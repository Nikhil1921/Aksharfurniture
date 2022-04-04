<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
*
*/
class ApiModel extends CI_Model 
{
	
	public function __construct()
	{
		parent::__construct();
	}

	private $table = "employee";

	private function response($sql)
    {
    	$data = $this->db->query($sql)->result();

        if($data)
        {   
            return $data;
        }
        else
        {
            return FALSE;
        }
    }

    private function response_single($sql)
    {
        $data = $this->db->query($sql)->row_array();

        if($data)
        {   
            return $data;
        }
        else
        {
            return FALSE;
        }
    }

	public function total_payment($api)
    {

        $sql = "SELECT sum(total_bill) total FROM `orders`
                WHERE `employee` = '$api'";

        return $this->response($sql);
    }

    public function pending_payment($api)
    {

        $sql = "SELECT sum(pending_bill) total FROM `orders`
                WHERE `employee` = '$api'";

        return $this->response($sql);
    }
}