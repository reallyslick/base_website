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
$markerid = -1;
 if(isset($_GET["markerid"]))
    {$markerid = $_GET["markerid"];}else{$markerid = "-1";} 
    

        
          
    
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




//if markerid is set have a specific marker to find
$usemarker = false;
$markeraddress = "";
$udSQL = "select address from ".CONFIG_DB_NAME.".markers where id='$markerid';";
$ssc_db->querymysql($udSQL);
while ($row = $ssc_db->nextRecord()) {
    //overwrite filterzip (the term used to search)
   $filterZip = $row["address"];
}






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
    $jsonurl = "https://maps.googleapis.com/maps/api/place/findplacefromtext/json?input=$tempPlace+hot+wings&inputtype=textquery&fields=photos,formatted_address,name,rating,opening_hours,geometry&key=AIzaSyD8PYKniHsmvRRngGywq33xHeCNBL8c_8g";
    $json = file_get_contents($jsonurl);
    $json = json_decode($json, true);

    //If they put a specific place in and there are no results... then fail and exit.
    if($json["status"] == "ZERO_RESULTS")
    {
        echo "failed to find any results";
        exit();
    }
    
    //otherwise, get the lat/lng of the place they searched for. we'll use this lat/lng
    foreach($json["candidates"] as $result)
    {
        if(!in_array($result["formatted_address"],$arrayID))
        {
            //items
            $lat = $result["geometry"]["location"]["lat"];
            $lng = $result["geometry"]["location"]["lng"];
        }
    }
    
    
    
    
    

    
    
    
    
    
    
