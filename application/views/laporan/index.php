<div class="content-wrapper">

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
        <a href="" id="btn-report" class="btn btn-primary btn-block" target="_blank"><li class="fa fa-print" data-id=""></li> Cetak Laporan</a>
      
        <hr>
        <div class="form-group">

          <label>Pilih Kecamatan</label>
          <select class="form-control" id="combocarikecamatan">
            <option value="">Cari Kecamatan</option>
            <?php foreach ($kecamatan as $key => $value): ?>
              <option value="<?php echo $value['id_kecamatan']?>"><?php echo $value['kecamatan'] ?></option>
            <?php endforeach ?>
          </select>
        </div>
        <div class="form-group">

          <label>Pilih Kelurahan</label>
          <select class="form-control" id="combolaporankel">
          
          </select>

        </div>
        <hr>
       <!--  <div class="form-group">
          <label>Suara Partai </label>
          <input type="" disabled id="partai" class="form-control">
        </div>
        <div class="form-group">
          <label>Suara Tidak Sah </label>
          <input type="" disabled id="tidaksah" class="form-control">
        </div><div class="form-group">
          <label>Suara Sah </label>
          <input type="" disabled id="sah" class="form-control">
        </div> -->

      </div>
    </div>
  </div>

  <div class="col-sm-9">
    
  
      <!-- Default box -->
      <div class="box">
        <div class="box-body">
          <table class="table table-striped table-bordered" id="table_js" >
              <thead>
                <tr>
                  <!-- <th class="bg-primary">#</th> -->
                  <th class="text-center bg-primary">TPS</th>

                  <th class="text-center bg-primary">Suara Partai</th>
                  <th class="text-center bg-primary">Suara Tidak Sah</th>
                  <th class="text-center bg-primary">Jumlah Suara</th>

                </tr>
              </thead>
              <tbody>

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
