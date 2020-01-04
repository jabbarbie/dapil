<!-- Modal -->
<div class="modal  modal-primary fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Tambah Kecamatan</h4>
      </div>
      <div class="modal-body">
      <form class="form-group" method="post" action="kecamatan/tambah" id="formx">  
       
      <div class="form-group">
          <input type="hidden" id="pk" value="" name="id_kecamatan">
          <div class="form-group">
            <label>Kecamatan</label>
            <input class="form-control" id="kecamatan" name='kecamatan' placeholder="Masukkan nama kecamatan" />
          </div>
          

        
      </div>
    
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