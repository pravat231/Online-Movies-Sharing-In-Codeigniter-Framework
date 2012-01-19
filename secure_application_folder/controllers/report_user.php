<?php
class Report_user extends CI_Controller {

	function Report_user()
	{
		parent::__construct();
	}
	
	function Index()
	{
		$this->load->view('report/report_user');
	}
}
