<!DOCTYPE html>
<html>
<head>
    <title><?= (count($product))?$product[0]->product_title : 'Product Not Found.' ;?> - CodeBit Shop</title>
    <?php $this->load->view('home/css-file');?>
    <style type="text/css">
      body{background: #002366;}
     
    </style>
</head>
<body>
    <!-- body section -->
    <?php $this->load->view('home/header');?>
    <!-- cart section -->
        
            <!-- card section -->
            <div class="card" style="margin-top: 10px;">
               <div class="card-content" style="padding: 10px;">
                <!-- Product Detail section -->
                   <div class="row">
                       <div class="col l4 m4 s12">
                           <img src="<?=base_url().'uploads/product_image/'.$product[0]->image;?>" class="responsive-img" style="border:1px solid rgba(0,0,0,0.1);">
                       </div>
                       <div class="col l5 m5 s12">
                           <h5 style="margin-top: 0px;font-weight: 500;"><?= $product[0]->product_title;?></h5>
                           <?php
                            $category_detail = get_category_details($product[0]->category_id);
                           ?>

                           <h6 style="font-size: 14px;color: silver;"><a href="<?= base_url('index');?>">Home </a>/ <a href="<?= base_url('home/category_products/'.$product[0]->category_id);?>"><?= $category_detail[0]->category_name;?> </a>/ <?= $product[0]->product_title;?> </h6>
                           <div class="divider" style="margin-top: 15px;margin-bottom: 15px;"></div>
                           <p style="font-size: 14px;color: grey;line-height: 20px;"><?= $product[0]->short_description;?></p>
                           <h6 style="font-size: 15px;font-weight: 500;color: grey;">Color : <?= $product[0]->color;?></h6>
                           <h6 style="font-size: 15px;font-weight: 500;color: grey;">Weight : <?= $product[0]->weight;?></h6>
                           <div class="divider" style="margin-top: 15px;margin-bottom: 15px;"></div>
                           <h5><b><span class="fa fa-rupee-sign"></span>&nbsp;<?= $product[0]->price;?></b></h5>
                           <div class="row">
                               <div class="col l6 m6 s12">
                                   <a onclick="add_to_cart('<?= $product[0]->id; ?>')" type="button" class="btn waves-effect waves-light" style="background: #002366;width: 100%;height: 40px;box-shadow: none;"><span class="fa fa-shopping-cart"></span> &nbsp;Add to Cart</a>
                               </div>
                               <div class="col l6 m6 s12">
                                    <a href="<?= base_url('home/buy_now/'.$product[0]->id) ;?>" type="button" class="btn waves-effect waves-light" style="background: black;width: 100%;height: 40px;box-shadow: none;"><span class="fa fa-cube"></span> &nbsp;Buy Now</a>
                               </div>
                           </div>
                       </div>
                       <div class="col l3 m3 s12">
                           <div class="card" style="box-shadow: none;border:1px dashed silver;">
                               <div class="card-content" style="padding: 10px;">
                                   <h6 style="font-size: 15px;font-weight: 500;margin-top: 0px;">Gift Card</h6>
                                   <p style="font-size: 14px;color: grey;line-height: 20px;">---Gift Description------Gift Description------Gift Description------Gift Description------Gift Description---</p>
                               </div>
                           </div>
                            <div class="card" style="box-shadow: none;border:1px dashed silver;">
                               <div class="card-content" style="padding: 10px;">
                                   <h6 style="font-size: 15px;font-weight: 500;margin-top: 0px;">Gift Card</h6>
                                   <p style="font-size: 14px;color: grey;line-height: 20px;">---Gift Description------Gift Description------Gift Description------Gift Description------Gift Description---</p>
                               </div>
                           </div>
                           <div class="card" style="box-shadow: none;border:1px dashed silver;">
                               <div class="card-content" style="padding: 10px;">
                                   <h6 style="font-size: 15px;font-weight: 500;margin-top: 0px;">Gift Card</h6>
                                   <p style="font-size: 14px;color: grey;line-height: 20px;">---Gift Description------Gift Description------Gift Description------Gift Description------Gift Description---</p>
                               </div>
                           </div>
                           <div class="card" style="box-shadow: none;border:1px dashed silver;">
                               <div class="card-content" style="padding: 10px;">
                                   <h6 style="font-size: 15px;font-weight: 500;margin-top: 0px;">Gift Card</h6>
                                   <p style="font-size: 14px;color: grey;line-height: 20px;">---Gift Description------Gift Description------Gift Description------Gift Description------Gift Description---</p>
                               </div>
                           </div>
                       </div>
                   </div>
                   <!-- Product Detail section -->
                   <!-- Related Products -->
                   <h5 style="padding-left: 15px;font-size: 22px;font-weight: 500;">Related Products<span class="right"></span></h5>
                   <div class="row" style="margin-bottom: 0px;">
                        <?php if(count($related_products)):
                            foreach($related_products as $r_pro):?>
                                <div class="col l2 m3 s6">
                                    <!-- card section -->
                                    <div class="card">
                                        <div class="card-image">
                                            <img src="<?=base_url().'uploads/product_image/'.$r_pro->image;?>" class="responsive-img" style="width: 100%;height: 190px;">
                                        </div>
                                        <div class="card-contain" style="padding: 10px; border-bottom: 1px solid silver;">
                                            <h6 style="font-size: 15px;color: black;margin-top: 5px;"><?= $r_pro->product_title;?></h6>
                                            <h6 style="font-size: 14px;color: grey;margin-top: 5px;"><?php $category_data = get_category_details($r_pro->category_id); echo $category_data[0]->category_name;?></h6>
                                            <h5 style="font-size: 20px;color: green;font-weight: 500;margin-top: 5px;margin-bottom: 5px;"><span class="fa fa-rupee-sign"></span>&nbsp;<?= $r_pro->price ;?></h5>
                                        </div>
                                        <div class="card-contain" style="padding: 3px;">
                                            <center>
                                                <a href="" class="btn btn-flat btn-floating waves-effect"><span class="fa fa-shopping-cart"></span></a>
                                                <a href="" class="btn btn-flat btn-floating waves-effect"><span class="fa fa-eye"></span></a>
                                            </center>
                                        </div>
                                    </div>
                                    <!-- card section -->
                                </div>
                        <?php endforeach; 
                    else: ?>
                        <h6 style="font-size: 14px;font-weight:500;padding-left:15px;">Related Product Not Found</h6>
                    <?php endif;?>
                    </div>
                   <!-- Related Products -->
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