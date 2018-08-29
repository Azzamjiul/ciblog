<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		
	}

	public function view($page = 'home')
	{
		echo $page; return;
		if(!file_exists(APPPATH.'views/pages/'.$page.'.php'))
		{
			show_404();
		}

		$data['title'] = ucfirst($page);

		$this->load->view('template/header');
		$this->load->view('pages/'.$page, $data);
		$this->load->view('template/footer');
	}

}

/* End of file Pages.php */
/* Location: ./application/controllers/Pages.php */