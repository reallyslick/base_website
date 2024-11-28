/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var map; // global used for the map
var markers = new Array(); //cache markers that are queried
map_marker_table_index = 0;
var marker_lat = "";
var marker_lng = "";
var marker_name = "";
var marker_address = "";
var table;
        
        




$(document).ready(function() {
    
    $(".sbsarea").hide();
    
            //create the datatable
            table = $("#ranktable").DataTable({
                "data": [],
                "paging": false,
                "select": true,
                "language": {
                    "search": "Find:"
                  },
                  "bInfo" : false,
                "columnDefs": [
                               { "visible": false, "targets": 0}, 
                                {"visible": true, "targets": 1}, //title
                                {"visible": false, "targets": 2}, //address
                                {"visible": true, "targets": 3}, //rating
                                {"visible": true, "targets": 4}, //review
                                {"visible": false, "targets": 5}, //open_now
                                {"visible": true, "targets": 6}, //chart
                                {"visible": false, "targets": 7}, //lat
                                {"visible": false, "targets": 8}, //lng
                                {"visible": false, "targets": 9}, //msg
                                {"visible": false, "targets": 10}, //twt_atmosphere
                                {"visible": false, "targets": 11}, //twt_crisp
                                {"visible": false, "targets": 12}, //twt_heat
                                {"visible": false, "targets": 13}, //twt_location
                                {"visible": false, "targets": 14}, //twt_num_sauce
                                {"visible": false, "targets": 15}, //twt_sauce_amount
                                {"visible": false, "targets": 16}, //twt_sauce_quality
                                {"visible": false, "targets": 17}, //twt_size 
                                {"visible": false, "targets": 18}, //twt_size 
                                {"visible": false, "targets": 19}, //reviews 
                              ]
        });
        

        $("#sort_content").dialog({
            autoOpen  : false,
            modal     : true,
            title     : "Order",
            buttons   : {
                      'OK' : function() {
                          var items = $("#sortSelect").select2('val');
                          var sortArray = Array();
                          for(var i = 0; i < items.length; i++)
                          {
                              sortArray.push([items[i],'desc'])
                          }
                          table.order( sortArray ).draw();
                          $(this).dialog('close');
                          //Now you have the value of the textbox, you can do something with it, maybe an AJAX call to your server!
                      },
                      'Close' : function() {
                          $(this).dialog('close');
                          
                      }
                        }
        });
        
        $("#sortSelect").select2({
                theme: "classic",
                width: '200px',
                closeOnSelect: false
            });
    
});
   
  function order()
  {
      
     $("#sort_content").dialog("open");
      
      
  }

   
function initMap() {
    var mapOptions = {
        zoom: 4,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        center: new google.maps.LatLng(39, -90)
    };
    map = new google.maps.Map(document.getElementById('map'), mapOptions);
}


//this gets called when the marker is clicked
 var bindInfoWindow = function (marker, map, infowindow, html) {
        google.maps.event.addListener(marker, 'click', function (event) {
            infowindow.setContent(html);
            infowindow.open(map, marker);
            bindInfoWindow_callback(html);
            //move the chart to it's box
            var data = table.row(marker.get("id")).data();
            //alert(data[12] + " " +data[17] +" " +data[18] + " " +data[16] + " " +data[13] + " " +data[11] + " " +data[17] + " " );
            //size,crisp,num_sauce,sauce_quality,batter, sauce_amount,heat,location,atmosphere
            //alert(Number(data[19])+ " " +  Number(data[13])+ " " +  Number(data[16])+ " " +  Number(data[18])+ " " +  Number(data[12])+ " " +  Number(data[17])+ " " +  Number(data[14])+ " " +  Number(data[15])+ " " +  Number(data[11]));
            map_marker_table_index = data[0];
            map_marker_lat = data[7];
            map_marker_lng = data[8];
            
            map_marker_name = data[1];
            map_marker_address = data[2];
            map_marker_address = data[2];
            $("#reviewedname").html(map_marker_name);
            makeCompletenessChart("twt_map", Number(data[10]), Number(data[11]), Number(data[12]), Number(data[13]), Number(data[14]), Number(data[15]), Number(data[16]), Number(data[17]), Number(data[18]));
        });
    }

var bindInfoWindow_callback = function(html){
    alert("Result: " + html);
};
function set_bindInfoWindow_callback(successFunction){
    bindInfoWindow_callback = successFunction;
}

