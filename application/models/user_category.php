<?php 

/**
 * User model.
 *
 * A user has a 'userid', 'email', 'password', 'firstname', and 'lastname'
 */

class User_category extends CI_Model {

	//protected $_system = null;
	protected $_fields = null;
	protected $_error = null;

	function __construct() {
	
		parent::__construct();
		
		//$this->_system = &get_instance();
		//$this->_system->load->database();

		$this->load->database();

		// Set the table fields
		$this->_fields['userid'] = 'int';
		$this->_fields['category_id'] = 'int';
		
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
	 * @param array $data
	 */
	private function clean( $data )
	{
		foreach ($data as $k=>$v)
		{
			if (!isset($this->_fields[$k]))
				unset($data[$k]);
		}

		return $data;
	}

	/**
	 * Get by
	 */
	public function get_by($col, $val)
	{
		$query = $this->db->get_where('user_category', array( $col => $val));
		return $query->row_array();
	}

	/**
	 * Get all by
	 */
	public function get_all_by($col, $val)
	{
		$query = $this->db->get_where('user_category', array( $col => $val));
		return $query->result_array();
	}

	/**
	 * Add a new user_category relationship
	 *
	 * @param 	array 	$user_category containing category_id and userid
	 * @return 	bool 	true/false successs
	 */
	public function add($user_category)
	{
		$user_category = $this->clean($user_category);

		$query = $this->db->get_where('user_category', array( 'userid' => $user_category['userid'], 'category_id' => $user_category['category_id']));

		if ($query->num_rows() > 0) {
			// This relationship already exists
			return true;
		}

		return $this->create($user_category);
	}

	/**
	 * Create the user category connection
	 *
	 * @param array $user_category
	 */
	public function create( $user_category )
	{
		$category = $this->clean($user_category);
		$this->db->insert('user_category', $user_category);

		if ($this->db->insert_id())
			return $this->db->insert_id();
		else
			return false;
	}

	/**
	 * Get by userid
	 *
	 * @param 	int 	$userid
	 */
	public function get_by_userid( $userid )
	{
		return $this->get_all_by( 'userid', $userid );
	}

	/**
	 * Get by category_id
	 *
	 * @param 	int 	$category_id
	 */
	public function get_by_category_id( $category_id )
	{
		return $this->get_by( 'category_id', $category_id );
	}
}