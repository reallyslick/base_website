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
 * STATE Filter
 * 
 */
    $udSQL = "select distinct state from markers";
    echo $udSQL;
    $ssc_db->querymysql($udSQL);
    $select = '<select class="ui-button ui-widget ui-corner-all">';
    while ($row = $ssc_db->nextRecord()) {
        $state = $row["state"];
        $select = $select."<option value=\"$state\">$state</option>";
    }
$select = $select."</select>";
array_push($resultArray,["state" => $select]);


/*****************
 * 
 * 
 * CITY Filter
 * 
 */
    $udSQL = "select distinct CITY from $DB_NAME.markers";
    $ssc_db->querymysql($udSQL);
    $select = '<select class="ui-button ui-widget ui-corner-all">';
    while ($row = $ssc_db->nextRecord()) {
        $select = $select."<option>".$row["CITY"]."</option>";
    }
$select = $select."</select>";
array_push($resultArray,["city" => $select]);



/*****************
 * 
 * 
 * Sauce Filter
 * 
 */
    $udSQL = "select distinct review_sauce from $DB_NAME.reviews";
    $ssc_db->querymysql($udSQL);
    $select = '<select class="ui-button ui-widget ui-corner-all">';
    while ($row = $ssc_db->nextRecord()) {
        $state = $row["review_sauce"];
        $select = $select."<option value=\"$state\">$state</option>";
    }
$select = $select."</select>";
array_push($resultArray,["review_sauce" => $select]);

echo json_encode($resultArray);


?>
