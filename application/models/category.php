<?php 

/**
 * User model.
 *
 * A user has a 'userid', 'email', 'password', 'firstname', and 'lastname'
 */

class Category extends CI_Model {

	//protected $_system = null;
	protected $_fields = null;
	protected $_error = null;

	function __construct() {
	
		parent::__construct();
		
		//$this->_system = &get_instance();
		//$this->_system->load->database();

		$this->load->database();

		// Set the table fields
		$this->_fields['category_id'] = 'int';
		$this->_fields['name'] = 'string';
		
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
	 * Create the category
	 *
	 * @param array $category
	 */
	public function create( $category )
	{
		$category = $this->clean($category);
		$this->db->insert('category', $category);

		if ($this->db->insert_id())
			return $this->db->insert_id();
		else
			return false;
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
	 * Get by
	 */
	public function get_by($col, $val)
	{
		$query = $this->db->get_where('category', array( $col => $val));
		return $query->row_array();
	}

	/**
	 * Get all by
	 */
	public function get_all_by($col, $val)
	{
		$query = $this->db->get_where('category', array( $col => $val));
		return $query->result_array();
	}

	/**
	 * Get by category id
	 *
	 * @param 	int 	$category_id
	 */
	public function get_by_category_id( $category_id )
	{
		return $this->get_by( 'category_id', $category_id );
	}

	/**
	 * Get by name
	 *
	 * @param 	int 	$name
	 */
	public function get_by_name( $name )
	{
		return $this->get_by( 'name', $name );
	}
}