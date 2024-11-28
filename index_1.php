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


<link REL=StyleSheet HREF="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css" TYPE="text/css" MEDIA=screen/>
<script type="text/javascript" src="//cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>



<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.0.3/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.3/dist/js/select2.min.js"></script>

<script src="./js/ckeditor/ckeditor.js"></script>
<script src="./Auth/md5.js"></script>
<script src="./js/index.js"></script>
<script src="./js/login.js"></script>
<script src="./js/map.js"></script>


</head>
    
    
<body>

    
    
    <?php
    session_start();

    if (isset($_SESSION['userid'])) {
        echo '<a href="#" action="post" class="button">Post</a> ';
    }
    ?>
    
    

  
            

<div id="wrapper">
    <a href="" action="home" class="button">Home</a> 
    <a href="#" action="login" class="button">Admin</a> 
    <div>
        <hr>
            <span>The Wing Theory guides wing connoisseurs in their search for the perfect wing. Specify a name or address in the search below and discover all the Wings places in your area. Help others by selecting a location and answering a few simple questions about your wingxperience</span>
        <hr>
        <br>
    </div>
    <div>
        <p align="center" id="searchfilters">
        <!--<span id="filterState"></span>
        <span id="filterCity"></span>
        <span >&nbsp;&nbsp;&nbsp; OR &nbsp;&nbsp;&nbsp; </span>-->
        <input id="filterZipCode" type="text" placeholder="(ex. Wings Dallas)">
        <span id="sauce"></span>
        <span class="center" >
            <input class="" type="button" id="searchwings" value="Search Wings">
            <input class="" type="button" id="order" value="Order" onclick="order()">
            <br>
        </span>
            <!--Wing Size: <span id="wing_size"><select><option value="1">Small</option><option value="3" selected>Average</option><option value="5">Large</option></select></span>
                            Wing Crisp: <span id="wing_crisp"><select><option value="1">Soggy</option><option value="3" selected>Crisp</option><option value="5">Extra Crispy</option></select></span>
                            Number of Sauces: <span id="num_sauces"><select><option value="1">&gt;3</option><option value="3" selected>&gt;5</option><option value="5">&gt;10</option></select></span>
                            Sauce Quality: <span id="sauce_quality"><select><option value="1" selected>Standard quality</option><option value="3">Homemade and Distinctly Good</option><option value="5">High Quality Unique Flavors</option></select></span>
                            Sauce Amount: <span id="sauce_amount"><select><option value="1">Light, dry coating</option><option value="3" selected>Average Sauce</option><option value="5">Totally wet</option></select></span>
                            Maximum Heat Rating: <span id="heat_rating"><select><option value="1">Buffalo Heat</option><option value="3" selected>Habenero Heat</option><option value="5">Ghost Chili heat</option></select></span>-->
        </p>
    </div>

    <div id="map"></div>

    <div id="summary">
        <!--<a href="#" id="user_rate">Have you been here? Rate these wings!</a>-->
        <table id="ranktable" class="dataTable table table-striped" cellspacing="0" width="100%">
            <thead>
                <th>markerid</th>
                <th>Place</th>
                <th>Address</th>
                <th>Google Rating</th>
                <th>Google Reviews</th>
                <th>Open now?</th>
                <th>TWT</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Content</th>
                <th>TWT: Atmosphere</th>
                <th>TWT: Crisp</th>
                <th>TWT: Heat</th>
                <th>TWT: Location</th>
                <th>TWT: Number of Sauces</th>
                <th>TWT: Wet Wings</th>
                <th>TWT: Sauce Quality</th>
                <th>TWT: Wing Size</th>                 
            </thead>
            </th>
        </table>
        <div id="sortedresults">
        </div>
    </div>
    <div class="sbswrap" id="info_area">
        <div class="sbsleft">
            
            </div>
        <div class="sbsright">
            <div id="twt_map">
            </div> 
        </div>
        
                     
        </div>
    
    

</div>
    


    
    
    <!--Hidden content!!-->
<div id="sort_content" style="display: none;">
    <select id="sortSelect" multiple>
                <option value="1">Place</option>
                <option value="2">Address</option>
                <option value="3">Google Rating</option>
                <option value="4">Google Reviews</option>
                <option value="5">Open now?</option>
                <option value="6">TWT</option>
                <option value="7">Latitude</option>
                <option value="8">Longitude</option>
                <option value="9">Content</option>
                <option value="10">TWT: Atmosphere</option>
                <option value="11">TWT: Crisp</option>
                <option value="12">TWT: Heat</option>
                <option value="13">TWT: Location</option>
                <option value="14">TWT: Number of Sauces</option>
                <option value="15">TWT: Wet Wings</option>
                <option value="16">TWT: Sauce Quality</option>
                <option value="17">TWT: Wing Size</option> 
    </select>
</div>
    
    
    
