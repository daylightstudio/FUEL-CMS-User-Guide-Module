<?php 
/**
 * FUEL CMS
 * http://www.getfuelcms.com
 *
 * An open source Content Management System based on the 
 * Codeigniter framework (http://codeigniter.com)
 *
 * @package		FUEL CMS
 * @author		David McReynolds @ Daylight Studio
 * @copyright	Copyright (c) 2013, Run for Daylight LLC.
 * @license		http://docs.getfuelcms.com/general/license
 * @link		http://www.getfuelcms.com
 */

// ------------------------------------------------------------------------

/**
 * User Guide Helper
 *
 * Contains several convenience functions for creating user documentation.
 *
 * @package		User Guide
 * @subpackage	Helpers
 * @category	Helpers
 * @author		David McReynolds @ Daylight Studio
 * @link		http://docs.getfuelcms.com/modules/user_guide/user_guide_helper
 */


// --------------------------------------------------------------------

/**
 * Convenience function to easily create user guide urls
 * 
 * <code>
 * echo user_guide_url('libraries/assets');
 * </code>
 *
 * @access	public
 * @param	string	URI location
 * @return	string
 */
function user_guide_url($uri = '')
{
	$CI =& get_instance();
	$url_base = $CI->fuel->user_guide->config('root_url');
	return site_url($url_base.$uri);
}


// --------------------------------------------------------------------

/**
 * Generates the class documentation based on the class passed to it.  Shortcut to the Fuel_user_guide::generate_docs() method.
 * 
 * <code>
 * $vars = array('intro');
 * echo generate_class_docs('Fuel_cache', $vars);
 * </code>
 *
 * @access	public
 * @param	string	Name of class
 * @param	array 	Variables to be passed to the layout
 * @param	string	Module folder name
 * @param	string	Subfolder in module. Deafult is the libraries
 * @return	string
 */
function generate_docs($class, $folder = 'libraries', $module = NULL, $vars = array())
{
	$CI =& get_instance();
	return $CI->fuel->user_guide->generate_docs($class, $folder, $module, $vars);
}

// --------------------------------------------------------------------

/**
 * Returns a table of contents for your documentation. Shortcut to the Fuel_user_guide::generate_toc() method.
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
	$CI =& get_instance();
	return $CI->fuel->user_guide->generate_toc($folder, $module, $exclude, $return_array);
}

// --------------------------------------------------------------------

/**
 * Returns a list of configuration parameter for the advanced module. Shortcut to the Fuel_user_guide::generate_config_info() method.
 * 
 * @access	public
 * @param	stirng	The name of the module to generate the table of contents. If no module is provided, it will look at the current URI path (optional)
 * @return	string
 */
function generate_config_info($module = NULL)
{
	$CI =& get_instance();
	return $CI->fuel->user_guide->generate_config_info($module);
}

// --------------------------------------------------------------------

/**
 * Returns a single display option.  Shortcut to the Fuel_user_guide::block() method.
 * 
 * @access	public
 * @param	string	The name of the a block to display
 * @param	array	An array of variables to pass to the block (optional)
 * @param	boolean	A TRUE/FALSE value which determines whether to return the block as a string (TRUE) or send it to the output (FALSE)
 * @return	array
 */
function user_guide_block($block, $vars = array(), $return = TRUE)
{
	$CI =& get_instance();
	return $CI->fuel->user_guide->block($block, $vars, $return);
}

	
// --------------------------------------------------------------------

/**
 * Sets an example for a specific method/function
 * 
 * @access	public
 * @param	stirng	The name of the method/function
 * @param	string	The example to associate with the method/function
 * @return	void
 */
function set_user_guide_example($func, $example)
{
	$CI =& get_instance();
	return $CI->fuel->user_guide->set_example($func, $example);
	
}
	

/* End of file user_guide_helper.php */
/* Location: ./modules/user_guide/libraries/user_guide_helper.php */