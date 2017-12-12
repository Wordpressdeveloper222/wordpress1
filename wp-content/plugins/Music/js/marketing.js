
function validate()
{
    var x = document.forms["form"]["txt-fname"].value;
    if (x == null || x == "") {
        alert("Please Enter first name");
        return false;
    }
   var x = document.forms["form"]["txt-lname"].value;
    if (x == null || x == "") {
        alert("Please Enter last name");
        return false;
    }
	
	 var x = document.forms["form"]["txt_phone"].value;
    if (x == null || x == "") {
        alert("Please Enter phone number");
        return false;
    }
	
	
var x = document.forms["form"]["txt_email"].value;
    if (x == null || x == "") {
        alert("Please Enter emailAddress");
        return false;
    }
	


  
}
