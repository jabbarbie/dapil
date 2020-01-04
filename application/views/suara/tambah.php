<!-- Modal -->
<div class="modal  modal-warning fade" style="" id="formTPS" tabindex="-1" role="dialog" aria-labelledby="formTPSLabel" aria-hidden="true">
  <div class="modal-dialog">

            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">TPS - <span class='notpsx'>x</span></h4>
              </div>
              <div class="modal-body">
              <form class="form-group" method="post" action="suara/tambah" id="formx">
               <input type="hidden" name="id_suara" value="<?php echo $data['id_suara'] ?>">
               <input type="hidden" name="no_tps" value="0" id="notpsx">
               <input type="hidden" name="id_tps" value="0" id="id_tps">
               <input type="hidden" name="jumlah_caleg" value="<?php echo count($caleg) ?>">

               <input type="hidden" name="id_dapil" value="<?php echo $id_dapil ?>">
               <input type="hidden" name="id_suara" value="<?php echo $data['id_suara'] ?>">
               
               
               <table class="table table-bordered table-tps">
                  <?php foreach ($caleg as $key => $value): ?>
                    <tr>
                      <td><?php echo $value['no_urut'] ?></td>
                      <td><?php echo $value['nama'] ?></td>
                      <td width="10%">
                       <input type="number" class="form-control xnotps" id="no_urut<?php echo $key+1 ?>" name="suara[]" min="0" max="999" value="0">                        
                      </td>
                    </tr>
                  <?php endforeach ?>
                  
                  <tr>
                    <td colspan="2">Suara Partai</td>
                    <td><input type="number" name="suara_partai" id="suara_partai" class="form-control" min="0" max="999" value="0"  min="0" max="999" value="0"/></td>  
                  </tr>
                  <tr>
                    <td  colspan="2">Suara Tidak Sah</td>
                    <td><input type="number" name="suara_tidaksah" id="suara_tidaksah" class="form-control" min="0" max="999" value="0" /></td>  
                  </tr>
     
               </table>
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