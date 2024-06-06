<?php namespace Gewora\SafeGuardPro;
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

/**
 * Load
 *
 * Autoloader. Loads the needed classes
 * @param   String          $classname          The class we should load
 * @return  boolean
 */
function load($classname)
{
    # Make sure that the class is not loaded already
    if(class_exists($classname)) {
        return true;
    }

    $path = str_replace(
            array('_', '\\'),
            '/',
            $classname
        ) . '.php';

    $fullpath = BASE_PATH . '/lib/' . $path;

    if(file_exists($fullpath)) {
        include_once $fullpath;
        return true;
    }

    return false;
}

spl_autoload_register(__NAMESPACE__ . '\load');

?>