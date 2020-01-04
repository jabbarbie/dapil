<?php 

/**
 * 
 */
class Dapil extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('MDapil');

		if($this->session->userdata('status') <= 0){ 
			redirect(base_url("login"));
		}
		
	}
	function index(){
		$data['judul']		= 'Data Daerah Pemilihan';
		$data['data']		= $this->MDapil->getdapilkelurahan();
		$data['warna']		= array('purple','Navy');
		// $data['test']		= $this->MDapil->getdapilkelurahanrelasi(1);
		// $data['data']		= $this->MDapil->getdapilkelurahan();

		// var_dump($data['test']);
		// echo '<pre>',var_dump($data['data'][1]),'</pre>';
		// die();
		$this->load->view('template/header',$data);
		$this->load->view('dapil/index');

		$this->load->view('dapil/tambah');		
		$this->load->view('template/footer');
	}
	public function tambah(){		
		$data 	= ['success' => false, 'message' => array()];

		$this->load->library('form_validation');	
		$this->form_validation->set_rules('id_dapil', 'Dapil', 'required|integer');

		// echo die('gagal');
		
		if($this->form_validation->run() ==  FALSE){

			foreach ($_POST as $key => $value) {
				// $data['message']['key']	= form_error($key);
				if(!empty(form_error($key))){
					$data['message'][$key]	= form_error($key);					
				};
			}	
		}else{
			if($this->MDapil->cekid($this->input->post('id_dapil')) <= 0){
				$this->MDapil->tambah();
				$data['success']	= true;
			}else{
				$data['success']	= false;
				$data['message']	= "Nomor Dapil Sudah Ada";
			}
			// $this->session->set_flashdata('pesan', 'Berhasil ditambah');
			// redirect('caleg');
		}

		echo json_encode($data);
	}
	function detail(int $id){
		$data['judul']		= 'Detail - Data Daerah Pemilihan';
		$data['data']		= $this->MDapil->getdapilkelurahanrelasi($id);
		$data['id_dapil']	= $id;

		// print_r($data['data']);
		// die();
		$this->load->view('template/header',$data);
		$this->load->view('dapil/detail');
		$this->load->view('dapil/tambah_kelurahan');

		$this->load->view('template/footer');
	}
	function hapuskelurahan($id, $id_dapil){
		$this->MDapil->hapuskelurahan($id);
		$this->session->set_flashdata('pesan','Dihapus');
		
		// echo $id.' - '.$id_dapil;
		redirect('dapil/detail/'.$id_dapil);
	}
	function tambahkelurahan(){
		$data 	= ['success' => false, 'message' => array()];
		
		$this->load->library('form_validation');

		// $data['judul']	= "Form Tambah - Data Caleg";
		$this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required');
	
		// echo die('gagal');
		
		if($this->form_validation->run() ==  FALSE){

			foreach ($_POST as $key => $value) {
				// $data['message']['key']	= form_error($key);
				if(!empty(form_error($key))){
					$data['message'][$key]	= form_error($key);					
				};

		}	
		}else{
			$this->MDapil->tambahkelurahan();
			// $this->session->set_flashdata('pesan', 'Berhasil ditambah');
			// redirect('caleg');
			$data['success']	= true;
		}

		echo json_encode($data);
	}

	// fungsi di bawah hapus semua aja 
	function test(){
		$this->load->model('MKelurahan');
		$x = $this->MKelurahan->getallkelurahanbyidkecamatan(1);
		print_r($x);
	}
	function hapusx($id1, $id2){
		$this->load->model('MKelurahan');
		$this->MKelurahan->hapusbyidkecamatan($id1, $id2);
		
	}
}
?>