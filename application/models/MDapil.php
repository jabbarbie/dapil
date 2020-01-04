<?php 
class MDapil extends CI_Model{
	function getalldapil(){
		return $this->db->get('tbl_dapil')->result_array();
	}
	function getdapilkelurahanrelasi($id_dapil){
		$data	= $this->db
				->group_by('kel.id_kelurahan')
				->select('dapil_kel.id_dapilkelurahan, dapil_kel.id_kelurahan, dapil_kel.id_dapil,
						kel.id_kelurahan, kel.kelurahan, kec.id_kecamatan, kec.kecamatan')

				->from('tbl_dapilkelurahan as dapil_kel')
				
				->join('tbl_kelurahan as kel','kel.id_kelurahan = dapil_kel.id_kelurahan','INNER')
				->join('tbl_kecamatan as kec','kec.id_kecamatan = kel.id_kecamatan', 'INNER')
				->get_where('tbl_dapilkelurahan', array('dapil_kel.id_dapil' => $id_dapil))
				->result_array();
		return $data;
	}
	function cekid($id_dapil){
		return $this->db->get_where('tbl_dapil', array('id_dapil' => $id_dapil))->num_rows();

	}
	public function tambah(){
			$data 	= array(
						'id_dapil'	=> $this->input->post('id_dapil', true)
						// 'dapil'	=> $this->input->post('id_dapil', true)
						
					  );
			$this->db->insert('tbl_dapil',$data);
	}
	function getdapilkelurahan(){
		// pencarian manual 
		// $dapil['id_dapil']['kecamatan']	= ['sabangau','bukit tunggal','apa gitu']; 
		// $dapil['id_dapil']['kelurahan']	= ['sapan','rajawali','apa gitu']; 
		$this->load->model('MKecamatan');

		$dapil 	= $this->getalldapil();
		// return $dapil[0]['id_dapil'];
		$data 	= array();
		// $data['id_dapil']['kecamatan'] = array();
							// ,'kecamatan' => array('id_kecamatan','kecamatan')
							// ,'kelurahan' => array('id_kelurahan','kelurahan')
				  
		foreach ($dapil as $keysatu => $valuesatu) {
			$kec 	= array();
			$datao 	= $this->getdapilkelurahanrelasi($valuesatu['id_dapil']);
			// array_push($data['id_dapil'], $valuesatu['dapil']);
			// array_push($data['id_dapil']['kecamatan'], 1);
			$id_dapil = $valuesatu['id_dapil'];
			$data[$id_dapil] = array(
											'id_dapil'	=> (int)$valuesatu['id_dapil'],
											'dapil'		=>  $valuesatu['dapil'],
											
											'kec_kel'	=> array(),
											'kecamatan'	=> array()
											);
			// $data['id_dapil'][1]	= ['kecamatan' => ['idsate','kambing'], 'kelurahan' => ['sip','oke']]; 
			// $data['id_dapil'][2]	= ['kecamatan' => ['idsate','kambing'], 'kelurahan' => ['sip2','oke2']]; 
			// $data['id_dapil'][3]	= ['kecamatan' => ['idsate','kambing'], 'kelurahan' => ['sip3','oke3']]; 

			foreach ($datao as $keydua => $valuedua) {
				# code...
				// $data['id_dapil'][1] = 'sate';

				$kecx 	= $valuedua['kecamatan'];
				// if(in_array($data[$id_dapil]['kec_kel']['kecamatan'][$keydua], 'JEKAN RAYA')){
				// 	$kec 	= 'sate';
				// }
				$data[$id_dapil]['kec_kel'][]	= array(['id_kelurahan' => $valuedua['id_kelurahan'],
														 'kelurahan' 	=> $valuedua['kelurahan'],
														 'id_kecamatan'	=> $valuedua['id_kecamatan']
														]);

				// array_push($kec, $kecx);
				$kec[$valuedua['id_kecamatan']]	= $kecx;
			} // end foreach
			// array_unique($kec);

			$data[$id_dapil]['kecamatan']	= $kec;

		}// end foreach
		// $data[1]['dapil'] = 'sate2' ;
		return $data;
			
	}
	public function hapuskelurahan($id){
		// $this->db->where('id_caleg',$id);
		$this->db->delete('tbl_dapilkelurahan', array('id_dapilkelurahan' => $id));
	}

	public function tambahkelurahan(){
		$kecamatan = $this->input->post('kecamatan', true);
		$kelurahan = $this->input->post('kelurahan', true);
		if($kelurahan <= 0){
			// jika user tidak memilih kelurahan
			// multi input kelurahan
			$this->load->model('MKelurahan');
			$semuakelurahan = $this->MKelurahan->getallkelurahanbyidkecamatan($kecamatan);
			$arraykelurahan = [];
			foreach ($semuakelurahan as $key => $value) {
				// array_push($arraykelurahan, $value);

				$data 	= array(
					// 'id_kecamatan'	=> $this->input->post('kecamatan', true),				
					'id_kelurahan'	=> $value['id_kelurahan'],
					'id_dapil'		=> $this->input->post('id_dapil', true)
				  );

				$this->db->insert('tbl_dapilkelurahan',$data);	
			}

		}else{
			// single input kelurahan
			$data 	= array(
					// 'id_kecamatan'	=> $this->input->post('kecamatan', true),				
					'id_kelurahan'	=> $kelurahan,
					'id_dapil'		=> $this->input->post('id_dapil', true)
				  );
			$this->db->insert('tbl_dapilkelurahan',$data);	
		}
		
	}
}
?>