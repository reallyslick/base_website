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
    	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
	 <meta name="description" content="TheWingTheory.com" />	    
	<!--meta name="keywords" content="themes, bootstrap, free, templates, bootstrap 3, freebie,">-->
        <meta property="og:title" content=""/>
<head>

<title></title>



<link href="http://fonts.googleapis.com/css?family=Varela" rel="stylesheet" />
<!--<link href="css/index.css" rel="stylesheet" type="text/css" media="all" />-->
<link href="css/index.css" rel="stylesheet" type="text/css" media="all" />
<link href="font/fonts.css" rel="stylesheet" type="text/css" media="all" />


<link rel="stylesheet" href="./css/jquery-ui-1.12.1.custom-red/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
            <!-- Optional theme -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
            <!-- Latest compiled and minified JavaScript -->
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
            <link href="./js/jquerytheme/jquery-ui.css" rel="stylesheet">


<link REL=StyleSheet HREF="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" TYPE="text/css" MEDIA=screen/>
<script type="text/javascript" src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>



<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.0.3/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.3/dist/js/select2.min.js"></script>

<script src="./js/ckeditor/ckeditor.js"></script>
<script src="./Auth/md5.js"></script>
<script src="./js/login.js"></script>

<!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->

</head>
<body>
    
<div id="wrapper">
    <a href="index.php" action="home" class="button">Home</a> 
    <a href = "mailto: Cyrus.Bavarian@gmail.com">Contact</a> 
    <a href = "about.php" action="about" class="button">About</a> 
    
    <!--<a href="#" action="login" class="button">Admin</a>--> 
    <div>
        <hr>
            <span>Cy is on the hunt for the perfect hot wing. </span>
        <hr>
        <br>
    </div>
    
    
    <div id="rate_content">
        <div class="rate_slide">
            <h1>Wing Rating</h1>
            <p>Name: [The name of the place] <span id="rate_name"></span></p>
            <p align="center">Welcome to the Wing Rating System. </p>
            <p>Wing Size - Indicate the size of wings served at the restaurant. 
                <br>
                <select id="rate_wingsize">
                    <option value='1'>Small Wings</option>
                    <option value='3'>Average Size</option>
                    <option value='5'>Large Wings</option>
                </select>
            </p>
            <p>Number of Sauces - Indicate how many options of sauces are available 
                <br>
                <select id="rate_numsauce">
                    <option value='1'>Standard sauce options (Less than 5)</option>
                    <option value='3'>Standard sauces including some less common choices (Between 5-15 sauces)</option>
                    <option value='5'>Many Sauce Option (Greater than 20!!)</option>
                </select>
            </p>
            <p>Sauce Quality - Indicate if the sauces are off the shelf, or house made.
                <br>
                <select id="rate_saucequality">
                    <option value='1'>Standard sauces</option>
                    <option value='3'>Above Average quality with a house special</option>
                    <option value='5'>Best quality with house made sauces</option>
                </select>
            </p>
            <p>Battered Wings - Indicate the level of batter 
                <br>
                <select id="rate_wingbatter">
                    <option value='1'>Naked wings, no batter</option>
                    <option value='3'>Lightly battered</option>
                    <option value='5'>Heavily battered</option>
                </select>
            </p>
            <p>Wet Wings - wet refers to the amount of sauce on a wing. Lots of sauce means extra wet.
                <br>
                <select id="rate_wet">
                    <option value='1'>Dry Wings</option>
                    <option value='3'>Average amount of sauce</option>
                    <option value='5'>Deliciously Wet</option>
                </select>
            </p>
            <p>Heat Level - Indicate how spicy the spiciest sauce is. NOT the menu's description, select using your best judgment! 
                <br>
                <select id="rate_sauceheat">
                    <option value='1'>None - There is no spicy wing option</option>
                    <option value='2'>Standard Heat - Think Franks Red Hot, Chipotle, Louisiana or less</option>
                    <option value='4'>Pretty Hot - Think Habanero, Extra Hot Buffalo, Flavorful ghost pepper level spice ~ burns, but still edible</option>
                    <option value='5'>OMG! - Think Source, pepper concentrate, or extreme pepper mixture ~ burn awful</option>
                </select>
            </p>
            <p>Location - Indicate the style of location 
                <br>
                <select id="rate_location">
                    <option value='1'>Quiet place with nowhere else to go</option>
                    <option value='2'>Proximity is close to other restaurants but no nightlife or downtown scene</option>
                    <option value='4'>In a popular area, in close proximity to a few other bars and entertainment</option>
                    <option value='5'>Downtown or highly trafficked spot in close proximity to many other bars and entertainment.</option>
                </select>
            </p>
            <p>Atmosphere - Indicate how fun the experience was 
                <br>
                <select id="rate_atmosphere">
                    <option value='1'>low-key spot with no bar</option>
                    <option value='2'>Average spot with low-key bar</option>
                    <option value='4'>Average Sports bar with some tv's and slightly busy</option>
                    <option value='5'>Sport-bar, many TV's, popular and crowded</option>
                </select>
            </p>
            <p>Final Words  - Describe the food, service, and experience.
                <br>
                    <textarea id='review_text'></textarea>
            </p>
        </div>
    </div>

</div>

    
    
    
    
    
    
    
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8PYKniHsmvRRngGywq33xHeCNBL8c_8g&callback=initMap&libraries=places">
    </script>
    

    
    
</body>
</html>


