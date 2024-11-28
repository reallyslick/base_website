<?php



/*uses google places api to find multiple places*/

/* it appears this path is relative to the member that called it's path. */
require_once("../../config/constants.php");
require_once("../../config/mysqlDBAPI.php"); 
require_once('../../config/logger.php');

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
$filterZip;
if(isset($_GET["zipcode"]))
    {$filterZip = $_GET["zipcode"];}else{$filterZip = "";} 
        
    
$ssc_db = new mysqlDBAPI();
$ssc_conn = $ssc_db->connect("HTTP", CONFIG_DB_NAME);
if (!$ssc_conn) {
    die("SSC db connection failed!");
}


//GLOBALS
$count = 0;

/*
 * 
 * First, Query the google Places url to get the places
 * 

if($filterZip)
{
    $jsonurl = "http://api.geonames.org/postalCodeSearchJSON?postalcode=$filterZip&country=US&username=reallyslick";
    $json = file_get_contents($jsonurl);
    $json = json_decode($json, true);
    //$searchlat = $json["postalCodes"][0]["lat"]; 
    //$searchlng = $json["postalCodes"][0]["lng"]; 
}
else
{
    $tempCity=  str_replace(" ", "+", $filterCity);
    $tempState=  str_replace(" ", "+", $filterState);
    $jsonurl = "http://api.geonames.org/geoCodeAddressJSON?q=$tempCity+$tempState&username=reallyslick";
    $json = file_get_contents($jsonurl);
    $json = json_decode($json, true);
    $searchlat = $json["address"]["lat"]; 
    $searchlng = $json["address"]["lng"]; 
}

 * 
 */    

//or




/*
 * 
 * Use the places api to get the wings in this area
 * 
 */   

$array = array();
$arrayID = array();
$lat = "";
$lng = "";


$queryarray = array();



//The queryarray holds the address to query in the below for loop. the results should be in json format.
//array_push($queryarray,"https://maps.googleapis.com/maps/api/place/textsearch/json?query=wings+Restaurant&sensor=true&location=$searchlat,$searchlng&radius=200&key=AIzaSyD8PYKniHsmvRRngGywq33xHeCNBL8c_8g");
//array_push($queryarray,"https://maps.googleapis.com/maps/api/place/textsearch/json?query=hotwings+Restaurant&sensor=true&location=$searchlat,$searchlng&radius=200&key=AIzaSyD8PYKniHsmvRRngGywq33xHeCNBL8c_8g");
/******
 * 
 * Query #1
 * 
 * This query will search what was provided in a text field. It will grab the lat,lng and search again for wings place in a different way
 * 
 */
    $tempPlace=  str_replace(" ", "+", $filterZip);
    $jsonurl = "https://maps.googleapis.com/maps/api/place/photo?maxwidth=400&photoreference=CmRaAAAAggz3ECLAp_vVipjAaj5xU7zWTQS0JCG_x85tvamX-W5sZMzWDkQuXA05-vxqMvhiVFt--P5Vxklim4ZI7VXCwXCG_YuLmwo_h8Knjx5qsB7XoaC2txlht-8QXwrDAp89EhB0MlhHu4TFm_dHGV-GA4m5GhRNztjB8u93BreZ0bHIfhdvOEQ7Jw&sensor=false&key=AIzaSyD8PYKniHsmvRRngGywq33xHeCNBL8c_8g";
    $remoteImage = $jsonurl;
    $imginfo = getimagesize($remoteImage);
    header("Content-type: {$imginfo['mime']}");
    readfile($remoteImage);
    
    
    
    

    
    
    
    
?>
