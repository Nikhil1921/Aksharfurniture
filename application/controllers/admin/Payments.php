<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Payments extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		auth();
	}

	private $name = 'payment approval';
	private $redirect = 'admin/payments';
	private $icon = 'fa-file';
	private $table = 'payment_logs';

	public function index()
	{	
		$data['name'] = $this->name;
		$data['icon'] = $this->icon;
        
		$this->template->load('admin/template','admin/payments/index', $data);
	}

	public function get()
    {
        $fetch_data = $this->main->make_datatables('admin/PaymentsModel');
		$sr = $_POST['start'] + 1;
        $data = array();  

        foreach($fetch_data as $row)  
        {  
            $sub_array = array();
            $sub_array[] = $sr;
            $sub_array[] = $row->order_id;
            $sub_array[] = ucwords($row->name);
            $sub_array[] = ucwords($row->cust_name);
            $pay = json_decode($row->payment_details);
            $sub_array[] = ucfirst($pay->pay_type);
            $sub_array[] = $pay->payment_id;
            $sub_array[] = $pay->payment;
            $sub_array[] = $pay->pay_at;
            
            $sub_array[] = '<form class="table_form" action="'.base_url('admin/payments/approve').'" method="POST" class="mr-2" ><input type="hidden" name="id" value="'.e_id($row->id).'"><button class="approve btn waves-effect waves-dark btn-success btn-outline-success btn-icon fa fa-thumbs-up"></button>
            </form>
            <form class="table_form" action="'.base_url('admin/payments/delete').'" method="POST" ><input type="hidden" name="id" value="'.e_id($row->id).'"><button class="delete btn waves-effect waves-dark btn-danger btn-outline-danger btn-icon fa fa-thumbs-down"></button>
            </form>';

            $data[] = $sub_array;
            $sr++;
    	}
    	
        $csrf_name = $this->security->get_csrf_token_name();
        $csrf_hash = $this->security->get_csrf_hash();  

        $output = array(  
            "draw"              =>     intval($_POST["draw"]),  
            "recordsTotal"      =>     $this->main->all($this->table),
            "recordsFiltered"   =>     $this->main->get_filtered_data('admin/PaymentsModel'),  
            "data"              =>     $data,
            $csrf_name          =>     $csrf_hash
        );
        
        echo json_encode($output);
	} 

	public function approve($id="")
    {
	    $id = d_id($this->input->post('id'));
     
        $pay = $this->main->get($this->table, 'payment_details, book_id, employee', ['id'=>$id]);
        $order = $this->main->get("orders", 'pending_bill,payment_details,pay_bill', ['id'=>$pay['book_id']]);
        $order['payment_details'] = json_decode($order['payment_details']);
        $payment = json_decode($pay['payment_details']);
        array_push($order['payment_details'], $payment);
        $order['pending_bill'] = $order['pending_bill'] - $payment->payment;
        $order['pay_bill'] = $order['pay_bill'] + $payment->payment;
        $order['payment_details'] = json_encode($order['payment_details']);
        $order['payment'] = ($order['pending_bill'] > 0) ? 0 : 1;
        
        $uid = $this->main->update(['id'=>$pay['book_id']], $order, "orders");
        if ($uid) {
            $this->main->delete(['id'=>$id], $this->table);
        }

        flashMsg(
            $uid, 'Payment Approved Successfully.', 'Payment Not Approved, Please Try Again.', $this->redirect
        );
    }

    public function update()
    {
        $id = d_id($this->input->post('pk'));
        $payment = $this->main->check($this->table, ['id'=>$id], 'payment_details');
        if ($payment) {
            $payment = json_decode($payment);
            $payment->payment = $this->input->post('value');
            $uid = $this->main->update(['id'=>$id], ['payment_details'=>json_encode($payment)], $this->table);
        }
    }

    public function delete()
    {
        $id = d_id($this->input->post('id'));
        $uid = $this->main->delete(['id'=>$id], $this->table);

        flashMsg(
            $uid, 'Payment Deleted Successfully.', 'Payment Not Deleted, Please Try Again.', $this->redirect
        );
    }
}