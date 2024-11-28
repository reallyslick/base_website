<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by TEMPLATED
http://templated.co
Released for free under the Creative Commons Attribution License

Name       : BarbedFlower 
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20140322

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="http://fonts.googleapis.com/css?family=Varela" rel="stylesheet" />
<link href="css/index.css" rel="stylesheet" type="text/css" media="all" />
<link href="font/fonts.css" rel="stylesheet" type="text/css" media="all" />


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="./Auth/md5.js"></script>
<script src="./js/map.js"></script>
<script src="./js/post.js"></script>



<!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->

</head>
<body>
    <div style="display: inline-block">
    <input style="width:100px" id="state" type="text" class="" placeholder="" maxlength="90" style="" disabled></input>
    <input style="width:100px" id="city" type="text" class="" placeholder="" maxlength="90" style="" disabled></input>
    <input style="width:300px" id="address" type="text" class="" placeholder="" maxlength="90" style="" disabled></input>
    <input style="width:100px" id="lat" type="text" class="" placeholder="" maxlength="90" style="" disabled></input>
    <input style="width:100px" id="lng" type="text" class="" placeholder="" maxlength="90" style="" disabled></input>
    <input style="width:100px" id="description" type="text" class="" placeholder="" maxlength="90" style="" disabled></input>
    </div>
    <br></br>
    <input style="width:731px" id="search_place" type="text" class="" placeholder="Enter the address here" maxlength="90" style=""></input>
    <a id="LookupAddress" href="#" action="lookupaddress" class="button">Lookup Address</a>
    <br></br>
    <form>
        Restaurant Name:<input style="width:400px" id="name" type="text" class="" placeholder="" maxlength="90" style="" ></input><br>
        <!--Describe your order:<input style="width:400px" id="title" type="text" class="" placeholder="12 original wings with lemon pepper dry rub" maxlength="90" style="" ></input><br>
        Describe the atmosphere:<input style="width:400px" id="title" type="text" class="" placeholder="busy, laid back, hole in the wall / sports bar, restaurant, food truck" maxlength="90" style="" ></input><br>
        Wing Size: <select id="">       <option>Small</option>        <option>Medium</option>        <option>Large</option>  </select>    <br>
        Wing Crispyness: <select id="">       <option>No Crisp, Soggy</option>        <option>Crisp</option>        <option>Very Crispy</option>  </select>  <br>
        Sauce Amount: <select id="">       <option>Dry</option>        <option>Lightly Coated</option>       <option>Covered</option>        <option>Deliciously Wet</option>  </select><br>
        Heat level Reference : <select id="">       <option>Sweet or savory</option>        <option>Black Pepper</option>       <option>Buffalo Sauce</option>        <option>Habenero Sauce</option>         <option>Ghost chili</option>  </select><br>
        Flavor level: <select id="">       <option>Not much flavor</option>        <option>Good Flavor</option>       <option>Impressive flavor and freshness</option> </select><br>
        Notable attributes:<input style="width:400px" id="title" type="text" class="" placeholder="Describe what makes these wings different/special" maxlength="900" style="" ></input><br>-->
    </form>
    <a id="SavePost" href="#" action="savepost" class="button">Save Post</a>
    <div id="map"></div>
    
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8PYKniHsmvRRngGywq33xHeCNBL8c_8g&callback=initMap&libraries=places">
    </script>
    
    
</body>
</html>


