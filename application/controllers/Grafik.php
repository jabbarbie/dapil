<?php 

/**
 * 
 */
class Grafik extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('MGrafik');
	}

	function grafik(){
		$this->load->Model('MCaleg');
		$id_dapil = $this->session->userdata('id_dapil');
		if($this->session->userdata('username') == 'admin' ){
			// $id_dapil = $this->session->userdata('id_dapil');
			$id_dapil = $this->input->post('id_dapil');
		}
		$caleg	= $this->MCaleg->getAllCalegByDapil($id_dapil);
		// foreach ($caleg as $key => $value) {
		// 	# code...
		// 	echo $value['no_urut'];
		// }
		$data 	= $this->MGrafik->grafik($caleg, $id_dapil);
		echo json_encode($data);
	}
	function index2(){
		$data['judul']		= 'Data Daerah Pemilihan';
		$data['data']		= $this->MDapil->getdapilkelurahan();
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