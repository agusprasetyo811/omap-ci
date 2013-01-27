<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dasbor extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->omap->type('pages');
		$this->omap->title('Welcome');
		$this->omap->label('dasbor');
	}

	public function index() {
		$data['source_name'] = 'Omap-CI';
		$data['source_description'] = 'Simple and Fast Creating our site with Codeigniter implement Omap-CI';
		$data['developer_name'] = 'Agus Prasetyo';
		$data['developer_email'] = 'agusprasetyo811@gmail.com';
		
		$modules_data['dasbor_data'] = "This data from dasbor pages";
		$modules_data['version'] = "Omaps-CI 4.0";
		
		$this->omap->modules('mod_dasbor', $modules_data);
		$this->omap->display('my_pages', $data);
	}
}

/* End of file dasbor.php */
/* Location: ./application/controllers/dasbor.php */