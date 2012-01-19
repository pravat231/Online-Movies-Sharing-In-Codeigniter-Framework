<?php
class Year extends CI_Controller {

	function Year()
	{
		parent::__construct();
		$this->load->model('home_model');
        $this->output->cache(240);
	}
	
	function Index()
	{
		$year=$this->uri->segment(2); 
		if(!preg_match('~^\d{4}$~',$year)){
			redirect(base_url());
			exit(0);
		}
		$this->load->library('sorted');
		if($this->uri->segment(3)=='month')
		{
			if(!preg_match('~^\d{2}$~',$this->uri->segment(4))){
				redirect(base_url());
				exit(0);
			}
			$month=$this->uri->segment(4);
			if($this->uri->segment(5)=='sort')
			{
				$offset=(int)$this->uri->segment(8);
			}
			else
			{
				$offset=(int)$this->uri->segment(6);
			}
		}else{
			$month='';
			if($this->uri->segment(3)=='sort')
			{
				$offset=(int)$this->uri->segment(6);
			}
			else
			{
				$offset=(int)$this->uri->segment(4);
			}
		}
		if($offset<1)
		{ 
			$offset=1; 
		}
		if($offset==1)
		{	
			if($month!='')
			{
				$data['site_title']='Movies from - '.$this->sorted->get_month($month).' '.$year.' - Watch Onlline Movies Free';
			}else{
				$data['site_title']='Movies from - '.$year.' - Watch Onlline Movies Free';
			}
		}
		else
		{
			if($month!='')
			{
				$data['site_title']='Movies from - '.$this->sorted->get_month($month).' '.$year.' - Watch Onlline Movies Free - Page-'.$offset;
			}else{
				$data['site_title']='Movies from - '.$year.' - Watch Onlline Movies Free - Page-'.$offset;
			}
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
		if($month!='')
		{
			$index_data['stage_nav']='<div class="link_nowrap">Movies from '.$this->sorted->get_month($month).' '.$year.'</div> > <div class="link_wrap">'.$this->sorted->sort_by_title().'</div>';
		}
		else
		{
			$index_data['stage_nav']='<div class="link_nowrap">Movies from '.$year.'</div> > <div class="link_wrap">'.$this->sorted->sort_by_title().'</div>';
		}		
		$this->load->library('pagination');
		if($month!='')
		{
			if($this->uri->segment(5)=='sort')
			{
				$page['base_url'] = base_url().'year/'.$year.'/month/'.$month.'/sort/'.$this->sorted->sorted.'/page/';
			}
			else
			{
				$page['base_url'] = base_url().'year/'.$year.'/month/'.$month.'/page/';
			}
		}
		else
		{
			if($this->uri->segment(3)=='sort')
			{
				$page['base_url'] = base_url().'year/'.$year.'/sort/'.$this->sorted->sorted.'/page/';
			}
			else
			{
				$page['base_url'] = base_url().'year/'.$year.'/page/';
			}
		}
		$page['per_page'] = '24';
		$page['full_tag_open'] = '<div class="pagination">';
		$page['full_tag_close'] = '</div>';
		$page['cur_tag_open'] = '<span class="current">';
		$page['cur_tag_close'] = '</span>';
		$page['rel_tag'] = 'next';
		//load the model and get results
		$offset=(($offset-1)*$page['per_page']);
		if($month!='')
		{
			$this->home_model->Set_free_where();	
			$this->home_model->Set_orderby($this->sorted->order_by());
			$this->home_model->Set_where("film_release_date like '".$year."-".$month."%'");
		}
		else
		{
			$this->home_model->Set_free_where();	
			$this->home_model->Set_orderby("gf_film.film_modify desc");
			$this->home_model->Set_where("film_release_date like '".$year."%'");
		}
		$this->home_model->Set_sql("gf_film.film_id,film_name,DATE_FORMAT(film_release_date,'%d') AS DATE,DATE_FORMAT(film_release_date,'%m') AS month_ori,DATE_FORMAT(film_release_date,'%M') AS MONTH,DATE_FORMAT(film_release_date,'%Y') AS YEAR,film_release_date,film_feature,film_modify,film_post_link,website_poster_url,film_genre_value AS genres FROM gf_film");
		$this->home_model->Set_groupby();
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