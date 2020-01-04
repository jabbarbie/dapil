<?php
/**
 * 
 */
class Kelurahan extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->model('MKelurahan');
		if($this->session->userdata('status') <= 0){ 
			redirect(base_url("login"));
		}

	}
	function index(){
		$this->load->model('MKecamatan');
		$data['kecamatan']	= $this->MKecamatan->getallkecamatan();
		
		$data['judul']	= "Kelurahan";
		// $data['data']	= $this->MKelurahan->getallKelurahan();
		$data['data']		= $this->MKelurahan->getrelasikelurahan();
		
		$this->load->view("template/header",$data);
		$this->load->view("kelurahan/index");
		$this->load->view('kelurahan/tambah');		

		$this->load->view("template/footer",$data);

	}
	public function tambah(){
		$data 	= ['success' => false, 'message' => array()];
		
		$this->load->library('form_validation');

		// $data['judul']	= "Form Tambah - Data Caleg";
		$this->form_validation->set_rules('kelurahan', 'Nama Kelurahan', 'required');
	
		// echo die('gagal');
		
		if($this->form_validation->run() ==  FALSE){

			foreach ($_POST as $key => $value) {
				// $data['message']['key']	= form_error($key);
				if(!empty(form_error($key))){
					$data['message'][$key]	= form_error($key);					
				};

		}	
		}else{
			$this->MKelurahan->tambah();
			// $this->session->set_flashdata('pesan', 'Berhasil ditambah');
			// redirect('caleg');
			$data['success']	= true;
		}

		echo json_encode($data);
	}

	public function hapus($id){
		$this->MKelurahan->hapus($id);
		// $this->session->set_flashdata('pesan','Dihapus');
		
		redirect('kelurahan');
	}
	function edit(){
		$data 	= ['success' => false, 'message' => array()];
		$this->load->library('form_validation');
		$this->form_validation->set_rules('kelurahan', 'Kelurahan', 'required');
		$this->form_validation->set_rules('id_kecamatan', 'Kecamatan', 'required');

		if($this->form_validation->run() == false){
			foreach ($_POST as $key => $value) {
				// $data['message']['key']	= form_error($key);
				if(!empty(form_error($key))){
					$data['message'][$key]	= form_error($key);					
				};
			}	
		}else{
			$this->MKelurahan->edit();
			$data['success']	= true;
		}

		echo json_encode($data);
	}
	function carikelurahan($id_kecamatan = ""){
		$json 	= [];
		if(!empty($this->input->get("q"))){
			$this->db->like('kelurahan', $this->input->get("q"));
			$query = $this->db->select('kel.id_kelurahan as id, kel.kelurahan as text')
						->from("tbl_kelurahan as kel")
						->join('tbl_dapilkelurahan as dapkel','kel.id_kelurahan = dapkel.id_kelurahan','INNER')
						->limit(10)
						->get();
			$json = $query->result();
		}else{

			$query = $this->db->select('kel.id_kelurahan as id, kel.kelurahan as text, kel.id_kecamatan')
						->from("tbl_kelurahan as kel")
						->join('tbl_dapilkelurahan as dapkel','kel.id_kelurahan = dapkel.id_kelurahan','INNER')
						// ->limit(10)
						->where('kel.id_kecamatan', $id_kecamatan)
						->where('dapkel.id_dapil', $this->session->userdata('id_dapil'))
						->get();
			$json = $query->result();
		}
		// $json[$query->num_rows()]	= ["id" => "8", "text" => "Pilih Semua Kabupaten", "id_kecamatan" => $id_kecamatan];

		// $json["length"]	= $query->num_rows()+1;
		echo json_encode($json);
	}
	function modalkelurahan(){
		$id   = $this->input->get('id');
		$data = $this->MKelurahan->getkelurahanbyidkel($id);

		echo json_encode($data);
	}
	

}
?>
		

		
