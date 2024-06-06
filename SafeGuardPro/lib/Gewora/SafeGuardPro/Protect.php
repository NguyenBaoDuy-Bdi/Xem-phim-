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
class Protect extends Base
{

    public function __construct($config, $db, $fetchOnly = FALSE)
    {
        parent::__construct($config, $db);
        if($fetchOnly === FALSE) {
            $curl  = new \Curl();
            $this->WhatIsMyIPAdress = new \WhatIsMyIPAdress($curl);
            $this->sql_inject_class = new \sql_inject();
            $this->local_proxys_file = 'ip_list.txt';
        }
    }

    /**
     * Detect Proxy
     *
     * Detect a proxy/VON
     *
     * Optional @param  Integer         $method             Method to use. 1 has a high detection. 2 detects only proxys.
     * Optional @param  String          $ip                 IP you want to check. Default: Connecting IP
     * @return String
     *
     */
    public function detect_proxy($method = 1, $ip = null)
    {
        # Check if the proxy protection has been enabled
        if($this->config['application']['protection_proxies'] == '1') {
            if($ip === null) $ip = $_SERVER['REMOTE_ADDR'];

            if($method == 1) {
                # Check if this a known ip and already in our local list
                if(file_exists($this->local_proxys_file) && filesize($this->local_proxys_file) > 0 ) {
                    # The local file does already exists therefore we read it
                    $local_list = file_get_contents($this->local_proxys_file);
                    $local_list = unserialize($local_list);
                    $local_list = $local_list;

                    foreach ($local_list as $entry) {
                        if ($entry['ip'] === $ip) {
                            $ip_status = $entry['status'];
                            break;
                        }
                    }
                }

                if(isset($ip_status)) {
                    # IP is already in our list
                    # Check if it is a non allowed one
                    if($ip_status != 'none') {
                        # This IP is not allowed
                        # Redirect to the defined page
                        header('location: '. $this->config['application']['redirect_proxies']);
                        exit();
                    }
                } else {
                    # This IP is currently not in our list
                    # Detect proxy using WhatIsMyIPAdress.com
                    $detect = $this->WhatIsMyIPAdress->detect_proxy($ip);

                    if($detect === TRUE) {
                        # A proxy has been detected
                        # Ban the ip if the auto banning has been enabled
                        $auto_ban = $this->check_autoban('auto_ban_ip_proxies');

                        # If the proxy logging has been enabled, log it
                        if($this->config['application']['log_proxies'] == 1) {
                            $this->write_log('proxy', array('auto_banned' => $auto_ban));
                        }

                        $this->status = $this->WhatIsMyIPAdress->status;

                        # Write the IP into our local list
                        $array = array('ip' => $ip, 'status' => $this->status);
                        $this->add_item($array);

                        # Redirect to the defined page
                        header('location: '. $this->config['application']['redirect_proxies']);
                        exit();
                    } else {
                        # No proxy has been detected
                        # Write the IP into our local list
                        $array = array('ip' => $ip, 'status' => 'none');
                        $this->add_item($array);
                    }
                }

                # Detect proxy by checking the headers
            } elseif ($method == 2) {
                $proxy_headers = array(
                    'HTTP_VIA',
                    'HTTP_X_FORWARDED_FOR',
                    'HTTP_FORWARDED_FOR',
                    'HTTP_X_FORWARDED',
                    'HTTP_FORWARDED',
                    'HTTP_CLIENT_IP',
                    'HTTP_FORWARDED_FOR_IP',
                    'VIA',
                    'X_FORWARDED_FOR',
                    'FORWARDED_FOR',
                    'X_FORWARDED',
                    'FORWARDED',
                    'CLIENT_IP',
                    'FORWARDED_FOR_IP',
                    'HTTP_PROXY_CONNECTION'
                );
                foreach($proxy_headers as $x){
                    if (isset($_SERVER[$x])) {
                        # Ban the ip if the auto banning has been enabled
                        $auto_ban = $this->check_autoban('auto_ban_ip_proxies');

                        # If the proxy logging has been enabled, log it
                        if($this->config['application']['log_proxys'] == 1) {
                            $this->write_log('proxy', array('auto_banned' => $auto_ban));
                        }

                        # Redirect to the defined page
                        header('location: '. $this->config['application']['redirect_proxys']);
                        exit();
                    }
                }
            }
        }
    }