/*
function addMarkers() {
    
    
    //reset markers
    DeleteMarkers();
    
    //ajax call details
    var url =  "./php/getMarkers.php"
    var data = {username : "username", PASSWORD : "blah"}
    var success = function (data, i) 
    {

          var infowindow = new google.maps.InfoWindow({
            content: ''
        });
        //create the marker variable
        var marker = null;
        //for each coordinate, create a marker
         $.each(data, function (i, dt) {
            var msg = dt.msg
            var title = dt.title
            tmpLatLng = new google.maps.LatLng(dt.lat, dt.lng);
            marker = new google.maps.Marker({
                map: map,
                position: tmpLatLng,
                title: title
            });
            //bind the info window data
            bindInfoWindow(marker, map, infowindow, msg);
            //Add marker to the array.
            markers.push(marker);
        });      
                    

        //focus map on the coordinate of the last marker created
        if(marker)
        {
            map.panTo(marker.getPosition())
        }
        

    }
    var error = function(){
       // alert("I failed!");
    }
    
    
    //see above details
    $.ajax({
      dataType: "json",
      url: url,
      data: data,
      success: success,
      error: error
    });
};
*/

//shows single marker, given coordinates
function setMarkers(lat, lng) {
    
    //reset markers
    DeleteMarkers();
    marker = new google.maps.Marker({
        map: map,
        position: new google.maps.LatLng(lat, lng),
        title: "title blah"
    });
    
    //focus map on the coordinate of the last marker created
    if(marker)
    {
        map.panTo(marker.getPosition())
    }

};

function sortJSON(data, key, way) {
    return data.sort(function(a, b) {
        var x = a[key]; var y = b[key];
        if (way === '123' ) { return ((x < y) ? -1 : ((x > y) ? 1 : 0)); }
        if (way === '321') { return ((x > y) ? -1 : ((x < y) ? 1 : 0)); }
    });
}



function similarity(s1, s2) {
  var longer = s1;
  var shorter = s2;
  if (s1.length < s2.length) {
    longer = s2;
    shorter = s1;
  }
  var longerLength = longer.length;
  if (longerLength == 0) {
    return 1.0;
  }
  return (longerLength - editDistance(longer, shorter)) / parseFloat(longerLength);
}
function editDistance(s1, s2) {
  s1 = s1.toLowerCase();
  s2 = s2.toLowerCase();

  var costs = new Array();
  for (var i = 0; i <= s1.length; i++) {
    var lastValue = i;
    for (var j = 0; j <= s2.length; j++) {
      if (i == 0)
        costs[j] = j;
      else {
        if (j > 0) {
          var newValue = costs[j - 1];
          if (s1.charAt(i - 1) != s2.charAt(j - 1))
            newValue = Math.min(Math.min(newValue, lastValue),
              costs[j]) + 1;
          costs[j - 1] = lastValue;
          lastValue = newValue;
        }
      }
    }
    if (i > 0)
      costs[s2.length] = lastValue;
  }
  return costs[s2.length];
} // used with similarity



