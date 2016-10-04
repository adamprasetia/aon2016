<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta"); 
		if($this->session->userdata('user_login')==''){
			redirect('login');
		}	
	}	
}