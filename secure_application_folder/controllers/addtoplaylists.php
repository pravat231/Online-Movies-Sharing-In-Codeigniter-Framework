<?php
class Addtoplaylists extends CI_Controller {

	function Addtoplaylists()
	{
		parent::__construct();
		$this->load->model('home_model');
	}
	
	function Index()
	{
		if($this->session->userdata('logged_in')!=TRUE)
		{
			$this->session->set_flashdata('msg','<div class="error_message">Please login to add this to your playlist</div>');
			redirect($this->session->flashdata('referrer'));
			exit(0);
		}
	}
}