<?php defined('BASEPATH') OR exit('No direct script access allowed');

class CommonModel extends CI_Model
{
	public function getWhereData($tab,$whr)
	{
		$result = $this->db->get_where($tab,$whr)->result_array();
		//echo $this->db->last_query(); die();
		return $result;
	}

	public function getSingleData($tab,$whr)
	{
		$result = $this->db->get_where($tab,$whr)->row_array();
		return $result;
	}
	
	public function insertData($tab,$data)
	{
		$this->db->insert($tab,$data);
		$lid = $this->db->insert_id();
		return $lid;
	}

	public function insertMultiple($tab,$data)
	{
		$this->db->insert_batch($tab,$data);
		return true;
	}

	public function updateData($tab,$data,$whr)
	{
		$this->db->update($tab,$data,$whr);
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	public function getWhereDataByCol($tab,$whr,$col)
	{
		$this->db->select($col);
		$result = $this->db->get_where($tab,$whr)->row_array();
		//echo $this->db->last_query(); die();
		return $result;
	}

	public function getalldata($tab)
	{
		//$this->db->select('*');
		//$this->db->from($tab);
		$query = $this->db->select('*')->from($tab)->get();
        return $query->result_array();
		//echo $this->db->last_query(); die();
		//return $result;
	}

	public function deleteData($tab,$whr)
	{
		$this->db->delete($tab,$whr);
		return true;
	}

	public function deleteMultiple($tab,$col,$ids)
	{
		$sql = "DELETE FROM ".$tab." WHERE ".$col." IN (".$ids.")";
		$this->db->query($sql);
		return $true;
	}

	public function getWhereDataByOrder($tab,$whr,$order_name = false,$order_by = false,$col = false)
	{
		if(!empty($col))
		{
			$this->db->select($col);
		}
		
		if(!empty($order_name))
		{
			$this->db->order_by($order_name, $order_by);
		}	
		
		$result = $this->db->get_where($tab,$whr)->result_array();
		//echo $this->db->last_query();
		return $result;
	}


	
}
