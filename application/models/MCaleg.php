<?php 

class MCaleg extends CI_Model{

	public function getallcaleg(){
		return $this->db->get('tbl_caleg')->result_array();
	}
	public function tambah(){
			$data 	= array(
						'nama'	=> $this->input->post('nama', true)
						
					  );
			$this->db->insert('tbl_caleg',$data);
	}

	public function hapus($id){
		// $this->db->where('id_caleg',$id);
		$this->db->delete('tbl_caleg', array('id_caleg' => $id));
	}

	public function getdetail($id){
		return $this->db->get_where('tbl_caleg', array('id_caleg' => $id))->row_array();
	}
	public function getdetailuntukmodal($id){
				return $this->db->select('nama, no_urut')
					->from('tbl_caleg')
					->where('id_caleg', $id)
					->get()
					->row_array();
	}
	
	public function ubah(){
		$data 	= array(
					'nama'	=> $this->input->post('nama', true),
					'jk'	=> $this->input->post('jk', true),
					'no_hp'	=> $this->input->post('no_hp', true)
					
				  );
		$this->db->where('id_caleg',$this->input->post('id'));
		$this->db->update('tbl_caleg',$data);
	}

	public function simpan_upload(array $d){
		$data 	= array(
					'nama'		=> $d['nama'],
					'foto'		=> $d['image'],
					'id_dapil'	=> $this->input->post('id_dapil'),
					'no_urut'	=> $this->input->post('no_urut')
					
				  );
		return $this->db->insert('tbl_caleg',$data);
	}
	//
	public function getAllCalegByDapil(int $id){
		return $this->db->get_where('tbl_caleg', array('id_dapil' => $id))->result_array();
	}
	public function cariDapilByIdKelurahan($id_kelurahan){
		return $this->db->select('*')
					->from('tbl_dapilkelurahan')
					->where('id_kelurahan', $id_kelurahan)
					->get()
					->row_array()['id_dapil'];
	}
}
?>