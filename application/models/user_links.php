<?php 

/**
 * User model.
 *
 * A user has a 'userid', 'email', 'password', 'firstname', and 'lastname'
 */

class User_links extends CI_Model {

	//protected $_system = null;
	protected $_fields = null;
	protected $_error = null;

	function __construct() {
	
		parent::__construct();
		
		//$this->_system = &get_instance();
		//$this->_system->load->database();

		$this->load->database();

		// Set the table fields
		$this->_fields['links_id'] = 'int';
		$this->_fields['userid'] = 'int';
		$this->_fields['id'] = 'int'; // Primary key
		$this->_fields['timestamp'] = 'int';
		$this->_fields['description'] = 'string';
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
	 * Add user link
	 *
	 * @param 	int 	$userid
	 * @param 	int 	$links_id
	 */
	public function add_user_link( $userid, $links_id )
	{
		// Ensure this record is unique
		$query = $this->db->get_where('user_links', array( 'userid' => $userid, 'links_id' => $links_id));
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
			return $result['id'];
		} 

		// Set the current time
		$timestamp = time();

		$data = array( 'userid' => $userid, 'links_id' => $links_id, 'timestamp' => $timestamp );
		$this->db->insert('user_links',$data);
		return $this->db->insert_id();
	}

	/**
	 * Update by id
	 *
	 * @param 	int 	$user_links_id
	 * @param 	array 	$data to be updated
	 */
	public function update_by_id($user_links_id,$data)
	{
		$data = $this->clean($data);

		if (empty($data))
			return false;

		$this->db->where('id', $user_links_id);
		return $this->db->update('user_links', $data); 
	}

	/**
	 * Delete by id
	 */
	public function delete_by_id($my_link_id)
	{
		return $this->db->delete('user_links', array('id' => $my_link_id)); 
	}

	/**
	 * Get by
	 */
	public function get_by($col, $val)
	{
		$query = $this->db->get_where('user_links', array( $col => $val));
		return $query->row_array();
	}

	/**
	 * Get all by
	 */
	public function get_all_by($col, $val)
	{
		$query = $this->db->get_where('user_links', array( $col => $val));
		return $query->result_array();
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
	 * Get all links by userid
	 *
	 * @param 	int 	$userid
	 */
	public function get_all_by_userid( $userid )
	{
		$query = $this->db->query("SELECT * FROM links, user_links WHERE user_links.userid=$userid AND user_links.links_id=links.id");

		return $query->result_array();
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
}