<?php

/**
 * 
 */
class Home extends CI_Controller
{
	private $user_profile;
	public function __construct()
	{
		parent::__construct();
		// main model load
		$this->load->model('main','cm');

		//get user details
        $args = [
              'email' => $this->session->userdata('email'),
              'password' => $this->session->userdata('password')
        ];
		$this->user_profile = $this->cm->fetch_records_by_args('ms_users',$args);

	}

	public function index()
	{
		$args = ['status' => '0',];
		$data['categories']=$this->cm->fetch_records_by_args('ms_categories',$args);
		$this->load->view('home/index',$data);
	}
	public function user_signup($page = "")
	{
		$this->load->view('home/user_signup',['page'=>$page]);
	}
	public function user_registerd($page = "")
	{
		$data = [
			'fullname' => $this->input->post('full_name'),
			'email' => $this->input->post('email'),
			'mobile_no' => $this->input->post('mobile'),
			'password' => $this->input->post('Password'),
			'address' => $this->input->post('address'),
			'register_date' => date('Y-m-d')
		];
		//print_r($data);
		//die();
		if($data['fullname'] == "" || $data['email'] == "" || $data['mobile_no'] == "" || $data['password'] == "" || $data['address'] == "")
		{
			$this->session->set_flashdata('error','Please Enter Required Info.');
             return redirect('home/user_signup/'.$page); 
		}
		else
		{
			$args = [
				'email' => $data['email'],
				];
			$result = $this->cm->fetch_records_by_args('ms_users',$args);
			if(count($result))
			{
				$this->session->set_flashdata('error','Email Already Exits');
				return redirect('home/user_signup/'.$page);
			}	
			$result = $this->cm->insert_data('ms_users',$data);
			if($result == true)
			{
				$user_session = [
					'email' => $data['email'],
					'password' => $data['password']
				];
				$this->session->set_userdata($user_session);
				if($page == 'cart')
				{
					$this->session->set_flashdata('success','User Registerd Successfully.');
					return redirect('home/place_order');
				}
				else
				{
					$this->session->set_flashdata('success','User Registerd Successfully.');
					return redirect('home');
				}
			}
			else
			{
              $this->session->set_flashdata('error','User Registerd Fail.');
              return redirect('home/user_signup/'.$page);
			}
		}
	}

