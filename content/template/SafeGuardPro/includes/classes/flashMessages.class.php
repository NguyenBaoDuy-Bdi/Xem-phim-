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

/**
* Flash messages class
*
* This class is used to show flash messages
*
* @author https://github.com/plasticbrain/PHP-Flash-Messages
* @author Gewora <support@gewora.net>
* @copyright Copyright (c) 2013 by Gewora Project Team
*/

class flashMessages 
{

    //---------------------
    // Class Variables
    //---------------------	
    var $msgId;
    var $msgTypes = array('help', 'info', 'warning', 'error', 'success');
    var $msgClass = '';
    var $msgWrapper = '<div class="%s %s">%s %s<button data-dismiss="alert" class="close" type="button">&times;</button></div>';
    var $msgBefore = '';
    var $msgAfter = '';

    /**
     * Constructor
     * @author Mike Everhart
     */
    public function __construct($template_name, $application_url)
	{
        // Generate a unique ID for this user and session
        $this->msgId = md5(uniqid());
        $this->template_name = $template_name;
        $this->application_url = $application_url;
    }

    /**
     * Add a message to the queue
     * 
     * @author Mike Everhart
     * 
     * @param  string   $type        	The type of message to add
     * @param  string   $message     	The message
     * @param  string   $redirect_to 	(optional) If set, the user will be redirected to this URL
     * @param  bool     $new         	(optional) If set, we use the bootstrap 3 coding
     * @return  bool
     * 
     */
    public function add($type, $message, $redirect_to = null, $new = FALSE)
	{
        // Create the session array if it doesnt already exist
        if (!isset($_SESSION['gewora_management']['flash_messages']))
            $_SESSION['gewora_management']['flash_messages'] = array();
        if (!isset($type) || !isset($message[0]))
            return false;

        // Replace any shorthand codes with their full version
        if (strlen(trim($type)) == 1) {
            $type = str_replace(array('h', 'i', 'w', 'e', 's'), array('help', 'info', 'warning', 'error', 'success'), $type);

            // Backwards compatibility...
        } elseif ($type == 'information') {
            $type = 'info';
        }
        // Make sure it's a valid message type
        if (!in_array($type, $this->msgTypes))
            die('"' . strip_tags($type) . '" is not a valid message type!');

        if ($type == "info") {
            $type = "alert alert-info";
        } elseif ($type == "error") {
            $type = "alert alert-danger alert-error";
        } elseif ($type == "success") {
            $type = "alert alert-success";
        } elseif ($type == "warning") {
            $type = "alert alert-warning";
        }

        // If the session array doesn't exist, create it
        if (!array_key_exists($type, $_SESSION['gewora_management']['flash_messages']))
            $_SESSION['gewora_management']['flash_messages'][$type] = array();
            $_SESSION['gewora_management']['flash_messages'][$type][] =$message;
        
        if (!is_null($redirect_to)) {
            header("Location: $redirect_to");
            exit();
        }
        return true;
    }

    //---------------------
    // display()
    // print queued messages to the screen
    //---------------------
    /**
     * Display the queued messages
     * 
     * @author Mike Everhart
     * 
     * @param  string   $type     Which messages to display
     * @param  bool  	$print    True  = print the messages on the screen
     * @return mixed              
     * 
     */
    public function display($type = 'all', $print = true) 
	{
        $messages = '';
        $data = '';

        if (!isset($_SESSION['gewora_management']['flash_messages']))
            return false;

        if ($type == 'g' || $type == 'growl') {
            $this->displayGrowlMessages();
            return true;
        }

        // Print a certain type of message?
        if (in_array($type, $this->msgTypes)) {
            foreach ($_SESSION['gewora_management']['flash_messages'][$type] as $msg) {
                $messages .= $this->msgBefore . $msg . $this->msgAfter;
            }

            $data .= sprintf($this->msgWrapper, $this->msgClass, $type, $this->icon, $messages);

            // Clear the viewed messages
            $this->clear($type);

            // Print ALL queued messages
        } elseif ($type == 'all') {
            foreach ($_SESSION['gewora_management']['flash_messages'] as $type => $msgArray) {
                $messages = '';
                foreach ($msgArray as $msg) {
                    $messages .= $this->msgBefore . $msg . $this->msgAfter;
                }

                // For the old adminica template
                if ($type == "alert dismissible alert_blue") {
                    
                } elseif ($type == "alert alert-success") {
                    $icon = '<i class="icon-ok"></i>';
                } elseif ($type == "alert alert-error") {
                    $icon = '<i class="icon-remove"></i>';
                } elseif ($type == "alert alert-warning") {
                    $icon = '<i class="icon-info-sign"></i>';
                } elseif ($type == "alert alert-success") {
                    $icon = '<i class="icon-ok"></i>';
                } else {
                    $icon = '<i class="icon-info-sign"></i>';
                }
                $data .= sprintf($this->msgWrapper, $this->msgClass, $type, $icon, $messages);
            }

            // Clear ALL of the messages
            $this->clear();

            // Invalid Message Type?
        } else {
            return false;
        }

        // Print everything to the screen or return the data
        if ($print) {
            echo $data;
        } else {
            return $data;
        }
    }

    /**
     * Check to  see if there are any queued error messages
     * 
     * @author Mike Everhart
     * 
     * @return bool  true  = There ARE error messages
     *               false = There are NOT any error messages
     * 
     */
    public function hasErrors() {
        return empty($_SESSION['gewora_management']['flash_messages']['error']) ? false : true;
    }

    /**
     * Check to see if there are any ($type) messages queued
     * 
     * @author Mike Everhart
     * 
     * @param  string   $type     The type of messages to check for
     * @return bool            	  
     * 
     */
    public function hasMessages($type = null) 
	{
        if (!is_null($type)) {
            if (!empty($_SESSION['gewora_management']['flash_messages'][$type]))
                return $_SESSION['gewora_management']['flash_messages'][$type];
        } else {
            foreach ($this->msgTypes as $type) {
                if (!empty($_SESSION['gewora_management']['flash_messages']))
                    return true;
            }
        }
        return false;
    }

    /**
     * Clear messages from the session data
     * 
     * @author Mike Everhart
     * 
     * @param  string   $type     The type of messages to clear
     * @return bool 
     * 
     */
    public function clear($type = 'all') 
	{
        if ($type == 'all') {
            unset($_SESSION['gewora_management']['flash_messages']);
        } else {
            unset($_SESSION['gewora_management']['flash_messages'][$type]);
        }
        return true;
    }

    public function __toString() {
        return $this->hasMessages();
    }

    public function __destruct() {
        //$this->clear();
    }

}

?>