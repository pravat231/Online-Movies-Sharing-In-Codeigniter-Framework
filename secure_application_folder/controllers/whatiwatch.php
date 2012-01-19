<?php
class Whatiwatch extends CI_Controller {

	function Whatiwatch()
	{
		parent::__construct();
		$this->db->cache_off();
		$this->load->model('home_model');
	}
	
	function Index()
	{
		$post_value=$this->input->post('what_submit');
		if(isset($post_value)){
			$what_genre=$this->input->post('what_genre');
			if($what_genre==0){
				$this->home_model->Set_free_where();
				$this->home_model->Set_sql("film_id FROM gf_film");
				$this->home_model->Set_where();
				$this->home_model->Set_orderby('rand()');
				$this->home_model->Set_limit('0,1');
				$latest_post=$this->home_model->latest_post();
				$film_id=$latest_post[0]['film_id'];
			}else{
				$this->home_model->Set_free_where();
				$this->home_model->Set_sql("film_id from gf_film_genre");
				$this->home_model->Set_where("genre_id='".$what_genre."'");
				$this->home_model->Set_orderby('rand()');
				$this->home_model->Set_limit('0,1');
				$latest_post=$this->home_model->latest_post();
				$film_id=$latest_post[0]['film_id'];
			}
			if($film_id=='')
			{
				redirect(base_url());
				exit(0);
			}
			$this->home_model->Set_free_where();	
			$this->home_model->Set_sql("film_post_link from gf_film");
			$this->home_model->Set_where("film_id='".$film_id."'");
			$this->home_model->Set_orderby();
			$this->home_model->Set_limit('0,1');
			$last_post=$this->home_model->latest_post();
			if(count($last_post)>0)
			{
				$link_url=base_url().'watch/'.$last_post[0]['film_post_link'];
				redirect($link_url);
				exit(0);
			}
			else
			{
				redirect(base_url());
				exit(0);
			}
		}
		else
		{
			redirect(base_url());
			exit(0);
		}
	}
}