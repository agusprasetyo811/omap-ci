<?php

/**
 * Template generator OMAP-CI
 * @author agus prasetyo (agusprasetyo811@gmail.com)
 */
class Template {

	var $tpl;
	var $type = "default";
	var $label = "default";
	var $title = "default";

	public function __construct() {
		$this->tpl =& get_instance();
	}

	/**
	 * Fungsi type buat ngeset apakah module atau pages
	 * @param  $type
	 */
	public function type($type) {
		$this->type = $type;
	}

	public function get_type(){
		return $this->type;
	}
	
	/**
	 * Fungsi title buat ngeset title
	 * @param  $title
	 */	
	public function title($title) {
		$this->title = $title;
	}
	
	public function get_title() {
		return $this->title;
	}
	
	/**
	 * Fungsi label buat ngeset label {}
	 * @param  $label
	 */
	
	public function label($label) {
		$this->label = $label;
	}
	
	public function get_label() {
		return $this->label;
	}

	/**
	 * Fungsi display untuk menampikan template dengan buffer
	 * @param  $body
	 * @param  $data
	 * @param  $type
	 */
	public function display($body, $data = null, $type = null, $label = null, $title= null) {
		
		$new_type = null;
		$new_title = null;
		$new_label = null;
		
		// Set type dari halaman apakah bertype modules atau pages 
		if ($type == null) {
			if ($this->get_type() == "") {
				$new_type = "pages";
			} else if ($this->get_type() == "default") {
				$new_type = "pages";
			} else {
				$new_type = $this->get_type();
			}
		} else {
			$new_type = $type;
		}
		
		// Set kondisional title dari website
		if ($title == null) {
			if ($this->get_title() == "") {
				$new_title = "omap-ci";
			} else if ($this->get_title() == "default") {
				$new_title = "omap-ci";
			} else {
				$new_title = $this->get_title();
			}
		} else {
			$new_title = $title;
		}
		
		// Set kondisional label name buat penempatan {...}
		if ($label == null) {
			if ($this->get_label() == "") {
				$new_label = "omap-ci";
			} else if ($this->get_label() == "default") {
				$new_label = "omap-ci";
			} else {
				$new_label = $this->get_label();
			}
		} else {
			$new_label = $label;
		}

		ob_start();
		$this->tpl->load->view($new_type."/".$body, $data, false);
		$file_data[strtoupper($new_label)] = ob_get_contents();
		ob_end_clean();
		
		ob_start();
		$file_data['STYLE'] = STYLE_PATH;
		$file_data['JS'] = JS_PATH;
		ob_end_clean();
		
		ob_start();
		$file_data['TITLE'] = $new_title;
		ob_end_clean();

		ob_start();
		$template_path = 'template/'.THEME.'/index.php';
		require $template_path;
		$temp_field = ob_get_contents();
		ob_end_clean();
		echo @$OUTPUT = preg_replace('/\{(\w+)\}/e',"\$file_data['\\1']",$temp_field);
	}
}
/* End of file template.php */
/* Location: ./application/libraries/template.php */