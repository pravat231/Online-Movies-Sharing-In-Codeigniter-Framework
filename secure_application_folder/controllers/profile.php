<?php
class Profile extends Controller {

	function Profile()
	{
		parent::__construct();
		$this->load->model('home_model');
	}
	
	function Index()
	{
		if($this->uri->segment(3)=='')
		{
			redirect(base_url());
			exit(0);
		}
		if($this->uri->segment(4)!='')
		{
			redirect(base_url());
			exit(0);
		}
		$this->home_model->Set_free_where();	
		$this->home_model->Set_sql("user_id,username,DATE_FORMAT(birth_day,'%D %b, %Y') AS birth_day,gender,country_name,profileviews,lastlogin,avatar,registration_date,about_me,hobbies from gf_user left join gf_country on country=country_code");
		$this->home_model->Set_orderby();
		$this->home_model->Set_where("username='".$this->uri->segment(3)."'");
		$this->home_model->Set_limit();
		$profile['row_profile']=$this->home_model->watch_post();
		if(empty($profile['row_profile']))
		{
			$this->session->set_flashdata('msg','<div class="error_message">No such user exist.</div>');
			redirect(base_url());
			exit(0);
		}
		$data['site_title']=$this->uri->segment(3).'\'s Profile on Go4film.com';
		$this->load->view('header',$data);
		$this->home_model->Set_free_where();	
		$this->home_model->Set_sql("genre_id,genre_name from gf_genre");
		$this->home_model->Set_orderby('genre_name');
		$sidebar['watch_category']=$this->home_model->latest_post();
		$this->load->view('sidebar',$sidebar);
		if($this->session->userdata('logged_in')==TRUE)
		{
			$this->load->view('home_after_login/search_box');
		}
		else
		{
			$this->load->view('home_before_login/search_box');
		}
		$profile['right_col']=$this->right_column($profile['row_profile']->user_id);
		$this->load->helper('date');
		$this->load->view('profile/profile',$profile);
		$this->load->view('profile/pictures',$profile);
		$this->load->view('profile/profile_comments',$profile);
		$profile['user_name']=$this->session->userdata('user_name');
		$this->load->view('profile/profile_post_comments',$profile);
		$user_ip=$this->session->userdata('user_ip');
		if($user_ip!==$this->input->ip_address())
		{
			$this->db->cache_off();
			$this->home_model->sql_query("UPDATE gf_user SET profileviews=profileviews+1 WHERE username='".$this->uri->segment(3)."'");
		}
		$this->load->view('footer');
		if($user_ip=='')
		{
			$this->session->set_userdata('user_ip',$this->input->ip_address());
		}
	}
	
	function right_column($user_id='')
	{
		$user_name=$this->session->userdata('user_name');
		if($user_name===$this->uri->segment(3))
		{
			$output='<td width="135" rowspan="10" align="left" valign="top"><a href="'.base_url().'mysettings/yes" class="profile_button"><span class="profile_user_settings">My Settings</span></a><a href="'.base_url().'photos/'.$this->uri->segment(3).'" class="profile_button"><span class="profile_user_pictures">My Pictures</span></a><a href="'.base_url().'friends/'.$this->uri->segment(3).'" class="profile_button"><span class="profile_user_friends">My Friends</span></a><a href="'.base_url().'comments/'.$this->uri->segment(3).'" class="profile_button"><span class="profile_user_comments">My Comments</span></a></td>
            <td width="135" rowspan="9" align="left" valign="top"><a href="'.base_url().'favorites/'.$this->uri->segment(3).'" class="profile_button"><span class="profile_user_favorites">My Favorites</span></a><a href="'.base_url().'watched/'.$this->uri->segment(3).'" class="profile_button"><span class="profile_user_watched">Stuff I Watched</span></a><a href="#" class="profile_button"><span class="profile_report_user">Report User</span></a><a href="'.base_url().'reviews/'.$this->uri->segment(3).'" class="profile_button"><span class="profile_user_reviews">My Reviews</span></a></td>';
		}
		else
		{
			$output='<td width="135" rowspan="10" align="left" valign="top"><a href="'.base_url().'change_friendship/add/'.$user_id.'" name="add" class="profile_button"><span class="profile_add_friend">Add Friend</span></a><a href="'.base_url().'pm/'.$this->uri->segment(3).'" class="profile_button"><span class="profile_message_user">Send Message</span></a><a href="'.base_url().'photos/'.$this->uri->segment(3).'" class="profile_button"><span class="profile_user_pictures">My Pictures</span></a><a href="'.base_url().'friends/'.$this->uri->segment(3).'" class="profile_button"><span class="profile_user_friends">My Friends</span></a><a href="'.base_url().'comments/'.$this->uri->segment(3).'" class="profile_button"><span class="profile_user_comments">My Comments</span></a></td>
			<td width="135" rowspan="9" align="left" valign="top"><a href="'.base_url().'change_friendship/block/'.$user_id.'" name="block" class="profile_button"><span class="profile_block_user">Block User</span></a><a href="'.base_url().'favorites/'.$this->uri->segment(3).'" class="profile_button"><span class="profile_user_favorites">My Favorites</span></a><a href="'.base_url().'watched/'.$this->uri->segment(3).'" class="profile_button"><span class="profile_user_watched">Stuff I Watched</span></a><a href="javascript:smallPop(\''.base_url().'report_user/'.$user_id.'\')" class="profile_button profile_button_unpressed"><span class="profile_report_user">Report User</span></a><a href="'.base_url().'reviews/'.$this->uri->segment(3).'" class="profile_button"><span class="profile_user_reviews">My Reviews</span></a></td>';
		}
		return $output;
	}
}