<?php
class Register extends CI_Controller {

	function Register()
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
		$data['site_title']='Watch Movies Online - Full Movies Online -Go4film.com - Free Movies Online Register';
		$this->load->view('header',$data);
		$this->home_model->Set_free_where();	
		$this->home_model->Set_sql("genre_id,genre_name from gf_genre");
		$this->home_model->Set_orderby('genre_name');
		$sidebar['watch_category']=$this->home_model->latest_post();
		$this->load->view('sidebar',$sidebar);
		$this->load->view('home_before_login/search_box');
		$this->db->cache_off();
		$this->load->helper('recaptchalib');
		$submitted=$this->input->post('submit');
		$error_msg['error']='';
		if(trim($submitted)!=''){
			$username=$this->input->post('username');
			$email=$this->input->post('email');
			$password=$this->input->post('password');
			$password2=$this->input->post('password2');
			$gender=$this->input->post('gender');
			$birth_day_sel=$this->input->post('birth_day_sel');
			$birth_month_sel=$this->input->post('birth_month_sel');
			$birth_year_sel=$this->input->post('birth_year_sel');
			$heard_about=$this->input->post('heard_about');
			if(empty($birth_day_sel) && empty($birth_month_sel) && empty($birth_year_sel)){
				$error_msg['error']="<div class='error_message'>Invalid age entered.</div>";
			}elseif(trim($username)=='' || preg_match("/[^A-Za-z0-9_]/",trim($username))){
				$error_msg['error']="<div class='error_message'>Only letters, numbers and underscore are allowed for Username</div>";
			}elseif(strlen(trim($username))<4){
				$error_msg['error']="<div class='error_message'>Username needs to be 3 to 17 characters long.</div>";
			}elseif($this->username_validation()){
				$error_msg['error']="<div class='error_message'>You were too late.. <b>$username</b> was already Taken! Try another one..</div>";
			}elseif(trim($password)=='' && strlen(trim($password)) < 5){
				$error_msg['error']="<div class='error_message'>That password needs to be at least 5 characters.</div>";
			}elseif(trim($password)!=trim($password2)){
				$error_msg['error']="<div class='error_message'>That password/password again field needs to be match.</div>";
			}elseif(trim($email)=='' || !preg_match("/^[_A-z0-9-]+((\.|\+)[_A-z0-9-]+)*@[A-z0-9-]+(\.[A-z0-9-]+)*(\.[A-z]{2,4})$/",trim($email))){
				$error_msg['error']="<div class='error_message'>Please enter a valid email address.</div>";
			}elseif($this->email_validation()){
				$error_msg['error']="<div class='error_message'>That email is already in use by another user.</div>";
			}elseif($gender==''){
				$error_msg['error']="<div class='error_message'>Are you a homosexual.</div>";
			}/*elseif($this->recaptcha_validation()){
				$error_msg['error']="<div class='error_message'>The code that you entered was not correct.Try again.</div>";
			}*/else{
				$password=sha1($password);
				$birthday=$birth_year_sel.'-'.$birth_month_sel.'-'.$birth_day_sel;
				$time=time();
				$sql_register="insert into gf_user set email='$email',username='$username',password='$password',birth_day='$birthday',gender='$gender',hear_from='".mysql_real_escape_string($heard_about)."',registration_date=".$time;
				if($this->home_model->sql_query($sql_register)){
					$this->home_model->Set_free_where();
					$this->home_model->Set_sql("user_id,username,password,status from gf_user");
					$this->home_model->Set_orderby();
					$this->home_model->Set_where("username='".$username."' and password='".$password."'");
					$this->home_model->Set_limit('0,1');
					$result_login=$this->home_model->latest_post();
					if(count($result_login)>0){ 
						$data = array(
									'logged_in'=>TRUE,
									'user_name'=>$result_login[0]['username'],
									'user_id'=>$result_login[0]['user_id']
								);
						$this->session->set_userdata($data);	
						$this->session->set_flashdata("msg_set","<div class='ok_message'>You have registered successfully, and you may begin using the site!</div>");
						redirect('mysettings/');
						exit(0);
					}
				}else{
					$error_msg['error']="<div class='error_message'>There is something database error occured.Try to submit again.</div>";				 						
				}					
			}
		}
		$this->load->view('home/register',$error_msg);
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
	
	function username_validation()
	{
		$this->load->model('user_model');
		if($this->user_model->check_authenticate($this->input->post('username'),'uname'))
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
		if($this->user_model->check_authenticate($this->input->post('email'),'email'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
}