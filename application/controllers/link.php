<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

ini_set('display_errors', 1);
error_reporting(E_ALL);

class Link extends CI_Controller {

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		// NOt sure yet
	}

	/**
	 * Edit a link
	 */
	public function edit($user_links_id=false) // Actually the user_links id
	{
		$this->load->model('user_links');
		$this->load->model('category');

		if (!$user_links_id || !is_numeric($user_links_id)) {
			// Perhaps it was posted?
			if (!isset($_POST['user_links_id'])) {
				// Do something
			}
		}

		// Require Login
		$this->load->model('user');
		$this->user->require_login();

		$data['user'] = $user = $this->user->get_logged_in_user();

		// Handle submitted form
		if (isset($_POST['submit'])) {
			$_POST['user_links_id'] = $user_links_id;

			if (!empty($_POST['category'])) {
				$_POST['category_id'] = $uc['category_id'] = $this->category->add_or_find($_POST['category']);
				$uc['userid'] = $user['userid'];
				$this->load->model('user_category');
				$this->user_category->add($uc);
			}
			$response = $this->user_links->update_by_id($user_links_id,$_POST);
		}

		$menu = 'menus/main-user';

		// Get the entire link
		$data['link'] = $this->user_links->get_full_by_user_links_id( $user_links_id );

		// Get the users categories
		$data['categories'] = $this->category->get_categories_by_userid( $user['userid'] );

		$head['javascripts'][] = '/js/bmal.js';
		$head['javascripts'][] = '/js/mylinks.js';
		$head['javascripts'][] = '/js/user.js';
	
		$this->load->view('head', $head);
		$this->load->view($menu, $data);
		$this->load->view('link/edit',$data);
		$this->load->view('footer');
	}
	

}

/* End of file link.php */
/* Location: ./application/controllers/link.php */