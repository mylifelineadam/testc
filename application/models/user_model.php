<?php

class User_model extends CI_Model
{

	/**
	 * @usage
	 *	All: $this->user_model->get();
	 *  Single: $this->user_model->get('2);
	 */
	// 
	public function get($user_id = null)
	{
		if ($user_id === null) {
			$q = $this->db->get('user');
		} else {
			$q = $this->db->get_where('user', ['user_id' => $user_id]);
		}

		return $q->result_array();
	
	}


	public function insert()
	{

	
	}


	public function update()
	{

	
	}


	public function delete()
	{

	
	}


}