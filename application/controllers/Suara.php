<?php 

/**
 * 
 */
class Suara extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('MSuara');
		if($this->session->userdata('status') <= 0){ 
			redirect(base_url("login"));
		}
	}
	function getidtps(){
		// untuk json laporan tps
		$no_tps 	= $this->input->post('no_tps', 1);
		$id_suara 	= $this->input->post('id_suara', 1);

		$id_tps 		   = $this->MSuara->getidtp($id_suara, $no_tps)['id_tps'];
		echo (int)$id_tps;

	}
	function index(){
		$this->load->model('MKecamatan');

		$data['judul']		= 'Data Perolehan Suara';
		$kecamatan	= $this->MKecamatan->getallkecamatan();
		// echo die(json_encode($kecamatan));
		$data['kecamatan']	= $this->MSuara->xx($kecamatan);

		// echo die(json_encode($data['kecamatan']));

		// Untuk Model dialog
		$this->load->view('template/header',$data);
		$this->load->view('suara/index');

		$this->load->view('template/footer');
	}
	function kecamatan(int $id){
		$this->load->model('MKelurahan');
		$this->load->model('MKecamatan');

		$data['judul']		= 'Pilih Kelurahan';
		$data['kecamatan']	= $this->MKecamatan->getKecamatanById($id);
		// $data['kelurahan']	= $this->MKelurahan->getallkelurahanbyid($id);
		$data['kelurahan']	= $this->MSuara->totalsuara_kelurahan($id);
		
		// Untuk Model dialog

		$this->load->view('template/header',$data);
		$this->load->view('suara/kelurahan');

		// $this->load->view('dapil/tambah');		
		$this->load->view('template/footer');
	}
	function kelurahan($id=1){
		// die();
		$this->MSuara->hapusJikaKosong();
		$id 	= (int) $id;
		$this->load->model('MCaleg'); 
		$this->load->model('MKelurahan');

		$data['judul']	= 'Input Suara'; 
		$data['id_kelurahan']	= $id;
		$data['data']	= $this->MSuara->getAllSuaraById($id);
		$data['kelurahan'] = $this->MKelurahan->getkelurahanbyidkel($id);

		$data['tps']	= $this->MSuara->getAllTpsById($data['data']['id_suara']??0);

		// var_dump($data['tps']);
		// die();
		// echo json_encode($data['tps']);
		// echo $data['tps'][0]['no_tps'];
		

		$id_dapil 		= $this->MCaleg->cariDapilByIdKelurahan($id)??0;
		$data['caleg']	= $this->MCaleg->getAllCalegByDapil($id_dapil);
		$data['id_dapil']	= $id_dapil;

		// Untuk Model dialog
		$this->load->view('template/header',$data);
		$this->load->view('suara/tps');

		$this->load->view('suara/laporan');		
		$this->load->view('suara/tambah');		
		$this->load->view('template/footer');
	}
	function tambah(){
		// $id_suara 	= $this->input->post('id_suara');
		// $no_tps 	= $this->input->post('no_tps');
		// if ($this->tps($id_suara, $no_tps) < 0){
		// $x = $this->MSuara->tps($id_suara, $no_tps);

		if($this->input->post('jumlah_tps') > 0 OR isset($_POST['suara'])){
			// $data = ['success' => false, 'message' => 'Gagal Menambah Data'];
			// $data['message'] = $this->input->post('suara_tidaksah');

			if($this->MSuara->tambahsuara()){
				$data['success'] = true;
			}

		}
		// $data['success'] = $this->MSuara->tambahsuara();
			echo json_encode($data);
		// }

	}
	function edit(){
		$data = ['success' => false, 'message' => 'Gagal Menambah Data'];
		if($this->MSuara->ubahsuara()){
			$data['success'] = true;
		}
		echo json_encode($data);

		// echo json_encode(var_dump($this->input->post('suara')[0]));
	}
	function detailsuara(){
		$id_kelurahan = $this->input->post('id_kelurahan', 1);
		$no_tps 	= $this->input->post('no_tps', 1);
		$id_suara 	= $this->input->post('id_suara', 1);

		$this->load->model('MKelurahan');
		$data['kelurahan'] = $this->MKelurahan->getInfoKelurahan($id_kelurahan);
		$id_tps 		   = $this->MSuara->getidtp($id_suara, $no_tps)['id_tps'];

		$data['tps']	   = $this->MSuara->tpsubah($id_tps);
		echo json_encode($data);
		// echo 'sate';


		// $no_tps = $this->input->get('no_tps');
		// $id_suara = null;
		// $id_dapil = null;

	}
	function sate(){
		$maxnourut = $this->db->select_max('no_tps')->where('id_suara', 3)->get('tbl_tps')->row_array()['no_tps'];
		return $maxnourut;
	}
	function hapustps($id_tps = 0){
		if($id_tps > 0){
			$this->MSuara->hapustps($id_tps);		
		}
	}
	function hapussemuasuara($id_kelurahan){
		$id = (int) $id_kelurahan;
		$id_suara = $this->MSuara->getAllSuaraById($id)['id_suara'];
		$semuatps = $this->MSuara->gettpsbyidsuara($id_suara);
		foreach ($semuatps as $key => $value) {
			$this->MSuara->hapustps($value['id_tps']);
		}
		$this->MSuara->hapustpssuara($id_suara);
	}
}
?>