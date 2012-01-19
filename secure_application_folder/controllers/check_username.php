<?php
class Check_username extends CI_Controller {

	function Check_username()
	{
		parent::__construct();
		$this->load->model('user_model');
	}
	
	function Index()
	{
		$uname=explode("?ucheck=",$this->input->xss_clean($_SERVER['REQUEST_URI']));
		$this->db->cache_off();
		if(trim($uname[1])=='' || preg_match("/[^A-Za-z0-9_]/",trim($uname[1])))
		{
			echo "<font color=\"red\">Only letters, numbers and underscore are allowed</font>";
		}
		elseif(strlen(trim($uname[1]))<4)
		{
			echo "<font color=\"red\">Username needs to be 4 to 17 characters long.</font>";
		}
		elseif($this->user_model->check_authenticate($uname[1],'uname'))
		{
			echo "<font color=\"red\"><b>".$uname[1]."</b> was Taken! Try another one.</font>";
		}
	}
}