<!-- Modal -->
<div class="modal  modal-primary fade" id="formModal" role="dialog" aria-labelledby="formModalLabel" >
  <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Tambah Data Dapil <?php echo $id_dapil ?></h4>
              </div>
              <div class="modal-body">
                <!-- begin -->
                <form class="form-group" method="post" action="dapil/tambahkelurahan" id="formx">
                  <input class="hidden" name='id_dapil' value="<?php echo $id_dapil?>" />
                  <div class="form-group ">
                         <label>Kecamatan</label>
                         <select class="seleksi" id="kecamatancb" style="width: 100%" name="kecamatan">
                        </select>
                  </div>
                  <div>
                       <label>Kelurahan</label>
                         <select class="seleksi2" style="width: 100%" name="kelurahan">
                         <option>-- Pilih Semua Kelurahan--</option>
                        </select>
                  </div>
                <!-- end -->
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