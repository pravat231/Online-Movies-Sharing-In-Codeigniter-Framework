<?php
class User_model extends CI_Model {

	function __construct()
    {
        parent::__construct();
    }
	
	function check_authenticate($value='',$type='')
	{
		if($type=='uname'){
			$sql="select username from gf_user where username='".$value."'";
		}else{
			$sql="select email from gf_user where email='".$value."'";
		}
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	function update_reset_password($user_id,$reset_password)
	{
		if($this->db->query("UPDATE gf_user SET reset_password_code='".$reset_password."',reset_password_code_until=TIMESTAMPADD(DAY,1,now()) WHERE user_id='".$user_id."'"))
		{
			return TRUE;		
		}
		else
		{
			return FALSE;
		}
	}
	
	function check_reset_password_code($reset_password_code)
	{
		$query=$this->db->query("SELECT * FROM gf_user WHERE reset_password_code LIKE BINARY '".$reset_password_code."'");	
		if($query->num_rows()>0){
			$row=$query->row();
			if(strtotime($row->reset_password_code_until) > strtotime(date('Y-m-d H:i:s',time()))){
				return TRUE;
			}else{
				return 'Expired';
			}					
		}else{
			return FALSE;
		}	
	}
	
	function change_password($password,$reset_password_code)
	{
		if($this->db->query("UPDATE gf_user SET password='".$password."',reset_password_code=NULL,reset_password_code_until=NULL WHERE reset_password_code LIKE BINARY '".$reset_password_code."'"))
		{
			return TRUE;
		}
		else 
		{
			return FALSE;		
		}	
	}
}