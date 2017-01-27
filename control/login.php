<?php
define('TGT-MUSIC',true);
include("../tgt/tgt_music.php");
include("../tgt/class.inputfilter.php");
include("../tgt/securesession.class.php");
include("../tgt/lang.php");

$myFilter = new InputFilter();
$ss = new SecureSession();
$ss->check_browser = true;
$ss->check_ip_blocks = 2;
$ss->secure_word = 'SALT_';
$ss->regenerate_id = true;
$ss->Open();
		  
if(isset($_GET["act"]) && $_GET["act"] == "login"){
	$username = mysql_real_escape_string($myFilter->process($_POST["user"]));
	$password =mysql_real_escape_string($myFilter->process($_POST["pass"]));
	$pass2 =mysql_real_escape_string($myFilter->process($_POST["pass2"]));
	$arr = $tgtdb->databasetgt(" userid, username, password, salt , user_level ","user"," username = '".$username."'");
	$pass_new = md5(md5($password) . $arr[0][3]);
	
	if (count($arr)<1) { 
		mss("Username doesn\'t exist!","../admin.php");
		exit();
	}
	elseif ($pass_new != $arr[0][2]) {
		mss("Mật khẩu không đúng !","../admin.php");
		exit();
	}
	elseif ($pass2 != PASS2ADMIN) {
		mss("Mật khẩu không đúng !","../admin.php");
		exit();
	}
	elseif ($arr[0][4] == 3) {
			$_SESSION["username"] = $username;
			$_SESSION["admin_id"] = $arr[0][0];
			$_SESSION["rights"] = $arr[0][2];
			mss("Welcome ".$_SESSION["username"]." to Admin Control Panel!","../admin.php");
			exit();
	}
	else {
		mss("You don\'t have permission to access this page!","../index.php");
		exit();
	}
}
elseif ($_SESSION["admin_id"] == true) {
		mss("You\'ve already logged in!","../admin.php");
		exit();
}
	
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | <?echo admincp;?></title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="body-Login-back" style="background-color:#f2f2f2">

    <div class="container">
       
        <div class="row">
			<div class="col-md-4 col-md-offset-4 text-center logo-margin" style="font-size: 50px;margin-bottom:40px">
				<i class="fa fa-music" aria-hidden="true"></i>
			</div>
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-green">                  
                    <div class="panel-heading">
                        <h3 class="panel-title text-center text-bold"><?echo admincp;?></h3>
                    </div>
                    <div class="panel-body">
                        <form name="signin" method="post" action="login.php?act=login" role="form">
                            <fieldset>
                                <div class="form-group">
                                    <input name="user" type="text" class="form-control" placeholder="Username" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="pass" type="password" value="">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Secondary Password" name="pass2" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label><input name="remember" type="checkbox" value="Remember Me">Remember Me</label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" name="login" class="btn btn-lg btn-primary btn-block">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>