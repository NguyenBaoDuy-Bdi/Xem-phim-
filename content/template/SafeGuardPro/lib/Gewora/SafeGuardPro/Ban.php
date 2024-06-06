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

class Ban extends Base
{
    /**
     * Fetch
     *
     * Fetch all bans from the database
     *
     * @param   $type
     * @return  array
     */
    public function fetch($type = 'ip')
    {
        if($type == 'ip') {
            $sql = "SELECT *  FROM `" . $this->config['database']['prefix'] . "_bans`";
        } elseif($type == 'country') {
            $sql = "SELECT *  FROM `" . $this->config['database']['prefix'] . "_bans_country`";
        } elseif($type == 'isp') {
            $sql = "SELECT *  FROM `" . $this->config['database']['prefix'] . "_bans_isp`";
        }

        $query = $this->db->query($sql);

        $result = array();
        while($data = $query->fetch_assoc()) {
            $result[] = $data;
        }

        return $result;
    }

    /**
     * Ban IP
     *
     * Ban a specific IP until a specific time
     *
     * @param   String          $ip            The IP which we should ban
     * @param   String          $banned_until  Ban the IP until...
     * @param   String          $type          Type (ban or auto-ban) OPTIONAL
     * @return  boolean
     */
    public function ban_ip($ip, $banned_until, $type = 'ban')
    {
        # Check if we should sync
        # the bans with cloudflare
        if($type == 'ban') {
            if($this->config['application']['ban_ip_sync_with_cloudflare'] == 1) {
                $cloudflare = new Cloudflare($this->config, $this->db);
                $ban = $cloudflare->blacklist($ip);
            }
        } elseif($type == 'auto_ban') {
            if($this->config['application']['auto_ban_sync_with_cloudflare'] == 1) {
                $cloudflare = new Cloudflare($this->config, $this->db);
                $ban = $cloudflare->blacklist($ip);
            }
        }



        $time = time();
        $sql = 'INSERT INTO `' . $this->config['database']['prefix'] . '_bans` (`ip`, `banned_until`, `created_on`) VALUES (?, FROM_UNIXTIME(?), FROM_UNIXTIME(?))';
        $write = $this->db->prepare($sql);
        $write->bind_param('sii', $ip, $banned_until, $time);
        $write->execute();

        if($write->affected_rows== 1) {
            $insered_id = $write->insert_id;
            return $insered_id;
        } else {
            return FALSE;
        }
    }

    /**
     * Ban Country
     *
     * Ban a specific country
     *
     * @param   String          $country            The IP which we should ban
     * @return  boolean
     */
    public function ban_country($country)
    {
        $time = time();
        $sql = 'INSERT INTO `' . $this->config['database']['prefix'] . '_bans_country` (`country_code`, `created_on`) VALUES (?, FROM_UNIXTIME(?))';
        $write = $this->db->prepare($sql);
        $write->bind_param('si', $country, $time);
        $write->execute();

        if($write->affected_rows== 1) {
            $insered_id = $write->insert_id;
            return $insered_id;
        } else {
            return FALSE;
        }
    }

    /**
     * Ban ISP
     *
     * Ban a specific ISP
     *
     * @param   String          $isp            The ISP which we should ban
     * @return  boolean
     */
    public function ban_isp($isp)
    {
        $time = time();
        $sql = 'INSERT INTO `' . $this->config['database']['prefix'] . '_bans_isp` (`isp`, `created_on`) VALUES (?, FROM_UNIXTIME(?))';
        $write = $this->db->prepare($sql);
        $write->bind_param('si', $isp, $time);
        $write->execute();

        if($write->affected_rows== 1) {
            $insered_id = $write->insert_id;
            return $insered_id;
        } else {
            return FALSE;
        }
    }

