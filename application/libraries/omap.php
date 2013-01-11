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
	var $set_template = "default";
	var $modules = "default";
	var $data = "default";
	var $set_index = "default";

	public function __construct() {
		$this->tpl =& get_instance();
	}

	/**
	 * Type to set is the modules or pages
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
	 * Title to set the title of website
	 * @param  $title
	 */
	public function title($title) {
		$this->title = $title;
	}

	public function get_title() {
		return $this->title;
	}

	/**
	 * Label to set the label in template {}
	 * @param  $label
	 */
	public function label($label) {
		$this->label = $label;
	}

	public function get_label() {
		return $this->label;
	}

	/**
	 * Template to determine the name of template who we are use
	 * @param  $set_template
	 * @param $set_template_boolean
	 *
	 */
	public function template($set_template) {
		$this->set_template = $set_template;
	}

	public function get_template() {
		return $this->set_template;
	}

	/**
	 * Module to set that the modules activate in any controller/views
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
	 * Data to set the file that sending to the template
	 * @param  $data
	 *
	 */
	public function data($data) {
		$this->data = $data;
	}

	public function get_data() {
		return $this->data;
	}

	/**
	 * Index to set the index of template who we are use
	 * @param  $file
	 *
	 */
	public function index($file) {
		$this->set_index = $file;
	}

	public function get_index() {
		return $this->set_index;
	}

	/**
	 * Display is the end to showing the display setting of omaps-ci
	 * @param  $body
	 * @param  $data
	 * @param  $type
	 * @param  $label
	 * @param  $title
	 * @param  $set_template
	 * @param  $modules
	 *
	 */
	public function display($body, $data = null, $type = null, $label = null, $title = null, $set_template = THEME, $set_index = null, $modules = null) {

		$new_type = null;
		$new_title = null;
		$new_label = null;
		$new_template = null;
		$new_modules = null;
		$new_data = null;
		$new_index = "index";

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

		if ($set_template == THEME) {
			if ($this->get_template() == "") {
				$new_template = THEME;
			} else if ($this->get_template() == "default") {
				$new_template = THEME;
			} else {
				$new_template = $this->get_template();
			}
		} else {
			$new_template = THEME;
		}

		if ($set_index == null) {
			if ($this->get_index() == "") {
				$new_index = "index";
			} else if ($this->get_index() == "default") {
				$new_index = "index";
			} else {
				$new_index = $this->get_index();
			}
		} else {
		}

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
		$file_data['STYLE'] = base_url().'template/'.$new_template.'/style/';
		$file_data['JS'] = base_url().'template/'.$new_template.'/js/';
		$file_data['IMAGES'] = IMG_PATH;base_url().'template/'.$new_template.'/images/'
		$file_data['SITE_INDEX'] = base_url().'index.php/';
		$file_data['SITE'] = base_url();
		$file_data['AUTHOR'] = '&copy '.date('Y').' omap-ci - omap. All Right Reserved';
		$file_data['DEVELOPER'] = '<a href="http://github.com/agusprasetyo811/omap-ci/">Developer</a>';
		$file_data['DEVELOPER_SITE'] = '<a href="http://cmlocator.com/">Website</a>';
		ob_end_clean();

		if ($new_modules != "") {
			$count_modules = explode(',',$new_modules);
			foreach ($count_modules as $modules) {
				ob_start();
				$file_data[strtoupper(trim($modules))] = file_get_contents(base_url().'index.php/'.trim(str_replace('__','/',$modules)));
				ob_end_clean();
			}
		}

		if ($this->get_data() != "default") {
			ob_start();
			$new_data = $this->get_data();
			$file_data[strtoupper(trim($new_data))] = $new_data;
			ob_end_clean();
		}

		if ($this->get_template() != "default") {
			ob_start();
			$new_template = $this->get_template();
			$file_data[strtoupper(trim($new_template))] = $new_template;
			ob_end_clean();
		}

		ob_start();
		$this->tpl->load->view($new_type."/".$body, $data, false);
		$file_data[strtoupper($new_label)] = ob_get_contents();
		ob_end_clean();

		ob_start();
		$set_index_path = 'template/'.$new_template.'/'.$new_index.'.php';
		require $set_index_path;
		$temp_field = ob_get_contents();
		ob_end_clean();

		echo @$OUTPUT = preg_replace('/\{(\w+)\}/e',"\$file_data['\\1']",$temp_field);
	}
}
/* End of file omap.php */
/* Location: ./application/libraries/omap.php */