var bounds;
//similar to add markers but with filters
function filterMarkers(state,city,zipcode,id) {
    
    
            
    
    //reset markers
    DeleteMarkers();
    
    //reset boungds
    bounds  = new google.maps.LatLngBounds();
        
    var markerFound = false;
    //ajax call details
    var url =  "./php/map/getMarkers.php"
    var data = {state : state, city : city, zipcode : zipcode, markerid : id}
    var success = function (data) 
    {
        $('#searchwings').prop('value', 'Search For Wings'); 
        $('#order').prop("disabled",false);
        $('.searchbutton').prop("disabled",false);
        
          var infowindow = new google.maps.InfoWindow({
            content: ''
        });
        //create the marker variable
        var marker = null;
        var bestMatchMarker = null;
        var bestMatchSimilarity = 0;
        
        var originalResult = data;
                
        //reset table
        table.clear();

        var count = 0;
        //for each coordinate, create a marker
         $.each(originalResult, function (i, dt) {
             
             
             markerFound = true;
             
             
             //alert(i);
            var id=dt.id;
            var msg = dt.msg;
            var title = dt.title;
            var g_rating = dt.g_rating;
            var g_review = dt.g_review;
            var rank = dt.rank;
            var address = dt.address;
            var lat= dt.lat;
            var lng= dt.lng;
            var open_now = dt.open_now;
            var twt_crisp = dt.twt_crisp ? dt.twt_crisp : 0;
            var twt_size = dt.twt_size ? dt.twt_size : 0;
            var twt_location = dt.twt_location ? dt.twt_location : 0;
            var twt_atmosphere = dt.twt_atmosphere ? dt.twt_atmosphere : 0;
            var twt_heat = dt.twt_heat ? dt.twt_heat : 0;
            var twt_num_sauce = dt.twt_num_sauce ? dt.twt_num_sauce : 0;  
            var twt_price = dt.twt_price ? dt.twt_price : 0;
            var twt_sauce_amount = dt.twt_sauce_amount ? dt.twt_sauce_amount : 0; 
            var twt_sauce_quality = dt.twt_sauce_quality ? dt.twt_sauce_quality : 0;
            var twt_batter = dt.twt_batter ? dt.twt_batter : 0;
            var twt_reviews = dt.twt_reviews ? dt.twt_reviews : "blah";
            

            
            //debug
            
            
            //add a row to the table with the data
            table.row.add([
                i,
                title,
                address,
                g_rating,
                g_review,
                open_now ? "Open" : "Closed",
                "<div class=\"rankcontainer\" id=\"container" + i + "\"></div>",
                lat,
                lng,
                msg,
                twt_size,
                twt_crisp,
                twt_num_sauce,
                twt_sauce_quality,
                twt_batter,
                twt_sauce_amount,
                twt_heat,
                twt_location,
                twt_atmosphere,
                twt_reviews,
                
            ]).draw(false);
            
            //size,crisp,num_sauce,sauce_quality,batter, sauce_amount,heat,location,atmosphere
            
            makeCompletenessChart("container" + i, twt_size, twt_crisp, twt_num_sauce, twt_sauce_quality, twt_batter, twt_sauce_amount, twt_heat, twt_location, twt_atmosphere);
           
             
             //create the chart for that row
            

            tmpLatLng = new google.maps.LatLng(dt.lat, dt.lng);
            marker = new google.maps.Marker({
                map: map,
                position: tmpLatLng,
                title: title,
                id: i
            });
            
            //similary of query vs marker title
            //alert(zipcode + " : " + title + " = "  + similarity(title, zipcode));
            var percentSim = similarity(title,zipcode )
            if(percentSim > bestMatchSimilarity)
            {
                bestMatchSimilarity = percentSim;
                bestMatchMarker = marker;
            }
            
            //bind the info window data
            //msg = msg.replace("INFO_WINDOW_CHANGE_ME","blah");
            bindInfoWindow(marker, map, infowindow, msg);
            
            //add to bounds
            loc = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
            bounds.extend(loc);
            
            //Add marker to the array.
            markers[i] = marker;
            
            
            
            
        });       

            
    
        

        //focus map on the coordinate of the last marker created
        
        if(markerFound)
        {
            
            //map.setZoom(17);
            map.panTo(bestMatchMarker.position);
            map.panTo(bestMatchMarker.position);
            
            //open the marker of the list item.. this is most likely item they searched for
            new google.maps.event.trigger( bestMatchMarker, 'click' );
            
            //last pan to bounds
            map.fitBounds(bounds);       // auto-zoom
            map.panToBounds(bounds);     // auto-center
            
        }
        
            $("#ranktable tbody tr").dblclick(function(){
                 
                 map.setZoom(17); //higher number, higher zoom
                 
                 var data = table.row( this ).data();
                 table.row( this ).select();
                 map.panTo(markers[data[0]].position);
                
            });
        
             //create the events for the table when a row is clicked
            $("#ranktable tbody tr").click(function(){
                 
                 $(".sbsarea").show();
                 
                 $("#marker_reviews").empty();
                 
                //set the zoom
                map.setZoom(13.5); //higher number, higher zoom
                 
                //get the row data
                //data0 = num
                //data1 = name
                //data2 = address
                        //...
                var data = table.row( this ).data();
                 
                //move map to the marker
                //data[0] s the marker id ~ 1,2,3,4,5...
                 map.panTo(markers[data[0]].position);
                 
                 //globals used elsewhere...
                map_marker_table_index = data[0];
                map_marker_lat = data[7];
                map_marker_lng = data[8];
                map_marker_name = data[1];
                map_marker_address = data[2];
                map_marker_address = data[2];
                 
                //
                 $("#container"+data[0]).appendTo("infowWindow_" + data[0]);
                 //fill in content
                 $("#marker_address").html(data[2]);
                 //fill in reviews
                 $.each(data[19], function(i, item) {
                     var p = "<p class=\"review\"><span>Date: "+item["registered_dtts"]+"<span><br><span>Comment: " +item["review_text"]+"<span></p>";
                     
                     $("#marker_reviews").append(p);

                 });
                 
                //trigger the marker click to display the infowindow
                new google.maps.event.trigger( markers[data[0]], 'click' );
                
                
                
                
                
                
                
            });
        

        

    }
    var error = function(){
        alert("Hm... I couldn't seem to find that. Try adding a city. If you still can't find it, Contact me!");
        $('#searchwings').prop('value', 'Search For Wings'); 
        $('#order').prop("disabled",false);
        $('.searchbutton').prop("disabled",false);
    }
    
    
    //see above details
    $.ajax({
      dataType: "json",
      url: url,
      data: data,
      success: success,
      error: error
    });
};


            
          
