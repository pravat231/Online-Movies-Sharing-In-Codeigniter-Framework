<?php
class Watch extends CI_Controller {

	function Watch()
	{
		parent::__construct();
		$this->load->model('home_model');
        $this->output->cache(1440);
	}
	
	function Index()
	{
		$watch_url=$this->uri->segment(2);
		if(!preg_match('/[0-9a-zA-Z]/',$watch_url)){
			redirect(base_url());
			exit(0);
		}
		$this->home_model->Set_free_where();
		$this->home_model->Set_where("gf_film.film_post_link='".$watch_url."'");
		$this->home_model->Set_sql("gf_film.film_id,film_name,film_plot,DATE_FORMAT(film_release_date,'%d') as date_ori,DATE_FORMAT(film_release_date,'%m') as month_ori,DATE_FORMAT(film_release_date,'%M') as month,DATE_FORMAT(film_release_date,'%Y') as year,film_post_link,original_poster_url,website_poster_url,film_genre_value,film_actor_value,film_director_value,imdb_link,trailer from gf_film");
		$this->home_model->Set_orderby();
		$this->home_model->Set_limit("0,1");
		$watch_post['row_watch']=$this->home_model->watch_post();
		if($watch_post['row_watch']==''){
			redirect(base_url());
			exit(0);
		}
		$watch_post['site_title']='Watch '.$watch_post['row_watch']->film_name.' '.$watch_post['row_watch']->year.' Movie Online For Free On Go4film.com';
		$watch_post['meta_description']='Watch '.$watch_post['row_watch']->film_name.' Full Length Movie Streaming Online For Free.';
		$this->load->view('home/header_watch',$watch_post);
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
		$watch_post['stage_nav']='<div class="link_nowrap">Movies</div> > <div class="link_wrap">'.anchor('year/'.$watch_post["row_watch"]->year,$watch_post["row_watch"]->year).'</div> > <div class="link_wrap">'.anchor('year/'.$watch_post["row_watch"]->year.'/month/'.$watch_post["row_watch"]->month_ori,$watch_post["row_watch"]->month).'</div> > <span class="stage_navigation_current"><span class="link_wrap">Watch '.$watch_post["row_watch"]->film_name.'</span></span>';
		$this->home_model->Set_free_where();	
		$this->home_model->Set_sql("link_id,link_url_1,link_url_2,link_url_3,link_host_domain,link_status,link_views,link_type from gf_film_link");
		$this->home_model->Set_orderby();
		$this->home_model->Set_where("film_id='".$watch_post['row_watch']->film_id."'");
		$this->home_model->Set_limit();
		$watch_post['row_versions']=$this->home_model->latest_post();
		$this->load->view('home/home_watch',$watch_post);
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
	
	function comment_check($str)
	{
		if (strlen(trim($str))<16)
		{
			$this->form_validation->set_message('comment_check','Say something meaningful.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
}

/* End of file home.php */
/* Location: ./system/application/controllers/home.php */