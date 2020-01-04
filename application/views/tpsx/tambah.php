<!-- Modal -->
<div class="modal  modal-primary fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
  <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Tambah Data TPS</h4>
              </div>
              <div class="modal-body">
                <form>
                 
                  <div class="form-group">
                    <label>Kecamatan</label>
                    <select class="form-control">
                      <option>Jekan Raya 1</option>
                      <option>Jekan Raya 2</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Kelurahan</label>
                    <select class="form-control">
                      <option>Palangka Raya</option>
                    </select>
                  </div>


                  
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary">Simpan</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
</div>

<!-- Modal -->
<button type="button" class="btn btn-danger btn-flat btnTambah" data-toggle="modal" data-target="#formModal" >
  Tambah TPS
</button