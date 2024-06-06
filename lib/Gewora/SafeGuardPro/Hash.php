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
 * Hash class
 *
 * This class holds methods to hash passwords securely
 *
 * @package Gewora/SafeGuardPro
 * @author Gewora <support@gewora.net>
 * @copyright Copyright (c) 2014 by Gewora Project Team
 * @license http://codecanyon.net/licenses
 */

class Hash
{
    /**
     * MD5
     *
     * Hash the string using MD5
     *
     * @param  String          $str                String to hash
     * @param  String          $iterations         Number of iterations
     * @return String
     *
     */
    public static function md5($str, $iterations)
    {
        for ($x=0; $x<$iterations; $x++) {
            $str = hash('md5', $str);
        }
        return $str;
    }

    /**
     * Whirlpool
     *
     * Hash the string using Whirlpool
     *
     * @param  String          $str                String to hash
     * @param  String          $iterations         Number of iterations
     * @return String
     *
     */
    public static function whirlpool($str, $iterations)
    {
        for ($x=0; $x<$iterations; $x++) {
            $str = hash('whirlpool', $str);
        }
        return $str;
    }

    /**
     * SHA 256
     *
     * Hash the string using SHA 256
     *
     * @param  String          $str                String to hash
     * @param  String          $iterations         Number of iterations
     * @return String
     *
     */
    public static function sha256($str, $iterations)
    {
        for ($x=0; $x<$iterations; $x++) {
            $str = hash('sha256', $str);
        }
        return $str;
    }

    /**
     * SHA 512
     *
     * Hash the string using SHA 512
     *
     * @param  String          $str                String to hash
     * @param  String          $iterations         Number of iterations
     * @return String
     *
     */
    public static function sha512($str, $iterations)
    {
        for ($x=0; $x<$iterations; $x++) {
            $str = hash('sha512', $str);
        }
        return $str;
    }
}