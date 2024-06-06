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

class User extends Base
{
    /**
     * Update general
     *
     * Update the general settings for a specific user
     *
     * @param           String          $id               ID of the user
     * @param           String          $username         New username
     * Optional @param  String          $password         New password. Default: Keep the current password
     * @return boolean
     *
     */
    public function update_general($id, $username, $password = NULL)
    {
        # Should we change the password too
        if(!is_null($password) && !empty($password)) {
            $sql = "UPDATE `" . $this->config['database']['prefix'] . "_users` SET `username` = ?, `password` = ? WHERE `id` = ?";
            $result = $this->db->prepare($sql);
            $result->bind_param('ssi', $username, $password, $id);
        } else {
            $sql = "UPDATE `" . $this->config['database']['prefix'] . "_users` SET `username` = ? WHERE `id` = ?";
            $result = $this->db->prepare($sql);
            $result->bind_param('si', $username, $id);
        }
        $result->execute();

        if ($result->affected_rows == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}

?>