<?php
/**
 * 
 */
class Admin extends CI_Controller
{
	
	function __construct(argument)
	{
		parent::__construct();
		# code...
		if ($this->session->userdata('status') != 'login') {
			redirect(base_url('login'));
		}
	}
	function index(){
		$this->load->view('dashboard');
	}
}
?>