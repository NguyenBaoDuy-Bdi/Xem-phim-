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

use Gewora\SafeGuardPro\Hash;
use Gewora\SafeGuardPro\Tools;

$data = array();

if(isset($_POST['submit'])) {
    if(isset($_POST['hash']) && isset($_POST['hash_string']) && !empty($_POST['hash_string'])) {
        $string = $_POST['hash_string'];
        $algorithm = $_POST['hash_algorithm'];
        $iterations = $_POST['hash_iterations'];
        $hash = new Hash;
        $hash_string = $hash->$algorithm($string, $iterations);
        $data['hashed'] = $hash_string;
    } elseif(isset($_POST['generate_password']) && isset($_POST['password_length'])) {
        $tools = new Tools();
        $password = $tools->generate_password($_POST['password_length']);
        $data['password'] = $password;
    }
}

# Render template
$template = $twig->loadTemplate('tools.html.twig');
echo $template->render(array(
    'msg' => $msg,
    'data' => $data,
    'config' => $config,
));

?>