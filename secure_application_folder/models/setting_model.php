<?php
class Setting_model extends CI_Model {
	var $sql=''; 
    var $orderby='';
    var $where='';
	var $groupby='';
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
	
	function Set_limit($limit=''){
		if($limit!='')
		$this->limit = ' limit '.$limit;
		else
		$this->limit = '';
	}
	
	function latest_post()
	{
		$row=array();
		$query=$this->db->query("SELECT SQL_CALC_FOUND_ROWS ".$this->sql.$this->where.$this->groupby.$this->orderby.$this->limit);
		if($query->num_rows()>0){
			$row=$query->result_array();
		}
		return $row;
	}
	
	function count_posts()
	{
		$result=$this->db->query("SELECT FOUND_ROWS() AS posts");
		$result=$result->row(0,'posts');
		return $result['posts'];
	}
	
	function get_user_data($user_id)
	{
		$array=array('user_id'=>$user_id);
		$this->db->where($array);
		$query=$this->db->get('gf_user');
		if($query->num_rows()>0){
			return $query->row();	
		}else{
			return FALSE;
		}
	}
	
	function get_country_data()
	{
		$row=array();
		$query=$this->db->query("SELECT country_code,country_name FROM gf_country");
		if($query->num_rows()>0){
			$row=$query->result_array();
		}
		return $row;
	}
	
	function sql_write_query($sql='')
	{
		$this->db->query($sql);
		if($this->db->affected_rows()==0)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		
		}
	}
	
	function sql_rows($sql='')
	{
		$query=$this->db->query($sql);
		return $query->num_rows();
	}
}