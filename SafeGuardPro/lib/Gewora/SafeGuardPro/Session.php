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

class Session extends Base
{
    /**
     * Check
     *
     * Check if a session is active, and the user has the required rank
     */
    function check() {
        if (isset($_SESSION['gewora_safe_guard']['loggedIn']) && isset($_SESSION['gewora_safe_guard']['id'])) {
            if ($_SESSION['gewora_safe_guard']['loggedIn'] !== true)
                return false;
        } else {
            return false;
        }
        return true;
    }

    /**
     * Start
     *
     * Check the entered login data and start the session if it is valid
     * @param   Object          $db                 Database object
     * @param   String          $username           Username
     * @param   String          $password           Password
     * @return  boolean
     */
    function start($db, $username, $password)
    {
        # Leerzeichen aus dem Benutzernamen entfernen und Passwort Hashen
        $username = trim($username);

        # User IP auslesen
        $ip = $_SERVER['REMOTE_ADDR'];

        # Benutzerdaten aus der DB laden
        $sql = 'SELECT `id` FROM ' . $this->config['database']['prefix'] . '_users WHERE `username` = ? AND `password` = ?';

        $login_check = $db->prepare($sql);
        $login_check->bind_param('ss', $username, $password);
        $login_check->execute();
        $login_check->store_result();
        $login_check->bind_result($id);
        $login_check->fetch();


        # Wenn ein Datensatz gefunden wurde, also das Passwort korrekt ist
        if ($login_check->num_rows == 1) {
            $_SESSION['gewora_safe_guard']['loggedIn'] = true;
            $_SESSION['gewora_safe_guard']['id'] = $id;
            $_SESSION['gewora_safe_guard']['username'] = $username;
            return true;
        }

    }

    /**
     * Stop
     *
     * Stop the session and log the user out
     */
    function stop($redirect = 1) {
        @session_start();
        @session_unset();
        @session_destroy();
        @session_write_close();
        @setcookie(session_name(), '', 0, '/');
        @session_regenerate_id(true);
        if ($redirect == 1) {
            header('Location: index.php');
        }
    }
}