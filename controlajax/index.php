<?php
session_start();
include("../tgt/securesession.class.php");
include("../tgt/lang.php");
$ss = new SecureSession();
$ss->check_browser = true;
$ss->check_ip_blocks = 2;
$ss->secure_word = 'SALT_';
$ss->regenerate_id = true;
if (!$ss->Check() || !isset($_SESSION["username"]) || !$_SESSION["username"])
{
header('Location: login.php');
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
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="css/icons.css" rel="stylesheet">

    <!-- Custom Fonts -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script>
$(document).ready(function(){
	$('#side a').click(function(e){
	e.preventDefault();
	$("#content").load($(this).attr('href'));
	});
});
</script>
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
                <a class="navbar-brand" href="/control"><?echo admincp?></a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
				<li>
					<a href="/" target="_blank"><i class="fa fa-home" aria-hidden="true"></i> <?echo home;?></a>
				</li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?echo $_SESSION["username"];?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
                        <li>
                            <a href="./media/cau_hinh.php"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log out</a>
                        </li>
                    </ul>
                </li>
            </ul>
			
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->			
			<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul id="side" class="nav navbar-nav side-nav">
			<li>
				<span class="library"><?echo media;?></span>
				<ul class="holder">
					<li class="active"><a href="./media/library.php?mode=songs"><span><?echo audio;?></span></a></li>
					<li><a href="./media/media.php?mode=add"><span>Thêm mới Nhạc/Video </span></a></li>
					<li><a href="./media/library.php?mode=clip_music"><span>Danh sách video</span></a></li>
					<li><a href="./media/library.php?mode=broken"><span>Danh sách media bị lỗi</span></a></li>
					<li><a href="./media/library.php?mode=top_hot"><span>Danh sách top hot</span></a></li>
					<li><a href="./media/library.php?mode=hq"><span>D/s nhạc 320kps</span></a></li>
					<li><a href="./media/library.php?mode=mem_upload"><span>D/s media mem upload</span></a></li>
				</ul>
			</li>
			<li>
				<span class="albums"><?echo albums;?></span>
				<ul class="holder">
					<li><a href="./media/media.php?mode=multi_add_song"><span>Thêm mới Album/Playlist</span></a></li>
					<li><a href="./media/list_album.php"><span>Danh sách album</span></a></li>
					<li><a href="./media/list_album.php?mode=hot"><span>Danh sách album hot</span></a></li>
					<li><a href="./media/list_album.php?mode=tv"><span>D/s album member</span></a></li>
				</ul>
			</li>
			<li>
				<span class="artists"><?echo artists;?></span>
				<ul class="holder">
					<li><a href="./media/list_singer.php"><span>Danh sách singer</span></a></li>
					<li><a href="./media/singer.php?mode=add"><span>Thêm mới singer </span></a></li>
				</ul>
			</li>
			<li>
				<span class="genres"><?echo genres;?></span>
				<ul class="holder">
					<li><a href="./media/list_cat.php"><span>Danh sách thể loại</span></a></li>
					<li><a href="./media/cat.php?mode=add"><span>Thêm mới thể loại </span></a></li>
				</ul>
			</li>
			<li>
				<span class="members"><?echo members;?></span>
				<ul class="holder">
					<li><a href="./media/list_user.php"><span>Danh sách thành viên</span></a></li>
					<li><a href="./media/user.php?mode=add"><span>Thêm mới user </span></a></li>
				</ul>
			</li>
			<li>
				<span class="news"><?echo news;?></span>
				<ul class="holder">
					<li><a href="./media/list_news.php"><span>Danh Sách</span></a></li>
					<li><a href="./media/news.php?mode=add"><span>Thêm mới Tin Tức</span></a></li>
				</ul>
			</li>
			<li>
				<span class="advert"><?echo advert;?></span>
				<ul class="holder">
					<li><a href="./media/adv_list.php"><span>Danh sách</span></a></li>
					<li><a href="./media/adv.php?act=add"><span>Thêm mới </span></a></li>
				</ul>
			</li>
			<li>
				<span class="system"><?echo system;?></span>
				<ul class="holder">
					<li><a href="./media/cau_hinh.php"><span>Cấu hình website</span></a></li>
					<li><a href="./media/chu_de1.php"><span>Danh sách chủ đề</span></a></li>
					<li><a href="./media/list_cm.php"><span>Danh sách bình luận</span></a></li>
					<li><a href="./media/server.php"><span>Server chứa nhạc</span></a></li>
					<li><a href="xoa_cache.php" target="_blank">Cập nhật cache website</a>
					<li><a href="logout.php"><span>Đăng xuất</span></a></li>
				</ul>
			</li>
			</ul>
			</div>
            <!-- /.navbar-collapse -->
			
        </nav>

        <div id="page-wrapper">

            <div id="content" class="container-fluid">
			<!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Dashboard</h1>
                    </div>
                </div>
				<iframe src="notes/index.php" width="100%;" height="500px" frameBorder="0"></iframe>
			</div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
