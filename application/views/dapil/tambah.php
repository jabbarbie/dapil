<!-- Modal -->
<div class="modal  modal-primary  fade" id="formModal" role="dialog" aria-labelledby="formModalLabel" >
  <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Tambah Data Dapil</h4>
              </div>
              <div class="modal-body">
                <!-- begin -->
                <div class="callout callout-warning">
                  <h4>Pesan</h4>
                  <p>Nomor Dapil Bersifat Unik, Tidak Boleh Sama !</p>
                </div>

                <form class="form-group" method="post" action="dapil/tambah" id="formx">
                  <div class="form-group">
                    <label>Dapil</label>
                    <input type="number" class="form-control" name="id_dapil" id="id_dapil" value="1" min="1" />
                  </div>
                <!-- end -->
                
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