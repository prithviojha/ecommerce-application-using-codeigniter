<!DOCTYPE html>
<html>
<head>
    <title>Upload Product - CodeBit Shop</title>
    <?php $this->load->view('home/css-file');?>

<body>
<style type="text/css">
  body{background:#ffebe5;}
  #input_box{color: grey;box-shadow: none;border-bottom: none;padding-left: 10px;padding-right: 10px;width: 100%;margin: 0 auto;border-radius: 2px;box-sizing: border-box;height: 40px;border:1px solid silver;}
  #input_file{border:1px solid silver;width: 40%;padding: 8px;border-radius: 3px;display: block;}
  select{display: block;}
  textarea{border: 1px solid silver;outline: none;resize: none;padding: 10px;border-radius: 3px;height: 90px;width: 40%;}
  select{display: block;border: 1px solid silver;outline: none;width: 40%;height: 40px;border-radius: 3px;}
</style>
</head>
<body>
<!-- body section -->
<?php $this->load->view('admin/topbar');?>
<!-- upload product section -->
<div class="container">
  <div class="row" style="margin-bottom: 0px;">
    <div class="col l12 m12 s12">
      <div class="card">
        <div class="card-content">
          <h5 style="margin-top: 0px;font-size: 20px;font-weight: 500;margin-bottom: 0px;">Upload New Product</h5>
        </div>
        <div class="card-content" style="padding: 20px;">
          <?= form_open_multipart('admin/save_product');?>
          <h6 style="font-size: 14px;font-weight: 500;">Product Name</h6>
          <input type="text" value="<?= count($categories) ? $categories[0]->product_title : '';?>" name="product_name" id="input_box" placeholder="Product Name" required>
          
          <h6 style="font-size: 14px;font-weight: 500;">Product Category</h6>

          <select name="category_id" required>
            <option value="" selected>Select Category</option>
            <?php if(count($category)):
              foreach($category as $cate):?>
              <?php if($categories[0]-> category_id == $cate->id):?>
            <option value="<?= $cate->id;?>" selected><?= $cate->category_name;?></option>
            <?php else: ?>
            <option value="<?= $cate->id;?>"><?= $cate->category_name;?></option>
          <?php endif;?>
            <?php endforeach;
              else:?>
              <option value="">Categories Not Found.</option>
              <?php endif;?>
          </select>

            <h6 style="font-size: 14px;font-weight: 500;">Product Description</h6>
            <textarea name="short_desc" placeholder="Enter product Description"><?= count($categories) ? $categories[0]->short_description : '';?></textarea>
          <h6 style="font-size: 14px;font-weight: 500;">Color</h6>
          <input type="text" name="color" id="input_box" placeholder="Enter Product Color" style="width: 40%;" value="<?= count($categories) ?  $categories[0]->color : '';?>">
          <h6 style="font-size: 14px;font-weight: 500;">Weight</h6>
          <input type="text" name="weight" id="input_box" placeholder="Enter Product weight" style="width: 40%;" value="<?= count($categories) ? $categories[0]->weight : '';?>">
          <h6 style="font-size: 14px;font-weight: 500;">Price</h6>
          <input type="text" name="price" id="input_box" placeholder="Eg: 150" required style="width: 40%;" value="<?= count($categories) ? $categories[0]->price : '';?>">

          
          <h6 style="font-size: 14px;font-weight: 500;">Image</h6>
          <?php if(count($categories)):?>
          <img src="<?= count($categories) ? base_url('uploads/product_image/'.$categories[0]->image) : '' ;?>" style="width: 100px;height: 100px;border: 2px dashed silver;">
        <?php endif;?>
          <input type="file" name="product_image" id="input_file" value="">
          <button type="submit" class="btn waves-effect waves-light" style="background: black;box-shadow: none;text-transform: capitalize;font-weight: 500;height: 40px;margin-top: 15px;">Save Product</button>

          <button type="reset" class="btn waves-effect waves-light" style="background: red;box-shadow: none;text-transform: capitalize;font-weight: 500;height: 40px;margin-top: 15px;">Reset</button>
          <?= form_close(); ?>
          <h6 style="font-weight: 500;color: red;">Notes : </h6>
          <h6 style="font-size: 14px;font-size: 500;font-weight: 500;">1. Product Title Limit 5 Words Only.</h6>
          <h6 style="font-size: 14px;font-size: 500;font-weight: 500;">2. Category Image Size 100px X 100px</h6>
          <h6 style="font-size: 14px;font-size: 500;font-weight: 500;">3. Select Product Category.</h6>
          <h6 style="font-size: 14px;font-size: 500;font-weight: 500;">4. Enter Product Price.</h6>
        </div>
      </div>  
    </div>
  </div>
</div>
<!-- upload product section -->
<!-- body section -->
<?php $this->load->view('home/js-file');?>
<?php $this->load->view('admin/custom_js');?>
</body>
</html>
