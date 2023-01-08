<!DOCTYPE html>
<html>
<head>
    <title>Edit category - CodeBit Shop</title>
    <?php $this->load->view('home/css-file');?>

<body>
<style type="text/css">
  body{background:#ffebe5;}
  #input_box{background: rgba(0,0,0,0.02);color: grey;box-shadow: none;border-bottom: none;padding-left: 10px;padding-right: 10px;width: 100%;margin: 0 auto;border-radius: 2px;box-sizing: border-box;height: 40px;border:1px solid silver;}
  #input_upload{border:1px solid silver;width: 50%;padding: 8px;border-radius: 3px;}
  select{display: block;border:1px solid silver;border-radius: 3px;outline: none;height: 40px;}
  .container{width: 100%!important;}
  #category_image{height: 50px;width: 50px;border-radius: 100%;border: 1px solid silver;}
</style>
</head>
<body>
<!-- body section -->
<?php $this->load->view('admin/topbar');?>
<!-- <?php print_r($category);?> -->
<div class="container">
  <!-- Category form -->
  <div class="row" style="margin-bottom: 0px;">
    <div class="col l6 m6 s12">
      <?= form_open_multipart('admin/update_category/'.$category[0]->id); ?>
      <div class="card">
        <div class="card-content">
          <h5 style="margin-top: 0px;font-size: 20px;font-weight: 500;margin-bottom: 0px;text-align: center;">Edit Category</h5>
        </div>
        <div class="card-content" style="padding: 20px;">
          <form method="POST" id="desktop_category_form" enctype="multipart/form-data">
          <h6 style="font-size: 14px;font-weight: 500;">Category Name</h6>
          <input type="text" name="category_name" id="input_box" value="<?= $category[0]->category_name;?>" placeholder="Category Name">
          <small class="red-text">Eg: Biscuts, Breads</small>
          <h6 style="font-size: 14px;font-weight: 500;">Image</h6>
          <img src="<?=base_url().'uploads/category_image/'.$category[0]->image;?>" style="width: 100px;height: 100px;border: 2px dashed silver;">
          <input type="file" name="category_image" id="input_upload" placeholder="Category Name">
          <small style="margin-top:0px;margin-bottom: 15px;color: red;">Max. Image Size : 2MB | 100px * 100px</small>
          <button type="submit" class="btn waves-effect waves-light" style="background: #ff3d00;margin-top: 15px;text-transform: capitalize;width: 100%;height: 40px;box-shadow: none;">Update Category</button>
          </form>
          <h6 style="font-weight: 500;color: red;">Notes : </h6>
          <h6 style="font-size: 14px;font-size: 500;font-weight: 500;">1. Category Title Limit 2 Words Only.</h6>
          <h6 style="font-size: 14px;font-size: 500;font-weight: 500;">2. Category Image Size 50px X 50px</h6>
        </div>
      </div> 
      <?= form_close();?> 
    </div>
    <!-- category form -->
    <!-- recent category -->
    <div class="col l6 m6 s12">
      <div class="card">
        <div class="card-content" style="padding:0px;">
          <h6 style="font-size: 14px;font-weight: 500;text-align: center;font-size: 20px;">Recent Upload Category<span class="red-text">(Last 7 Days)</span></h6>
          <table>
            <tr>
              <th class="center-align">Image</th>
              <th class="center-align">Category</th>
              <th class="center-align">Action</th>
            </tr>
            <?php if(count($categories)):
              foreach($categories as $cate):
            ?>
            <tr>
              <td><center><img src="<?=base_url().'uploads/category_image/'.$cate->image;?>" class="responsive-img" id="category_image"></center></td>
              <td class="center-align"><?=$cate->category_name;?></td>
              <td class="center-align"><a href="<?= base_url('admin/edit_category/'.$cate->id);?>"><span class="fa fa-edit"></span></a> - <a href="<?= base_url('admin/delete_category/'.$cate->id);?>" onclick="return confirm('Are you sure you want to delete this category?')"><span class="fa fa-trash"></span></a></td>
            </tr>
            <?php endforeach;
              else:
            ?>
            <?php
             endif;  
            ?>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- recent category -->
</div>
<!-- body section -->
<?php $this->load->view('home/js-file');?>
<?php $this->load->view('admin/custom_js');?>
</body>
</html>
