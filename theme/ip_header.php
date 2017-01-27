	<div id="top_menu">
    <!--<div class="tleft">
		<a href="index.php">Home</a> | <a href="dieu-khoan.html">Điều khoản sử dụng</a> |<a href="lien-he.html">Liên hệ</a> 	
		</div>	-->
    </div>
	<div id="header">
    	<div class="logo"><a href="index.php"><img src="theme/images/logo.png" width="251" height="82" border="0" /></a></div>
<div id="tfheader">
<form id="tfnewsearch" method="get" action="tim-kiem/bai-hat.html">
<input class="tftextinput" type="text" name="key" id="key" placeholder="Nhập từ khóa cần tìm..." value="" autocomplete="off" required autofocus />
<input class="tfbutton" type="submit" value="Tìm kiếm" /></form>
	<div class="tfclear"></div>
	</div>

        <div class="clr"></div>
    </div>
    
    <div id="menu_nav">
        	<ul>
            	<li><a href="#">Trang chủ</a></li>
                <li><a href="#">Nhạc</a><ul><li><? include("./theme/box/ip_cat_mp3.php");?></li></ul></li>
                <li><a href="#">Video</a><ul><li><? include("./theme/box/ip_cat_video.php");?></li></ul></li>
                <li><a href="#">Album</a><ul><li><? include("./theme/box/ip_cat_album.php");?></li></ul></li>
                <!--<li><a href="#">Ca sỹ</a><ul><li><? include("./theme/box/ip_cat_singer.php");?></li></ul></li>-->				
                <li><a href="BXH/index.html">Bảng Xếp Hạng</a>
                    <ul>
                        <li>
                            <div class="navbox">
                            	<h3>Bài hát</h3>
                            	<p>
                                    <a href="BXH/bai-hat/Viet-Nam.html">Việt Nam</a>
                                    <a href="BXH/bai-hat/Au-My.html">Âu Mỹ</a>									
                                    <a href="BXH/bai-hat/Han-Quoc.html">Hàn Quốc</a>
                                    <br class="clr" />
                                </p>
                            	<h3>Video</h3>
                            	<p class="fjx">
                                    <a href="BXH/Video/Viet-Nam.html">Việt Nam</a>
                                    <a href="BXH/Video/Au-My.html">Âu Mỹ</a>
                                    <a href="BXH/Video/Han-Quoc.html">Hàn Quốc</a>
                                    <br class="clr" />
                                </p>
                            	<h3>Album</h3>
                            	<p class="fjx">
                                    <a href="BXH/Album/Viet-Nam.html">Việt Nam</a>
                                    <a href="BXH/Album/Au-My.html">Âu Mỹ</a>
                                    <a href="BXH/Album/Han-Quoc.html">Hàn Quốc</a>
                                    <br class="clr" />
                                </p>
													
                            </div>
                        </li>
                    </ul>
                </li>
                <!--<li><a href="danh-sach-playlist.html">Playlist thành viên</a><ul><li><? include("");?></li></ul></li>-->
                <li><a href="yeu-cau-nhac.html" target="_blank">Yêu cầu nhạc</a><ul><li><? include("");?></li></ul></li>
                <li><a href="news/all.html">News</a><ul><li><? include("");?></li></ul></li>	
                <li><a href="news/Tai-ve/EZEFZZF.html">Tải về</a><ul><li><? include("");?></li></ul></li>
                <li><a href="mobile" target="_blank">Mobile</a><ul><li><? include("");?></li></ul></li>							
					
<?
	if($_SESSION["tgt_user_id"]) {
	echo '<li id="MenuUser"><a href="cpanel/music/playlist.html">Thư viện nhạc của '.$_SESSION["tgt_user_name"].'</a>
                    <ul>
 						<li>
                        	<div class="navbox">
                            	<h3>Nhạc</h3>
                                <p>
                                    <a href="cpanel/music/upload.html">Bài hát của tôi</a>
                                    <a href="cpanel/music/favourite.html">Bài hát yêu thích</a>
                                    <a href="cpanel/music/playlist.html">Playlist của tôi</a>
									<a href="cpanel/music/favouritep.html">Playlist yêu thích</a>
									<br class="clr" />
                                </p>
                            	<h3>Video</h3>
                                <p>
									<a href="cpanel/video/upload.html">Video của tôi</a>
                                    <a href="cpanel/video/favourite.html">Video yêu thích</a>
									<br class="clr" />
                                </p>
							</div>
                         </li>
                    </ul></li>';
	}
	?>
	
        <div class="tright" id="LoginTGT"></div>
        <div class="clr"></div>
    </div>
	