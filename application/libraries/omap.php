<?php

/**
 * Template generator OMAP-CI
 * @author agus prasetyo (agusprasetyo811@gmail.com)
 */
class Omap {

	var $tpl;
	var $type = "default";
	var $label = "default";
	var $title = "default";
	var $admin = "default";
	var $modules = "default";

	public function __construct() {
		$this->tpl =& get_instance();
	}

	/**
	 * Fungsi type buat ngeset apakah module atau pages
	 * @param  $type
	 */
	public function type($type, $body = null, $data = null) {
		if ($type == 'modules') {
			$this->tpl->load->view($type.'/'.$body, $data);
		} else {
			$this->type = $type;
		}
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
	 * Fungsi admin buat ngeset admin aktif atau tidak
	 * @param  $admin
	 * @param $admin_boolean
	 *
	 */
	public function admin($admin, $admin_boolean = false) {
		if ($admin_boolean == true) {
			$this->admin = $admin;
		} else {
			$this->admin = THEME;
		}
	}

	public function get_admin() {
		return $this->admin;
	}

	/**
	 * Fungsi module untuk mengeset modul-modul yang aktif
	 * @param  $modules
	 *
	 */
	public function modules($modules) {
		$this->modules = $modules;
	}

	public function get_modules() {
		return $this->modules;
	}

	/**
	 * Fungsi display untuk menampikan template dengan buffer
	 * @param  $body
	 * @param  $data
	 * @param  $type
	 * @param  $label
	 * @param  $title
	 * @param  $admin
	 * @param  $modules
	 *
	 */
	public function display($body, $data = null, $type = null, $label = null, $title = null,$admin = THEME, $modules = null) {

		$new_type = null;
		$new_title = null;
		$new_label = null;
		$new_admin = null;
		$new_modules = null;

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

		// Set kondisional admin true atau false
		if ($admin == THEME) {
			if ($this->get_admin() == "") {
				$new_admin = THEME;
			} else if ($this->get_admin() == "default") {
				$new_admin = THEME;
			} else {
				$new_admin = $this->get_admin();
			}
		} else {
			$new_admin = THEME;
		}

		// Set kondisional modules
		if ($modules == null) {
			if ($this->get_modules() == "") {
				$new_modules = "";
			} else if ($this->get_modules() == "default") {
				$new_modules = "";
			} else {
				$new_modules = $this->get_modules();
			}
		} else {
			$new_modules = $modules;
		}

		ob_start();
		$file_data['TITLE'] = $new_title;
		$file_data['STYLE'] = STYLE_PATH;
		$file_data['JS'] = JS_PATH;
		$file_data['IMAGES'] = IMG_PATH;
		$file_data['SITE'] = base_url().'index.php/';
		$file_data['AUTHOR'] = '&copy '.date('Y').' omap-ci - omap. All Right Reserved';
		$file_data['DEVELOPER'] = '<a href="http://github.com/agusprasetyo811/omap-ci/">Developer</a>';
		$file_data['DEVELOPER_SITE'] = '<a href="http://cmlocator.com/">Website</a>';
		ob_end_clean();

		if ($new_modules != "") {
			$count_modules = explode(',',$new_modules);
			foreach ($count_modules as $modules) {
				ob_start();
				$file_data[strtoupper(trim($modules))] = file_get_contents(base_url().'index.php/'.trim($modules));
				ob_end_clean();
			}
		}

		ob_start();
		$this->tpl->load->view($new_type."/".$body, $data, false);
		$file_data[strtoupper($new_label)] = ob_get_contents();
		ob_end_clean();

		ob_start();
		$template_path = 'template/'.$new_admin.'/index.php';
		require $template_path;
		$temp_field = ob_get_contents();
		ob_end_clean();

		echo @$OUTPUT = preg_replace('/\{(\w+)\}/e',"\$file_data['\\1']",$temp_field);
	}
}
/* End of file omap.php */
/* Location: ./application/libraries/omap.php */