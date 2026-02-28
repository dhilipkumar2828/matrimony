<?php 
include("include/connect.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include("include/title.php"); ?>
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<link type="text/css" rel="stylesheet" href="css/header-footer.css" />
<link type="text/css" rel="stylesheet" href="css/common.css" />
</head>
<body class="back">
	    <style type="text/css"><style type="text/css">
.paginate {
font-family:Arial, Helvetica, sans-serif;
padding: 3px;
margin: 3px;
}
.paginate a {
	padding:2px 5px 2px 5px;
	margin:2px;
	border:1px solid #999;
	text-decoration:none;
	color: #0099FF;
}
.paginate a:hover, .paginate a:active {
	border: 1px solid #999;
	color: #3300CC;
}
.paginate span.current {
    margin: 2px;
	padding: 2px 5px 2px 5px;
border: 1px solid #999;
font-weight: bold;
background-color: #999;
color: #FFF;
}
.paginate span.disabled {
padding:2px 5px 2px 5px;
margin:2px;
border:1px solid #eee;
color:#DDD;
}
.searching_jo
{
  background: none repeat scroll 0 0 #FFFFCC;
    border: 1px solid #006699;
    border-radius: 10px 10px 10px 10px;
    margin-bottom: 5px;
    margin-left: 38px;
    padding: 5px;
    width: 813px;
}
</style>
<div id="body"><!--body id start-->

<?php include("include/header.php"); ?>
<br />
<div class="plr">

<?php include("include/menu.php"); ?>
	<p class="cb"></p>
	<br />
<div class="heading pb5px bdrB mb2px">
<h1>User Id Search</h1>
</div>
<p class="tree">&bull;<a href="index.php">Home</a>&bull; User Id Search</p>
<br />

<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
<tr valign="top">
<td>
<p class="refine_bg2 large b p5px15px">User Id Search</p>
<p class="cb"></p>
<div class="p5px bgfbfff8 bdrbed563">
<link href="extension/Highslides/css/highslides.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="extension/Highslides/highslide-with-html.js"></script>
    <script type="text/javascript" src="extension/Highslides/highslide_manage.js"></script>
    <script type="text/javascript">
        hs.graphicsDir = 'extension/Highslides/graphics/';
        hs.outlineType = 'rounded-white';
        hs.outlineWhileAnimating = true;
</script>
<script type="text/javascript">
function validlogin12()
{
var x=document.getElementById("user_id").value;
if(x=="null" || x=="")
{
alert("Please Enter User Id");
return false; 
}
return true;
}
</script>
<form action="userid_search.php" method="post" name="topsearch" onSubmit="return validlogin12();">
<input type="hidden" name="command" id="command" value="search_profile" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr valign="top">
<td class="p5px10px" width="28%"><p class="mb5px">UserId</p>
<input type="text" name="user_id" id="user_id" />
</td>
<td width="28%" class="p5px10px">
<input type="submit" name="submit" id="submit" class="bt" value="Search Profiles" style='background: url("images/bg.png") no-repeat scroll 0 -960px transparent;
 border: 0 none; cursor:pointer; color: #FFFFFF; font-weight: bold; height: 25px; margin-bottom: 8px; outline: medium none; width: 120px;' /></td>
</tr>
</table>
</form>

</div>
<br />

</td>
<td width="220" class="pl15px"></td>
</tr>
</table>



<?php
if(isset($_POST['submit']))
{
$user_id=$_POST['user_id'];
$result =mysqli_query($con, "SELECT * FROM register where username='$user_id' and status='1'");
$i=1;
if(mysqli_num_rows($result)>0)
{
while($usprod=mysqli_fetch_array($result))
{
$id=$usprod['id'];
?>
<table width="100%" cellpadding="5" cellspacing="5">
<tr>
<td  align="right"><span style="color:#0033FF; font-weight:bold; font-size:14px;"></span></td>
<td></td>
<td><span style="color:#FF0000; font-size:14px;"></span></td>
<td align="right"><span style="color:#0033FF; font-weight:bold; font-size:14px;">Userid</span></td>
<td>:</td>
<td><?php echo ucwords($usprod['username']); ?></td>
</tr>
<tr>
<td width="18%" align="right"><span style="color:#0033FF; font-weight:bold; font-size:14px;">Name</span></td>
<td width="1%">:</td>
<td width="25%"><span style="color:#FF0000; font-size:14px;"><?php echo  ucwords($usprod['name']); ?></span></td>
<td width="20%" align="right"><span style="color:#0033FF; font-weight:bold; font-size:14px;">Gender</span></td>
<td width="1%">:</td>
<td width="35%"><?php echo  ucwords($usprod['gender']); ?></td>
</tr>
<tr>
<td  align="right"><span style="color:#0033FF; font-weight:bold; font-size:14px;">Date of Birth</span></td>
<td>:</td>
<td><span style="color:#FF0000; font-size:14px;"><?php echo $usprod['dob']; ?></span></td>
<td align="right"><span style="color:#0033FF; font-weight:bold; font-size:14px;">Age</span></td>
<td>:</td>
<td><?php echo $usprod['age']; ?></td>
</tr>
<tr>
<td  align="right"><span style="color:#0033FF; font-weight:bold; font-size:14px;">Time of Birth</span></td>
<td>:</td>
<td><span style="color:#FF0000; font-size:14px;"><?php echo $usprod['tob']; ?></span></td>
<td align="right"><span style="color:#0033FF; font-weight:bold; font-size:14px;">Place of Birth</span></td>
<td>:</td>
<td><?php echo ucwords($usprod['p_birth']); ?></td>
</tr>
<?php
$caste1=$usprod['religion'];
$man=mysqli_query($con,"select * from caste where id='$caste1'");
$man11=mysqli_fetch_array($man);
$subcaste11=$usprod['caste'];
$man112=mysqli_query($con,"select * from subcaste where id='$subcaste11'");
$man111=mysqli_fetch_array($man112);
?>
<tr>
<td  align="right"><span style="color:#0033FF; font-weight:bold; font-size:14px;">Caste</span></td>
<td>:</td>
<td><span style="color:#FF0000; font-size:14px;"><?php echo ucwords($man11['caste']); ?></span></td>
<td align="right"><span style="color:#0033FF; font-weight:bold; font-size:14px;">Sub Caste</span></td>
<td>:</td>
<td><?php echo ucwords($man111['subcaste']); ?></td>
</tr>
<tr>
<td  align="right"><span style="color:#0033FF; font-weight:bold; font-size:14px;">Star</span></td>
<td>:</td>
<td><span style="color:#FF0000; font-size:14px;"><?php echo ucwords($usprod['star']); ?></span></td>
<td align="right"><span style="color:#0033FF; font-weight:bold; font-size:14px;">Moonsign</span></td>
<td>:</td>
<td><?php echo ucwords($usprod['moonsign']); ?></td>
</tr>
<tr>
<td  align="right"><span style="color:#0033FF; font-weight:bold; font-size:14px;">Education</span></td>
<td>:</td>
<td><span style="color:#FF0000; font-size:14px;"><?php echo ucwords($usprod['education']); ?>
<?php if($usprod['edu_det']!='') { ?> [<?php echo ucwords($usprod['edu_det']); ?>]<?php } ?></span></td>
<td align="right"><span style="color:#0033FF; font-weight:bold; font-size:14px;">Place of birth</span></td>
<td>:</td>
<td><?php echo $usprod['p_birth']; ?></td>
</tr>
<tr>
<td  align="right"><span style="color:#0033FF; font-weight:bold; font-size:14px;">Father's Name</span></td>
<td>:</td>
<td><span style="color:#FF0000; font-size:14px;"><?php echo ucwords($usprod['fathername']); ?></span></td>
<td align="right"><span style="color:#0033FF; font-weight:bold; font-size:14px;">Father's Occupation</span></td>
<td>:</td>
<td><?php echo ucwords($usprod['father_occupation']); ?></td>
</tr>
<tr>
<td  align="right"><span style="color:#0033FF; font-weight:bold; font-size:14px;">Mother's Name</span></td>
<td>:</td>
<td><span style="color:#FF0000; font-size:14px;"><?php echo ucwords($usprod['mother_name']); ?></span></td>
<td align="right"><span style="color:#0033FF; font-weight:bold; font-size:14px;">Mother's Occupation</span></td>
<td>:</td>
<td><?php echo ucwords($usprod['mother_occupation']); ?></td>
</tr>
<tr>
<td  align="right"><span style="color:#0033FF; font-weight:bold; font-size:14px;">Number of brothers</span></td>
<td>:</td>
<td><span style="color:#FF0000; font-size:14px;"><?php echo ucwords($usprod['no_of_brothers']); ?></span></td>
<td align="right"><span style="color:#0033FF; font-weight:bold; font-size:14px;">Number of Sisters</span></td>
<td>:</td>
<td><?php echo ucwords($usprod['no_of_sisters']); ?></td>
</tr>
<tr>
<td  align="right"><span style="color:#0033FF; font-weight:bold; font-size:14px;">Married brothers</span></td>
<td>:</td>
<td><span style="color:#FF0000; font-size:14px;"><?php echo ucwords($usprod['bro_married']); ?></span></td>
<td align="right"><span style="color:#0033FF; font-weight:bold; font-size:14px;">Married Sisters</span></td>
<td>:</td>
<td><?php echo ucwords($usprod['sis_married']); ?></td>
</tr>
<tr>
<td  align="right"><span style="color:#0033FF; font-weight:bold; font-size:14px;">Skin Color</span></td>
<td>:</td>
<td><span style="color:#FF0000; font-size:14px;"><?php echo ucwords($usprod['skin']); ?></span></td>
<td align="right"><span style="color:#0033FF; font-weight:bold; font-size:14px;">Height</span></td>
<td>:</td>
<td><?php echo ucwords($usprod['height']); ?></td>
</tr>
<tr>
<td  align="right"><span style="color:#0033FF; font-weight:bold; font-size:14px;">Company Name</span></td>
<td>:</td>
<td><span style="color:#FF0000; font-size:14px;"><?php echo ucwords($usprod['job_cmpy']); ?></span></td>
<td align="right"><span style="color:#0033FF; font-weight:bold; font-size:14px;">Job Details</span></td>
<td>:</td>
<td><?php echo ucwords($usprod['job']); ?></td>
</tr>
<tr>
<td  align="right"><span style="color:#0033FF; font-weight:bold; font-size:14px;">Job Location</span></td>
<td>:</td>
<td><span style="color:#FF0000; font-size:14px;"><?php echo ucwords($usprod['job_loc']); ?></span></td>
<td align="right"><span style="color:#0033FF; font-weight:bold; font-size:14px;">Salary</span></td>
<td>:</td>
<td><?php echo ucwords($usprod['salary']); ?></td>
</tr>
<tr>
<td  align="right"><span style="color:#0033FF; font-weight:bold; font-size:14px;">Self Description</span></td>
<td>:</td>
<td colspan="4"><span style="color:#FF0000; font-size:14px;"><?php echo ucwords($usprod['self_desc']); ?></span></td>
</tr>

<tr>
<td  align="right"><span style="color:#0033FF; font-weight:bold; font-size:14px;">Profile Picture</span></td>
<td>:</td>
<td colspan="4">
<?php if($usprod['uploadedfile']=='') { echo '<span style="color:#FF0000; font-weight:bold;">Picture not found</span>'; } else { ?>
<img src="profile/<?php echo $usprod['uploadedfile']; ?>" height="300" width="300" />
<?php } ?>
</td>
</tr>
<?php
$horo=$usprod['horo'];
if($horo!='')
{
?>
<tr>
<td  align="right"><span style="color:#0033FF; font-weight:bold; font-size:14px;">Horoscope</span></td>
<td>:</td>
<td colspan="4">
<img src="admin/horo/<?php echo $usprod['horo']; ?>" height="300" width="500" />
</td>
</tr>
<?php
}
else
{
?>
<tr>
<td  align="right"><span style="color:#0033FF; font-weight:bold; font-size:14px;">Horoscope</span></td>
<td>:</td>
<td colspan="4">
<span style="color:#FF0000; font-weight:bold;">Horoscope not yet uploaded</span>
</td>
</tr>
<?php
}
?>
</table>
            

<?php
}
}
?>
 
 
 
 
 
 
 <?php
}
?>



</div>
<?php include("include/footer.php"); ?>
</div>
<script type="text/javascript">
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-16625285-7']);
_gaq.push(['_setDomainName', '.matrimonialsindia.com']);
_gaq.push(['_trackPageview']);
(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
</script> </body>
</html>