/******
 * 
 * Query #2
 * 
 * This query will search the lat,lng of the term that was provided in the text field It will grab the lat,lng and search again for wings place in a different way
 * 
 */
    $tempPlace=  str_replace(" ", "+", $filterZip);
    $jsonurl = "https://maps.googleapis.com/maps/api/place/textsearch/json?query=wings+Restaurant&sensor=true&location=$lat,$lng&radius=200&key=AIzaSyD8PYKniHsmvRRngGywq33xHeCNBL8c_8g";
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
                    . '<span class="iw_title">'.$title.'</span><br>'
                    . '<span>Cy\'s Score: ???</span><br>'
                    . '<span>Google Rating: '.$google_rating.' w/ '.$num_google_review.' reviews</span><br>'
                    . '<span>'.$address.'</span><br>'
                  . '</div>';
                    
            //create the ranked view
            $rankSection = "<p class=\"rankSection\" onclick=\"rankSelected('".$address."')\">"
                    . '<span style="font-weight: bold">'.$title.' </span><br>'
                    . '<span>Google Rating: '.$google_rating.' w/ '.$num_google_review.' reviews</span><br>'
                    . ""
                    . ""
                    . ""
                    . ""
                    . "<p>";
            
            $g_rating = $google_rating;
            $g_review = $num_google_review;
            
            
            
            if($google_rating != "??" & $num_google_review != "??")
            {
                /*
                //query and see if we have this in the wingtheory list
                $sql = "select avg(size) as size,"
                        . "avg(crisp) as crisp,"
                        . "avg(num_sauce) as num_sauce,"
                        . "avg(sauce_quality) as sauce_quality,"
                        . "avg(batter) as batter,"
                        . "avg(sauce_amount) as sauce_amount,"
                        . "avg(heat) as heat,"
                        . "avg(location) as location,"
                        . "avg(atmosphere) as atmosphere"
                        . "  from ".CONFIG_DB_NAME.".markers join ".CONFIG_DB_NAME.".reviews on markerid = id where address = '".$result["formatted_address"]."'";
                
                //echo $sql . "\n";
                $ssc_db->querymysql($sql);

                while ($row = $ssc_db->nextRecord()) {
                    $size = $row["size"];
                    $crisp = $row["crisp"];
                    $num_sauce = $row["num_sauce"];
                    $sauce_quality = $row["sauce_quality"];
                    $batter = $row["batter"];
                    $location = $row["location"];
                    $atmosphere = $row["atmosphere"];
                    
                    $sauce_amount = $row["sauce_amount"];
                    $heat = $row["heat"];
                }
                */
                
                //now get the review text
                //query and see if we have this in the wingtheory list
                $count = 1;
                $size = $size = 0;
                $crisp = 0; 
                $num_sauce = 0;
                $location = 0;
                $atmosphere = 0;
                $sauce_quality = 0;
                $sauce_amount = 0;
                $heat = 0;
                $sql = "select r.size as size,"
                        . "r.batter as batter,"
                        . "r.num_sauce as num_sauce,"
                        . "r.sauce_quality as sauce_quality, "
                        . "r.sauce_amount as sauce_amount,"
                        . "r.heat as heat,"
                        . "r.location as location,"
                        . "r.atmosphere as atmosphere,"
                        . "r.review_sauce as review_sauce,"
                        . "r.review_text as review_text,"
                        . "r.registered_dtts as registered_dtts from ".CONFIG_DB_NAME.".markers m join ".CONFIG_DB_NAME.".reviews r on markerid = id where address = '".$result["formatted_address"]."' order by r.registered_dtts desc";
                
                //echo $sql . "\n";
                $ssc_db->querymysql($sql);

                $review_array = array();
                while ($row = $ssc_db->nextRecord()) {
                    
                    array_push($review_array, array(
                        'review_sauce' => $row["review_sauce"],
                        'review_text' => $row["review_text"],
                        'registered_dtts' => $row["registered_dtts"],
                        'size' => $row["size"],
                        'crisp' => $row["batter"],
                        'num_sauce' => $row["num_sauce"],
                        'location' => $row["location"],
                        'atmosphere' => $row["atmosphere"],
                        'sauce_quality' => $row["sauce_quality"],
                        'sauce_amount' => $row["sauce_amount"],
                        'heat' => $row["heat"]));
                    
                    $size = $size + $row["size"];
                    $crisp = $crisp + $row["batter"];
                    $num_sauce = $num_sauce + $row["num_sauce"];
                    $location = $location + $row["location"];
                    $atmosphere = $atmosphere + $row["atmosphere"];
                    $sauce_quality = $sauce_quality + $row["sauce_quality"]; 
                    $sauce_amount = $sauce_amount + $row["sauce_amount"];
                    $heat = $heat + $row["heat"];
                    $count=$count;
               }
                //echo $count;
                //if(in_array($result["formatted_address"],$array))
                {
                    array_push($array, array(
                    'id' => $count,
                    'lat' => $result["geometry"]["location"]["lat"],
                    'lng' => $result["geometry"]["location"]["lng"],
                    'address' => $result["formatted_address"],
                    'open_now' => isset( $result["opening_hours"]["open_now" ]) ? $result["opening_hours"]["open_now"] : "not sure",
                    'title' => $result["name"],
                    'msg' => $tmpmsg,
                    'g_rating' => $g_rating,
                    'g_review' => $g_review,
                    'rank' =>      $rankSection,
                    'twt_size' =>       $size/$count, //are the wings big?
                    'twt_crisp' =>      $crisp/$count, //
                    'twt_num_sauce' =>  $num_sauce/$count, //do they have a big selection of sauces, or just the standard cut?
                    'twt_sauce_quality' => $sauce_quality/$count, //whats the place like  
                    'twt_batter'=> $crisp/$count,
                    'twt_sauce_amount' => $sauce_amount/$count, //whats the place like 
                    'twt_heat' =>       $heat/$count, //when they say hot, HOW hot?
                    'twt_location' =>   $location/$count,     //is the location of the place outside the city or inside the city near other fun stuff
                    'twt_atmosphere' => $atmosphere/$count, //whats the place like 
                    'twt_reviews' => $review_array,
                    
                    ));
                }
            }
            
           
        
            //adds it to the arrayID so that we don't add it again later 
            array_push($arrayID, $result["place_id"]);
        }
        
        
    }
    
    
    

    
    
    
    
    /******
 * 
 * Query #3
 * 
 * This is the last item in the query, making it the last item in the return json. The last item is what google maps will focus on 
 * 
 */
    
    
    //$tempPlace=  str_replace(" ", "+", $filterZip);
    $jsonurl = "https://maps.googleapis.com/maps/api/place/textsearch/json?query=$tempPlace&sensor=true&key=AIzaSyD8PYKniHsmvRRngGywq33xHeCNBL8c_8g";
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
                    . '<span class="iw_title">'.$title.'</span><br>'
                    . '<span>Cy\'s Rating: ???</span><br>'
                    . '<span>Google Rating: '.$google_rating.' w/ '.$num_google_review.' reviews</span><br>'
                    . '<span>'.$address.'</span><br>'
                  . '</div>';
                    
            //create the ranked view
            $rankSection = "<p class=\"rankSection\" onclick=\"rankSelected('".$address."')\">"
                    . '<span style="font-weight: bold">'.$title.' </span><br>'
                    . '<span>Google Rating: '.$google_rating.' w/ '.$num_google_review.' reviews</span><br>'
                    . ""
                    . ""
                    . ""
                    . ""
                    . "<p>";
            
            $g_rating = $google_rating;
            $g_review = $num_google_review;
            
            
            
            //if($google_rating != "??" & $num_google_review != "??")
            {
                /*//alert("Hello");
                //query and see if we have this in the wingtheory list
                $sql = "select avg(size) as size,"
                        . "avg(batter) as batter,"
                        . "avg(num_sauce) as num_sauce,"
                        . "avg(sauce_quality) as sauce_quality,"
                        . "avg(sauce_amount) as sauce_amount,"
                        . "avg(heat) as heat,"
                        . "avg(location) as location,"
                        . "avg(atmosphere) as atmosphere"
                        . "  from ".CONFIG_DB_NAME.".markers join ".CONFIG_DB_NAME.".reviews on markerid = id where address = '".$result["formatted_address"]."'";
                
                //echo $sql . "\n";
                $ssc_db->querymysql($sql);

                while ($row = $ssc_db->nextRecord()) {
                    $size = $row["size"];
                    $crisp = $row["batter"];
                    $num_sauce = $row["num_sauce"];
                    $location = $row["location"];
                    $atmosphere = $row["atmosphere"];
                    $sauce_quality = $row["sauce_quality"];
                    $sauce_amount = $row["sauce_amount"];
                    $heat = $row["heat"];
                }
                */
                 //now get the review text
                //query and see if we have this in the wingtheory list
                $count = 0;
                $sql = "select r.size as size,"
                        . "r.batter as batter,"
                        . "r.num_sauce as num_sauce,"
                        . "r.sauce_quality as sauce_quality, "
                        . "r.sauce_amount as sauce_amount,"
                        . "r.heat as heat,"
                        . "r.location as location,"
                        . "r.atmosphere as atmosphere,"
                        . "r.review_sauce as review_sauce,"
                        . "r.review_text as review_text,"
                        . "r.registered_dtts as registered_dtts from ".CONFIG_DB_NAME.".markers m join ".CONFIG_DB_NAME.".reviews r on markerid = id where address = '".$result["formatted_address"]."' order by r.registered_dtts asc";
                
                //echo $sql . "\n";
                $ssc_db->querymysql($sql);

                $review_array = array();
                while ($row = $ssc_db->nextRecord()) {
                    
                    array_push($review_array, array(
                        'review_sauce' => $row["review_sauce"],
                        'review_text' => $row["review_text"],
                        'registered_dtts' => $row["registered_dtts"],
                        'size' => $row["size"],
                        'crisp' => $row["batter"],
                        'num_sauce' => $row["num_sauce"],
                        'location' => $row["location"],
                        'atmosphere' => $row["atmosphere"],
                        'sauce_quality' => $row["sauce_quality"],
                        'sauce_amount' => $row["sauce_amount"],
                        'heat' => $row["heat"]));
                    
                    $size = $size + $row["size"];
                    $crisp = $crisp + $row["batter"];
                    $num_sauce = $num_sauce + $row["num_sauce"];
                    $location = $location + $row["location"];
                    $atmosphere = $atmosphere + $row["atmosphere"];
                    $sauce_quality = $sauce_quality + $row["sauce_quality"]; 
                    $sauce_amount = $sauce_amount + $row["sauce_amount"];
                    $heat = $heat + $row["heat"];
                    $count++;
               }
                
                
                //if(in_array($result["formatted_address"],$array))
                {
                    array_push($array, array(
                    'id' => $count++,
                    'lat' => $result["geometry"]["location"]["lat"],
                    'lng' => $result["geometry"]["location"]["lng"],
                    'address' => $result["formatted_address"],
                    'open_now' => isset( $result["opening_hours"]["open_now" ]) ? $result["opening_hours"]["open_now"] : "not sure",
                    'title' => $result["name"],
                    'msg' => $tmpmsg,
                    'g_rating' => $g_rating,
                    'g_review' => $g_review,
                    'rank' =>      $rankSection,
                    'twt_size' =>       $size/$count, //are the wings big?
                    'twt_crisp' =>      $crisp/$count, //
                    'twt_num_sauce' =>  $num_sauce/$count, //do they have a big selection of sauces, or just the standard cut?
                    'twt_sauce_quality' => $sauce_quality/$count, //whats the place like  
                    'twt_batter'=> $crisp/$count,
                    'twt_sauce_amount' => $sauce_amount/$count, //whats the place like 
                    'twt_heat' =>       $heat/$count, //when they say hot, HOW hot?
                    'twt_location' =>   $location/$count,     //is the location of the place outside the city or inside the city near other fun stuff
                    'twt_atmosphere' => $atmosphere/$count, //whats the place like 
                    'twt_reviews' => $review_array,
                    
                    ));
                }
            }
            
           
        
            //adds it to the arrayID so that we don't add it again later 
            array_push($arrayID, $result["place_id"]);
        }
        
        
    }
    
    
    
    
    echo json_encode($array);
    exit();
    
    
    
    
    

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
/******
 * 
 * UNUSED, there is an EXIT above!
 * 
 * This is the last item in the query, making it the last item in the return json. The last item is what google maps will focus on 
 * 
 */
    $tempPlace=  str_replace(" ", "+", $filterZip);
    $jsonurl = "https://maps.googleapis.com/maps/api/place/findplacefromtext/json?input=$tempPlace+hot+wings&inputtype=textquery&fields=photos,formatted_address,name,rating,opening_hours,geometry&key=AIzaSyD8PYKniHsmvRRngGywq33xHeCNBL8c_8g";
    $json = file_get_contents($jsonurl);
    $json = json_decode($json, true);

    foreach($json["candidates"] as $result)
    {
        
        if(!in_array($result["formatted_address"],$arrayID))
        {
            //items
            $lat = $result["geometry"]["location"]["lat"];
            $lng = $result["geometry"]["location"]["lng"];
            
            $address = $result["formatted_address"];
            $open_now = isset( $result["opening_hours"]["open_now" ]) ? $result["opening_hours"]["open_now"] : "??";
            $num_google_review = isset( $result["user_ratings_total"]) ? $result["user_ratings_total"] : "??"; 
            $google_rating = isset( $result["rating"]) ? $result["rating"] : "??";  
            $title = $result["name"];
            
            //verify duplicae
            $id = array_search($result["formatted_address"], array_column($array,'address'));
            
            //create the info window
            $tmpmsg = '<div>'
                    . '<span class="iw_title">'.$title.'</span><br>'
                    . '<span>TWT Rating: ???</span><br>'
                    . '<span>Google Rating: '.$google_rating.' w/ '.$num_google_review.' reviews</span><br>'
                    . '<span>'.$address.'</span><br>'
                    . '<span class="iw_address">'.$address.'</span><br>'
                    . '<div id="iw_chart_'.$count.'" class=""></div><br>'
                  . '</div>';
            
                        //create the ranked view
            $rankSection = "<p class=\"rankSection\">"
                    . '<span style="font-weight: bold" >'.$title.' ss</span><br>'
                    . '<span>Google Rating: '.$google_rating.' w/ '.$num_google_review.' reviews</span><br>'
                    . ""
                    . ""
                    . ""
                    . ""
                    . "<p>";        
            
            //if it is not a valid result it should have no google reviews
                        
            $g_rating = $google_rating;
            $g_review = $num_google_review;
            

            
            if($google_rating != "??")
            {
                //if(in_array($result["formatted_address"],$array))
                {
                    array_push($array, array(
                    'id' => $count++,
                    'lat' => $result["geometry"]["location"]["lat"],
                    'lng' => $result["geometry"]["location"]["lng"],
                    'address' => $result["formatted_address"],
                    'open_now' => isset( $result["opening_hours"]["open_now" ]) ? $result["opening_hours"]["open_now"] : "not sure",
                    'title' => $result["name"],
                    'msg' => $tmpmsg,
                    'g_rating' => $g_rating,
                    'g_review' => $g_review,
                    'rank' =>      $rankSection,
                    'twt_crisp' =>      "3", //
                    'twt_atmosphere' =>      "3", //whats the place like
                    'twt_size' =>      "3", //are the wings big?
                    'twt_location' =>      "3",     //is the location of the place outside the city or inside the city near other fun stuff
                    'twt_heat' =>      "3", //when they say hot, HOW hot?
                    'twt_num_sauce' =>      "3", //do they have a big selection of sauces, or just the standard cut?
                    'twt_price' =>      "5", //do they have a big selection of sauces, or just the standard cut?    
                    ));
                }
            }
            
            //adds it to the arrayID so that we don't add it again later 
            array_push($arrayID, $result["formatted_address"]);
        }
        
        
    }
    
    
    


echo json_encode($array);

?>
