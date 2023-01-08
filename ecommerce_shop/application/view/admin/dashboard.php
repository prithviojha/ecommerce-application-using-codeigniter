<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - CodeBit Shop</title>
    <?php $this->load->view('home/css-file');?>

<body>
<style type="text/css">
  body{background:#ffebe5;}
  
  .container{width: 80%;}
  #top_sold_products li {border-bottom: 1px dashed silver;padding: 10px;}
  #top_sold_products li:hover{background: rgba(0,0,0,0.1);}
  #order_dropdown,#income_dropdown,#Product_dropdown,#customer_dropdown {width: 200px!important;padding-top:8px;}
  #order_dropdown a,#income_dropdown a,#Product_dropdown a,#customer_dropdown a{color: grey;font-size: 14px;font-weight: 500;}
  
</style>
</head>
<body>
<!-- body section -->
<?php $this->load->view('admin/topbar');?>
<div class="container">
  <!-- four card section -->
    <div class="row" style="margin-top: 10px;margin-bottom: 0px;">
      <div class="col l3 m4 s12">
        <div class="card">
          <div class="card-content">
            <div class="row">
              <h6 style="font-size: 15px;font-weight: 500;">Order's<span class="right"><span class="fa fa-ellipsis-v dropdown-trigger" 
              data-target="order_dropdown" style="cursor: pointer;"></span></span></h6>
            </div>
            <h5 style="margin-top: 25px;color: #ff3d00;"><b><span id="show_orders">0</span></b><span class="right"><span class="fa fa-shopping-cart black-text"></span></span></h5>
            <h6 style="font-size: 14px;color: silver;"><span id="show_orders_heading"></span></h6>
          </div>
        </div>
      </div>
               <!-- order dropdown -->
          <ul class="dropdown-content" id="order_dropdown" style="width: 150px;">
            <a href="#!" onclick="count_orders('today')" style="font-size: 12px;font-weight: 500;">Today Orders</a><br/>
            <a href="#!" onclick="count_orders('yesterday')" style="font-size: 12px;font-weight: 500;">previous Day Orders</a><br/>
            <a href="#!" onclick="count_orders('last_30_days')" style="font-size: 12px;font-weight: 500;">Last 30 Days Orders</a><br/>
            <a href="#!" onclick="count_orders('all')" style="font-size: 12px;font-weight: 500;">All Orders</a>
          </ul>
          <!-- order dropdown -->
      <div class="col l3 m4 s12">
        <div class="card">
          <div class="card-content">
            <div class="row">
              <h6 style="font-size: 15px;font-weight: 500;">Income<span class="right"><span class="fa fa-ellipsis-v dropdown-trigger" 
              data-target="income_dropdown" style="cursor: pointer;"></span></span></h6>
            </div>
            <h5 style="margin-top: 25px;color: #ff3d00;"><b><span id="show_income">0</span></b><span class="right"><span class="fa fa-coins black-text"></span></span></h5>
            <h6 style="font-size: 14px;color: silver;"><span id="show_income_heading"></span></h6>
          </div>
        </div>
      </div>
        <!-- income dropdown -->
          <ul class="dropdown-content" id="income_dropdown" style="width: 150px;">
            <a href="#!" onclick="count_income('today')" style="font-size: 12px;font-weight: 500;">Today Income</a><br/>
            <a href="#!" onclick="count_income('yesterday')" style="font-size: 12px;font-weight: 500;">previous Day Income</a><br/>
            <a href="#!" onclick="count_income('last_30_days')" style="font-size: 12px;font-weight: 500;">Last 30 Days Income</a><br/>
            <a href="#!" onclick="count_income('all')" style="font-size: 12px;font-weight: 500;">All Income</a>
          </ul>
        <!-- income dropdown -->
      <div class="col l3 m4 s12">
        <div class="card">
          <div class="card-content">
            <div class="row">
              <h6 style="font-size: 15px;font-weight: 500;">Products<span class="right"><span class="fa fa-ellipsis-v dropdown-trigger" 
              data-target="Product_dropdown" style="cursor: pointer;"></span></span></h6>
            </div>
            <h5 style="margin-top: 25px;color: #ff3d00;"><b><span id="show_product">0</span></b><span class="right"><span class="fa fa-cubes black-text"></span></h5>
            <h6 style="font-size: 14px;color: silver;"><span id="show_product_heading"></h6>
          </div>
        </div>
      </div>
        <!-- product dropdown -->
          <ul class="dropdown-content" id="Product_dropdown" style="width: 150px;">
            <a href="#!" onclick="count_products('today')" style="font-size: 12px;font-weight: 500;">Today Products</a><br/>
            <a href="#!" onclick="count_products('yesterday')" style="font-size: 12px;font-weight: 500;">previous Day Products</a><br/>
            <a href="#!" onclick="count_products('last_30_days')" style="font-size: 12px;font-weight: 500;">Last 30 Days Products</a><br/>
            <a href="#!" onclick="count_products('all')" style="font-size: 12px;font-weight: 500;">All Products</a>
          </ul>
        <!-- product dropdown -->
      <div class="col l3 m4 s12">
        <div class="card">
          <div class="card-content">
            <div class="row">
              <h6 style="font-size: 15px;font-weight: 500;">Customerss<span class="right"><span class="fa fa-ellipsis-v dropdown-trigger" 
              data-target="customer_dropdown" style="cursor: pointer;"></span></span></h6>
            </div>
            <h5 style="margin-top: 25px;color: #ff3d00;"><b><span id="show_customer">0</span></b><span class="right"><span class="fa fa-users black-text"></span></span></h5>
            <h6 style="font-size: 14px;color: silver;"><span id="show_customer_heading"></h6>
          </div>
        </div>
      </div>
        <!-- Customer dropdown -->
          <ul class="dropdown-content" id="customer_dropdown" style="width: 150px;">
            <a href="#!" onclick="count_customer('today')" style="font-size: 12px;font-weight: 500;">Today Customers</a><br/>
            <a href="#!" onclick="count_customer('yesterday')" style="font-size: 12px;font-weight: 500;">Yesterday Customers</a><br/>
            <a href="#!" onclick="count_customer('last_30_days')" style="font-size: 12px;font-weight: 500;">Last 30 Days Customers</a><br/>
            <a href="#!" onclick="count_customer('all')" style="font-size: 12px;font-weight: 500;">All Customers</a>
          </ul>
        <!-- Customer dropdown -->
    </div>
  <!-- four card section -->
 
  <!-- two card section -->
  <div class="row">
    <div class="col l7 m7 s12">
      <div class="card">
        <div class="card-content">
           <div id="chartContainer" style="height: 300px; width: 100%;">
        </div>
      </div>
    </div>
    </div>
    <div class="col l5 m5 s12">
      <div class="card">
        <div class="card-content">
           <h6>Top Products Sold</h6>
           <ul id="top_sold_products">
            <?php if(count($top_sold_products)):
              foreach($top_sold_products as $t_s_pro):?>
             <li>
               <h6 style="font-size: 14px;font-weight: 500;"><a href="<?= base_url('home/product_detail/'.$t_s_pro->id); ?>" target="_blank" style="color: black;"><?= $t_s_pro->product_title ;?></a></h6><h6 style="font-size: 15px;"><span class="fa fa-rupee-sign">&nbsp;<?= number_format($t_s_pro->price) ;?></span><span class="right"><b>Quantity : <?= number_format($t_s_pro->count_sales) ;?></b></span></h6>
             </li>
           <?php endforeach;
         else: ?>
         <?php endif; ?>           
         </ul>
        </div>
      </div>
    </div>
  </div>

  <!-- two card section -->
<!-- body section -->
<?php $this->load->view('home/js-file');?>
<?php $this->load->view('admin/custom_js');?>
</body>
</html>