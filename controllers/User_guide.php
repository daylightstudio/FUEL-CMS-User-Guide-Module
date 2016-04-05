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
 * @copyright	Copyright (c) 2012, Run for Daylight LLC.
 * @license		http://www.getfuelcms.com/user_guide/general/license
 * @link		http://www.getfuelcms.com
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * User guide 
 *
 * @package		FUEL CMS
 * @subpackage	Libraries
 * @category	Libraries
 * @author		David McReynolds @ Daylight Studio
 * @link		http://www.getfuelcms.com/user_guide/modules/user_guide
 */

// --------------------------------------------------------------------

require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');

class User_guide extends Fuel_base_controller {
	
	public $current_page;
	
	function __construct()
	{
		parent::__construct(FALSE);
		if ($this->fuel->user_guide->config('authenticate'))
		{
			$this->_validate_user('tools/user_guide');
		}
		$this->fuel->cache->set_cache_path($this->fuel->user_guide->config('cache_path'));
	}
	
	function _remap()
	{

		$this->current_page = $this->fuel->user_guide->current_page();
		
		$cache_id = $this->current_page;
		if ($this->fuel->user_guide->config('use_cache') AND $this->fuel->cache->is_cached($cache_id))
		{
			$output = $this->fuel->cache->get($cache_id);
		}
		else
		{
			$this->fuel->pagevars->vars_path = USER_GUIDE_PATH.'views/_variables/';
			$vars = array();

			// get modules
			$modules = array('', 'fuel');
			$modules = array_merge($modules, $this->fuel->config('modules_allowed'));
			$vars = $this->fuel->user_guide->get_vars($this->current_page);

			foreach($modules as $m)
			{
				if ((!$this->fuel->user_guide->config('authenticate') OR $this->fuel->auth->has_permission('user_guide_'.$m)) AND 
					file_exists(MODULES_PATH.$m.'/views/_docs/index'.EXT)) 
				{
					$module_view = $this->load->module_view($m, '_docs/index', array(), TRUE);
					$mod_page_title = $this->fuel->user_guide->page_title($module_view);
					$vars['modules'][$m] = (!empty($mod_page_title)) ? $mod_page_title : humanize($m).' Module';
				}
			}

			// render page
			// pull from modules folder if URI says so	
			$uri_path_index = count(explode('/', $this->fuel->user_guide->config('root_url'))) + 1;
			$module_page = uri_path(FALSE, $uri_path_index);
			$module_view_path = (!empty($module_page)) ? '_docs/'.$module_page : '_docs/index';
			$allow_auto_generation = $this->fuel->user_guide->config('allow_auto_generation');

			if (is_file(USER_GUIDE_PATH.'views/'.$this->current_page.EXT))
			{
				$vars['body'] = $this->load->module_view(USER_GUIDE_FOLDER, $this->current_page, $vars, TRUE);
				if ($this->fuel->user_guide->page_segment(2))
				{
					$vars['sections'] = $this->fuel->user_guide->breadcrumb($this->current_page);
				}
			}
			else if (is_file(FUEL_PATH.'views/_docs/'.$this->current_page.EXT))
			{
				$vars['body'] = $this->load->module_view(FUEL_FOLDER, '_docs/'.$this->current_page, $vars, TRUE);
				if ($this->fuel->user_guide->page_segment(2))
				{
					$vars['sections'] = $this->fuel->user_guide->breadcrumb($this->current_page);
				}
			}
			else if ($this->fuel->user_guide->page_segment(2))
			{

				if (in_array($this->fuel->user_guide->page_segment(1), $this->fuel->user_guide->valid_folders))
				{
					$module = FUEL_FOLDER;
					$file = $this->fuel->user_guide->page_segment(2);
					$uri_path_index = count(explode('/', $this->fuel->user_guide->config('root_url'))) - 2;
					$module_view_path = '_docs/'.uri_path(FALSE, $uri_path_index);
				}
				else
				{
					$module = $this->fuel->user_guide->page_segment(2);
					$file = $this->fuel->user_guide->page_segment(3);
					if (!empty($file) AND $file != 'index')
					{
						$module_view_path = '_docs/'.$file;	
					}
				}

				$body = '';

				if (file_exists(MODULES_PATH.$module.'/views/'.$module_view_path.EXT))
				{
					$body = $this->load->module_view($module, $module_view_path, $vars, TRUE);
				}
				else if ($allow_auto_generation === TRUE OR in_array($module, $allow_auto_generation))
				{

					if (!empty($file))
					{
						$uri_folder = $this->fuel->user_guide->page_segment(4);
						$valid_folders = $this->fuel->user_guide->valid_folders;
						$file_name = ucfirst($file);

						$folder = ($uri_folder AND in_array($uri_folder, $valid_folders)) ? $uri_folder : 'libraries';
						if (preg_match('#_helper$#', $file))
						{
							$folder = 'helpers';
							$file_name = strtolower($file);
						}
						else if (preg_match('#_model$#', $file))
						{
							$folder = 'models';
							$file_name = strtolower($file);
						}

						$file_name = preg_replace('#^my_(\w+)#', 'MY_$1', $file_name);

						$file_path = MODULES_PATH.$module.'/'.$folder.'/'.$file_name.EXT;
						if (file_exists($file_path))
						{
							$body = $this->fuel->user_guide->generate_docs($file_name, $folder, $module, array());
						}
						else
						{
							$file_path = APPPATH.'/'.$folder.'/'.$file_name.EXT;

							if (file_exists($file_path))
							{
								$body = $this->fuel->user_guide->generate_docs($file_name, $folder, $module, array());
							}

						}

						if ($this->fuel->user_guide->page_segment(2))
						{
							$vars['sections'] = $this->fuel->user_guide->breadcrumb($this->current_page);
						}
					}
				}

				if (!$this->fuel->user_guide->config('authenticate') OR ($this->fuel->auth->has_permission('user_guide_'.$module) AND isset($body)))
				{

					$vars['body'] = $body;
					if ($file)
					{
						if (isset($vars['modules'][$module]))
						{
							if ($module != FUEL_FOLDER)
							{
								$vars['sections'] = array($vars['modules'][$module] => 'modules/'.$module);
							}

						}
						else
						{
							redirect_404();
						}
					}
				}
			}
			else
			{
				redirect_404();
			}

			if (empty($vars['body']))
			{
				redirect_404();
			}

			$vars['page_title'] = $this->fuel->user_guide->page_title($vars['body']);
			$output = $this->load->module_view(USER_GUIDE_FOLDER, '_layouts/user_guide', $vars, TRUE);
			
			if ($this->fuel->user_guide->config('use_cache'))
			{
				$this->fuel->cache->save($cache_id, $output);
			}
		}
		$this->output->set_output($output);

	}
}

/* End of file user_guide.php */
/* Location: ./fuel/modules/user_guide/controllers/user_guide.php */