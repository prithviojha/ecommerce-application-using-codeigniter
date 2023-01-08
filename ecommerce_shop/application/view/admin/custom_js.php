<style type="text/css">
	#preloader{width: 25%;margin-top: 10%}
</style>
<!-- preloader section -->
<div class="modal" id="preloader">
	<div class="modal-content" style="padding: 0px;">
		<h5 style="padding-left: 15px;font-size: 22px;font-weight: 500;">Please Wait...</h5>
		<!-- preloader -->

		<div class="progress" style="background: #ffffff;">
            <div class="indeterminate" style="background: #002366;"></div>
        </div>
		<!-- preloader -->
	</div>
	<div class="modal-content" style="padding: 10px;">
		<h6 id="preloader_heading" style="margin-top: 0px;">Login Your Account</h6>
	</div>
</div>
<!-- preloader section -->
<script type="text/javascript">

	$(function(){
		$('.modal').modal({
			dismissible:false
		});

        $('#btn_signin').click(function()
        {
          var user_name = $('input[name=username]').val();
          var password = $('input[name=password]').val();
          if(user_name=='')
          {
          	M.toast({html:'Please Enter username'});
          }
          else if(password=='')
          {
          	M.toast({html:'Please Enter password'});

          }
          else
          {
              $.ajax({
              	type:'ajax',
              	method:'POST',
              	url:'<?= base_url('admin/loggedin'); ?>',
              	data:{user_name:user_name,password:password},
              	beforeSend:function(data)
              	{
              		$('#preloader').modal('open');
              	},
              	success:function(data)
              	{
              		$('#preloader').modal('close');
              		if(data == '1')
              		{

                      window.location.href = '<?=base_url('admin/dashboard');?>';
              		}
              		else
              		{
                       M.toast({html:'Your Username and Password does not Match'});
              		}
              	},
              	error:function()
              	{
              		$('#preloader').modal('close');
              		alert('Error Admin Login account');
              	}

              });
          }
        });
         	 	
	});
</script>
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light1", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "Last 7 Days Orders"
	},
  data: [{
		type: "column", //change type to bar, line, area, pie, etc
		//indexLabel: "{y}", //Shows y value on all Data Points
		indexLabelFontColor: "#5A5757",
      	indexLabelFontSize: 16,
		indexLabelPlacement: "outside",
		dataPoints: [

      { label:'Today', y: <?= $chart_data['ch_today_order']; ?> },
			{ label:'Yesterday', y: <?= $chart_data['ch_yesterday_order']; ?> },
			{ label:'3rd Days', y: <?= $chart_data['ch_last_3_day_order']; ?> },
			{ label:'4th Days', y: <?= $chart_data['ch_last_4_day_order']; ?> },
			{ label:'5th Days', y: <?= $chart_data['ch_last_5_day_order']; ?> },
			{ label:'6th Days', y: <?= $chart_data['ch_last_6_day_order']; ?> },
			{ label:'7th Days', y: <?= $chart_data['ch_last_7_day_order']; ?> },
		]
	}]
});
chart.render();

}
</script>
<script type="text/javascript">
	// count orders script
        count_orders();
        function count_orders(type = "all")
        {
        	if(type == 'all')
        	{
        		$('#show_orders_heading').text('Life Time');
        	}
          else if(type == 'today')
          {
          	$('#show_orders_heading').text('Today');
          }
          else if(type == 'yesterday')
          {
          	$('#show_orders_heading').text('Yesterday');
          }
          else if(type == 'last_30_days')
          {
          	$('#show_orders_heading').text('Last 30 Days');
          }
          else
          {
          	$('#show_orders_heading').text('Life Time');


          }

                $.ajax({
              	type:'ajax',
              	method:'GET',
              	url:'<?= base_url('admin/count_orders/'); ?>'+type,
              	beforeSend:function(data)
              	{
                   $('#show_orders').text('loading...');  
              	},
              	
              	success:function(data)
              	{
              	  $('#show_orders').html(data);
              	},
              	error:function()
              	{
              		$('#show_orders').text('0');
              	}

              });

        }	
        // count orders script
</script>

        // count income script
        <script type="text/javascript">
	
        count_income();
        function count_income(type = "all")
        {
        	if(type == 'all')
        	{
        		$('#show_income_heading').text('Life Time');
        	}
          else if(type == 'today')
          {
          	$('#show_income_heading').text('Today');
          }
          else if(type == 'yesterday')
          {
          	$('#show_income_heading').text('Yesterday');
          }
          else if(type == 'last_30_days')
          {
          	$('#show_income_heading').text('Last 30 Days');
          }
          else
          {
          	$('#show_income_heading').text('Life Time');


          }

                $.ajax({
              	type:'ajax',
              	method:'GET',
              	url:'<?= base_url('admin/count_income/'); ?>'+type,
              	beforeSend:function(data)
              	{
                   $('#show_income').text('loading...');  
              	},
              	
              	success:function(data)
              	{
              	  $('#show_income').html(data);
              	},
              	error:function()
              	{
              		$('#show_income').text('0');
              	}

              });

        }	
        // count income script
</script>
        // count product script
<script type="text/javascript">
	
        count_products();
        function count_products(type = "all")
        {
        	if(type == 'all')
        	{
        		$('#show_product_heading').text('Life Time');
        	}
          else if(type == 'today')
          {
          	$('#show_product_heading').text('Today');
          }
          else if(type == 'yesterday')
          {
          	$('#show_product_heading').text('Yesterday');
          }
          else if(type == 'last_30_days')
          {
          	$('#show_product_heading').text('Last 30 Days');
          }
          else
          {
          	$('#show_product_heading').text('Life Time');


          }

                $.ajax({
              	type:'ajax',
              	method:'GET',
              	url:'<?= base_url('admin/count_product/'); ?>'+type,
              	beforeSend:function(data)
              	{
                   $('#show_product').text('loading...');  
              	},
              	
              	success:function(data)
              	{
              	  $('#show_product').html(data);
              	},
              	error:function()
              	{
              		$('#show_product').text('0');
              	}

              });

        }	
        // count customer script
</script>
// count product script
<script type="text/javascript">
	
        count_customer();
        function count_customer(type = "all")
        {
        	if(type == 'all')
        	{
        		$('#show_customer_heading').text('Life Time');
        	}
          else if(type == 'today')
          {
          	$('#show_customer_heading').text('Today');
          }
          else if(type == 'yesterday')
          {
          	$('#show_customer_headingv').text('Yesterday');
          }
          else if(type == 'last_30_days')
          {
          	$('#show_customer_heading').text('Last 30 Days');
          }
          else
          {
          	$('#show_customer_heading').text('Life Time');


          }

                $.ajax({
              	type:'ajax',
              	method:'GET',
              	url:'<?= base_url('admin/count_customer/'); ?>'+type,
              	beforeSend:function(data)
              	{
                   $('#show_customer').text('loading...');  
              	},
              	
              	success:function(data)
              	{
              	  $('#show_customer').html(data);
              	},
              	error:function()
              	{
              		$('#show_customer').text('0');
              	}

              });

        }	
        // count customer script
</script>