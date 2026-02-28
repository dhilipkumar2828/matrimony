<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include("include/title.php"); ?>
<link type="text/css" rel="stylesheet" href="css/header-footer.css" />
<link type="text/css" rel="stylesheet" href="css/common.css" />
</head>
<body class="back">
<div id="body"><!--body id start-->
<?php include("include/header.php"); ?>
<br />
<div class="plr">

	<?php include("include/menu.php"); ?>
	<p class="cb"></p>
	 
<script type="text/javascript">
$(document).ready(function() {
	$("#contactus_form").validate();
});
</script>
 <style type="text/css">
#contactus_form label.error {
	border:1px solid #c00;
	background-color:#FFEEEE;
	color:red;
	width:150px;
	position:absolute;
	float:right;
	font-size:11px;
	height:13px;
	padding:3px 5px;
	margin-left:5px;
}
</style> 
<br />
<script type="text/javascript">
 function onlyNumbers(event) {
        var e = event || evt; // for trans-browser compatibility
        var charCode = e.which || e.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
	function validateEmail(email)
{
	var x=document.getElementById("email").value;
	//alert(x);exit;
	//var x=document.forms["registerform"]["email"].value;
	var atpos=x.indexOf("@");
	var dotpos=x.lastIndexOf(".");
	if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
    {
    alert("Not a valid e-mail address");
	document.getElementById("email").value='';
    return false;
    }
	return true;
}
 </script>
 <script type="text/javascript">
function validateForm()
	{
	//alert("{fdfd");
	var x=document.getElementById("name").value;
	if(x=="null" || x=="")
	{
	alert("Please Enter Your Name");
	return false; 
	}
	var x=document.getElementById("mobile").value;
	if(x=="null" || x=="")
	{
	alert("Please Enter Your Mobile Number");
	return false; 
	}
	/*var x=document.getElementById("email").value;
	if(x=="null" || x=="")
	{
	alert("Please Enter Your Email Id");
	return false; 
	}*/
	var x=document.getElementById("msg").value;
	if(x=="null" || x=="")
	{
	alert("Please Enter Your Comment");
	return false; 
	}
	
	return true;
    }
</script>
<div class="plr">
<div class="heading pb5px bdrB mb2px">
<h1>Contact Us</h1>
</div>
<br class="lh1em" />
<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
<tr valign="top">
<td>
<table width="98%" align="center" border="0" cellspacing="0" cellpadding="0">
<tr valign="top">
<td class="pr20px" width="55%"><p class="maroon b large mb2px">Registered Branch</p>
<p class="mb10px">
28/49,South usman road,<br />
T Nagar,Chennai-600 017<br />
Landmark : Between Paragon and Shree Leathers, Near Bus Depot.<br />
</p>
<br />
</td>
<td style="background-position:left;"  class="pl20px vr"><p class="maroon b large mb2px">Contact details :-</p>
<p class="mb10px uu">
Mobile No &nbsp; &nbsp; &nbsp;:+91 90940 10909 / 7299234446<br />
Landline No : 044 4386 3901<br />
Email Id &nbsp; &nbsp; &nbsp; &nbsp;:hmlucky03@gmail.com
</p></td>
</tr>
</table>

<br />
<iframe width="560" height="315" src="https://www.youtube.com/embed/t2mlL7K1hbs" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
<br /><br />
<p class="refine_bg2 large b p5px10px ttu">Send Your Message</p>
<p class="fr p5px"><span style="color:#FF0000;">*</span> marked as required fields</p>
<div style="background:url(images/contact.gif) no-repeat 0 bottom;" class="p15px bdrbed563">
<form name="contactus_form" id="contactus_form" action="save.php" method="post"  onSubmit="return validateForm();">
<input id="command" type="hidden" value="mail_form" name="command"> 
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
	<tr>
	<td width="35%" class="p2px5px ar">Name<span style="color:#FF0000;">*</span> :</td>
	<td class="p2px5px">
	<input class="input w60 required" title="Enter Your Name"  type="text" name="name" id="name" value="" /></td>
	</tr>
	
	<tr valign="top">
	<td class="p2px5px ar">Phone<span style="color:#FF0000;">*</span> :</td>
	<td class="p2px5px"><input class="input w60 required number" title="Enter Valid Phone Number" type="text" name="mobile" id="mobile"  onkeypress="return onlyNumbers(event)"/></td>
	</tr>
	<tr valign="top">
	<td class="p2px5px ar">Email:</td>
	<td class="p2px5px"><input class="input w60 required email" title="Enter Valid Email Id" type="text" name="email" id="email" value=""  onblur="return validateEmail(this)"  /></td>
	</tr>
	<tr valign="top">
<td class="p2px5px ar">Message<span style="color:#FF0000;">*</span> :</td>
<td class="p2px5px"><textarea class="input w60 required" title="Enter Your Message" name="msg" id="msg"  rows="5"></textarea></td>
</tr>
<tr valign="top">
<td class="p2px5px">&nbsp;</td>
<td class="p2px5px">
<div class="rn_btn">
<button type="submit" style="width: auto;"><span style="color:#FFFFFF; padding:5px; font-size:16px; font-weight:bold;">Ask Us</span></button>
<button type="reset" style="width: auto; margin-left:10px;"><span style="color:#FFFFFF; padding:5px; font-size:16px; font-weight:bold;">Reset</span></button>
</div>
</td>
</tr>
</table>
</form>
</div>
</td>
<td width="216" class="pl15px">
	
	

    
    
<br />
    <div class="bdr gray">
    <p style="background:url('images/fld_g1.gif') repeat-x bottom; padding:10px;" class="large b">Indian Bank Details</p>
    <div class="p10px">
    <p class="b1 pl10px mb5px bdrBd pb5px">Account Holder Name	: <a href="#" style="font-weight:bold;">P.Mani</a></p>
     <p class="b1 pl10px mb5px bdrBd pb5px">Bank Name	: <a href="#" style="font-weight:bold;">Indian Bank</a></p>
     <p class="b1 pl10px mb5px bdrBd pb5px">Account Number	: <a href="#" style="font-weight:bold;">428197570</a></p>
      <p class="b1 pl10px mb5px bdrBd pb5px">IFSC Code	: <a href="#" style="font-weight:bold;">IDIB000T115</a></p>
     <p class="b1 pl10px mb5px bdrBd pb5px">Branch Name	: <a href="#" style="font-weight:bold;">T.Nagar,Chennai</a></p>
    </div>
    </div>

 <div class="bdr gray">
    <p style="background:url('images/fld_g1.gif') repeat-x bottom; padding:10px;" class="large b">Axis Bank Details</p>
    <div class="p10px">
    <p class="b1 pl10px mb5px bdrBd pb5px">Account Holder Name	: <a href="#" style="font-weight:bold;">Happy Marriage Matrimony</a></p>
     <p class="b1 pl10px mb5px bdrBd pb5px">Bank Name	: <a href="#" style="font-weight:bold;">Axis Bank</a></p>
     <p class="b1 pl10px mb5px bdrBd pb5px">Account Number	: <a href="#" style="font-weight:bold;">9140 2003 9993 724</a></p>
      <p class="b1 pl10px mb5px bdrBd pb5px">IFSC Code	: <a href="#" style="font-weight:bold;">UTIB0001594</a></p>
     <p class="b1 pl10px mb5px bdrBd pb5px">Branch Name	: <a href="#" style="font-weight:bold;">Venkat Narayana Road,T.Nagar</a></p>
 <p class="b1 pl10px mb5px bdrBd pb5px">Branch Code : <a href="#" style="font-weight:bold;">001594</a></p>
    </div>
    </div>
    
</td>
</tr>
</table>
</div><?php include("include/footer.php"); ?>
</div>
</body>
</html>