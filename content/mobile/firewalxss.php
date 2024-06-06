<?php

/**
 * Author: Killer
**/

class K_Security {

    /**
     * Loại bỏ ký tự đặc biệt của ID
	 * Fix bug sql injection
     * @param integer $Numeric
     * @return integer
     */
	public function removeSQLI($Numeric){
		$strNumeric = preg_replace('/\D/', '', $Numeric);
		if($strNumeric != 0){
			return $strNumeric;
		}else{
			return false;
		}
	}
	
    /**
     * Loại bỏ thẻ html
	 * Fix bug XSS
     * @param string $Numeric
     * @return string
     */
    public function cleanXSS($string){
		if(get_magic_quotes_gpc()){
			$string = stripslashes($string);
		}
		$string = mysql_real_escape_string($string);
		$string = strip_tags(str_replace(array("alert(\'","\');",), array('',''),$string));
		return $string;
    }
}