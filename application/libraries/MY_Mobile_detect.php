<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Mobile_detect
{
	public function __construct()
	{
		require_once APPPATH.'third_party/mobile_detect/Mobile_Detect.php';
	}

    public function find_device_category()
    {
    	$temp_device_category = 0;

	    $detect = $this->my_mobile_detect->Mobile_Detect();
	    
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
