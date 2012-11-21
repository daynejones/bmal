<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	/**
	 * This is the main controller for the front of the site
	 */
	public function index()
	{
		// Nothing yet
	}
	
	/**
	 * Show the page
	 */
	public function show( $code )
	{
		$this->load->model( 'bmal_model' );
	
		if ( $code == '' )
			header( 'Location: http://www.beermealink.com' );
						
		$response = $this->bmal_model->getURLFromCode( $code );
		
		if ( !$response['error'] )
			header( 'Location: ' . $response['url'] );
		else 
			$message = 'This url does not exist!';
		
		echo "
		<html>
		<head>
		<title>BMAL</title>
		</head>
		<body>
		<?= $message; ?>
		</body>
		</html>";
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
