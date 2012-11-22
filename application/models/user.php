<?php 

/**
 * User model.
 *
 * A user has a 'userid', 'email', 'password', 'firstname', and 'lastname'
 */

class User extends CI_Model {

	//protected $_system = null;
	protected $_fields = null;
	protected $_error = null;

	function __construct() {
	
		parent::__construct();
		
		//$this->_system = &get_instance();
		//$this->_system->load->database();

		$this->load->database();
		$this->load->library('session');

		// Set the table fields
		$this->_fields['email'] = 'string';
		$this->_fields['password'] = 'string';
		$this->_fields['firstname'] = 'string';
		$this->_fields['lastname'] = 'string';
		
	}

	/**
	 * Get the error
	 */
	public function _get_error()
	{
		if (!isset($this->_error))
			return false;

		return $this->_error;
	}

	/**
	 * New user signup
	 *
	 * @param array $user
	 */
	public function signup( $user )
	{
		// Check to see if the user already exists

		// Create the user
		$userid = $this->create( $user );

		// Set the session
		$this->set_session_data($userid);

		return true;
	}

	/**
	 * Login user
	 *
	 * @param 	array 	$user
	 */
	public function login( $user )
	{
		$user = $this->clean( $user );

		if (!isset($user['email']) || !isset($user['password'])) {
			// Set error return false
			$this->_error = "Email or password was not provided";
			return false;
		}

		if ($user = $this->authenticate($user['email'], $user['password'])) {
			// Set the session data
			$this->set_session_data( $user['userid'] );
			return $user;
		} else {
			$this->_error = "Email or password was incorrect.";
			return false;
		}
	}

	/**
	 * Logout user
	 */
	public function logout()
	{
		$this->session->sess_destroy();
	}

	/**
	 * Is user logged in?
	 *
	 * @return  bool 	TRUE for logged in
	 */
	public function is_logged_in()
	{
		$sd = $this->get_session_data();

		return $sd['LOGGED'];
	}

	/**
	 * Create the user
	 *
	 * @param array $user
	 */
	public function create( $user )
	{
		$user = $this->clean($user);
		$user['password'] = $this->generate_password($user['password']);
		// return $this->_system->db->insert( 'user', $user );
		$this->db->insert('user', $user);

		if ($this->db->insert_id())
			return $this->db->insert_id();
		else
			return false;
	}

	/** 
	 * Authenticate a user
	 *
	 * @param 	string 	$email
	 * @param 	string 	$password
	 */
	public function authenticate( $email, $password )
	{
		if ( !$user = $this->get_by_email($email) ) {
			$this->_error = "This email does not exist.";
			return false;
		}

		if ( $this->generate_password($password) != $user['password'] ) {
			$this->_error = "The password is incorrect.";
			return false;
		}

		return $user;
	}

	/**
	 * Clean the input
	 *
	 * @param array $data
	 */
	private function clean( $data )
	{
		foreach ($user as $k=>$v)
		{
			if (!isset($this->_fields[$k]))
				unset($data[$k]);
		}

		return $data;
	}

	/** 
	 * Generate password
	 */
	private function generate_password( $password )
	{
		return md5("jesusis" . md5($password) . "lord");
	}

	/**
	 * Set the session data for a user
	 *
	 * @param 	int 	$userid
	 */
	public function set_session_data($userid)
	{		
		// Only place in the entire application where session data should be generated 	
		$arr = $this->get_by_userid($userid);	
		$newdata['LOGGED']=true;
		$newdata['TIME']=time();	
		$newdata['USERID'] = $userid;
		$newdata['EMAIL'] = $arr['email'];
		
		/* Save the session data */
		$this->session->set_userdata($newdata);	
		
		/* Return the array of session data */
		return $newdata;
	}

	/**
	 * Get the current session data
	 */
	public function get_session_data()
	{
		/* Instantiate $s */
		//$s = new session();
		
		/* Return session data */
		//return $s->data;
		
		/* Array of session variables */
		$session_vars = array( 'LOGGED', 'TIME', 'USERID', 'EMAIL' );
		
		foreach ($session_vars as $var) {
			$data[$var] = $this->session->userdata($var);
		}
		
		return $data;
	}

	/**
	 * Get logged in user
	 */
	public function get_logged_in_user()
	{
		if (!$this->is_logged_in())
			return false;

		$sd = $this->get_session_data();

		return $this->get_by_userid( $sd['USERID'] );
	}

	/**
	 * Get by
	 */
	public function get_by($col, $val)
	{
		$query = $this->db->get_where('user', array( $col => $val));
		return $query->row_array();
	}

	/**
	 * Get all by
	 */
	public function get_all_by($col, $val)
	{
		$query = $this->db->get_where('user', array( $col => $val));
		return $query->result_array();
	}

	/**
	 * Get by id
	 *
	 * @param 	int 	$userid
	 */
	public function get_by_userid( $userid )
	{
		return $this->get_by( 'userid', $userid );
	}

	/**
	 * Get by email
	 *
	 * @param 	string 		$email
	 */
	public function get_by_email( $email )
	{
		return $this->get_by( 'email', $email );
	}
}