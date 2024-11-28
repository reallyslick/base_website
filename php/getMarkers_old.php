<?php

/* it appears this path is relative to the member that called it's path. */
require_once("../config/constants.php");
require_once("../config/mysqlDBAPI.php"); 
require_once('../config/logger.php');

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$filterState;
if(isset($_GET["state"]))
    {$filterState = $_GET["state"];}else{$filterState = "";}
$filterCity;
if(isset($_GET["city"]))
    {$filterCity = $_GET["city"];}else{$filterCity = "";}


$ssc_db = new mysqlDBAPI();
$DB_NAME = CONFIG_DB_NAME;
$ssc_conn = $ssc_db->connect("HTTP", $DB_NAME);
if (!$ssc_conn) {
    die("SSC db connection failed!");
}

$resultArray = array();
    $udSQL = "select * from $DB_NAME.markers where state = '$filterState' and city = '$filterCity'";
    $ssc_db->querymysql($udSQL);
    while ($row = $ssc_db->nextRecord()) {
        //$newArray = array('lat' => $row["lat"], 'lng' => $row["lng"], 'msg'  => $row["msg"], 'title' => $row["title"], 'website' => $row["website"]);
        $name = $row["name"];
        $address = $row["address"];
        $description = $row["description"]; 
        $description = str_replace("point_of_interest","",$description);
        $description = str_replace("  "," ",$description);
        $description = str_replace(" ","/",$description);
        $description = str_replace("_"," ",$description);
        $hiddenContent = '<div class="datahandle" name="'.$name.'" address="'.$address.'" description="'.$description.'"  style="display: none;"></div>';
        $visibleContent = '<div>'.$name.'</div>';
        $msg = $hiddenContent.$visibleContent;
        
        $newArray = array('lat' => $row["lat"], 'lng' => $row["lng"], 'msg'  => $msg, 'title' => $row["title"], 'website' => $row["website"]);
        array_push($resultArray,array("blah" => $newArray));
    }




echo json_encode($resultArray);


?>
