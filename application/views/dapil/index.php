<div class="content-wrapper">
<!-- <section class="content-header">
  <h1>
    Data Calon Legislatif 
    <small></small>
  </h1>
</section> -->
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
        <a href="#tambah" class="btn btn-info btn-block" data-toggle="modal" data-target="#formModal"><li class="fa fa-plus"></li> Tambah Dapil</a>
        <hr>
        <a href="<?php echo base_url().'laporan/cetakdapil'?>" class="btn btn-primary btn-block"><li class="fa fa-print"></li> Cetak Dapil</a>
      </div>
    </div>
  </div>
  <div class="col-sm-9">
      
  
      <!-- Default box -->
      <div class="box box-warning box-solid">

        <div class="box-header with-border">
            <h3 class="box-title">Data Dapil</h3>
            <div class="box-tools pull-right">
              
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          <!-- /.box-tools -->
          </div>

        <div class="box-body">
          <table class="table table-striped">
              <thead>
                <tr>
                
                  <th>Dapil</th>
                  <th>Kecamatan</th>
                  <th>Kelurahan</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data as $key => $dapil): ?>
                  <tr>
                    <td><?php echo $dapil['id_dapil'] ?></td>
                    <td>
                      <?php 
                      foreach ($dapil['kecamatan'] as $key => $kec): ?>
                        <span class="label bg-purple">
                          <?php echo $kec; ?>
                        </span>
                        &nbsp
                      <?php endforeach ?>

                    </td>
                    <td>
                      <?php foreach ($dapil['kec_kel'] as $key => $value): ?>
                        <span class="label bg-maroon">
                          <?php echo $value[0]['kelurahan'].' '.$value[0]['id_kecamatan'] ?>
                        </span> 

                        &nbsp
                      <?php endforeach ?>
                    </td>


                    <td>
                      <a href="<?php echo base_url('dapil/detail/').$dapil['id_dapil'] ?>" 
                      class="btn btn-sm btn-flat btn-primary" 
                      >Detail</a>
                    </td>
                  </tr>
                <?php endforeach ?>
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


<!-- Modal -->
<!-- <button type="button" class="btn btn-danger btn-flat btnTambah" data-toggle="modal" data-target="#formModal" >
  Tambah dapil
</button>
 -->
