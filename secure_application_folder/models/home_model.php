<?php
class Home_model extends CI_Model {
	var $sql=''; 
    var $orderby='';
    var $where='';
	var $groupby='';
	var $having='';
	var $limit='';
	
	function __construct()
    {
        parent::__construct();
    }
		
	function Set_sql($sql=''){
		if($sql!='')
		$this->sql = $sql;
		else
		$this->sql = '';
	}
	
	function Set_orderby($orderby=''){
		if($orderby!='')
		$this->orderby = ' order by '.$orderby;
		else
		$this->orderby = '';
	}
	
	function Set_where($where=''){
		if($where!='')
		{
			if($this->where!=''){
				$this->where = ' WHERE '.str_replace(" WHERE ","",$this->where)." AND ".$where;
			}else{
				$this->where = ' WHERE '.$where;
			}
		}
		else
		{
			$this->where = '';
		}
	}
	
	function Set_free_where(){
		$this->where = '';
	}
	
	function Set_groupby($groupby=''){
		if($groupby!='')
		$this->groupby = ' GROUP BY '.$groupby;
		else
		$this->groupby = '';
	}
	
	function Set_having($having=''){
		if($having!='')
		$this->having = '  HAVING  '.$having;
		else
		$this->having = '';
	}
	
	function Set_limit($limit=''){
		if($limit!='')
		$this->limit = ' limit '.$limit;
		else
		$this->limit = '';
	}
	
	function latest_post()
	{
		$row=array();
		$query=$this->db->query("SELECT SQL_CALC_FOUND_ROWS ".$this->sql.$this->where.$this->groupby.$this->having.$this->orderby.$this->limit);
		if($query->num_rows()>0){
			$row=$query->result_array();
		}
		return $row;
	}
	
	function watch_post()
	{
		$row='';
		$query=$this->db->query("SELECT ".$this->sql.$this->where.$this->orderby.$this->limit);
		if($query->num_rows()>0){
			$row=$query->row();
		}
		return $row;
	}
	
	function watch_link($sql='')
	{
		$row='';
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			$row=$query->row();
		}
		return $row;
	}
	
	function count_posts()
	{
		$result=$this->db->query("SELECT FOUND_ROWS() AS posts");
		$result=$result->row_array();
		return $result['posts'];
	}
	
	function actor_name($actor_id='')
	{
		$row='';
		$query=$this->db->query("select actor_name from gf_actor where actor_id='".$actor_id."' LIMIT 1");
		if($query->num_rows()>0){
			$row=$query->row();
			$row=$row->actor_name;
		}
		return $row;
	}
	
	function director_name($director_id='')
	{
		$row='';
		$query=$this->db->query("select director_name from gf_director where director_id='".$director_id."' LIMIT 1");
		if($query->num_rows()>0){
			$row=$query->row();
			$row=$row->director_name;
		}
		return $row;
	}
	
	function genre_id($genre_name='')
	{
		$row='';
		$query=$this->db->query("select genre_id from gf_genre where genre_name='".$genre_name."' LIMIT 1");
		if($query->num_rows()>0){
			$row=$query->row();
			$row=$row->genre_id;
		}
		return $row;
	}
	
	function insert_comment($film_id='')
	{
		if(($film_id!='') && ($this->session->userdata('user_id')!=''))
		{
			$sql="insert into gf_film_comment set film_id='".$film_id."',comment_msg='".mysql_real_escape_string($this->input->post('comment_text'))."',comment_post_by='".$this->session->userdata('user_id')."'";
			if($this->db->query($sql))
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}
	}
	
	function sql_query($sql='')
	{
		if($this->db->query($sql))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		
		}
	}
	
	function retrieve_user_id($email)
	{
		$array=array('email'=>$email);
		$this->db->where($array);
		$query=$this->db->get('gf_user');
		if($query->num_rows()>0){
			$row=$query->row();
			return $row->user_id;		
		}else{
			return FALSE;
		}
	}
}