<?php
class Share_email extends CI_Controller {

	function Share_email()
	{
		parent::__construct();
		$this->load->model('home_model');
	}
	
	function Index()
	{
		$share_name=$this->input->post('share_name');
		$share_email=$this->input->post('share_email');
		$share_url=$this->input->post('share_url');
		$share_img=$this->input->post('share_img');
		$share_movname=$this->input->post('share_movname');
		if(($share_name=='') || ($share_email==''))
		{
			echo "<div class='error_message'>Name and email must be filled in.</div>";
		}
		elseif($this->spamcheck($share_email))
		{
			$subject='Watching movie on Go4Film.com';
			$message='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
			<style type="text/css">
			<!--
			.style1 {color: #FF0033}
			-->
			</style>
			</head>
			<body>
			<table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
			  <tr>
				<td colspan="2" align="center" valign="top"><h1>Watch &quot;'.$share_movname.'&quot;</h1></td>
			  </tr>
			  <tr>
				<td width="150" height="225" rowspan="1" align="center" valign="top"><img src="'.base_url().'thumbs/'.$share_img.'.jpg"/></td>
				<td width="350" align="left" valign="top">Your buddy '.$share_name.', sent you a movie you might be interested in watching  on www.go4film.com. Its totally free and there are no strings  attached. Follow the link below to see the movie your friend sent you:<br />
				  <br />
				  <a href="'.$share_url.'" target="_blank">'.$share_url.'</a><br />
				  <br />
		Enjoy!</td>
			  </tr>
			  <tr>
				<td colspan="2" align="center" valign="top"><h4 class="style1">Copyright 2009 www.go4film.com</h4></td>
			  </tr>
			</table>
			</body>
			</html>';
			$config = array();
			$config['mailtype'] = 'html';
			$this->load->library('email', $config);  
			$this->email->from('admin@go4film.com','Go4film Admin');
			$this->email->to($share_email);
			$this->email->cc('pravat.231@gmail.com');
			$this->email->bcc('pravat_231@yahoo.co.in');
			$this->email->reply_to('admin@go4film.com','Go4film Admin');
			$this->email->subject($subject);
			$this->email->message($message);
			if($this->email->send())
			{
				echo "<div class='ok_message'>Your message has been sent. Thanks for sharing the movie with your friend!</div>";
			}
			else
			{
				echo "<div class='error_message'>Mail not send there is some error in our Server.</div>";
			}	
		}
		else
		{
			echo "<div class='error_message'>Please enter a valid email.</div>";
		}
	}
	
	function spamcheck($field)
	{
		$field=filter_var($field, FILTER_SANITIZE_EMAIL);
		if(filter_var($field, FILTER_VALIDATE_EMAIL))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
}