<?php 
class Dashboard extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('status') <= 0){ 
			redirect(base_url("login"));
		}
	}
	public function index(){
		$this->load->Model('MCaleg');
		$this->load->Model('MDapil');

		$data['caleg']	= $this->MCaleg->getAllCalegByDapil($this->session->userdata('id_dapil'));
		// $data['id_dapil']	= $this->session->userdata('id_dapil');
		$data['judul']	= ' Halaman Dashboard '.$this->session->userdata('id_dapil');
		$data['jumlah_dapil'] = 3;
		
		$this->load->view('template/header', $data);
    	if ($this->session->userdata('username') != 'admin'){
			$this->load->view('dashboard/index');
		}else{
			$this->load->view('dashboard/admin');			
		}
		
		$this->load->view('template/footer');
	}
}
?>