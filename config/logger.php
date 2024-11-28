<?php
require_once("constants.php");

function writeLog($string) {
    
  //some formatting  
  $string = date("Y-m-d_H:i:s_").$string."\n";
  
  
  //$log_file = LOG_FILE_BASE . '/log.txt.'.date("Y-m-d_H");        
  $log_file = LOG_FILE_BASE . '/log.txt.'.date("Y-m-d");        
  if ($fh = @fopen($log_file, "a+")) {
    fputs($fh, $string, strlen($string));
    fclose($fh);
    return true;
  }
  else {
    return false;
  }
}

?>

