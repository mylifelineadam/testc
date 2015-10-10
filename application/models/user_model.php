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

	/**
	 * @param array $data
	 * @usage
	 *  $result = $this->user_model->insert([ 'login' => 'jethro' ]);
	 */
	public function insert($data)
	{
		$this->db->insert('user', $data);
		return $this->db->insert_id();
	}


	public function update()
	{

	
	}


	public function delete()
	{

	
	}


}