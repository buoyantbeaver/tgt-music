function playerReady(thePlayer) {
    player = document.getElementById(thePlayer.id);
	player.addModelListener('ERROR', 'errorMonitor');
    printPlaylistData();
};
function printPlaylistData() {
    var plst = player.getPlaylist();
    if (plst && plst.length > 0) {
        player.addControllerListener("ITEM", "nextTracker");
        $(".playlist li:eq(0)").addClass("playing");
    } else {
        setTimeout("printPlaylistData()", 100);
    }
};
function nextTracker(obj) {
    $(".list_play_all_song li").removeClass("playing");
    $(".list_play_all_song li:eq(" + obj.index + ")").addClass("playing");
}
function viewLyric(){
	if($(".txt_lyric").hasClass('min')){
		$(".txt_lyric").removeClass('min');
		$(".txt_lyric").css("height", "100%");
	}else{
		$(".txt_lyric").addClass('min');
		$(".txt_lyric").css("height", "125");
	}
}
function loadSong(i, lyric){
	jwplayer().playlistItem(i);
	console.log(lyric);
}