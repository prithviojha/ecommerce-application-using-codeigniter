<!DOCTYPE html>
<html>
<head>
    <title>Manage Orders - CodeBit Shop</title>
    <?php $this->load->view('home/css-file');?>

<body>
<style type="text/css">
  body{background:#ffebe5;}
  table tr th{font-size: 13px;text-align: center;}
  table tr td{font-size: 14px;color: grey;text-align: center;}
  .btn-flat:hover{background: #ff3d00;color: white;}

  .dropdown-content{width: 120px!important;}
  .dropdown-content li a{color: grey!important;font-size: 14px;display: block;font-size: 14px;}
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
          <h5 style="margin-top: 0px;font-size: 20px;font-weight: 500;margin-bottom: 0px;">Manage Orders</h5>
          <!-- category search form -->
          <div class="row">
            <div class="col l6 m6 s12">
              <?= form_open('admin/search_orders');?>
              <ul id="search_category">
                <li>
                  <input type="text" name="order_id" id="input_box" placeholder="Enter Order Id" value="<?= set_value('order_id');?>" required>
                </li>
                <li>
                  <button type="submit" class="btn waves-effect waves-light" style="background: black;box-shadow: none;text-transform: capitalize;font-weight: 500;height: 40px;">Search Now</button>
                </li>
              </ul>
              <?= form_close();?>
            </div>
            <div class="col l6 m6 s12">
              
            </div>
          </div>
          <!-- category search form -->
        </div>
        <div class="card-content" style="padding: 0px;">
          <table class="table striped">
            <tr>
              
              <th class="center-align">Order Id</th>
              <th>CUSTOMER NAME</th>
              <th>QUANTITY</th>
              <th>AMOUNT</th>
              <th>ORDER DATE</th>
              <th>STATUS</th>
              <th class="center-align">ACTION</th>
            </tr>
            <?php if(count($orders)):
             foreach($orders as $order): ?>
            <tr>
              <td><a href=""><?= $order->id ;?></a></td>
              <td><?= $order->user_name ;?></td>
              <td><?= $order->total_quantity ;?></td>
              <td><span class="fa fa-rupee-sign"></span>&nbsp;<?= number_format($order->total_amount) ;?></td>
              <td><?= date('d M Y',strtotime($order->order_date)) ;?></td>
              <td><?= $order->order_status ;?></td>
              <td><button type="button" class="btn btn-flat btn-floating dropdown-trigger" data-target="order_action_<?= $order->id; ?>"><span class="fa fa-ellipsis-v"></span></button>
                <ul class="dropdown-content action_dropdown" id="order_action_<?= $order->id; ?>">
                <li><a href="<?= base_url('admin/order_delete/'.$order->id);?>" onclick="return confirm('Confirm! Are You Sure Delete this order.')" class="waves-effect">Delete Order</a></li>
                <li><a href="<?= base_url('admin/view_order/'.$order->id);?>" class="waves-effect">View Order</a></li>
 
              </td>
            </tr>
          <?php endforeach; 
        else: ?>
            <tr>
              <td colspan="7" style="text-align: center;">Orders Not Found.</td>
            </tr>
            <?php endif; ?> 
            
               <tr>
                  <td colspan="7" style="padding: 15px;">
                    <div id="pagination">
                      <?= $this->pagination->create_links();?>
                    </div>
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
