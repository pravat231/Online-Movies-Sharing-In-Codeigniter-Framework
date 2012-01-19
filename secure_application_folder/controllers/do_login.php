<?php
class Do_login extends CI_Controller {

	function Do_login()
	{
		parent::__construct();
		$this->db->cache_off();
		$this->load->model('home_model');
	}
	
	function Index()
	{
		if($this->input->post('action')=='user_login'){
			$post_username=$this->input->post('username');
			$post_password=$this->input->post('password');
			$post_password=sha1($post_password);
			$post_remember_me=$this->input->post('remember_me');
			$this->home_model->Set_free_where();	
			$this->home_model->Set_sql("user_id,username,password,status from gf_user");
			$this->home_model->Set_orderby();
			$this->home_model->Set_where("username='".$post_username."' and password='".$post_password."'");
			$this->home_model->Set_limit('0,1');
			$result_login=$this->home_model->latest_post();
			if(count($result_login)>0){ 
				$data = array(
							'logged_in'=>TRUE,
							'user_name'=>$result_login[0]['username'],
							'user_id'=>$result_login[0]['user_id']
						);
				$this->session->set_userdata($data);	
				$sql_instant="update gf_user set status='ACTIVE' where user_id='".$result_login[0]['user_id']."'";
				$this->home_model->sql_query($sql_instant);
				if($post_remember_me=='yes'){
					set_cookie("remember_me", true, 604800);
					set_cookie("info",$result_login[0]['user_id'].','.md5($result_login[0]['password']), 604800);
				}
				echo 'OK';
			}else{
				$auth_error='<div id="notification_error">The login info is not correct.</div>';
				echo $auth_error;
			}
		}
	}
}