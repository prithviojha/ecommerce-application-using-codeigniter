<!DOCTYPE html>
<html>
<head>
	<title>Place Order - CodeBit Shop</title>
	<?php $this->load->view('home/css-file');?>
    <style type="text/css">
    #input_box{border:1px solid silver;box-shadow: none;box-sizing: border-box;padding-left: 10px;padding-right: 10px;height: 40px;border-radius: 3px;}	
    textarea{border:1px solid silver;padding: 10px;outline: none;height: 90px;resize: none;}
    .card-contain{margin: 1%;}
    .card{padding: 1%;}
    input.waves-button-input {color: white;}
    </style>
    <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>

</head>
<body>
    <!-- body section -->
    <?php $this->load->view('home/header');?>
    <!-- place order -->
    	<div class="container">
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
        
    		<!-- card section -->
    		<div class="card">
    			<div class="card-contain" style="padding: 10px;border-bottom: 1px solid silver;">
    				<h6 style="font-size: 15px;color: grey;font-weight: 500;margin-top: 5px;">User Login & Register</h6>
    			</div>
                <?php if($this->session->userdata('email') == ""):?>
                <div class="card-contain" style="padding: 10px;border-bottom: 1px solid silver;">
                    <!-- button section -->
                    <div class="row" style="margin-top: 18px;margin-bottom: 0px;">
                        <div class="col l6 m6 s6">
                            <a href="<?= base_url('home/user_signup/cart');?>" class="btn waves-effect waves-light" style="font-size: 12px;text-transform: capitalize;font-weight: 500;width: 100%;background: #002366;box-shadow: none;height: 40px;">Register Account</a>
                        </div>
                        <div class="col l6 m6 s6">
                            <a href="<?= base_url('home/user_signin/cart');?>" class="btn waves-effect waves-light" style="font-size: 12px;text-transform: capitalize;font-weight: 500;width: 100%;background: black;box-shadow: none;height: 40px;">Login Account</a>
                        </div>
                    </div>
                    <!-- button section -->
                </div>
                <?php endif;?>
                
                <div class="card-contain" style="padding: 10px;border-bottom: 1px solid silver;">
                    <h6 style="font-size: 15px;color: grey;font-weight: 500;margin-top: 5px;">User Shipping Address</h6>
                </div>
                <?php if($this->session->userdata('email') != "" && $this->session->userdata('password') != ""): ?>
                <?php $this->load->helper('user');
                $user_detail = get_user_details($this->session->userdata('email'),$this->session->userdata('password'));
                //print_r($user_detail);
                //echo $user_detail[0]->address;
                //die();
                //if($user_detail):
                 $check_address = $this->db->get_where('ms_temp_address',['user_id'=>$user_detail[0]->id])->result();
                 if(count($check_address)):
                    $address = $check_address[0]->address;
                else:
                    $address = "";?>
                    <div class="card-contain" style="padding: 10px;border-bottom: 1px solid silver;">
                            <?= form_open('home/save_temp_address/'.$user_detail[0]->id);?>
                            <h6 style="font-size: 14px;color: grey; font-weight: 500;">Shipping Address</h6>
                            <textarea name="shipping_address"><?= $address ? $address : $user_detail[0]->address;?></textarea>
                            <button type="submit" class="btn waves-effect waves-light" style="background: black;text-transform: capitalize;margin-top: 10px;margin-bottom: 10px;">Save Address</button>
                              <?= form_close();?>
                         </div>
                           <?php //endif;?>
                        <?php endif;?>
                    <?php endif;?>
                    <div class="card-contain" style="padding: 10px;border-bottom: 1px solid silver;">
                       <h6 style="font-size: 15px;color: grey;font-weight: 500;margin-top: 5px;"> Complete Purchase </h6>
                    </div>
                    <div class="card-contain">
                        <?php
                        $t_amount = 0;
                        if(count($products)):
                            foreach($products as $product): 
                                $t_amount += ($product->quantity * $product->rate);
                                ?>
                        <h6 style="font-size: 14px;color:grey"><?= $product->product_name;?><b><span class="right"><span class="fa fa-rupee-sign">&nbsp;<?= number_format($product->rate * $product->quantity); ?></span></span></b></h6>
                    <?php endforeach;
                else: 
                    $t_amount = 0; ?>
                    <h6 style="text-align: center;">Products Not Found.</h6>
                <?php endif; ?>
                <h6>Grand Total<span class="right"><span class="fa fa-rupee-sign"></span>&nbsp;<?= number_format($t_amount); ?></span></h6>
                <?php 
                if($this->session->userdata('email') != "" && $this->session->userdata('password') != ""):
                $this->load->helper('user');
                $user_detail = get_user_details($this->session->userdata('email'),$this->session->userdata('password'));
                $check_address = $this->db->get_where('ms_temp_address',['user_id'=>$user_detail[0]->id])->result();
                if(count($check_address)):?>
                <h6>Select Payment Option</h6>
                <a href="<?= base_url('home/complete_purchased');?>" class="btn btn waves-effect waves-light" style="background: black;text-transform: capitalize;margin-top: 15px;">Cash On Delivery</a><br/>

                <form action="https://uat.esewa.com.np/epay/main" method="POST">


                    <?php
                        $t_amount = 0;

                        if(count($products)):
                            foreach($products as $product):
                                $data = ['product_id' =>$product->id];
                                ?> 
                                <?php
                                $pid = $product->id;
                                $t_amount += ($product->quantity * $product->rate);
                                
                                ?>
                       
                            <?php endforeach;?>
                            <input type="hidden" name="tAmt" value="<?= $t_amount; ?>">
                            <input type="hidden" name="amt" value="<?= $t_amount; ?>">
                            <?php else: 
                            $t_amount = 0; ?>
                            
                            <h6 style="text-align: center;">Products Not Found.</h6>
                            <?php endif; ?>


                    <!-- <input value="100" name="tAmt" type="hidden"> -->
                    <!-- <input value="90" name="amt" type="hidden"> -->
                    <input value="0" name="txAmt" type="hidden">
                    <input value="0" name="psc" type="hidden">
                    <input value="0" name="pdc" type="hidden">
                    <input value="<?= $pid; ?>" name="pid" type="hidden">

                    <input value="EPAYTEST" name="scd" type="hidden">
                    <input value="<?= base_url('home/esewa_purchased/'.$q='su');?>" type="hidden" name="su">
                    <input value="<?= base_url('home/esewa_purchased/'.$q='fu');?>" type="hidden" name="fu">
                    <input value="Pay with esewa" type="submit" class="btn btn waves-effect waves-light responsive-img" style="background: black;text-transform: capitalize;margin-top: 15px;">
                    

                </form>

                    </div>
                <?php endif;?>
                <?php endif;?>
                </div>
        
        </div>
    		<!-- place order -->
    <!-- user signup form -->
    <?php $this->load->view('home/footer');?>
    <!-- body section -->
	<?php $this->load->view('home/js-file');?>

</body>
</html>