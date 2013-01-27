<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mod_dasbor extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->omap->title('Welcome');
		$this->omap->type('modules');
	}
	
	public function index() {
		$data['logo_large'] = "logo_large.png";
		$data['logo_only'] = "logo_only.png";
		$data['logo'] = "logo.png";
		$data['structure'] = "structure.png";
		
		$this->omap->display('my_modules', $data);
	}
}

/* End of file mod_dasbor.php */
/* Location: ./application/controllers/mod_dasbor.php */