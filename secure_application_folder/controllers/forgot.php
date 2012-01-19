<?php
class Forgot extends CI_Controller {

	function Forgot()
	{
		parent::__construct();
		$this->load->model('home_model');
	}
	
	function Index()
	{
		if($this->session->userdata('logged_in')==TRUE)
		{
			redirect(base_url());
			exit(0);
		}
		$data['site_title']='Watch Movies Online - Full Movies Online -Go4film.com - Free Movies Online Forgot Password';
		$this->load->view('header',$data);
		$this->home_model->Set_free_where();	
		$this->home_model->Set_sql("genre_id,genre_name from gf_genre");
		$this->home_model->Set_orderby('genre_name');
		$sidebar['watch_category']=$this->home_model->latest_post();
		$this->load->view('sidebar',$sidebar);
		$this->load->view('home_before_login/search_box');
		$this->db->cache_off();
		$this->load->helper('recaptchalib');
		$submitted=$this->input->post('forgot_submit');
		$error_msg['error']='';
		if(trim($submitted)!=''){
			$email=$this->input->post('forgot_email');
			$email_conf=$this->input->post('conf_email');
			if(trim($email)=='' || !preg_match("/^[_A-z0-9-]+((\.|\+)[_A-z0-9-]+)*@[A-z0-9-]+(\.[A-z0-9-]+)*(\.[A-z]{2,4})$/",trim($email))){
				$error_msg['error']="<div class='error_message'>Please enter a valid email address.</div>";
			}elseif(!$this->email_validation()){
				$error_msg['error']="<div class='error_message'>This email address is not registered with us.</div>";
			}elseif(trim($email)!=trim($email_conf)){
				$error_msg['error']="<div class='error_message'>That Email/Confirm Email field needs to be match.</div>";
			}/*elseif($this->recaptcha_validation()){
				$error_msg['error']="<div class='error_message'>The code that you entered was not correct.Try again.</div>";
			}*/else{
				if($user_id=$this->home_model->retrieve_user_id($email))
				{
					$reset_password=sha1(trim($email)).sha1(time());
					$email_url=base_url()."reset_password/".$reset_password;
					if(!empty($user_id) && !empty($reset_password)){
						$this->load->model('user_model');
						if($this->user_model->update_reset_password($user_id,$reset_password))
						{
							$this->load->library('email');
							$this->email->from('support@go4film.com', 'Go4film Support Dept.');
							$this->email->to($email);
							$this->email->bcc('pravat_231@yahoo.co.in');
							$this->email->reply_to('support@go4film.com','Go4film Support Dept.');
							$this->email->subject('Go4film Password Assistance');
							$this->email->message("To initiate the password reset process for your\n ".$email." Go4film Account, click the link below:\n\n".$email_url."\n\nIf clicking the link above doesn't work, please copy and paste the URL in a\nnew browser window instead.\n\nIf you've received this mail in error, it's likely that another user entered\nyour email address by mistake while trying to reset a password. If you didn't\ninitiate the request, you don't need to take any further action and can safely\ndisregard this email.\n\nThank you for using Go4film.\n\n\nThis is a post-only mailing.  Replies to this message are not monitored\nor answered.");
							if($this->email->send())
							{
								$error_msg['error']="<div class='ok_message'>Reset Password link emailed to ".$email.".</div>";
							}
							else
							{
								$error_msg['error']="<div class='error_message'>There is some error occured during mail sending.</div>";
							}
						}
					}
					else
					{
						$error_msg['error']="<div class='error_message'>There is some error occured.</div>";
					}
				}
				else
				{
					$error_msg['error']="<div class='error_message'>This email address is not registered with us.</div>";
				}			
			}
		}
		$this->load->view('home/forgot',$error_msg);
		$this->load->view('footer');
	}
	
	function recaptcha_validation()
	{
		$return = recaptcha_check_answer($this->config->item('6LcpXr0SAAAAAK3XtW9wkH-3z2CZZTu0E2teQzUW'),$_SERVER["REMOTE_ADDR"],$this->input->post("recaptcha_challenge_field"),$this->input->post("recaptcha_response_field"));
		if(!$return->is_valid)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function email_validation()
	{
		$this->load->model('user_model');
		if($this->user_model->check_authenticate($this->input->post('forgot_email'),'email'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
}