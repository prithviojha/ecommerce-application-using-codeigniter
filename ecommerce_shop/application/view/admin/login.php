<!DOCTYPE html>
<html>
<head>
    <title>Admin Login - CodeBit Shop</title>
    <?php $this->load->view('home/css-file');?>
    <style type="text/css">
      body{background: #002366;padding: 10px;}
      #input_box{border: 1px solid;background: white;color: black;box-shadow: none;padding-left: 10px;padding-right: 10px;width: 100%;margin: 0 auto;border-radius: 2px;box-sizing: border-box;height: 40px;}
    </style>
</head>
<body>
<!-- body section -->
<!-- login form -->
<div class="container">
  <div class="row" style="margin-top: 5%;">
    <div class="col l3 m3 s12"></div>
    <div class="col l6 m6 s12">
      <div class="card">
        <div class="card-content">
      <h3 class="center-align black-text" style="margin-bottom: 5px;"><span class="fa fa-users"></span></h3>
      <h5 class="center-align black-text" style="margin-top: 0px;">Admin Login</h5>
      <div style="margin-top: 25px;">
        <h6 style="font-size: 14px;font-weight: 500;color: black;">Username / Email</h6>
        <input type="text" name="username" id="input_box" placeholder="USERNAME / EMAIL">
        <h6 style="font-size: 14px;font-weight: 500;color: black;margin-top: 15px;">Password</h6>
        <input type="password" name="password" id="input_box" placeholder="XXXXXXXXXX">
        <center>
          <button type="button" class="btn waves-effect waves-light" id="btn_signin" style="background: black;color: white;margin-top: 15px;text-transform: capitalize;height: 40px;line-height: 40px;width: 40%;">sign in&nbsp;&nbsp;<span class="fa fa-sign-in-alt"></span></button>
        </center>
      </div>
      <br/>
      <h6 style="font-size: 14px;font-weight: 500;color: black;margin-top: 15px;text-align: center;">About Us</h6>
      <p style="color: black;margin-top: 0px;text-align: center;">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
      tempor incididunt ut labore et dolore magna aliqua.</p>
    </div>
    </div>
    </div>
    <div class="col l3 m3 s12"></div>
  </div>
</div>
<!-- login form -->
<!-- body section -->
<?php $this->load->view('home/js-file');?>
<?php $this->load->view('admin/custom_js');?>
</body>
</html>