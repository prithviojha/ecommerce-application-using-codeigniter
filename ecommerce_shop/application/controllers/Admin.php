<?php

/**
 * 
 */
class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// main model load
		$this->load->model('main','cm');
		$this->load->library('session');
	}

	public function index()
	{
		if($this->session->userdata('admin_id') == "")

		{
			$this->load->view('admin/login');
		}
		else
		{
			return redirect('admin/dashboard');
		}
	}
	public function loggedin()
	{
		$args = ['username'=>$this->input->post('user_name'),'password'=>$this->input->post('password')];
        $result=$this->cm->login_auth('ms_admin',$args);
        if(count($result))
		{
           $admin_session_data = ['admin_id'=>$result[0]->id,
           'admin_fullname'=> $result[0]->fullname,
           'admin_username'=>$result[0]->username];
           $this->session->set_userdata($admin_session_data);
           $response = '1';
           echo $response;
        }
		else
		{
		   $response = '0';	
           echo $response;
		}
	}
	public function dashboard()
	{
		if($this->session->userdata('admin_id')=="")
		{
			return redirect('admin/index');
		}
		else
		{
			$order = [
				'column_name' => 'count_sales',
				'order' => 'desc'
			];
			$data['top_sold_products'] = $this->cm->fetch_all_records_with_order('ms_products',$order,'5');
			// Order Chart data
			$args = [
				'order_date' => date('Y-m-d')
			];
			$today_orders_data = $this->cm->fetch_records_by_args('ms_orders',$args);

    			$args = [
				'order_date' => date('Y-m-d',strtotime("-1 day"))
			];
			$yesterday_orders_data = $this->cm->fetch_records_by_args('ms_orders',$args);
      
      $args = [
				'order_date' => date('Y-m-d',strtotime("-2 day"))
			];
			$last_3day_order = $this->cm->fetch_records_by_args('ms_orders',$args);


      $args = [
				'order_date' => date('Y-m-d',strtotime("-3 day"))
			];
			$last_4day_order = $this->cm->fetch_records_by_args('ms_orders',$args);


      $args = [
				'order_date' => date('Y-m-d',strtotime("-4 day"))
			];
			$last_5day_order = $this->cm->fetch_records_by_args('ms_orders',$args);


      $args = [
				'order_date' => date('Y-m-d',strtotime("-5 day"))
			];
			$last_6day_order = $this->cm->fetch_records_by_args('ms_orders',$args);


      $args = [
				'order_date' => date('Y-m-d',strtotime("-6 day"))
			];
			$last_7day_order = $this->cm->fetch_records_by_args('ms_orders',$args);

			$data['chart_data'] = [
				'ch_today_order' => count($today_orders_data),
				'ch_yesterday_order' => count($yesterday_orders_data),
				'ch_last_3_day_order' => count($last_3day_order),
				'ch_last_4_day_order' => count($last_4day_order),
				'ch_last_5_day_order' => count($last_5day_order),
				'ch_last_6_day_order' => count($last_6day_order),
				'ch_last_7_day_order' => count($last_7day_order)
			];
			// Order Chart data
			$this->load->view('admin/dashboard',$data);
		}
	}
	public function logout()
	{
		$this->session->unset_userdata('admin_id');
		$this->session->unset_userdata('admin_fullname');
		$this->session->unset_userdata('admin_username');
		return redirect('admin/index');
	}
	public function add_category()
	{
		if($this->session->userdata('admin_id')=="")
		{
			return redirect('admin/index');
		}
		else
		{
			$args=['date>=' => date('Y-m-d',strtotime("-7 days"))];
			$data['categories'] = $this->cm->fetch_records_by_args('ms_categories',$args);
			$this->load->view('admin/add_category',$data);
		}

	}
	public function upload_category()
	{
		if($this->session->userdata('admin_id')=="")
		{
			return redirect('admin/index');
		}
		else
		{   
			$config = ['upload_path' => './uploads/category_image','allowed_types' => 'jpg|jpeg|png|gif'];
			$this->load->library('upload',$config);
			$this->upload->do_upload('category_image');
			$img = $this->upload->data('file_name');
			$categoryname = $this->input->post('category_name');
			$data = ['category_name'=> $categoryname,'image' => $img,'status' => '0','date' => date('Y-m-d')];
			if($data['category_name'] == "" && $data['image'] == "")
			{ 
            $this->session->set_flashdata('error','Please Enter required info.');
			}
			else
			{
			$result = $this->cm->insert_data('ms_categories',$data);
			if($result == true)
			{
				
				$this->session->set_flashdata('success','Category Added Successfully');
			}
			else
			{
				$this->session->set_flashdata('error','Error Adding Category');
			}
			}
			
			return redirect('admin/add_category');
			

		}

	}
	public function manage_category()
	{
		if($this->session->userdata('admin_id')=="")
		{
			return redirect('admin/index');
		}
		else
		{
			$data['categories'] = $this->cm->fetch_all_records('ms_categories','desc','limit');
			$this->load->view('admin/manage_category',$data);
		}

	}
	public function delete_category($id = "")
	{
		if($this->session->userdata('admin_id')=="")
		{
			return redirect('admin/index');
		}
		else
		{
			if($id == '')
			{
              $this->session->set_flashdata('error','Please Pass Category Id');
			}
			else
			{
				$args = ['id' => $id];
				$result = $this->cm->delete_record_by_args('ms_categories',$args);
				if($result == true)
				{
                  $this->session->set_flashdata('success','Category Deleted Successfully');
				}
				else
				{
                  $this->session->set_flashdata('error','Fail to Delete Category');
				}
			}
			return redirect('admin/manage_category');
		}

	}
	public function edit_category($id = "")
	{
		if($this->session->userdata('admin_id')=="")
		{
			return redirect('admin/index');
		}
		else
		{
			if($id == '')
			{
              $this->session->set_flashdata('error','Please Pass Category Id');
			}
			else
			{
				$args = ['id' => $id];
				$data['category'] = $this->cm->fetch_records_by_args('ms_categories',$args);
				$args=['date>=' => date('Y-m-d',strtotime("-7 days"))];
			    $data['categories'] = $this->cm->fetch_records_by_args('ms_categories',$args);
				$this->load->view('admin/edit_category',$data);
			}

		}
	}
	public function update_category($id)
	{
		if($this->session->userdata('admin_id') == "")
		{
			return redirect('admin/index');
		}
		else
		{   
			$config = ['upload_path' => './uploads/category_image','allowed_types' => 'jpg|jpeg|png|gif'];
			$this->load->library('upload',$config);
			// check image
			// print_r($_FILES);
			// //die();
			if($_FILES['category_image']['name'] == '')
			{

			}
			else
			{
				$args = ['id' => $id];
				$old_data = $this->cm->fetch_records_by_args('ms_categories',$args);
				// delete old image
				unlink('uploads/category_image/'.$old_data[0]->image);
				// delete old image
				$this->upload->do_upload('category_image');
				$img = $this->upload->data('file_name');
                $data['image'] = $img;
			}
			// check image
		    $data['category_name'] = $this->input->post('category_name');
			if($data['category_name'] == "")
			{ 
            $this->session->set_flashdata('error','Please Enter Category Name');
			}
			else
			{
		   
			$args = ['id' => $id];
			$result = $this->cm->update_record_by_args('ms_categories',$data,$args);
            
			if($result == true)
			{
				
				$this->session->set_flashdata('success','Category Update Successfully');
			}
			else
			{
				$this->session->set_flashdata('error','Error on Updating Category');
			}
			}
			
            
			return redirect('admin/edit_category/'.$id);
			

		}

	}
    public function search_category()
	{
		if($this->session->userdata('admin_id') == "")
		{
			return redirect('admin/index');
		}
		else
		{
			$args = ['category_name' => $this->input->post('category_name')];
			$data['categories'] = $this->cm->fetch_records_by_args_with_like('ms_categories',$args);
			$this->load->view('admin/manage_category',$data);
		}
	}
	  public function filter_category($filter)
	{
		if($this->session->userdata('admin_id') == "")
		{
			return redirect('admin/index');
		}
		else
		{
			if($filter == 'new_category')
			{
				$order = ['column_name' => 'id','order' => 'desc'];

			}
			else if($filter == 'old_category')
			{
				$order = ['column_name' => 'id','order' => 'asc'];

			}
			else if($filter == 'highest_products')
			{
				$order = ['column_name' => 'count_products','order' => 'desc'];

			}
			else if($filter == 'lowest_products')
			{
				$order = ['column_name' => 'count_products','order' => 'asc'];

			}
			else
			{
				$order = ['column_name' => 'id','order' => 'desc'];

			}
			$data['categories'] = $this->cm->fetch_records_by_order('ms_categories',$order);
			$this->load->view('admin/manage_category',$data);

		}
	}

    public function add_product()
	{
		if($this->session->userdata('admin_id') == "")
		{
			return redirect('admin/index');
		}
		else
		{
			$data['category'] = $this->cm->fetch_all_records('ms_categories','desc','limit');
			$data['categories'] = $this->cm->fetch_all_record('ms_products','desc','1');
			$this->load->view('admin/upload_product',$data);
    }
    }
      public function save_product()
	{
		if($this->session->userdata('admin_id') == "")
		{
			return redirect('admin/index');
		}
		else
		{
			$config = ['upload_path' => './uploads/product_image','allowed_types' => 'jpg|jpeg|png|gif'];
			$this->load->library('upload',$config);
            $this->upload->do_upload('product_image');
            $img = $this->upload->data('file_name');
			$data = [
				'product_title' => $this->input->post('product_name'),
				'image'         =>$img,
				'category_id'   => $this->input->post('category_id'),
				'short_description' => $this->input->post('short_desc'),
				'color'         => $this->input->post('color'),
				'weight'        => $this->input->post('weight'),
				'price'         => $this->input->post('price'),
				'status'        => '0',
				'upload_date'   => date('Y-m-d')
			];
			if($data['product_title'] == '' && $data['image'] == '' && $data['price'] == '')
			{
				$this->session->set_flashdata('error','Please Enter Required Information');
			}
			else
			{
				$result = $this->cm->insert_data('ms_products',$data);

				if($result == true)
				{
          $args = ['id' => $this->input->post('category_id')];
          $category_data = $this->cm->fetch_records_by_args('ms_categories',$args);
          //print_r($category_data);
          $count_product_old = $category_data[0]->count_products;
          $data = ['count_products' => $count_product_old+1 ];
          $this->cm->update_record_by_args('ms_categories',$data,$args);
          //die();
          $this->session->set_flashdata('success','Product Added Successfully');
				}
				else
				{
					$this->session->set_flashdata('error','Fail to add product');
				}
			}
			return redirect('admin/add_product');

		}

    }
  public function change_category_status($id,$status)
	{
		if($this->session->userdata('admin_id') == "")
		{
			return redirect('admin/index');
		}
		else
		{
      $args = ['id' => $id];
      $data = ['status' => $status];
      $result = $this->cm->update_record_by_args('ms_categories',$data,$args);
      if($result == true)
      {
        $this->session->set_flashdata('success','Category Status Updated Successfully');
      }
      else
      {
      	$this->session->set_flashdata('error','Failed To Update Category Status Successfully');
      }
      return redirect('admin/manage_category');
		}
	}
	 public function manage_products()
	{
		if($this->session->userdata('admin_id') == "")
		{
			return redirect('admin/index');
		}
		else
		{
			// Create Pagination
			$config['base_url'] = base_url('admin/manage_products');
			$config['per_page'] = 10;
			$config['total_rows'] = $this->db->count_all('ms_products');
			$this->load->library('pagination',$config);
			$order = ['column_name' => 'id','order' => 'desc'];
			// Create Pagination
			$data['products'] = $this->cm->fetch_all_records_with_pagination('ms_products',$order,$config['per_page'],$this->uri->segment(3));
			$this->load->view('admin/manage_products',$data);
		}
  }
   public function delete_product($id = 0)
	{
		if($this->session->userdata('admin_id') == "")
		{
			return redirect('admin/index');
		}
		else
		{
      $args = ['id' => $id];
      $product = $this->cm->fetch_records_by_args('ms_products',$args);
      // delete image in folder
      unlink('uploads/product_image/'.$product[0]->image);
      // delete image in folder
      $result = $this->cm->delete_record_by_args('ms_products',$args);
      if($result == true)
      {
        $this->session->set_flashdata('success','Product Deleted Successfully');

      }
      else
      {
        $this->session->set_flashdata('error','Fail to Delete Product');

      }
      return redirect('admin/manage_products');
		}
	}
	  public function change_product_status($id,$status)
	{
		if($this->session->userdata('admin_id') == "")
		{
			return redirect('admin/index');
		}
		else
		{
			$args = ['id' => $id];
			$data = ['status' => $status];
			$result = $this->cm->update_record_by_args('ms_products',$data,$args);
			if($result == true)
			{
				$this->session->set_flashdata('success','Product Status Updated Successfully');
			}
			else
			{
				$this->session->set_flashdata('error','Fail to Update Product Status');
			}
			return redirect('admin/manage_products');

		}
	}
	  public function filter_product($filter)
	{
	  if($this->session->userdata('admin_id') == "")
		{
			return redirect('admin/index');
		}
		else
		{
			if($filter == 'new_product')
			{
				$order = ['column_name' => 'id','order' => 'desc'];

			}
			else if($filter == 'old_product')
			{
				$order = ['column_name' => 'id','order' => 'asc'];

			}
			else if($filter == 'highest_price')
			{
				$order = ['column_name' => 'price','order' => 'desc'];

			}
			else if($filter == 'lowest_price')
			{
				$order = ['column_name' => 'price','order' => 'asc'];

			}
			else
			{
				$order = ['column_name' => 'id','order' => 'desc'];

			}
			// Create Pagination
			$config['base_url'] = base_url('admin/filter_product/'.$filter);
			$config['per_page'] = 10;
			$config['total_rows'] = $this->db->count_all('ms_products');
			$this->load->library('pagination',$config);
			// Create Pagination
			$data['products'] = $this->cm->fetch_all_records_with_pagination('ms_products',$order,$config['per_page'],$this->uri->segment(3));
			$this->load->view('admin/manage_products',$data);
		}
		
	}
	public function search_product()
	{
	  if($this->session->userdata('admin_id') == "")
		{
			return redirect('admin/index');
		}
		else
		{
		  $args = ['product_title' => $this->input->post('product_name')];
		  $order = ['column_name' => 'id','order' => 'desc'];
		  // Create Pagination
			$config['base_url'] = base_url('admin/search_product/');
			$config['per_page'] = 10;
			$config['total_rows'] = count($this->cm->fetch_records_by_args_with_like('ms_products',$args));
			$this->load->library('pagination',$config);
			// Create Pagination
			$data['products'] = $this->cm->fetch_records_by_like_with_pagination('ms_products',$args,$order,$config['per_page'],$this->uri->segment(3));
			$this->load->view('admin/manage_products',$data);
    }
	}
		public function edit_product($id = 0)
	{
	  if($this->session->userdata('admin_id') == "")
		{
			return redirect('admin/index');
		}
		else
		{
			$args = ['id' => $id];
			$data['product'] = $this->cm->fetch_records_by_args('ms_products',$args);
      $data['categories'] = $this->cm->fetch_all_records('ms_categories','desc','limit');
      $this->load->view('admin/edit_product',$data);
    }
	}
	public function update_product($id)
	{
		if($this->session->userdata('admin_id') == "")
		{
			return redirect('admin/index');
		}
		else
		{   
			$config = ['upload_path' => './uploads/product_image','allowed_types' => 'jpg|jpeg|png|gif'];
			$this->load->library('upload',$config);
			
			if($_FILES['product_image']['name'] == '')
			{

			}
			else
			{
				$args = ['id' => $id];
				$old_data = $this->cm->fetch_records_by_args('ms_products',$args);
				// delete old image
				unlink('uploads/product_image/'.$old_data[0]->image);
				// delete old image
				$this->upload->do_upload('product_image');
				$img = $this->upload->data('file_name');
                $data['image'] = $img;
			}
			// check image
		    $data['product_title'] = $this->input->post('product_title');
		    $data['category_id'] = $this->input->post('category_id');
		    $data['short_description'] = $this->input->post('short_desc');
		    $data['color'] = $this->input->post('color');
		    $data['weight'] = $this->input->post('weight');
		    $data['price'] = $this->input->post('price');
			if($data['product_title'] == "" && $data['category_id'] == '' && $data['price'])
			{ 
            $this->session->set_flashdata('error','Please Enter Required Details!');
			}
			else
			{
		   
			$args = ['id' => $id];
			$result = $this->cm->update_record_by_args('ms_products',$data,$args);
            
			if($result == true)
			{
				
				$this->session->set_flashdata('success','Product Updated Successfully');
			}
			else
			{
				$this->session->set_flashdata('error','Error on Updating Product!');
			}
			}
			
            
			return redirect('admin/edit_product/'.$id);
			

		}

	}
		public function manage_orders()
	{
		if($this->session->userdata('admin_id') == "")
		{
			return redirect('admin/index');
		}
		else
		{
				// Create Pagination
			$config['base_url'] = base_url('admin/manage_orders');
			$config['per_page'] = 10;
			$config['total_rows'] = $this->db->count_all('ms_orders');
			$this->load->library('pagination',$config);
			$order = ['column_name' => 'order_date','order' => 'desc'];
			// Create Pagination
			$data['orders'] = $this->cm->fetch_all_records_with_pagination('ms_orders',$order,$config['per_page'],$this->uri->segment(3));
      $this->load->view('admin/manage_orders',$data);
		}
	}
	public function pending_orders()
	{
		if($this->session->userdata('admin_id') == "")
		{
			return redirect('admin/index');
		}
		else
		{
			$args = [
				'order_status!=' => 'Delivered'
			];
				// Create Pagination
			$config['base_url'] = base_url('admin/pending_orders');
			$config['per_page'] = 10;
			$config['total_rows'] = count($this->cm->fetch_records_by_args('ms_orders',$args));
			// echo $config['total_rows'];
			// die();
			// $config['total_rows'] = $this->db->count_all('ms_orders');
			$this->load->library('pagination',$config);
			$order = ['column_name' => 'order_date','order' => 'desc'];
			// Create Pagination
			$data['orders'] = $this->cm->fetch_all_records_by_args_with_pagination('ms_orders',$args,$order,$config['per_page'],$this->uri->segment(3));
      $this->load->view('admin/manage_orders',$data);
		}
	}
	public function delivered_orders()
	{
		if($this->session->userdata('admin_id') == "")
		{
			return redirect('admin/index');
		}
		else
		{
			$args = [
				'order_status=' => 'Delivered'
			];
				// Create Pagination
			$config['base_url'] = base_url('admin/delivered_orders');
			$config['per_page'] = 10;
			$config['total_rows'] = count($this->cm->fetch_records_by_args('ms_orders',$args));
			// echo $config['total_rows'];
			// die();
			// $config['total_rows'] = $this->db->count_all('ms_orders');
			$this->load->library('pagination',$config);
			$order = ['column_name' => 'order_date','order' => 'desc'];
			// Create Pagination
			$data['orders'] = $this->cm->fetch_all_records_by_args_with_pagination('ms_orders',$args,$order,$config['per_page'],$this->uri->segment(3));
      $this->load->view('admin/manage_orders',$data);
		}
	}
	public function search_orders()
	{
		if($this->session->userdata('admin_id') == "")
		{
			return redirect('admin/index');
		}
		else
		{
			$args = ['id' => $this->input->post('order_id')];
		  $order = ['column_name' => 'id','order' => 'desc'];
		  // Create Pagination
			$config['base_url'] = base_url('admin/search_orders/');
			$config['per_page'] = 10;
			$config['total_rows'] = count($this->cm->fetch_records_by_args_with_like('ms_products',$args));
			$this->load->library('pagination',$config);
			// Create Pagination
			$data['orders'] = $this->cm->fetch_records_by_like_with_pagination('ms_orders',$args,$order,$config['per_page'],$this->uri->segment(3));
			$this->load->view('admin/manage_orders',$data);

		}

	}
			public function order_delete($order_id = 0)
	{
		if($this->session->userdata('admin_id') == "")
		{
			return redirect('admin/index');
		}
		else
		{
			$args = [
				'order_id' => $order_id
			];
			$result = $this->cm->delete_record_by_args('ms_order_products',$args);
			$args = [
				'id' => $order_id
			];
			$result = $this->cm->delete_record_by_args('ms_orders',$args);
			if($result == true)
			{
				$this->session->set_flashdata('success','Order Deleted Successfully');
			}
			else
			{
				$this->session->set_flashdata('error','Fail to Deleted Order');
			}
			return redirect('admin/manage_orders');
		}
	}
	public function view_order($order_id)
	{
		if($this->session->userdata('admin_id') == "")
		{
			return redirect('admin/index');
		}
		else
		{
			$args = [
				'id' => $order_id
			];
			$data['order_details'] = $this->cm->fetch_records_by_args('ms_orders',$args);
			$args = [
				'order_id' => $order_id
			];
			$data['product_list'] = $this->cm->fetch_records_by_args('ms_order_products',$args);
       $this->load->view('admin/order_details',$data);
		}
	}
		public function print_label($order_id)
	{
		if($this->session->userdata('admin_id') == "")
		{
			return redirect('admin/index');
		}
		else
		{
			$args = [
				'id' => $order_id
			];
			$data['order_details'] = $this->cm->fetch_records_by_args('ms_orders',$args);
			$args = [
				'order_id' => $order_id
			];
			$data['product_list'] = $this->cm->fetch_records_by_args('ms_order_products',$args);
      $this->load->view('admin/print_label',$data);
		}
	}
	public function change_order_status($order_id)
	{
		if($this->session->userdata('admin_id') == "")
		{
			return redirect('admin/index');
		}
		else
		{
			// count sold products
			if($this->input->post('status') == "Delivered")
			{
				$args = [
				'order_id' => $order_id
			    ];
			  $check_products = $this->cm->fetch_records_by_args('ms_order_products',$args);
			  $product_ids = "";
			  if(count($check_products))
			  {
			  	foreach($check_products as $check_pro)
			  	{
			  		$product_ids = $check_pro->product_id;
			  		$this->db->insert('ms_sold_products',['product_id'=>$check_pro->product_id]);
			  	}
			  	// Fetch Products
			  	$sold_products = $this->db->select('product_id, COUNT(product_id)')
			  	->from('ms_sold_products')
			  	->where_in('product_id',$product_ids)
			  	->group_by('product_id')
			  	->get()->result_array();
			  	for($i=0;$i<count($sold_products);$i++)
			  	{
			  		$result = $this->db->where('id',$sold_products[$i]['product_id'])
			  		->update('ms_products',['count_sales'=>$sold_products[$i]['COUNT(product_id)']]);
			  	}
			  }
			     
			}
			else
			{

			}
			// count sold products
			$args = [
				'id' => $order_id
			];
			$data = [
				'order_status' => $this->input->post('status')
			];
			$result = $this->cm->update_record_by_args('ms_orders',$data,$args);
			//print_r($result);
			//die();
			if($result == true)
			{
				$this->session->set_flashdata('success','Order Status Updated Successfully.');
			}
			else
			{
				$this->session->set_flashdata('error','Fail To Updated  Order Status.');

			}
			return redirect('admin/view_order/'.$order_id);
		}
	}
	public function all_sales()
	{
		if($this->session->userdata('admin_id') == "")
		{
			return redirect('admin/index');
		}
		else
		{
			$args = [
				'order_status' => 'Delivered'
			];
			$data['sales'] = $this->cm->fetch_all_sales($args);
			$this->load->view('admin/sales',$data);

		}
	}
		public function search_sales()
	{
		if($this->session->userdata('admin_id') == "")
		{
			return redirect('admin/index');
		}
		else
		{
			$args = [
				'order_status' => 'Delivered',
				'order_date>=' => $this->input->post('start_date'),
				'order_date<=' => $this->input->post('last_date')
			];
			$data['sales'] = $this->cm->fetch_all_sales($args);
			$this->load->view('admin/sales',$data);

		}
	}
	public function today_sales()
	{
		if($this->session->userdata('admin_id') == "")
		{
			return redirect('admin/index');
		}
		else
		{
			$args = [
				'order_status' => 'Delivered',
				'order_date' => date('Y-m-d')
				
			];
			$data['sales'] = $this->cm->fetch_all_sales($args);
			$this->load->view('admin/sales',$data);

		}
	}
		public function count_orders($type)
	{
		if($this->session->userdata('admin_id') == "")
		{
			return redirect('admin/index');
		}
		else
		{
			if($type == 'all')
			{
				$orders = $this->cm->fetch_all_records('ms_orders','desc','limit');
			}
			else if($type == "today")
			{
				$args = [
					'order_date' => date('Y-m-d')
				];
				$orders = $this->cm->fetch_records_by_args('ms_orders',$args);
			}
			else if($type == "yesterday")
			{
				$args = [
					'order_date' => date('Y-m-d',strtotime("-1 day"))
				];
				$orders = $this->cm->fetch_records_by_args('ms_orders',$args);
			}
			else if($type == "last_30_days")
			{
				$args = [
					'order_date>=' => date('Y-m-d',strtotime("-30 days")),
					'order_date<=' => date('Y-m-d')
				];
				$orders = $this->cm->fetch_records_by_args('ms_orders',$args);
			}
			else
			{
				$orders = $this->cm->fetch_all_records('ms_orders','desc','limit');


			}
			echo count($orders);

		} 
	}
	public function count_income($type)
	{
		if($this->session->userdata('admin_id') == "")
		{
			return redirect('admin/index');
		}
		else
		{
			if($type == 'all')
			{
				$income = $this->cm->fetch_all_records_with_sum('ms_orders','total_amount','');
			}
			else if($type == "today")
			{
				$args = [
					'order_date' => date('Y-m-d'),
					'order_status' => 'Delivered'
				];
				$income = $this->cm->fetch_all_records_with_sum('ms_orders','total_amount',$args);
			}
			else if($type == "yesterday")
			{
				$args = [
					'order_date' => date('Y-m-d',strtotime("-1 day")),
					'order_status' => 'Delivered'
				];
				$income = $this->cm->fetch_all_records_with_sum('ms_orders','total_amount',$args);
			}
			else if($type == "last_30_days")
			{
				$args = [
					'order_date>=' => date('Y-m-d',strtotime("-30 days")),
					'order_date<=' => date('Y-m-d'),
					'order_status' => 'Delivered'
				];
				$income = $this->cm->fetch_all_records_with_sum('ms_orders','total_amount',$args);

			}
			else
			{
				$income = $this->cm->fetch_all_records_with_sum('ms_orders','total_amount','');


			}
			//echo count($income).'<br/>';
			//echo $income[0]->id.'<br/>';
			$total_amount = 0;
			$i = 0;
			foreach($income as $inc):
				$total_amount += $income[$i]->total_amount;
        $i += 1;
			endforeach;
			echo $total_amount;	


		} 
	}
	public function count_product($type)
	{
		if($this->session->userdata('admin_id') == "")
		{
			return redirect('admin/index');
		}
		else
		{
			if($type == 'all')
			{
				$product = $this->cm->fetch_all_products('ms_products','');
			}
			else if($type == "today")
			{
				$args = [
					'upload_date' => date('Y-m-d')
				];
				$product = $this->cm->fetch_all_products('ms_products',$args);
			}
			else if($type == "yesterday")
			{
				$args = [
					'upload_date' => date('Y-m-d',strtotime("-1 day")),
				];
				$product = $this->cm->fetch_all_products('ms_products',$args);
			}
			else if($type == "last_30_days")
			{
				$args = [
					'upload_date>=' => date('Y-m-d',strtotime("-30 days")),
					'upload_date<=' => date('Y-m-d'),
				];
				$product = $this->cm->fetch_all_products('ms_products',$args);

			}
			else
			{
				$product = $this->cm->fetch_all_products('ms_products','');


			}
			//echo count($income).'<br/>';
			//echo $income[0]->id.'<br/>';
			// $total_amount = 0;
			// $i = 0;
			// foreach($income as $inc):
			// 	$total_amount += $income[$i]->total_amount;
   //      $i += 1;
			// endforeach;
			echo count($product);	


		} 
	}
	public function count_customer($type)
	{
		if($this->session->userdata('admin_id') == "")
		{
			return redirect('admin/index');
		}
		else
		{
			if($type == 'all')
			{
				$customer = $this->cm->fetch_all_customer('ms_users','');
			}
			else if($type == "today")
			{
				$args = [
					'register_date' => date('Y-m-d')
				];
				$customer = $this->cm->fetch_all_customer('ms_users',$args);
			}
			else if($type == "yesterday")
			{
				$args = [
					'register_date' => date('Y-m-d',strtotime("-1 day")),
				];
				$customer = $this->cm->fetch_all_customer('ms_users',$args);
			}
			else if($type == "last_30_days")
			{
				$args = [
					'register_date>=' => date('Y-m-d',strtotime("-30 days")),
					'register_date<=' => date('Y-m-d'),
				];
				$customer = $this->cm->fetch_all_customer('ms_users',$args);

			}
			else
			{
				$customer = $this->cm->fetch_all_customer('ms_users','');


			}
		
			echo count($customer);	


		} 
	}
	public function all_customers()
	{
		// Create Pagination
			$config['base_url'] = base_url('admin/all_customers');
			$config['per_page'] = 10;
			$config['total_rows'] = $this->db->count_all('ms_users');
			$this->load->library('pagination',$config);
			$order = ['column_name' => 'id','order' => 'desc'];
			// Create Pagination
			$all_customers['all_customer'] = $this->cm->fetch_all_records_with_pagination('ms_users',$order,$config['per_page'],$this->uri->segment(3));

     
    

		//$all_customers['all_customer'] = $this->cm->fetch_all_records('ms_users','desc','limit');

		$args = [
			'order_status' => 'Delivered'
		];
		$all_customers['income'] = $this->cm->fetch_income_from_individual_user('ms_orders','desc','limit',$args);


     


		$this->load->view('admin/all_customers',$all_customers);
	}
	public function new_customers()
	{
		$args = [
			'register_date>=' => date('Y-m-d',strtotime("-7 days")),
			'register_date<=' => date('Y-m-d')

		];

    
				// Create Pagination
			$config['base_url'] = base_url('admin/new_customers');
			$config['per_page'] = 10;
			$config['total_rows'] = count($this->cm->fetch_records_by_args('ms_users',$args));
			// echo $config['total_rows'];
			// die();
			// $config['total_rows'] = $this->db->count_all('ms_orders');
			$this->load->library('pagination',$config);
			$order = ['column_name' => 'id','order' => 'desc'];
			// Create Pagination
			$new_customers['new_customer'] = $this->cm->fetch_all_records_by_args_with_pagination('ms_users',$args,$order,$config['per_page'],$this->uri->segment(3));






		//$new_customers['new_customer'] = $this->cm->fetch_records_by_args('ms_users',$args);
		$data = [
			'order_status' => 'Delivered'
		];
		$new_customers['income'] = $this->cm->fetch_income_from_individual_user('ms_orders','desc','limit',$data);
    $this->load->view('admin/new_customers',$new_customers);
	}

	
}

?>