<?php
/*======================================================================*\
|| #################################################################### ||
|| #                This file is part of SafeGuard Pro                # ||
|| #                          for WordPress                           # ||
|| # ---------------------------------------------------------------- # ||
|| #         Copyright © 2014 Gewora.net. All Rights Reserved.        # ||
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

class sql_inject
{

    public $query;

    function testArray($array, array $config)
    {
        foreach ($array as $name => $value)
        {
            if(is_array($value) === true) {
                $this->testArray($value, $config);
            } else {
                $test = $this->testHelper($value, $config);
                if($test === TRUE) {
                    $this->query = $value;
                    return TRUE;
                }
            }
        }
        return FALSE;
    }

    function testHelper($varvalue, array $config)
    {
        $status = $this->test($varvalue, false, $config);
        return $status;
    }

    function test($varvalue, $_comment_loop = false, array $config)
    {
        $total = 0;
        $varvalue_orig = $varvalue;
        $quote_pattern = '\%27|\'|\%22|\"|\%60|`';

        # Detect base64 encoding
        if(preg_match('/^[a-zA-Z0-9\/+]*={0,2}$/', $varvalue) > 0 && base64_decode($varvalue) !== false) {
            $varvalue = base64_decode($varvalue);
        }

        # Detect and remove comments
        if(preg_match('!/\*.*?\*/!s', $varvalue) > 0) {
            if($_comment_loop === false) {
                $total += $this->test($varvalue_orig, true, $config);
                $varvalue = preg_replace('!/\*.*?\*/!s', '', $varvalue);
            } else {
                $varvalue = preg_replace('!/\*.*?\*/!s', ' ', $varvalue);
            }

            $varvalue = preg_replace('/\n\s*\n/', "\n", $varvalue);
        }

        $varvalue = preg_replace('/((\-\-|\#)([^\\n]*))\\n/si', ' ', $varvalue);

        # Detect and replace hex encoding
        # Detect and replace decimal encodings
        if(preg_match_all('/&#x([0-9]{2});/', $varvalue, $matches) > 0 || preg_match_all('/&#([0-9]{2})/', $varvalue, $matches) > 0) {
            # replace numeric entities
            $varvalue = preg_replace('/&#x([0-9a-f]{2});?/ei', 'chr(hexdec("\\1"))', $varvalue);
            $varvalue = preg_replace('/&#([0-9]{2});?/e', 'chr("\\1")', $varvalue);
            # replace literal entities
            $trans_tbl = get_html_translation_table(HTML_ENTITIES);
            $trans_tbl = array_flip($trans_tbl);
            $varvalue = strtr($varvalue, $trans_tbl);
        }

        $and_pattern = '(\%41|a|\%61)(\%4e|n|%6e)(\%44|d|\%64)';
        $or_pattern = '(\%6F|o|\%4F)(\%72|r|\%52)';
        $equal_pattern = '(\%3D|=)';
        $regexes = array(
            '/(\-\-|\#|\/\*)\s*$/si',
            '/('.$quote_pattern.')?\s*'.$or_pattern.'\s*(\d+)\s*'.$equal_pattern.'\s*\\4\s*/si',
            '/('.$quote_pattern.')?\s*'.$or_pattern.'\s*('.$quote_pattern.')(\d+)\\4\s*'.$equal_pattern.'\s*\\5\s*/si',
            '/('.$quote_pattern.')?\s*'.$or_pattern.'\s*(\d+)\s*'.$equal_pattern.'\s*('.$quote_pattern.')\\4\\6?/si',
            '/('.$quote_pattern.')?\s*'.$or_pattern.'\s*('.$quote_pattern.')?(\d+)\\4?/si',
            '/('.$quote_pattern.')?\s*'.$or_pattern.'\s*('.$quote_pattern.')([^\\4]*)\\4\\5\s*'.$equal_pattern.'\s*('.$quote_pattern.')/si',
            '/((('.$quote_pattern.')\s*)|\s+)'.$or_pattern.'\s+([a-z_]+)/si',
            '/('.$quote_pattern.')?\s*'.$or_pattern.'\s+([a-z_]+)\s*'.$equal_pattern.'\s*(d+)/si',
            '/('.$quote_pattern.')?\s*'.$or_pattern.'\s+([a-z_]+)\s*'.$equal_pattern.'\s*('.$quote_pattern.')/si',
            '/('.$quote_pattern.')?\s*'.$or_pattern.'\s*('.$quote_pattern.')([^\\4]+)\\4\s*'.$equal_pattern.'\s*([a-z_]+)/si',
            '/('.$quote_pattern.')?\s*'.$or_pattern.'\s*('.$quote_pattern.')([^\\4]+)\\4\s*'.$equal_pattern.'\s*('.$quote_pattern.')/si',
            '/('.$quote_pattern.')?\s*\)\s*'.$or_pattern.'\s*\(\s*('.$quote_pattern.')([^\\4]+)\\4\s*'.$equal_pattern.'\s*('.$quote_pattern.')/si',
            '/from(\s*)information_schema.tables/ix',
        );

        # Additional patterns if higher security has been enabled
        if($config['application']['security_level'] > 1) {
            $regexes[] = '/('.$quote_pattern.'|\d)?(;|%20|\s)*(union|select|insert|update|delete|drop|alter|create|show|truncate|load_file|exec|concat|benchmark)((\s+)|\s*\()/ix';
        }

        foreach ($regexes as $regex) {
            $total += preg_match($regex, $varvalue);
        }

        if($total > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
