<?php
class Version extends CI_Controller {

	function Version()
	{
		parent::__construct();
		$this->load->model('home_model');
	}
	
	function Index()
	{
		if($this->uri->segment(3)!='part'){
			redirect(base_url());
			exit(0);
		}
		$part=$this->uri->segment(4);
		if(!is_numeric($part)){
			redirect(base_url());
			exit(0);
		}
		$version=$this->uri->segment(2);
		if(!is_numeric($version)){
			redirect(base_url());
			exit(0);
		}
		if($part==3){
		$link_part="link_url_3";
		}elseif($part==2){
		$link_part="link_url_2";
		}else{
		$link_part="link_url_1";
		}
		$sql_version_link="select $link_part from gf_film_link where link_id='".$version."'";
		$watch_link=$this->home_model->watch_link($sql_version_link);
		if(!empty($watch_link->$link_part)){
			$sql="UPDATE gf_film_link SET link_views=link_views+1 WHERE link_id='".$version."'";
			$user_ip=$this->session->userdata('user_ip');
			if($user_ip!==$this->input->ip_address())
			{
				$this->home_model->sql_query($sql);
			}
			if($user_ip=='')
			{
				$this->session->set_userdata('user_ip',$this->input->ip_address());
			}
			redirect($watch_link->$link_part);
		}else{
			redirect(base_url());
		}
	}
}