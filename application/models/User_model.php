<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function register($enc_passsword){
		//user data array
		$data = array(
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'username' => $this->input->post('username'),
			'password' => $enc_passsword,
			'zipcode' => $this->input->post('zipcode')
		);

		//insert user
		return $this->db->insert('users', $data);
	}

	public function login($username, $password){
		//validate
		$this->db->where('username', $username);
		$this->db->where('password', $password);

		$result = $this->db->get('users');

		if($result->num_rows() == 1){
			return $result->row(0)->id;
		}else{
			return false;
		}

	}

	public function check_username_exists($username){
		$query = $this->db->get_where('users', array('username' => $username));

		if(empty($query->row_array())){
			return true;
		}else{
			return false;
		}
	}

	public function check_email_exists($email){
		$query = $this->db->get_where('users', array('email' => $email));

		if(empty($query->row_array())){
			return true;
		}else{
			return false;
		}
	}

}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */