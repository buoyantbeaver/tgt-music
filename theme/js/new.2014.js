$(document).scroll(function() {
    if ($(document).scrollTop() > 44) {
        $("#header_nav").addClass("header_nav fix").show();
        $("#icon_menu_logo").removeClass("hide");
        $("#icon_menu_home").addClass("hide");
        $("#goTopPage").removeClass("hide");
    }
    if ($(document).scrollTop() <= 44) {
        $("#header_nav").removeClass("fix").show();
        $("#icon_menu_home").removeClass("hide");
        $("#icon_menu_logo").addClass("hide");
        $("#goTopPage").addClass("hide");
    }
});

function changeItemPlaylist(currentItem){
$('#idScrllSongInAlbum').children("li").removeClass("active");
$('#itemSong_'+currentItem.index).attr('class','active');
$('div.idScrllSongInAlbum').scrollTop(currentItem.index*($('#itemSong_0').outerHeight())-8);}


function playlistOnError(jwplayer){if(jwplayer.getPlaylist().length>1){jwplayer.playlistNext();}else{$('#currentplay').html('Lỗi tải nhạc. Vui lòng F5 lại.');}}
  
$(document).ready(function() {           
            $('#goTopPage').click(function() {
            $('html, body').animate({scrollTop:0},500);
           });
});