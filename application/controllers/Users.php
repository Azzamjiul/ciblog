<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		
	}

	public function register(){
		$data['title'] = 'Sign Up';

		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
		$this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');

		if($this->form_validation->run() === FALSE){
			$this->load->view('template/header');
			$this->load->view('users/register', $data);
			$this->load->view('template/footer');
		}else{
			//Encrypt password
			$enc_password = md5($this->input->post('password'));

			$this->user_model->register($enc_password);

			//set message
			$this->session->set_flashdata('user_registered', 'You are now registered and can log in');
			redirect('posts');
		}
	}

	public function login(){
		$data['title'] = 'Sign In';

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if($this->form_validation->run() === FALSE){
			$this->load->view('template/header');
			$this->load->view('users/login', $data);
			$this->load->view('template/footer');
		}else{
			//get username
			$username = $this->input->post('username');
			//get and enrypt password
			$password = md5($this->input->post('password'));

			//login user
			$user_id = $this->user_model->login($username, $password);

			if($user_id){
				//create session
				$user_data = array(
					'user_id'	=>	$user_id,
					'username'	=>	$username,
					'logged_in'	=> true
				);

				//set the session
				$this->session->set_userdata($user_data);

				//set message
				$this->session->set_flashdata('user_loggedin', 'You are now logged in');
				redirect('posts');
			}else{
				//set message
				$this->session->set_flashdata('login_failed', 'Login is invalid');
				redirect('users/login');
			}
		}
	}

	public function logout(){
		//unset user data
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('user_id');

		//set message
		$this->session->set_flashdata('user_loggedout', 'You are now logged out');
		redirect('users/login');

	}

	public function check_username_exists($username){
		$this->form_validation->set_message('check_username_exists', "that username is taken. please choose a different one");

		if($this->user_model->check_username_exists($username)){
			return true;
		}else{
			return false;
		}
	}

	public function check_email_exists($email){
		$this->form_validation->set_message('check_email_exists', "that email is taken. please choose a different one");

		if($this->user_model->check_email_exists($email)){
			return true;
		}else{
			return false;
		}
	}

}

/* End of file Users.php */
/* Location: ./application/controllers/Users.php */