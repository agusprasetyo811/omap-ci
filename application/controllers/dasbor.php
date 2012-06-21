<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dasbor extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->library('template');
	}
	
	public function index() {
		$data['content'] = 'agus'; 
		$this->template->type('pages');
		$this->template->display('my_pages', $data);
	}
}

/* End of file dasbor.php */
/* Location: ./application/controllers/dasbor.php */