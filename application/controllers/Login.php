<?php
/**
 * 
 */
class Login extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('MLogin');

	}
	function index(){
		if( (int) $this->session->userdata('status') > 0){ 
			redirect(base_url("dashboard"));
		}
		// echo $this->session->userdata('status');
		// die();
		$this->load->view('login/index');
	}
	function ceklogin(){
		$username 	= $this->input->post('username', 1);
		$pass 		= $this->input->post('pass', 1);
		$kondisi 	= array('username' => $username, 
							'pass' => md5($pass)
						);

		$cek 		= $this->MLogin->cek_login($kondisi)->num_rows();
		if($cek > 0){
			$data 	   = $this->MLogin->cek_login($kondisi)->row_array();
			$data_user = array(
						'username' 	=> $username,
						'id_dapil'	=> $data['id_dapil'],
						'status'	=> 1
					);
			$this->session->set_userdata($data_user);
			redirect(base_url());
			// echo "berhasil".$username.$this->session->userdata('username');
		}else{
			echo "Login Gagal - Periksan Username & Password";
		}
	}
	function logout(){

		// $this->session->set_userdata('status', 0);
		$this->session->sess_destroy();
		// echo $this->session->userdata('status');
		redirect(base_url().'login');
	}
}
?>