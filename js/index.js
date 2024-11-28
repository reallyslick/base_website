$(document).ready(function() {
    
    //create the drop down menu
    //makeFilters();
    
    $("#rate_content").hide();
    
    
    //Since we are in index, we want to do special stuff with this page.
    //if the map marker is clicked, it should interact with the map.js
    //so we create a function specific to this page when a marker is clicked.
    //then we pass this function to the set_bindInfoWindow_callback function to execute when a marker is clicked.
    //you perform some stuff when the marker is clicked
    var successFunc = function(html){
        //alert(marker.title)
        $("#name").html($(html).attr("name"));
        $("#description").html($(html).attr("description"));
    };
    set_bindInfoWindow_callback(successFunc);
     
     
     

    
    //Show the review section if the user wants to leave a review
     $('#user_rate').on('click', function() {

         //hide the slides
         $("#rate_slide").hide();
         
         //show the first slide
         $("#rate_content").first("div").show();
         $("#rate_content").dialog({
             
             height : 400,
             width: 600,
             open: function(){
                 $("#rate_name").html(map_marker_name);
             },
             'buttons': {
                'Rate!': function(event) {
                    //collect responses
                    
                
                    var marker_lat = map_marker_lat;
                    var marker_lng = map_marker_lng;
                    var marker_name = map_marker_name;
                    var marker_address = map_marker_address;        
                    var rate_wingsize = $("#rate_wingsize").val();
                    var rate_numsauce = $("#rate_numsauce").val();
                    var rate_saucequality = $("#rate_saucequality").val();
                    var rate_batter = $("#rate_wingbatter").val();
                    var rate_wet = $("#rate_wet").val();
                    var rate_sauceheat = $("#rate_sauceheat").val();
                    var rate_location = $("#rate_location").val();
                    var rate_atmosphere = $("#rate_atmosphere").val();
                    var rate_text = $("#review_text").val();
                    
                     var url =  "./php/userRating.php"
                    var data = {
                                marker_lat: marker_lat,
                                marker_lng: marker_lng,
                                marker_name: marker_name,
                                marker_address: marker_address,
                                wingsize : rate_wingsize,
                                numsauce : rate_numsauce,
                                saucequality : rate_saucequality,
                                batter : rate_batter,
                                wet : rate_wet,
                                heat : rate_sauceheat,
                                location: rate_location, 
                                atmosphere: rate_atmosphere,
                                review_text: rate_text
                                }
                    var success = function(data){

                        alert("Thank you for rating!")
                    };
                    var error = function(){
                        alert("Rating Failed");
                    };

                        $.ajax({
                      dataType: "json",
                      url: url,
                      data: data,
                      success: success,
                      error: error
                    });
                    
                    //send to php
                }
            }
                 
         });
         
    });
    
    //Hide the current review question, show the next one when the user clicks
    $('[type="radio"]').on('click', function(event) {
        
        //get the max number of these fieldsets
        var max;
        $(this).parent().each(function() {
            /*var value = parseInt($(this).data('q'));
            max = (value > max) ? value : max;*/
            });
        //alert(max);
        
        //hide the current questions
        $(this).parent().hide();
        
        //show the next question
        $(this).parent().next().show();
    });
    
    //on submit review do somethings
    $('#submitreview').on('click', function() {
        var radioValue = $("input[name='size']:checked").val();
           
    });
    
    //this is the search wings button. when it is clicked you call filterMArkers which is a map.js function
    //you will enable the buttons there.
    $('#searchwings').on('click', function() {
            //if ($(this).data('action') === 'add') {
            //in maps.js
            $('.searchbutton').prop("disabled",true);
            $('#order').prop("disabled",true);
            $('#searchwings').prop('value', 'Finding Wings...'); 
            filterMarkers($("#filterState :selected").val(),$("#filterCity :selected").val(),$("#filterZipCode").val(),"-1"); //-1 set for markerid. serverside will ignore
    });
    //the other way to trigger a search...
    $('#filterZipCode').on('keyup', function (e) {
    if (e.keyCode == 13) {
            $('#thisbutton').prop("disabled",true);
            // Do something
            $('.searchbutton').prop("disabled",true);
            $('#order').prop("disabled",true);
            $('#searchwings').prop('value', 'Finding Wings...'); 
            filterMarkers($("#filterState :selected").val(),$("#filterCity :selected").val(),$("#filterZipCode").val(),"-1");
        }
    });
    
    
    //login content
    $('[action="login"]').on('click', function() {
        $("#logincotent").dialog();
    });
    
    //admin post section
    $('[action="post"]').on('click', function() {
        window.open('post.php', '_blank');
    });
    
    //admin post section
    $('[action="about"]').on('click', function() {
        location.href('about.php');
    });
   
    //not using the editor
    /*CKEDITOR.editorConfig = function (config) {
    config.language = 'es';
    config.uiColor = '#F7B42C';
    config.height = 300;
    config.toolbarCanCollapse = true;

};
CKEDITOR.replace('editor1');*/





$("#filterZipCode").focus();


});
   
   
   
function randomreview()
{
    var markerid = 0;
    var name = "";
    var url =  "./php/getRandomReview.php"
    var data = {}
    var success = function(data){
        
        var markerid = data[0].id;
        var name = data[1].name;
        filterMarkers("","",name,markerid); //-1 set for markerid. serverside will ignore
    };
    var error = function(){
        alert("I failed getting the random thing");
    };
    
    
    
    $('.searchbutton').prop("disabled",true);
    $('#order').prop("disabled",true);
    $('#searchwings').prop('value', 'Finding Wings...'); 
    
        $.ajax({
      dataType: "json",
      url: url,
      data: data,
      success: success,
      error: error
    });
}
   
   
//creates the drop down menus for the map
function makeFilters()
{
    
    var url =  "./php/getFilters.php"
    var data = {username : "username", PASSWORD : "blah"}
    var success = function(data){
        
        
        $.each(data, function (i, dt) {
            $("#filterState").html(dt.state)
            $("#filterCity").html(dt.city)
            $("#sauce").html(dt.sauce)
            
        });
        
    };
    var error = function(){
        alert("I failed here");
    };
    
        $.ajax({
      dataType: "json",
      url: url,
      data: data,
      success: success,
      error: error
    });
}

