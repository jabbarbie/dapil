<?php
/**
 * 
 */
class Kecamatan extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->model('MKecamatan');
		if($this->session->userdata('status') <= 0){ 
			redirect(base_url("login"));
		}

	}
	function index(){
		$data['judul']	= "Kecamatan";
		// $data['data']	= $this->MKecamatan->getallkecamatan();
		$data['data']		= $this->MKecamatan->getallkecamatan();
		
		$this->load->view("template/header",$data);
		$this->load->view("kecamatan/index");
		$this->load->view('kecamatan/tambah');		
		$this->load->view("template/footer",$data);

	}
	public function tambah(){
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
			$this->MKecamatan->tambah();
			// $this->session->set_flashdata('pesan', 'Berhasil ditambah');
			// redirect('caleg');
			$data['success']	= true;
		}

		echo json_encode($data);
	}
	function edit(){
		$data 	= ['success' => false, 'message' => array()];
		$this->load->library('form_validation');
		$this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required');

		if($this->form_validation->run() == false){
			foreach ($_POST as $key => $value) {
				// $data['message']['key']	= form_error($key);
				if(!empty(form_error($key))){
					$data['message'][$key]	= form_error($key);					
				};
			}	
		}else{
			$this->MKecamatan->edit();
			$data['success']	= true;
		}

		echo json_encode($data);
	}

	function hapus($id){
		$this->MKecamatan->hapus($id);
		$this->session->set_flashdata('pesan','Dihapus');
		
		redirect('kecamatan');
	}
	function carikecamatan(){
		$json 	= [];
		if(!empty($this->input->get("q"))){
			$this->db->like('name', $this->input->get("q"));
			$query = $this->db->select('id,name as text')
						->limit(10)
						->get("tags");
			$json = $query->result();
		}else{
			$query = $this->db->select('id_kecamatan as id, kecamatan as text')
						->get('tbl_kecamatan');
			$json = $query->result();
		}
		
		echo json_encode($json);
	}
	function modalkecamatan(){
		$id 	= $this->input->get('id');
		$data = $this->MKecamatan->getdetailuntukmodal($id);

		echo json_encode($data);
	}

}
?>
		

		
