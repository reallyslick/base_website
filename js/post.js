$(document).ready(function() {
    
    $('[action="savepost"').on('click', function() {
    
        var name = $("#name").val();
        var state = $("#state").val();
        var city = $("#city").val();
        var address = $("#address").val();
        var lat = $("#lat").val();
        var lng = $("#lng").val();
        var description = $("#description").val();
        
         //ajax call details
        var url =  "./php/savePost.php"
        //var data = {lat: lat, lng: lng, state: state, city: city, address: address, name:name, order_desc: order_desc, atmosphere: atmosphere, wing_size: wingsize, wing_crispyness: wing_crispyness, sauce_amount: sauce_amount, sauce_heat: sauce_heat, flavor_level}
        var data = {name: name, lat: lat, lng: lng, state: state, city: city, address: address, description: description}
        var success = function (data) {
            alert("Success: " + data);
        }
        var error = function () {
            alert("I failed!");
        }


        //see above details
        $.ajax({
            url: url,
            data: data,
            success: success,
            error: error
        });
        
    });
      
    $('[action="lookupaddress"').on('click', function() {
        
        //reset
        $("#name").val("");
        $("#state").val("");
        $("#city").val("");
        $("#address").val("");
        $("#lat").val("");
        $("#lng").val("");
        $("#description").val("");
        
        //get the place that they entered
        var place_name = $("#search_place").val();
        
        //this is the call back that gets executed in lookup address function
        var success_callback = function(data){
            
            //Address components
            var addressComp = data["results"][0].address_components;
            $.each(addressComp, function (i, dt) {
                var type = dt.types[0];
                switch(type)
                {
                    case "locality":
                        $("#city").val(dt.long_name);
                        break;
                    case "administrative_area_level_1":
                        $("#state").val(dt.long_name);
                        break;
                    default:
                        break
                }
            });
            
            //gps components
            var gpsComp = data["results"][0].geometry.location;
            $("#lat").val(gpsComp.lat);
            $("#lng").val(gpsComp.lng);
            
            //formatted address components
            var formAddress = data["results"][0].formatted_address;
            $("#address").val(formAddress);
            
            var description = data["results"][0].types;
            var word = "";
            $.each(description, function (i, dt) {
                word = word +" " + dt;
            });
            $("#description").val(word);
                   
                        
            //set the single marker
            setMarkers(gpsComp.lat, gpsComp.lng)

            
        }
        //this is the call to the function
        LookupAddress(place_name, success_callback);
    });
   
    
});
   
   
   