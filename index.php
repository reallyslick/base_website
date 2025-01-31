
<!--

Name       : Cyrus Bavarian 
Description: A basic website
Version    : 1.0
Released   : 20250131

-->

<html xmlns="http://www.w3.org/1999/xhtml">
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <meta name="description" content="Change me" />	    
    <!--meta name="keywords" content="themes, bootstrap, free, templates, bootstrap 3, freebie,">-->
    <meta property="og:title" content=""/>
    <head>
        <!-- Title -->
        <title>CHANGEME</title>

        <!-- Style Sheets -->
        <link href="http://fonts.googleapis.com/css?family=Varela" rel="stylesheet" />
        <link href="css/index.css" rel="stylesheet" type="text/css" media="all" />
        <link href="font/fonts.css" rel="stylesheet" type="text/css" media="all" />

        <!-- Jquery -->
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link href="./js/jquerytheme/jquery-ui.css" rel="stylesheet">
            
        <!-- Cy's Javascript -->
        <script src="./Auth/md5.js"></script>
        <script src="./js/index.js"></script>
    </head>
    <body>
        
        <img src="./images/banner.png"></img>
        <p>Hello this is a basic website. it works!</p  
        <?php
            session_start();
            echo "PHP is working!";
        ?>

    </body>
</html>

