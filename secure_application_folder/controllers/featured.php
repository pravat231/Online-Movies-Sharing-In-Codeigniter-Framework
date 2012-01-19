<?php
class Featured extends CI_Controller {
	function Featured()
	{
		parent::__construct();
	}
	
	function Index()
	{
		$value=$this->uri->segment(3);
		if($value=='yes')
		{
			delete_cookie("FeaturedCookie");
			redirect(base_url());
			exit(0);
		}
		elseif($value=='no')
		{
			$time=time();
			set_cookie("FeaturedCookie",$time,604800);
			redirect(base_url());
			exit(0);
		}
		else
		{
			redirect(base_url());
			exit(0);
		}
	}
}