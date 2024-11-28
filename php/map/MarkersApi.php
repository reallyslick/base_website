<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class googlemarkers {
    
    
    var $markerArray;
    var $queryResult; //Json result always.
    
    function initialize()
    {
        $this->$markerArray = array();
        $this->$queryResult = "";
    }
    
    function executeQueryJson($jsonurl)
    {
        $this->$queryResult = json_decode($jsonurl, true);
    }
    
    function createMarkerFromJson($pathtolat,$pathtolng,$pathtolat,$pathtolat,$pathtolat)
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