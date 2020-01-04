<?php 
class MSuara extends CI_Model{
	function getAllByid($id){
		return $this->db->get_where('tbl_suara', array('id_kelurahan' => $id))->row_array();
	}
	function getAllSuara(){
		return $this->db->get('tbl_suara')->result_array();
	}
	function getAllSuaraById(int $id){
		return $this->db->get_where('tbl_suara', array('id_kelurahan' => $id))->row_array();
	}
	function getAllTpsById(int $id_suara = 0, $id_kelurahan = 0){
		// $this->db->order_by('no_tps asc');
		$this->db->select('*')->from('tbl_tps');
		if($id_suara > 0){
				// ->get_where('tbl_tps', array('id_suara' => $id_suara))
			$this->db->where('id_suara', $id_suara);
		}
		
		$data = $this->db->get()->result_array();

		$hasil = array();
		$totalsuara_partai = 0;
		$totalsuara_tidaksah = 0;
		$totalsuara_sah = 0;

		$hasil['id_kelurahan'] = $id_kelurahan;
		foreach ($data as $key => $value) {
			# code...
			$totalsuara_partai	= $totalsuara_partai + $value['suara_partai'];
			$totalsuara_tidaksah	= $totalsuara_tidaksah + $value['suara_tidaksah'];
			$totalsuara_sah	= $totalsuara_sah + $value['suara_sah'];

			$hasil['suara'][$value['no_tps']] = ['suara_partai'   => $value['suara_partai'], 
										'suara_tidaksah' => $value['suara_tidaksah'],
										'suara_sah' 	 => $value['suara_sah'],
										'id_tps'		 => $value['id_tps']
										
										];
		}
		$hasil['total']		= ['partai'		=> $totalsuara_partai, 
							   'tidaksah' 	=> $totalsuara_tidaksah,
							   'sah'		=> $totalsuara_sah
							  ];
		// return count($hasil);
		return $hasil;

	}	
	function getSuaraCalegPerTPS(int $id_suara = 0){
		// untuk mencari perlolehan suara masing2 caleg berdasarkan no urut dan id_tps
		// $data = $this->getAllSuaraById($id_kelurahan);
		$data  = [];
		$suara = $this->db->order_by('no_tps asc')
				->get_where('tbl_tps', array('id_suara' => $id_suara))
				->result_array();
		$suara2 = $this->db->select('*')
						->from('tbl_tps as t')
						->join('tbl_pemilihan as p','p.id_tps = t.id_tps', 'LEFT')
						->where('t.id_suara', $id_suara)
						->get()
						->result_array();
		foreach ($suara2 as $key => $value) {
			// $data['suara']['id_tps']['no_urut'] = 1;
			$data['suara'][$value['id_tps']][$value['no_urut']] = $value['suara'];
		}
		
		return $data;

	}	
	function tps($id_suara, $no_tps){
		return $this->db->get_where('tbl_tps', array('id_suara' => $id_suara, 'no_tps' => $no_tps))->num_rows();
	}

