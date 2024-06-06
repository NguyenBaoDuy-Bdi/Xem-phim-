<?php namespace Gewora\SafeGuardPro\Install;

class Install
{
    /**
     * Check parameters
     *
     * Checks the required PHP parameters
     *
     * @return array
     *
     */
    public function check_parameters()
    {
        # PHP Version
        if (phpversion() >= 5.3) {
            $return['phpVersion'] = TRUE;
        } else {
            $return['phpVersion'] = FALSE;
        }

        $return['safeMode'] = ini_get('safe_mode');
        $return['registerGlobals'] = ini_get('register_globals');

        # MCrypt
        if (extension_loaded('mcrypt')) {
            $return['mcrypt'] = TRUE;
        } else {
            $return['mcrypt'] = FALSE;
        }

        # MySQLi
        if (extension_loaded('mysqli')) {
            $return['mysqli'] = TRUE;
        } else {
            $return['mysqli'] = FALSE;
        }

        # Curl
        if (extension_loaded('curl')) {
            $return['curl'] = TRUE;
        } else {
            $return['curl'] = FALSE;
        }

        # Curl Version
        $curl_version = curl_version();
        $curl_version = $curl_version['version'];
        if ($curl_version >= 7.30) {
            $return['curlVersion'] = TRUE;
        } else {
            $return['curlVersion'] = FALSE;
        }

        if ($return['phpVersion'] === FALSE || $return['curlVersion'] === FALSE || $return['mcrypt'] === FALSE || $return['mysqli'] === FALSE || $return['curl'] === FALSE) {
            $return['status'] = "Error";
        } elseif ($return['safeMode'] || $return['registerGlobals']) {
            $return['status'] = "Warning";
        }
        return $return;
    }

    /**
     * Check purchase code
     *
     * Checks your purchase code to make sure you bought this product
     * You should know how much work it is to write such an application,
     * so please be fair and buy it if you did not already.
     *
     * @param $purchaseCode - The purchase code
     * @param $curl - A Curl instance
     *
     * @return bool
     *
     */
    public function check_purchase_code($purchaseCode, $curl)
    {
        $apiKey = 'r89ecsf9hyxhxvv81c4wvk5ge2l96s27';
        $username = 'Gewora';
        $url = 'http://marketplace.envato.com/api/v3/' . $username . '/' . $apiKey . '/verify-purchase:' . $purchaseCode . '.json';
        $curl->get($url);
        $check = $curl->result;
        $check_json = json_decode($check);

        if(isset($check_json->{'verify-purchase'}->item_id) || $check === TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}