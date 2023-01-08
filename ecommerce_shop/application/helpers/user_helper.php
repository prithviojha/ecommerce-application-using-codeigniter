<?php
function get_user_details($username,$password)
{
	//echo $username;
	//echo $password;
	$CI =& get_instance();
	$fetch_rec = $CI->db->get_where('ms_users',['email'=>$username,'password'=>$password]);
	//$str = $this->db->last_query();
    //echo $str;
	//die();
	if($fetch_rec->num_rows() > 0)
	{
		return $fetch_rec->result();
	}
	else
	{
		return $fetch_rec->result();
	}
}
?>