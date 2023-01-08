<style type="text/css">
	#topbar{background:#002366;padding: 2px;}
		#my_account_dropdown{width: 12%!important;padding-top: 10px;padding-bottom: 10px;}
		#my_account_dropdown li a{color: grey;font-size: 14px;}
		#search_bar{background:#002366;}
		#search_bar #logo{font-size: 30px;font-weight: 700;color: white;}
		#search_form{display: flex;}
		#search_form li:first-child{width: 400px;}
		#search{background: white;padding-left: 10px;padding-right: 10px;box-shadow: none;box-sizing: border-box;height: 40px;border-bottom: none;margin-bottom: 0px;font-size: 14px;}
		nav{background: black;height: 40px;line-height: 40px;box-shadow: none;}
		#show_product_list{background: white;margin-top: 0px;position: absolute;z-index: 99;width: 400px;display: none;}
		#show_product_list a{display: block;font-size: 14px;color: grey;font-weight: 500;padding-left: 15px;line-height: 35px;}
		#show_product_list a:hover{background: rgba(0, 0, 0, 0.05);}
</style>
<!-- topbar section -->
	<div id="topbar">
		<h6 style="color: white;font-size: 14px;font-weight:500;margin-top: 5px;padding-left: 15px;" ><span class="fa fa-mobile"></span>&nbsp;+9779864037363&nbsp;&nbsp;<span class="fa fa-envelope"></span> codebitnp@gmail.com<span class="right" style="padding-right: 15px;"> <a href="#!" class="dropdown-trigger" data-target="my_account_dropdown" style="color: white;"> <span class="fa fa-user"></span> My Account</a></span></h6>
		<!-- my account dropdown -->
		<ul class="dropdown-content" id="my_account_dropdown">
			<?php if($this->session->userdata('email') == "" && $this->session->userdata('password') == ""):?>
			<li><a href="<?= base_url('home/user_signup');?>" class="waves-effect"><span class="fa fa-user-plus"></span>&nbsp;Register</a></li>
			<li><a href="<?= base_url('home/user_signin');?>" class="waves-effect"><span class="fa fa-sign-in-alt"></span>&nbsp;Login</a></li>
			<?php else: ?>
				<li><a href="<?= base_url('home/dashboard');?>" class="waves-effect"><span class="fa fa-home"></span>&nbsp;Dashboard</a></li>
				<li><a href="<?= base_url('home/carts');?>" class="waves-effect"><span class="fa fa-shopping-cart"></span>&nbsp;Carts</a></li>
				<li><a href="<?= base_url('home/my_orders');?>" class="waves-effect"><span class="fa fa-truck"></span>&nbsp;My Order's</a></li>
				<li><a href="<?= base_url('home/logout');?>" class="waves-effect"><span class="fa fa-sign-out-alt"></span>&nbsp;Logout</a></li>
		<?php endif; ?>
		</ul>
		<!-- my account dropdown -->
	</div>
	<!-- topbar section -->
	<!-- search bar section -->
	<div id="search_bar">
	<div class="row" style="margin-bottom: 0px;">
		<div class="col l3 m3 s12">
			<h6 style="margin-top: 22px;"> <a href="<?= base_url();?>" id="logo">CodeBit Shop</a></h6>
		</div>
		<div class="col l6 m6 s12">
			<!-- search product form -->
			<ul id="search_form">
				<li>
					<input type="text" name="search" id="search" placeholder="search your product" autocomplete="off" onkeyup="search_products(this.value)">
					<div id="show_product_list">
						<a href="">Product name</a>
						<a href="">Product name</a>
						<a href="">Product name</a>
						<a href="">Product name</a>
						<a href="">Product name</a>
						<a href="">Product name</a>
					</div>
				</li>
				<li>
					<button type="submit" class="btn waves-effect waves-light" style="box-shadow: none;background: black;text-transform: capitalize;height: 40px;font-weight: 400;">Search now</button>
				</li>
			</ul>
			<!-- search product form -->
		</div>
		<div class="col l3 m3 s12">
			<h6 style="font-size: 14px;color: white;text-align: center;line-height: 18px;font-weight: 500;margin-top: 15px;"><a href="<?=base_url('home/carts');?>" style="color: white;"><span class="fa fa-shopping-cart"></span>&nbsp;Shopping Cart</a><br/>
				<span id="total_products">0</span> Items - <span class="fa fa-rupee-sign"></span><span id="total_amount">0</span></a></h6>
		</div>
	</div>
	</div>
	<!-- search bar section -->
	<!-- menu bar section -->
	<nav>
		<div class="nav-wrapper">
			<!-- left side menu -->
			<ul class="left"> 
				<li><a href="">Home</a></li>
				<li><a href="">Company Profile</a></li>
				<li><a href="">Our Policies</a></li>
				<li><a href="">Offers</a></li>
				<li><a href="">Contact Us</a></li>
			</ul>
			<!-- left side menu -->

		</div>
	</nav>
	<!-- menu bar section -->
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