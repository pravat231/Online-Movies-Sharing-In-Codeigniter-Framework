<?php
class Delfrmfavs extends CI_Controller {

	function Delfrmfavs()
	{
		parent::__construct();
		$this->db->cache_off();
		$this->load->model('setting_model');
	}
	
	function Index()
	{
		if($this->session->userdata('logged_in')!=TRUE)
		{
			$this->session->set_flashdata('msg','<div class="error_message">Please login to delete videos from favorites</div>');
			redirect($this->session->flashdata('referrer'));
			exit(0);
		}
		if($this->uri->segment(3)=='')
		{
			$this->session->set_flashdata('msg','<div class="error_message">You need to select an actual video</div>');
			redirect(base_url());
			exit(0);
		}
		if($this->setting_model->sql_rows("Select * from gf_favorites where user_id='".$this->session->userdata('user_id')."' AND favorite_id='".$this->uri->segment(3)."'")==0)
		{
			$this->session->set_flashdata('msg','<div class="error_message">This video is not available in your favorites list</div>');
			redirect(base_url());
			exit(0);
		}
		$sql="DELETE FROM gf_favorites WHERE favorite_id='".$this->uri->segment(3)."' AND user_id='".$this->session->userdata('user_id')."'";		
		if($this->setting_model->sql_write_query($sql))
		{
			$this->session->set_flashdata('msg','<div class="ok_message">Movie deleted from favorites</div>');
			redirect($this->session->flashdata('referrer'));
			exit(0);
		}
		else
		{
			$this->session->set_flashdata('msg','<div class="error_message">This video is already in your favorites list</div>');
			redirect($this->session->flashdata('referrer'));
			exit(0);
		}
	}
}