<?php

////////////////////////////////////////////////////////
// for php 5.6+ you need to make some changes in code
// method 1
// add the following line
// curl_setopt($ch, CURLOPT_SAFE_UPLOAD, 0);
//
// method 2
// change
// $post_fields['vfile'] = "@".$file;
// to
// $post_fields['vfile'] = CURLFile($file);
////////////////////////////////////////////////////////

$apiversion = "2.123.20150426";

//REQUIRED Registered Users - You can find your user token in API page.
$user_token = "003966073d3989f6389b4424745b6c82";


if(count($argv) < 2)
die("Usage: php $argv[0] [VIDEO TO UPLOAD] {SUB FILE}\n");

$file = $argv[1];
if(!file_exists("$file"))
die("ERROR: Can't find '$file'!\n");

$path_parts = pathinfo($file);
$ext = $path_parts['extension'];

$allowed = array("flv", "avi", "rmvb", "mkv", "mp4", "wmv", "mpeg", "mpg", "mov");

if (!in_array(strtolower($ext),$allowed))
die("ERROR: Video format not permitted. Formats allowed: .avi, .rmvb, .mkv, .flv, .mp4, .wmv, .mpeg, .mpg, .mov!\n");

if(isset($argv[2]))
{
$sub_file = $argv[2];

if(!file_exists("$sub_file"))
die("ERROR: Can't find '$file'!\n");

$path_parts = pathinfo($sub_file);
$ext = $path_parts['extension'];

$allowed = array("srt");

if (!in_array(strtolower($ext),$allowed))
die("ERROR: Subtitle format not permitted. Formats allowed: .srt!\n");

$post_fields['subfile'] = "@".$sub_file;
}

$converter = file_get_contents("http://videomega.tv/getconv_uploadapi.php?upload_hash=".$user_token);

if($converter=="ERROR")
die("ERROR: Could not choose converter. Aborting... \n");

$post_fields['vfile'] = "@".$file;
$post_fields['upload'] = "1";
$post_fields ['token'] = 'sdfdsfFFs34676zabc';
if(!empty($user_token))
$post_fields['upload_hash'] = $user_token;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$converter);
curl_setopt($ch, CURLOPT_POST,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result=curl_exec ($ch);
curl_close ($ch);

echo "$result\n";
?>