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

class WhatIsMyIPAdress
{
    public function __construct($curl)
    {
        $this->curl = $curl;
        $this->detect_proxy_url = 'http://whatismyipaddress.com/ip/';
    }


    /**
     * Detect proxy
     *
     * Detects a proxy/VPN
     *
     * @param  String         $ip                IP we want to check
     * @return boolean
     *
     */
    public function detect_proxy($ip)
    {
        $url = $this->detect_proxy_url . $ip;

        $this->curl->get($url);
        $result = $this->curl->result;

        if(preg_match_all('/([nN]etwork [sS]haring [dD]evice [oO]r [pP]roxy [sS]erver|[sS]uspected [pP]roxy [sS]erver|[cC]onfirmed [pP]roxy [sS]erver|[oO]pen [pP]roxy [sS]erver|[tT]or [eE]xit [nN]ode)/', $result, $matches)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}

?>