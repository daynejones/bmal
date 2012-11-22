<?php 

/**
 * User model.
 *
 * A user has a 'userid', 'email', 'password', 'firstname', and 'lastname'
 */

class Links extends CI_Model {

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
		$this->_fields['code'] = 'string';
		$this->_fields['url'] = 'string';
		$this->_fields['userid'] = 'int';
		
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
	 * Clean the input
	 *
	 * @param array $user
	 */
	private function clean( $user )
	{
		foreach ($user as $k=>$v)
		{
			if (!isset($this->_fields[$k]))
				unset($user[$k]);
		}

		return $user;
	}

	/**
	 * Get by
	 */
	public function get_by($col, $val)
	{
		$query = $this->db->get_where('links', array( $col => $val));
		return $query->row_array();
	}

	/**
	 * Get all by
	 */
	public function get_all_by($col, $val)
	{
		$query = $this->db->get_where('links', array( $col => $val));
		return $query->result_array();
	}

	/**
	 * Get by link code
	 */
	public function get_by_code( $code )
	{
		return $this->get_by( 'code', $code );
	}

	/**
	 * Get by userid
	 *
	 * @param 	int 	$userid
	 */
	public function get_by_userid( $userid )
	{
		return $this->get_by( 'userid', $userid );
	}

	/**
	 * Get all by userid
	 *
	 * @param 	int 	$userid
	 */
	public function get_all_by_userid( $userid )
	{
		return $this->get_all_by( 'userid', $userid );
	}
}