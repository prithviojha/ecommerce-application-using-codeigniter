<?php
 class Main extends CI_Model
{
  public function login_auth($tablename,$args)
  {
  	$fetch_record = $this->db->get_where($tablename,$args);
 
  	if($fetch_record->num_rows()>0)
  	{
  		return $fetch_record->result();
  	}
  	else
  	{
  		return $fetch_record->result();

  	}

  }
  public function insert_data($tablename,$data)
  {
   
    $insert_rec = $this->db->insert($tablename,$data);
    if($this->db->affected_rows() > 0)
    {
      return true;
    }
   else
   {
    return false;
   }

  }
  public function fetch_records_by_args($tablename,$args)
  {
    $this->db->order_by('id','DESC');
    $fetch_record = $this->db->get_where($tablename,$args);
    if($fetch_record->num_rows()>0)
    {
      return $fetch_record->result();
    }
    else
    {
      return $fetch_record->result();

    }
  }
  public function fetch_all_record($tablename,$order,$limit)
  {
    $fetch_rec = $this->db->select()
             ->from($tablename)
             ->order_by('id',$order)
             ->limit($limit)
             ->get();
    if($fetch_rec->num_rows()>0)
    {
      return $fetch_rec->result();
    }
    else
    {
      return $fetch_rec->result();

    }    

  }
  public function fetch_all_records($tablename,$order,$limit)
  {
    if($limit='limit')
    {

    }
    else
    {
      $this->db->limit($limit);
    }
    $fetch_rec = $this->db->select()
             ->from($tablename)
             ->order_by('id',$order)
             ->get();
    if($fetch_rec->num_rows()>0)
    {
      return $fetch_rec->result();
    }
    else
    {
      return $fetch_rec->result();

    }         
  }
 public function fetch_income_from_individual_user($tablename,$order,$limit,$args)
  {
    if($limit='limit')
    {

    }
    else
    {
      $this->db->limit($limit);
    }
     $fetch_rec = $this->db->select('SUM(total_amount) as total_amount,user_id')
             ->from($tablename)
             ->where($args)
             ->group_by('user_id')
             ->order_by('id',$order)
             ->limit($offset)
             ->get();
    if($fetch_rec->num_rows()>0)
    {
      return $fetch_rec->result();
    }
    else
    {
      return $fetch_rec->result();

    } 

  }
  public function delete_record_by_args($tablename,$args)
  {
    $delete_rec = $this->db->delete($tablename,$args);
    if($this->db->affected_rows() > 0)
    {
      return true;
    } 
    else
    {
      return false;
    }
  }
  public function update_record_by_args($tablename,$data,$args)
  {
 
    $update_rec = $this->db->where($args)
             ->update($tablename,$data);
    if($this->db->affected_rows() > 0)
    {
      return true;
    } 
    else
    {
      return false;
    }         
  }
  public function fetch_records_by_args_with_like($tablename,$args)
  {
    $fetch_rec = $this->db->select()
                 ->from($tablename)
                 ->like($args)
                 ->get();
    if($fetch_rec->num_rows()>0)
    {
      return $fetch_rec->result();
    }
    else
    {
      return $fetch_rec->result();

    }              

  }
  public function fetch_records_by_order($tablename,$order_format)
  {
    extract($order_format);
    $fetch_rec = $this->db->select()
                          ->from($tablename)
                          ->order_by($order_format['column_name'],$order_format['order'])
                          ->get();
    if($fetch_rec->num_rows()>0)
    {
      return $fetch_rec->result();
    }
    else
    {
      return $fetch_rec->result();

    }                      
  }
  public function fetch_records_by_args_with_order($tablename,$args,$order_format)
  {
    extract($order_format);
    $fetch_rec = $this->db->select()
                          ->from($tablename)
                          ->where($args)
                          ->order_by($order_format['column_name'],$order_format['order'])
                          ->get();
     if($fetch_rec->num_rows()>0)
    {
      return $fetch_rec->result();
    }
    else
    {
      return $fetch_rec->result();

    }                       

  }
  public function fetch_records_by_args_with_limit($tablename,$args,$limit)
  {
    $this->db->limit($limit);
    $fetch_rec = $this->db->get_where($tablename,$args);
      if($fetch_rec->num_rows()>0)
    {
      return $fetch_rec->result();
    }
    else
    {
      return $fetch_rec->result();

    }
  }
  public function fetch_all_records_with_pagination($tablename,$order_format,$limit,$offset)
  {
    extract($order_format);
  $fetch_rec = $this->db->select()
             ->from($tablename)
             ->order_by($order_format['column_name'],$order_format['order'])
             ->limit($limit,$offset)
             ->get();
    if($fetch_rec->num_rows() > 0)
    {
      return $fetch_rec->result();
    }
    else
    {
      return $fetch_rec->result();

    }         
  }
  public function fetch_records_by_like_with_pagination($tablename,$args,$order_format,$limit,$offset)
  {
   
  extract($order_format);
  $fetch_rec = $this->db->select()
             ->from($tablename)
             ->like($args)
             ->order_by($order_format['column_name'],$order_format['order'])
             ->limit($limit,$offset)
             ->get();
    if($fetch_rec->num_rows() > 0)
    {
      return $fetch_rec->result();
    }
    else
    {
      return $fetch_rec->result();

    }         
  }
  public function insert_data_with_last_id($tablename, $data)
  {
    $insert_rec = $this->db->insert($tablename,$data);
    if($this->db->affected_rows() > 0)
    {
      return $this->db->insert_id();
    }
    else
    {
      return 0;
    }
  }
  public function fetch_all_records_with_order($tablename,$order_format,$limit)
  {
    extract($order_format);
    if($limit == 'limit')
    {

    }
    else
    {
      $this->db->limit($limit);
    }
    $fetch_rec = $this->db->select()
             ->from($tablename)
             ->order_by($order_format['column_name'],$order_format['order'])
             ->get();
    if($fetch_rec->num_rows() > 0)
    {
      return $fetch_rec->result();
    }
    else
    {
      return $fetch_rec->result();
    }         
  }
  public function fetch_all_sales($args)
  {
    $fetch_rec = $this->db->select('order_date,COUNT(order_date),SUM(total_quantity),SUM(total_amount)')
                ->from('ms_orders')
                ->where($args)
                ->group_by('order_date')
                ->get();
    if($fetch_rec->num_rows() > 0)
    {
      return $fetch_rec->result_array();
    }
    else
    {
      return $fetch_rec->result_array();
    }            
  }
  public function fetch_all_records_by_args_with_pagination($tablename,$args,$order_format,$limit,$offset)
  {
   
  extract($order_format);
  $fetch_rec = $this->db->select()
             ->from($tablename)
             ->where($args)
             ->order_by($order_format['column_name'],$order_format['order'])
             ->limit($limit,$offset)
             ->get();
    if($fetch_rec->num_rows() > 0)
    {
      return $fetch_rec->result();
    }
    else
    {
      return $fetch_rec->result();

    }         
  }
  public function fetch_all_records_with_sum($tablename,$column,$args) 
  {
    if($args != '')
    {
    $fetch_rec = $this->db->select($column)
             ->from($tablename)
             ->where($args)
             ->get();
    if($fetch_rec->num_rows()>0)
    {
      return $fetch_rec->result();
    }
    else
    {
      return $fetch_rec->result();

    }

  }
  else
  {
    $fetch_rec = $this->db->select($column)
             ->from($tablename)
             ->get();
    if($fetch_rec->num_rows()>0)
    {
      return $fetch_rec->result();
    }
    else
    {
      return $fetch_rec->result();

    }


  }
  }
  public function fetch_all_products($tablename,$args)
  {
    if($args != '')
    {
      $fetch_rec = $this->db->select()
             ->from($tablename)
             ->where($args)
             ->get();

    }
    else
    {
       $fetch_rec = $this->db->select()
             ->from($tablename)
             ->get();
    }        
    if($fetch_rec->num_rows()>0)
    {
      return $fetch_rec->result();
    }
    else
    {
      return $fetch_rec->result();

    }

    
  }
   public function fetch_all_customer($tablename,$args)
  {
    if($args != '')
    {
      $fetch_rec = $this->db->select()
             ->from($tablename)
             ->where($args)
             ->get();

    }
    else
    {
       $fetch_rec = $this->db->select()
             ->from($tablename)
             ->get();
    }        
    if($fetch_rec->num_rows()>0)
    {
      return $fetch_rec->result();
    }
    else
    {
      return $fetch_rec->result();

    }

    
  }
}
?>