	public function user_signin($page = "")
	{
		$this->load->view('home/user_signin',['page'=>$page]);
	}
	public function user_logged_in($page = " ")
	{
		//echo 'page:-'.$page.'<br/>';
		$args = [
              'email' => $this->input->post('email'),
              'password' => $this->input->post('Password')
		];
		//print_r($args);
		$result = $this->cm->fetch_records_by_args('ms_users',$args);
		if($result == true)
		{
			//echo 'result'.'<br/>';
			//echo 'page:-'$page;
			//die();
			$user_session = [
				'email' => $args['email'],
				'password' => $args['password']
			];

			$this->session->set_userdata($user_session);
			$this->session->set_flashdata('success','Your are Logged in now');

			if($page == "cart")
			{
				return redirect('home/place_order');

			}
			else
			{
                return redirect('home/index');
			}
		}
		else
		{
			$this->session->set_flashdata('error','Your Username and Password Incorrect');
			return redirect('home/user_signin/'.$page);

		}
	}
	public function carts()
	{
		$args = [
			'session_id' => $this->session->userdata('session_id')
		];
		$data['products'] = $this->cm->fetch_records_by_args('ms_carts',$args);
		$this->load->view('home/my_cart',$data);
	}
	public function remove_product($product_id = 0)
	{
		$args = [
			'product_id' => $product_id,
			'session_id' => $this->session->userdata('session_id')
			];
		$result = $this->cm->delete_record_by_args('ms_carts',$args);
		if($result == true)
		{
			$this->session->set_flashdata('success','Product Removed Successfully From Cart.');
        }
        else
        {
        	$this->session->set_flashdata('error','Fail To Remove Item From Cart');
        }
        return redirect('home/carts');	
	}
	public function update_quantity($quantity,$type,$product_id)
	{
		if($type == 'add')
		{
           $new_qty = $quantity + 1;
           $args = [
           	'product_id' => $product_id
           ];
           $data = [
           	'quantity' => $new_qty
           ];
           $result = $this->cm->update_record_by_args('ms_carts',$data,$args);
		}
		else
		{
			if($quantity > 1)
			{
				$new_qty = $quantity - 1;
	            $args = [
	           	'product_id' => $product_id
	           ];
	           $data = [
	           	'quantity' => $new_qty
	           ];
	           $result = $this->cm->update_record_by_args('ms_carts',$data,$args);

			}
			else
			{
               $result = false;
			}
           
		}
		if($result == true)
		{
			echo '1';
		}
		else
		{
			echo '0';
		}
	}
	public function calculate_carts_products()
	{
		$args = [
			'session_id' => $this->session->userdata('session_id')
		];
		$products = $this->cm->fetch_records_by_args('ms_carts',$args);
		$cal_amount = 0;
		if(count($products))
		{
			foreach($products as $product)
			{
				$cal_amount += ($product->rate * $product->quantity);

			}

		}
		else
		{
			$cal_amount = 0;
		}
		$data = [
			     'total_products' => count($products),
		         'total_amount' => ($cal_amount > 0) ? number_format($cal_amount) : '0'
	            ];
	    echo json_encode($data);        
	}
	public function category_products($id = '')
	{
		$args = ['category_id' => $id] ;
		$data['products'] = $this->cm->fetch_records_by_args('ms_products',$args);
		$args = ['id' => $id];
		$data['category_detail'] = $this->cm->fetch_records_by_args('ms_categories',$args);
		$this->load->view('home/view_category',$data);
	}
	public function product_filter($id,$order)
	{
		
		
		if($order == 'default')
		{
			$order_format = ['column_name' => 'id','order' => 'desc'];

		}
		else if($order == 'best_match')
		{
			$order_format = ['column_name' => 'count_sales','order' => 'desc'];

		}
		else if($order == 'lowest_price')
		{
			$order_format = ['column_name' => 'price','order' => 'asc'];

		}
		else if($order == 'highest_price')
		{

			$order_format = ['column_name' => 'price','order' => 'desc'];
			
			

		}
		else
		{
			$order_format = ['column_name' => 'id','order' => 'desc'];
		}

		$args = ['category_id' => $id];
		$data['products'] = $this->cm->fetch_records_by_args_with_order('ms_products',$args,$order_format);
		

		$args = ['id' => $id];
		$data['category_detail'] = $this->cm->fetch_records_by_args('ms_categories',$args);

		$this->load->view('home/view_category',$data);

	}
		public function product_detail($id = "")
	
	{
        $args = ['id' => $id];
        $data['product'] = $this->cm->fetch_records_by_args('ms_products',$args);
        $args = ['id!=' => $id,'category_id' => $data['product'][0]->category_id];
        $data['related_products'] = $this->cm->fetch_records_by_args_with_limit('ms_products',$args,'6');
        $this->load->view('home/view_product',$data);
	}
	public function dashboard()
	{
		if($this->session->userdata('email') == "" && $this->session->userdata('password') == "")
		{
			redirect('home/user_signin');
		}
		else
		{
			$user = $this->user_profile;
			$args = [
				'user_id' => $user[0]->id
			];
			$data['orders'] = $this->cm->fetch_records_by_args('ms_orders',$args);
			$args = [
				'session_id' => $this->session->userdata('session_id')
			];
			$data['cart_products'] = $this->cm->fetch_records_by_args('ms_carts',$args);
       
       	$args = [
				'user_id' => $user[0]->id,
				'order_status' => 'Delivered'
			];

			$data['delivered_orders'] = $this->cm->fetch_records_by_args('ms_orders',$args);

		    $this->load->view('home/dashboard',$data);
	    }
	}

