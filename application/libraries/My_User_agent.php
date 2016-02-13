<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_User_agent extends CI_User_agent {

    public function __construct($config = array())
    {
        parent::__construct($config);
    }

    public function find_device_category()
    {
    	$temp_device_category = 0;

	    $detect = new Mobile_Detect();
	    if ( $detect->isTablet() ) {

    		$temp_device_category = 3; # Tablet

	    } elseif ( $detect->isMobile() ) {
	        
    		$temp_device_category = 2; # Tablet

    	} else {
    		
    		$temp_device_category = 1; # Desktop
    	}

    	return $temp_device_category;

    }


}