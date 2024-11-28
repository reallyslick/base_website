<?php
define('LOCAL', true);
define('CONFIG_DB_NAME', "wingtheory_test");
define('LOGIN_DB_NAME','CYT');
define('DEBUG_MODE', true);
define('DEVLOC',"littleboy");
define('LOG_FILE_BASE',"C:\\logs\\"); //DEV LOG BASE
if(!LOCAL)
{
    define('MYSQL_CONFIG_PATH',$_SERVER["DOCUMENT_ROOT"]."/TheWingTheory/config/dbConnections.xml"); //PROD LOG BASE
}
else
{
    if(DEVLOC === "littleboy")
    {
        define('MYSQL_CONFIG_PATH',"C:/_svn/WEB/TheWingTheory/config/dbConnections.xml"); 
    }
    else
    {
        define('MYSQL_CONFIG_PATH',"C:\Users\cyrus.admin\Documents\My Web Sites\WebSite1\TheWingTheory\config\dbConnections.xml"); 
    }
   
}
?>