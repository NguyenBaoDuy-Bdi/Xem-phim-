<?php
$_ModGET = @(string)$_GET['mod'];
if(trim($_ModGET) != false && $_ModGET = 'location')
{
	$_Token = (string)$_GET['token'];
	$_UrlDecode = base64_decode($_Token); // decode token link
	header('Location:' . $_UrlDecode);
	exit;
}
?>