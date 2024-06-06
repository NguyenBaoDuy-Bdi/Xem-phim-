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

class Log extends Base {

    /**
     * Stats
     *
     * Fetch the statistics for the current logs (shown on the dashboard)
     *
     * @param   String          $frame          Time frame - OPTIONAL
     * @return  boolean
     */
    public function stats($frame = 'default')
    {
        if($frame == 'default') {
            # Fetch stats for one day
            $sql = 'SELECT COUNT(*) FROM `' . $this->config['database']['prefix'] . '_detected_attacks` WHERE created_on > DATE_SUB(NOW(), INTERVAL 1 DAY)';
            $fetch = $this->db->prepare($sql);
            $fetch->execute();
            $fetch->bind_result($day);
            $fetch->fetch();
            $fetch->free_result();

            # Fetch stats for one week
            $sql = 'SELECT COUNT(*) FROM `' . $this->config['database']['prefix'] . '_detected_attacks` WHERE created_on > DATE_SUB(NOW(), INTERVAL 1 WEEK)';
            $fetch = $this->db->prepare($sql);
            $fetch->execute();
            $fetch->bind_result($week);
            $fetch->fetch();
            $fetch->free_result();

            # Fetch stats for one month
            $sql = 'SELECT COUNT(*) FROM `' . $this->config['database']['prefix'] . '_detected_attacks` WHERE created_on > DATE_SUB(NOW(), INTERVAL 1 MONTH)';
            $fetch = $this->db->prepare($sql);
            $fetch->execute();
            $fetch->bind_result($month);
            $fetch->fetch();
            $fetch->free_result();

            # Return the stats
            $return = array('day' => $day, 'week' => $week, 'month' => $month);
            return $return;
        }
    }
}