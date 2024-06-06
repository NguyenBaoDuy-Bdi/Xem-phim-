<?php
$username = "YourUsername";
$password = "YourPassword";

$getacc = $_POST['getacc'];
if($getacc=="true"){
	echo "&u=".$username."&p=".$password."&";
}
?> 