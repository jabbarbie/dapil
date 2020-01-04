  <div id="infohalaman" data-jumlahdapil="<?php echo $jumlah_dapil?>" ></div>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
<!--       <h1>
        DASHBOARD
        <small></small>
      </h1> -->
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <div class="row">
             
          <?php for($i = 1;$i <= $jumlah_dapil; $i++): ?>
          <div class="col-sm-6">
            <div class="box box-warning">
            <div class="box-header with-border">
              <!-- <i class="fa fa-comments-o"></i> -->
              <h3 class="box-title">Dapil <?php echo $i ?></h3>
              
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas class="grafikdapil<?php echo $i?>" ></canvas>
              </div>
            </div>
            </div>
          </div>
        <?php endfor; ?>

        
        </div>
    </section>
    <!-- /.content -->
  </div>



  <!-- Ini untuk chatbox -->
  