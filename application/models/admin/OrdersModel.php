<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
*
*/
class OrdersModel extends CI_Model 
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public $table = "orders o";
	public $select_column = array('o.id','o.order_type','o.cust_name','o.cust_mobile','total_bill','pay_bill', 'pending_bill', 'status','payment_details', 'order_details', 'payment', 'delivery_date', 'employee', 'created_at','e.name','e.mobile','o.order_id');
	public $search_column = array('o.id','o.order_type','o.cust_name','o.cust_mobile','total_bill','pay_bill', 'pending_bill', 'status', 'order_details', 'payment', 'delivery_date', 'employee', 'created_at','o.order_id');
    public $order_column = array(null, 'o.order_id', 'created_at','e.name','o.cust_name','cust_mobile','total_bill','pay_bill', 'pending_bill', 'o.order_type', null);
    
	public $order = array('o.id' => 'ASC');

	public function make_query()
	{  
        $this->db->select($this->select_column)
            ->from($this->table)
            ->where(['o.is_delete'=>0])
            ->join('employee e', 'e.id = o.employee');
            
        $i = 0;

        if ($_POST['employee']) {
            $this->db->where(['e.id' => $_POST['employee']]);
        }

        if ($_POST['s_date'] && $_POST['e_date']) {

            $start = date('Y-m-d', strtotime($_POST['s_date']));
            $end = date('Y-m-d', strtotime($_POST['e_date']));
            $this->db->where("o.create_date BETWEEN '$start' AND '$end'");
            /*$this->db->where(['DATE(o.created_at) >=' => date("d-m-Y", strtotime($_POST['s_date']))]);
            $this->db->where(['DATE(o.created_at) <=' => date("d-m-Y", strtotime($_POST['e_date']))]);*/
        }
        // re($this->db);
        foreach ($this->search_column as $item) 
        {
            if($_POST['search']['value']) 
            {
                if($i===0) 
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->search_column) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
         
        if(isset($_POST['order'])) 
        {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
	}           
}