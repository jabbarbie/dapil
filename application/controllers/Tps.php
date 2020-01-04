<?php   
/**
 * 
 */
class Tps extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->model('MTps');
	}
	public function getList(){
		$data = $row = array();
		$tpsData = $this->MTps->getRows($_POST);

		$i = $_POST['start'];
		foreach ($tpsData as $r) {
			$i++;
			$data[]	= array($i, $r->id_caleg, 
								$r->nama, 
								// $r->foto,
								// $r->no_urut,
								// $r->id_dapil
								);
		}

		$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->MTps->countAll(),
				"recordsFiltered" => $this->MTps->countFiltered($_POST),
				"data" => $data,
		);

		echo json_encode($data);
	}
	public function index(){
		$data['judul']	= "Data TPS";

		$this->load->view('template/header',$data);
		$this->load->view('tps/index');
		$this->load->view('tps/tambah');

		$this->load->view('template/footer');
		if($this->session->userdata('status') <= 0){ 
			redirect(base_url("login"));
		}

	}
	public function setjumlahtps(){		
		$this->load->model('MSuara');
		$id_kelurahan = (int) $this->input->post('id_kelurahan');
		$jumlah_tps = (int) $this->input->post('jumlah_tps');

		if($jumlah_tps > 0){
			$this->MSuara->jumlahtps($id_kelurahan);
		}
		redirect('suara/kelurahan/'.$id_kelurahan);
	}
	function carisuara(){

		$this->load->model('MSuara');

		$notps = $this->input->post('notps');
		$id_suara = $this->input->post('id_suara');
		
		$id_tps 	= $this->MSuara->getidtp($id_suara, $notps)['id_tps']??0;
		// echo $notps.' = '.$id_suara.' = '.$id_tps;
		if ($id_tps <= 0){
			echo die(json_encode(0));
		}
		$pemilihan = $this->MSuara->tpsubah($id_tps);
		// echo $data;
		$data['suara']	= $pemilihan['suara'];
		$data['partai']	= $pemilihan['partai'];
		$data['tidaksah'] = $pemilihan['tidaksah'];
		$data['id_tps']	= $id_tps;
		// echo var_dump($data);
		echo json_encode($data);

	 	// tpsubah($id_tps, $no_urut){
		

		// echo $id_tps.' => no tps '.$notps;
		// echo $notps;
	}
	function table_laporan(){


		$r = $this->db->get_where('tbl_suara',array('id_suara', 1))->row_array();
		$this->load->model('MSuara');

		$data 	= array();
		$no 	= $_POST['id']??0;

		// $countx = $r['jumlah_tps'];
		$id_kelurahan = (int) $_POST['id'];
		$suara	= $this->MSuara->getAllSuaraById($id_kelurahan);
		$tps	= $this->MSuara->getAllTpsById($suara['id_suara']??0);


		for ($i=0; $i < $suara['jumlah_tps']; $i++) { 
			# code...
			$x = $tps['suara'][$i]??0;

			$no++;
			$row = array();
			$row[]	= $i+1	;
			$row[]	= (((int)$x['suara_partai'] <= 0)?'-':$x['suara_partai']); 
			$row[]	= (((int)$x['suara_tidaksah'] <= 0)?'-':$x['suara_tidaksah']); 
			$row[]	= (((int)$x['suara_sah'] <= 0)?'-':$x['suara_sah']); 			
			$data[] = $row;
			// $row[]	
		}
		// foreach ($r as $key => $value) {
		// 	$no++;
		// 	$row = array();
		// 	// $row[] = $no;
		// 	$row[] = 'TPS - '.($key+1);
		// 	$row[] = $value['no_urut'];
		// 	$row[] = $value['foto'];
		// 	$row[] = $value['no_urut'];

		// 	$data[] = $row;

		// }
		$output = array(
                        // "draw" => $_POST['draw'],
                        "recordsTotal" => 0,
                        "recordsFiltered" => 0,
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
	}

}
?>