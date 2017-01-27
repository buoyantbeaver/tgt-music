<!--Header -->
        <div class="header">
            <h1 class="logo">
            </h1>
        </div>
        <!--Top Menu -->
        <div class="topmenu"> 
            <a href="#" class="home " title="home"></a>
            <a href="the-loai-bai-hat/Nhac-Tre/EZEFZOB.html" class="active" title="Bài hát">Bài hát</a> 
            <a href="#"  title="Playlist">Playlist</a>  
            
            <a href="#"  title="MV">MV</a>
            
        </div>
        <!--Search -->        
        <div class="search" id="search">
            <div class="bgsearch">
                <div class="pd-input">
                    <input type="text" value="" class="input-search" onkeypress="return searchKeyPress(event);" id="txtSearchkey" name="txtSearchkey"/>
                    <input type="button" class="btn-search" onclick="search();
                return false;" id="btnSearch"/>
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