<?php
class Genres extends CI_Controller {

	function Genres()
	{
		parent::__construct();
		$this->load->model('home_model');
		$this->output->cache(240);
	}
	
	function Index()
	{
		$data['site_title']='Watch movies by genre - Just Added';
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
		$this->home_model->Set_free_where();	
		$this->home_model->Set_sql("genre_name,count(gf_film_genre.film_id) as no_of_count from gf_genre left join gf_film_genre on gf_genre.genre_id=gf_film_genre.genre_id group by gf_film_genre.genre_id");
		$this->home_model->Set_orderby('genre_name');
		$this->home_model->Set_limit();
		$genres['genres_all']=$this->home_model->latest_post();
		$this->load->view('home/home_genres_all',$genres);
		$this->db->cache_on();
		$this->home_model->Set_free_where();
		$this->home_model->Set_sql("genre_id,genre_name from gf_genre");
		$this->home_model->Set_where();
		$this->home_model->Set_groupby();
		$this->home_model->Set_orderby('genre_name');
		$this->home_model->Set_limit();
		$sidebar['watch_category']=$this->home_model->latest_post();
		$this->db->cache_off();
		$this->load->view('sidebar',$sidebar);
		$this->load->view('footer');
	}
}