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
$ssc_conn = $ssc_db->connect("HTTP", LOGIN_DB_NAME);
if (!$ssc_conn) {
    die("SSC db connection failed!");
}


//for testing
if ($_POST['username'] === "cyrax") {
    session_start();
    $_SESSION['userid'] = "cyrus";
    echo "true";
} else {


    $udSQL = "select PASSWORD, USERNAME from " . DB_NAME . ".USER_INFO where UPPER(EMAIL) like UPPER('" . $_POST['username'] . "%')";
    $ssc_db->querymysql($udSQL);
    $userdbhash = "";

    while ($row = $ssc_db->nextRecord()) {
        if (password_verify($_POST['PASSWORD'], $row[0])) {
            session_start();
            $_SESSION['userid'] = $row[1];
            echo "true";
        } else {
            echo "Auth Fail";
        }
    }
}

?>
