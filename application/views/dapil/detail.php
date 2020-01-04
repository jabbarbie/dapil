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
    <div class="box box-primary box-solid ">
        <div class="box-header with-border">
            <h3 class="box-title">Control Panel</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
      <div class="box-body">
        <a href="#tambah" class="btn btn-info btn-block" data-toggle="modal" data-target="#formModal"><li class="fa fa-plus"></li> Tambah Kabupaten</a>

        <br />
        <!-- <a href="#tambah" class="btn btn-danger btn-block"><li class="fa fa-trash"></li> Hapus Dapil</a> -->

        <hr>
        <div class="form-group">
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-9">
      
  
      <!-- Default box -->
      <div class="box box-primary box-solid">

        <div class="box-header with-border">
            <h3 class="box-title">Daerah Pemilihan - <?php echo $id_dapil ?></h3>
            <div class="box-tools pull-right">
              
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          <!-- /.box-tools -->
          </div>

        <div class="box-body">
          <table class="table table-striped" id="table_nosearch">
              <thead>
                <tr>
                  <th>
                    #
                  </th>
                  <th>Kecamatan</th>
                  <th>Kelurahan</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data as $key => $dapil): ?>
                  <tr>
                    <td><?php echo $key+1 ?></td>                    
                    <td>
                      <?php echo $dapil['kecamatan'] ?>
                    </td>
                    <td>
                      <?php echo $dapil['kelurahan'] ?>                      
                    </td>
                    <td><a href="<?php echo base_url('dapil/hapuskelurahan/'.$dapil['id_dapilkelurahan'].'/'.$id_dapil) ?>" 
                    class="btn btn-sm btn-flat bg-maroon" 
                    onclick="return confirm('sure?'); "
                    >Hapus</a>

                    <a href="<?php echo base_url('caleg/hapuskelurahan/'.$dapil['id_kelurahan']) ?>" 
                    class="btn btn-sm btn-flat btn-primary" 
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
  Tambah dapil
</button>
 -->
