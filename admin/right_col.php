<!-- Begin Right Column -->

<div id="rightcolumn">
<script type="text/javascript">
function validEmailAddress(email)
{

		invalidChars = " /:,;~"
		if (email == "") 
		{
			return (false);
		}
		for (i=0; i<invalidChars.length; i++) 
		{
			badChar = invalidChars.charAt(i)
			if (email.indexOf(badChar,0) != -1) 
			{
				return (false);
			}
		}
		atPos = email.indexOf("@",1)
		if (atPos == -1) 
		{
			return (false);
		}
		if (email.indexOf("@",atPos+1) != -1) 
		{
			return (false);
		}
		periodPos = email.indexOf(".",atPos)
		if (periodPos == -1) 
		{
			return (false);
		}
		if (periodPos+3 > email.length)	
		{
			return (false);
		}
			
		return (true);
}

function trim(str)
{
    while (str.substring(0, 1) == ' ')
	{
        str = str.substring(1, str.length);
    }
    while (str.substring(str.length - 1, str.length) == ' ')
	{
        str = str.substring(0, str.length - 1);
    }
    return str;
}

function ValidateForm(contact_us)
{
	var name = document.getElementById("name").value;
	var Name = trim(name);
	
	var phone = document.getElementById("phone").value;
	var Phone = trim(phone);
	
	var email = document.getElementById("email").value;

	var Email = trim(email);
	var filter = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;
	
	var comment = document.getElementById("message").value;
	var Comment = trim(comment);

	if (Name == "")
	{
		alert('Please enter your name');document.getElementById("name").focus();return false;
	}
	if (Email == "")
	{
		alert('Please enter your email address');document.getElementById("email").focus();return false;
	}

	if (!validEmailAddress(Email))
	{
		alert('Please enter a valid email address.'); contact_us.FromEmailAddress.focus();return false;
	}
	if (Phone == "")
	{
		alert('Please enter your Phone');document.getElementById("phone").focus();return false;
	}

	if (Comment == "")
	{
		alert('Please enter message or questions.');document.getElementById("message").focus();return false;
	}
	return true;
}


function signup(){

	var fname = document.getElementById("fname").value;
	var lname = document.getElementById("lname").value;
	var email = document.getElementById("email").value;
	var zip =	document.getElementById("zip").value;
	var password = document.getElementById("password").value;
	var confirm_password = document.getElementById("confirm_password").value;
	
	var provider =	document.getElementById("provider").value;
	var tax_id =	document.getElementById("tax_id").value;
	var fax =	document.getElementById("fax").value;
	var city =	document.getElementById("city").value;
	var phone =	document.getElementById("phone").value;
	var address =	document.getElementById("address").value;
	var designation = document.getElementById("designation").value;
	var c_email = document.getElementById("c_email").value;	
	
	//var agree =	document.getElementById("agree").value;
//alert(agree);
	
	if(fname == ""){
		alert("Please enter first name"); document.getElementById("fname").focus();return false;
	}
	else if(lname == ""){
		alert("Please enter last name"); document.getElementById("lname").focus();return false;
	}
	else if(designation == ""){
		alert("Please enter designation"); document.getElementById("designation").focus(); return false;
	}
	else if(provider == ""){
		alert("Please enter provider name"); document.getElementById("provider").focus();return false;
	}
	else if(tax_id == ""){
		alert("Please enter tax id"); document.getElementById("tax_id").focus();return false;
	}

	else if(address == ""){
		alert("Please enter address"); document.getElementById("address").focus();return false;
	}
	else if(city == ""){
		alert("Please enter city"); document.getElementById("city").focus();return false;
	}

	else if(zip == ""){
		alert("Please enter zip code"); document.getElementById("zip").focus();return false;
	}

	else if(phone == ""){
		alert("Please enter phone number"); document.getElementById("phone").focus();return false;
	}	
	else if(fax == ""){
		alert("Please enter fax number"); document.getElementById("fax").focus();return false;
	}

	else if(email == ""){
		alert("Please enter email address"); document.getElementById("email").focus();return false;
	}
	else if(email != ""){
	
