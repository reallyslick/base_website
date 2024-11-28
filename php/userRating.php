<?php



/*uses google places api to find multiple places*/

/* it appears this path is relative to the member that called it's path. */
require_once("../config/constants.php");
require_once("../config/mysqlDBAPI.php");
require_once("../config/logger.php");

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$marker_lat = "";
if(isset($_GET["marker_lat"])){$marker_lat = $_GET["marker_lat"];}else{$marker_lat = "";}
$marker_lng = "";
if(isset($_GET["marker_lng"])){$marker_lng = $_GET["marker_lng"];}else{$marker_lng = "";}
$marker_name = "";
if(isset($_GET["marker_name"])){$marker_name = $_GET["marker_name"];}else{$marker_name = "";}
$marker_address = "";
if(isset($_GET["marker_address"])){$marker_address = $_GET["marker_address"];}else{$marker_address = "";}

$wingsize = "";
if(isset($_GET["wingsize"])){$wingsize = $_GET["wingsize"];}else{$wingsize = "";}
$numsauce = "";
if(isset($_GET["numsauce"])){$numsauce = $_GET["numsauce"];}else{$numsauce = "";}
$saucequality = "";
if(isset($_GET["saucequality"])){$saucequality = $_GET["saucequality"];}else{$saucequality = "";}
$batter = "";
if(isset($_GET["batter"])){$batter = $_GET["batter"];}else{$batter = "";}
$wet = "";
if(isset($_GET["wet"])){$wet = $_GET["wet"];}else{$wet = "";}
$heat = "";
if(isset($_GET["heat"])){$heat = $_GET["heat"];}else{$heat = "";}
$location = "";
if(isset($_GET["location"])){$location = $_GET["location"];}else{$location = "";}
$atmosphere = "";
if(isset($_GET["atmosphere"])){$atmosphere = $_GET["atmosphere"];}else{$atmosphere = "";}
$review_text = "";
if(isset($_GET["review_text"])){$review_text = $_GET["review_text"];}else{$review_text = "";}

        
    
$ssc_db = new mysqlDBAPI();
$ssc_conn = $ssc_db->connect("HTTP", CONFIG_DB_NAME);
if (!$ssc_conn) {
    die("SSC db connection failed!");
}


//find the markerid, if it doesn't exist, create it.
$sql = "select id from ".CONFIG_DB_NAME.".markers where address = '$marker_address'";
//echo $sql . "\n";
 $ssc_db->querymysql($sql);
 
$markerid = "";
while ($row = $ssc_db->nextRecord()) {
      $markerid = $row["id"];
}

if($markerid == "")
{
    
    $sql = "insert into ".CONFIG_DB_NAME.".markers (lat, lng, name, title, msg, address, registered_dtts) values"
        . "("
        . "'$marker_lat',"
        . "'$marker_lng',"
        . "'$marker_name',"    
        . "'$marker_name',"        
        . "'',"     
        . "'$marker_address',"
         . "now()"
        . ")";
    //echo $sql . "\n";
    $ssc_db->querymysql($sql);
}

//insert new rating history
$sql = "insert into ".CONFIG_DB_NAME.".reviews (markerid, size, crisp, num_sauce, sauce_quality, batter, sauce_amount, heat, location, atmosphere, review_text, registered_dtts) values"
        . "("
        . "'$markerid',"
        . "'$wingsize',"
        . "'0',"
        . "'$numsauce',"    
        . "'$saucequality',"        
        . "'$batter',"    
        . "'$wet',"    
        . "'$heat',"
        . "'$location',"
        . "'$atmosphere',"
        . "'$review_text',"
        . "now()"
        . ")";

//echo $sql . "\n";

$ssc_db->querymysql($sql);
//calculate new rating for marker and update

$result=Array();

array_push($result,"success");

echo json_encode($result);


?>
