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
        <a href="#tambah" class="btn btn-info btn-block" data-toggle="modal" data-target="#formModal"><li class="fa fa-plus"></li> Tambah Data Caleg</a>
      
        <hr>
        <div class="form-group">
          <label>Daerah Pemilihan</label>
            <select class="form-control" name="dapil" id="combocari">
              <?php foreach ($dapil as $key => $value): ?>
                <option value="<?php echo $value['id_dapil'] ?>"> <?php echo $value['dapil'] ?> </option>
              <?php endforeach ?>
            </select>
        </div>
      </div>
    </div>
  </div>

  <!-- ------------------------ -->
  <div class="col-sm-9">
    <div class="box">
      <div class="box-header with-border">
          <h3 class="box-title">Data Calon Legislatif</h3>
      </div>
        <div class="box-body">
        	<table class="table table-striped" id="table_dt">
              <thead>
                <tr>
                  <th>
                    #
                  </th>
                  <th>
                    Nama Caleg
                  </th>
                  <th>
                    Dapil 
                  </th>
                  <th>
                    Urut
                  </th>
                  <th>
                  	Aksi
                  </th>
                </tr>
              </thead>
              <tbody>
              	<?php foreach ($caleg as $data): ?>
				        <tr>
        					<td class="py-1">						
        						<img src="<?php echo base_url().'assets/images/foto_caleg/'.$data['foto'] ?>" alt="image" width=25px>
        					</td>
					        <td><?php echo $data['nama'] ?></td>
                  <td><?php echo $data['id_dapil'] ?></td>
        					<td><?php echo $data['no_urut'] ?></td>
        					<td><a href="<?php echo base_url('caleg/hapus/'.$data['id_caleg']) ?>" 
        						class="btn btn-sm btn-flat bg-maroon" 
        						onclick="return confirm('sure?'); "
        						>Hapus</a>

        			<!-- 			<a href="<?php echo base_url('caleg/detail/'.$data['id_caleg']) ?>" 
        						class="btn btn-sm btn-flat bg-olive" 
        						>Detail</a> -->


        						<a data-toggle="modal" data-target="#formModal"
                       data-halaman="caleg"                        
                       data-id="<?php echo $data['id_caleg'] ?>"
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

      <!-- /.box -->

</div><!-- Div Row -->
</section>
