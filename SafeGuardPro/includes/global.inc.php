<?php
/*======================================================================*\
|| #################################################################### ||
|| #                This file is part of SafeGuard Pro                # ||
|| # ---------------------------------------------------------------- # ||
|| #     Copyright © 2014 - 2015 Gewora.net. All Rights Reserved.     # ||
|| # This file may not be redistributed in whole or significant part  # ||
|| #                                                                  # ||
|| #            For more license information contact Gewora           # ||
|| #            and/or read the envato license details at:            # ||
|| #                  http://codecanyon.net/licenses                  # ||
|| # You are NOT allowed to modify/remove this copyright information  # ||
|| #                                                                  # ||
|| #              Any infringement of this copyright will             # ||
|| #               result in legal action by the holder               # ||
|| #                                                                  # ||
|| # ----------     SafeGuard Pro IS NOT FREE SOFTWARE     ---------- # ||
|| # -------------------- http://www.gewora.net --------------------- # ||
|| #################################################################### ||
\*======================================================================*/

require_once 'config.inc.php';
require_once 'classes/flashMessages.class.php';

# Turn off error reporting
error_reporting(0);

/*
|--------------------------------------------------------------------------
| Set up some paths
|--------------------------------------------------------------------------
|
| Sometimes we need full paths so we go ahed and set them up,
| and write them into our session for easy use everywhere
|
*/

# Set up the paths
$application_path = $_SERVER['DOCUMENT_ROOT'] . '/' . $config['application']['working_directory'];
$application_url = 'http://' . $_SERVER['SERVER_NAME'] . '/' . $config['application']['working_directory'];
$filename = basename($_SERVER["SCRIPT_FILENAME"], '.php');

# Make sure that the application path is correct
if(!is_dir($application_path)) die('Working directory not correct. Check the "includes/config.inc.php" file.');

define("BASE_PATH", $application_path);

/*
|--------------------------------------------------------------------------
| Start the session
|--------------------------------------------------------------------------
|
| Let's start the session where we store important informations
|
*/

# Start the session
if(!isset($_SESSION) || !count($_SESSION)) {
    # Make sure that we use cookies to transport the SID
    # instead of showing her in the URL
    @ini_set('session.use_only_cookies', '1');
    @ini_set('session.use_trans_sid', '0');
    @session_start();
}


# Write some data into the session
$_SESSION['gewora_safe_guard_pro']['application']['application_path'] = $application_path;


/*
|--------------------------------------------------------------------------
| Flash messages
|--------------------------------------------------------------------------
|
| We will create a object for the flash messages so we do not
| need to do that anywhere else.
|
*/
$msg = new flashMessages($config['application']['template_name'], $application_url);



/*
|--------------------------------------------------------------------------
| Install dir check
|--------------------------------------------------------------------------
|
| If the install dir exists, redirect to it
|
*/
if (is_dir("install")) {
    header('Location: install');
    exit();
}

if (is_dir("../install")) {
    header('Location: ../install');
    exit();
}


/*
|--------------------------------------------------------------------------
| Start the autoloader
|--------------------------------------------------------------------------
|
| Write the important stuff into the session
|
*/
# The autoloader for the Gewora Management libary
require_once $application_path . '/lib/Gewora/SafeGuardPro/Autoloader.php';


/*
|--------------------------------------------------------------------------
| Connect to the database
|--------------------------------------------------------------------------
|
| Let's try to connect to the database
|
*/
# Make sure that the database settings have filled in
if(empty($config['database']['host']) || empty($config['database']['user']) || empty($config['database']['password']) || empty($config['database']['database'])) {
    die('Database data not filled in. Please read the documentation.');
}

# Create database object
$db = @new mysqli($config['database']['host'],$config['database']['user'],$config['database']['password'],$config['database']['database']);

# Make sure that we are connected now
if (!mysqli_connect_errno() == 0) {
    echo 'Unable to connect to the Database!';

    # For security reasons we will not output the error(s) to our users
    # If you want to see the error uncomment the line below as long as you need it
    echo '<br/> The following error occured: '.mysqli_connect_errno(). ' : ' .mysqli_connect_error();
    die();
}

/*
|--------------------------------------------------------------------------
| Fetch the config
|--------------------------------------------------------------------------
|
| Time to fetch the config
|
*/
$sql = "SELECT * FROM `" . $config['database']['prefix'] . "_config`";
$result = $db->query($sql);
while ($row = $result->fetch_assoc()) {
    $config['application'][$row['key']] =  $row['value'];
}

/*
|--------------------------------------------------------------------------
| Twig template system
|--------------------------------------------------------------------------
|
| Time to register the twig autoloader and set up all parameters
|
*/

# Load the Twig Autoloader
require_once $application_path . '/lib/Twig/Autoloader.php';
Twig_Autoloader::register();

# Set the template paths
$templateDir1 = $application_path . '/templates/' . $config['application']['template_name'];
$templateDir2 = $application_path . '/templates/' . $config['application']['template_name'] . '/includes/components';
$templateDir3 = $application_path . '/templates/' . $config['application']['template_name'] . '/includes/core';
$templateDir4 = $application_path . '/templates/' . $config['application']['template_name'] . '/admincp';
$templateDir5 = $application_path . '/templates/' . $config['application']['template_name'] . '/admincp/includes/core';
$templateDir6 = $application_path . '/templates/' . $config['application']['template_name'] . '/admincp/includes/components';

$loader = new Twig_Loader_Filesystem(array(
    $templateDir1,
    $templateDir2,
    $templateDir3,
    $templateDir4,
    $templateDir5,
    $templateDir6
));

# Start Twig
$twig = new Twig_Environment($loader, array(
    'debug' => FALSE,
    'cache' => 'compilation_cache',
    'autoescape' => TRUE,
    'auto_reload' => TRUE,
));

# Create some custom filters
# Serialize function
$filter_serialize = new Twig_SimpleFilter('serialize', function ($string) {
    return serialize($string);
});

# Unserialize function
$filter_unserialize = new Twig_SimpleFilter('unserialize', function ($string) {
    return unserialize($string);
});

# Add the filters
$twig->addFilter($filter_serialize);
$twig->addFilter($filter_unserialize);

# Add our global variables
$twig->addGlobal("session", $_SESSION);
$twig->addGlobal("msg", $msg);
$twig->addGlobal("application_config", $config['application']);
$twig->addGlobal("application_path", $application_path);
$twig->addGlobal("application_url", $application_url);
$twig->addGlobal("template_name", $config['application']['template_name']);

?>