<?php  
class Caleg extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('MCaleg');
		
		if($this->session->userdata('status') <= 0){ 
			redirect(base_url("login"));
		}
		
	}
	public function simpan2(){
		try{
			$this->db->trans_start(FALSE);
			$kecamatan = $this->input->post('kecamatan');
			$data = array('kecamatan' => $kecamatan);
			
			if($this->db->insert('tbl_kecamatan', $data)){
				echo "Sukses";
			}else{
				$error = array(['code' => 123, 'pesan' => 'cant access']); 
				return $this->output
        					->set_content_type('application/json')
					        ->set_status_header(400) // Return status
		        			->set_output(json_encode($error));

				// echo "Hey Kamu Gagal <br /> ";
				// echo "Baris Kode ".$this->db->error()['code'].'<br />';
				// echo "Pesannya ".$this->db->error()['message'];
		        // $this->load->view('errors/html/error_db.php', $data);
			}
		}catch(Exception $e){
			echo "Error";
		}
	}
	public function test(){
		echo "<form action=".base_url()."caleg/simpan2 method=post>
				<input name=kecamatan type=text>
				<input type=submit >
			  </form>
			";
	}
	public function index(){
		$data['judul']		= 'Data Calon Legislatif';
		$data['caleg']		= $this->MCaleg->getallcaleg();

		// ambil data dapil
		$this->load->Model('MDapil');
		$data['dapil']		= $this->MDapil->getalldapil();

		//$this->load->library('form_validation');

		$this->load->view('template/header',$data);
		$this->load->view('caleg/index');
		$this->load->view('caleg/tambah');
		// $this->load->view('caleg/ubah');

		$this->load->view('template/footer');

	}
	public function tambah(){

		$data 	= ['success' => $this->input->post('nama'), 'message' => array()];
		// echo json_encode($data);
		$this->load->library('form_validation');

		// echo json_encode($data);

		// $data['judul']	= "Form Tambah - Data Caleg";
	
		$this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');

		if($this->form_validation->run() ==  FALSE){
			// jika gagal
			foreach ($_POST as $key => $value) {
				// $data['message']['key']	= form_error($key);
				if(!empty(form_error($key))){
					$data['message'][$key]	= form_error($key);					
				};


			}	
		}else{
			$this->MCaleg->tambah();
			// $this->session->set_flashdata('pesan', 'Berhasil ditambah');
			// redirect('caleg');
			$data['success']	= true;
		}

		echo json_encode($data);

	}

	public function hapus($id){
		$this->MCaleg->hapus($id);
		$this->session->set_flashdata('pesan','Dihapus');
		
		redirect('caleg');
	}

	public function detail($id){
		$data['judul']		= 'Detail Data Caleg';
		$data['caleg']		= $this->MCaleg->getdetail($id);

		$this->load->view('template/header',$data);
		$this->load->view('caleg/detail',$data);

		$this->load->view('template/footer');
	}

	public function ubah($id){
		$data['judul']	= "Form Ubah - Data Caleg";
		$this->load->library('form_validation');

		$data['caleg']	= $this->MCaleg->getdetail($id);
		$this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
		$this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('no_hp', 'Nomor Handphone', 'required');
		
		if($this->form_validation->run() ==  FALSE){
			$this->load->view('template/header',$data);
			$this->load->view('caleg/ubah',$data);
			$this->load->view('template/footer');			
		}else{
			$this->MCaleg->ubah();
			$this->session->set_flashdata('pesan', 'Berhasil diubah');
			redirect('caleg');
		}

	}


	// public function caricaleg(){
	// 	$nama = $this->input->post('notps');
	// 	// echo json_decode($nama);
	// }
	public function upload_foto(){
		$this->load->helper('string');

		$data 	= ['success' => $this->input->post('nama'), 'message' => array()];

		$config['upload_path']		= './assets/images/foto_caleg';
		$config['allowed_types']	= 'gif|jpg|png';
		$config['file_name']		= random_string('alnum',7);
		// $config['encrypt_name']		= TRUE;


		$this->load->library('upload', $config);



		if ($this->upload->do_upload("file")){
			// $data['success']	= 'ada 2';
			// echo json_encode($data);

			$data	= array('upload_data'	=> $this->upload->data());

			$data['nama']	= $this->input->post('nama');
			$data['image']	= $data['upload_data']['file_name'];

			$result = $this->MCaleg->simpan_upload($data);
			echo json_decode($result);
		}
		else{
			$data['success']	= $this->upload->display_errors();
			echo json_encode($data);
			// die();
		}
	}
	function modalcaleg(){
		$id 	= $this->input->get('id');
		$data = $this->MCaleg->getdetailuntukmodal($id);

		echo json_encode($data);
	}

}

?>