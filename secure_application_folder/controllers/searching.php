<?php
class Searching extends CI_Controller {

	function Searching()
	{
		parent::__construct();
		$this->load->model('home_model');
	}
	
	function Index()
	{
		$offset=(int)$this->uri->segment(3);
		if($offset<1)
		{ 
			$offset=1; 
		}
		$search_word=$this->input->xss_clean($_SERVER['REQUEST_URI']);
		if(stristr($search_word,'/?s=')!==FALSE)
		{
			$search_word=explode("/?s=",$search_word);
			$search_word=$search_word[1];
		}
		if(stristr($search_word,'searching/') || $search_word=='')
		{
			redirect(base_url());
			exit(0);
		}
		$this->load->library('sorted');
		$search_word=str_replace('+',' ',$search_word);
		if($offset==1)
		{
			$data['site_title']='Watch '.$search_word.' - Watch Movies Onlline Free';
		}
		else
		{
			$data['site_title']='Watch '.$search_word.' - Watch Movies Onlline Free - Page-'.$offset;
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
		$index_data['stage_nav']='<div class="link_nowrap">Search : '.$search_word.'</div> > <div class="link_wrap">Just Added</div>';
		$this->load->library('pagination');
		$page['per_page'] = '24';
		$page['full_tag_open'] = '<div class="pagination">';
		$page['full_tag_close'] = '</div>';
		$page['cur_tag_open'] = '<span class="current">';
		$page['cur_tag_close'] = '</span>';
		$page['rel_tag'] = 'next';
		$page['query_segment'] = '?s='.str_replace(' ','+',$search_word);
		$page['base_url'] = base_url().'searching/page/';
		//load the model and get results
		$offset=(($offset-1)*$page['per_page']);
		$this->load->library('stemmer');
		$new_search_word=array();
		if(stristr($search_word," ")!==FALSE)
		{
			$split_string=explode(" ",$search_word);
			foreach($split_string as $new_split_string){
				array_push($new_search_word,$this->stemmer->stem($new_split_string));
			}
		}
		else
		{
			array_push($new_search_word,$this->stemmer->stem($search_word));
		}
		$new_search_word=array_unique($new_search_word);
		$against1='';
		$against2='';
		if(count($new_search_word)>0)
		{
			foreach($new_search_word AS $new_search_word_arr)
			{
				$against1.=$new_search_word_arr.' ';
				$against2.='+'.$new_search_word_arr.' ';
			}
		}
		else
		{
			redirect(base_url());
			exit(0);
		}
		$against1=trim($against1);
		$against2=trim($against2);
		$this->home_model->Set_free_where();
		$this->home_model->Set_sql("MATCH(film_name) AGAINST ('".$against1."') as Relevance,gf_film.film_id,film_name,DATE_FORMAT(film_release_date,'%d') AS DATE,DATE_FORMAT(film_release_date,'%m') AS month_ori,DATE_FORMAT(film_release_date,'%M') AS MONTH,DATE_FORMAT(film_release_date,'%Y') AS YEAR,film_release_date,film_feature,film_modify,film_post_link,website_poster_url,film_genre_value AS genres FROM gf_film");
		$this->home_model->Set_where("MATCH(film_name) AGAINST('".$against2."' IN BOOLEAN MODE)");
		$this->home_model->Set_groupby('gf_film.film_id');
		$this->home_model->Set_having('Relevance > 0.2');
		$this->home_model->Set_orderby('Relevance DESC');
		$this->home_model->Set_limit($offset.",".$page['per_page']);
		$index_data['latest_post']=$this->home_model->latest_post();
		if(count($index_data['latest_post'])==0)
		{
			$sql_where="(";
			foreach($new_search_word AS $new_search_word_arr)
			{
				$sql_where.="(film_name LIKE '%".$new_search_word_arr."%') OR ";			
			}
			$new_sql_where=trim($sql_where," OR ");
			$sql_where=$new_sql_where.")";
			if($sql_where=='()')
			{
				$sql_where="film_name LIKE ''";
			}
			$this->home_model->Set_free_where();
			$this->home_model->Set_sql("gf_film.film_id,film_name,DATE_FORMAT(film_release_date,'%d') AS DATE,DATE_FORMAT(film_release_date,'%m') AS month_ori,DATE_FORMAT(film_release_date,'%M') AS MONTH,DATE_FORMAT(film_release_date,'%Y') AS YEAR,film_release_date,film_feature,film_modify,film_post_link,website_poster_url FROM gf_film");
			$this->home_model->Set_where($sql_where);
			$this->home_model->Set_groupby();
			$this->home_model->Set_having('');
			$this->home_model->Set_orderby('film_modify DESC');
			$this->home_model->Set_limit($offset.",".$page['per_page']);
			$index_data['latest_post']=$this->home_model->latest_post();		
		}
		//echo $this->db->last_query();		
		$page['cur_page'] = $offset;
		$page['total_rows']=$this->home_model->count_posts();
		$this->pagination->initialize($page);
		$index_data['sort_url']='';
		$this->load->view('home/search_index',$index_data);
		$this->home_model->Set_free_where();	
		$this->home_model->Set_sql("genre_id,genre_name from gf_genre");
		$this->home_model->Set_groupby('');
		$this->home_model->Set_having('');
		$this->home_model->Set_orderby('genre_name');
		$sidebar['watch_category']=$this->home_model->latest_post();
		$this->load->view('sidebar',$sidebar);			
		$this->load->view('footer');
	}
}