<?php
/**
 * OMAPS-CI
 *
 * Template generator OMAP-CI
 *
 * @author 		OMAPS LABS Agus Prasetyo (agusprasetyo811@gmail.com)
 * @copyright	Copyright (c) 2012 - 2013, OMAPS LABS
 * @link		http://cmlocator.com
 * @filesource 	http://github.com/agusprasetyo811/omap-ci
 * @since		Version 4.0
 *
 */

// ------------------------------------------------------------------------

/**
 * Omap Library Class
 *
 * This class create the view make two type (pages/modules) to added in templaes
 *
 * @subpackage	Libraries
 * @category	Libraries
 * @author		OMAPS LABS
 * @link 		http://cmlocator.com
 */
class Omap {

	var $tpl;
	var $type = "default";
	var $label = "default";
	var $title = "default";
	var $modules = "default";
	var $modules_data = "default";
	var $data = "default";
	var $set_index = "default";
	var $set_view = "default";
	var $set_template = "default";

	public function __construct() {
		$this->tpl =& get_instance();
	}

	/**
	 * Type to set is the modules or pages
	 * @param  $type
	 */
	public function type($type, $body = null, $data = null) {
		if ($type == 'modules') {
			if ($body == null) {
				$this->type = $type;
			} else {
				$this->tpl->load->view($type.'/'.$body, $data);
			}
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
	public function modules($modules, $modules_data = null) {
		$this->modules = $modules;
		$this->modules_data = $modules_data;
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
	 * View to set the folder view is modules/pages
	 * @param  $folder_fiew
	 *
	 */
	public function view($folder_fiew) {
		$this->set_view = $folder_fiew;
	}

	public function get_view() {
		return $this->set_view;
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
		$new_view = null;

		# Define type is module or pages
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

		# Define is any view to set in pages for ex: pages request modules file
		if ($this->get_view() == "" || $this->get_view() == "default") {
			$new_view = $new_type;
		} else {
			$new_view = $this->get_view();
		}

		# Define title of websites
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

		# Define label to template
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

		# Define another template
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

		# Define index of templates
		if ($set_index == null) {
			if ($this->get_index() == "") {
				$new_index = "index";
			} else if ($this->get_index() == "default") {
				$new_index = "index";
			} else {
				$new_index = $this->get_index();
			}
		}
		
		# Manage template process
			if ($this->get_template() != "default") {
				ob_start();
				$new_template = $this->get_template();
				$file_data[strtoupper(trim($new_template))] = $new_template;
				ob_end_clean();
			}

			# Manage view process
			ob_start();
			$this->tpl->load->view($new_view."/".$body, $data, false);
			$file_data[strtoupper($new_label)] = ob_get_contents();
			ob_end_clean();

		# Define modules that added in any pages
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
		$file_data['IMAGES'] = base_url().'template/'.$new_template.'/images/';
		$file_data['SITE_INDEX'] = base_url().'index.php/';
		$file_data['SITE'] = base_url();
		$file_data['AUTHOR'] = AUTHOR;
		$file_data['DEVELOPER'] = DEVELOPER;
		ob_end_clean();

		if ($new_type == 'pages') {
			# Manage module process
			if ($new_modules != "") {
				$count_modules = explode(',',$new_modules);
				foreach ($count_modules as $modules) {
					# Prepare $modules_data to be default
					if ($this->modules_data == null ) {
						$file_data[strtoupper(trim($modules))] = file_get_contents(base_url().'index.php/'.trim(str_replace('__','/',$modules)));
					} else {
						# is $modules_data is_array then exec http_build_query
						if(is_array($this->modules_data)) {
							$build_query_modules_data = http_build_query($this->modules_data,'',';');
							$file_data[strtoupper(trim($modules))] = file_get_contents(base_url().'index.php/'.trim(str_replace('__','/',$modules.'?data='.$build_query_modules_data)));
						} else {
							$file_data[strtoupper(trim($modules))] = file_get_contents(base_url().'index.php/'.trim(str_replace('__','/',$modules.'?data='.$this->modules_data)));
						}		
					}
				}
			}

			# Manage data
			if ($this->get_data() != "default") {
				ob_start();
				$new_data = $this->get_data();
				$file_data[strtoupper(trim($new_data))] = $new_data;
				ob_end_clean();
			}
				
			# Buffer to template
			ob_start();
			$set_index_path = 'template/'.$new_template.'/'.$new_index.'.php';
			require $set_index_path;
			$temp_field = ob_get_contents();
			ob_end_clean();
			echo @$OUTPUT = preg_replace('/\{(\w+)\}/e',"\$file_data['\\1']",$temp_field);
		} else {
			# Get modules_data
			$modules_data = @$_GET['data'];
			$new_modules_data = str_replace(';','&',$modules_data);
			@parse_str($new_modules_data, $output_modules_data);
			
			if (is_array($output_modules_data)) {
				@extract($output_modules_data);
			} else {
				$modules_data;
			}
			
			# Extract variable
			@extract($data);
				
			# Buffer to templates
			ob_start();
			$set_index_path = 'application/views/modules/'.$body.'.php';
			require $set_index_path;
			$temp_field = ob_get_contents();
			ob_end_clean();
			echo @$OUTPUT = preg_replace('/\{(\w+)\}/e',"\$file_data['\\1']",$temp_field);
		}
	}
}
/* End of file omap.php */
/* Location: ./system/libraries/omap.php */