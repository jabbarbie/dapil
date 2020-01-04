<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SISLEG - <?php echo $judul??''; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/skins/skin-yellow.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/DataTables/css/datatables.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/sweet/sweetalert2.min.css">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url('assets/images') ?>/favicon-16x16.png">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/styleku.css" />
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  
  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="skin-yellow sidebar-mini fixed style-2   modal-show     pace-done pace-done">
<div class="wrapper">
  <header class="main-header">

    <!-- Logo -->
    <a href="<?php echo base_url(); ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>D</b>1</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>PKY - <?php echo strtoupper($this->session->userdata('username')) ?></b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->

          <li >
            <a href="#" class="" data-toggle="">
              <span class="hidden-xs"><?php echo date('l, d F Y') ?> - </span><span id="jam"></span>
            </a>
            
          </li>
        </ul>

      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
    

     

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <?php $urlnya = $this->uri->segment(1) ?>

        <li class="header">DATA UMUM</li>
        <li class="<?php echo ($urlnya == '')?'active':'' ?>"><a href="<?php echo base_url() ?>"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
        
        <?php if ($this->session->userdata('username') != 'admin'): ?>                  
        <li class="<?php echo ($urlnya == 'suara')?'active':'' ?>"><a href="<?php echo base_url() ?>suara"><i class="fa fa-check"></i> <span>Perolehan Suara</span></a></li>
        <?php endif ?>

        <?php if ($this->session->userdata('username') == 'admin'): ?>          
        <li class="header">DATA MASTER</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="<?php echo ($urlnya == 'dapil')?'active':'' ?>"><a href="<?php echo base_url() ?>dapil"><i class="fa fa-map"></i> <span>Daerah Pemilihan</span></a></li>
        <li class="<?php echo ($urlnya == 'caleg')?'active':'' ?>"><a href="<?php echo base_url() ?>caleg"><i class="fa fa-user"></i> <span>Calon Legislatif</span></a></li>
      
        <!-- <li><a href="<?php //echo base_url() ?>tps"><i class="fa fa-user"></i> <span>TPS</span></a></li> -->
        <li class="<?php echo ($urlnya == 'kecamatan')?'active':'' ?>"><a href="<?php echo base_url() ?>kecamatan"><i class="fa fa-map"></i> <span>Kecamatan</span></a></li>
        <li class="<?php echo ($urlnya == 'kelurahan')?'active':'' ?>"><a href="<?php echo base_url() ?>kelurahan"><i class="fa fa-user"></i> <span>Kelurahan</span></a></li>
        
        <?php endif ?>

        <li class="header">REKAP</li>
        <li class="<?php echo ($urlnya == 'rekapsuara')?'active':'' ?>"><a href="<?php echo base_url() ?>rekapsuara"><i class="fa fa-book"></i> <span>Rekapitulasi Suara</span></a></li>      

        <li class="header">PENGATURAN </li>
        <li><a href="<?php echo base_url() ?>login/logout"><i class="fa fa-user"></i> <span>Keluar </span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->

  <!-- /.content-wrapper -->


  <!-- Control Sidebar -->
  