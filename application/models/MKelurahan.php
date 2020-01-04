<?php 
class MKelurahan extends CI_Model{
	protected $namatable	= 'tbl_kelurahan',
			  $primaryKey	= 'id_kelurahan';

	function getallkelurahan(){
		return $this->db->get('tbl_kelurahan')->result_array();
	}
	function getallkelurahanbyid(int $id){
		return $this->db->select('*')
						->from('tbl_kelurahan')
						->where('id_kecamatan', $id)
						->get()
						->result_array();
	}
	public function tambah(){
			$data 	= array(
						'id_kecamatan'	=> $this->input->post('id_kecamatan', true),				
						'kelurahan'	=> $this->input->post('kelurahan', true),
						
					  );
			$this->db->insert('tbl_kelurahan',$data);
	}
	public function edit(){
			$data 	= array(
						'id_kecamatan'	=> $this->input->post('id_kecamatan', true),
						'kelurahan'	=> $this->input->post('kelurahan', true)
						
					  );
			$this->db->where('id_kelurahan', $this->input->post('id_kelurahan', true));
			$this->db->update('tbl_kelurahan',$data);
	}
	public function hapus($id){
		$this->db->delete($this->namatable, array($this->primaryKey => $id));
	}

	function getrelasikelurahan(){
		return $this->db->select('kel.id_kelurahan, kec.id_kecamatan, kec.kecamatan, kel.kelurahan')
						->from('tbl_kelurahan as kel')
						->join('tbl_kecamatan as kec','kel.id_kecamatan = kec.id_kecamatan','LEFT')
						// ->where('kec.id_kecamatan', 2)
						->get()
						->result_array();
	}
	function getrelasikelurahanbyid(int $id){
		return $this->db->select('kel.id_kelurahan, kec.kecamatan, kel.kelurahan')
				->from('tbl_kelurahan as kel')
				->join('tbl_kecamatan as kec','kel.id_kecamatan = kec.id_kecamatan','RIGHT')
				->get_where('tbl_kelurahan', array('kel.id_kecamatan' => $id))
				->result_array();
	}
	function test(int $id){
		// return $this->db->get_where('tbl_kelurahan', array('id_caleg' => $id))->row_array();		
	}
	function getallkelurahanbyidkecamatan($id_kecamatan){
		return $this->db->select("id_kelurahan")
					->from('tbl_kelurahan')
					->where('id_kecamatan', $id_kecamatan)
					->get()
					->result_array();
	}
	function hapusbyidkecamatan($id_kecamatan, $id_dapil = 1){
		$this->db->delete('tbl_dapilkelurahan', array('id_kecamatan' => $id_kecamatan, 'id_dapil' => $id_dapil));
	}
	function getkelurahanbyidkel($id_kelurahan){
		return $this->db->select('kel.id_kecamatan, kel.id_kelurahan, kec.kecamatan, kel.kelurahan')
						->from('tbl_kelurahan as kel')
						->join('tbl_kecamatan as kec','kel.id_kecamatan = kec.id_kecamatan','LEFT')
						->where('kel.id_kelurahan', $id_kelurahan)
						->get()
						->row_array();
	}
	public function getdetailuntukmodal($id){
				return $this->db->select('kelurahan')
					->from('tbl_kelurahan')
					->where('id_kelurahan', $id)
					->get()
					->row_array();
	}
	function getInfoKelurahan($id_kelurahan){
		return $this->db->select('kel.id_kelurahan, kec.id_kecamatan, kecamatan, kelurahan')
			 ->from('tbl_kelurahan as kel')
			 ->join('tbl_kecamatan as kec','kec.id_kecamatan = kel.id_kelurahan','INNER')
			 ->where('kel.id_kelurahan', $id_kelurahan)
			 ->get()
			 ->row_array();
	}
	function getIdDapilByIdKelurahan($id_kelurahan){
		return $this->db->get_where('tbl_dapilkelurahan', array('id_kelurahan' => $id_kelurahan))->row_array()['id_dapil'];

	}
	// function getonlyidkecamatan($id_kelurahan){
	// 	return $this->db->select('id_kecamatan')
	// 			->from('tbl_kelurahan')
	// 			->where('id_kelurahan', $id_kelurahan)
	// 			->get()
	// 			->row_array();
	// }
}
?>