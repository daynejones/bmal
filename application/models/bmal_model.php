<?php 

class Bmal_model extends CI_Model {

	protected $_system = null;

	function __construct() {
	
		parent::__construct();
		
		$this->_system = &get_instance();
		$this->_system->load->database();
		
	}

	public function getLast() {

		$this->_system->db->select_max('id');
		$query = $this->_system->db->get('links');
		
		$row = $query->result_array();
		$max_id = $row[0]['id'];
				
		$query = $this->_system->db->query( "SELECT * FROM links WHERE id=$max_id" );
		$data = $query->result_array();

		if ( empty( $data ) ) 
			return "aaa";
		else 
			return $data[0]['code'];
	
	}

	public function getLinkCode() {

		$last = $this->getLast();

        $next = false;

        $letters = array();

        // Populate the letters array

        foreach (range('a', 'z') as $letter) {
                $letters[] = $letter;
        }

        foreach (range('A', 'Z') as $letter) {
                $letters[] = $letter;
        }


        foreach ( $letters as $k1 => $v1 ) {
            foreach ( $letters as $k2 => $v2 ) {
                foreach ( $letters as $k3 => $v3 ) {
                    $code =  $v3 . $v2 . $v1;
                    if ( $next )
                            return $code;
                    if ( $code == $last )
                            $next = true;
                }
	       }
	    }
	}

	private function isNotUniqueURL( $url ) {
	
		$url = mysql_real_escape_string($url);

		$query = $this->_system->db->query( "SELECT * FROM `links` WHERE `url`='$url' LIMIT 1" );

		$row = $query->result_array();

		if ( $query->num_rows() < 1 )
			return false;
		else 
			return $row[0]['code'];

	}

	public function addLink( $url ) {
		
		$this->_system->load->model('user');
		$this->_system->load->model('links');
		$this->_system->load->model('user_links');

		// Check to see if url has already been submitted
		if ( $link_code = $this->isNotUniqueURL( $url ) ) { 
			if ( $this->_system->user->is_logged_in() ) {
				// Associate logged in user with the link
				$sd = $this->_system->user->get_session_data();
				$link = $this->_system->links->get_by_code($link_code);
				$this->_system->user_links->add_user_link( $sd['USERID'], $link['id'] );
			}
			return array( 'error' => false, 'link_code' => $link_code );
		}

		$link_code = $this->getLinkCode();
		
		$url = mysql_real_escape_string($url);
		
		$data['code'] = $link_code;
		$data['url'] = $url; 

		if ( $this->_system->db->insert( 'links', $data ) ) {
			// If user is logged in
			if ( $this->_system->user->is_logged_in() ) {
				// Associate logged in user with the link
				$sd = $this->_system->user->get_session_data();
				$this->user_links->add_user_link( $sd['USERID'], $this->_system->db->insert_id() );
			}
			return array( 'error' => false, 'link_code' => $link_code );
		}
		else
			return array('error'=>true,'message' => $this->_system->db->_error_message() );
  	}

	public function getURLfromCode( $code ) {
		
		$query = $this->_system->db->query( "SELECT * FROM links WHERE binary code='$code'" );

		if ( $query->num_rows > 1 )
			return array( 'error' => true, 'message' => mysql_error() );
		else {
			$row = $query->result_array();

			if ( empty( $row ) )
				return array( 'error' => true, 'message' => 'Not found' );

			$url = $row[0]['url'];
			return array( 'error' => false, 'url' => $url );
		}

	}

}