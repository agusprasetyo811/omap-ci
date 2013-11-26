<?php
/**
 * OMAPS-CI
 *
 * Template generator OMAP-CI
 *
 * @author 		OMAPS LABS Agus Prasetyo (agusprasetyo811@gmail.com)
 * @copyright	Copyright (c) 2012 - 2013, OMAPSLABS
 * @link		http://cmlocator.com
 * @filesource 	http://github.com/agusprasetyo811/omap-ci
 * @since		Version 4.6
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
 * @author		OMAPSLABS
 * @link 		http://cmlocator.com
 */
class Omap  {

	var $tpl;
	var $type = "default";
	var $label = "default";
	var $title = "default";
	var $modules = "default";
	var $modules_data = "default";
	var $modules_data_access_in_controller = FALSE;
	var $data = "default";
	var $set_index = "default";
	var $set_view = "default";
	var $set_template = "default";
	var $set_head_data = "default";
	var $compress_html = HTML_COMPRESSOR;

	public function __construct() {
		$this->tpl =& get_instance();
		log_message('debug', 'OMAPS-CI '.$this->tpl->config->item('version').' RUNNING');
	}

	/**
	 * Type to set is the modules or pages
	 * @param  $type
	 */
	public function type($type, $body = NULL, $data = NULL) {
		if ($type == 'modules') {
			if ($body == NULL) {
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
	 * @param  $modules_data
	 * @param  $access_in_controller
	 *
	 */
	public function modules($modules, $modules_data = NULL, $access_in_controller = FALSE) {
		$this->modules = $modules;
		$this->modules_data = $modules_data;
		$this->modules_data_access_in_controller = $access_in_controller;
	}
	
	/**
	 * Modules builder to set that the modules activate in any controller/views
	 * @param  $modules
	 *
	 */
	public function modules_build($modules) {
		$this->modules = $modules;
		$this->modules_data_access_in_controller = TRUE;
	}
	
	/**
	 * Modules Register to register any modules and saving on sessions
	 * @param  $mod
	 *
	 */
	public function modules_register($mod) {
		foreach ($mod as $m) {
			$m_label = $m; 
			$m_class = $m;
			$get_method = explode('__', $m);
			require_once 'application/controllers/'. $get_method[0].'.php';
			$m_class = new $get_method[0]();
			
			//var_dump($get_method);
			if (count($get_method) != 1) {	
				$m = $m_class->$get_method[1]();
				$this->tpl->session->set_userdata('session_mod_data_'.$m_label, $m);
			} else {
				$m = $m_class->index();
				$this->tpl->session->set_userdata('session_mod_data_'.$m_label, $m);
			}
		}	
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
	 * Head to set head data in template
	 * @param  $head_data
	 *
	 */
	public function head($head_data) {
		$this->set_head_data = $head_data;
	}

	public function get_head() {
		return $this->set_head_data;
	}

	/**
	 * build_json_data to build data with json format
	 * @param  $array_data
	 * @return json_data
	 */
	public function build_json_data($array_data) {
		if (is_array($array_data)) {
			return json_encode($array_data);
		} else {
			return '{"notif":"ERROR","message": "OMAPS CI build_json_data failed, Data not Array!!"}';
		}
	}

	/**
	 * Push to sending or push data
	 * @param  $data
	 *
	 */
	public function push($data) {
		echo $data;
	}

	/**
	 * Pull to get push data
	 * @param  $api_type
	 * @param  $api_action
	 * @return $data;
	 */
	public function pull($api_type, $api_action) {
		$data = @file_get_contents(base_url().'index.php/api/'.$api_type.'/'.$api_action) or exit(show_error('OMAPS-CI API ERROR,  ACTION <b>'.$api_type.'</b> is illegal'));
		return $data;
	}
	
	/**
	 * Load Api Data
	 * @param  $api_data
	 * 
	 */
	public function api($api_file) {
		$this->tpl->load->library('../controllers/'.$api_file);
		return $this->tpl->$api_file;
	}
	
	/**
	 * Load Single Controlles Data
	 * @param  $api_data
	 *
	 */
	public function controller($controllers, $return_data = NULL) {
		if ($return_data != NULL) {
			$get_method = explode('__', $controllers);
			if (count($get_method) != 1) {
				$this->tpl->load->library('../controllers/'.$get_method[0]);
				return $this->tpl->$get_method[0]->$get_method[1]();
			} else {
				$this->tpl->load->library('../controllers/'.$get_method[0]);
				return $this->tpl->$get_method[0]->index();
			}
		} else {
			$this->tpl->load->library('../controllers/'.$controllers);
			return $this->tpl->$controllers;
		}
	}
	

	/**
	 * Set_tpl_data to set template of data
	 * @param  $tpl
	 * @param  $data
	 * @return $tpl;
	 */
	public function mod_tpl_data($tpl, $data= NULL) {
		$tpl = $this->tpl->load->view('modules/'.$tpl, $data, true);
		return $tpl;
	}
	
	/**
	 * Register variable
	 * @return $data;
	 */
	public function register_mod_var() {
		return get_modules_access_data($this->tpl->input->get('modules_data'));
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
	public function display($body, $data = NULL, $return_display = FALSE, $type = NULL, $label = NULL, $title = NULL, $set_template = THEME, $set_index = NULL, $modules = NULL) {

		$new_type = NULL;
		$new_title = NULL;
		$new_label = NULL;
		$new_template = NULL;
		$new_modules = NULL;
		$new_data = NULL;
		$new_index = "index";
		$new_view = NULL;
		

		# Define type is module or pages
		if ($type == NULL) {
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
		if ($title == NULL) {
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
		if ($label == NULL) {
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
		if ($set_index == NULL) {
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

		# Define modules that added in any pages
		if ($modules == NULL) {
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
		$file_data['SITE_TEMPLATE'] = SITE_TEMPLATE;
		$file_data['SITE'] = base_url();
		$file_data['ASSETS'] = ASSETS .'/';
		$file_data['THEME'] = THEME;
		$file_data['ADMIN_THEME'] = ADMIN_THEME;
		$file_data['FLUID_THEME'] = $new_template;
		$file_data['AUTHOR'] = AUTHOR;
		$file_data['VERSION'] = VERSION;
		$file_data['SINCE'] = SINCE;
		$file_data['DEVELOPER'] = DEVELOPER;
		ob_end_clean();

		# Define Site Theme
		//define('FLUID_THEME', $new_template);

		# Define head if set or not
		if ($this->get_head() != "default") {
			$file_data['HEAD'] = $this->get_head();
		} else {
			$file_data['HEAD'] = NULL;
		}

		if ($new_type == 'pages') {
			
			if ($this->modules_data_access_in_controller == FALSE ) {	
				# Manage module process with file_get_contents
				if ($new_modules != "") {
					foreach ($new_modules as $modules) {
						# Prepare $modules_data to be default
						if ($this->modules_data == NULL ) {
							//$file_data[strtoupper(trim($modules))] = $this->tpl->load->library('../controllers/'.trim(str_replace('__','/',$modules))) or die('<div style=position:relative; z-index:100; backgroud:white;><h3>OMAPS-CI MESSAGE :</h3><b style=color:red;>MODULES NULL</b> : <b>'. $modules .'</b> Not Founds.</div>');
							$file_data[strtoupper(trim($modules))] = @file_get_contents(base_url().'index.php/'.trim(str_replace('__','/',$modules)));
							//log_message('debug', 'OMAPS-CI '.$this->tpl->config->item('version').' RUNNING MODULES '. strtoupper(trim($modules)));
						} else {
							# is $modules_data is_array then exec http_build_query
							if(is_array($this->modules_data)) {
								trim(str_replace('__','/',$modules)); 
								$build_query_modules_data = http_build_query($this->modules_data,'',';');
								$file_data[strtoupper(trim($modules))] = @file_get_contents(base_url().'index.php/'.trim(str_replace('__','/',$modules)).'?modules_data='.$build_query_modules_data);
								//or die(show_error('OMAPS-CI MESSAGE : Modules ( '. $modules .' ) Not Founds.'))
								//log_message('debug', 'OMAPS-CI '.$this->tpl->config->item('version').' RUNNING MODULES '. strtoupper(trim($modules)));
							}
						}
					}
				}
			
			} else {				
				if ($new_modules != "") {
					if (is_array($new_modules)) {
						$modules = $new_modules;
					} else {
						$modules = array();
					}
					
					foreach ($modules as $mod) {
						$file_data[strtoupper(trim($mod))] = $this->tpl->session->userdata('session_mod_data_'.$mod);
						$this->tpl->session->unset_userdata('session_mod_data_'.$mod);
					}
				}
			}
			
				
			# Manage module process with curl
			/*
			if ($new_modules != "") {
				$count_modules = explode(',',$new_modules);
				foreach ($count_modules as $modules) {
					# Prepare $modules_data to be default
					if ($this->modules_data == NULL ) {
						$file_data[strtoupper(trim($modules))] = @get_content_curl(base_url().'index.php/'.trim(str_replace('__','/',$modules))) or die('<div style=position:relative; z-index:100; backgroud:white;><h3>OMAPS-CI MESSAGE :</h3><b style=color:red;>MODULES NULL</b> : <b>'. $modules .'</b> Not Founds.</div>');
					} else {
						# is $modules_data is_array then exec http_build_query
						if(is_array($this->modules_data)) {
							$build_query_modules_data = http_build_query($this->modules_data,'',';');
							$file_data[strtoupper(trim($modules))] = @get_content_curl(base_url().'index.php/'.trim(str_replace('__','/',$modules)).'?modules_data='.$build_query_modules_data) or die('<div style=position:relative; z-index:100; backgroud:white;><h3>OMAPS-CI MESSAGE :</h3><b style=color:red;>MODULES NULL</b> : <b>'. $modules .'</b> Not Founds.</div>');
						}
					}
				}
			}
			*/

			# Manage data
			if ($this->get_data() != "default") {
				ob_start();
				$new_data = $this->get_data();
				$file_data[strtoupper(trim($new_data))] = $new_data;
			}

			# Manage view process
			ob_start();
			$this->tpl->load->view($new_view."/".$body, $data, FALSE);

			# Comperss HTML if TRUE
			if ($this->compress_html == TRUE) {
				// Compress HTML
				$search = array(
			        '/\>[^\S ]+/s', //strip whitespaces after tags, except space
			        '/[^\S ]+\</s', //strip whitespaces before tags, except space
			        '/(\s)+/s'  //shorten multiple whitespace sequences
				);
				$replace = array(
			        '>',
			        '<',
			        '\\1'
			        );
			        $body_data = preg_replace($search, $replace, ob_get_contents());
			} else {
				$body_data = ob_get_contents();
			}

			$file_data[strtoupper($new_label)] = preg_replace('/\{(\w+)\}/e',"\$file_data['\\1']",$body_data);
			ob_end_clean();

			# Buffer to template
			ob_start();
			$set_index_path = 'template/'.$new_template.'/'.$new_index.'.php';

			if (!file_exists($set_index_path)) {
				show_error('OMAPS-CI MESSAGE : Theme '. $new_template .' Not Found');
			} else {
				require $set_index_path;
				$temp_field = ob_get_contents();

				# Comperss Temp HTML if TRUE
				if ($this->compress_html == TRUE) {
					// Compress HTML
					$search = array(
			        '/\>[^\S ]+/s', //strip whitespaces after tags, except space
			        '/[^\S ]+\</s', //strip whitespaces before tags, except space
			        '/(\s)+/s'  //shorten multiple whitespace sequences
					);
					$replace = array(
			        '>',
			        '<',
			        '\\1'
			        );
			        $temp_body_data = preg_replace($search, $replace, $temp_field);
				} else {
					$temp_body_data = ob_get_contents();
				}
				ob_end_clean();
				
				if ($return_display == TRUE) {
					return @preg_replace('/\{(\w+)\}/e',"\$file_data['\\1']",$temp_body_data);
				} else {
					exit(@preg_replace('/\{(\w+)\}/e',"\$file_data['\\1']",$temp_body_data));
				}
			}

		} else if ($new_type == 'modules') {	
			// $modules_data = str_replace('______',' ', @$_GET['data']);
			$modules_data = @$_GET['modules_data'];
			$new_modules_data = str_replace(';','&',$modules_data);
			@parse_str($new_modules_data, $output_modules_data);
			if (is_array($output_modules_data)) {
				$output_modules_data;
				@extract($output_modules_data);
			}
			
			# Extract variable
			@extract($data);
		
		
			# Buffer to templates
			ob_start();
			$set_index_path = 'application/views/modules/'.$body.'.php';

			# Set error Handling
			if (file_exists($set_index_path)) {
				require $set_index_path;
				$temp_field = ob_get_contents();

				# Comperss Temp Module HTML if TRUE
				if ($this->compress_html == TRUE) {
					// Compress HTML
					$search = array(
			        '/\>[^\S ]+/s', //strip whitespaces after tags, except space
			        '/[^\S ]+\</s', //strip whitespaces before tags, except space
			        '/(\s)+/s'  //shorten multiple whitespace sequences
					);
					$replace = array(
			        '>',
			        '<',
			        '\\1'
			        );
			        $temp_body_data = preg_replace($search, $replace, $temp_field);
				} else {
					$temp_body_data = ob_get_contents();
				}
				ob_end_clean();
				
				if ($return_display == TRUE) {
					return @preg_replace('/\{(\w+)\}/e',"\$file_data['\\1']",$temp_body_data);
				} else {
					exit(@preg_replace('/\{(\w+)\}/e',"\$file_data['\\1']",$temp_body_data));
				}
			} else {
				show_error('OMAPS-CI MESSAGE : Module File '.$body .'.php not found');
			}
		} else {
			show_error('OMAPS-CI MESSAGE : Type definition error, Modules or Pages Type Undefined');
		}
	}
}
/* End of file omap.php */
/* Location: ./system/libraries/omap.php */