    /**
     * Detect SQL Injection
     *
     * Checks a string for a SQL injection
     *
     * @param  String         $query             Query you want to check
     * @return void
     *
     */
    public function detect_sql_injection($query)
    {
        # Check if the SQL injection protection has been enabled
        if($this->config['application']['protection_sql_injections'] == '1') {
            if($this->sql_inject_class->testArray($query, $this->config) === TRUE) {
                # Ban the ip if the auto banning has been enabled
                $auto_ban = $this->check_autoban('auto_ban_ip_sql_injections');

                # If the proxy logging has been enabled, log it
                if($this->config['application']['log_sql_injections'] == 1) {
                    $this->write_log('sql_injection', array('query' => $this->sql_inject_class->query, 'auto_banned' => $auto_ban));
                }

                # Redirect to the defined page
                header('location: '. $this->config['application']['redirect_sql_injections']);
                exit();
            }
        }
    }



    /**
     * Detect Mass Requests (DDos)
     *
     * Detects mass requests (DDos attacks)
     *
     * @return boolean
     * @return void
     *
     */
    public function detect_mass_requests()
    {
        # Check if the mass requests protection has been enabled
        if($this->config['application']['protection_mass_requests'] == '1') {
            if(!isset($_SESSION['protect']['mass_request_time']) || $_SESSION['protect']['mass_request_time'] == null) {
                $_SESSION['protect']['mass_request_time'] = microtime(true);
                $_SESSION['protect']['mass_request_request'] = 1;
            } else {
                $_SESSION['protect']['mass_request_request'] += 1;
                if($_SESSION['protect']['mass_request_request'] > $this->config['application']['mass_requests_limit'] && microtime(true) - $_SESSION['protect']['mass_request_time'] < 1) {
                    return TRUE;
                } elseif(microtime(true) - $_SESSION['protect']['mass_request_time'] > 1) {
                    # Reset the counter since more than a second is over
                    $_SESSION['protect']['mass_request_time'] = null;

                    # Check if there were mass requests in the last second
                    if($_SESSION['protect']['mass_request_request'] > $this->config['application']['mass_requests_limit']) {
                        # Ban the ip if the auto banning has been enabled
                        $auto_ban = $this->check_autoban('auto_ban_ip_mass_requests');

                        # Log them if logging has been enabled
                        if($this->config['application']['log_mass_requests'] == 1) {
                            $this->write_log('mass_requests', array('requests' => $_SESSION['protect']['mass_request_request'], 'auto_banned' => $auto_ban));
                        }

                        # Redirect to the defined page
                        header('location: '. $this->config['application']['redirect_mass_requests']);
                        exit();
                    }
                }
            }
        }
    }

    /**
     * Detect Spammer
     *
     * Checks if the connecting IP is a spammer
     *
     * @return void
     *
     */
    public function detect_spammer() {
        # Check if the spammer protection has been enabled
        if($this->config['application']['protection_spammers'] == '1') {
            $ip = $_SERVER['REMOTE_ADDR'];

            $lookup = $this->config['application']['project_honeypot_api_key'] . '.' . implode('.', array_reverse(explode ('.', $ip ))) . '.dnsbl.httpbl.org';
            $result = explode( '.', gethostbyname($lookup));

            if ($result[0] == 127) {
                $activity = $result[1];
                $threat = $result[2];
                $type = $result[3];

                # Do not block search engines unless it has been enabled
                if($type != '0' || $this->config['application']['block_search_engines'] == 1) {
                    # Ban the ip if the auto banning has been enabled
                    $auto_ban = $this->check_autoban('auto_ban_ip_spammers');

                    # Log them if logging has been enabled
                    if($this->config['application']['log_spammers'] == 1) {
                        $this->write_log('spammer', array('auto_banned' => $auto_ban));
                    }

                    # Redirect to the defined page
                    header('location: '. $this->config['application']['redirect_spammers']);
                    exit();
                }
            }
        }
    }

