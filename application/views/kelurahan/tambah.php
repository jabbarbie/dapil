<!-- Modal -->
<div class="modal  modal-primary fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
  <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Tambah Data Kelurahan</h4>
              </div>
              <div class="modal-body">
                <form class="form-group" method="post" action="kelurahan/tambah" id="formx">
                  <input type="hidden" name="id_kelurahan" id="id_kelurahan" value="">
                 <div class="form-group">
                   <label>Pilih Kecamatan sate</label>
                   <select class="form-control" name='id_kecamatan' id="kecamatan">
                     <?php foreach ($kecamatan as $key => $value): ?>
                       <option value="<?php echo $value['id_kecamatan'] ?>">
                         <?php echo $value['kecamatan'] ?>
                       </option>
                     <?php endforeach ?>
                   </select>
                 </div>
                 <div class="form-group">
                    <label>Kelurahan</label>
                    <input class="form-control" id="kelurahan" name="kelurahan" placeholder="" autofocus="" />
                  </div>
                  
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                <input type="submit" class="btn btn-primary btnSimpan" value="Simpan">
              </div>
            </form>
            </div>
            <!-- /.modal-content -->
          </div>
</div>