<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('api');
        $this->load->model('ApiModel', 'api');
        // mobile();
    }

    private $table = 'employee';

    public function login()
    {
        post();
        verifyRequiredParams(['mobile', 'password']);
        $post['mobile'] = $this->input->post('mobile');
        $post['password'] = my_crypt($this->input->post('password'));
        $row = $this->main->get($this->table,'id u_id,mobile,name,email',$post);
        
        if($row)
        {
            $response['row'] = $row;
            $response['error'] = FALSE;
            $response['message'] ="Login Successfull.";
            echoRespnse(200, $response);
        } 
        else 
        {
            $response["error"] = TRUE;
            $response['message'] = "Login Not Successfull!";
            echoRespnse(400, $response);
        }
    }

    public function profile()
    {
        get();
        $api_key = authenticate($this->table);
        
        $row = $this->main->get($this->table,'mobile,name,email',['id'=>$api_key]);
        if($row)
        {
            $response['row'] = $row;
            $response['error'] = FALSE;
            $response['message'] ="Profile Successfull.";
            echoRespnse(200, $response);
        }
        else
        {
            $response["error"] = TRUE;
            $response['message'] = "Profile Not Successfull!";
            echoRespnse(400, $response);
        }  
    }

    /*public function category()
    {
        get();
        $api_key = authenticate($this->table);
        
        if($row = $this->main->getall("category", 'id, c_name', ['is_delete'=>0]))
        {
            $response['row'] = $row;
            $response['error'] = FALSE;
            $response['message'] ="Category List Successfull.";
            echoRespnse(200, $response);
        }
        else
        {
            $response["error"] = TRUE;
            $response['message'] = "Category List Not Successfull!";
            echoRespnse(400, $response);
        }  
    }*/

    public function products()
    {
        get();
        $api_key = authenticate($this->table);
        /*verifyRequiredParams(['cat_id']);
        $cat_id = $this->input->get('cat_id');*/
        

        /*if($row = $this->main->getall("products", 'id, p_name, price, description, images, include_gst, cat_id', ['is_delete'=>0, 'cat_id'=>$cat_id]))*/
        if($row = $this->main->getall("products", 'id, p_name, price, description, images, include_gst', ['is_delete'=>0]))
        {
            foreach ($row as $k => $v) {
                $qty = $this->main->check('cart', ['prod_id' => $v['id'], 'user_id' => $api_key], 'qty');
                
                $row[$k]['qty'] = ($qty) ? $qty : (string) 0;

                /*$img = explode(",", $v['images']);
                unset($row[$k]['images']);
                if ($v['images'] != "No Image") {
                    foreach ($img as $ke => $va) {
                        $row[$k]['images'][$ke]['image'] = base_url('assets/images/products/').$va;
                    }
                }else{
                    $row[$k]['images'][]['image'] = "";
                }*/
            }

            $response['row'] = $row;
            $response['error'] = FALSE;
            $response['message'] ="Products List Successfull.";
            echoRespnse(200, $response);
        }
        else
        {
            $response["error"] = TRUE;
            $response['message'] = "Products List Not Successfull!";
            echoRespnse(400, $response);
        }  
    }

    public function add_cart()
    {
        post();
        $api_key = authenticate($this->table);
        verifyRequiredParams(['prod_id', 'qty']);
        $prod_id = $this->input->post('prod_id');
        $qty = $this->input->post('qty');

        $check = $this->main->check('cart', ['prod_id' => $prod_id, 'user_id' => $api_key], 'id');

        $post = ['prod_id' => $prod_id, 'user_id' => $api_key, 'qty' => $qty];

        if ($check) {
            $row = $this->main->update(['id' => $check], $post, 'cart');
        }else{
            $row = $this->main->add($post, 'cart');
        }

        if($row)
        {
            $response['row'] = $post;
            $response['error'] = FALSE;
            $response['message'] ="Product Added to cart.";
            echoRespnse(200, $response);
        } 
        else 
        {
            $response["error"] = TRUE;
            $response['message'] = "Product not Added to cart";
            echoRespnse(400, $response);
        } 
    }

    public function delete_cart()
    {
        post();
        $api_key = authenticate($this->table);
        verifyRequiredParams(['prod_id']);
        $prod_id = $this->input->post('prod_id');
        
        $check = $this->main->check('cart', ['prod_id' => $prod_id, 'user_id' => $api_key], 'id');
        
        if (!$check) {
            $response['error'] = TRUE;
            $response['message'] ="Product Not in cart.";
            echoRespnse(200, $response);
        }else{
            $row = $this->main->delete(['prod_id' => $prod_id, 'user_id' => $api_key], 'cart');
        }
        
        if($row)
        {
            $response['error'] = FALSE;
            $response['message'] ="Product Deleted";
            echoRespnse(200, $response);
        }
        else 
        {
            $response["error"] = TRUE;
            $response['message'] = "Product Not Deleted";
            echoRespnse(400, $response);
        }
    }

    public function list_cart()
    {
        get();
        $api_key = authenticate($this->table);
        
        $row = $this->main->getall("cart",'prod_id, p_name, qty, price, include_gst', ['user_id' => $api_key],['prod_id' => 'products p']);
        $total = 0;
        
        foreach ($row as $k => $v) {
            $total += (($v['include_gst']) ? ($v['price'] * $v['qty']) : (($v['price'] * 118) / 100) * $v['qty']);
        }

        if($row)
        {
            $response['row'] = $row;
            $response['total'] = (string) $total;
            $response['error'] = FALSE;
            $response['message'] ="Cart List Successfull.";
            echoRespnse(200, $response);
        }
        else
        {
            $response["error"] = TRUE;
            $response['message'] = "Cart List Not Successfull!";
            echoRespnse(400, $response);
        }  
    }

    public function final_order()
    {
        post();
        $api_key = authenticate($this->table);
        
        $cart = $this->main->getall("cart",'prod_id, qty, price, include_gst gst',['user_id' => $api_key],['prod_id' => 'products p']);
        if (!$cart) {
            $response["error"] = TRUE;
            $response['message'] = "Empty Cart. Order Not Successfull.";
            echoRespnse(400, $response);
        }else{
            verifyRequiredParams(['cust_name','cust_address','cust_mobile','total_bill','pay_bill','pending_bill', 'delivery_date', 'pay_type', 'payment_id','order_id','create_date']);
            
            $payment_details[] = [
                    'pay_type'   => $this->input->post('pay_type'),
                    'payment_id' => $this->input->post('payment_id'),
                    'payment'    => $this->input->post('pay_bill'),
                    'pay_at'     => date('d-m-Y h:i A')
                ];

            $post = [
                'order_type'      => "product",
                'order_id'        => $this->input->post('order_id'),
                'cust_name'       => $this->input->post('cust_name'),
                'cust_address'    => $this->input->post('cust_address'),
                'cust_mobile'     => $this->input->post('cust_mobile'),
                'total_bill'      => $this->input->post('total_bill'),
                'pay_bill'        => $this->input->post('pay_bill'),
                'pending_bill'    => $this->input->post('pending_bill'),
                'status'          => "approved",
                'order_details'   => json_encode($cart),
                'payment'         => ($this->input->post('pending_bill') > 0) ? 0 : 1,
                'delivery_date'   => date('Y-m-d', strtotime($this->input->post('delivery_date'))),
                'employee'        => $api_key,
                'payment_details' => json_encode($payment_details),
                'created_at'      => date('d-m-Y h:i A', strtotime($this->input->post('create_date'))),
                    'create_date'     => date('Y-m-d', strtotime($this->input->post('create_date')))
            ];

            if($row = $this->main->add($post, 'orders') && $this->main->delete(['user_id' => $api_key], 'cart'))
            {   
                $response['error'] = FALSE;
                $response['message'] ="Order Successfull.";
                echoRespnse(200, $response);
            } 
            else 
            {
                $response["error"] = TRUE;
                $response['message'] = "Order Not Successfull.";
                echoRespnse(400, $response);
            }
        }
    }

    public function add_order_book()
    {
        post();
        $api_key = authenticate($this->table);
        verifyRequiredParams(['description', 'qty', 'rate','gst']);

        $post = [
            'description' => $this->input->post('description'),
            'qty'         => $this->input->post('qty'),
            'rate'        => $this->input->post('rate'),
            'gst'         => $this->input->post('gst'),
            'employee'    => $api_key,
        ];

        if($row = $this->main->add($post, 'order_book_cart'))
        {
            $response['row'] = (string) $row;
            $response['error'] = FALSE;
            $response['message'] ="Order Book Added to cart.";
            echoRespnse(200, $response);
        } 
        else 
        {
            $response["error"] = TRUE;
            $response['message'] = "Order Book Not Added to cart";
            echoRespnse(400, $response);
        } 
    }

    public function order_book_list()
    {
        get();
        $api_key = authenticate($this->table);

        if($row = $this->main->getall("order_book_cart", 'id, description, qty, rate, gst', ['employee'=>$api_key]))
        {
            $total = 0;
        
            foreach ($row as $k => $v) {
                $total += (($v['gst']) ? ($v['rate'] * $v['qty']) : (($v['rate'] * 118) / 100) * $v['qty']);
            }

            $response['row'] = $row;
            $response['total'] = (string) ceil($total);
            $response['error'] = FALSE;
            $response['message'] ="Order Book List Succesfull.";
            echoRespnse(200, $response);
        } 
        else 
        {
            $response["error"] = TRUE;
            $response['message'] = "Order Book List Not Succesfull";
            echoRespnse(400, $response);
        } 
    }

    public function delete_order_book()
    {
        post();
        $api_key = authenticate($this->table);
        verifyRequiredParams(['book_id']);
        $book_id = $this->input->post('book_id');
        
        if($row = $this->main->delete(['id' => $book_id, 'employee' => $api_key], 'order_book_cart'))
        {
            $response['error'] = FALSE;
            $response['message'] ="Order Book Deleted";
            echoRespnse(200, $response);
        }
        else 
        {
            $response["error"] = TRUE;
            $response['message'] = "Order Book Not Deleted";
            echoRespnse(400, $response);
        }
    }

    public function final_order_book()
    {
        post();
        $api_key = authenticate($this->table);
        
        $cart = $this->main->getall("order_book_cart", 'description, qty, rate,gst', ['employee'=>$api_key]);

        if (!$cart) {
            $response["error"] = TRUE;
            $response['message'] = "Empty Cart. Order Not Successfull.";
            echoRespnse(400, $response);
        }else{
            verifyRequiredParams(['cust_name','cust_address','cust_mobile','total_bill','pay_bill','pending_bill', 'delivery_date', 'pay_type', 'payment_id', 'order_id','create_date']);

           (empty($_FILES['order_book']['name'])) ? verifyRequiredParams(['order_book']) : '' ;
            
            $config = [
                'upload_path'   => "./assets/images/order_book/",
                'allowed_types' => 'jpg|jpeg|png'
            ];

            $this->upload->initialize($config);
            
            $extn = explode(".", strtolower($_FILES['order_book']['name']));
            $image = time().'.'.end($extn);
            $_FILES['order_book']['name'] = $image;

            if (!$this->upload->do_upload("order_book")) { 
                $response["row"] = strip_tags($this->upload->display_errors());
                $response["error"] = TRUE;
                $response['message'] = "Order Not Successfull.";
                echoRespnse(400, $response);
            }else{
                $data = $this->upload->data();

                $payment_details[] = [
                    'pay_type'   => $this->input->post('pay_type'),
                    'payment_id' => $this->input->post('payment_id'),
                    'payment'    => $this->input->post('pay_bill'),
                    'pay_at'     => date('d-m-Y h:i A')
                ];

                $post = [
                    'order_type'      => "order book",
                    'order_id'        => $this->input->post('order_id'),
                    'cust_name'       => $this->input->post('cust_name'),
                    'cust_address'    => $this->input->post('cust_address'),
                    'cust_mobile'     => $this->input->post('cust_mobile'),
                    'total_bill'      => $this->input->post('total_bill'),
                    'pay_bill'        => $this->input->post('pay_bill'),
                    'pending_bill'    => $this->input->post('pending_bill'),
                    'status'          => "approved",
                    'order_details'   => json_encode($cart),
                    'payment'         => ($this->input->post('pending_bill') > 0) ? 0 : 1,
                    'delivery_date'   => date('Y-m-d', strtotime($this->input->post('delivery_date'))),
                    'employee'        => $api_key,
                    'payment_details' => json_encode($payment_details),
                    'created_at'      => date('d-m-Y h:i A', strtotime($this->input->post('create_date'))),
                    'create_date'     => date('Y-m-d', strtotime($this->input->post('create_date'))),
                    'order_book'      => $data["file_name"]
                ];

                if($row = $this->main->add($post, 'orders') && $this->main->delete(['employee' => $api_key], 'order_book_cart'))
                {
                    $response['error'] = FALSE;
                    $response['message'] ="Order Successfull.";
                    echoRespnse(200, $response);
                } 
                else 
                {
                    $response["error"] = TRUE;
                    $response['message'] = "Order Not Successfull.";
                    echoRespnse(400, $response);
                }
            }
        }
    }

    public function total_payment()
    {
        get();
        $api_key = authenticate($this->table);
        
        if($row = $this->api->total_payment($api_key))
        {
            foreach ($row as $k => $v) {
                if ($v->total) {
                    $row[$k]->total = $v->total;
                }else{
                    $row[$k]->total = "0";
                }
            }
            
            $response['row'] = $row;
            $response['error'] = FALSE;
            $response['message'] ="Total Payment Successfull";
            echoRespnse(200, $response);
        }
        else 
        {
            $response["error"] = TRUE;
            $response['message'] = "Total Payment Not Successfull";
            echoRespnse(400, $response);
        }
    }

    public function pending_payment()
    {
        get();
        $api_key = authenticate($this->table);
        
        if($row = $this->api->pending_payment($api_key))
        {
            foreach ($row as $k => $v) {
                if ($v->total) {
                    $row[$k]->total = $v->total;
                }else{
                    $row[$k]->total = "0";
                }
            }
            
            $response['row'] = $row;
            $response['error'] = FALSE;
            $response['message'] ="Pending Payment Successfull";
            echoRespnse(200, $response);
        }
        else 
        {
            $response["error"] = TRUE;
            $response['message'] = "Pending Payment Not Successfull";
            echoRespnse(400, $response);
        }
    }

    public function add_payment()
    {
        post();
        $api_key = authenticate($this->table);
        verifyRequiredParams(['book_id','pay_bill', 'pay_type', 'payment_id']);
        $book_id = $this->input->post('book_id');
        
        $payment_details = [
                'pay_type'   => $this->input->post('pay_type'),
                'payment_id' => $this->input->post('payment_id'),
                'payment'    => $this->input->post('pay_bill'),
                'pay_at'     => date('d-m-Y h:i A')
            ];
        $amount = $this->main->check('orders',['id' => $book_id], 'pending_bill');    
        if ($amount - $payment_details['payment'] >= 0) {
            $post = [
                'payment_details' => json_encode($payment_details),
                'book_id'         => $book_id,
                'employee'        => $api_key,
            ];
            
            if($row = $this->main->add($post, 'payment_logs'))
            {
                $response['error'] = FALSE;
                $response['message'] ="Payment Add Successfull.";
                echoRespnse(200, $response);
            } 
            else 
            {
                $response["error"] = TRUE;
                $response['message'] = "Payment Add Not Successfull.";
                echoRespnse(400, $response);
            }
        }else{
            $response["error"] = TRUE;
            $response['message'] = "Payment Add Not Successfull.";
            echoRespnse(400, $response);
        }
    }

    public function orders_list()
    {
        get();
        $api_key = authenticate($this->table);
        
        if($row = $this->main->getall('orders', 'id, order_type, cust_name, cust_address, cust_mobile, total_bill, pay_bill, pending_bill, status, delivery_date, order_id', ['employee' => $api_key]))
        {
            $response['row'] = $row;
            $response['error'] = FALSE;
            $response['message'] ="Orders List Successfull";
            echoRespnse(200, $response);
        }
        else
        {
            $response["error"] = TRUE;
            $response['message'] = "Orders List Not Successfull";
            echoRespnse(400, $response);
        }
    }
}