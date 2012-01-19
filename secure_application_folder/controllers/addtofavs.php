<?php
class Addtofavs extends CI_Controller {

	function Addtofavs()
	{
		parent::__construct();
		$this->db->cache_off();
		$this->load->model('setting_model');
	}
	
	function Index()
	{
		if($this->session->userdata('logged_in')!=TRUE)
		{
			$this->session->set_flashdata('msg','<div class="error_message">Please login to add videos to favorites</div>');
			redirect($this->session->flashdata('referrer'));
			exit(0);
		}
		
		if($this->uri->segment(3)=='')
		{
			$this->session->set_flashdata('msg','<div class="error_message">You need to select an actual video</div>');
			redirect(base_url());
			exit(0);
		}
		if($this->setting_model->sql_rows("Select film_id from gf_film where film_id='".$this->uri->segment(3)."'")==0)
		{
			$this->session->set_flashdata('msg','<div class="error_message">You need to select an actual video</div>');
			redirect(base_url());
			exit(0);
		}
		
		if($this->setting_model->sql_rows("Select * from gf_favorites where user_id='".$this->session->userdata('user_id')."' AND film_id='".$this->uri->segment(3)."'")>0)
		{
			$this->session->set_flashdata('msg','<div class="error_message">This video is already on your favorites list</div>');
			redirect($this->session->flashdata('referrer'));
			exit(0);
		}
		
		$sql="INSERT INTO gf_favorites(user_id,film_id)VALUES('".$this->session->userdata('user_id')."','".$this->uri->segment(3)."')";
		if($this->setting_model->sql_write_query($sql))
		{
			$this->session->set_flashdata('msg','<div class="ok_message">Movie added to favorites</div>');
			redirect($this->session->flashdata('referrer'));
			exit(0);
		}
		else
		{
			$this->session->set_flashdata('msg','<div class="error_message">This video is already on your favorites list</div>');
			redirect($this->session->flashdata('referrer'));
			exit(0);
		}
	}
}