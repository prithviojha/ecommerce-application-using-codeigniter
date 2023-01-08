<!DOCTYPE html>
<html>
<head>
	<title>Cart(2) - CodeBit Shop</title>
	<?php $this->load->view('home/css-file');?>
    <style type="text/css">
      body{background: #002366;}
      .btn-flat:hover{background: #002366;color: white;}
      #quantity_form{display: flex;}
      #quantity_form li{margin: 2px;}
      #input-box{border:1px solid silver;box-shadow: none;box-sizing: border-box;padding-left: 10px;padding-right: 10px;height: 40px;border-radius: 3px;} 
      .card{padding: 1%;}  
    </style>
</head>
<body>
<!-- body section -->
<?php $this->load->view('home/header');?>
<!-- cart section -->
<div class="row" style="margin-bottom: 0px;margin-top: 10px;">
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
        <div class="col xl8 l8 m8 l12">
            <!-- card section -->
            <div class="card">
                <div class="card-content" style="padding: 10px; border-bottom: 1px solid rgba(0,0,0,0.1);">
                <h5 style="font-size: 20px;margin-top: 5px;">My Cart (<?= count($products);?>)</h5>
                </div>
                <div class="card-content">
                <?php if(count($products)):
                foreach($products as $pro):
                $product_detail = get_product_detail($pro->product_id);?>
                <div class="row">
                    <div class="col l3 m3 s12">
                        <img src="<?= base_url().'uploads/product_image/'.$product_detail[0]->image; ?>" class="responsive-img">
                         <!-- quantity form -->
                        <ul id="quantity_form">
                            <li>
                                <button type="button" class="btn btn-floating" onclick="update_quantity('sub','<?= $pro->product_id;?>','<?= $pro->id; ?>')" style="background:#002366;box-shadow: none;">-</button>
                            </li>
                            <input type="text" name="quantity_<?= $pro->id; ?>" id="input-box" value="<?= $pro->quantity;?>" readonly>
                            <li>
                                <button type="button" class="btn btn-floating" onclick="update_quantity('add','<?= $pro->product_id ;?>','<?= $pro->id; ?>')" style="background:#002366;box-shadow: none;">+</button>
                            </li>
                        </ul>
                    <!-- quantity form -->
                    </div>
                    <div class="col l9 m9 s12">
                        <h6 style="font-size: 15px;font-weight: 500;"><?= $pro->product_name;?></h6>
                        <h5 style="font-size: 20px;"><b><span class="fa fa-rupee-sign">&nbsp;<?php $calculate = $pro->quantity * $pro->rate; echo  number_format($calculate);?></b></span></h5>
                        <h6 style="font-size: 14px;color: silver;"><?= $pro->quantity;?> Item x <?= number_format($pro->rate);?></h6>
                        <a href="<?= base_url('home/product_detail/'.$pro->product_id);?>" class="btn btn-flat" target="_blank">View Item</a>
                        <a href="<?= base_url('home/remove_product/'.$pro->product_id);?>" class="btn btn-flat">Remove Item</a>
                    </div>
                    </div>
                    <?php endforeach;
                    else: ?>
                    <center>
                        <h3><span class="fa fa-shopping-cart" style="color: #002366;"></span></h3>
                        <h6 style="font-size: 14px;font-weight: 500">Your Cart is Empty? <a href="<?= base_url('index'); ?>">Start Shopping Now</a></h6>
                    </center>
                    <?php endif; ?>
                </div>
            </div>
        <!-- card section -->
        </div>
        <div class="col xl4 l4 m4 l12">
        <!-- card section -->
        <div class="card">
        <div class="card-content" style="padding: 10px; border-bottom: 1px solid rgba(0,0,0,0.1);">
            <h5 style="font-size: 20px;margin-top: 5px;">Price Details</h5>
        </div>
        <div class="card-content">
            
            <h6 style="font-size: 15px;font-weight: 500;margin-top: 0px;border-bottom: 1px dashed silver;padding-bottom: 15px;">Price (<?= count($products);?> Items)<span class="right"><span class="fa fa-rupee-sign"></span>&nbsp;
                <?php if(count($products)):
                    $t_amount = 0;
                    foreach($products as $cpro):
                    $t_amount += ($cpro->quantity * $cpro->rate);
                endforeach;
            else:
                $t_amount = 0;
            endif;
            echo ($t_amount > 0) ? number_format($t_amount) : '0'; ?>
            </span></h6>
            <h5 style="font-size: 20px;font-weight: 500;border-bottom: 1px dashed silver;padding-bottom: 15px;">Total Amount<span class="right"><span class="fa fa-rupee-sign"></span>&nbsp;<?= ($t_amount > 0) ? number_format($t_amount) : '0'; ?></span></h5>
           <!-- button section -->
            <div class="row" style="margin-top: 18px;margin-bottom: 0px;">
                <?php if(count($products)): ?>
                <div class="col l6 m6 s6">
                    <a href="<?= base_url('index');?>" class="btn waves-effect waves-light" style="font-size: 12px;text-transform: capitalize;font-weight: 500;width: 100%;background: #002366;box-shadow: none;height: 40px;">Continue Shopping</a>
                </div>
                <div class="col l6 m6 s6">
                    <a href="<?= base_url('home/place_order');?>" class="btn waves-effect waves-light" style="font-size: 12px;text-transform: capitalize;font-weight: 500;width: 100%;background: black;box-shadow: none;height: 40px;">Place Order</a>
                </div>
            <?php else: ?>
                <div class="col l12 m12 s12">
                    <a href="<?= base_url('home/index');?>" class="btn waves-effect waves-light" style="font-size: 12px;text-transform: capitalize;font-weight: 500;width: 100%;background: black;box-shadow: none;height: 40px;">Continue Shopping</a>
                </div>
            <?php endif;?>
            </div>
            <!-- button section -->
        </div>
        </div>
        <!-- card section -->
        </div>
</div>
<!-- cart section -->
<?php $this->load->view('home/footer');?>
<!-- body section -->
<?php $this->load->view('home/js-file');?>

</body>
</html>