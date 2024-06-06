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

/*
|--------------------------------------------------------------------------
| Database settings
|--------------------------------------------------------------------------
|
| Insert you database connection settings below
|
*/

$config = array();
$config['database']['host'] = 'localhost';          # Database host. Mostly it is 'localhost'
$config['database']['user'] = 'khangcom_test';          # Database user name
$config['database']['password']  = 'Duykhang113';     # Database user password
$config['database']['database'] = 'khangcom_test';      # Database name
$config['database']['prefix'] = 'gewora';  # !!!!!! DO NOT EDIT THIS !!!!!!

/*
|--------------------------------------------------------------------------
| Working directory
|--------------------------------------------------------------------------
|
| Path to the application (from the root directory)
| DO NOT USE SLASHES AT THE START OR THE END
|
*/

$config['application']['working_directory'] = 'GLA';

/*
|--------------------------------------------------------------------------
| Template name
|--------------------------------------------------------------------------
|
| Name of the template we want to use
| Since there is only one template we leave it at 'default'
|
*/

$config['application']['template_name'] = 'default';/*

|--------------------------------------------------------------------------
| Security Level
|--------------------------------------------------------------------------
|
| 1 = Default
| 2 = Very strict (This checks for the following words: union,select,insert,update,delete,drop,alter,create,show,truncate,load_file,exec,concat,benchmark
      This will make the protection more secure but can lead to false positives if clients perform requests which include at least one of the above words
      The default level (1) will still protect you against many attacks which might use a word from above, so you should really only enable this if you want
      a very high security but have to deal with possible false positives
|
*/

$config['application']['security_level'] = 1;

/*
|--------------------------------------------------------------------------
| Excluded IP Addresses
|--------------------------------------------------------------------------
|
| Add the IP addresses which should not be affected by the protection
| features, below.
|
*/

$excludedFromProtection = array(
    '127.0.0.1',
    '::1',
);

?>