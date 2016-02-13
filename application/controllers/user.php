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

	# new user registration
	public function register()
	{

		# always output json
		$this->output->set_content_type('application_json');

		# print_r($_POST);
		# die();

		$this->form_validation->set_rules('first_name', 'First Name', 'required|min_length[2]|max_length[30]');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required|min_length[2]|max_length[30]');
		$this->form_validation->set_rules('login', 'Login', 'required|min_length[6]|max_length[16]|is_unique[user.login]');
		$this->form_validation->set_rules('city', 'City', 'exact_length[0]');
		$this->form_validation->set_rules('email', 'Email', 'required|min_length[6]|valid_email|is_unique[user.email]|matches[email_again]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|matches[password_again]');

		# set custom error messages
		/*
		$this->form_validation->set_message('required', '');
		$this->form_validation->set_message('min_length', '');
		$this->form_validation->set_message('max_length', '');
		$this->form_validation->set_message('valid_email', '');
		$this->form_validation->set_message('is_unique', '');
		$this->form_validation->set_message('matches', '');
		*/

		# echo $this->form_validation->test_get_five();
		# die(' it ends tonight! ');

		# if validation found errors then...
		if ($this->form_validation->run() == FALSE ) {

			# show validation errors
			# echo validation_errors();

			# set result to "0" and send back validation errors
            $this->output->set_output(json_encode([ 'result' => 0, 'error' => $this->form_validation->error_array() ]));

			# die("here i am user.php");

			# exit out of function
			return false;
		}

		die('stop here 0');

		$login = trim( $this->input->post('login') );
		$first_name = trim( $this->input->post('first_name') );
		$last_name = trim( $this->input->post('last_name') );
		$email = trim( strtolower( $this->input->post('email') ) );
		$password = trim( $this->input->post('password') );
		
		$register_user_agent = $this->agent->agent_string();
		# $register_device_category = $this->agent->find_device_category();
		$register_device_category = '';
		$register_platform = $this->agent->platform();
		$register_referrer = $this->agent->referrer();
		$register_domain = $_SERVER['HTTP_HOST'];

		die('stop here a');

		$ip_address = $this->input->ip_address();
		$geoip_a = '';
		$register_country_code = '';
		$register_region = '';
		$register_city = '';
		$register_zip = '';
		$register_lat = '';
		$register_lng = '';
		$register_dma_code = '';
		$register_area_code = '';

		die('stop here b');

		# if there's an ip address
		if ($ip_address) {
			
			# pull geo data based on ip address
			
			# method 1: require geo library
			# reference: http://php.net/manual/en/book.geoip.php
			# $geoip_a = geoip_record_by_name($ip_address);

			# method 3: simple offsite pull
			# reference: http://stackoverflow.com/questions/21306088/getting-geolocation-from-ip-address
			# untested

			# method 3: simple offsite json data pull
			# reference: http://stackoverflow.com/questions/409999/getting-the-location-from-an-ip-address
			# note: service limit = 10,000 requests per hour
			$geoip_json = file_get_contents('http://freegeoip.net/json/'.$ip_address);

			$geoip_a = json_decode($geoip_json, true);
			
			# if geo pull is a valid array
			if ( 
				is_array($geoip_a) && 
				array_key_exists('latitude',$geoip_a) &&
				($geoip_a['latitude'] != "") && 
				array_key_exists('longitude',$geoip_a) &&
				($geoip_a['longitude'] != "") ) 
			{

				$register_country_code = $geoip_a['country_code']; # 2 characters
				$register_region = $geoip_a['region'];
				$register_city = $geoip_a['city'];
				$register_zip = $geoip_a['zip'];
				$register_lat = $geoip_a['latitude'];
				$register_lng = $geoip_a['longitude'];
				$register_dma_code = $geoip_a['dma_code'];
				$register_area_code = $geoip_a['area_code'];

			}
		}

		$user_id = $this->user_model->insert([
			'login' => $login,
			'first_name' => $first_name,
			'last_name' => $last_name,
			'email' => $email,
			'password' => hash('sha256', $password . SALT),
			
			'register_user_agent' => $register_user_agent,
			'register_device_category' => $register_device_category,
			'register_platform' => $register_platform,
			'register_referrer' => $register_referrer,
			'register_domain' => $register_domain,

			'register_ip' => $ip_address,			
			'register_geoip_a' => $geoip_a,
			'register_country_code' => $register_country_code,
			'register_region' => $register_region,
			'register_city' => $register_city,
			'register_zip' => $register_zip,
			'register_lat' => $register_lat,
			'register_lng' => $register_lng,
			'register_dma_code' => $register_dma_code,
			'register_area_code' => $register_area_code
		
		]);

		echo $user_id;

		die('not yet ready');

		# print_r($result);
		# die();

		# create an output array
		$output = array();

		# if there is a result...
		if ($user_id) {

			# ... we will set the user data
			$this->session->set_userdata([
				'user_id' => $result[0]['user_id']
			]);

			# sending back json
			# found user = success (1)
			$this->output->set_output(json_encode(['result' => 1]));

			# we found what we are looking for
			# ... so stop function
			return false;

		}

		# did not find user = fail (0)
		$this->output->set_output(json_encode( ['result' => 0, 'error' => 'User not created.'] ));
		return false;

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

