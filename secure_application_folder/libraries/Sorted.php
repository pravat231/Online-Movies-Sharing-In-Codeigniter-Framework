<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sorted {

	var $sorted_url='';
	var $sorted='';
    
	function Sorted()
    {
		$CI =& get_instance();
		$sorted_url=$_SERVER["REQUEST_URI"];
		if(stristr($sorted_url,'page') !== FALSE)
		{
			$sorted_url=explode("/page",$sorted_url);
			$this->sorted_url=substr($sorted_url[0],1);
		}
		else
		{
			$this->sorted_url=substr($sorted_url,1);
		}
		if(stristr($this->sorted_url,'sort') !== FALSE)
		{
			$sorted_url=explode("sort",$this->sorted_url);
			$this->sorted_url=$sorted_url[0];
		}
		if($CI->uri->segment(1)=='sort')
		{
			$this->sorted=$CI->uri->segment(3);
		}
		else if($CI->uri->segment(4)=='sort')
		{
			$this->sorted=$CI->uri->segment(5);
		}
		else if($CI->uri->segment(6)=='sort')
		{
			$this->sorted=$CI->uri->segment(7);
		}
		else
		{
			$this->sorted='default';
		}
    }
	
	function get_month($month)
	{
		switch($month)
		{
			case '02':
			return 'February';
			break;
			case '03':
			return 'March';
			break;
			case '04':
			return 'April';
			break;
			case '05':
			return 'May';
			break;
			case '06':
			return 'June';
			break;
			case '07':
			return 'July';
			break;
			case '08':
			return 'August';
			break;
			case '09':
			return 'September';
			break;
			case '10':
			return 'October';
			break;
			case '11':
			return 'November';
			break;
			default:
			return 'January';
		}
	}
	
	function sorted_link()
	{
		$url=base_url().$this->sorted_url;
		$url=trim($url,"/");
		switch($this->sorted)
		{
			case 'favorites':
			$output='<li><a href="#">Favorites</a>
			<ul>
				<li><a href="'.$url.'/sort/latest"> - Latest</a>
				<li><a href="'.$url.'/sort/date"> - Date Added</a></li>				
				<li><a href="'.$url.'/sort/release"> - Release Date</a></li>
				<li><a href="'.$url.'/sort/alphabet"> - Alphabet</a></li>
				<li><a href="'.$url.'/sort/featured"> - Featured</a></li>
			</ul>
			</li>';
			return $output;	
			break;
			case 'release':
			$output='<li><a href="#">Release Date</a>
			<ul>
				<li><a href="'.$url.'/sort/latest"> - Latest</a>
				<li><a href="'.$url.'/sort/date"> - Date Added</a></li>				
				<li><a href="'.$url.'/sort/favorites"> - Favorites</a></li>
				<li><a href="'.$url.'/sort/alphabet"> - Alphabet</a></li>
				<li><a href="'.$url.'/sort/featured"> - Featured</a></li>
			</ul>
			</li>';
			return $output;	
			break;
			case 'alphabet':
			$output='<li><a href="#">Alphabet</a>
			<ul>
				<li><a href="'.$url.'/sort/latest"> - Latest</a>
				<li><a href="'.$url.'/sort/date"> - Date Added</a></li>				
				<li><a href="'.$url.'/sort/favorites"> - Favorites</a></li>
				<li><a href="'.$url.'/sort/release"> - Release Date</a></li>
				<li><a href="'.$url.'/sort/featured"> - Featured</a></li>
			</ul>
			</li>';
			return $output;	
			break;
			case 'featured':
			$output='<li><a href="#">Featured</a>
			<ul>
				<li><a href="'.$url.'/sort/latest"> - Latest</a>
				<li><a href="'.$url.'/sort/date"> - Date Added</a></li>				
				<li><a href="'.$url.'/sort/favorites"> - Favorites</a></li>
				<li><a href="'.$url.'/sort/release"> - Release Date</a></li>
				<li><a href="'.$url.'/sort/alphabet"> - Alphabet</a></li>
			</ul>
			</li>';
			return $output;	
			break;
			case 'date':
			$output='<li><a href="#">Date Added</a>
			<ul>
				<li><a href="'.$url.'/sort/latest"> - Latest</a>				
				<li><a href="'.$url.'/sort/favorites"> - Favorites</a></li>
				<li><a href="'.$url.'/sort/release"> - Release Date</a></li>
				<li><a href="'.$url.'/sort/alphabet"> - Alphabet</a></li>
				<li><a href="'.$url.'/sort/featured"> - Featured</a></li>
			</ul>
			</li>';
			return $output;	
			break;
			default:
			$output='<li><a href="#">Latest</a>
			<ul>
				<li><a href="'.$url.'/sort/date"> - Date Added</a></li>				
				<li><a href="'.$url.'/sort/favorites"> - Favorites</a></li>
				<li><a href="'.$url.'/sort/release"> - Release Date</a></li>
				<li><a href="'.$url.'/sort/alphabet"> - Alphabet</a></li>
				<li><a href="'.$url.'/sort/featured"> - Featured</a></li>
			</ul>
			</li>';
			return $output;		
		}
	}
	
	function order_by()
	{
		switch($this->sorted)
		{
			case 'favorites':
			return 'gf_film.film_id desc';
			break;
			case 'release':
			return 'film_release_date desc';
			break;
			case 'alphabet':
			return 'film_name asc';
			break;
			case 'featured':
			$CI =& get_instance();
			$CI->load->model('home_model');
			$CI->home_model->Set_where("film_feature='Y'");
			return 'gf_film.film_post_date desc';
			break;
			case 'date':
			return 'film_post_date desc';
			break;
			case 'default':
			return 'gf_film.film_modify desc';
			break;
			default:
			return 'gf_film.film_modify desc';	
		}
	}
	
	function sort_by_title()
	{
		switch($this->sorted)
		{
			case 'favorites':
			return 'Most Favourite';
			break;
			case 'release':
			return 'Newly Released';
			break;
			case 'alphabet':
			return 'A to Z';
			break;
			case 'featured':
			return 'Featured';
			break;
			case 'date':
			return 'Latest';
			break;
			case 'default':
			return 'Just Added';
			break;
			default:
			return 'Just Added';
		}	
	}
	
	function genre_name($genres)
	{
		$output='';
		if($genres!='')
		{
			if(stristr($genres,','))
			{
				$genres=explode(",",$genres);
				foreach($genres as $value)
				{
					$output.='<a href="'.base_url().'genre/'.strtolower($value).'">'.$value.'</a> ';
				}
			}
			else
			{
				$output='<a href="'.base_url().'genre/'.strtolower($genres).'">'.$genres.'</a>';		
			}
		}
        return $output;
	}
}

?>