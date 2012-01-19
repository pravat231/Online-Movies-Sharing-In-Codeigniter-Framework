<?php
class Actor extends CI_Controller {
	function Actor()
	{
		parent::__construct();
		$this->load->model('home_model');
		$this->output->cache(260);
	}
	
	function Index()
	{
		$actor_id=$this->uri->segment(2); 
		if(!preg_match('/[0-9]/',$actor_id)){
			redirect(base_url());
			exit(0);
		}
		$this->load->library('sorted');
		if($this->uri->segment(3)=='sort')
		{
			$offset=(int)$this->uri->segment(6);
			$page['base_url'] = base_url().'actor/'.$actor_id.'/sort/'.$this->uri->segment(4).'/page/';
		}
		else
		{
			$offset=(int)$this->uri->segment(4);
			$page['base_url'] = base_url().'actor/'.$actor_id.'/page/';
		}
		if($offset<1) 
		{ 
			$offset=1; 
		}
		$actor_name=$this->home_model->actor_name($actor_id);
		if($offset==1)
		{
			$data['site_title']=$actor_name.'\'s Movies - Watch Onlline Movies Free';
		}
		else
		{
			$data['site_title']=$actor_name.'\'s Movies - Watch Onlline Movies Free - Page-'.$offset;
		}
		$this->load->view('header',$data);
		$this->home_model->Set_free_where();	
		$this->home_model->Set_sql("SUBSTRING(film_name,1,20) AS f_name,film_name,YEAR(film_release_date) as year,film_post_link,website_poster_url from gf_film");
		$this->home_model->Set_orderby("film_post_date desc");
		$this->home_model->Set_where("film_feature='Y'");
		$this->home_model->Set_limit("0,6");
		$feature['featured']=$this->home_model->latest_post();
		$this->load->view('home/featured',$feature);
		$this->load->view('home/welcome');
		$this->load->view('home_before_login/below_welcome');
		$this->load->view('home_before_login/search_box');
		$index_data['stage_nav']='<div class="link_nowrap">'.ucfirst($actor_name).'\'s Movies</div> > <div class="link_wrap">'.$this->sorted->sort_by_title().'</div>';
		$this->load->library('pagination');
		$page['per_page'] = '24';
		$page['full_tag_open'] = '<div class="pagination">';
		$page['full_tag_close'] = '</div>';
		$page['cur_tag_open'] = '<span class="current">';
		$page['cur_tag_close'] = '</span>';
		$page['rel_tag'] = 'next';
		//load the model and get results
		$offset=(($offset-1)*$page['per_page']);
		$this->home_model->Set_free_where();	
		$this->home_model->Set_sql("gf_film.film_id,film_name,DATE_FORMAT(film_release_date,'%d') AS DATE,DATE_FORMAT(film_release_date,'%m') AS month_ori,DATE_FORMAT(film_release_date,'%M') AS MONTH,DATE_FORMAT(film_release_date,'%Y') AS YEAR,film_release_date,film_feature,film_modify,film_post_link,website_poster_url,film_genre_value AS genres FROM gf_film left join gf_film_actor on gf_film_actor.film_id=gf_film.film_id");
		$this->home_model->Set_where("gf_film_actor.actor_id='".$actor_id."'");
		$this->home_model->Set_groupby();
		$this->home_model->Set_orderby($this->sorted->order_by());
		$this->home_model->Set_limit($offset.",".$page['per_page']);
		$index_data['latest_post']=$this->home_model->latest_post();
		$page['cur_page'] = $offset;
		$page['total_rows']=$this->home_model->count_posts();
		$this->pagination->initialize($page);
		$index_data['sort_url']=$this->sorted->sorted_link();
		$this->load->view('home/home_index',$index_data);
		$this->home_model->Set_free_where();
		$this->home_model->Set_sql("genre_id,genre_name from gf_genre");
		$this->home_model->Set_where();
		$this->home_model->Set_groupby();
		$this->home_model->Set_orderby('genre_name');
		$this->home_model->Set_limit();
		$sidebar['watch_category']=$this->home_model->latest_post();
		$this->load->view('sidebar',$sidebar);	
		$this->load->view('footer');
	}
}