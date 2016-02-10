<?php

class MY_Form_validation extends CI_Form_validation 
{

    # public function __construct($config = array())
    public function __construct()
    {
        # parent::__construct($config);
        parent::__construct();
    }

    /*
    public function error_array()
    {
        if (count($this->_error_array > 0)) {
            return $this->_error_array;
        }
    }
    */

    public function test_get_five() 
    {
        return '5';
    }

}
