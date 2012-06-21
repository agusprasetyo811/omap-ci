<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dasbor extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->library('template');
	}
	
	public function index() {
		$data['content'] = 'ini adalah dataku'; 
		
		$this->template->title('omap-ciscc');
		$this->template->label('model');
		$this->template->display('my_pages', $data, 'pages');
	}
}

/* End of file dasbor.php */
/* Location: ./application/controllers/dasbor.php */