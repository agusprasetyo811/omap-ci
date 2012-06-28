<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dasbor extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->library('omap');
	}
	
	public function index() {
		$data['source_name'] = 'Omap-CI';
		$data['source_description'] = 'Simple and Fast Creating our site with Codeigniter implement Omap-CI';
		$data['developer_name'] = 'Agus Prasetyo';
		$data['developer_email'] = 'agusprasetyo811@gmail.com';
		
		$this->omap->type('pages');
		$this->omap->title('Welcome');
		$this->omap->label('dasbor');
		$this->omap->display('my_pages', $data);
	}
}

/* End of file dasbor.php */
/* Location: ./application/controllers/dasbor.php */