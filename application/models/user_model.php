<?php

class User_model extends CI_Model
{

	/**
	 * @usage
	 *	All: $this->user_model->get();
	 *  Single: $this->user_model->get(2);
	 */
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

	/**
	 *
	 * @usage
	 *  $result = $this->user_model->update([ 'login' => 'peggy' ], 3);
	 */
	public function update($data, $user_id)
	{
		$this->db->where(['user_id' => $user_id]);
		$this->db->update('user', $data);
		
		# returns a count of rows affected
		return $this->db->affected_rows();
	}

	/**
	 *
	 * @usage
	 *  $result = $this->user_model->delete(6);
	 */
	public function delete($user_id)
	{
		$this->db->delete('user', ['user_id' => $user_id]);
		return $this->db->affected_rows();
	}


}