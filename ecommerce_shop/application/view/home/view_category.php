<!DOCTYPE html>
<html>
<head>
    <title><?= (count($category_detail)) ? $category_detail[0]->category_name.' Products' : 'Category Not Found.';?> - CodeBit Shop</title>
    <?php $this->load->view('home/css-file');?>
    <style type="text/css">
      body{background: #002366;}
      .btn-flat:hover{background: #002366;color: white;}
      #category_filter{padding-top: 10px;padding-bottom: 10px;}
      #category_filter li a{color: grey;font-size: 14px;}
    </style>
</head>
<body>
    <!-- body section -->
    <?php $this->load->view('home/header');?>
    <!-- cart section -->
        
            <!-- card section -->
            <div class="card" style="margin-top: 10px;">
               <div class="card-content" style="padding: 10px;border-bottom: 1px solid silver;">
                <h5 style="margin-top: 5px;"><?= (count($category_detail)) ? $category_detail[0]->category_name.' Products' : 'Category Not Found.';?><span class="right"><button type="button" class="btn btn-flat waves-effect waves-light  dropdown-trigger" data-target="category_filter" style="text-transform: capitalize;font-weight: 500;"><span class="fa fa-filter"></span>&nbsp;Product Filter</button></span></h5>
                <?php
                $cate_id = (count($category_detail)) ? $category_detail[0]->id : '0';
                ?>
                <!-- category filter dropdown -->
                <ul class="dropdown-content" id="category_filter">
                    <li><a href="<?= base_url('home/product_filter/'.$cate_id.'/default');?>" class="waves-effect">Default Products</a></li>
                    <li><a href="<?= base_url('home/product_filter/'.$cate_id.'/best_match');?>" class="waves-effect">Best Match</a></li>
                    <li><a href="<?= base_url('home/product_filter/'.$cate_id.'/lowest_price');?>" class="waves-effect">Lowest Price</a></li>
                    <li><a href="<?= base_url('home/product_filter/'.$cate_id.'/highest_price');?>" class="waves-effect">Highest Price</a></li>
                </ul>  
                <!-- category filter dropdown -->
               </div>
               <div class="card-content" style="padding: 0px;margin-top: 10px;">
                 <div class="row" style="margin-bottom: 0px;">
                    <?php if(count($products)):
                        foreach($products as $product): ?>
                            <div class="col l2 m3 s6">
                                <!-- card section -->
                                <a href="<?= base_url('home/product_detail/'.$product->id);?>" target="_blank">
                                <div class="card">
                                    <div class="card-image">
                                        <img src="<?= base_url().'uploads/product_image/'.$product->image;?>" class="responsive-img" style="width: 100%;height: 190px;">
                                    </div>
                                    <div class="card-contain" style="padding: 10px; border-bottom: 1px solid silver;">
                                        <h6 style="font-size: 15px;color: black;margin-top: 5px;"><?= $product->product_title; ?></h6>
                                        <h6 style="font-size: 14px;color: grey;margin-top: 5px;"><?php $category_data = get_category_details($product->category_id);
                                        echo (count($category_data)) ? $category_data[0]->category_name : 'No Category Found' ;?></h6>
                                        <h5 style="font-size: 20px;color: green;font-weight: 500;margin-top: 5px;margin-bottom: 5px;"><span class="fa fa-rupee-sign"></span>&nbsp;<?= $product->price;?></h5>
                                    </div>
                                    <div class="card-contain" style="padding: 3px;">
                                        <center>
                                            <a href="#!" class="btn btn-flat btn-floating waves-effect" onclick="add_to_cart('<?= $product->id; ?>')"><span class="fa fa-shopping-cart"></span></a>
                                            <a href="#!" class="btn btn-flat btn-floating waves-effect" onclick="view_product_details('<?= $product->id; ?>')"><span class="fa fa-eye"></span></a>
                                        </center>
                                    </div>
                                </div>
                                </a>
                                <!-- card section -->
                            </div>
                    <?php endforeach;
                    else: ?>
                        <h6 style="padding-left: 10px;font-weight: 500;font-size: 14px;">Product Not Found.</h6>
                    <?php endif; ?>    
                </div>
               </div>
            </div>
            <!-- card section -->
        </div>
    <!-- cart section -->
    <?php $this->load->view('home/footer');?>
    <!-- body section -->
    <?php $this->load->view('home/js-file');?>

</body>
</html>