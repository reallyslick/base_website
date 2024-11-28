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
        
    


/*
 * 
 * First, Query the google Places url to get the places
 * 
 * 
 */    

if($filterZip)
{
    $jsonurl = "http://api.geonames.org/postalCodeSearchJSON?postalcode=$filterZip&country=US&username=reallyslick";
    $json = file_get_contents($jsonurl);
    $json = json_decode($json, true);
    $searchlat = $json["postalCodes"][0]["lat"]; 
    $searchlng = $json["postalCodes"][0]["lng"]; 
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


//or




/*
 * 
 * Use the places api to get the wings in this area
 * 
 */   

$array = array();
$arrayID = array();


$queryarray = array();

//The queryarray holds the address to query in the below for loop. the results should be in json format.
//array_push($queryarray,"https://maps.googleapis.com/maps/api/place/textsearch/json?query=wings+Restaurant&sensor=true&location=$searchlat,$searchlng&radius=200&key=AIzaSyD8PYKniHsmvRRngGywq33xHeCNBL8c_8g");
//array_push($queryarray,"https://maps.googleapis.com/maps/api/place/textsearch/json?query=hotwings+Restaurant&sensor=true&location=$searchlat,$searchlng&radius=200&key=AIzaSyD8PYKniHsmvRRngGywq33xHeCNBL8c_8g");
array_push($queryarray,"https://maps.googleapis.com/maps/api/place/findplacefromtext/json?input=Wingsup%20Austin&inputtype=textquery&fields=photos,formatted_address,name,rating,opening_hours,geometry&key=AIzaSyD8PYKniHsmvRRngGywq33xHeCNBL8c_8g");

foreach($queryarray as $jsonurl)
{
    $json = file_get_contents($jsonurl);
    $json = json_decode($json, true);

    foreach($json["results"] as $result)
    {

        if(!in_array($result["place_id"],$arrayID))
        {
            //items
            $lat = $result["geometry"]["location"]["lat"];
            $lng = $result["geometry"]["location"]["lng"];
            
            $address = $result["formatted_address"];
            $open_now = isset( $result["opening_hours"]["open_now" ]) ? $result["opening_hours"]["open_now"] : "dunno";
            $num_google_review = isset( $result["user_ratings_total"]) ? $result["user_ratings_total"] : "dunno"; 
            $google_rating = isset( $result["rating"]) ? $result["rating"] : "dunno";  
            $title = $result["name"];
            
            //create the info window
            $tmpmsg = '<div>'
                    . '<span>'.$title.'</span><br>'
                    . '<span>TWT Rating: ???</span><br>'
                    . '<span>Google Rating: '.$google_rating.' w/ '.$num_google_review.' reviews</span><br>'
                    . '<span>'.$address.'</span><br>'
                  . '</div>';
                    
            
            array_push($array, array(
            'lat' => $result["geometry"]["location"]["lat"],
            'lng' => $result["geometry"]["location"]["lng"],
            'address' => $result["formatted_address"],
            'open_now' => isset( $result["opening_hours"]["open_now" ]) ? $result["opening_hours"]["open_now"] : "not sure",
            'title' => $result["name"],
            'msg' => $tmpmsg
            ));
            
            //create the ranked view
            $rankSection = "<p>"
                    . "Name: " . $result["name"]
                    . ""
                    . ""
                    . ""
                    . ""
                    . ""
                    . "<p>";
        
            //adds it to the arrayID so that we don't add it again later 
            array_push($arrayID, $result["place_id"]);
        }
        
        
    }
}

echo json_encode($array);

?>