<div id="rate_content" style="display: none;">
    <div style="font-weight: bold">
    Restaurant Name:&nbsp<span id="name"></span><br>
    Overall User Rating:&nbsp<span id="avgRating"></span><br>
    Restaurant Description:&nbsp<span id="description"></span><br>
    </div>
</div>
<fieldset q="1" class="rating">
<legend>Wing Size:</legend>
<input type="radio" id="size1" name="size" value="1" /><label for="size1" title=""><img src="images/banner.jpg" alt="Smiley face" height="42" width="42"></img>Small</label>
    <input type="radio" id="size3" name="size" value="3" /><label for="size3" title=""><img class="size1"></img>Average</label>
    <input type="radio" id="size5" name="size" value="5" /><label for="size5" title=""><img class="size1"></img>Large</label>
</fieldset>
<fieldset q="2" class="rating">
    <legend>Wing Crisp:</legend>
    <input type="radio" id="crisp1" name="crisp" value="1" /><label for="crisp1" title="">Soggy</label>
    <input type="radio" id="crisp3" name="crisp" value="3" /><label for="crisp3" title="">Crisp</label>
    <input type="radio" id="crisp5" name="crisp" value="5" /><label for="crisp5" title="">Extra Crispy</label>
</fieldset>
<fieldset q="3" class="rating">
    <legend>Number of Sauces:</legend>
    <input type="radio" id="numsauce1" name="num_sauce" value="1" /><label for="numsauce1" title="">&lt;5</label>
    <input type="radio" id="numsauce3" name="num_sauce" value="3" /><label for="numsauce3" title="">5-10</label>
    <input type="radio" id="numsauce5" name="num_sauce" value="5" /><label for="numsauce5" title="">&gt;103 stars</label>
</fieldset>
<fieldset q="4" class="rating">
    <legend>Sauce Quality:</legend>
    <input type="radio" id="saucequal1" name="sauce_qual" value="1" /><label for="saucequal1" title="">1 stars</label>
    <input type="radio" id="saucequal3" name="sauce_qual" value="3" /><label for="saucequal3" title="">3 stars</label>
    <input type="radio" id="saucequal5" name="sauce_qual" value="5" /><label for="saucequal5" title="">5 star</label>
</fieldset>
<fieldset q="5" class="rating">
    <legend>Sauce Amount: </legend>
    <input type="radio" id="sauceamount1" name="sauce_amt" value="1" /><label for="sauceamount5" title="">1 stars</label>
    <input type="radio" id="sauceamount3" name="sauce_amt" value="3" /><label for="sauceamount3" title="">3 stars</label>
    <input type="radio" id="sauceamount5" name="sauce_amt" value="5" /><label for="sauceamount1" title="">5 star</label>
</fieldset>
<fieldset q="6" class="rating">
    <legend>Maximum Heat Rating: </legend>
    <input type="radio" id="heat1" name="heat" value="1" /><label for="heat1" title="">1 stars</label>
    <input type="radio" id="heat2" name="heat" value="2" /><label for="heat2" title="">2 stars</label>
    <input type="radio" id="heat3" name="heat" value="3" /><label for="heat3" title="">3 stars</label>
    <input type="radio" id="heat4" name="heat" value="4" /><label for="heat4" title="">4 stars</label>
    <input type="radio" id="heat5" name="heat" value="5" /><label for="heat5" title="">5 star</label>
</fieldset>
<fieldset q="7" class="rating">
    <legend>Briefly Describe your experience: </legend>
    <textarea rows="4" cols="50"></textarea>
    <button id="submitreview" type="submit">submit</button>
</fieldset>
           <!-- <textarea placeholder="text" name="editor1" id="editor1" rows="10" cols="80"></textarea></div>-->
        

    
    
    

        

    <div id="logincotent" style="display: none">
        <form id="target" action="index.php">
            <input style="width:60%" id="loginusername" type="text" class="" placeholder="Email" maxlength="90" style="">
                <br>
                    <input style="width:60%" id="loginpassword" type="password" class="" placeholder="Password" maxlength="90" style="">
                        <br><br>
                                <input onclick="login()" style="width: 30%;" class="" type="submit" value="Login">
                                    <br> <br>
                                            <a href="#" id="createaccount">(create account)</a>
                                            </form>

                    <div id="createcontent" style="display: none">
                        </form>
                        <form id="createForm" action="index.php">
                            <input style="width:60%" id="createFirst" type="text" class="" placeholder="First Name" maxlength="90" style="">
                                <input style="width:60%" id="createLast" type="text" class="" placeholder="Last Name" maxlength="90" style="">
                                    <input style="width:60%" id="createEmail" type="text" class="" placeholder="Email" maxlength="90" style="">
                                        <input style="width:60%" id="createPass" type="password" class="" placeholder="Password" maxlength="90" style="">
                                            </form>
                                            </div>
    </div>
                                            <br> 

                                               
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8PYKniHsmvRRngGywq33xHeCNBL8c_8g&callback=initMap&libraries=places">
    </script>
    
    
</body>
</html>

