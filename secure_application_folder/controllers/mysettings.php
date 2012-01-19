<?php
class Mysettings extends CI_Controller {

	function Mysettings()
	{
		parent::__construct();
		$this->load->model('setting_model');
	}
	
	function Index()
	{
		if($this->session->userdata('logged_in')!=TRUE)
		{
			redirect(base_url());
			exit(0);
		}		
		$data['site_title']='Watch Movies Online - Full Movies Online -Go4film.com - Free Movies Online Profile Settings';
		$this->load->view('header',$data);
		$this->setting_model->Set_free_where();	
		$this->setting_model->Set_sql("genre_id,genre_name from gf_genre");
		$this->setting_model->Set_orderby('genre_name');
		$sidebar['watch_category']=$this->setting_model->latest_post();
		$this->load->view('sidebar',$sidebar);
		$this->load->view('home_after_login/search_box');
		$user_data['error']='';
		$this->db->cache_off();
		$user_id=$this->session->userdata('user_id');
		$user_name=$this->session->userdata('user_name');
		if($this->input->post('mysettings')=='Update Profile')
		{
			$country=$this->input->post('country');
			$aboutme=mysql_real_escape_string(htmlentities($this->input->post('aboutme')));
			$hobbies=mysql_real_escape_string(htmlentities($this->input->post('hobbies')));
			if($country=='')
			{
				$sql_profile_up="update gf_user set country=NULL,about_me='$aboutme',hobbies='$hobbies' where user_id='$user_id'";
			}
			else
			{
				$sql_profile_up="update gf_user set country='$country',about_me='$aboutme',hobbies='$hobbies' where user_id='$user_id'";
			}
			if($this->setting_model->sql_write_query($sql_profile_up))
			{
				$this->db->cache_delete('profile+'.$user_name);
				$user_data['error']="<div class='ok_message'>Settings have been updated!</div>";
			}
			else
			{
				$user_data['error']="<div class='error_message'>Same info can't be updated!</div>";
			}
		}
		
		if($this->input->post('mysettings')=='Update Privacy')
		{
			$pmnotify=$this->input->post('pmnotify');
			$who_can_view=$this->input->post('who_can_view');
			$recentvisit=$this->input->post('recentvisit');
			$tagging=$this->input->post('tagging');
			$sql_privacy_up="update gf_user set pm_notify_mail='$pmnotify',view_content_to='$who_can_view',view_recent_visit='$recentvisit',photo_tagging='$tagging' where user_id='$user_id'";
			if($this->setting_model->sql_write_query($sql_privacy_up))
			{
				$this->db->cache_delete('profile+'.$user_name);
				$user_data['error']="<div class='ok_message'>Settings have been updated!</div>";
			}
			else
			{
				$user_data['error']="<div class='error_message'>Same info can't be updated!</div>";
			}
		}
		
		if($this->input->post('mysettings')=='Update Avatar')
		{
			$upload_path=$_SERVER['DOCUMENT_ROOT']."/user_thumb/";
			$upload_file_name=md5(uniqid(mt_rand(), true));
			$oldavatar=$this->input->post('oldavatar');
			if(file_exists($upload_path.$oldavatar.'.jpg'))
			{
				unlink($upload_path.$oldavatar.'.jpg');
			}
			$config['upload_path'] = $upload_path;
			$config['file_name']=$upload_file_name.'.jpg';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['overwrite'] = false;
			$config['remove_spaces'] = true;
			$this->load->library('upload', $config);
			if(!$this->upload->do_upload('user_avatar'))
			{
				$user_data['error']="<div class='error_message'>There is some error occured!</div>";
			}	
			else
			{
				$config['source_image']=$this->upload->upload_path.$this->upload->file_name;
				$config['maintain_ratio']=FALSE;
				$config['width'] = 75;
				$config['height'] = 100;
				$this->load->library('image_lib',$config);
				if(!$this->image_lib->resize())
				{
					$user_data['error']="<div class='error_message'>There is some error occured!</div>";
				}
				else
				{
					$sql_avtar_up="update gf_user set avatar='$upload_file_name' where user_id='$user_id'";
					if($this->setting_model->sql_write_query($sql_avtar_up))
					{
						$this->db->cache_delete('profile+'.$user_name);
						$user_data['error']="<div class='ok_message'>Avtar has been updated!</div>";
					}
					else
					{
						$user_data['error']="<div class='error_message'>Same info can't be updated!</div>";
					}
				}
			}
		}
			
		if($this->input->post('mysettings')=='Update Email')
		{
			$opt_email=$this->input->post('opt_email');
			$hidden_opt_email=$this->input->post('hidden_opt_email');
			$this->load->model('user_model');
			if(trim($opt_email)==trim($hidden_opt_email))
			{
				$user_data['error']="<div class='error_message'>Same info can't be updated!</div>";
			}elseif(trim($opt_email)=='' || !preg_match("/^[_A-z0-9-]+((\.|\+)[_A-z0-9-]+)*@[A-z0-9-]+(\.[A-z0-9-]+)*(\.[A-z]{2,4})$/",trim($opt_email)))
			{
				$user_data['error']="<div class='error_message'>Please enter a valid email address!</div>";
			}
			elseif($this->user_model->check_authenticate($opt_email,'email'))
			{
				$user_data['error']="<div class='error_message'>That email is already in use by another user!</div>";
			}
			else
			{
				$sql_email_up="update gf_user set email='$opt_email' where user_id='$user_id'";
				if($this->setting_model->sql_write_query($sql_email_up))
				{
					$this->db->cache_delete('profile+'.$user_name);
					$user_data['error']="<div class='ok_message'>Email address has been updated!</div>";
				}
				else
				{
					$user_data['error']="<div class='error_message'>Same info can't be updated!</div>";
				}
			}
			
		}
		
		$user_data['user_data']=$this->setting_model->get_user_data($user_id);

		if($this->input->post('mysettings')=='Update Password')
		{
			$opt_oldpass=$this->input->post('opt_oldpass');
			$opt_password=$this->input->post('opt_password');
			$opt_password2=$this->input->post('opt_password2');
			if(trim($opt_oldpass)!='' || trim($opt_password)!=''){
				if(sha1(trim($opt_oldpass))!=$user_data['user_data']->password)
				{
					$user_data['error']="<div class='error_message'>Current password you entered isn't correct. Please enter the correct current password!</div>";
				}
				elseif(trim($opt_password)=='' && strlen(trim($opt_password)) < 5)
				{
					$user_data['error']="<div class='error_message'>That new password needs to be at least 5 characters!</div>";

				}
				elseif(trim($opt_password)!=trim($opt_password2))
				{
					$user_data['error']="<div class='error_message'>That new password/new password again field needs to be match!</div>";
				}
				else
				{
					$opt_password=sha1($opt_password);
					$sql_password_up="update gf_user set password='$opt_password' where user_id='$user_id'";
					if($this->setting_model->sql_write_query($sql_password_up))
					{
						$this->db->cache_delete('profile+'.$user_name);
						$user_data['error']="<div class='ok_message'>Password has been updated!</div>";
					}
					else
					{
						$user_data['error']="<div class='error_message'>Same info can't be updated!</div>";
					}	
				}
			}
			else
			{
				$user_data['error']="<div class='error_message'>Password field can't be blank!</div>";
			}
		}		
		$this->db->cache_on();
		$user_data['country']=$this->setting_model->get_country_data();
		$this->load->view('user/mysettings',$user_data);
		$this->load->view('footer');		
	}
}