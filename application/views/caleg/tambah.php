<!-- Modal -->
<div class="modal  modal-primary fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Tambah Data Caleg</h4>
      </div>
      <div class="modal-body">
   		<form class="form-group" method="post" action="caleg/upload_foto" id="formx">	
			 
   		<div class="form-group">
   			<div class="row">
   				<div class="col-sm-4">

   					<div class="form-group">
   						<label>Pas Foto</label>
 	  					<img class="img img-responsive" id="img-upload" src="<?php echo base_url()?>assets/images/foto.jpg" />
                <div class="input-group input-group-sm">
                    <span class="input-group-btn">
                        <span class="btn btn-success btn-file btn-sm">
                            Cari Foto.. <input type="file" name="file" id="imgInp">
                        </span>
                    </span>
                    <input type="text" class="form-control" readonly>
                </div>
   					</div>
   				</div>
   				<div class="col-sm-8">
					<div class="form-group">
						<label>Dapil</label>
						<select class="form-control" name="id_dapil" id="combodapil">
              <?php foreach ($dapil as $key => $value): ?>
                <option value="<?php echo $value['id_dapil'] ?>"> <?php echo $value['dapil'] ?> </option>
              <?php endforeach ?>
            </select>
					</div>
					<div class="form-group">
						<label>Nama</label>
						<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap"  autofocus="">
					</div>
					<div class="form-group">
						<label>Nomor Urut</label>
            <input type="text" class="form-control" id="no_urut" name="no_urut" placeholder="Masukkan Nomor Urut">
					</div>
				</div>

				
   			</div>
   		</div>
		
      <div id="progressbar"></div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal" ">Tutup</button>
        <input type="submit" class="btn btn-primary btnSimpan" value="Simpan">
      </div>
	  </form>

    </div>
    <!-- /.modal-content -->
  </div>
</div>