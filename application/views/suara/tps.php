<span id="id_suaray" val="<?php echo $data['id_suara'] ?>" ></span>
<div class="content-wrapper">
<section class="content-header">
  <h1>
    Data Perolehan Suara
    <small></small>
  </h1>
  <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-tv"></i><?php echo $kelurahan['kecamatan'] ?></a></li>
        <li><a href="#"><?php echo $kelurahan['kelurahan'] ?></a></li>
        <li><a href="#">TPS</a></li>
  </ol>
</section>
<section class="content">
<div class="row">
    <div class="col-sm-3">
    <div class="box box-warning box-solid ">
        <div class="box-header with-border">
            <h3 class="box-title">Control Panel</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
      <div class="box-body">
       <!--  <a href="#tambah" class="btn btn-info btn-block" data-toggle="modal" data-target="#formModal"><li class="fa fa-plus"></li> Tambah Data</a> -->
        <div class="form-group">
          <label>Jumlah TPS</label>
             <form action="<?php echo base_url()?>tps/setjumlahtps" method="post" onsubmit="harusangka()">

              <div class="input-group ">
                <!-- /btn-group -->
                <input type="hidden" name="id_kelurahan" value="<?php echo $id_kelurahan ?>">
                <input type="hidden" name="id_suara" value="<?php echo $data['id_suara'] ?>">
                <input class="form-control " id="jumlahtpsxx" name="jumlah_tps" value="<?php echo $data['jumlah_tps']??0 ?>" /> 
                <div class="input-group-btn">
                  <input type="submit" value="+" class="btn btn-primary" />
                </div>


              </div>
            </form>
        
      
        </div>
         <ol class="daftarcaleg">
            <?php foreach ($caleg as $key => $value): ?>
             <li><?php echo substr($value['nama'],0,24) ?>
               
               
             </li>
            <?php endforeach ?>
          </ol>




      </div>
    </div>
    <div class="box">
      <a  data-link="<?php echo base_url().'suara/hapussemuasuara/'.$id_kelurahan ?>" id="btn-hapus" class="btn btn-danger btn-block btn-hapus"><li class="fa fa-trash" data-id=""></li> Hapus Semua Suara</a>
    </div>
  </div>
  <div class="col-sm-9">
    
  
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <span id="idkelurahanx" valx="100"></span>
          <h3 class="box-title"><?php echo $kelurahan['kecamatan'].' - '.$kelurahan['kelurahan'] ?> 
          </h3>
        </div>
        <div class="box-body">
          <?php if ((int)$data['jumlah_tps'] > 0): ?>            
          <table class="table table-striped table-bordered" id="table_tps">
              <thead>
                <tr>
                  <th class="bg-primary">#</th>
                  <th class="text-center bg-primary">TPS</th>
                  <th class="text-center bg-primary">Suara Partai</th>
                  <th class="text-center bg-primary">Suara Tidak Sah</th>
                  <th class="text-center bg-primary">Suara Sah</th>                  
                  <th class="text-center bg-primary">Jumlah Suara</th>
                  <th class="text-center bg-primary">Aksi</th>

                </tr>
              </thead>
              <tbody>
                <?php for ($i=1;$i <= (int)$data['jumlah_tps'];$i++): ?>
                  <tr>
                    <td><?php echo $i ?></td>
                    <td class="text-center">
                      <a href="" data-toggle="modal" data-target="#formTPS" 
                         data-notps="<?php echo (int) $i ?>"
                         data-idkelurahan="1" 
                         class="tubah" 
                       >
                        <?php echo 'TPS - '.$i ?>                       
                      </a>
                        
                      </td>
                    <?php 
                      $x = $tps['suara'][$i]??0;

                    ?>
                    <td class="text-right"><?php echo ((int)$x['suara_partai'] <= 0)?'-':$x['suara_partai'] ?></td>
                    <td class="text-right"><?php echo ((int)$x['suara_tidaksah'] <= 0)?'-':$x['suara_tidaksah'] ?></td>
                    <td class="text-right"><?php echo ((int)$x['suara_sah'] <= 0)?'-':$x['suara_sah'] ?></td>

                    <td class="text-right"><?php echo ((int)$x['suara_partai']+(int)$x['suara_sah']>0)?(int)$x['suara_partai']+(int)$x['suara_sah']:'-' ?></td>

                    <td class="text-center">
                      <?php if ((int) $x['suara_partai'] > 0 || (int) $x['suara_tidaksah'] > 0 || (int) $x['suara_sah'] > 0 ): ?>
                        
                      <a href="" 
                         data-toggle="modal" data-target="#laporanTPS" 
                         data-notps="<?php echo (int) $i ?>"
                         data-idkelurahan="1"
                         data-iddapil=<?php echo $id_dapil ?>  
                         data-idsuara=<?php echo $data['id_suara'] ?>
                         class="btn btn-primary tlapor btn-sm">Detail</a></td>
                      <?php endif ?>
                    
                    
                  </tr>
                <?php endfor ?>
                <tr>
                  <td>&nbsp</td>
                  <td class=" font-weight-bold "><strong>Total</strong></td>
                  <td class=" text-right"><strong><?php echo $tps['total']['partai'] ?></strong></td>
                  <td class=" text-right"><strong><?php echo $tps['total']['tidaksah'] ?></strong></td>

                  <td class=" text-right"><strong><?php echo $tps['total']['sah'] ?></strong></td>
                  <td class=" text-right"><strong><?php echo $tps['total']['sah']+$tps['total']['partai'] ?></strong></td>
                  <td></td>
                </tr>

              </tbody>
            </table>
        <?php else: ?>
              <div class="alert alert-info alert-dismissible">
                <h4><i class="icon fa fa-warning"></i> Pesan!</h4>
                Jumlah TPS belum ditentukan
              </div>
        <?php endif ?>

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <!-- Footer -->
        </div>
        <!-- /.box-footer-->
      </div>
  
  </div>
</div>
</section>
