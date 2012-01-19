<?php
class Delfrmwatched extends CI_Controller {

	function Delfrmwatched()
	{
		parent::__construct();
		$this->db->cache_off();
		$this->load->model('setting_model');
	}
	
	function Index()
	{
		if($this->session->userdata('logged_in')!=TRUE)
		{
			$this->session->set_flashdata('msg','<div class="error_message">Please login to delete videos from watched list</div>');
			redirect($this->session->flashdata('referrer'));
			exit(0);
		}
		if($this->uri->segment(3)=='')
		{
			$this->session->set_flashdata('msg','<div class="error_message">You need to select an actual video</div>');
			redirect(base_url());
			exit(0);
		}
		if($this->setting_model->sql_rows("Select * from gf_watched where user_id='".$this->session->userdata('user_id')."' AND watched_id='".$this->uri->segment(3)."'")==0)
		{
			$this->session->set_flashdata('msg','<div class="error_message">This video is not available in your watched list</div>');
			redirect(base_url());
			exit(0);
		}
		$sql="DELETE FROM gf_watched WHERE watched_id='".$this->uri->segment(3)."' AND user_id='".$this->session->userdata('user_id')."'";		
		if($this->setting_model->sql_write_query($sql))
		{
			$this->session->set_flashdata('msg','<div class="ok_message">Movie deleted from watched list</div>');
			redirect($this->session->flashdata('referrer'));
			exit(0);
		}
		else
		{
			$this->session->set_flashdata('msg','<div class="error_message">This video is already in your watched list</div>');
			redirect($this->session->flashdata('referrer'));
			exit(0);
		}
	}
}