    /**
     * Unban IP
     *
     * Remove an IP ban
     *
     * @param   String          $id            The ban which we should remove
     * @return  boolean
     */
    public function unban_ip($id)
    {
        # Check if we should sync bans and/or auto-bans
        # with cloudflare
        if($this->config['application']['auto_ban_sync_with_cloudflare'] == 1 || $this->config['application']['ban_ip_sync_with_cloudflare'] == 1) {
            $sql = "SELECT COUNT(*) FROM `" . $this->config['database']['prefix'] . "_detected_attacks` WHERE auto_banned = ?";
            $check = $this->db->prepare($sql);
            $check->bind_param('s', $id);
            $check->execute();
            $check->bind_result($count);
            $check->fetch();
            $check->free_result();

            if($this->config['application']['auto_ban_sync_with_cloudflare'] == 1 && $count != 0) {
                # Remove the ban from cloudflare
                $sql = "SELECT `ip` FROM `" . $this->config['database']['prefix'] . "_bans` WHERE id = ?";
                $check = $this->db->prepare($sql);
                $check->bind_param('s', $id);
                $check->execute();
                $check->bind_result($ip);
                $check->fetch();
                $check->free_result();

                $cloudflare = new Cloudflare($this->config, $this->db);
                $unban = $cloudflare->remove($ip);

            } elseif($this->config['application']['ban_ip_sync_with_cloudflare'] == 1 && $count == 0) {
                # Remove the ban from cloudflare
                $sql = "SELECT `ip` FROM `" . $this->config['database']['prefix'] . "_bans` WHERE id = ?";
                $check = $this->db->prepare($sql);
                $check->bind_param('s', $id);
                $check->execute();
                $check->bind_result($ip);
                $check->fetch();
                $check->free_result();

                $cloudflare = new Cloudflare($this->config, $this->db);
                $unban = $cloudflare->remove($ip);
            }
        }

        # Remove the ban from the database
        $sql = 'DELETE FROM `' . $this->config['database']['prefix'] . '_bans` WHERE `id` = ?';
        $delete = $this->db->prepare($sql);
        $delete->bind_param('s', $id);
        $delete->execute();


        return TRUE;
    }

    /**
     * Unban Country
     *
     * Remove an country ban
     *
     * @param   String          $id            The ban which we should remove
     * @return  boolean
     */
    public function unban_country($id)
    {
        $sql = 'DELETE FROM `' . $this->config['database']['prefix'] . '_bans_country` WHERE `id` = ?';
        $delete = $this->db->prepare($sql);
        $delete->bind_param('s', $id);
        $delete->execute();

        return TRUE;
    }

    /**
     * Unban ISP
     *
     * Remove an ISP ban
     *
     * @param   String          $id            The ban which we should remove
     * @return  boolean
     */
    public function unban_isp($id)
    {
        $sql = 'DELETE FROM `' . $this->config['database']['prefix'] . '_bans_isp` WHERE `id` = ?';
        $delete = $this->db->prepare($sql);
        $delete->bind_param('s', $id);
        $delete->execute();

        return TRUE;
    }


    /**
     * Check IP
     *
     * Check if the current IP is banned
     *
     * @return  boolean
     */
    public function check_ip()
    {
        $ip = $_SERVER['REMOTE_ADDR'];

        $sql = "SELECT `id`, unix_timestamp(banned_until) FROM `" . $this->config['database']['prefix'] . "_bans` WHERE ip = ?";
        $check = $this->db->prepare($sql);
        $check->bind_param('s', $ip);
        $check->execute();
        $check->store_result();
        $num_rows = $check->num_rows();

        if($num_rows == 1) {
            $check->bind_result($id, $banned_until);
            $check->fetch();

            # Check if the ban is still active
            if($banned_until > time()) {
                # The ban is still active
                $result = array('banned_until' => $banned_until);
                return $result;
            } else {
                # The ban has been expired
                # Remove it from the database
                $unban = $this->unban_ip($id);
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    /**
     * Check Country
     *
     * Check if the current country is banned
     *
     * @return  boolean
     */
    public function check_country()
    {
        # Create a detection instance
        $detect = new Detect();

        # Detect the OS
        $location = $detect->Location();

        $sql = "SELECT `id` FROM `" . $this->config['database']['prefix'] . "_bans_country` WHERE country_code = ?";
        $check = $this->db->prepare($sql);
        $check->bind_param('s', $location['country_code']);
        $check->execute();
        $check->store_result();
        $num_rows = $check->num_rows();

        if($num_rows == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * Check ISP
     *
     * Check if the current ISP is banned
     *
     * @return  boolean
     */
    public function check_isp()
    {
        # Create a detection instance
        $detect = new Detect();

        # Detect the ISP
        $isp = $detect->ISP();

        $sql = "SELECT `id` FROM `" . $this->config['database']['prefix'] . "_bans_isp` WHERE isp = ?";
        $check = $this->db->prepare($sql);
        $check->bind_param('s', $isp);
        $check->execute();
        $check->store_result();
        $num_rows = $check->num_rows();

        if($num_rows == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}