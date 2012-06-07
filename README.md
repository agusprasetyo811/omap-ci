omap-ci
=======

Template Library in Codeigniter like Omap Templating

## Setup
* Place all this file into Codeigniter Source. (Replaces)

## Structure
* <b>appliction/</b> <br>`config/config.php`<br>`controllers/dasbor.php`<br>`libraries/template.php`<br>`views/omap-ci/pages/anyfile_page.php`<br>`views/omap-ci/modules/anyfile_module.php`<br>`views/omap-ci/style/style.css`<br>`views/index.php`)
* <b>system/</b><br>`core/config.php`<br>

## Usage
* Open `application/config/config.php` and see `$config['theme'] = 'omap-ci';` this is name of theme, Take a look `application/views/` This can be changed in accordance with the `views/{name_of_theme}`
* Open `application/controllers/dasbor.php` this is example of usage omap-ci template library.<br>Call `$this->load->liblaly('template.php');` to activate this library.<br> OMAP-ci have some type of view that separated like `module` or `pages`<br>Call `$this->template->type('module')` to set module or  `$this->template->type('pages')` to set pages