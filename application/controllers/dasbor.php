<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dasbor extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->library('template');
	}
	
	public function index() {
		$data['content'] = 'aku orangnya bagus'; 
		
		$this->omap->title('Welcome');
		$this->omap->label('models');
		$this->omap->display('my_pages', $data, 'pages'); 
	}
}

/* End of file dasbor.php */
/* Location: ./application/controllers/dasbor.php */