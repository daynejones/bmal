<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	/**
	 * This is the main controller for the front of the site
	 */
	public function index()
	{
		$data = array();

		$this->load->model('user');

		// View defaults
		$menu = 'menus/main';

		$is_logged_in = $this->user->is_logged_in();
		if ($is_logged_in) {
			// Set the user
			$sd = $this->user->get_session_data();
			$data['user'] = $user = $this->user->get_by_userid($sd["USERID"]);
			$menu = 'menus/main-user';
		}

		$head['javascripts'][] = 'js/bmal.js';
		$head['javascripts'][] = 'js/mylinks.js';
		// $head['javascripts'][] = 'js/bg.js';
	
		$this->load->view('head', $head);
		$this->load->view($menu, $data);

		if ($is_logged_in) {
			$this->load->model('user_links');
			$links['links'] = $this->user_links->get_all_by_userid($user['userid']);
			$data['my_links'] = $this->load->view('my_links',$links,true);
		}

		$this->load->view('bmal',$data);
		$this->load->view('footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
