<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	
		$this->load->model('bmal_model');
		$this->load->model('user');
	}
	
	
	public function getlink()
	{
		$the_url = $_POST['the_url'];
				
		$response = $this->bmal_model->addLink( $the_url );
		
		echo json_encode( $response );
	}
	
	function sendurl()
	{
		// Required $_POST keys
		if (!isset($_POST['to']) || !isset($_POST['long_url']) || !isset($_POST['short_url'])) {
			echo json_encode(array(
				'error' => true,
				'message' => 'Missing parameters.'
			));
			die;
		}
		
		$short_url = $_POST['short_url'];
		$long_url = $_POST['long_url'];
		$to = $_POST['to'];
		
$body = <<<EMAIL

Hello good sir or madam,

Consider yourself beered. Here's your shortened URL:

$short_url

Original url:

$long_url

EMAIL;
		
		$this->load->library('email');

		$this->email->from( 'beered@beermealink.com', 'Tyler @ BMAL');
		$this->email->to( $to );
		
		$this->email->subject( "You've been beered. Here's your URL." );
		$this->email->message( $body );

		if ( $this->email->send() ) {
			echo json_encode( array(
				'error' => false,
				'message' => 'It worked.' 
			) );
		} else {
		   echo json_encode( array(
		   		'error' => true,
		   		'message' => 'Could not send email.'
		   ) );
		}
	}

	public function reload_mylinks()
	{
		$this->load->model('user_links');

		if (!$this->user->is_logged_in()) {
			echo json_encode(array(
				'error'		=>		true,
				'message'	=>		'User must log in.'
			));
			die;
		}

		$user = $this->user->get_logged_in_user();

		$data['links'] = $this->user_links->get_all_by_userid($user['userid']);
		$html = $this->load->view('my_links',$data,true);

		echo json_encode( array(
			'error'		=>		false,
			'html'		=>		$html
		));
		die;
	}

	public function mylink_actions()
	{
		$this->load->model('user_links');

		if (!$this->user->is_logged_in()) {
			echo json_encode(array(
				'error'		=>		true,
				'message'	=>		'User must log in.'
			));
			die;
		}

		$user = $this->user->get_logged_in_user();

		switch($_POST['action'])
		{
			case 'delete':
				$response = $this->user_links->delete_by_id($_POST['user_links_id']);
				break;

			case 'update_details':
				// Handle the category if set
				if (isset($_POST['category'])) {
					$this->load->model('category');
					$_POST['category_id'] = $uc['category_id'] = $this->category->add_or_find($_POST['category']);
					$uc['userid'] = $user['userid'];
					$this->load->model('user_category');
					$this->user_category->add($uc);
				}
				$response = $this->user_links->update_by_id($_POST['user_links_id'],$_POST);
				break;
		}

		echo json_encode($response);
	}

	/**
	 * Get user data 
	 */
	public function get_user_data()
	{
		if (!$this->user->is_logged_in()) {
			echo json_encode(array(
				'error'		=>		true,
				'message'	=>		'User is not logged in.'
			));
			die;
		}

		$user = $this->user->get_logged_in_user();

		// Get the users categories
		$this->load->model('category');
		$json['user_categories'] = $this->category->get_categories_by_userid($user['userid']);

		echo json_encode($json);
	}
}

/* End of file ajax.php */
/* Location: ./application/controllers/ajax.php */