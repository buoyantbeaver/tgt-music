<?php
session_start();
include("./tgt/securesession.class.php");
include("./tgt/lang.php");
$ss = new SecureSession();
$ss->check_browser = true;
$ss->check_ip_blocks = 2;
$ss->secure_word = 'SALT_';
$ss->regenerate_id = true;
if (!$ss->Check() || !isset($_SESSION["username"]) || !$_SESSION["username"])
{
header('Location: ./control/login.php');
die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?echo admincp;?> | <?echo sitename;?></title>

    <!-- Bootstrap Core CSS -->
    <link href="./control/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="./control/css/sb-admin.css" rel="stylesheet">
    <link href="./control/css/icons.css" rel="stylesheet">

    <!-- Custom Fonts -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>

<body>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
				<span class="logo"><i class="fa fa-tachometer" aria-hidden="true"></i></span>
                <a class="navbar-brand" href="/admin.php"><?echo admincp?></a>
            </div>
            <!-- Top Menu Items -->
			<div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-right top-nav">
				<li>
					<a href="/" target="_blank"><i class="fa fa-home" aria-hidden="true"></i> <?echo home;?></a>
				</li>
                <li>
                    <a href="control/logout.php"><i class="fa fa-fw fa-power-off"></i><?echo logout;?> <?echo $_SESSION["username"];?></a>
               </li>
            </ul>
			</div>
			
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->	
			<?include("./control/menu.php");?>
			
        </nav>
			
        <div id="page-wrapper">

            <div class="container-fluid">
				<iframe name="content" id="content" src="./control/notes/index.php" seamless></iframe>
			</div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="control/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="control/js/bootstrap.min.js"></script>

</body>
</html>
