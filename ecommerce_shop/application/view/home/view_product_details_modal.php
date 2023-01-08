 <!-- Product Detail section -->
 <span class="right modal-close" style="padding:10px 12px;background: red;color: white;margin-right: 25px;"><b>X</b></span>
 <div class="modal-content">
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
               </div>