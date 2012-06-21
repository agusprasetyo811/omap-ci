<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dasbor extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->library('omap');
	}
	
	public function index() {
		$data['content'] = 'ini adalah website pertamaku pake CI'; 
		
		$this->omap->type('pages');
		$this->omap->title('Welcome');
		$this->omap->label('dasbor');
		$this->omap->display('my_pages', $data); 
	}
}

/* End of file dasbor.php */
/* Location: ./application/controllers/dasbor.php */