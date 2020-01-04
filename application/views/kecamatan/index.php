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
        <a href="#tambah" class="btn btn-info btn-block" data-halaman='kecamatan' data-toggle="modal" data-target="#formModal"><li class="fa fa-plus"></li> Tambah Data Kecamatan</a>
      
       
      </div>
    </div>
  </div>

  <div class="col-sm-9">  
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Data Kecamatan</h3>
        </div>
        <div class="box-body">
          <table class="table table-striped" id="table_nosearch">
              <thead>
                <tr>
                  <th>
                    #
                  </th>
                  <th>
                    Kecamatan
                  </th>
                  <th>
                    Aksi
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data as $key => $value): ?>
                  <tr>
                    <td><?php echo $key+1 ?></td>                    
                    <td><?php echo $value['kecamatan'] ?></td>
                    <td><a href="<?php echo base_url('kecamatan/hapus/'.$value['id_kecamatan']) ?>" 
                      class="btn btn-sm btn-flat bg-maroon" 
                      onclick="return confirm('Yakin ingin menghapus?'); "
                      >Hapus</a>


                      <a data-toggle="modal" data-target="#formModal"
                      data-halaman="kecamatan" 
                      data-id="<?php echo $value['id_kecamatan'] ?>"                      
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