    /**
     * Detect XSS
     *
     * Detects XSS attacks
     *
     * @param  String         $string            String we want to check
     * @return boolean
     *
     */
    public function detect_xss($string) {
        # Check if the xss protection has been enabled
        if($this->config['application']['protection_xss_attacks'] == '1') {
            $string_input = $string;
            $contains_xss = FALSE;

            // Skip any null or non string values
            if(is_null($string) || !is_string($string)) {
                return FALSE;
            }

            // Keep a copy of the original string before cleaning up
            $orig = $string;

            // URL decode
            $string = urldecode($string);

            // Convert Hexadecimals
            $string = preg_replace_callback('!(&#|\\\)[xX]([0-9a-fA-F]+);?!', function ($m) {
                return chr(hexdec($m[2]));
            }, $string);

            // Clean up entities
            $string = preg_replace('!(&#0+[0-9]+)!','$1;',$string);

            // Decode entities
            $string = html_entity_decode($string, ENT_NOQUOTES, 'UTF-8');

            // Strip whitespace characters
            $string = preg_replace('!\s!','',$string);

            // Set the patterns we'll test against
            $patterns = array(
                // Match any attribute starting with "on" or xmlns
                '#(<[^>]+[\x00-\x20\"\'\/])(on|xmlns)[^>]*>?#iUu',

                // Match javascript:, livescript:, vbscript: and mocha: protocols
                '!((java|live|vb)script|mocha|feed|data):(\w)*!iUu',
                '#-moz-binding[\x00-\x20]*:#u',

                // Match style attributes
                '#(<[^>]+[\x00-\x20\"\'\/])style=[^>]*>?#iUu',

                // Match unneeded tags
                '#</*(applet|meta|xml|blink|link|style|script|embed|object|iframe|frame|frameset|ilayer|layer|bgsound|title|base)[^>]*>?#i'
            );

            foreach($patterns as $pattern) {
                // Test both the original string and clean string
                if(preg_match($pattern, $string) || preg_match($pattern, $orig)){
                    $contains_xss = TRUE;
                }

                if ($contains_xss === TRUE) {
                    # Ban the ip if the auto banning has been enabled
                    $auto_ban = $this->check_autoban('auto_ban_ip_xss_attacks');

                    # Log them if logging has been enabled
                    if($this->config['application']['log_xss_attacks'] == 1) {
                        $this->write_log('xss_attack', array('query' => $string_input, 'auto_banned' => $auto_ban));
                    }

                    # Redirect to the defined page
                    header('location: '. $this->config['application']['redirect_xss_attacks']);
                    exit();
                }
            }
        }
        return FALSE;
    }

    /**
     * Detect Banned IP
     *
     * Check if the current IP is banned
     *
     * @return boolean
     *
     */
    public function detect_banned_ip()
    {
        $ban_object = new Ban($this->config, $this->db);
        $check = $ban_object->check_ip();
        if($check !== FALSE) {
            header('location: '. $this->config['application']['redirect_banned']);
            exit();
        }
    }

    /**
     * Detect Banned Country
     *
     * Check if the current country is banned
     *
     * @return boolean
     *
     */
    public function detect_banned_country()
    {
        $ban_object = new Ban($this->config, $this->db);
        $check = $ban_object->check_country();

        if($check !== FALSE) {
            header('location: '. $this->config['application']['redirect_banned']);
            exit();
        }
    }

