<?php
/**************************************************************
 * Title: oraDBAPI.php
 * $Author: SAMSUNG-AUSTIN\jjohnson $
 * $Rev: 25 $
 * $Date: 2015-02-05 15:07:18 -0600 (Thu, 05 Feb 2015) $
 * Description: This script defines a class for accessing Oracle
 * DB from PHP.
 *************************************************************/
class mysqlDBAPI {
    var $SID = "";
    var $Server = "";
    var $User = "";
    var $Password = "";
    var $Database = "";
    var $conn = false;
    
    var $Link_ID  = 0;                  // Result of mysql_connect().
    var $Query_ID = 0;                  // Result of most recent mysql_query().
    var $Exec_Res = false;
    var $Record   = array();            // current mysql_fetch_array()-result.
    var $Row;                           // current row number.
    var $LoginError = "";
    var $Errors = array();
    var $Path = "";
    
    function connect() {
        $this->getConnection(CONFIG_DB_NAME);
        // Create connection
        $this->conn = new mysqli($this->Server, $this->User, $this->Password);
        $this->conn->select_db($this->Server);
        
        
        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        } 
        return $this->conn;
    }
    
   /* 
    function connect($source, $db_name) {
        if ($source == "CLI") {
            $this->getCLIConnection($db_name);
            $this->conn = mysqli($this->User, $this->Password, $this->SID);
            if (!$this->conn)
                $this->halt("Connection failed!");
            return $this->conn;
        }
        else {
            $this->getConnection($db_name);
            $this->debug_to_console($this->Server);
            $this->debug_to_console($this->User);
            $this->debug_to_console($this->Password);
            $this->conn = mysqli("198.58.118.29","remoter", "t00sl0w");
            if (!$this->conn)
                $this->halt("Connection failed!");
            return $this->conn;
        }
    }*/
    function freeResource() {
        oci_free_statement($this->Query_ID);
    }
    
    function debug_to_console( $data ) {

    if ( is_array( $data ) )
        $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
    else
        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

    echo $output;
}
       
    function disconnectmysql() {
        mysqli_close($this->conn);
    }

    //default connect function
    function getConnection($connectionName) {
        //$path = $_SERVER['DOCUMENT_ROOT'];
        $Path = MYSQL_CONFIG_PATH;
        $connections = simplexml_load_file($Path);
        foreach ($connections->children() as $database) { //DATABASES
            if ($database['name'] == $connectionName) {
                $this->Server = (string) $database->server;
                $this->User = (string) $database->user_name;
                $this->Password = (string) $database->password;
                $this->Database = (string) $database->database;
                break;
           }
        }
    }
    //connect function used when executing PHP from command line
    function getCLIConnection($connectionName) {
        $connections = simplexml_load_file("C:\\somewhere\\config\\dbConnections.xml");
        foreach ($connections->children() as $database) { //DATABASES
            if ($database['name'] == $connectionName) {
                $this->SID = (string) $database->sid;
                $this->User = (string) $database->user_name;
                $this->Password = (string) $database->password;
                break;
            }
        }
    }
    function halt($msg) {
        printf("<strong>Database error:</strong> %s", $msg);
        die("Session halted.");
        
    }
//-------------------------------------------
//    Queries the database
//-------------------------------------------
    function querymysql($sql) {
        
        if(LOCAL)
        {
            writeLog("SQL QUERY[".$this->Server."/".CONFIG_DB_NAME."]  " . $sql);
        }
        
        $this->Query_ID = mysqli_query($this->conn, $sql);
       if (!$this->Query_ID)
       {           //consider this, but this line has an error in execution. array_push($Errors, "ERROR", "Query Fail");
           $this->halt("Query Fail");
       }
       
       return $this->Query_ID;
    }
    function query($sql) {
        $this->Query_ID = oci_parse($this->conn, $sql);
        $this->Errors = oci_error();
        if (!$this->Query_ID)
            $this->halt(print_r(oci_error(), true) + "\t" + $sql);
        
        $this->Exec_Res = oci_execute($this->Query_ID, OCI_DEFAULT);
        $this->Errors = oci_error();
        if (!$this->Exec_Res)
            $this->halt(print_r(oci_error(), true) + "\t" + $sql);
        $this->Row = 0;
        return $this->Query_ID;
    }
    
    
    
    
    
    
    
//-------------------------------------------
//    Retrieves the next record in a recordset
//-------------------------------------------
    function nextRecord() {
        $row = mysqli_fetch_array($this->Query_ID);
        if (!$row)
            return false;
        return $row;
    }

//-------------------------------------------
//    Retrieves a single record
//-------------------------------------------
    function singleRecord() {
        $this->Record = oci_fetch_array($this->Query_ID);
        $stat = is_array($this->Record);
        return $stat;
    }
//-------------------------------------------
//    Returns the number of rows affected by last statement
//-------------------------------------------
    function affectedRows() {
        return oci_num_rows($this->Query_ID);
    }

//-------------------------------------------
//    Returns the number of fields in a recordset
//-------------------------------------------
    function numFields() {
        return oci_num_fields($this->Query_ID);
    }

}
?>