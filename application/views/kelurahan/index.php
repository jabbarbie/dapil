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
        <a href="#tambah" class="btn btn-info btn-block" data-toggle="modal" data-target="#formModal"><li class="fa fa-plus"></li> Tambah Data</a>
      
        <hr>
        <div class="form-group">
          <label>Pilih Kecamatan</label>
          <select class="form-control" id="combocari">
            <?php foreach ($kecamatan as $key => $value): ?>
              <option value="<?php echo $value['id_kecamatan']?>"><?php echo $value['kecamatan'] ?></option>
            <?php endforeach ?>
          </select>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-9">
      
  
      <!-- Default box -->
      <div class="box box-warning box-solid">

        <div class="box-header with-border">
            <h3 class="box-title">Data Kelurahan</h3>
            <div class="box-tools pull-right">
              
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          <!-- /.box-tools -->
          </div>

        <div class="box-body">
          <table class="table table-striped" id="table_dt">
              <thead>
                <tr>
                  <th>
                    #
                  </th>
                  <th>Kecamatan</th>
                  <th>id_kecamatan</th>
                  <th>Kelurahan</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data as $key => $value): ?>
                  <tr>
                    <td><?php echo $key+1 ?></td>                    
                    <td><?php echo $value['kecamatan'] ?></td>
                    <td><?php echo $value['id_kecamatan'] ?></td>
                    <td><?php echo $value['kelurahan'] ?></td>
                    <td><a href="<?php echo base_url('kelurahan/hapus/'.$value['id_kelurahan']) ?>" 
                      class="btn btn-sm btn-flat bg-maroon" 
                      onclick="return confirm('Yakin ingin menghapus?'); "
                      >Hapus</a>


                      <a 
                      data-toggle="modal" data-target="#formModal"
                      data-halaman="kelurahan"
                      data-id="<?php echo $value['id_kelurahan']?>"
                      class="btn btn-sm btn-flat btn-primary tubah" 
                      >Ubah</a>
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
  Tambah Kelurahan
</button>
 -->