    /**
     * Detect Banned ISP
     *
     * Check if the current ISP is banned
     *
     * @return boolean
     *
     */
    public function detect_banned_isp()
    {
        $ban_object = new Ban($this->config, $this->db);
        $check = $ban_object->check_isp();

        if($check !== FALSE) {
            header('location: '. $this->config['application']['redirect_banned']);
            exit();
        }
    }


    /**
     * Write Log
     *
     * Write the threat into our logs
     *
     * @param  Integer       $type               Type of the threat we want to log
     * @param  Array         $data               Array with the data needed to log this type of threat
     * @return Void
     *
     */
    public function write_log($type, $data)
    {
        global $_config;
        global $db;

        # Fill the required variables
        $time = date("Y-m-d H:i:s");
        $ip = $_SERVER['REMOTE_ADDR'];


        $auto_banned = $data['auto_banned'];


        if(isset($_SERVER['HTTP_REFERER'])) {
            $referrer = $_SERVER['HTTP_REFERER'];
        } else {
            $referrer = 'Unknown';
        }

        # Add the personal data
        $personal_data = $this->get_personal_data();

        # Browser Data
        $custom_data['personal']['browser']['name'] = $personal_data['browser']['name'] . ' ' . $personal_data['browser']['version'];
        $custom_data['personal']['browser']['code'] = $personal_data['browser']['code'];

        # OS Data
        $custom_data['personal']['OS'] = $personal_data['OS'];

        # Location Data
        $custom_data['personal']['location']['name'] = $personal_data['location']['name'];
        $custom_data['personal']['location']['code'] = strtolower($personal_data['location']['country_code']);


        # Add some additional details to the log
        # User agent
        $custom_data['personal']['user_agent'] = $_SERVER['HTTP_USER_AGENT'];

        # Referrer
        $custom_data['personal']['referrer'] = $referrer;


        # Write the data into our database
        if($type == 'mass_requests') {
            # Store the amount of requests
            $custom_data['attack']['requests'] = $data['requests'];
        } elseif($type == 'sql_injection' || $type == 'xss_attack') {
            # Store the query
            $custom_data['attack']['query'] = $data['query'];
        }

        $custom_data = serialize($custom_data);
        $sql = 'INSERT INTO `' . $this->config['database']['prefix'] . '_detected_attacks` (`ip`, `type`, `created_on`, `auto_banned`, `custom_data`) VALUES (?, ?, ?, ?, ?)';
        $write = $db->prepare($sql);
        $write->bind_param('sssis', $ip, $type, $time, $auto_banned, $custom_data);
        $write->execute();
    }

    /**
     * Fetch Log
     *
     * Fetch the log for a specific threat type
     *
     * @param  String          $type             Method to use. 1 has a high detection. 2 detects only proxys.
     * Optional @param  String          $ip             Method to use. 1 has a high detection. 2 detects only proxys.
     * @return String
     *
     */
    public function fetch_log($type, $ip_full_log = null)
    {
        global $_config;
        global $db;



        # Should we fetch the detail log for a single ip
        if($ip_full_log != null) {
            $sql = "SELECT `id`, `type`, `ip`, `auto_banned`, `custom_data`, `created_on`  FROM `" . $this->config['database']['prefix'] . "_detected_attacks` WHERE `type` = ? and `ip` = ?";
            $fetch = $db->prepare($sql);
            $fetch->bind_param('ss', $type, $ip_full_log);
        } else {
            $sql = "SELECT `id`, `type`, `ip`, `auto_banned`, `custom_data`, `created_on`  FROM `" . $this->config['database']['prefix'] . "_detected_attacks` WHERE `type` = ?";
            $fetch = $db->prepare($sql);
            $fetch->bind_param('s', $type);
        }

        $fetch->execute();
        $fetch->bind_result($id, $type, $ip, $auto_banned, $custom_data, $created_on);

        while ($fetch->fetch()) {
            $result[$id] = array('id' => $id, 'ip' => $ip, 'type' => $type, 'auto_banned' => $auto_banned, 'created_on' => $created_on, 'custom_data' => $custom_data);
        }

        if($type == 'mass_requests' && isset($result) && !is_null($result) && $ip_full_log == null) {
            $output = array();
            foreach($result as $key1) {
                $custom_data = unserialize($key1['custom_data']);
                $key1['requests'] = $custom_data['attack']['requests'];

                $check = $this->filter($key1['ip']);
                if($check === TRUE) {
                    # Ip is not in the array. Let's add it.
                    $temp_array = array('id' => $key1['id'], 'ip' => $key1['ip']);
                    $this->check[] = $temp_array;
                    $output[$key1['id']] = $key1;
                } else {
                    # Ip is already in the array
                    # Count the total amount of requests from this ip
                    $i = 0;
                    foreach($output as $temp) {
                        $i++;
                        if($temp['ip'] == $key1['ip']) {
                            $output[$check['id']]['requests'] += $key1['requests'];
                            break;
                        }
                    }
                }
            }
        } else {
            if(isset($result)) {
                $output = $result;
            }
        }

        if (isset($output) && !is_null($output)) {
            return $output;
        } else {
            return FALSE;
        }
    }

