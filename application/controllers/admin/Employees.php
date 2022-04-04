<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Employees extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		auth();
	}

	private $name = 'employees';
	private $redirect = 'admin/employees';
	private $icon = 'fa-users';
	private $table = 'employee';

	protected $validate = [
            [
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'required',
                'errors' => [
                    'required' => "%s is Required",
                ],
            ],
            [
                'field' => 'mobile',
                'label' => 'Mobile',
                'rules' => 'required|callback_mobile_check',
                'errors' => [
                    'required' => "%s is Required",
                ],
            ],
            [
                'field' => 'address',
                'label' => 'Address',
                'rules' => 'required',
                'errors' => [
                    'required' => "%s is Required",
                ],
            ],
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'callback_email_check'
            ]
    ];

    public function mobile_check($str)
    {   
        $id = $this->uri->segment(4);
        $man = $this->main->count($this->table, array('mobile' => $str));

        if ($man && empty($id)) {
            $this->form_validation->set_message('mobile_check', 'The %s is already in use');
            return FALSE;
        }else{
            return TRUE;
        }
    }

    public function email_check($str="")
    {   
        $id = $this->uri->segment(4);
        $man = $this->main->count($this->table, array('email' => $str));

        if ($man && empty($id)) {
            $this->form_validation->set_message('email_check', 'The %s is already in use');
            return FALSE;
        }else{
            return TRUE;
        }
    }

	public function index()
	{	
		$data['name'] = $this->name;
		$data['icon'] = $this->icon;
        
		$this->template->load('admin/template','admin/employees/index', $data);
	}

	public function get()
    {
        $fetch_data = $this->main->make_datatables('admin/EmployeesModel');
		$sr = $_POST['start'] + 1;
        $data = array();  

        foreach($fetch_data as $row)  
        {  
            $sub_array = array();
            $sub_array[] = $sr;
            $sub_array[] = ucwords($row->name);
            $sub_array[] = $row->mobile;
            $sub_array[] = $row->email;
            
            $sub_array[] = '
            <a href="'.base_url('admin/'.$this->name.'/view/').e_id($row->id).'" class="btn waves-effect waves-dark btn-success btn-outline-success btn-icon fa fa-eye"></a>
            <a href="'.base_url('admin/'.$this->name.'/update/').e_id($row->id).'" class="btn waves-effect waves-dark btn-primary btn-outline-primary btn-icon fa fa-pencil"></a>
            <form class="table_form" action="'.base_url('admin/'.$this->name.'/delete').'" method="POST" ><input type="hidden" name="id" value="'.e_id($row->id).'"><input type="hidden" name="token" value="'.$this->security->get_csrf_hash().'"><button class="delete btn waves-effect waves-dark btn-danger btn-outline-danger btn-icon fa fa-trash"></button>
            </form>';

            $data[] = $sub_array;
            $sr++;
    	}
    	
        $csrf_name = $this->security->get_csrf_token_name();
        $csrf_hash = $this->security->get_csrf_hash();  

        $output = array(  
            "draw"              =>     intval($_POST["draw"]),  
            "recordsTotal"      =>     $this->main->count($this->table,['is_delete'=>0]),
            "recordsFiltered"   =>     $this->main->get_filtered_data('admin/EmployeesModel'),  
            "data"              =>     $data,
            $csrf_name          =>     $csrf_hash
        );
        
        echo json_encode($output);
	}

	public function add()
    {
        $data['name'] = $this->name;
        $data['icon'] = $this->icon;

        $this->form_validation->set_rules($this->validate);
        if ($this->form_validation->run() == FALSE) {
            $this->template->load('admin/template','admin/employees/add', $data);
        }else{
            $post = [
            	'name' => $this->input->post('name'),
            	'mobile' => $this->input->post('mobile'),
            	'email' => (!empty($this->input->post('email'))) ? $this->input->post('email') : "Not Given",
            	'address' => $this->input->post('address'),
            	'password' => my_crypt($this->input->post('password'))
        	];
            
            $id = $this->main->add($post, $this->table);
            
            flashMsg(
            	$id, ucwords($this->name).' Added Successfully.', ucwords($this->name).' Not Added, Please Try Again.', $this->redirect
            );
        }
    }

    public function view($id)
    {
        $data['name'] = $this->name;
        $data['icon'] = $this->icon;
        $data['data'] = $this->main->get($this->table, 'name,email,mobile,address', ['id'=>d_id($id)]);
        
        $this->template->load('admin/template','admin/employees/view', $data);
    }

    public function update($id)
    {
        $data['name'] = $this->name;
        $data['icon'] = $this->icon;
        $data['data'] = $this->main->get($this->table, 'id,name,email,mobile,address', ['id'=>d_id($id)]);
        
        $this->form_validation->set_rules($this->validate);
        if ($this->form_validation->run() === FALSE) {
            $this->template->load('admin/template','admin/employees/update', $data);
        }else{
            $post = [
            	'name' => $this->input->post('name'),
            	'mobile' => $this->input->post('mobile'),
            	'email' => (!empty($this->input->post('email'))) ? $this->input->post('email') : "Not Given",
            	'address' => $this->input->post('address')
        	];
            
            $id = $this->main->update(['id'=>d_id($id)], $post, $this->table);

            flashMsg(
                $id, ucwords($this->name).' Updated Successfully.', ucwords($this->name).' Not Updated, Please Try Again.', $this->redirect
            );     
        }
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $id = $this->main->update(['id'=>d_id($id)], ['is_delete' => 1], $this->table);
        
        flashMsg(
        	$id, ucwords($this->name).' Deleted Successfully.', ucwords($this->name).' Not Deleted, Please Try Again.', $this->redirect
        );
    }
}

?>