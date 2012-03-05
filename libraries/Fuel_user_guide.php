<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * FUEL CMS
 * http://www.getfuelcms.com
 *
 * An open source Content Management System based on the 
 * Codeigniter framework (http://codeigniter.com)
 *
 * @package		FUEL CMS
 * @author		David McReynolds @ Daylight Studio
 * @copyright	Copyright (c) 2011, Run for Daylight LLC.
 * @license		http://www.getfuelcms.com/user_guide/general/license
 * @link		http://www.getfuelcms.com
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * User guide library
 *
 * @package		FUEL CMS
 * @subpackage	Libraries
 * @category	Libraries
 * @author		David McReynolds @ Daylight Studio
 * @link		http://www.getfuelcms.com/user_guide/modules/page_analysis
 */

// --------------------------------------------------------------------

class Fuel_user_guide extends Fuel_advanced_module {
	
	public $use_search = TRUE;
	public $use_breadcrumb = TRUE;
	public $use_nav = TRUE;
	public $use_footer = TRUE;
	public $display_options = array(
									'use_search' => TRUE,
									'use_breadcrumb' => TRUE,
									'use_nav' => TRUE,
									'user_footer' => TRUE,
									);
	public $valid_folders = array('libraries', 'helpers');
	protected $current_page;

	/**
	 * Constructor - Sets user guide preferences
	 *
	 * The constructor can be passed an array of config values
	 */
	function __construct($params = array())
	{
		parent::__construct($params);
		$this->CI->load->helper('text');
		$this->CI->load->helper('inflector');
		$this->CI->load->helper('utility');

		$this->fuel->load_library('fuel_pagevars');
		$this->load_helper('user_guide');
		
		if (!empty($params))
		{
			$this->initialize($params);
		}
		$this->init_page();
		
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Initialize the page analysis object
	 *
	 * Accepts an associative array as input, containing backup preferences.
	 * Also will set the values in the config as properties of this object
	 *
	 * @access	public
	 * @param	array	config preferences
	 * @return	void
	 */	
	function initialize($params)
	{
		parent::initialize($params);
		$this->set_params($this->_config);
		
	}
	
	// --------------------------------------------------------------------

	/**
	 * Initializes the user guide page
	 * 
	 * @access	public
	 * @return	void
	 */
	function init_page()
	{
		$uri = uri_path(FALSE);
		$root_url = $this->config('root_url');
		if (substr($root_url, -1) == '/') $root_url = trim(substr($root_url, 0, (strlen($root_url) -1)), '/');
		$new_uri = preg_replace('#^'.$root_url.'#', '', trim($uri, '/'));
		
		if (empty($new_uri)) $new_uri = 'home';
		$this->set_current_page($new_uri);
	}
	
	// --------------------------------------------------------------------

	/**
	 * Returns the current user guide page
	 * 
	 * @access	public
	 * @return	string
	 */
	function current_page()
	{
		return $this->current_page;
	}

	// --------------------------------------------------------------------

	/**
	 * Sets the current user guide page
	 * 
	 * @access	public
	 * @param	string The name of the display option
	 * @return	void
	 */
	function set_current_page($page)
	{
		$this->current_page = $page;
	}
	
	// --------------------------------------------------------------------

	/**
	 * Returns user guide page segment
	 * 
	 * @access	public
	 * @param	int The segment to return
	 * @return	mixed
	 */
	function page_segment($segment)
	{
		$segment = $segment - 1;

		// clean off beginning and ending slashes
		$page = preg_replace('#^(\/)?(.+)(\/)?$#', '$2', $this->current_page);
		$segs = explode('/', $page);
		if (!empty($segs[$segment]))
		{
			return $segs[$segment];
		}
		return FALSE;
	}
	
	// --------------------------------------------------------------------

	/**
	 * Gets the current page title based on the H1 value in the page
	 * 
	 * @access	public
	 * @param	string The html of a user guide page
	 * @return	string
	 */
	function page_title($page)
	{
		preg_match('#<h1>(.+)<\/h1>#U', $page, $matches);
		if (!empty($matches[1]))
		{
			return strip_tags($matches[1]);
		}
		return '';
		
	}
	
	// --------------------------------------------------------------------

	/**
	 * Returns user guide page segment
	 * 
	 * @access	public
	 * @param	string The html of a user guide page
	 * @return	mixed
	 */
	function breadcrumb($page = NULL)
	{
		if (empty($page))
		{
			$page = $this->current_page;
		}
		$vars = $this->get_vars($this->current_page);
		$page_arr = explode('/', $page);
		if (count($page_arr) == 1) return '';
		array_pop($page_arr);
		$prev_page = implode('/', $page_arr);

		if (is_file(USER_GUIDE_PATH.'/views'.$prev_page.EXT))
		{
			$prev_view = $this->CI->load->module_view(USER_GUIDE_FOLDER, $prev_page, $vars, TRUE);
			$vars['breadcrumb'][$this->page_title($prev_view)] = $prev_page;
		}
		return $vars['breadcrumb'];
	}
	
	// --------------------------------------------------------------------

	/**
	 * Returns an array of page variables which determines whether to display things like the search area, breadcrumb, top navigation and the footer
	 * 
	 * @access	public
	 * @param	string The html of a user guide page
	 * @return	array
	 */
	function get_vars($page = NULL)
	{
		if (empty($page))
		{
			$page = $this->current_page;
		}
		$vars = $this->CI->fuel_pagevars->view($page, 'user_guide');
		$vars['modules'] = array();
		$vars['site_docs'] = '';
		$vars['use_search'] = $this->display_option('use_search');
		$vars['use_breadcrumb'] = $this->display_option('use_breadcrumb');
		$vars['use_nav'] = $this->display_option('use_nav');
		$vars['use_footer'] = $this->display_option('use_footer');
		$vars['sections'] = array();
		$vars['breadcrumb'] = array();
		return $vars;
	}
	
	// --------------------------------------------------------------------

	/**
	 * Returns a single display option
	 * 
	 * @access	public
	 * @param	string The name of the display option
	 * @param	boolean A TRUE/FALSE value which determines whether to display a certain area
	 * @return	void
	 */
	function set_display_option($opt, $val)
	{
		$this->display_options[$opt] = $val;
	}
	
	// --------------------------------------------------------------------

	/**
	 * Returns a single display option
	 * 
	 * @access	public
	 * @param	string The display option key (optional)
	 * @return	array
	 */
	function display_option($opt = NULL)
	{
		$opts = $this->display_options();
		if (isset($opts[$opt]))
		{
			return $opts[$opt];
		}
		return FALSE;
	}
	
	// --------------------------------------------------------------------

	/**
	 * Returns the all the various display options as an array:
	 * 
	<ul>
		<li><strong>use_search</strong></li>
		<li><strong>use_breadcrumb</strong></li>
		<li><strong>use_nav</strong></li>
		<li><strong>use_footer</strong></li>
	</ul>
	 * 
	 * @access	public
	 * @return	array
	 */
	function display_options()
	{
		return $this->display_options;
	}
	
	// --------------------------------------------------------------------

	/**
	 * Generates the class documentation based on the class passed to it
	 * 
	 * <code>
	 * $vars = array('intro');
	 * echo generate_class_docs('Fuel_cache', $vars);
	 * </code>
	 *
	 * @access	public
	 * @param	string	Name of class
	 * @param	string	Module folder name (optional)
	 * @param	string	Subfolder in module. Deafult is the libraries (optional)
	 * @param	array 	Variables to be passed to the layout (optional)
	 * @return	string
	 */
	function generate_docs($file, $folder = 'libraries', $module = NULL, $vars = array())
	{
		// must be a valid folder
		if (!in_array($folder, $this->valid_folders))
		{
			return '';
		}
		
		if (empty($module))
		{
			$module = $this->page_segment(2);
		}
		
		if ($folder == 'libraries')
		{
			$file = ucfirst($file);
		}
		$class_path = MODULES_PATH.$module.'/'.$folder.'/'.$file.'.php';
		
		$this->CI->load->library('inspection');
		$vars['module'] = $module;
		$vars['folder'] = $folder;
		
		$vars['user_guide_links_func'] = create_function('$source', '
			$source = str_replace(array("[user_guide_url]", "<user_guide_url>"), "'.user_guide_url().'/", $source);
			$source = preg_replace("#<\?=user_guide_url\([\'\"](.+)[\'\"]\)\?>#U", "'.user_guide_url().'/$1", $source);
			return $source;
		');
		$this->CI->inspection->initialize(array('file' => $class_path));
		
		switch($folder)
		{
			case 'helpers':
				$layout = 'helper_layout';
				$vars['helper'] = humanize($file);
				$vars['helpers'] = $this->CI->inspection->functions();
				$vars['comments'] = $this->CI->inspection->comments();
				break;
			default:
				$layout = 'class_layout';
				$vars['class'] = $this->CI->inspection->classes($file);
		}
		return $this->load_view('_layouts/'.$layout, $vars, TRUE);
	}
	
	// --------------------------------------------------------------------

	/**
	 * Returns a table of contents for your documentation
	 * 
	 * @access	public
	 * @param	stirng	The name of the module to generate the table of contents. If no module is provided, it will look at the current URI path (optional)
	 * @param	string	Module folder name (optional)
	 * @param	array	An array of files to exclude from the list (optional)
	 * @param	boolean	Whether to return an array of values or a view (optional)
	 * @return	string
	 */
	function generate_toc($folder = NULL, $module = NULL, $exclude = array(), $return_array = FALSE)
	{
		if (empty($module))
		{
			$module = $this->page_segment(2);
		}

		// set variable defaults
		$vars['libraries'] = NULL;
		$vars['helpers'] = NULL;
		if (isset($vars[$folder]))
		{
			$vars[$folder] = NULL;
		}
		
		if (isset($folder))
		{
			$files = $this->folder_files($folder, $module, $exclude);
			$folder = end(explode('/', $folder));
			$vars[$folder] = $files;
		}
		else
		{

			$libraries = $this->folder_files('libraries', $module,  $exclude);
			$vars['libraries'] = $libraries;

			$helpers = $this->folder_files('helpers',$module, $exclude);
			$vars['helpers'] = $helpers;
		}

		if ($return_array === TRUE)
		{
			return $vars;
		}
		
		return $this->block('toc', $vars);
		
	}
	
	// --------------------------------------------------------------------

	/**
	 * Returns a a table of contents for your documentation
	 * 
	 * @access	public
	 * @param	string	Module folder name (optional)
	 * @param	boolean	Whether to return an array of values or a view (optional)
	 * @return	mixed
	 */
	function generate_config_info($module = NULL, $return_array = FALSE)
	{
		if (empty($module))
		{
			$module = $this->page_segment(2);
		}

		$config_path = MODULES_PATH.$module.'/config/'.$module.EXT;
		if (file_exists($config_path))
		{
			$file = file_get_contents($config_path);
		}
		
		$config = array();
		if (!empty($file))
		{
			// preg_match_all("#//(.+)\$config\[['|\"]".$module."\\2\]\[(['|\"])(.+)\\3\]\s*=\s*(.+)#ms", $file, $matches);
			preg_match_all("#^//(.+);#Ums", $file, $matches);
			
			if (isset($matches[1]))
			{
				foreach($matches[1] as $match)
				{
					// remove any extra comment slashes
					$match = str_replace('//', '', $match);
					$match = trim_multiline($match);
					preg_match('#\$config\[([\'|"])'.$module.'\\1\]\[([\'|"])(.+)\\2\]\s*=\s*(.+)#ms', $match, $key_arr);
					if (isset($key_arr[3]) AND isset($key_arr[4]))
					{
						$key = $key_arr[3];
						$comment = current(explode('$config', $match));
						$default = '<pre>'.$key_arr[4].'</pre>';
						$c = new stdClass();
						$c->param = $key;
						$c->comment  = $comment;
						$c->default_value = $default;
						$config[$key] = $c;
					}
				}
			}
		}
		$vars['config'] = $config;
		$vars['module'] = $module;
		return $this->block('config', $vars);
		
	}
	
	// --------------------------------------------------------------------

	/**
	 * Returns an array with the keys as links and the values as the name of the file
	 * 
	 * @access	public
	 * @param	stirng	The name of the folder relative to the MODULES_PATH
	 * @param	string	Module folder name (optional)
	 * @param	array	An array of files to exclude from the list (optional)
	 * @return	array
	 */
	function folder_files($folder, $module = NULL, $exclude = array())
	{
		$this->CI->load->helper('file');
		$this->CI->load->helper('directory');
		
		$folder_arr = explode('/', $folder);
		
		if (isset($folder_arr[1]))
		{
			$module = $folder_arr[0];
			$folder = $folder_arr[1];
		}
		
		if (empty($module))
		{
			$module = $this->page_segment(2);
		}

		$module_path = MODULES_PATH.$module.'/';
	
		// force exclude to an array
		$exclude = (array) $exclude;
		
		// add PHP extension if it doesn't exist'
		foreach($exclude as $key => $val)
		{
			if (!preg_match('#.+\.php$#', $val))
			{
				$exclude[$key] = $val.EXT;
			}
		}
		$exclude[] = 'index.html';
		$files = directory_to_array($module_path.$folder, FALSE, $exclude, FALSE, TRUE);
		
		$return = array();
		if (is_array($files))
		{
			foreach($files as $file)
			{
				$url = user_guide_url('modules/'.$module.'/'.strtolower($file));
				$return[$url] = humanize($file);
			}
		}
		return $return;
	}
	
	// --------------------------------------------------------------------

	/**
	 * Returns a single display option
	 * 
	 * @access	public
	 * @param	string	The name of the a block to display
	 * @param	array	An array of variables to pass to the block (optional)
	 * @param	boolean	A TRUE/FALSE value which determines whether to return the block as a string (TRUE) or send it to the output (FALSE)
	 * @return	array
	 */
	function block($block, $vars = array(), $return = TRUE)
	{
		$output = $this->load_view('_blocks/'.$block, $vars, $return);
		
		if ($return)
		{
			return $output;
		}
	}
	
}

/* End of file Fuel_user_guide.php */
/* Location: ./modules/user_guide/libraries/Fuel_user_guide.php */