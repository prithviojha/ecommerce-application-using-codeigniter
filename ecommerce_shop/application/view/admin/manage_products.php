<!DOCTYPE html>
<html>
<head>
    <title>Manage Products - CodeBit Shop</title>
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
  #pagination a{color: black;font-weight: 500;border: 1px solid black;padding: 5px 10px;margin-left: 5px;}
  #pagination strong{font-weight: 500;border: 1px solid black;padding: 5px 10px;margin-left: 5px;background: black;color: white;}
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
          <h5 style="margin-top: 0px;font-size: 20px;font-weight: 500;margin-bottom: 0px;">Manage Products</h5>
          <!-- category search form -->
          <div class="row">
            <div class="col l6 m6 s12">
              <?= form_open('admin/search_product');?>
              <ul id="search_category">
                <li>
                  <input type="text" name="product_name" id="input_box" placeholder="Enter Product Name" value="<?= set_value('product_name');?>" required>
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
                <li><a href="<?= base_url('admin/filter_product/new_product');?>" class="waves-effect">New Product First</a></li>
                <li><a href="<?= base_url('admin/filter_product/old_product');?>" class="waves-effect">Old Product First</a></li>
                <li><a href="<?= base_url('admin/filter_product/highest_price');?>" class="waves-effect">Highest Price</a></li>
                <li><a href="<?= base_url('admin/filter_product/lowest_price');?>" class="waves-effect">Lowest Price</a></li>
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
              <th>CATEGORY</th>
              <th>PRICE</th>
              <th>COUNT SOLD</th>
              <th>STATUS</th>
              <th class="center-align">ACTION</th>
            </tr>
            <?php if(count($products)):
              foreach($products as $pro):?>
              <tr>

                <td>
                  <center>
                    <img src="<?= base_url().'uploads/product_image/'.$pro->image; ?>" class="responsive-img" style="width: 40px;height: 40px;border:1px solid silver;border-radius: 100%;">
                  </center>
                </td>
                <td style="width: 270px;"><?=$pro->product_title;?><br/><a href="<?= base_url('home/product_detail/'.$pro->id);?>" target="_blank">View on Home</a></td>
                <td><a href="">
                  <?php $category_data = get_category_details($pro->category_id);echo $category_data[0]->category_name;?></a></td>
                  <td><?= number_format($pro->price);?></td>
                  <td><?= $pro->count_sales;?></td>
                <td style="width: 270px;"><?= ($pro->status == '0')?'Active':'Inactive';?></td>
                <td>
                  <center>
                    <button class="btn btn-flat btn-floating waves-effect waves-light dropdown-trigger" data-target="action_dropdown<?= $pro->id; ?>"><span class="fa fa-ellipsis-v"></span></button>
                  </center>
                <!-- action dropdown section -->
                  <ul class="dropdown-content" id="action_dropdown<?= $pro->id; ?>">
                    <li><a href="<?= base_url('admin/edit_product/'.$pro->id);?>" class="fa fa-edit">&nbsp;Edit</a></li>
                    <li><a href="<?= base_url('admin/delete_product/'.$pro->id);?>" onclick="return confirm('Are you sure you want to delete this Product?')" class="fa fa-trash">&nbsp;Delete</a></li>
                    <?php if($pro->status == "0"):?>
                      <li><a href="<?= base_url('admin/change_product_status/'.$pro->id.'/1');?>"><span class="fa fa-eye-slash"span>&nbsp;Inactive</a></li>
                    <?php else:?>
                      <li><a href="<?= base_url('admin/change_product_status/'.$pro->id.'/0');?>"><span class="fa fa-eye"></span>&nbsp;Active</a></li>
                    <?php endif;?>
                  </ul>
                <!-- action dropdown section -->
                </td>
              </tr>
              <?php endforeach;
                else:?>
                <tr>
                  <td colspan="5" style="text-align: center;">Products Not Found</td>
                </tr>
                <?php endif; ?>
                <tr>
                  <td colspan="7">
                    <div id="pagination">
                      <?= $this->pagination->create_links();?>
                    </div>
                  </td>
                </tr>
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
