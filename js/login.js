/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


function login()
{
    event.preventDefault();
            var username = document.getElementById("loginusername").value;
            var password = document.getElementById("loginpassword").value;
            $.post("./Auth/login.php",{username : username, PASSWORD : md5(password)}, function(data) {
                    if(data.trim() === "true")
                    {
                       alert("Logged in");
                       location.reload();
                       
                    }
                    else
                    {
                        alert("Authentication failure. Try again.");
                        document.getElementById("loginpassword").value = "";
                        $("#loginusername").focus();
                    }
               });
            
}

$(document).ready(function() {
  

          
          
          
          
          
          
          
          //Create Accfount
          $("#createaccount").click(function () {
        // Define the Dialog and its properties.
            $("#createcontent").dialog({
                resizable: true,
                modal: true,
                title: "Create New Account",
//                height: 300,
 //               width: 200,
                buttons: {
                    "Create": function () {
                        
                        var createFirst = document.getElementById("createFirst").value;
                        var createLast = document.getElementById("createLast").value;
                        var createEmail = document.getElementById("createEmail").value;
                        var createPass = document.getElementById("createPass").value;
                        
                        if(createFirst === "" || createLast === "" || createEmail === "" || createPass === "" ||  createEmail.indexOf("@") === 0 || createEmail.indexOf(".") === 0)
                            {
                                alert("Invalid form data");
                            }
                            else
                            {

                                $.post("./Auth/create.php",{FIRST : createFirst,LAST : createLast, EMAIL : createEmail, PASSWORD : md5(createPass)}, function(data) {
                                    alert("result data:" + data);
                                        document.getElementById("createFirst").value ="";
                                        document.getElementById("createLast").value ="";
                                        document.getElementById("createEmail").value ="";
                                        document.getElementById("createPass").value ="";
                               });
                                $(this).dialog('close');
                            }
                        
                       
                        //callback(true);
                    },
                        "Cancel": function () {
                        $(this).dialog('close');
                        //callback(false);
                    }
                }
            });
    });
          
          
});


 $("#userlogout").click(function () {
        $.post("./Auth/logout.php",{}, function(data) {
                
                    window.location.href = "#";
                  
               });
    });
    


