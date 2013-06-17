<?php
/*
|--------------------------------------------------------------------------
| FUEL NAVIGATION: An array of navigation items for the left menu
|--------------------------------------------------------------------------
*/
$config['nav']['tools']['tools/user_guide'] = lang('module_user_guide');



/*
|--------------------------------------------------------------------------
| User Guide specific parameters
|--------------------------------------------------------------------------
*/
$config['user_guide'] = array();

// user guide requires user authentication to view
$config['user_guide']['authenticate'] = TRUE;

// determines whether to cache the user guide files or not
$config['user_guide']['use_cache'] = FALSE;

// determines whether to cache the user guide files or not
$config['user_guide']['cache_path'] = USER_GUIDE_PATH.'cache/';

// the URI path to the user guide
$config['user_guide']['root_url'] = FUEL_ROUTE.'tools/user_guide/';

// allows the user guide to try and automatically generate the documentation based on folder paths.
// the value set is an array of modules to allow it to automatically generate.
// setting it to TRUE will allow all modules
$config['user_guide']['allow_auto_generation'] = TRUE;

// classes that may need to be loaded before generating documentation for certain classes (e.g. model classes)
$config['user_guide']['preload_classes'] = array(BASEPATH.'core/Model.php', FUEL_PATH.'core/MY_Model.php');
