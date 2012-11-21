<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

ini_set('display_errors', 1);
error_reporting(E_ALL);

class Users extends CI_Controller {

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		// NOt sure yet
	}
	
	public function signup()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->database();

		// $head['javascripts'][] = 'js/bg.js';

		// If submitting the signup form
		if (isset($_POST['submit'])) {
			// Validate
			$this->load->library('form_validation');

			$this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[user.email]');
			$this->form_validation->set_rules('password', 'password', 'required');
			$this->form_validation->set_rules('firstname', 'first name', 'required');
			$this->form_validation->set_rules('lastname', 'last name', 'required');

			if ($this->form_validation->run() == FALSE) {
				// Just show the form
			} else {
				$this->load->model('user');
				$this->user->signup($_POST);
				redirect('', 'refresh');
				die;
			}
		}

		$this->load->view( 'head' );
		$this->load->view( 'menus/main' );
		$this->load->view( 'sections/signup' );
		$this->load->view( 'footer' );
	}

	/**
	 * User login
	 */
	public function login()
	{
		$data = array();

		$this->load->helper('url');

		// If submitting the login form
		if (isset($_POST['submit'])) {
			$this->load->model('user');
			if ($this->user->login($_POST))
			{
				redirect('','refresh');
			}
			else 
			{
				$data['error'] = $this->user->_get('error');
			}
		}

		$this->load->view('head');
		$this->load->view('menus/main');
		$this->load->view('sections/login',$data);
		$this->load->view('footer');
	}

	/**
	 * Logout
	 */
	public function logout()
	{
		$this->load->model('user');
		$this->user->logout();
		$this->load->helper('url');
		redirect('','refresh');
	}

	/**
	 * Temp - session data
	 */
	public function session()
	{
		$this->load->helper(array('form', 'url'));

		$this->load->model('user');
		$session_data = $this->user->get_session_data();

		print_r($session_data);

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */