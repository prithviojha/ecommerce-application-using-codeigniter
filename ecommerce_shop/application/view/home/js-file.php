   <style type="text/css">
      #product_detail_modal{width: 80%;}
   </style>
	<!-- view product details modal -->
   <div class="modal" id="product_detail_modal">
      
   </div>
   <!-- view product details modal -->
   <!-- preloader section -->
<div class="modal" id="preloader">
   <div class="modal-content" style="padding: 0px;">
      <h5 style="padding-left: 15px;font-size: 22px;font-weight: 500;">Please Wait...</h5>
      <!-- preloader -->

      <div class="progress" style="background: #ffffff;">
            <div class="indeterminate" style="background: #002366;"></div>
        </div>
      <!-- preloader -->
   <!-- jquery file included -->
    <script type="text/javascript" src="<?= base_url('assets/jquery/jquery.js');?>"></script>
    <!-- materialize js file included -->
    <script type="text/javascript" src="<?= base_url('assets/materialize/js/materialize.js');?>"></script>
    <!-- chart js file included -->
    <script type="text/javascript" src="<?= base_url('assets/chart/chart.js');?>"></script>
    <!-- custom js file -->
    <script type="text/javascript">

    	$(document).ready(function(){
         // modal script
         $('.modal').modal();
         //$('#product_detail_modal').modal('open');
         // modal script
        //collapsible script
        $('.collapsible').collapsible();
        //sidenav script
        $('.sidenav').sidenav();
    		// dropdown script
            $('.dropdown-trigger').dropdown({
               coverTrigger:false
           });
            $('.carousel.carousel-slider').carousel({
               fullWidth: true,
               indicators: true
            });
    	});
    </script>
    <!-- custom js file -->
    <!-- custom ajax script -->
    <script type="text/javascript">
       function view_product_details(product_id)
       {
         //alert(product_id);
         $.ajax({
            type:'ajax',
            method:'GET',
            url:'<?= base_url('home/get_product_details/');?>'+product_id,
            beforeSend:function()
            {
               $('#preloader').modal('open');
               $('#preloader_heading').text('fetch product Details');

            },
            success:function(data)
            {
               $('#product_detail_modal').modal('open');
               $('#product_detail_modal').html(data);
               $('#preloader').modal('close');
               $('#preloader_heading').text('fetch product details');

            },
            error:function()
            {
               alert('Error! Product Details');
            }
         });
       }
       // add to cart script
        function add_to_cart(product_id)
       {
         //alert(product_id);
         $.ajax({
            type:'ajax',
            method:'GET',
            url:'<?= base_url('home/add_to_cart/'); ?>'+product_id,
            beforeSend:function()
            {
               $('#preloader').modal('open');
               $('#preloader_heading').text('Product Add in Your Cart.');

            },
            success:function(data)
            {
               $('#preloader').modal('close');
               if(data == "1")
               {
                  M.toast({html:'Product Successfully add in cart.'});
                  calculate_carts_products();

               }
               else
               {
                  M.toast({html:'Product Not Add in Cart.'});
               }
            },
            error:function()
            {
               alert('Error! Add to cart');
            }
         });
       }
       // add to cart script
       //update quantity script
       function update_quantity(type,product_id,id)
       {
         var qname = "quantity_"+id;
         var quantity = $('input[name="'+qname+'"]').val();
         $.ajax({
            type:'ajax',
            method:'GET',
            url:'<?= base_url('home/update_quantity/'); ?>'+quantity+'/'+type+'/'+product_id,
            beforeSend:function()
            {
               $('#preloader').modal('open');
               $('#preloader_heading').text('Update Product Quantity.');

            },
            success:function(data)
            {
               $('#preloader').modal('close');
               if(data == "1")
               {
                  M.toast({html:'Product Quantity Update Successfully.'});
                  location.reload();
               }
               else
               {
                  M.toast({html:'Product Quantity Update Fail.'});
               }
            },
            error:function()
            {
               alert('Error! Update Quantity');
            }
         });
       }
       //update quantity script

       //calculate carts products script
       calculate_carts_products();
       function calculate_carts_products()
       {
         $.ajax({
            type:'ajax',
            method:'GET',
            url:'<?= base_url('home/calculate_carts_products'); ?>',
            beforeSend:function()
            {
               //$('#preloader').modal('open');
               //$('#preloader_heading').text('Update Product Quantity.');

            },
            success:function(data)
            {
               //$('#preloader').modal('close');
               var json_data = JSON.parse(data);
               $('#total_products').html(json_data.total_products);
               $('#total_amount').html(json_data.total_amount);
            },
            error:function()
            {
               alert('Error! Update Quantity');
            }
         });

       }
       //calculate carts products script
       // search product script
       $('body').click(function()
       {
         $('#show_product_list').hide();
       });
       function search_products(val)
       {
         //alert(val);
         if(val.length > 1)
         {
            $.ajax({
            type:'ajax',
            method:'GET',
            url:'<?= base_url('home/search_products/'); ?>'+val,
            beforeSend:function()
            {
               //$('#preloader').modal('open');
               //$('#preloader_heading').text('Update Product Quantity.');

            },
            success:function(data)
            {
               $('#show_product_list').show();
               $('#show_product_list').html(data);
            },
            error:function()
            {
               alert('Error! Product Quantity');
            }
         });


         }
         
       }
       // search product script
    </script>
    <!-- custom ajax script -->