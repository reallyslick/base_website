<?php

require_once("../config/constants.php");
require_once("../config/mysqlDBAPI.php"); 
require_once("../config/logger.php");  
require_once("password.php"); 


/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$ssc_db = new mysqlDBAPI();
$ssc_conn = $ssc_db->connect("HTTP", CONFIG_DB_NAME);
if (!$ssc_conn) {
    die("SSC db connection failed!");
}



$udSQL = "select * from ".DB_NAME.".USER_INFO where UPPER(EMAIL) = UPPER('".$_POST['EMAIL']."')";
$ssc_db->querymysql($udSQL);
$udSQL = "insert into ".DB_NAME.".USER_INFO(FIRST, LAST, EMAIL, PASSWORD) values ('".$_POST['FIRST']."','".$_POST['LAST']."','".$_POST['EMAIL']."','')";
while ($row = $ssc_db->nextRecord()) {
    $udSQL = "";
}

if($udSQL === "")
{
    echo $_POST['EMAIL'];
    echo "Email already exist.";
}
else
{
    $hash = password_hash($_POST['PASSWORD'], PASSWORD_DEFAULT);

    $udSQL = "insert into ".DB_NAME.".USER_INFO(FIRST, LAST, EMAIL, PASSWORD) values ('".$_POST['FIRST']."','".$_POST['LAST']."','".$_POST['EMAIL']."','".$hash."')";
    $ssc_db->querymysql($udSQL);

    if (password_verify($_POST['PASSWORD'], $hash)) {
        echo "Created!";
    }

}




?>
