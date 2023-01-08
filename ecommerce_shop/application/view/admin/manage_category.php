<!DOCTYPE html>
<html>
<head>
    <title>Manage Categories - CodeBit Shop</title>
    <?php $this->load->view('home/css-file');?>

<body>
<style type="text/css">
  body{background:#ffebe5;}
  #category_image{height: 50px;width: 50px;border-radius: 100%;border: 1px solid silver;}
  table tr th{font-size: 13px;}
  table tr td{font-size: 13px;color: grey;}
  .btn-flat:hover{background: #ff3d00;color: white;}

  .dropdown-content{width: 120px!important;}
  .dropdown-content li a{color: grey!important;font-size: 14px;display: block;font-size: 14px;}
  #category_filter{width: 180px!important;padding-top: 8px;padding-bottom: 8px;}
  #category_filter li a{color: grey;font-size: 14px;font-weight: 500;}
  #search_category{display: flex;}
  #search_category li:first-child{width: 250px;}
  #input_box{border:1px solid silver;box-shadow: none;box-sizing: border-box;padding-left: 10px;padding-right: 10px;height: 40px;border-radius: 0px;}
</style>
</head>
<body>
<!-- body section -->
<?php $this->load->view('admin/topbar');?>

<div class="container">
    <!-- message section -->
<!-- message section -->
  <!-- recent delivered order -->
  <div class="row" style="margin-bottom: 0px;">
    <div class="col l12 m12 s12">
      <div class="card">
        <div class="card-content">
          <h5 style="margin-top: 0px;font-size: 20px;font-weight: 500;margin-bottom: 0px;">Manage Categories</h5>
          <!-- category search form -->
          <div class="row">
            <div class="col l6 m6 s12">
              <?= form_open('admin/search_category');?>
              <ul id="search_category">
                <li>
                  <input type="text" name="category_name" id="input_box" placeholder="Enter Category Name" value="<?= set_value('category_name');?>" required>
                </li>
                <li>
                  <button type="submit" class="btn waves-effect waves-light" style="background: black;box-shadow: none;text-transform: capitalize;font-weight: 500;height: 40px;">Search Now</button>
                </li>
              </ul>
              <?= form_close();?>
            </div>
            <div class="col l6 m6 s12">
              <span class="right">
                <button type="button" class="btn waves-effect waves-light dropdown-trigger" data-target="category_filter" style="background: black;box-shadow: none;text-transform: capitalize;font-weight: 500;height: 40px;margin-top: 15px;"><span class="fa fa-filter"></span>&nbsp;Filter</button>
              </span>
              <!-- Category filter -->
              <ul class="dropdown-content" id="category_filter">
                <li><a href="<?= base_url('admin/filter_category/new_category');?>" class="waves-effect">New Category First</a></li>
                <li><a href="<?= base_url('admin/filter_category/old_category');?>" class="waves-effect">Old Category First</a></li>
                <li><a href="<?= base_url('admin/filter_category/highest_products');?>" class="waves-effect">Highest Product</a></li>
                <li><a href="<?= base_url('admin/filter_category/lowest_products');?>" class="waves-effect">Lowest Product</a></li>
              </ul>
              <!-- Category filter -->
            </div>
          </div>
          <!-- category search form -->
        </div>
        <div class="card-content" style="padding: 0px;">
          <table class="table striped">
            <tr>
              
              <th class="center-align">IMAGE</th>
              <th>NAME</th>
              <th>PRODUCTS</th>
              <th>STATUS</th>
              <th class="center-align">ACTION</th>
            </tr>
            <?php if(count($categories)):
              foreach($categories as $cate):
                //print_r($cate);
                ?>
              <tr>

                <td>
                  <center>
                    <img src="<?= base_url().'uploads/category_image/'.$cate->image; ?>" class="responsive-img" style="width: 40px;height: 40px;border:1px solid silver;border-radius: 100%;">
                  </center>
                </td>
                <td style="width: 270px;"><?=$cate->category_name;?><br/><a href="<?= base_url('home/category_products/'.$cate->id);?>">View on Home</a></td>
                <td>
                  
                  <a href="<?= base_url('home/category_products/'.$cate->id);?>"><?=$cate->count_products;?> - Products</a>


                </td>
                <td style="width: 270px;"><?= ($cate->status == '0')?'Active':'Inactive';?></td>
                <td>
                  <center>
                    <button class="btn btn-flat btn-floating waves-effect waves-light dropdown-trigger" data-target="action_dropdown<?= $cate->id; ?>"><span class="fa fa-ellipsis-v"></span></button>
                  </center>
                <!-- action dropdown section -->
                  <ul class="dropdown-content" id="action_dropdown<?= $cate->id; ?>">
                    <li><a href="<?= base_url('admin/edit_category/'.$cate->id);?>" class="fa fa-edit">&nbsp;Edit</a></li>
                    <li><a href="<?= base_url('admin/delete_category/'.$cate->id);?>" onclick="return confirm('Are you sure you want to delete this category?')" class="fa fa-trash">&nbsp;Delete</a></li>
                    <?php if($cate->status == "0"):?>
                      <li><a href="<?= base_url('admin/change_category_status/'.$cate->id.'/1');?>"><span class="fa fa-eye-slash"span>&nbsp;Inactive</a></li>
                    <?php else:?>
                      <li><a href="<?= base_url('admin/change_category_status/'.$cate->id.'/0');?>"><span class="fa fa-eye"></span>&nbsp;Active</a></li>
                    <?php endif;?>
                  </ul>
                <!-- action dropdown section -->
                </td>
              </tr>
              <?php endforeach;
                else:?>
                <tr>
                  <td colspan="5" style="text-align: center;">Categories Not Found</td>
                </tr>
                <?php endif; ?>
                </ul>
                <!-- action dropdown section -->
              </td>
            </tr>
                      </table>
        </div>
      </div>  
    </div>
  </div>
  <!-- recent delivered order -->
</div>

<!-- body section -->
<?php $this->load->view('home/js-file');?>
<?php $this->load->view('admin/custom_js');?>
</body>
</html>
