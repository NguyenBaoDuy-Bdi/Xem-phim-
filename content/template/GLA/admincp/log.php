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

require_once '../includes/global.inc.php';
require_once '../includes/global_admin.inc.php';

use Gewora\SafeGuardPro\Protect;

# Create the protect object
$protect_class = new Protect($config, $db, TRUE);

# Array to store some custom data
$data = array();

# Get the type where we should fetch the logs form
if(isset($_GET['type']) && !empty($_GET['type'])) {
    $type = $_GET['type'];

    # Should we fetch the detail log for a single ip
    if(isset($_GET['detail']) && $_GET['detail'] == 'full') {
        $data['fetch_log']['detail'] = 'full';
        $fetch_ip = $_GET['ip'];
        $fetch = $protect_class->fetch_log($type, $fetch_ip);
    } else {
        $fetch = $protect_class->fetch_log($type);
    }

    # Should we delete a log
    if(isset($_GET['delete']) && is_numeric($_GET['delete'])) {
        $protect_class->delete_from_log($type, $_GET['delete']);
        if(isset($_GET['detail']) && $_GET['detail'] == 'full' &&
           isset($_GET['ip']) && !empty($_GET['ip'])) {
            $msg->add('s', '<strong>Success!</strong> The selected data has been deleted from the logs.', 'log.php?type=' . $type . '&detail=full&ip=' . $_GET['ip']);
        } else {
            $msg->add('s', '<strong>Success!</strong> The selected data has been deleted from the logs.', 'log.php?type=' . $type);
        }
    }


    # Show we display the details for a log (in
    # a ajax loaded modal window)
    if(isset($_GET['details']) && is_numeric($_GET['details'])) {
        $id = $fetch[$_GET['details']]['id'];
        $custom_data = unserialize($fetch[$id]['custom_data']);

        $auto_banned = $fetch[$id]['auto_banned'];
        if(!is_null($auto_banned) && !empty($auto_banned) && $auto_banned >= 1) {
            $auto_banned_status = TRUE;
            $auto_banned = '<span class="label label-success">Yes</span>';
        } else {
            $auto_banned_status = FALSE;
            $auto_banned = '<span class="label label-important">No</span>';
        }

        $result = '
        <div class="modal">
            <div class="modal-header">
                <a class="close" data-dismiss="modal">&times;</a>
                <h3>Details for log entry with ID ' .$id. '</h3>
            </div>
            <div class="modal-body" style:"width:85%;">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Date & Time</td>
                            <td>' .$fetch[$id]['created_on']. ' </td>
                        </tr>
                        <tr>
                            <td>IP Address</td>
                            <td>' .$fetch[$id]['ip']. ' </td>
                        </tr>';

                        if(isset($fetch[$id]['requests'])) {
                            $result .='
                            <tr>
                                <td>Total requests</td>
                                <td>' .$fetch[$id]['requests']. ' </td>
                            </tr>';
                        }

                        if(isset($custom_data['attack']['requests'])) {
                            $result .='
                                <tr>
                                    <td>Requests</td>
                                    <td>' .$custom_data['attack']['requests']. ' </td>
                                </tr>';
                        }

                        if(isset($custom_data['attack']['query'])) {
                            $result .='
                            <tr>
                                <td>Query</td>
                                <td><pre>' .htmlspecialchars($custom_data['attack']['query']). '</pre></td>
                            </tr>';
                        }

                        $result .='
                        <tr>
                            <td>User agent</td>
                            <td>' .$custom_data['personal']['user_agent']. ' </td>
                        </tr>
                        <tr>
                            <td>Referrer</td>
                            <td>' .$custom_data['personal']['referrer']. ' </td>
                        </tr>
                        <tr>
                            <td>Operating system</td>
                            <td><img src="../templates/' .$config['application']['template_name'].'/includes/data/img/os/' .$custom_data['personal']['OS']['code']. '.png"> ' .$custom_data['personal']['OS']['name']. ' </td>
                        </tr>
                        <tr>
                            <td>Browser</td>
                            <td><img src="../templates/' .$config['application']['template_name'].'/includes/data/img/browsers/' .$custom_data['personal']['browser']['code']. '.png"> ' .$custom_data['personal']['browser']['name']. ' </td>
                        </tr>
                        <tr>
                            <td>Location</td>
                            <td><img src="../templates/' .$config['application']['template_name'].'/includes/data/img/flags/' .$custom_data['personal']['location']['code']. '.png"> ' .$custom_data['personal']['location']['name']. ' </td>
                        </tr>
                        <tr>
                            <td>Auto Banned</td>
                            <td>' .$auto_banned. '</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <a class="btn btn-danger" href="log.php?type=' .$type. '&delete=' .$id. '">Delete</a>';

            if($auto_banned_status === TRUE) {
                $result .='<a class="btn btn-warning" href="ban.php?action=unban&id=' .$fetch[$id]['auto_banned']. '">Unban</a>';
            }

        $result .='<a class="btn" data-dismiss="modal">Close</a>
            </div>
        </div>';

        exit($result);
    }

} else {
    $msg->add('e', '<strong>Error!</strong> Which logs do you want to see? No type has been specified.', 'dashboard.php');
}


# Settings
$settings = array();
$type = $_GET['type'];
$settings['type'] = $type;
if(isset($_GET['detail']) && !empty($_GET['detail'])) {
    $settings['detail'] = $_GET['detail'];
} else {
    $settings['detail'] = null;
}

# Render template
$template = $twig->loadTemplate('log.html.twig');
echo $template->render(array(
    'msg' => $msg,
    'logs' => $fetch,
    'data' => $data,
    'settings' => $settings,
));

?>