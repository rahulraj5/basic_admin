<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Common_model extends CI_Model 
{
	public function GetWhere($tab,$whr)
	{
		
		$result = $this->db->get_where($tab,$whr)->result_array();

		return $result;
	}

	public function getSingleRecordById($table,$conditions)
	{

		 $query = $this->db->get_where($table,$conditions);

		 return $query->row_array();
	}

	public function getRecordCount($table, $where_condition)
	{

		$this->db->where($where_condition);

		$query = $this->db->get($table);

		return $query->num_rows();
	}

	public function deleteRecords($table,$where_condition)
	{   
		$this->db->where($where_condition);
		return $this->db->delete($table);
	}

	public function updateData($tab,$data,$whr)
	{
		$this->db->update($tab,$data,$whr);
		//echo $this->db->last_query(); die();

		return true;
	}

	public function insertMultipleData($tab,$noti_array)
	{

		$this->db->insert_batch($tab, $noti_array);

		return true;
	}

	public function addrecord($table,$post_data)
	{
		$this->db->insert($table,$post_data);
		return $this->db->insert_id(); 
	}
}