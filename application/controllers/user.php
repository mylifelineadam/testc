<?php

class User extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
	}

	public function login()
	{

		$login = $this->input->post('login');
		$password = $this->input->post('password');

		$result = $this->user_model->get([
			'login' => $login,
			'password' => $password
		]);

		print_r($result);

		die();

		$this->session->set_userdata([
			'user_id' => 1
		]);

		$session = $this->session->all_userdata();
		print_r($session);

	}

	public function test_get()
	{
		$data = $this->user_model->get(1);
		print_r($data);

		$this->output->enable_profiler(true);
	}

	public function test_insert()
	{
		$result = $this->user_model->insert([
			'login' => 'batman'
		]);
		print_r($result);
	}

	public function test_update()
	{
		$result = $this->user_model->update([
			'login' => 'wolverine'
		], 3);
		print_r($result);
	}

	public function test_delete()
	{
		$result = $this->user_model->delete(8);
		print_r($result);
	}

}