		public function my_orders()
	{
		$user = $this->user_profile;
		$args = [
			'user_id' => $user[0]->id
		];
		$data['orders'] = $this->cm->fetch_records_by_args('ms_orders',$args);
		$this->load->view('home/my_orders',$data);
	}
	public function get_product_details($product_id = 0)
	{
		$args = ['id' => $product_id];
		$data['product'] = $this->cm->fetch_records_by_args('ms_products',$args);
		$this->load->view('home/view_product_details_modal',$data);
		
	}
	public function add_to_cart($product_id)
	{
	   if($this->session->userdata('session_id') == "")
	   {
	   	$user_session_id = [
	   		'session_id' => rand(9999,999999)
	   	];
	   	$this->session->set_userdata($user_session_id);
	   }
	   else
	   {
         //$session_id = $this->session->userdata('session_id');
	   }
       $args = ['id' => $product_id];
       $product_details = $this->cm->fetch_records_by_args('ms_products',$args);
       $args = [

                  'product_id' => $product_id,
                  'session_id' => $this->session->userdata('session_id')
       ];
       $check_product =$this->cm->fetch_records_by_args('ms_carts',$args);
       if(count($check_product))
       {
       	$old_qty = $check_product[0]->quantity;
       	$new_qty = $old_qty + 1;
       	$args = ['id' => $check_product[0]->id];
       	$data = ['quantity' => $new_qty];
       	$result = $this->cm->update_record_by_args('ms_carts',$data,$args);
       	if($result == true)
       	{
       		echo '1';
       	}
       	else
       	{
       		echo '0';
       	}

       }
       else
       {
       	$data = [
       	'product_id' => $product_details[0]->id,
       	'session_id' => $this->session->userdata('session_id'),
       	'product_name' => $product_details[0]->product_title,
       	'quantity' => '1',
       	'rate' => $product_details[0]->price
       ];
       
       $result = $this->cm->insert_data('ms_carts',$data);
       
       if($result == true)
       {
       	echo "1";
       }
       else
       {
       	echo '0';
       }

       }
       
	}
	public function buy_now($product_id)
	{
	   if($this->session->userdata('session_id') == "")
	   {
	   	$user_session_id = [
	   		'session_id' => rand(9999,999999)
	   	];
	   	$this->session->set_userdata($user_session_id);
	   }
	   else
	   {
         //$session_id = $this->session->userdata('session_id');
	   }
       $args = ['id' => $product_id];
       $product_details = $this->cm->fetch_records_by_args('ms_products',$args);
       $args = [

                  'product_id' => $product_id,
                  'session_id' => $this->session->userdata('session_id')
       ];
       $check_product =$this->cm->fetch_records_by_args('ms_carts',$args);
       if(count($check_product))
       {
       	$old_qty = $check_product[0]->quantity;
       	$new_qty = $old_qty + 1;
       	$args = ['id' => $check_product[0]->id];
       	$data = ['quantity' => $new_qty];
       	$result = $this->cm->update_record_by_args('ms_carts',$data,$args);
       }
       else
       {
       	$data = [
       	'product_id' => $product_details[0]->id,
       	'session_id' => $this->session->userdata('session_id'),
       	'product_name' => $product_details[0]->product_title,
       	'quantity' => '1',
       	'rate' => $product_details[0]->price
       ];
       
       $result = $this->cm->insert_data('ms_carts',$data);
      }
      return redirect('home/carts');
       
	}
	public function place_order()
	{
		$args = [
			'session_id' => $this->session->userdata('session_id')
		];
		$data['products'] = $this->cm->fetch_records_by_args('ms_carts',$args);
		$this->load->view('home/place_order',$data);
	}
	public function complete_purchased()
	{
		if($this->session->userdata('email') == "" && $this->session->userdata('password') == "")
		{
			redirect('home/user_signin');
		}
		else
		{
		    $args = [
			'session_id' => $this->session->userdata('session_id')
		        ];
		    $products = $this->cm->fetch_records_by_args('ms_carts',$args);
		   // print_r($this->user_profile);
		    $user = $this->user_profile;
		    //get shipping address
		    $args = [
		    	'user_id' => $user[0]->id
		    ];
		     //print_r($args);
		    // die();
		    $temp_address = $this->cm->fetch_records_by_args('ms_temp_address',$args);
		    //get shipping address
           // print_r($temp_address);
            //die();
            $total_quantity = 0;
            $total_amount = 0;
            if(count($products))
            {
            	foreach($products as $pro)
            	{
            		$total_quantity += $pro->quantity;
            		$total_amount += ($pro->quantity * $pro->rate);
            	}
            }
            else
            {
            	$total_quantity = 0;
            }

		    $data = [
		    	'user_id' => $user[0]->id,
		    	'user_name' => $user[0]->fullname,
		    	'total_quantity' => $total_quantity,
		    	'total_amount' => $total_amount,
		    	'order_date' => date('Y-m-d'),
		    	'shipping_address' => $temp_address[0]->address,
		    	'order_status' => 'pending',
		    	'payment_method' => 'Cash on delivery'
		    ];
		    $order_id = $this->cm->insert_data_with_last_id('ms_orders',$data);
		    // Insert other products
		    if(count($products))
            {
            	foreach($products as $pro)
            	{
            		$result = $this->db->insert('ms_order_products',[
            			'order_id' => $order_id,
            			'product_id' => $pro->product_id,
            			'product_name' => $pro->product_name,
            			'quantity' => $pro->quantity,
            			'rate' => $pro->rate
            		]);
            	}
            }
            else
            {

            }
            // insert order products
            $args = [
            	'session_id' => $this->session->userdata('session_id')
            ];
            $result = $this->cm->delete_record_by_args('ms_carts',$args);
            $args = [
            	'user_id' => $user[0]->id
            ];
            $result = $this->cm->delete_record_by_args('ms_temp_address',$args);
            if($result == true)
            {
            	$this->session->set_flashdata('success','Congratulation Your Order Placed Successfully');
            }
            else
            {
            	$this->session->set_flashdata('error','Your Order Fail');
            }
		    // Insert other products
            return redirect('home/dashboard');

		}
	}
	public function esewa_purchased($e_result)
	{
	 if($e_result == 'su')
	 {
		$args = [
			'session_id' => $this->session->userdata('session_id')
		];
		$data = $this->cm->fetch_records_by_args('ms_carts',$args);
		$t_amount = 0;
		if(count($data)):
            foreach($data as $dat):
                $pid = $dat->id; 
                $t_amount += ($dat->quantity * $dat->rate);
            endforeach;
        endif;
        $rid = $_GET['refId'];
        $url = "https://uat.esewa.com.np/epay/transrec";
		$data =[
		    'amt'=> $t_amount,
		    'rid'=> $rid,
		    'pid'=>$pid,
		    'scd'=> 'EPAYTEST'
		];
        //print_r($data);
	    $curl = curl_init($url);
	    curl_setopt($curl, CURLOPT_POST, true);
	    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	    $response = curl_exec($curl);
	    //echo 'response:'.$response;
	   
	    
	    curl_close($curl);
	    
	    
	    //verification
			if($this->session->userdata('email') == "" && $this->session->userdata('password') == "")
			{
				redirect('home/user_signin');
			}
			else
			{
		    $args = [
			'session_id' => $this->session->userdata('session_id')
		        ];
		    $products = $this->cm->fetch_records_by_args('ms_carts',$args);
		    $user = $this->user_profile;
		    $args = [
		    	'user_id' => $user[0]->id
		    ];
		    $temp_address = $this->cm->fetch_records_by_args('ms_temp_address',$args);
		    $total_quantity = 0;
            $total_amount = 0;
            if(count($products))
            {
            	foreach($products as $pro)
            	{
            		$total_quantity += $pro->quantity;
            		$total_amount += ($pro->quantity * $pro->rate);
            	}
            }
            else
            {
            	$total_quantity = 0;
            }

		    $data = [
		    	'user_id' => $user[0]->id,
		    	'user_name' => $user[0]->fullname,
		    	'total_quantity' => $total_quantity,
		    	'total_amount' => $total_amount,
		    	'order_date' => date('Y-m-d'),
		    	'shipping_address' => $temp_address[0]->address,
		    	'order_status' => 'pending',
		    	'payment_method' => 'Payment by Esewa'
		    ];
		    $order_id = $this->cm->insert_data_with_last_id('ms_orders',$data);
		    // Insert other products
		    if(count($products))
            {
            	foreach($products as $pro)
            	{
            		$result = $this->db->insert('ms_order_products',[
            			'order_id' => $order_id,
            			'product_id' => $pro->product_id,
            			'product_name' => $pro->product_name,
            			'quantity' => $pro->quantity,
            			'rate' => $pro->rate
            		]);
            	}
            }
            else
            {

            }
            // insert order products
            $args = [
            	'session_id' => $this->session->userdata('session_id')
            ];
            $result = $this->cm->delete_record_by_args('ms_carts',$args);
            $args = [
            	'user_id' => $user[0]->id
            ];
            $result = $this->cm->delete_record_by_args('ms_temp_address',$args);
            if($result == true)
            {
            	$this->session->set_flashdata('success','Congratulation Payment Successfull');
            	//return redirect('home/dashboard');
            }
            else
            {
            	$this->session->set_flashdata('error','Payment Fail');
            }
		    // Insert other products
        
	  
            return redirect('home/dashboard');

			}
		}

	 else
	 {
	 	$this->session->set_flashdata('error','Payment Fail2');
	 	
	 }
	 return redirect('home/dashboard');
	}
	public function save_temp_address($user_id = 0)
	{
		if($this->session->userdata('email') == "" && $this->session->userdata('password') == "")
		{
			redirect('home/user_signin');
		}
		else
		{
			$data = [
				'user_id' => $user_id,
				'address' => $this->input->post('shipping_address')
			];
			// echo 'address: '.$data['address'];
			// die();
			if($data['user_id'] == " " && $data['address'] == " ")
			{
				$this->session->set_flashdata('error','Please Enter Shipping Address');
				return redirect('home/place_order');
			}
			else
			{
				$result = $this->cm->insert_data('ms_temp_address',$data);
				if($result == true)
				{
					$this->session->set_flashdata('success','Shipping Address save Successfully');
					$user_session = [
				                  'temp_address' => $data,
			                       ];

			        $this->session->set_userdata($user_session);
					
					return redirect('home/place_order',$user_session);
				}
				else
				{
					$this->session->set_flashdata('error','Fail to Save Shipping Address');
					return redirect('home/place_order');
				}

			}
		}
	
	} 
	public function search_products($val)
	{
		//echo "val".$val;
		$args = [
			'product_title' => $val
		];
		$products = $this->cm->fetch_records_by_args_with_like('ms_products',$args);
		//print_r($products);
		//die();
		$output = '';
		if(count($products))
		{
			$i=0;
			foreach($products as $pro)
			{
				$i++;
				$output .= '<a href="'.base_url("home/product_detail/").$pro->id.'">'.$pro->product_title.'</a>';
				 if($i>9): break;
				 endif;
			}
		}
		else
		{
			$output = '<a href="#!">Product Not Found.</a>';
		}
		echo $output;
	}
	function logout()
{
    $user_data = $this->session->all_userdata();
        foreach ($user_data as $key => $value) {
            if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
                $this->session->unset_userdata($key);
            }
        }
    $this->session->sess_destroy();
    redirect('home/index');
}
}

?>