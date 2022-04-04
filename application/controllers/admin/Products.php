<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Products extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		auth();
	}

	private $name = 'products';
	private $redirect = 'admin/products';
	private $icon = 'fa-users';
	private $table = 'products';

	protected $validate = [
            /*[
                'field' => 'c_name',
                'label' => 'Category Name',
                'rules' => 'required',
                'errors' => [
                    'required' => "%s is Required",
                ],
            ],*/
            [
                'field' => 'include_gst',
                'label' => 'Include gst',
                'rules' => 'required',
                'errors' => [
                    'required' => "%s is Required",
                ],
            ],
            [
                'field' => 'p_name',
                'label' => 'Name',
                'rules' => 'required',
                'errors' => [
                    'required' => "%s is Required",
                ],
            ],
            [
                'field' => 'price',
                'label' => 'Price',
                'rules' => 'required',
                'errors' => [
                    'required' => "%s is Required",
                ],
            ],
            [
                'field' => 'description',
                'label' => 'Description',
                'rules' => 'required',
                'errors' => [
                    'required' => "%s is Required",
                ],
            ]
    ];

	public function index()
	{	
		$data['name'] = $this->name;
		$data['icon'] = $this->icon;
        $this->template->load('admin/template','admin/products/index', $data);
	}

	public function get()
    {
        $fetch_data = $this->main->make_datatables('admin/ProductModel');
		$sr = $_POST['start'] + 1;
        $data = array();  

        foreach($fetch_data as $row)  
        {  
            $sub_array = array();
            $sub_array[] = $sr;
            $sub_array[] = ucwords($row->p_name);
            $sub_array[] = $row->price;
            // $sub_array[] = ucwords($row->c_name);
            
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
            "recordsTotal"      =>     $this->main->count($this->table, ['is_delete'=>0]),
            "recordsFiltered"   =>     $this->main->get_filtered_data('admin/ProductModel'),  
            "data"              =>     $data,
            $csrf_name          =>     $csrf_hash
        );
        
        echo json_encode($output);
	}

	public function add()
    {
        $data['name'] = $this->name;
        $data['icon'] = $this->icon;
        /*$data['cats'] = $this->main->getall("category", 'id,c_name', ['is_delete'=>0]);*/

        $this->form_validation->set_rules($this->validate);
        if ($this->form_validation->run() == FALSE) {
            $this->template->load('admin/template','admin/products/add', $data);
        }else{
            $post = [
            	/*'cat_id' => $this->input->post('c_name'),*/
                'cat_id' => 1,
                'p_name' => $this->input->post('p_name'),
                'include_gst' => $this->input->post('include_gst'),
            	'price' => $this->input->post('price'),
            	'description' => $this->input->post('description'),
                'images' => "No Image"
        	];
            
            $id = $this->main->add($post, $this->table);
            // $this->session->set_flashdata('prod_id',$id);
            
            flashMsg(
            	$id, ucwords($this->name).' Added Successfully.', ucwords($this->name).' Not Added, Please Try Again.', $this->redirect
            );
            /*flashMsg(
                $id, ucwords($this->name).' Added Successfully.', ucwords($this->name).' Not Added, Please Try Again.', $this->redirect."/images"
            );*/
        }
    }

    /*public function images()
    {
        if ($this->input->server('REQUEST_METHOD') == "POST") {
            $id = $this->input->get('prod_id');
            
            $config['upload_path']= "./assets/images/products/";
            $config['allowed_types']='jpg|jpeg|png';
            
            $this->upload->initialize($config);
            
            $extn = explode(".", strtolower($_FILES['image']['name']));
            $image = rand(1000,9999).'.'.$extn[1];
            $_FILES['image']['name'] = $image;

            $images = $this->main->check($this->table, ['id'=>$id], 'images');
            
            if (!$this->upload->do_upload("image")) {
                echo $this->upload->display_errors();
            }else{
                $image = $this->upload->data("file_name");
                if ($images == 'No Image') {
                    $this->main->update(['id'=>$id], ['images'=>$image], $this->table);
                }else{
                    $images = explode(',', $images);
                    array_push($images, $image);
                    $images = implode(',', $images);
                    $this->main->update(['id'=>$id], ['images'=>$images], $this->table);
                }
                echo "File uploaded successfully";
            }
        }else{
            if (!$this->session->userdata('prod_id')) {
                return redirect($this->redirect);
            }
            $data['name'] = $this->name;
            $data['icon'] = $this->icon;
            $this->template->load('admin/template','admin/products/images', $data);
        }
    }

    public function remove_image()
    {
        if (!$this->input->is_ajax_request()) {
           error_404();
        }else{
            $id = $this->input->get('id');
            $image = $this->input->get('image');

            $images = $this->main->check($this->table, ['id'=>$id], 'images');
            $images = explode(',', $images);
            
            if (unlink('./assets/images/products/'.$image)) {
                if (($key = array_search($image, $images)) !== false) {
                    unset($images[$key]);
                    $images = implode(',', $images);
                    $this->main->update(['id'=>$id], ['images'=>$images],$this->table);
                    echo "TRUE";
                }
            }else{
                echo "FALSE";
            }
        }
    }*/

    public function view($id)
    {
        $data['name'] = $this->name;
        $data['icon'] = $this->icon;
        $data['data'] = $this->main->get($this->table.' u', 'p_name, price, description, images, c_name, include_gst', ['u.id'=>d_id($id)], ['cat_id'=>'category c']);
        
        $this->template->load('admin/template','admin/products/view', $data);
    }

    public function update($id)
    {
        $data['name'] = $this->name;
        $data['icon'] = $this->icon;
        $data['data'] = $this->main->get($this->table, 'id,p_name, price, description, images,include_gst', ['id'=>d_id($id)]);
        // $data['data'] = $this->main->get($this->table, 'id,p_name, price, description, images,include_gst,cat_id', ['id'=>d_id($id)]);
        /*$data['cats'] = $this->main->getall("category", 'id,c_name', ['is_delete'=>0]);*/

        $this->form_validation->set_rules($this->validate);
        if ($this->form_validation->run() == FALSE) {
            $this->template->load('admin/template','admin/products/update', $data);
        }else{
            $post = [
                // 'cat_id' => $this->input->post('c_name'),
                'cat_id' => 1,
                'include_gst' => $this->input->post('include_gst'),
                'p_name' => $this->input->post('p_name'),
                'price' => $this->input->post('price'),
                'description' => $this->input->post('description')
            ];
            
            $pid = $this->main->update(['id'=>d_id($id)], $post, $this->table);
            // $this->session->set_flashdata('prod_id',d_id($id));
            flashMsg(
                $pid, ucwords($this->name).' Updated Successfully.', ucwords($this->name).' Not Updated, Please Try Again.', $this->redirect
            );
            /*flashMsg(
                $pid, ucwords($this->name).' Updated Successfully.', ucwords($this->name).' Not Updated, Please Try Again.', $this->redirect."/images"
            );*/
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