<div class="menu_left">
<div class="title nhac">Nhạc</div>
<ul class="singer_">
    <li <? if($act == "music/upload") echo 'class="_black"';?>><a href="cpanel/music/upload.html">Bài hát của tôi</a></li>
    <li <? if($act == "music/favourite") echo 'class="_black"';?>><a href="cpanel/music/favourite.html">Bài hát yêu thích</a></li>
    <li <? if($act == "music/playlist") echo 'class="_black"';?>><a href="cpanel/music/playlist.html">Playlist của tôi</a></li>
    <li <? if($act == "music/favouritep") echo 'class="_black"';?>><a href="cpanel/music/favouritep.html">Playlist yêu thích</a></li>
</ul>
</div>
<div class="menu_left">
<div class="title video">Video</div>
<ul class="singer_">
     <li <? if($act == "video/upload") echo 'class="_black"';?>><a href="cpanel/video/upload.html">Video của tôi</a></li>
     <li <? if($act == "video/favourite") echo 'class="_black"';?>><a href="cpanel/video/favourite.html">Video yêu thích</a></li>
</ul>
</div>