<?php defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModel extends CI_Model
{
	public function user_login($udata)
	{
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where($udata);
		$this->db->where_in("userrole","1");
		$result = $this->db->get()->row_array();
		return $result;
	}

	public function getUserData($id)
	{
		$this->db->select("users.*");
		$this->db->from("users");
		$this->db->where("users.id",$id);
		$this->db->where("users.userrole",2);
		$result = $this->db->get()->row_array();
		return $result;
	}

    

}