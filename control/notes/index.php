<?php
session_start();
include("./functions.php");
include("../../tgt/lang.php");
$ss = new SecureSession();
$ss->check_browser = true;
$ss->check_ip_blocks = 2;
$ss->secure_word = 'SALT_';
$ss->regenerate_id = true;
if (!$ss->Check() || !isset($_SESSION["username"]) || !$_SESSION["username"])
{
header('Location: ../login.php');
die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="images/favicon.html">
<title>Notes | <?echo sitename;?></title>
 
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-reset.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<script src="http://code.jquery.com/jquery-latest.js"></script>

<!--[if lt IE 9]><script src="js/ie8/ie8-responsive-file-warning.js"></script><![endif]-->
 
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Dashboard</h1>
    </div>
</div>
				
<div class="col-md-4" style="margin:0 auto;float:none!important;min-width:420px;">
	<div class="col-md-12 event-list-block">
		<div class="cal-day">
			<span><?echo $_SESSION["username"];?>'s Notes</span>
			<?php echo date('l d-M-Y');?>
		</div>
		<ul class="event-list">
			<?php loadnotes(); ?>
		</ul>
		<input type="text" class="form-control evnt-input" placeholder="QUICK NOTES - Enter to submit your note!">
	</div>
</div>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.slimscroll.js"></script>
<script src="js/script.js"></script>
</body>
</html>