<!DOCTYPE html>
<html>
<head>
    <title>Manage Sales - CodeBit Shop</title>
    <?php $this->load->view('home/css-file');?>

<body>
<style type="text/css">
  body{background:#ffebe5;}
  table tr th{font-size: 13px;text-align: center;}
  table tr td{font-size: 14px;color: grey;text-align: center;}
  #input_box{border: 1px solid silver;height: 35px;padding-left: 10px;box-shadow: none;box-sizing: border-box;}
  #customize_sale_modal{width: 40%;}
  
</style>
</head>
<body>
<!-- body section -->
<?php $this->load->view('admin/topbar');?>

<div class="container">
  <div class="card">
    <div class="card-content" style="border-bottom: 1px solid silver;padding: 10px;">
      <h5 style="margin-top: 0px;font-size: 20px;font-weight: 500;margin-bottom: 0px;">Sales<span class="right"><a href="#!" class="modal-trigger" data-target="customize_sale_modal" style="font-size: 15px;font-weight: 500;">Customize Sales</a>
        <br/><a href="<?= base_url('admin/all_sales') ;?>" class="right" style="font-size: 13px;color: red;">Reset</a></span></h5>
      <h6 style="font-size: 14px;color: grey;"><b>07-Jun-2021</b> To <b>07-Jul-2021</b></h6>
    </div>
    <div class="modal" id="customize_sale_modal">
      <div class="modal-content" style="padding: 10px;border-bottom: 1px solid silver;">
        <h6 style="font-size:15px;color: grey;">Customize Sales Report</h6>
      </div>
      <div class="modal-content" style="padding: 10px;">
        <?= form_open('admin/search_sales'); ?>
        <div class="row" style="margin-bottom:0px;margin-top: 10px;">
          <div class="col l6 m6 s12">
            <input type="date" name="start_date" id="input_box" required>
          </div>
          <div class="col l6 m6 s12">
            <input type="date" name="last_date" id="input_box" required>
          </div>
          <div class="col l12 m12 s12">
            <button type="submit" class="btn waves-effect waves-light" style="background: black;margin-top: 10px;text-transform: capitalize;">Search Reports</button>
          </div>
        </div>
        <?= form_close(); ?>
      </div>
    </div>
    <div class="card-content" style="padding: 0px;">
      <table class="table">
        <tr>
          <th class="center-align">Date</th>
          <th class="center-align">Customers</th>
          <th class="center-align">Sale Units</th>
          <th class="center-align" style="padding-right: 15px;">Amount</th>
        </tr>
        <?php if(count($sales)):
          foreach($sales as $sale): ?>
        <tr>
          <td class="center-align"><?= $sale['order_date'];?></td>
          <td class="center-align"><?= $sale['COUNT(order_date)'];?> Customer<br/>
            <?php 
             $total_customers = get_all_customers($sale['order_date']);
            ?>
            <?php if(count($total_customers)):
              foreach($total_customers as $total_cus):?>
            <i><span style="color: silver;">Sold To : <?= $total_cus->user_name; ?></span></i><br/>
          <?php endforeach;
        else: ?>
          <i>Customers Not Found.</i>
        <?php endif; ?>
          </td>
          <td class="center-align"><?= $sale['SUM(total_quantity)'];?><br/>
            <?php 
             $total_customers = get_all_customers($sale['order_date']);
            ?>
            <?php if(count($total_customers)):
              foreach($total_customers as $total_cus):?>
            <i><span style="color: silver;">Unit : <?= $total_cus->total_quantity; ?></span></i><br/>
          <?php endforeach;
        else: ?>
          <i>Quantity Not Found.</i>
        <?php endif; ?>
          </td>
          <td class="center-align"><?= number_format($sale['SUM(total_amount)'],2,'.',',');?>/-<br/>
            <?php 
             $total_customers = get_all_customers($sale['order_date']);
            ?>
            <?php if(count($total_customers)):
              foreach($total_customers as $total_cus):?>
            <i><span style="color: silver;"><?= number_format($total_cus->total_amount,2,'.',','); ?>/-</span></i><br/>
          <?php endforeach;
        else: ?>
          <i>Quantity Not Found.</i>
        <?php endif; ?>

          </td>
        </tr>
      <?php endforeach;
    else: ?>
      <tr>
        <td style="text-align:center;" colspan="4">Sales Not Found</td>
      </tr>
    <?php endif; ?>
      <!-- <tr>
        <th colspan="3" style="text-align: right;">Grand Total</th>
        <th class="right-align"><span class="fa fa-rupee-sign"></span>&nbsp;0.00</th>
      </tr> -->
      </table>
    </div>
  </div>
</div>

<!-- sale filter modal -->
<!-- <div class="modal" id="customize_report">
  <div class="modal-content" style="padding: 10px;border-bottom: 1px solid silver;">
    <h6 style="margin-top: 5px;"><span class="fa fa-filter"></span>&nbsp;Filters</h6>
  </div>
  <div class="modal-content" style="padding: 10px;">
    <form action="#!" method="post" accept-charset="utf-8">
    <div class="row" style="margin-bottom: 5px;padding: 0px;">
      <div class="col l6 m6 s6">
        <h6 style="font-size: 14px;font-weight: 400;color: black;">Start Date</h6>
        <input type="date" name="start_date" id="input_date" required>
      </div>
      <div class="col l6 m6 s6">
        <h6 style="font-size: 14px;font-weight: 400;color: black;">End Date</h6>
        <input type="date" name="end_date" id="input_date" required>
      </div>
    </div>
    <div class="row">
      <div class="col l12 m12 s12">
        <button type="submit" class="btn waves-effect waves-light" style="background: #ff3d00;box-shadow: none;text-transform: capitalize;font-weight: 500;">Search</button>
        <button type="button" class="btn waves-effect waves-light modal-close" style="background: black;box-shadow: none;margin-left: 5px;text-transform: capitalize;font-weight: 500;">Cancel</button> 
      </div>
    </div>
    </form> 
  </div>

</div> -->
<!-- sale filter modal -->

<!-- body section -->
<?php $this->load->view('home/js-file');?>
<?php $this->load->view('admin/custom_js');?>
</body>
</html>
