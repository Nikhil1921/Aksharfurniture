<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
*
*/
class ProductModel extends CI_Model 
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public $table = "products p";
	public $select_column = array('p.id', 'p.p_name', 'p.price','c.c_name');
	public $search_column = array('p.p_name', 'p.price', 'p.description','c.c_name');
    public $order_column = array(null,'p.p_name','p.price','c.c_name',null);
    
	public $order = array('p.id' => 'DESC');

	public function make_query()
	{  
        $this->db->select($this->select_column)
            ->from($this->table)
            ->where(['p.is_delete'=>0, 'c.is_delete'=>0])
            ->join('category c', 'c.id = p.cat_id');
            
        $i = 0;

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