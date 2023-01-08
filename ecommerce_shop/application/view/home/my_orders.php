<!DOCTYPE html>
<html>
<head>
    <title>My Orders - CodeBit Shop</title>
    <?php $this->load->view('home/css-file');?>
    <style type="text/css">
      body{background: #afeeee;}
    </style>
</head>
<body>
<!-- body section -->
<?php $this->load->view('home/header');?>
<!-- card section -->
<h4 style="padding-left: 10px;font-size: 25px;">My Orders(<?= count($orders);?>)</h4>
 <div class="container">
  <?php if(count($orders)):
    foreach($orders as $ord):?>
   <!-- card section -->
   <div class="card">
     <div class="card-content" style="border-bottom: 1px solid silver;">
       <a href="" class="btn waves-effect waves-light" style="background: #002366;box-shadow: none;">Order Id - <?= $ord->id ;?></a>
       <a href="" class="btn waves-effect waves-dark right" style="background: no-repeat;color: grey;box-shadow: none;border:1px solid silver;">Track Order</a>
     </div>
     <div class="card-content" style="border-bottom: 1px solid silver;">
      <?php $this->load->helper('product');
      $order_items = get_order_products('ms_order_products',$ord->id); ?>
      <?php if(count($order_items)):
          foreach($order_items as $ord_item) :
            //print_r($ord_item);
            //die();
            ?>
       <div class="row" style="margin-bottom: 0px;">
         <div class="col l2 m3 s12">
          <?php
           $get_product_detail = get_product_detail($ord_item->product_id);
           foreach($get_product_detail as $get_pro_detail) : 
           // print_r($get_product_detail);
           ?>
           <img src="<?=base_url('uploads/product_image/'.$get_pro_detail->image);?>" class="responsive-img" style="height: 100px;width: 100px;">
         <?php endforeach;?>
         </div>
         <div class="col l5 m5 s12">
           <h5 style="font-size: 20px;font-weight: 500;"><?= $ord_item->product_name;?></h5>
           <h6 style="font-size: 14px;color: grey;margin-top: 0px;">Quantity : <?= $ord_item->quantity;?></h6>
         </div>
         <div class="col l5 m4 s12">
           <h5 style="font-size: 20px;font-weight: 500;"><span class="fa fa-rupee-sign"></span>&nbsp;<?= $ord_item->rate;?> Per Unit</h5>
           <h6 style="font-size: 14px;color: grey;margin-top: 0px;">
           <?php if($ord->order_status == "Delivered"):
              $status = "Delivered"; ?>
            <?php else:
              $status = "Not Delivered";?>
            <?php endif; ?>
            Your Product is <?= $status; ?></h6>
         </div>
       </div>
     <?php endforeach;
   else: ?>
    <h6 style="text-align: center;">Product Not Found.</h6>
  <?php endif;?>
     </div>
    <div class="card-content" style="padding: 10px;">
      <h6 style="margin-top: 5px;">Ordered on : <b><?= date('D, M. d Y',strtotime($ord->order_date));?></b><span class="right">Order Total : <b><span class="fa fa-rupee-sign">&nbsp;<?= number_format($ord->total_amount);?></b></span></span></h6>
    </div>

   </div>
   <!-- card section -->
 <?php endforeach;
    else:?>
      <h6 style="text-align: center;">Orders Not Found</h6>
    <?php endif; ?>
 </div>
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