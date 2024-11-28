<?php

/* it appears this path is relative to the member that called it's path. */
require_once("../config/constants.php");
require_once("../config/mysqlDBAPI.php"); 
require_once('../config/logger.php');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$name="";
$state="";
$city="";
$address="";
$lat="";
$lng="";
$description="";
if(isset($_GET["name"]))
    {$name = $_GET["name"];}else{echo "name not sent"; exit(0);}
    $name = str_replace("'","",$name);
    $name = str_replace("%","\%",$name);
    $name = str_replace(";","\;",$name);
    $name = str_replace(")","\)",$name);
    $name = str_replace("(","\(",$name);
    $name = str_replace("\"","\\\"",$name);
if(isset($_GET["state"]))
    {$state = $_GET["state"];}else{echo "state not sent"; exit(0);}
if(isset($_GET["city"]))
    {$city = $_GET["city"];}else{echo "city not sent"; exit(0);}
if(isset($_GET["address"]))
    {$address = $_GET["address"];}else{echo "address not sent"; exit(0);}
if(isset($_GET["lat"]))
    {$lat = $_GET["lat"];}else{echo "lat not sent"; exit(0);}
if(isset($_GET["lng"]))
    {$lng = $_GET["lng"];}else{echo "lng not sent"; exit(0);} 
if(isset($_GET["description"]))
    {$description = $_GET["description"];}else{echo "description not sent"; exit(0);} 

$ssc_db = new mysqlDBAPI();
$DB_NAME = CONFIG_DB_NAME;
$ssc_conn = $ssc_db->connect("HTTP", $DB_NAME);
if (!$ssc_conn) {
    die("SSC db connection failed!");
}

$udSQL = "select name from $DB_NAME.markers where address = '$address'";
$found = false;
$ssc_db->querymysql($udSQL);
while ($row = $ssc_db->nextRecord()) {
    echo "this place already exists as " . $row["name"];
    exit(0);
}

$resultArray = array();
    $udSQL = "insert into $DB_NAME.markers(name, state, city, address, lat, lng, description) values ('$name', '$state', '$city','$address','$lat','$lng','$description')";
    echo $udSQL . "\n";
    $ssc_db->querymysql($udSQL);



?>
