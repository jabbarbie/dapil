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
            <div class="col-sm-3">
            <div class="box box-danger">
              <!-- <div class="box-header with-border">
                <h3 class="box-title">Caleg</h3>
              </div> -->
              <div class="box-body">
                
                <ol class="daftarcaleg">
                  <?php foreach ($caleg as $key => $value): ?>
                   <li><?php echo substr($value['nama'],0,24) ?>
                     
                     <a href=""><img src="<?php echo base_url('assets/images/foto_caleg/').$value['foto'] ?>" width=17px class="pull-right"></a>
                   </li>
                  <?php endforeach ?>
                </ol>


              </div>

            </div>
            

          </div>
            
          <div class="col-sm-9">
            
            <div class="box box-warning">
            <div class="box-header with-border">
              <!-- <i class="fa fa-comments-o"></i> -->
              <h3 class="box-title">Dapil <?php echo $this->session->userdata('id_dapil') ?></h3>
              
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="grafikdapil"  style="height: 255px; width: 567px;" width="1134" height="510">
                  
                </canvas>
              </div>
            </div>
            <!-- /.box-body -->
            </div>

          </div>
        
        </div>
    </section>
    <!-- /.content -->
  </div>



  <!-- Ini untuk chatbox -->
  