function makeCompletenessChart(container,twt_size, twt_crisp, twt_num_sauce, twt_sauce_quality, twt_batter, twt_sauce_amount, twt_heat, twt_location, twt_atmosphere)
{
    
    twt_crisp = twt_crisp ? twt_crisp : 0;
    twt_size = twt_size ? twt_size : 0;
    twt_location = twt_location ? twt_location : 0;
    twt_atmosphere = twt_atmosphere ? twt_atmosphere : 0;
    twt_heat = twt_heat ? twt_heat : 0;
    twt_num_sauce = twt_num_sauce ? twt_num_sauce : 0;
    twt_sauce_quality = twt_sauce_quality ? twt_sauce_quality : 0;
    twt_batter = twt_batter ? twt_batter : 0;
    twt_sauce_amount = twt_sauce_amount ? twt_sauce_amount : 0;
 
    //there are two types of containers "twt_map" vs "container_#"
    
   /* var category = ["","","","","","","",""]
    if(container.contains("twt"))
    {
        category = ["a","b","c","d","e","f","g","h"]
    }
    */
   
    //destroy the existing chart (it's the last chart in the highcharts array)
    var hcsize = Highcharts.charts.length
    if(Highcharts.charts[hcsize])
    {
        Highcharts.charts[hcsize].destroy();
    }
    
    Highcharts.chart(container, {

    chart: {
        polar: true,
        type: 'line'
    },

    accessibility: {
        description: 'A Spider Web Chart'
    },

    title: {
        text: '',
        x: -80
    },

   pane: {
        size: '80%'
    },

    xAxis: {
        //categories: ['Size', 'Crisp', 'Num Sauce', 'Sauce Quality','Batter', 'Sauce Amount', 'Heat', 'Location', 'Atmosphere'],
        categories: ['Size', 'Num Sauce', 'Sauce Quality','Batter', 'Sauce Amount', 'Heat', 'Location', 'Atmosphere'],
        tickmarkPlacement: 'off',
        lineWidth: 1,
        
    },
    colors: ['#dc3545'],

    yAxis: {
        gridLineInterpolation: 'polygon',
        lineWidth: 0,
        min: 0,
        max: 5,
        //AxisTypeValue: "logarithmic",
        labels: {
            enabled: false
        }
    },

    tooltip: {
         shared: true,
        pointFormat: '<span style="color:{series.color}">{series.name}: <b>{point.y:,.1f}</b><br/>'
    },

    legend: {
        enabled: false,
         align: 'right',
        verticalAlign: 'middle',
        layout: 'vertical'
    },

    series: [{
        name: '',
        //data: [Number(twt_size), Number(twt_crisp),  Number(twt_num_sauce),Number(twt_sauce_quality),Number(twt_batter),Number(twt_sauce_amount),Number(twt_heat),Number(twt_location),Number(twt_atmosphere)],
        data: [Number(twt_size) ? Number(twt_size) : 0,
            Number(twt_num_sauce) ? Number(twt_num_sauce) : 0,
            Number(twt_sauce_quality) ? Number(twt_sauce_quality) : 0,
            Number(twt_batter) ? Number(twt_batter) : 0,
            Number(twt_sauce_amount) ? Number(twt_sauce_amount) : 0,
            Number(twt_heat) ? Number(twt_heat) : 0,
            Number(twt_location) ? Number(twt_location) : 0,
            Number(twt_atmosphere) ? Number(twt_atmosphere) : 0],
        //data: [twt_crisp, twt_size, twt_location, twt_atmosphere, twt_heat, twt_num_sauce, twt_price],
        //data: [1, 2, 1, 2, 1, 2, 1],
        pointPlacement: 'on'
    }],

    responsive: {
           rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    align: 'center',
                    verticalAlign: 'bottom',
                    layout: 'horizontal'
                },
                pane: {
                    size: '70%'
                }
            }
        }]
    }

});
}


function rankSelected(id)
{
        //finally create a event for when one of the markers gets clicks
        var marker = markers[id];
        new google.maps.event.trigger( marker, 'click' );
}


function DeleteMarkers() {
        //Loop through all the markers and remove
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(null);
        }
        markers = [];
        
    };
    
    
function LookupAddress(place_name, successCallback) {

    //ajax call details
    var url = "https://maps.googleapis.com/maps/api/geocode/json?address=" + encodeURIComponent(place_name) + "&key=AIzaSyD8PYKniHsmvRRngGywq33xHeCNBL8c_8g"
    //var url =  "./php/test.php"
    var data = {}
    var success = successCallback;
    var error = function () {
        alert("I failed now!!!");
    }


    //see above details
    $.ajax({
        dataType: "json",
        url: url,
        data: data,
        success: success,
        error: error
    });
}
