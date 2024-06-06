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

class Cloudflare extends Base
{

    /**
     * Blacklist
     *
     * Blacklist a specific IP
     * @param   String          $ip          The IP which should get blacklisted
     * @return  boolean
     */
    public function blacklist($ip)
    {
        $data = $this->ip($ip, 'ban');
        return $data;
    }

    /**
     * Remove
     *
     * Removes the blacklist for a specific IP
     * @param   String          $ip          The IP which should get removed from the blacklist
     * @return  boolean
     */
    public function remove($ip)
    {
        $data = $this->ip($ip, 'nul');
        return $data;
    }

    /**
     * IP
     *
     * Performs the specific action for a IP
     * @param   String          $ip          The IP
     * @param   String          $action      The action we should perform
     * @return  boolean
     */
    private function ip($ip, $action)
    {
        # Set the data which we send to cloudflare
        $api_key = $this->config['application']['cloudflare_api_key'];
        $email = $this->config['application']['cloudflare_email'];

        $data = array('a' => $action, 'tkn' => $api_key, 'email' => $email, 'key' => $ip);


        # Create a new curl instance
        $curl = new Curl();

        # Post the data to cloudflare
        $curl->post('https://www.cloudflare.com/api_json.html', $data);

        # Get the result from cloudflare
        $response = $curl->result;

        # Validate the response from cloudflare
        $result = $this->validate_response($response);

        return $result;
    }

    /**
     * Validate Response
     *
     * Validate the CloudFlare response (check it for errors)
     * @param   String          $data          The data which we got from CloudFlare
     * @return  boolean
     */
    private function validate_response($data)
    {
        $json = json_decode($data, TRUE);

        if(!is_array($json['result']) && $json['result'] == 'error') {
            return FALSE;
        } else {
            return TRUE;
        }
    }
}