<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		auth();
	}

	private $name = 'dashboard';
	private $icon = 'fa-home';
	private $table = 'orders';

	public function index()
	{	
		$data['name'] = $this->name;
		$data['icon'] = $this->icon;
        
		$this->template->load('admin/template','admin/dashboard', $data);
	}

	public function error()
	{	
		error_404();
	}
}