	function jumlahtps(int $id_kelurahan){
		$adatidak = $this->getAllSuaraById($id_kelurahan)['jumlah_tps'] ?? 0;
		if($adatidak <= 0){
			// kalau belum setting jumlah sebelumnya - tambahkan dulu
			$data 	= array(
				'id_kelurahan'	=> $id_kelurahan,
				'jumlah_tps'	=> $this->input->post('jumlah_tps', true)
			);
			$this->db->insert('tbl_suara',$data);
		}else{
			// kalau sudah ada - update datanya aja

			$jum = $this->input->post('jumlah_tps', true);
			$kel = $this->input->post('id_kelurahan', true);
			$id_suara = $this->input->post('id_suara', true)??0;

			$maxnourut = $this->db->select_max('no_tps')->where('id_suara', $id_suara)->get('tbl_tps')->row_array()['no_tps'];

			if($jum > $maxnourut){
				$jum = $maxnourut;
			}
			$data 	= array(
				'jumlah_tps'	=> $maxnourut
			);
			$this->db->where('id_kelurahan',$kel);
			$this->db->update('tbl_suara',$data);
		}
	}
	function tambahsuara(){
		// cek untuk tbl_tps apakah sudah diset nomor tps / belum
		$id_suara 	= $this->input->post('id_suara');

		$no_tps 	= $this->input->post('no_tps');
		// return "jumlah suara ".$this->tps($id_suara, $no_tps);
		if ($this->tps($id_suara, $no_tps) <= 0){
			// return 1;
			// return "masuk if";
			// tambahkan tps jika belum dibuat sebelumnya
			$data 	= array(
				'id_suara'	=> $id_suara,
				'no_tps'	=> $no_tps,
				'suara_partai'	=> $this->input->post('suara_partai'),
				'suara_tidaksah'=> $this->input->post('suara_tidaksah')
			);
			$this->db->insert('tbl_tps',$data);
		}
			$id_tps 	= $this->db->insert_id();
			$arraysuara = $this->input->post('suara');
			foreach ($arraysuara as $key => $value) {
				if($value > 0){
					// hanya yg suara lebih dari 0 saja yg akan diinputkan
					$data 	= array(
						'id_tps'	=> $id_tps,
						'no_urut'	=> $key+1,
						'id_dapil'	=> $this->input->post('id_dapil'),
						'suara'	=> 	$value
					);

					$this->db->insert('tbl_pemilihan',$data);

				}
			}
		
		return  true;
		// input suara partai - tidak sah 

	}
	function ubahsuara(){
		$suara = $this->input->post('suara');
		$jumlah_caleg = $this->input->post('jumlah_caleg');
		// foreach ($suara as $key => $value) {
		for ($i=1; $i <= $jumlah_caleg; $i++):
			# code...
				$this->db->where('id_tps', $this->input->post('id_tps', true));
				$this->db->where('no_urut', $i);
				$q = $this->db->get('tbl_pemilihan');
				if($q->num_rows() > 0){
					// jika suara ditemukan - maka lakukan proses update data

						$data 	= array(
							//'no_urut'	=> $key+1,
							'suara'	=>  $suara[$i-1]
						);
					$this->db->where('id_tps', $this->input->post('id_tps', true));
					$this->db->where('no_urut', $i);		
					if($suara[$i-1] >0){
						$this->db->update('tbl_pemilihan',$data);
					}else{
						$this->db->delete('tbl_pemilihan');
					}	
				}
				else{
					// insert data
					$data 	= array(
						'no_urut'	=> $i,
						'suara'		=> $suara[$i-1],
						'id_tps'	=> $this->input->post('id_tps', true),
						'id_dapil'	=> $this->input->post('id_dapil', true),

					);
					// if($suara[$i] > 0){
						$this->db->insert('tbl_pemilihan',$data);
					// }

				}
							
		endfor;
		$data = array(
			'suara_partai'	=> $this->input->post('suara_partai', true),
			'suara_tidaksah'=> $this->input->post('suara_tidaksah', true)
		);
		$this->db->where('id_tps', $this->input->post('id_tps', true));
		$this->db->update('tbl_tps',$data);
		return true;

	}
	// ubah suara - tps
	function getidtp($id_suara, $no_tps){
		return $this->db->get_where('tbl_tps', array('id_suara' => $id_suara, 'no_tps' => $no_tps))->row_array();
	}
	function gettpsbyid($id_tps){
		return $this->db->get_where('tbl_tps', array('id_tps' => $id_tps))->row_array();
	}
	function gettpsbyidsuara($id_suara){
		return $this->db->get_where('tbl_tps', array('id_suara' => $id_suara))->result_array();
	}
	function tpsubah($id_tps){
		//
		// return "ada ".$id_tps;
		$data = [];
		$data['id_tps'] = $id_tps;
		$data['suara'] = $this->db->select('no_urut, suara')
					->from('tbl_pemilihan')
					->where('id_tps', $id_tps)
					->get()
					->result_array();
		$r 	= $this->db->get_where('tbl_tps', array('id_tps' => $id_tps))->row_array();
					// ->row_array();
		$data['partai'] = $r['suara_partai'];
		$data['tidaksah']	= $r['suara_tidaksah'];
		return $data;
	}

