<?php

/* it appears this path is relative to the member that called it's path. */
require_once("../config/constants.php");
require_once("../config/mysqlDBAPI.php"); 
require_once('../config/logger.php');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$ssc_db = new mysqlDBAPI();
$DB_NAME = CONFIG_DB_NAME;
$ssc_conn = $ssc_db->connect("HTTP", $DB_NAME);
if (!$ssc_conn) {
    die("SSC db connection failed!");
}

$resultArray = array();





/*****************
 * 
 * 
 * random marker
 * 
 */
    $markerid = "";
    $name = "";
    $udSQL = "select distinct markerid, name  from $DB_NAME.reviews r join $DB_NAME.markers m on r.markerid = m.id order by rand() limit 1";
    $ssc_db->querymysql($udSQL);
    while ($row = $ssc_db->nextRecord()) {
       $markerid = $row["markerid"];
       $name = $row["name"];
    }
    array_push($resultArray,["id" =>  $markerid]);
    array_push($resultArray,["name" =>  $name]);



echo json_encode($resultArray);


?>
