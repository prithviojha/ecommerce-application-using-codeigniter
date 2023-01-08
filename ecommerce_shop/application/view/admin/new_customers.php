<style type="text/css">
	#pagination a{color: black;font-weight: 500;border: 1px solid black;padding: 5px 10px;margin-left: 5px;}
  #pagination strong{font-weight: 500;border: 1px solid black;padding: 5px 10px;margin-left: 5px;background: black;color: white;}
</style>
<!DOCTYPE html>
<html>
<head>
    <title>New Customers - CodeBit Shop</title>
    <?php $this->load->view('home/css-file');?>

<body>
<style type="text/css">
  body{background:#ffebe5;}
  table tr th{font-size: 13px;text-align: center;}
  table tr td{font-size: 14px;color: grey;text-align: center;}
 
  
</style>
</head>
<body>
<!-- body section -->
<?php $this->load->view('admin/topbar');?>
<div class="container">
    <div class="card">
	    <div class="card-content" style="border-bottom: 1px solid silver;padding: 10px;">
	    	<h6 style="font-size:15px;color: grey;text-align: center;">NEW CUSTOMERS(This Week)</h6>
	    	<table>
	    		<tr>
	    			<th>S No.</th>
	    			<th>User Id</th>
	    			<th>Full Name</th>
	    			<th>Email</th>
	    			<th>Mobile Number</th>
	    			<th>PASSWORD</th>
	    			<th>Address</th>
	    			<th>Register Date</th>
	    			<th>Total Spent</th>
	    		</tr>

	    		<?php
	    		$count = 0; 
	    		if(count($new_customer)) :
	    			foreach($new_customer as $new_cust):
	    				$count += 1;
	    			?>
			    		<tr>
			    			<td><?= $count ;?></td>
			    			<td><?= $new_cust->id ;?></td>
			    			<td><?= $new_cust->fullname ;?></td>
			    			<td><?= $new_cust->email ;?></td>
			    			<td><?= $new_cust->mobile_no ;?></td>
			    			<td><?= $new_cust->password ;?></td>
			    			<td><?= $new_cust->address ;?></td>
			    			<td><?= $new_cust->register_date ;?></td>
			    <?php if(count($income))
			   { 
                    foreach($income as $inc)
                    {
                      if($new_cust->id == $inc->user_id)
                      {

                      ?>
                       <td><?= number_format($inc->total_amount); ?>/-</td>
                      <?php
                      }

                    }
                } 
                else
                {
                ?>
                  <td>0</td>
                <?php
                }?>
			    		</tr>
	    	    <?php endforeach;
	            else:
	            	$count = 0;
	            	?>
	                    <tr>
                        	<td colspan="7">No new Customer this Week</td>
                        </tr>
	            <?php endif;?> 
	            <tr>
                  <td colspan="7">
                    <div id="pagination">
                      <?= $this->pagination->create_links();?>
                    </div>
                  </td>
                </tr> 
            </table>
        </div>
    </div>  
</div>    	
        

<!-- body section -->
<?php $this->load->view('home/js-file');?>
<?php $this->load->view('admin/custom_js');?>
</body>
</html>