	function getrelasikecamatansuara($id_kecamatan = 0){
		// mencari relasi antara kelurahan dan suara
		$data = $this->db->select('suara.id_suara, suara.jumlah_tps, kel.id_kecamatan')
			// ->select_sum('jumlah_tps')
			->from('tbl_suara as suara')

			->join('tbl_kelurahan as kel','kel.id_kelurahan = suara.id_kelurahan','LEFT')
			// ->join('tbl_kecamatan as kec','kec.id_kecamatan = kec.id_kecamatan','LEFT')
			->where('kel.id_kecamatan', $id_kecamatan)
			->order_by('kel.id_kecamatan')

			->get()
			->result_array();
		// return ['data' => 
			return $data;
	}
	function xx($kecamatan){
		$data = [];
		foreach ($kecamatan as $key => $kec) {
			# code...
			$id_kecamatan = $kec['id_kecamatan'];

			$id_suara = 0;
			$suara_partai = 0;
			$suara_tidaksah = 0;
			$suara_sah = 0;
			$jumlah_tps = 0;

			$relasikecamatan = $this->getrelasikecamatansuara($id_kecamatan);
			foreach ($relasikecamatan as $key2 => $value) {
				$id_suara = $value['id_suara'];
				$total_suara  = $this->totalsuara_kecamatan($id_suara);

				$jumlah_tps = $jumlah_tps + $value['jumlah_tps']??0;
				$suara_partai = $suara_partai + $total_suara['suara_partai']??0;
				$suara_tidaksah = $suara_tidaksah + $total_suara['suara_tidaksah']??0;
				$suara_sah = $suara_sah + $total_suara['suara_sah']??0;
			}
			// $id_suara     = $relasikecamatan['id_suara']??0;

			// $jumlah_tps   = $relasikecamatan['jumlah_tps']??0;

			// $suara_partai = $total_suara['suara_partai']??0;
			$data[$key] = array('id_kecamatan' 	=> $kec['id_kecamatan'],
								'kecamatan'		=> $kec['kecamatan'],
								'jumlah_tps' 	=> $jumlah_tps,
								'id_suara'		=> $id_suara,
								'suara_partai'	=> $suara_partai,
								'suara_tidaksah'=> $suara_tidaksah,
								'suara_sah'	=> $suara_sah,



							);
			// $data[$id_kecamatan]	 = 200;

			// getrelasikecamatansuara
		}
		return $data;
	}
	function totalsuara_kelurahan($id_kelurahan){
		$kelurahanx = 'dapilkel.id_dapil';
		if($this->session->userdata('username') != 'admin' ){
			$kelurahanx = ['dapilkel.id_dapil' => $this->session->userdata('id_dapil')];
		}
		return $this->db->select('kel.id_kelurahan, kelurahan, id_kecamatan, suara.id_suara, jumlah_tps')
				->select_sum('tps.suara_partai')
				->select_sum('tps.suara_tidaksah')
				->select_sum('tps.suara_sah')

				// ->select_sum('suara_partai')
				// ->select_sum('suara_tidaksah')
				// ->select_sum('suara_sah')

				->from('tbl_kelurahan as kel')
				->join('tbl_dapilkelurahan as dapilkel','dapilkel.id_kelurahan = kel.id_kelurahan','INNER')
				// ->join('tbl_dapilkelurahan as dapilkel','dapilkel.id_kelurahan = kel.id_kelurahan','INNER')
				->join('tbl_suara as suara','suara.id_kelurahan = kel.id_kelurahan', 'LEFT')
				->join('tbl_tps as tps','tps.id_suara = suara.id_suara','LEFT')
				->where('id_kecamatan', $id_kelurahan)
				->where($kelurahanx)
				// ->where($kelurahanx)
				->group_by('kel.id_kelurahan')
				->get()
				->result_array();
	}
	function totalsuara_kecamatan($id_suara){
		$data = $this->db
			->select_sum('suara_partai')
			->select_sum('suara_tidaksah')
			->select_sum('suara_sah')

			->from('tbl_tps')
			->where('id_suara', $id_suara)
			// ->join('tbl_tps as tps','tps.id_suara = suara.id_suara','LEFT')
			->get()
			->row_array();

		return $data;
		// tidak bisa group by id_kecamatan <= kalau dari kecamatan suara partai tdk kehitung dg baik
		/*
		return $this->db->select('kec.id_kecamatan, kec.kecamatan, kel.id_kelurahan, kel.kelurahan, suara.id_suara, jumlah_tps')
				// ->distinct('id.id_kelurahan')	
				->select('(SELECT SUM(suara_partai) FROM tbl_tps tps WHERE id_suara=suara.id_suara) AS suara_partai')
				// ->select_sum('tps.suara_partai')
				->select_sum('tps.suara_tidaksah')
				->select_sum('tps.suara_sah')

				->from('tbl_kecamatan as kec')
				->join('tbl_kelurahan as kel','kel.id_kecamatan = kec.id_kecamatan', 'RIGHT')
				->join('tbl_suara as suara','suara.id_kelurahan = kel.id_kelurahan', 'LEFT')
				->join('tbl_tps as tps','tps.id_suara = suara.id_suara','LEFT')
				// ->where('id_kecamatan', $id_kelurahan)
				->group_by(array('kec.id_kecamatan','kel.id_kelurahan'))
				->get()
				->result_array();
		*/
	}
	function cariSuaraLaporan($id_tps, $no_urut){
		$r = $this->db->select('suara')
				->from('tbl_pemilihan')
				->where('id_tps', $id_tps)
				->where('no_urut', $no_urut)
				->get()
				->row_array();

		return $r;
	}
	function getJumlahTps(int $id_kelurahan){
		// return 10;
		return $this->db->get_where('tbl_suara', array('id_kelurahan' => $id_kelurahan))->row_array()['jumlah_tps'];
	}
	function hapusJikaKosong(){
		return $this->db->delete('tbl_pemilihan', array('suara' => 0));		
	}
	function hapustps($id){
		$d = $this->db->delete('tbl_tps', array('id_tps' => $id));		
		$x = $this->db->delete('tbl_pemilihan', array('id_tps' => $id));	
		if($d AND $x){
			return true;
		}	
	}
	function hapustpssuara($id_suara){
		$this->db->delete('tbl_suara', array('id_suara' => $id_suara));		
		$this->db->delete('tbl_tps', array('id_suara' => $id_suara));		
	}
	
}
?>