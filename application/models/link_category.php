<?php 

/**
 * User model.
 *
 * A user has a 'userid', 'email', 'password', 'firstname', and 'lastname'
 */

class Link_category extends CI_Model {

	//protected $_system = null;
	protected $_fields = null;
	protected $_error = null;

	function __construct() {
	
		parent::__construct();
		
		//$this->_system = &get_instance();
		//$this->_system->load->database();

		$this->load->database();

		// Set the table fields
		$this->_fields['link_id'] = 'int';
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
		$query = $this->db->get_where('link_category', array( $col => $val));
		return $query->row_array();
	}

	/**
	 * Get all by
	 */
	public function get_all_by($col, $val)
	{
		$query = $this->db->get_where('link_category', array( $col => $val));
		return $query->result_array();
	}

	/**
	 * Create the link category connection
	 *
	 * @param array $link_category
	 */
	public function create( $link_category )
	{
		$category = $this->clean($link_category);
		$this->db->insert('link_category', $link_category);

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
	public function get_by_link_id( $link_id )
	{
		return $this->get_by( 'link_id', $link_id );
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