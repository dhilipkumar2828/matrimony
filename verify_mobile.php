<?php
if(isset($_GET['mobile_no']) && $_GET['mobile_no']!='' && isset($_GET['reg_id']) && $_GET['reg_id']!='')
{
    $mobile_no=$_GET['mobile_no'];
    $reg_id=$_GET['reg_id'];
}
else
{
     echo "<script type=\"text/javascript\">
        alert('Invalid Parameter,Please contact admin');
        window.location='index.php';
        </script>";
   // header("Location: https://hmmatrimony.com");
    //die();
}
?>
<?php include("include/connect.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include("include/title.php"); ?>
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/register.js"></script>
<script type="text/javascript" src="js/form-field-tooltip.js"></script>
<script type="text/javascript" src="js/rounded-corners.js"></script>
<link type="text/css" rel="stylesheet" href="css/header-footer.css" />
<link type="text/css" rel="stylesheet" href="css/form-field-tooltip.css" />
<link type="text/css" rel="stylesheet" href="css/common.css" />
</head>
<body class="back">
<div id="body"><!--body id start-->
<?php include("include/header.php"); ?>
<br />
<div class="plr">
<style>
.error { color:#f00; font-size:11px; display:none; }
</style>
<script language="javascript">
function profile_add_disp(obj) {
	if (obj=="Self" || obj=="") {
		$('#addedfrm').html('Basic Information')		
		$('#conperson').hide()
	}
	else {
		$('#addedfrm').html("Basic Information Of Your "+obj)
		$('#conperson').show()
	}
}
function isNumberKey(evt) {
	var charCode = (evt.which) ? evt.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57))
	return false;
	return true;
}
</SCRIPT>
<script type="text/javascript">
var xmlHttp;
function dynshowHint(str,sitename,geturl,element_name) {
	xmlHttp = GetXmlHttpObject();
	if (xmlHttp==null) {
		alert ("Browser does not support HTTP Request");
		return;
	}
	document.getElementById(element_name).innerHTML='<img src="images/loading.gif">';
	var url = sitename+geturl;
	url = url+"&q="+str;
	url = url+"&sid="+Math.random();
	xmlHttp.onreadystatechange=
	function dynstateChanged() {
		if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete") {
			document.getElementById(element_name).innerHTML = xmlHttp.responseText;
			if (xmlHttp.responseText.length>4) {
				document.getElementById(element_name).innerHTML = xmlHttp.responseText;			
				if (element_name=='namedisp') {
					document.getElementById('username').focus();
				}
				return false;
			}
		} 
	};
	xmlHttp.open("GET/index.html",url,true);
	xmlHttp.send(null)
}
function GetXmlHttpObject() { 
	var objXMLHttp = null;
	if (window.XMLHttpRequest) {
		objXMLHttp = new XMLHttpRequest();
	}
	else if (window.ActiveXObject) {
		objXMLHttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	return (objXMLHttp);
} 
</script>
<script type="text/javascript">
  function getXMLHTTP() { //fuction to return the xml http object
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	
		{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		return xmlhttp;
	}
//Function for Displaying cities
function getcity(title)
{
//alert('hai');
//alert(title);
 var strURL="getinfo.php?title="+title;
  //alert(strURL);
   var req = getXMLHTTP();
   if (req)
   {
     req.onreadystatechange = function()
     {
      if (req.readyState == 4)
      {
  // only if "OK"
  if (req.status == 200)
         {
     document.getElementById('caste').innerHTML=req.responseText;
  } else {
       alert("There was a problem while using XMLHTTP:\n" + req.statusText);
  }
       }
      }
   req.open("GET", strURL, true);
   req.send(null);
   } 
}
//Function for Displaying and hiding.....
</script>
 <script type="text/javascript">
 function onlyNumbers(event) {
        var e = event || evt; // for trans-browser compatibility
        var charCode = e.which || e.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
	function validate_Email(email) 
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
	var x=document.getElementById("otp").value;
	if(x=="null" || x=="")
	{
	alert("Please Enter OTP");
	return false; 
	}
	return true;
}
</script>
<div class="plr">

<?php include("include/menu.php"); ?>
<style type="text/css">
.w90 {
    width: 50%;
}
</style>
<p class="amem uu">Already a Member? <a href="login.php">Click Here</a></p>
<div class="bdr">
<p class="jn_g2 p10px"><b>Mobile Verification</b>  (* Mandatory Fields)</p>
<div class="p10px gray joinNow"><br />
<form name="registerForm" id="registerForm" action="save_profile.php" method="post" enctype="multipart/form-data"  onSubmit="return validateForm();" >
<input id="command" type="hidden" name="command" value="verify" />
<input id="mobile_no" type="hidden" name="mobile_no" value="<?php echo $mobile_no; ?>" />
<input id="reg_id" type="hidden" name="reg_id" value="<?php echo $reg_id; ?>" />
<table width="98%" border="0" cellspacing="0" cellpadding="0">
<tr valign="top">
<td class="bdrR w66">
<h1 class="p5px10px mb15px bdrBd mr20px">Please enter your otp send to your mobile number</h1>

<table  style="font-size:15px;" width="100%"  border="0" cellpadding="0" cellspacing="0">
<tr>
<td class="p5px10px">OTP<span class="star">*</span></td>
<td class="p5px10px">
<input type="text" class="input w90" style="padding:3px;" name="otp" id="otp" value="" tooltipText="Please enter your otp send to your mobile number" />
<p class="error" id="name_error"></p>
</td>
</tr>
<tr valign="top">
<td class="p20px" style="padding-left:316px;" colspan="2">
<br />
<div class="rn_btn">
<input type="hidden" name="id1" value="submit_new">
<button type="submit"><span style="color:#FFFFFF; padding:5px; font-size:16px; font-weight:bold;">Verify My Mobile</span></button>
</div>
</td>
</tr>
</table>
</form>
</div>
</div>
</div>

<script type="text/javascript">
var tooltipObj = new DHTMLgoodies_formTooltip();
tooltipObj.setTooltipPosition('right');
tooltipObj.setPageBgColor('#f00');
tooltipObj.setCloseMessage('Exit');
tooltipObj.initFormFieldTooltip();
</script> 
<script language="javascript">
function chk()
{
	var a = document.getElementById('marital_status_code').value;	
	if (a != "12" && a != "")
		{
			$('#children').css('display','block');
		}
	else
		{
			$('#children').css('display','none');	
		}
}
</script>

<?php include("include/footer.php"); ?>
</div>
 </body>

</html>