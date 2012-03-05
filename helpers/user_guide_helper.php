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
 * @copyright	Copyright (c) 2011, Run for Daylight LLC.
 * @license		http://www.getfuelcms.com/user_guide/general/license
 * @link		http://www.getfuelcms.com
 * @filesource
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
 * @link		http://www.getfuelcms.com/user_guide/modules/user_guide/user_guide_helper
 */


// --------------------------------------------------------------------

/**
 * Convenience function to easily create user guide urls
 * 
 * <code>
 * echo user_guide_url('libraries/assets);
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
 * @return	string
 */
function generate_toc($module = NULL)
{
	$CI =& get_instance();
	return $CI->fuel->user_guide->generate_toc($module);
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


/* End of file user_guide_helper.php */
/* Location: ./modules/user_guide/libraries/user_guide_helper.php */