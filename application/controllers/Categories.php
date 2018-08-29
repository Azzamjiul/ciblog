<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title'] = 'Categories';

		$data['categories'] = $this->category_model->get_categories();

		$this->load->view('template/header');
		$this->load->view('categories/index', $data);
		$this->load->view('template/footer');
	}

	public function create()
	{
		//check user
		if (!$this->session->userdata('logged_in')) {
			redirect('users/login');
		}

		$data['title'] = 'Create Category';
		$data['categories'] = $this->category_model->get_categories();

		$this->form_validation->set_rules('name', 'Name', 'required');

		if($this->form_validation->run() === FALSE)
		{
			$this->load->view('template/header');
			$this->load->view('categories/create', $data);
			$this->load->view('template/footer');
		}else{
			$this->category_model->create_category();
			//set message
			$this->session->set_flashdata('category_created', 'Category has been created');
			redirect('categories');
		}
	}

	public function posts($id)
	{
		//check user
		if (!$this->session->userdata('logged_in')) {
			redirect('users/login');
		}
		
		$data['title'] = $this->category_model->get_category($id)->name;

		$data['posts'] = $this->Post_model->get_posts_by_id($id);

		$this->load->view('template/header');
		$this->load->view('posts/index', $data);
		$this->load->view('template/footer');
	}

}

/* End of file Categories.php */
/* Location: ./application/controllers/Categories.php */