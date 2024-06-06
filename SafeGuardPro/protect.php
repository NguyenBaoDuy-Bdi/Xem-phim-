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

require_once 'includes/global.inc.php';
require_once 'includes/classes/curl.class.php';
require_once 'includes/classes/WhatIsMyIPAdress.class.php';
require_once 'includes/classes/sql_inject.class.php';


use Gewora\SafeGuardPro\Protect;

# Start the protection features if the current
# connecting ip is not on the exclusion list
if(array_search($_SERVER['REMOTE_ADDR'], $excludedFromProtection) === FALSE) {
    # Create new protect instance
    $protect_class = new Protect($config, $db);

    # Detect a banned ip
    $detect_banned_ip = $protect_class->detect_banned_ip();

    # Detect a banned country
    $detect_banned_ip = $protect_class->detect_banned_country();

    # Detect a banned ISP
    $detect_banned_ip = $protect_class->detect_banned_isp();

    # Detect a proxy
    $protect_class->detect_proxy(1);

    # Detect mass requests
    $protect_class->detect_mass_requests();

    # Detect spammer
    $protect_class->detect_spammer();

    # Detect XSS attacks
    # Check POST request
    foreach($_POST as $string) {
        $protect_class->detect_xss($string);
    }

    # Check GET request
    foreach($_GET as $string) {
        $protect_class->detect_xss($string);
    }

    # Detect SQL Injections
    $protect_class->detect_sql_injection($_GET);
    $protect_class->detect_sql_injection($_POST);
    $protect_class->detect_sql_injection($_COOKIE);
}
?>