    /**
     * Delete from log
     *
     * Delete a specific entry from our logs
     *
     * @param  Integer         $type               Type of the threat
     * @param  Integer         $id                 ID of the entry
     * @return boolean
     *
     */
    public function delete_from_log($type, $id)
    {
        global $_config;
        global $db;

        $sql = 'DELETE FROM `' . $this->config['database']['prefix'] . '_detected_attacks` WHERE `id` = ? and `type` = ?';
        $delete = $db->prepare($sql);
        $delete->bind_param('is', $id, $type);
        $delete->execute();
        return TRUE;
    }

    /**
     * Get Personal Data
     *
     * Get a client´s personal data (OS, Browser, Location)
     *
     * @return array
     *
     */
    public function get_personal_data()
    {
        # Create a detection instance
        $detect = new Detect();

        # Detect the OS
        $os = $detect->OS();
        $browser = $detect->Browser();
        $location = $detect->Location();
        # Return the gathered data
        $result = array('OS' => $os, 'browser' => $browser, 'location' => $location);
        return $result;

    }

    private function check_autoban($type)
    {
        # Check if the auto banning
        # has been enabled for this type
        if($this->config['application'][$type] > 0) {
            # Auto banning has been enabled
            $ip = $_SERVER['REMOTE_ADDR'];

            # Add the ban
            $ban_object = new Ban($this->config, $this->db);
            $ban_until = time() + (60*$this->config['application'][$type]);
            $ban = $ban_object->ban_ip($ip, $ban_until, 'auto_ban');

            # Make sure that the ban has been added successfully
            if($ban !== FALSE) {
                # The ban has been added
                # Return the id
                return $ban;
            } else {
                # Something went wrong
                # Unable to a add the ban
                return FALSE;
            }
        } else {
            # Auto banning has been disabled
            # for this type
            return FALSE;
        }
    }

    /**
     * Filter
     *
     * Private function. Needed to sort our "Mass requests" logs
     *
     * @param  Integer          $ip                 Type of the threat we want to log
     * @return Array
     *
     */
    private function filter($ip)
    {
        if(!isset($this->check)) $this->check = array();
        for($i=0; $i<count($this->check); $i++) {
            if($ip == $this->check[$i]['ip']) {
                return $this->check[$i];
            }
        }
        return TRUE;
    }

    /**
     * Add item
     *
     * Private function. Add a IP to our local ip list
     *
     * @param  Array            $array               Array with the data for the proxy/VPN
     * @return array
     *
     */
    private function add_item($array) {
        if(file_exists($this->local_proxys_file) && filesize($this->local_proxys_file) > 0) {
            $old = file_get_contents($this->local_proxys_file);
            $old = unserialize($old);
        } else {
            $old = array();
        }

        array_push($old, $array);
        $new = serialize($old);
        file_put_contents($this->local_proxys_file, $new);
        return $new;
    }
}