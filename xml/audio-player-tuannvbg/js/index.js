var num = 0;
var hiddenPlayer = $('#hidden-player');
var player = $('#player');
var title = $('.title');
var artist = $('.artist');
var cover = $('.coverr');

function secondsTimeSpanToHMS(s) {
	var h = Math.floor(s / 3600); //Get whole hours
	s -= h * 3600;
	var m = Math.floor(s / 60); //Get remaining minutes
	s -= m * 60;
	return h + ":" + (m < 10 ? '0' + m : m) + ":" + (s < 10 ? '0' + s : s); //zero padding on minutes and seconds
};

songs = [{
		src: "http://k003.kiwi6.com/hotlink/jl2xpsy7fc/Nhat_Ky_-_Trieu_Hoang.mp3",
		title: "Nhật Ký",
		artist: "Triệu Hoàng",
		coverart: "http://avatar.nct.nixcdn.com/playlist/2015/03/21/1/3/7/8/1426915918116_500.jpg"
	},

	{
		src: "http://k002.kiwi6.com/hotlink/vbccry8dsa/Dong_Nhi_-_Khoc.mp3",
		title: "Khóc",
		artist: "Đông Nhi",
		coverart: "http://img.news.zing.vn/img/177/t177780.jpg"
	},

	{
		src: "http://k002.kiwi6.com/hotlink/y5e06hackc/Truong_Quynh_Anh_-_Don_Coi.mp3",
		title: "Đơn Côi",
		artist: "Trương Quỳnh Anh",
		coverart: "http://www.xaluan.com/images/news/Image/2009/02/24/080921bai6anh7.jpg"
	},

	{
		src: "http://www.musicsite.biz/mp3_uploader/files/user_songs/20120915/tuannvbg/954-14361.mp3",
		title: "Liên Khúc Tuấn Ai Cho Tôi Tình Yêu",
		artist: "Tuấn Vũ",
		coverart: "http://avatar.nct.nixcdn.com/singer/avatar/2016/01/25/4/1/1/7/1453717652492.jpg"
	},

	{
		src: "http://www.musicsite.biz/mp3_uploader/files/user_songs/20120915/tuannvbg/954-14365.mp3",
		title: "Liên Khúc Bông Cỏ May",
		artist: "Tuấn Vũ",
		coverart: "http://avatar.nct.nixcdn.com/singer/avatar/2016/01/25/4/1/1/7/1453717652492.jpg"
	}
];

var initSongSrc = songs[0].src;
var initSongTitle = songs[0].title;
var initSongArtist = songs[0].artist;
var initSongCover = songs[0].coverart;

hiddenPlayer.attr("src", initSongSrc);
title.html(initSongTitle);
artist.html(initSongArtist);
cover.attr('src', initSongCover);

hiddenPlayer.attr('order', '0');
hiddenPlayer[0].onloadedmetadata = function() {
	var dur = hiddenPlayer[0].duration;
	var songLength = secondsTimeSpanToHMS(dur)
	var songLengthParse = songLength.split(".")[0];
	$('.time-finish').html(songLengthParse);
};

var items = songs.length - 1;

$('.next').on('click', function() {
	var songOrder = hiddenPlayer.attr('order');

	if (items == songOrder) {
		num = 0;
		var songSrc = songs[0].src;
		var songTitle = songs[0].title;
		var songArtist = songs[0].artist;
		var songCover = songs[0].coverart;
		hiddenPlayer.attr('order', '0');
		hiddenPlayer.attr('src', songSrc).trigger('play');
		title.html(songTitle);
		artist.html(songArtist);
		cover.attr('src', songCover);
	} else {
		console.log(songOrder);
		num += 1;
		var songSrc = songs[num].src;
		var songTitle = songs[num].title;
		var songArtist = songs[num].artist;
		var songCover = songs[num].coverart;
		hiddenPlayer.attr('src', songSrc).trigger('play');
		title.html(songTitle);
		artist.html(songArtist);
		cover.attr('src', songCover);
		hiddenPlayer.attr('order', num);
	}
});

$('.prev').on('click', function() {
	var songOrder = hiddenPlayer.attr('order');

	if (songOrder == 0) {
		num = items;
		var songSrc = songs[items].src;
		var songTitle = songs[items].title;
		var songArtist = songs[items].artist;
		hiddenPlayer.attr('order', items);
		hiddenPlayer.attr('src', songSrc).trigger('play');
		title.html(songTitle);
		artist.html(songArtist);
	} else {
		num -= 1;
		var songSrc = songs[num].src;
		var songTitle = songs[num].title;
		var songArtist = songs[num].artist;
		hiddenPlayer.attr('src', songSrc).trigger('play');
		title.html(songTitle);
		artist.html(songArtist);
		hiddenPlayer.attr('order', num);
	}
});

$(".play-button").click(function() {
	$(this).toggleClass("paused");
	if ($(this).hasClass("paused")) {
		hiddenPlayer[0].pause();
	} else {
		hiddenPlayer[0].play();
	}
});

hiddenPlayer.on('timeupdate', function() {
	var songLength = secondsTimeSpanToHMS(this.duration)
	var songLengthParse = songLength.split(".")[0];
	$('.time-finish').html(songLengthParse);

	var songCurrent = secondsTimeSpanToHMS(this.currentTime)
	var songCurrentParse = songCurrent.split(".")[0];
	$('.time-now').html(songCurrentParse);
	$('progress').attr("value", this.currentTime / this.duration);

	if (!hiddenPlayer[0].paused) {
		$(".play-button").removeClass('paused');
		$('progress').css('cursor', 'pointer');
		
		
		$('progress').on('click', function(e) {
			var parentOffset = $(this).parent().offset(); 
			var relX = e.pageX - parentOffset.left;
			var percPos = relX * 100 / 355;
			var second = hiddenPlayer[0].duration * parseInt(percPos) / 100;
			console.log(second);
			hiddenPlayer[0].currentTime = second;
		})
	}
	
	if (this.currentTime == this.duration) {
		$('.next').trigger('click');
	}
});