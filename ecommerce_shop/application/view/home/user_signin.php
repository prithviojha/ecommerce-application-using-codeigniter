<!DOCTYPE html>
<html>
<head>
	<title>User Sign Up - CodeBit Shop</title>
	<?php $this->load->view('home/css-file');?>
    <style type="text/css">
    #input_box{border:1px solid silver;box-shadow: none;box-sizing: border-box;padding-left: 10px;padding-right: 10px;height: 40px;border-radius: 3px;}	
    textarea{border:1px solid silver;padding: 10px;outline: none;height: 90px;resize: none;}
    </style>
</head>
<body>
    <!-- body section -->
    <?php $this->load->view('home/header');?>
    <!-- user signup form -->
    <div class="row" style="margin-bottom: 0px;margin-top: 10px;">
    	<div class="col l4 m4 s12"></div>
    	<div class="col l4 m4 s12">
    		<!-- card section -->
    		<div class="card">
    			<div class="card-contain" style="margin-left: 10px; margin-right: 10px;padding-bottom: 10px;padding-top: 10px;">
                    <?= form_open('home/user_logged_in/'.$page);?>
    				<center>
	    				<h5><span class="fa fa-users"></span></h5>
	    				<h6 style="text-transform: capitalize;">SignIn Account</h6>
    				</center>
    				
    				<h6 style="font-size: 14px;color: grey;font-weight: 500;">Username / Email</h6>
    				<input type="text" name="email" id="input_box" placeholder="Email Address">
    				
    				<h6 style="font-size: 14px;color: grey;font-weight: 500;">Password</h6>
    				<input type="Password" name="Password" id="input_box" placeholder="xxxxxxxx">
    				
    				 <button type="submit" class="btn waves-effect" style="background: black;width: 100%;box-shadow: none;margin-bottom: 5px;text-transform: capitalize;">Sign In</button>
                    <h6 style="font-size: 14px;color: grey;font-weight: 500;text-align: center;text-transform: capitalize;">I don't have an Account</h6>
                    <a href="<?= base_url('home/user_signup') ;?>" class="btn waves-effect" style="background: #002366;width: 100%;box-shadow: none;margin-bottom: 5px;text-transform: capitalize;">Create an Account</a>
                    <?= form_close();?>
    			</div>
    		</div>
    		<!-- card section -->
        </div>
    	<div class="col l4 m4 s12"></div>
    </div>
    <!-- user signup form -->
    <?php $this->load->view('home/footer');?>
    <!-- body section -->
	<?php $this->load->view('home/js-file');?>

</body>
</html>