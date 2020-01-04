<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Administrator - Login</title>
  
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Montserrat:400,700'>
     <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url('assets/images') ?>/favicon-16x16.png">


    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/login/style.css">
</head>

<body>

  
<div class="container">
  <div class="info">
    <!-- <h1>PARTAI GERINDA</h1> -->
    <!-- <span>Made with <i class="fa fa-heart"></i> by <a href="http://andytran.me">Andy Tran</a></span> -->
  </div>
</div>
<div class="form">
  <!-- <div class="thumbnail"><img src="<?php echo base_url() ?>assets/images/logo2.png" /></div> -->
  <div class="thumbnail"><img src="<?php echo base_url() ?>assets/images/logo2.png" /></div>
  
  <form class="login-form" method="post" action="login/ceklogin" autocomplete="off">
    <input type="text" name="username" placeholder="username"  value="" autocomplete="off" />
    <input type="password" name="pass" placeholder="password"/>
    <button>LOGIN</button>
    <!-- <p class="message">Not registered? <a href="#">Create an account</a></p> -->
  </form>
</div>
  <script  src="<?php echo base_url() ?>assets/dist/js/login/index.js"></script>
</body>

</html>
