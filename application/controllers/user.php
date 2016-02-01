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

		# print_r($_POST);
		# die();

		$login = $this->input->post('login');
		$password = $this->input->post('password');

		# set user login vars: username & password hash
		$result = $this->user_model->get([
			'login' => $login,
			'password' => hash('sha256', $password . SALT)
		]);

		# print_r($result);
		# die();

		# create an output array
		$output = array();

		# always output json
		$this->output->set_content_type('application_json');


		# if there is a result...
		if ($result) {

			# ... we will set the user data
			$this->session->set_userdata([
				'user_id' => $result[0]['user_id']
			]);

			# sending back json
			# found user = success (1)
			$this->output->set_output(json_encode([
				'result' => 1
			]));

			# we found what we are looking for
			# ... so stop function
			return false;

		}

		# did not find user = fail (0)
		$this->output->set_output(json_encode([
			'result' => 0
		]));

		# print_r($result);

		# die();

		# $session = $this->session->all_userdata();
		# print_r($session);

	}




	public function register()
	{

		# print_r($_POST);
		# die();

		$login = $this->input->post('login');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$password_again = $this->input->post('password_again');

		die('not yet ready');


		# set user login vars: username & password hash
		$result = $this->user_model->get([
			'login' => $login,
			'password' => hash('sha256', $password . SALT)
		]);

		# print_r($result);
		# die();

		# create an output array
		$output = array();

		# always output json
		$this->output->set_content_type('application_json');


		# if there is a result...
		if ($result) {

			# ... we will set the user data
			$this->session->set_userdata([
				'user_id' => $result[0]['user_id']
			]);

			# sending back json
			# found user = success (1)
			$this->output->set_output(json_encode([
				'result' => 1
			]));

			# we found what we are looking for
			# ... so stop function
			return false;

		}

		# did not find user = fail (0)
		$this->output->set_output(json_encode([
			'result' => 0
		]));

		# print_r($result);

		# die();

		# $session = $this->session->all_userdata();
		# print_r($session);

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

