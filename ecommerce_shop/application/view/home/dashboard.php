<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - CodeBit Shop</title>
    <?php $this->load->view('home/css-file');?>
    <style type="text/css">
      body{background: #afeeee;}
    </style>
</head>
<body>
<!-- body section -->
<?php $this->load->view('home/header');?>
 
<?php 
$args = [
'email' => $_SESSION['email'],
'password' => $_SESSION['password']
];
$result['user_details'] = $this->cm->fetch_records_by_args('ms_users',$args);
//print_r($result);
//die();
?>
<!-- card section -->
<!-- ----------from site--------- -->
<!-- navbar section --><h5 style="padding-left: 10px;">Welcome to User Panel</h5>
<!-- two cart section -->
<div class="row" style="margin-bottom: 0px;">
   <?php
        if($this->session->flashdata('success')):
        $msg = $this->session->flashdata('success');
        ?>
        <!-- message section -->
        <div class="card success">
        <div class="card-content" style="padding:10px;padding-left:15px;">
        <h6 style="font-size: 15px;font-weight: 500;margin-top: 5px;"><span class="fa fa-check-circle green-text"></span>&nbsp;<?= $msg; unset($_SESSION['success']); ?></h6>
        </div>
        </div>
        <!-- message section -->

        <?php endif; ?>
        <?php if($this->session->flashdata('error')):
        $msg = $this->session->flashdata('error');
        ?>
        <!-- Error message section -->
        <div class="card success">
            <div class="card-content" style="padding:10px;padding-left:15px;">
                <h6 style="font-size: 15px;font-weight: 500;margin-top: 5px;"><span class="fa fa-exclamation-triangle red-text"></span>&nbsp;<?= $msg; unset($_SESSION['error']) ?></h6>
            </div>
        </div>
        <!-- Error message section -->
        <?php endif; 
        ?>
  <div class="col l3 m4 s12">
    <div class="card waves-effect" style="margin-bottom: 8px;width: 100%;">
      <div class="card-content">
        <!-- my cart section -->
        <div class="row" style="margin-bottom: 0px;">
          <div class="col l5 m5 s5">
            <h3 style="margin-top: 0px;"><span class="fa fa-shopping-cart" style="color: #ff3d00;"></span></h3>
          </div>
          <div class="col l7 m7 s7">
            <h6 style="text-align: right;margin-top: 0px;font-size: 15px;font-weight: 500;color: grey;">My Cart</h6>
            <h4 style="text-align: right;margin-top: 0px;"><?= count($cart_products);?></h4>
          </div>
        </div>
        <!-- my cart section -->
      </div>
      <div class="card-action">
        <a href="<?= base_url('home/carts');?>" style="text-transform: capitalize;">View Cart</a>
      </div>
    </div>
  </div>

  <div class="col l3 m4 s12">
    <div class="card waves-effect" style="margin-bottom: 8px;width: 100%;">
      <div class="card-content">
        <!-- my cart section -->
        <div class="row" style="margin-bottom: 0px;">
          <div class="col l5 m5 s5">
            <h3 style="margin-top: 0px;"><span class="fa fa-gift" style="color: #ff3d00;"></span></h3>
          </div>
          <div class="col l7 m7 s7">
            <h6 style="text-align: right;margin-top: 0px;font-size: 15px;font-weight: 500;color: grey;">My Order's</h6>
            <h4 style="text-align: right;margin-top: 0px;"><?= count($orders);?></h4>
          </div>
        </div>
        <!-- my cart section -->
      </div>
      <div class="card-action">
        <a href="<?= base_url('home/my_orders');?>" style="text-transform: capitalize;">View Order's</a>
      </div>
    </div>
  </div>

  <div class="col l3 m4 s12">
    <div class="card waves-effect" style="margin-bottom: 8px;width: 100%;">
      <div class="card-content">
        <!-- my cart section -->
        <div class="row" style="margin-bottom: 0px;">
          <div class="col l5 m5 s5">
            <h3 style="margin-top: 0px;"><span class="fa fa-gift" style="color: #ff3d00;"></span></h3>
          </div>
          <div class="col l7 m7 s7">
            <h6 style="text-align: right;margin-top: 0px;font-size: 15px;font-weight: 500;color: grey;">Delivered Order's</h6>
            <h4 style="text-align: right;margin-top: 0px;"><?= count($delivered_orders) ;?></h4>
          </div>
        </div>
        <!-- my cart section -->
      </div>
      <div class="card-action">
        <a href="<?= base_url('home/my_orders');?>" style="text-transform: capitalize;">View Order's</a>
      </div>
    </div>
  </div>

  <div class="col l3 m4 s12">
    <div class="card waves-effect" style="margin-bottom: 8px;width: 100%;">
      <div class="card-content">
        <!-- my cart section -->
        <div class="row" style="margin-bottom: 0px;">
          <div class="col l5 m5 s5">
            <h3 style="margin-top: 0px;"><span class="fa fa-user" style="color: #ff3d00;"></span></h3>
          </div>
          <div class="col l7 m7 s7">
            <?php foreach($result as $res) :
              //print_r($usr_details);
              ?>
            <h6 style="text-align: center;margin-top: 0px;font-size: 15px;font-weight: 500;color: grey;"><?= $res[0]->fullname != '' ? $res[0]->fullname : 'My Profile' ?></h6>
            <h4 style="text-align: center;margin-top: 0px;font-size: 15px;font-weight: 500;color: grey;"><?= $res[0]->email ?> <?= $res[0]->mobile_no ?>,<?= $res[0]->address ?></h4>

          <?php endforeach; ?>
          </div>
        </div>
        <!-- my cart section -->
      </div>
      <div class="card-action">
        <a href="" style="text-transform: capitalize;">Profile</a>
      </div>
    </div>
  </div>
</div>
<!-- two cart section -->
<div class="container" style="margin-bottom: 15px;">
<h6 class="center-align" style="font-size: 14px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat.</h6>
</div>
<!-- ---------------from site------------ -->
<!-- card section -->
<?php $this->load->view('home/footer');?>
<!-- body section -->
<?php $this->load->view('home/js-file');?>

</body>
</html>