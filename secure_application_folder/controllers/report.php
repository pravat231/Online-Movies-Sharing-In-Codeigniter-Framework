<?php
class Report extends CI_Controller {

	function Report()
	{
		parent::__construct();
	}
	
	function Index()
	{
		$this->load->view('report/report');
	}
}
