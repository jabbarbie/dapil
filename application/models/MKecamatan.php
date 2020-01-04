<?php 
class MKecamatan extends CI_Model{
	function getallkecamatan(){
		if($this->session->userdata('username') != 'admin'){
			return $this->db->select('kec.id_kecamatan, kec.kecamatan')
				 ->from('tbl_kecamatan as kec')
				 ->join('tbl_kelurahan as kel','kel.id_kecamatan = kec.id_kecamatan','INNER')
				 ->join('tbl_dapilkelurahan as dapilkel','dapilkel.id_kelurahan = kel.id_kelurahan','INNER')
				 ->where('dapilkel.id_dapil',$this->session->userdata('id_dapil'))
				 ->group_by('kec.id_kecamatan')
				 ->get()
				 ->result_array();
		}
		return $this->db->get('tbl_kecamatan')->result_array();
	}
	function getKecamatanById($id){
		return $this->db->get_where('tbl_kecamatan', array('id_kecamatan' => $id))->row_array();
	}

	public function tambah(){
			$data 	= array(
						'kecamatan'	=> $this->input->post('kecamatan', true)
						
					  );
			$this->db->insert('tbl_kecamatan',$data);
	}
	public function edit(){
			$data 	= array(
						'kecamatan'	=> $this->input->post('kecamatan', true)
						
					  );
			$this->db->where('id_kecamatan', $this->input->post('id_kecamatan', true));
			$this->db->update('tbl_kecamatan',$data);
	}

	public function hapus($id){
		// $this->db->where('id_caleg',$id);
		$this->db->delete('tbl_kecamatan', array('id_kecamatan' => $id));
	}
	public function getdetailuntukmodal($id){
				return $this->db->select('kecamatan')
					->from('tbl_kecamatan')
					->where('id_kecamatan', $id)
					->get()
					->row_array();
	}
}
?>