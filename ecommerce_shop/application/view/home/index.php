<?php $this->load->helper('product');?>
<!DOCTYPE html>
<html>
<head>
	<title>Home - CodeBit Shop</title>
	<?php $this->load->view('home/css-file');?>
	<style type="text/css">
		body{background: #ffebe5;}
		.btn-flat:hover{background: #002366;color: white;}
		
	</style>
</head>
<body>
	<!-- body section -->
	<?php $this->load->view('home/header');?>
	<!-- image slider section -->
		
	<div class="carousel carousel-slider center">
    
    <div class="carousel-item red white-text" href="#one!">
      <img src="<?= base_url('assets/images/banner1.jpg');?>" class="responsive-img">
    </div>
     <div class="carousel-item red white-text" href="#one!">
      <img src="<?= base_url('assets/images/banner2.jpg');?>" class="responsive-img">
    </div>
   
    </div>
    <!-- image slider section -->
	<!-- category section -->
	<div class="row" style="margin-top: 15px;">
		<?php if(count($categories)):
      foreach($categories as $cate):  
		?>
		<div class="col l3 m6 s12">
             <!-- cart section -->
             <div class="card waves-effect" style="box-shadow: none;">
             	<div class="card-contain" style="padding: 5px;padding-left: 10px;">
             		<div class="row" style="margin-bottom: 0px;">
             			<div class="col l7 m7 s7">
             				<h6 style="font-size: 15px;color: black;margin-top: 5px;"><?= $cate->category_name?></h6>
             				<?php $count_products = get_category_products($cate->id); ?>
             				<h6 style="font-size: 14px;color: grey;margin-top: 5px;"><?= count($count_products);?>  Products</h6>
             				<a href="<?= base_url('home/category_products/'.$cate->id);?>" class="btn waves-effect waves-light" style="background:#002366;box-shadow: none;margin-top: 10px;">View More</a>
             			</div>
             			<div class="col l5 m5 s5">
             				<img src="<?=base_url().'uploads/category_image/'.$cate->image;?>" class="responsive-img" style="border:none; width: 100%;margin-top: 5px;height: 90px;">
             			</div>
             		</div>
             	</div>
             </div>
             <!-- cart section -->
		</div>
		<?php endforeach; 
	else:?>
		<h6>Categories not found</h6>
	<?php endif; ?>
	</div>
	<!-- category section -->
	<?php if(count($categories)):
		foreach($categories as $cate):?>
	<!-- category product list section -->
	<div class="row">
		<h5 style="padding-left: 15px;font-size: 22px;font-weight: 500;"><?= $cate->category_name; ?><span class="right"><a href="<?= base_url('home/category_products/'.$cate->id);?>" class="btn waves-effect" style="margin-right: 12px;background: black;">View More</a></span></h5>
		<?php
		$products = get_category_products($cate->id);
		if(count($products)):
			foreach($products as $pro):
		?>
		<div class="col l2 m3 s6">
			<!-- card section -->
			<a href="<?= base_url('home/product_detail/'.$pro->id);?>" target="_blank">
			<div class="card">
				<div class="card-image">
					<img src="<?= base_url().'uploads/product_image/'.$pro->image;?>" class="responsive-img" style="width: 100%;height: 190px;">
				</div>
				<div class="card-contain" style="padding: 10px; border-bottom: 1px solid silver;">
					<h6 style="font-size: 15px;color: black;margin-top: 5px;"><?= $pro->product_title; ?></h6>
					<h6 style="font-size: 14px;color: grey;margin-top: 5px;"><?= $pro->category_name; ?></h6>
					<h5 style="font-size: 20px;color: green;font-weight: 500;margin-top: 5px;margin-bottom: 5px;"><span class="fa fa-rupee-sign"></span>&nbsp;<?= number_format($pro->price);?></h5>
				</div>
				<div class="card-contain" style="padding: 3px;">
					<center>
						<a href="#!" class="btn btn-flat btn-floating waves-effect" onclick="add_to_cart('<?= $pro->id; ?>')"><span class="fa fa-shopping-cart"></span></a>
						<a href="#!" class="btn btn-flat btn-floating waves-effect" onclick="view_product_details('<?= $pro->id; ?>')"><span class="fa fa-eye"></span></a>
                    </center>
				</div>
			</div>
			</a>
			<!-- card section -->
		</div>
	<?php endforeach;
else: ?>
	<h6 style="padding-left: 15px;font-size: 14px;font-weight: 500;">Product Not Found.</h6>
<?php endif;?>

	</div>
	<!-- category product list section -->
    <?php endforeach; ?>
    <?php else: ?>
		<h6>Category Not Found.</h6>
	<?php endif; ?>
     <?php $this->load->view('home/footer');?>
	<!-- body section -->
    <?php $this->load->view('home/js-file');?>

    
 	
 </body>
</html>