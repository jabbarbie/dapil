<?php
/**
 * 
 */
class Rekapsuara extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();

	}
	function index(){
		// $id 	= (int) $id_kelurahan;
		$this->load->model('MCaleg');
		$this->load->model('MSuara');
		$this->load->model('MKelurahan');
		$this->load->model('MKecamatan');

		$data['judul']	= 'Rekapitulasi'; 
		// $data['id_kelurahan']	= $id;
		// $data['data']	= $this->MSuara->getAllSuara();
		$data['kelurahan'] = $this->MKelurahan->getallkelurahan();
		$data['kecamatan']	= $this->MKecamatan->getallkecamatan();
		// $data['tps']	= $this->MSuara->getAllTpsById($data['data']['id_suara']??0);
		// $data['tps']	= $this->MSuara->getAllTpsById(0);

		// var_dump($data['tps']);

		// echo json_encode($data['tps']);
		// echo $data['tps'][0]['no_tps'];
		
		// die();	

		// $id_dapil 		= $this->MCaleg->cariDapilByIdKelurahan($id)??0;
		// $data['caleg']	= $this->MCaleg->getAllCalegByDapil($id_dapil);
		// $data['id_dapil']	= $id_dapil;

		$this->load->view("template/header",$data);
		$this->load->view("laporan/index");
		// $this->load->view('laporan/tambah');		

		$this->load->view("template/footer",$data);
	}
}
?>