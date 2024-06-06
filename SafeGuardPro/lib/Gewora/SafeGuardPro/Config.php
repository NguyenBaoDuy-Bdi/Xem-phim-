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

class Config extends Base {
    /**
     * Fetch
     *
     * Fetch the config settings from the database
     * @return  array
     */
    public function fetch()
    {
        $sql = "SELECT * FROM `" .$this->config['database']['prefix'] . "_config`";
        $result = $this->db->query($sql);
        while ($row = $result->fetch_assoc()) {
            $config[$row['key']] =  $row['value'];
        }
        return $config;
    }

    /**
     * Update
     *
     * Update a specific config value
     * @param   String          $key                The key you want to update
     * @param   String          $value              The value for the key you want to update
     * @return  boolean
     */
    public function update($key, $value)
    {
        $sql = "UPDATE `" . $this->config['database']['prefix'] . "_config` SET `value` = ? WHERE `key` = ?";
        $result = $this->db->prepare($sql);
        $result->bind_param('ss', $value, $key);
        $result->execute();

        if ($result->affected_rows == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}