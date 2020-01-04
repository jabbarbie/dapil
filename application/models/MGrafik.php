<?php 

class MGrafik extends CI_Model{


	public function sate(){
		$x = $this->db
						->select_sum('suara')
						->get_where('tbl_pemilihan', array('id_dapil' => 1, 'no_urut' => 1))
						->row_array();
		var_dump($x);
	}
	public function grafik($data_caleg, $id_dapil = 1){
		$data = [];
		$data['no_urut'] 	= [];
		$data['suara']		= [];
		$data['nama']		= [];
		foreach ($data_caleg as $key => $value) {
			$no_urut = (int) $value['no_urut'];
			// sum where id_dapil =  
			$x = $this->db
						->select_sum('suara')
						->get_where('tbl_pemilihan', array('id_dapil' => $id_dapil, 'no_urut' => $no_urut))
						->row_array();
			// $data['no_urut']	= $value['nama']??'-';
			array_push($data['no_urut'], $no_urut);
			array_push($data['nama'], $value['nama']??'-');
			array_push($data['suara'], $x['suara']??0);

			// $data[$no_urut]['suara'] = $x['suara']??0;


			// tbl_pimilihan => id_tps = tbl_tps.id_tps
			// tbl_tps		  => id_suara = tbl_suara.id_suara
			// id_kelurahan  => tbl_suara.id_kelurahan

			// sum(suara) from tbl_pemilihan
		}		
		return $data;
	}
	//
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