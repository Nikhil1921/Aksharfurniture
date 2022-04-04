<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Orders extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		auth();
	}

	private $name = 'orders';
	private $redirect = 'admin/orders';
	private $icon = 'fa-file';
	private $table = 'orders';

	public function index()
	{	
		$data['name'] = $this->name;
		$data['icon'] = $this->icon;
        $data['employees'] = $this->main->getall('employee', 'id, name', ['is_delete' => 0]);
        /*$orders = $this->main->getall($this->table, 'id, created_at');
        foreach ($orders as $key => $v) {
            $this->main->update(['id'=>$v['id']], ['create_date'=>date("Y-m-d", strtotime($v['created_at']))], $this->table);
        }
        $orders = $this->main->getall($this->table, 'id, created_at');
        re($orders);*/
		$this->template->load('admin/template','admin/orders/index', $data);
	}

	public function get()
    {
        $fetch_data = $this->main->make_datatables('admin/OrdersModel');
		$sr = $_POST['start'] + 1;
        $data = array();  

        foreach($fetch_data as $row)  
        {  
            $sub_array = array();
            $sub_array[] = $sr;
            $sub_array[] = $row->order_id;
            $sub_array[] = $row->created_at;
            $sub_array[] = ucwords($row->name);
            $sub_array[] = ucwords($row->cust_name);
            $sub_array[] = $row->cust_mobile;
            $sub_array[] = $row->total_bill;
            $sub_array[] = $row->pay_bill;
            $sub_array[] = $row->pending_bill;
            $sub_array[] = '<span class="badge badge-warning">'.ucwords($row->status).'</span>';
            $sub_array[] = '<span class="badge badge-primary">'.ucwords(json_decode($row->payment_details)[0]->pay_type).'</span>';
            
            if ($row->status == 'cancel') {
                $action = '';
            }else{
                    $action = '<div>
                <a href="'.base_url('admin/'.$this->name.'/update/').e_id($row->id).'" class="btn waves-effect waves-dark btn-primary btn-outline-primary btn-icon fa fa-pencil"></a>
                <a href="'.base_url('admin/'.$this->name.'/view/').e_id($row->id).'" class="btn waves-effect waves-dark btn-success btn-outline-success btn-icon fa fa-print"></a>
                <a href="'.base_url('admin/'.$this->name.'/payments/').e_id($row->id).'" class="btn waves-effect waves-dark btn-primary btn-outline-primary btn-icon fa fa-money"></a>';

                if ($row->pending_bill > 0) {
                    $action .= '<button type="button" class="btn waves-effect waves-dark btn-dark btn-outline-dark btn-icon fa fa-credit-card credit-pay" data-toggle="modal" data-target="#payment" data-id="'.e_id($row->id).'"></button>
                        <a href="'.base_url('admin/'.$this->name.'/delete/').e_id($row->id).'" class="btn waves-effect waves-dark btn-danger btn-outline-danger btn-icon fa fa-times"></a>';
                }

                $action .= '</div>';
            }
            
            $sub_array[] = $action;

            $data[] = $sub_array;
            $sr++;
    	}
    	
        $csrf_name = $this->security->get_csrf_token_name();
        $csrf_hash = $this->security->get_csrf_hash();  

        $output = array(  
            "draw"              =>     intval($_POST["draw"]),  
            "recordsTotal"      =>     $this->main->count($this->table, ['is_delete'=>0]),
            "recordsFiltered"   =>     $this->main->get_filtered_data('admin/OrdersModel'),  
            "data"              =>     $data,
            $csrf_name          =>     $csrf_hash
        );
        
        echo json_encode($output);
	}

    /*public function view($id)
    {
        $data['name'] = $this->name;
        $data['icon'] = $this->icon;
        $data['data'] = $this->main->get($this->table. ' u', 'u.id order_id, order_type, cust_name, cust_address, cust_mobile, total_bill, pay_bill, pending_bill, order_details,  delivery_date, e.name, e.mobile, created_at book_date', ['u.id'=>d_id($id)], ['employee'=> 'employee e']);
            foreach (json_decode($data['data']['order_details']) as $k => $v) {
                if ($data['data']['order_type'] == "product") {
                    $data['data']['details'][$k]['description'] = $this->main->check("products", ['id' => $v->prod_id], 'p_name');
                    $data['data']['details'][$k]['qty'] = $v->qty;
                    $data['data']['details'][$k]['rate'] = $v->price;
                    $data['data']['details'][$k]['total'] = $v->qty * $v->price;
                }else{
                    $data['data']['details'][$k]['description'] = $v->description;
                    $data['data']['details'][$k]['qty'] = $v->qty;
                    $data['data']['details'][$k]['rate'] = $v->rate;
                    $data['data']['details'][$k]['total'] = $v->qty * $v->rate;
                }
            }
        
        $this->template->load('admin/template','admin/orders/view - Copy', $data);
    }*/

    public function view($id)
    {
        $data['name'] = $this->name;
        $data['icon'] = $this->icon;
        $data['book'] = $this->main->get($this->table. ' u', 'u.order_book,u.order_id, order_type, cust_name, cust_address, cust_mobile, total_bill, pay_bill, pending_bill, order_details,  delivery_date, e.name, e.mobile, created_at book_date', ['u.id'=>d_id($id)], ['employee'=> 'employee e']);
            foreach (json_decode($data['book']['order_details']) as $k => $v) {
                if ($data['book']['order_type'] == "product") {
                    $data['book']['details'][$k]['description'] = $this->main->check("products", ['id' => $v->prod_id], 'p_name');
                    $data['book']['details'][$k]['qty'] = $v->qty;
                    $data['book']['details'][$k]['rate'] = $v->price;
                    $data['book']['details'][$k]['gst'] = (($v->gst) ? 0 : (($v->price * 18) / 100) * $v->qty);
                    $data['book']['details'][$k]['total'] = (($v->gst) ? ($v->price * $v->qty) : (($v->price * 118) / 100) * $v->qty);
                }else{
                    $data['book']['details'][$k]['description'] = $v->description;
                    $data['book']['details'][$k]['qty'] = $v->qty;
                    $data['book']['details'][$k]['rate'] = $v->rate;
                    $data['book']['details'][$k]['total'] = (($v->gst) ? ($v->rate * $v->qty) : (($v->rate * 118) / 100) * $v->qty);
                    $data['book']['details'][$k]['gst'] = (($v->gst) ? 0 : ceil(($v->rate * 18) / 100) * $v->qty);
                }
            }
        
        $this->template->load('admin/template','admin/orders/view', $data);
    }

    public function payments($id)
    {
        $data['name'] = "payment history";
        $data['icon'] = $this->icon;
        $data['book'] = $this->main->get($this->table. ' u', 'u.order_id, cust_name, cust_mobile, e.name, e.mobile, created_at book_date, payment_details, total_bill, pending_bill', ['u.id'=>d_id($id)], ['employee'=> 'employee e']);
        
        $this->template->load('admin/template','admin/orders/payments', $data);
    }

    public function update($id)
    {
        if ($this->input->server('REQUEST_METHOD') == 'GET') {
            $data['name'] = "order update";
            $data['icon'] = $this->icon;
            $data['book'] = $this->main->get($this->table. ' u', 'u.id order_id, order_id order, cust_name, cust_mobile, e.name, e.mobile, created_at book_date, payment_details, total_bill, pending_bill,order_details, order_book, order_type', ['u.id'=>d_id($id)], ['employee'=> 'employee e']);
            foreach (json_decode($data['book']['order_details']) as $k => $v) {

                if ($data['book']['order_type'] == "product") {
                    $data['book']['details'][$k]['description'] = $this->main->check("products", ['id' => $v->prod_id], 'p_name');
                    $data['book']['details'][$k]['qty'] = $v->qty;
                    $data['book']['details'][$k]['rate'] = $v->price;
                    $data['book']['details'][$k]['gst_save'] = $v->gst;
                    $data['book']['details'][$k]['gst'] = (($v->gst) ? 0 : (($v->price * 18) / 100) * $v->qty);
                    $data['book']['details'][$k]['total'] = (($v->gst) ? 0 : (($v->price * 118) / 100) * $v->qty);
                }else{
                    
                    $data['book']['details'][$k]['description'] = $v->description;
                    $data['book']['details'][$k]['qty'] = $v->qty;
                    $data['book']['details'][$k]['rate'] = $v->rate;
                    $data['book']['details'][$k]['gst_save'] = $v->gst;
                    $data['book']['details'][$k]['total'] = $v->qty * $v->rate;
                    $data['book']['details'][$k]['gst'] = (($v->gst) ? ($v->rate * $v->qty) : ceil(($v->rate * 18) / 100) * $v->qty);
                }
            }
            
            return $this->template->load('admin/template','admin/orders/update', $data);
        }else{
            $pay_bill = $total_bill = 0;
            foreach ($this->input->post('description') as $k => $v) {
                $order_details[$k]['description'] = $v;
                $order_details[$k]['qty'] = $this->input->post('qty')[$k];
                $order_details[$k]['rate'] = $this->input->post('rate')[$k];
                $order_details[$k]['gst'] = $this->input->post('gst')[$k];
                $total_bill += ($this->input->post('gst')[$k]) ? $this->input->post('qty')[$k] * $this->input->post('rate')[$k] : $this->input->post('qty')[$k] * $this->input->post('rate')[$k] * 1.18;
            }

            foreach ($this->input->post('pay_type') as $k => $v) {
                $payment_details[$k]['pay_type'] = $v;
                $payment_details[$k]['payment_id'] = $this->input->post('payment_id')[$k];
                $payment_details[$k]['payment'] = $this->input->post('payment')[$k];
                $payment_details[$k]['pay_at'] = $this->input->post('pay_at')[$k];
                $payment_details[$k]['update_at'] = time();
                $pay_bill += $this->input->post('payment')[$k];
            }
            
            $post = [
                'order_details'   => json_encode($order_details),
                'payment_details' => json_encode($payment_details),
                'total_bill'      => $total_bill,
                'pay_bill'        => $pay_bill,
                'pending_bill'    => $total_bill - $pay_bill,
            ];

            $uid = $this->main->update(['id'=> d_id($id)], $post, $this->table);
        
            flashMsg(
                $uid, 'Order Updated Successfully.', 'Order Not Updated, Please Try Again.', $this->redirect
            );
        }
    }

    public function credit()
    {
        $id = d_id($this->input->post('order_id'));

        $order = $this->main->get($this->table, 'pending_bill,payment_details,pay_bill', ['id'=>$id]);
        $order['payment_details'] = json_decode($order['payment_details']);
        
        $payment = (object) [
            'pay_type'   => $this->input->post('pay_type'),
            'payment_id' => $this->input->post('payment_id'),
            'payment'    => $this->input->post('pay_bill'),
            'pay_at'     => date('d-m-Y h:i A')
        ];

        array_push($order['payment_details'], $payment);
        $order['payment_details'] = json_encode($order['payment_details']);
        $order['pending_bill'] = $order['pending_bill'] - $payment->payment;
        $order['pay_bill'] = $order['pay_bill'] + $payment->payment;
        $order['payment'] = ($order['pending_bill'] > 0) ? 0 : 1;

        $uid = $this->main->update(['id'=>$id], $order, $this->table);
        
        flashMsg(
            $uid, 'Payment Approved Successfully.', 'Payment Not Approved, Please Try Again.', $this->redirect
        );
    }

    public function delete($id)
    {
        $uid = $this->main->update(['id'=>d_id($id)], ['is_delete' => 1], $this->table);
        
        flashMsg(
            $uid, 'Order Removed Successfully.', 'Order Not Removed, Please Try Again.', $this->redirect
        );
    }
}