<?php

/**
 * Template generator OMAP-CI
 * @author agus prasetyo (agusprasetyo811@gmail.com)
 */
class Template {

	var $tpl;
	var $type = "default";

	public function __construct() {
		$this->tpl =& get_instance();
	}

	public function type($type) {
		$this->type = $type;
	}

	public function get_type(){
		return $this->type;
	}

	/**
	 * Fungsi display untuk menampikan template dengan buffer
	 * @param  $body
	 * @param  $data
	 * @param  $type
	 */
	public function display($body, $data = null, $type = null) {
		$label = null;
		if ($type == null) {
			if ($this->get_type() == "") {
				$label = "pages";
			} else if ($this->get_type() == "default") {
				$label = "pages";
			} else {
				$label = $this->get_type();
			}
		} else {
			$label = $type;
		}
		
		ob_start();
		$this->tpl->load->view(THEME.'/'.$label."/".$body, $data, false);
		$file_data[strtoupper($label)] = ob_get_contents();
		ob_end_clean();

		ob_start();
		$template_path = APPPATH.'views/'.THEME.'/index.php';
		require_once $template_path;
		$temp_field = ob_get_contents();
		ob_end_clean();
		echo @$OUTPUT = preg_replace('/\{(\w+)\}/e',"\$file_data['\\1']",$temp_field);
	}
}
/* End of file template.php */
/* Location: ./application/libraries/template.php */