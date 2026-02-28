<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include(__DIR__ . "/../../../include/title.php"); ?>

<!-- Adding base tag to ensure all css & images load correctly even if url changes -->
<base href="/Matrimony/public_html/" />

<link type="text/css" rel="stylesheet" href="css/header-footer.css" />
<link type="text/css" rel="stylesheet" href="css/common.css" />
</head>
<body class="back">
<div id="body"><!--body id start-->

<?php include(__DIR__ . "/../../../include/header.php"); ?>

<br />

<div class="plr">

	<?php include(__DIR__ . "/../../../include/menu.php"); ?>
	<p class="cb"></p>
	
<div class="plr">

<div class="heading pb5px bdrB mb2px">
<h1>About Us</h1>
</div>
<br class="lh1em" />

<div class="bdr gray p10px" style="min-height:300px; background-color: #FAFAFA;">
    <h2 style="color: #bf0000; font-size: 20px; font-weight: bold;"><?= htmlspecialchars($heading) ?></h2>
    <p style="font-size: 14px; line-height: 25px; margin-top:15px; color: #333;">
       <?= htmlspecialchars($content) ?>
    </p>
    <br>
    <p style="color: #666;"><i>(This UI is successfully rendered through our new Advanced MVC Architecture!)</i></p>
</div>

</div>
</div>

<?php include(__DIR__ . "/../../../include/footer.php"); ?>

</div>
</body>
</html>