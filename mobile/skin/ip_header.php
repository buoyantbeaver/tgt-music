		<!--Header -->
        <div class="header">
            <h1 class="logo">
                <a href="<? echo SITE_LINK ?>mobile/" title="IPOS 1.0 Mobile"><img src="images/logo.gif" alt="IPOS 1.0 Mobile" width="68" height="37" border="0" /></a>
            </h1>
            <span><a href="<? echo SITE_LINK ?>mobile/tim-kiem" title="Tìm kiếm"><img alt="Tìm kiếm" src="images/search.png" width="43" height="37" border="0" /></a></span>
            <span><a href="<? echo SITE_LINK ?>mobile/danh_muc" title="Danh mục"><img alt="Danh mục" src="images/list.png" width="43" height="37" border="0" /></a></span>                      
            <span><a href="<? echo SITE_LINK ?>mobile/login" title="Đăng nhập"><img alt="Đăng nhập" src="images/user.png" width="43" height="37" border="0" /></a></span>
            

            


            
        </div>
        <!--Top Menu -->
        <div class="topmenu"> 
            <a href="<? echo SITE_LINK ?>mobile" class="home ac" title="IPOS 1.0 Mobile"></a>
            <a href="the-loai-bai-hat/Nhac-Tre/EZEFZOB.html"  title="Bài hát">Bài hát</a> 
            <a href="the-loai-album/Nhac-Viet-Nam/EZEFZOA.html"   title="Playlist">Playlist</a>  
            
            <a href="the-loai-video/Nhac-Tre/EZEFZOB.html"  title="MV">MV</a>
            
        </div>
        <!--Search -->
        
        <div class="search" id="search">
            <div class="bgsearch">
                <div class="pd-input">
                    <input type="text" value="" class="input-search" onkeypress="return searchKeyPress(event);" id="txtSearchkey" name="txtSearchkey">
                    <input type="button" class="btn-search" onclick="search();
                return false;" id="btnSearch">
                </div>
            </div>
        </div>
<?
	if($_SESSION["tgt_user_id"]) {
	echo '<li id="MenuUser"><a href="cpanel/music/playlist.html">Nhạc của '.$_SESSION["tgt_user_name"].'</a>
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