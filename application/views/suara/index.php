<div class="content-wrapper">
<section class="content-header">
  <h1>
    Data Perolehan Suara
    <small></small>
  </h1>
  <ol class="breadcrumb">
  </ol>
</section>
<section class="content">
<div class="row">
  <div class="col-sm-12">
    
  
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
        </div>
        <div class="box-body">
          <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Kecamatan</th>
                  <th>Jumlah TPS</th>
                  <th>Suara Partai</th>
                  <th>Suara Tidak Sah</th>
                  <th>Suara Sah</th>

                  <th>Jumlah Suara</th> 
                </tr>
              </thead>
              <tbody>
                <?php
                    $jum_tps = 0;
                    $jum_partai = 0;
                    $jum_tidaksah = 0;
                    $jum_sah = 0;
                    $total = 0;
                ?>
                <?php foreach ($kecamatan as $key => $value): ?>
                  <?php 
                    $jumlah = (int) $value['suara_partai'] + (int) $value['suara_sah'];
                    $jum_tps = $jum_tps + (int) $value['jumlah_tps'];
                    $jum_partai = $jum_partai + (int) $value['suara_partai'];
                    $jum_tidaksah = $jum_tidaksah + (int) $value['suara_tidaksah'];
                    $jum_sah = $jum_sah + (int) $value['suara_sah'];
                    $total = $total + $jumlah;
                  ?>

                  <tr>
                    <td><?php echo $key+1 ?></td>                    
                    <td><a href="<?php echo base_url().'suara/kecamatan/'.$value['id_kecamatan'];?>">
                        <?php echo $value['kecamatan'] ?> <?php // echo $value['id_suara'] ?>
                        </a>
                    </td>           
                    <td class="text-right">
                      <?php echo (int)$value['jumlah_tps'] > 0?$value['jumlah_tps']:'-' ?>                      
                    </td>
                    <td class="text-right">
                      <?php echo (int)$value['suara_partai'] > 0?$value['suara_partai']:'-' ?>
                    </td>
                    <td class="text-right">
                      <?php echo (int)$value['suara_tidaksah'] > 0?$value['suara_tidaksah']:'-' ?>
                    </td>
                    <td class="text-right">
                      <?php echo (int)$value['suara_sah'] > 0?$value['suara_sah']:'-' ?>
                    </td>  
                    <td class="text-right">
                      <?php echo $jumlah > 0?$jumlah:'-' ?>
                    </td>
                  </tr>
                <?php endforeach ?>
                <tr>
                    <td>&nbsp</td>
                    <td class=" font-weight-bold text-right"><strong>Total</strong></td>
                    <td class=" text-right"><strong><?php echo $jum_tps > 0?$jum_tps:'-' ?></strong></td>
                    <td class=" text-right"><strong><?php echo $jum_partai > 0?$jum_partai:'-' ?></strong></td>
                    <td class=" text-right"><strong><?php echo $jum_tidaksah > 0?$jum_tidaksah:'-' ?></strong></td>
                    <td class=" text-right"><strong><?php echo $jum_sah > 0?$jum_sah:'-' ?></strong></td>
                    <td class=" text-right"><strong><?php echo $total > 0?$total:'-' ?></strong></td>
                    

                  </tr>
              </tbody>
            </table>
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