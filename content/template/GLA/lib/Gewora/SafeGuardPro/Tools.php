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
 * Tools class
 *
 * This class holds methods for the Tools page
 *
 * @package Gewora/SafeGuardPro
 * @author Gewora <support@gewora.net>
 * @copyright Copyright (c) 2014 by Gewora Project Team
 * @license http://codecanyon.net/licenses
 */

class Tools
{
    /**
     * Generate Password
     *
     * Generate a complex password with the desired length
     *
     * @param   Integer          $length          Desired password length - OPTIONAL (default: 8)
     * @return  String
     */
    public function generate_password($length = 8) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
        $password = substr( str_shuffle( $chars ), 0, $length );
        return $password;
    }
}