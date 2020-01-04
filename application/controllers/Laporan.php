<?php
/**
 * 
 */
class Laporan extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('pdf');
        
	}
	function tps(int $id_kelurahan, int $id_tps, int $id_suara, int $id_dapil){
        // var url = base_urlx + 'laporan/tps/' + idkelurahanx + '/' + id_tps + '/' + id_suara;

        $this->load->model('MSuara');
        $this->load->model('MKelurahan');
        $kelurahan = $this->MKelurahan->getInfoKelurahan($id_kelurahan);
        $suara = $this->MSuara->gettpsbyid($id_tps);
        $total = $suara['suara_partai']+$suara['suara_tidaksah']+$suara['suara_sah'];
        // $data = $this->MSuara->detailsuara();
		$pdf = new FPDF('P','mm','Letter');
		$pdf->addPage();
		$pdf->SetFont('Arial','',10);
        // mencetak string 
        $pdf->Cell(30,6,'TPS ',0,0,'L');
        $pdf->Cell(60,6,': NOMOR '.$id_kelurahan,0,0,'L');
        $pdf->Cell(40,6,'Desa / Kelurahan',0,0,'L');
        $pdf->Cell(66,6,': '.$kelurahan['kelurahan'],0,1,'L');


		$pdf->Cell(30,6,'Kecamatan',0,0,'L');
        $pdf->Cell(60,6,': '.$kelurahan['kecamatan'],0,0,'L');
        $pdf->Cell(40,6,'Kabupaten / Kota',0,0,'L');
        $pdf->Cell(66,6,': PALANGKA RAYA',0,1,'L');

		$pdf->Cell(30,6,'Provinsi',0,0,'L');
        $pdf->Cell(60,6,': KALIMANTAN TENGAH ',0,0,'L');
        $pdf->Cell(40,6,'Dapil ',0,0,'L');
        $pdf->Cell(66,6,': '.$id_dapil,0,1,'L');

        $pdf->Cell(125,7,'',0,1,'L');
        $pdf->Cell(190,6,'RINCIAN PEROLEHAN SUARA',0,1,'C');
        $pdf->Cell(125,7,'',0,1,'L');

        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(165,7,'Nomor dan Nama Calon Legislatif',1,0,'C');
        $pdf->Cell(30,7,'Suara',1,1,'C');

        // $pdf->Cell(20,7,'No',1,0,'C');
       
        $pdf->SetFont('Arial','',10);
        $caleg = $this->db->where('id_dapil',$id_dapil)->get('tbl_caleg')->result_array();
        foreach ($caleg as $row){
            $s = $this->MSuara->cariSuaraLaporan($id_tps, $row['no_urut'])['suara']??'-';
            $pdf->Cell(20,9,$row['no_urut'],1,0,'C');
            $pdf->Cell(145,9,' '.$row['nama'],1,0,'L');
            $pdf->Cell(30,9,$s,1,1,'C');
            
        }
        $pdf->Cell(165,7,'Suara Partai ',1,0,'R');
        $pdf->Cell(30,7,$suara['suara_partai'],1,1,'C');
        $pdf->Cell(165,7,'Suara Tidak Sah ',1,0,'R');
        $pdf->Cell(30,7,$suara['suara_tidaksah'],1,1,'C');
        $pdf->Cell(165,7,'Suara Sah ',1,0,'R');
        $pdf->Cell(30,7,$suara['suara_sah'],1,1,'C');
        $pdf->Cell(165,7,'Total Suara ',1,0,'R');
        $pdf->Cell(30,7,$total,1,1,'C');
        $pdf->Output();
	}
    function rekapsuara($id_kelurahan){
        // jumlah_tps
        $this->load->model('MSuara');
        $this->load->model('MKelurahan');
        $this->load->model('MCaleg');

        $suara = $this->MSuara->getAllSuaraById($id_kelurahan);
        $jumlah_tps = $suara['jumlah_tps'];
        $id_suara   = $suara['id_suara']??0;

        $suara    = $this->MSuara->getAllTpsById($id_suara);


        $tpssuara = $this->MSuara->getSuaraCalegPerTPS($id_suara);
        // $stps = $tpssuara['suara'][2][7]??0;
       
       // echo $stps;
        // echo json_encode($tpssuara);
        // $tpssuara["suara"][id_tps][no_urut]
        // print_r ($tpssuara["suara"]);
        // die();

        // cari id dapil dari dapilkelurahan
        $id_dapil = $this->MKelurahan->getIdDapilByIdKelurahan($id_kelurahan);
        // echo die($id_dapil);
        $caleg = $this->MCaleg->getAllCalegByDapil($id_dapil);
        $jumlah_caleg =count($caleg);

        $s = new FPDF('P','mm','Letter');
        $s->addPage();
       
        $s->SetFont('Arial','',12);
        $s->Cell(190,5,'Rekapitulasi Perolehan Suara Calon Legislatif',0,1,'C');
        $s->SetFont('Arial','',8);

        // $s->Cell(190,5,'Per Tanggal : 27 Maret 2019',0,1,'C');
        $s->Cell(190,2,'',0,1,'C');

        $s->Line(11, 19, 200, 19);


        $s->Cell(125,5,'',0,1,'L');

        $s->SetFont('Arial','',10);
        
        $s->Cell(30,6,'Kelurahan ',0,0,'L');
        $s->Cell(60,6,': Bukit Tunggal ',0,0,'L');
        $s->Cell(40,6,'Jumlah TPS',0,0,'L');
        $s->Cell(66,6,': '. $jumlah_tps,0,1,'L');


        $s->Cell(30,6,'Kecamatan',0,0,'L');
        $s->Cell(60,6,': Bukit Batu',0,0,'L');
        $s->Cell(40,6,'Kabupaten / Kota',0,0,'L');
        $s->Cell(66,6,': Palangka Raya',0,1,'L');

        $s->Cell(30,6,'Provinsi',0,0,'L');
        $s->Cell(60,6,': Kalimantan Tengah ',0,0,'L');
        $s->Cell(40,6,'Dapil ',0,0,'L');
        $s->Cell(66,6,': '.$id_dapil,0,1,'L');
        $s->Cell(125,2,'',0,1,'L');

       
        // Memberikan space kebawah agar tidak terlalu rapat
        $lebar_suara = 14;
        $lebar_tps = 17;
        $s->SetFont('Arial','',9);
        $s->Cell($lebar_tps,14,'TPS',1,0,'C');
        $s->Cell(120,7,'Nomor Calon Legislatif',1,0,'C');
        $s->Cell($lebar_suara * 3,7,'Suara',1,0,'C');
        $s->Cell(13,14,'Jumlah',1,0,'C');
        // $s->Cell(1,7,'',0,1);
        $s->Ln(7);

        $lebar = 120 / $jumlah_caleg;
        $s->Cell($lebar_tps,7,'',0,0,'C');
        for ($i=1; $i <= $jumlah_caleg; $i++) { 
            $s->Cell($lebar,7,$i,1,0,'C');
        }
        $s->Cell($lebar_suara,7,'Partai',1,0,'C');
        $s->Cell($lebar_suara,7,'Tdk Sah',1,0,'C');
        $s->Cell($lebar_suara,7,'Sah',1,1,'C');
        // var_dump($suara);
        // die();
        $total_partai = 0;
        $total_tidaksah = 0;
        $total_sah = 0;
        $total_jumlah = 0;

        $s->SetFont('Arial','',8);        
        for ($j=1; $j <= $jumlah_tps; $j++) { 
            $x = $suara['suara'][$j]??0;
            $id_tpss = (int) $x['id_tps'];
            // $s->Cell($lebar_tps,6,'TPS - '.$j,1,0,'C');
            $s->Cell($lebar_tps,6,'TPS - '.$j,1,0,'C');
            
            for ($i=1; $i <= $jumlah_caleg; $i++) { 
                // $xx = $stps['suara'][$x['id_tps']][$i]??0;
                $valx = $tpssuara["suara"][$id_tpss][$i]??'-';
                $s->Cell($lebar,6,$valx,1,0,'C');


            }
            $jumlahx = (int) $x['suara_partai'] + $x['suara_sah'];

            $total_partai = $total_partai + $x['suara_partai']??0;
            $total_tidaksah = $total_tidaksah + $x['suara_tidaksah']??0;
            $total_sah = $total_sah + $x['suara_sah']??0;
            $total_jumlah = $total_jumlah + $jumlahx;

            $s->Cell($lebar_suara,6,((int) $x['suara_partai'] <= 0)?'-':$x['suara_partai'],1,0,'C');
            $s->Cell($lebar_suara,6,((int) $x['suara_tidaksah'] <= 0)?'-':$x['suara_tidaksah'],1,0,'C');
            $s->Cell($lebar_suara,6,((int) $x['suara_sah'] <= 0)?'-':$x['suara_sah'],1,0,'C');
            $s->Cell(13,6,($jumlahx <= 0)?'-':$jumlahx,1,1,'C');
        }
        $s->Cell(120+$lebar_tps,6,'Total Suara',1,0,'C');
        $s->Cell($lebar_suara, 6, ($total_partai <= 0)?'-':$total_partai,1,0,'C');
        $s->Cell($lebar_suara, 6, ($total_tidaksah <= 0)?'-':$total_tidaksah,1,0,'C');
        $s->Cell($lebar_suara, 6, ($total_sah <= 0)?'-':$total_sah,1,0,'C');
        $s->Cell(13, 6, ($total_jumlah <= 0)?'-':$total_jumlah,1,0,'C');

        $s->SetFont('Arial','',10);        

        $s->Ln(8);
        $s->Cell(50, 8, 'Daftar Caleg Dapil - '.$id_dapil,0,1);
  

        $s->SetFont('Arial','',8);                
        foreach ($caleg as $key => $value) {
            $s->Cell(5, 4, $value['no_urut'],0,0);
            $s->Cell(60, 4, $value['nama'] ,0,1);
        }
        $s->Output();

    }
    function cetakdapil(){
        // jumlah_tps
        // $this->load->model('MSuara');
        $this->load->model('MKelurahan');
        $this->load->model('MKecamatan');
        $this->load->model('MCaleg');
        $this->load->model('MDapil');
        $dapil = $this->MDapil->getalldapil();


        $s = new FPDF('P','mm','Letter');
        $s->addPage();
       
        $s->SetFont('Arial','',12);
        $s->Cell(190,5,'Data Calon Legislatif dan Daerah Pemilihan',0,1,'C');
        $s->SetFont('Arial','',10);
        // header
        $s->Ln(5);
        $s->SetFont('Arial','',9);

        $s->Cell('17',8,'Dapil',1,0,'C');
        $s->Cell('90',8,' Caleg',1,0,'L');
        $s->Cell('85',8,' Kelurahan',1,1,'L');

        $lebar_dapil = 17;
        $lebar_caleg = 90;
        $lebar_kelurahan = 85;

        foreach ($dapil as $key => $value) {
            $s->Cell($lebar_dapil,7,$value['id_dapil'],1,0,'C');

            $caleg = $this->MCaleg->getAllCalegByDapil($value['id_dapil']);
            foreach ($caleg as $key1 => $value2) {
                # code...
                $s->Cell($lebar_dapil,7,' ',1,0);
                $s->Cell($lebar_caleg,7,$value2['nama'],1,1,'L');
            }

            $s->Cell($lebar_kelurahan,7,$value['id_dapil'],1,1,'L');
        }
        $s->Output();

    }
}
?>