<style type="text/css">
  nav{height: 45px;line-height: 45px;background: #002366;}
  nav .brand-logo{font-size: 22px;}

  #admin_menus a, .collapsible-header{border-left: 3px solid white;transition: 0.5s}
  #admin_menus a:hover, .collapsible-header:hover{border-left: 3px solid #ff3d00!important;transition: 0.5s;background: #ff3d001a!important;}
  .collapsible-header{font-weight: 500;font-size: 14px;padding-left: 35px!important;background: none;}
</style>
<!-- nav section -->
<nav>
  <div class="nav-wrapper">
    <a href="<?=base_url('admin/Dashboard');?>" class="brand-logo">&nbsp;Admin Dashboard</a>
    <ul class="right">
      <li><a href="" class="sidenav-trigger" data-target="admin_menus" style="display: block;line-height: 45px;height: 45px;"><span class="fa fa-bars"></span>&nbsp;Menus</a></li>
    </ul>
  </div>
</nav>
<!-- nav section -->
<!-- admin sidenav section -->
<ul class="sidenav collapsible" id="admin_menus">
  <li><a href="<?= base_url('admin/dashboard');?>">Dashboard</a></li>
  <li>
    <div class="collapsible-header">Categories</div>
    <div class="collapsible-body">
      <ul>
        <li><a href="<?=base_url('admin/add_category')?>">Add Category</a></li>
        <li><a href="<?=base_url('admin/manage_category')?>">Manage Category</a></li>
      </ul>
    </div>
  </li>
  <li>
    <div class="collapsible-header">Products</div>
    <div class="collapsible-body">
      <ul>
        <li><a href="<?=base_url('admin/add_product')?>">Add Product</a></li>
        <li><a href="<?=base_url('admin/manage_products')?>">Manage Product</a></li>
      </ul>
    </div>
  </li>
  <li>
    <div class="collapsible-header">Orders</div>
    <div class="collapsible-body">
      <ul>
        <li><a href="<?= base_url('admin/pending_orders'); ?>">Pending Order</a></li>
        <li><a href="<?= base_url('admin/delivered_orders'); ?>">Delivered Orders</a></li>
        <li><a href="<?= base_url('admin/manage_orders'); ?>">Manage Orders</a></li>
      </ul>
    </div>
  </li>
  <li>
    <div class="collapsible-header">Sales</div>
    <div class="collapsible-body">
      <ul>
        <li><a href="<?= base_url('admin/today_sales') ;?>">Today Sale</a></li>
        <li><a href="<?= base_url('admin/all_sales'); ?>">All Time Sales</a></li>
      </ul>
    </div>
  </li>
   <li>
    <div class="collapsible-header">Customers</div>
    <div class="collapsible-body">
      <ul>
        <li><a href="<?= base_url('admin/new_customers'); ?>">New Registered</a></li>
        <li><a href="<?= base_url('admin/all_customers'); ?>">ALL Customers</a></li>
      </ul>
    </div>
  </li>
  <li><a href="<?=base_url('admin/logout')?>">Sign Out</a></li>
</ul>
<!-- admin sidenav section -->


<!-- jquery file included -->
    <script type="text/javascript" src="<?= base_url('assets/jquery/jquery.js');?>"></script>
<!-- jquery file included -->    
<?php
if($this->session->flashdata('success')):
$msg = $this->session->flashdata('success');
?>
<!-- message section -->
<div class="card success">
  <div class="card-content" style="padding:10px;padding-left:15px;">
    <h6 style="font-size: 15px;font-weight: 500;margin-top: 5px;"><span class="fa fa-check-circle green-text"></span>&nbsp;<?= $msg; unset($_SESSION['success']); ?></h6>
  </div>
</div>
<!-- message section -->

<?php endif; ?>
<?php if($this->session->flashdata('error')):
$msg = $this->session->flashdata('error');
?>
<!-- Error message section -->
<div class="card success">
  <div class="card-content" style="padding:10px;padding-left:15px;">
    <h6 style="font-size: 15px;font-weight: 500;margin-top: 5px;"><span class="fa fa-exclamation-triangle red-text"></span>&nbsp;<?= $msg; unset($_SESSION['error']) ?></h6>
  </div>
</div>
<!-- Error message section -->
<?php endif; 
?>