<?php
class Photos extends CI_Controller {

	function Photos()
	{
		parent::__construct();
		$this->load->model('home_model');
	}
	
	function Index()
	{
		$user_name=$this->uri->segment(3); 
		if($user_name==''){
			redirect(base_url());
			exit(0);
		}
		$offset=(int)$this->uri->segment(5);
		if($offset<1)
		{ 
			$offset=1; 
		}
		$this->db->cache_off();
		$this->home_model->Set_free_where();	
		$this->home_model->Set_sql("user_id from gf_user");
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
		$data['site_title']=$this->uri->segment(3).'\'s Photos on Go4film.com - Favorites';
		$this->load->view('header',$data);
		$this->home_model->Set_free_where();	
		$this->home_model->Set_sql("genre_id,genre_name from gf_genre");
		$this->home_model->Set_orderby('genre_name');
		$this->db->cache_on();
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
		$index_data['stage_nav']='<h1 class="link"><a href="'.base_url().'profile/'.$user_name.'">'.$user_name.'\'s</a></h1> > <h1>Pictures</h1>';
		$this->load->library('pagination');
		$page['per_page'] = '60';
		$page['full_tag_open'] = '<div class="pagination">';
		$page['full_tag_close'] = '</div>';
		$page['cur_tag_open'] = '<span class="current">';
		$page['cur_tag_close'] = '</span>';
		$page['rel_tag'] = 'next';
		$page['base_url'] = base_url().'photos/'.$user_name.'/page/';
		//load the model and get results
		$offset=(($offset-1)*$page['per_page']);
		$this->home_model->Set_free_where();
		$this->home_model->Set_sql("picture_id,picture_act_id,caption,uploaded_on FROM gf_pictures");		
		if(($this->session->userdata('logged_in')==TRUE))
		{
			$this->home_model->Set_where("gf_pictures.user_id='".$profile['row_profile']->user_id."' AND `picture_share_to`='everyone'");
		}
		else
		{
			$this->home_model->Set_where("gf_pictures.user_id='".$profile['row_profile']->user_id."' AND `picture_share_to`='everyone'");
		}		
		$this->home_model->Set_groupby();
		$this->home_model->Set_orderby("picture_id DESC");
		$this->home_model->Set_limit($offset.",".$page['per_page']);
		$this->db->cache_off();
		$index_data['latest_pics']=$this->home_model->latest_post();
		$index_data['pic_user_id']=$profile['row_profile']->user_id;
		$page['cur_page'] = $offset;
		$page['total_rows']=$this->home_model->count_posts();
		$this->pagination->initialize($page);
		$this->load->view('profile/upload_pictires',$index_data);			
		$this->load->view('footer');
	}
}		