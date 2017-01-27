var searchKeyPress, search, userLikeSong, userLikePlaylist, userLikeMV,
        postComment, userNotLogin;

var getIndex, setActiveSong, showSongPlaylist, showRelatedPlaylist, setActiveTag, showRelatedSong, showLyric, ShowMorePlayList;


search = function() {
    var key = document.getElementById("txtSearchkey")
            .value;
    key = encodeURIComponent(key)
            .replace(/%20/g, "+");
    window.location = "tim-kiem/bai-hat.html?key=" + key;
};

searchSubKey = function() {
    var key = document.getElementById("txtSearchSubkey")
            .value;
    key = encodeURIComponent(key)
            .replace(/%20/g, "+");
    window.location = "tim-kiem/bai-hat.html?key=" + key;
};

searchKeyPress = function(e) {
    if (e.keyCode == 13) {
        search();
        return false;
    }
};
searchSubKeyPress = function(e) {
    if (e.keyCode == 13) {
        searchSubKey();
        return false;
    }
};

userLikeSong = function(type) {
    var songLike = document.getElementById('hdSong')
            .value;
    var urlCallback = document.getElementById('hdUrlCallback')
            .value;

    if (songLike.length < 0) {
        alert("BA i hA�t khA�ng tồn tại");
        return;
    }
    var inputLike = document.getElementById("btnLiked");
    if (type == 'like') {
        inputLike.value = "Hết thA�ch";
        inputLike.setAttribute('onclick', 'userLikeSong("unlike");return false;');
    } else {
        inputLike.value = "ThA�ch";
        inputLike.setAttribute('onclick', 'userLikeSong("like");return false;');
    }

    ajax.load(NCTInfo.ROOT_URL + 'ajax/like?type=song&key=' + songLike, function(data) {
        if (data.error_code == 2) {
            inputLike.value = 'ThA�ch';
            inputLike.setAttribute('onclick', 'userLikeSong("like");return false;');
            document.getElementById("notlogin")
                    .innerHTML = (urlCallback.length > 0) ? 'Bạn phải <a href="' + NCTInfo.ROOT_URL + 'login?r=' + urlCallback + '">đăng nhập </a> để sử dụng chức năng nA y.' : 'Bạn phải <a href="' + NCTInfo.ROOT_URL + 'login">đăng nhập </a> để sử dụng chức năng nA y.';
            document.getElementById("notlogin")
                    .style.display = "block";
            return;
        } else if (data.error_code == 0) {
            document.getElementById("notlogin")
                    .style.display = "none";
            document.getElementById("notlogin")
                    .innerHTML = "";
            if (data.result == "unlike") {
                inputLike.value = 'Hết ThA�ch';
                inputLike.setAttribute('onclick', 'userLikeSong("unlike");return false;');
            } else if (data.result == "like") {
                inputLike.value = 'ThA�ch';
                inputLike.setAttribute('onclick', 'userLikeSong("like");return false;');
            }
        } else {
            inputLike.value = 'ThA�ch';
            inputLike.setAttribute('onclick', 'userLikeSong("like");return false;');
            document.getElementById("notlogin")
                    .innerHTML = 'CA� lỗi xảy ra, vui lA�ng thử lại sau.';
            document.getElementById("notlogin")
                    .style.display = "block";
            return;
        }
    }, 'json', 'post');
};

userLikePlaylist = function(type) {
    var listLike = document.getElementById('hdPlaylist')
            .value;
    var urlCallback = document.getElementById('hdUrlCallback')
            .value;

    if (listLike.length < 0) {
        alert("Playlist khA�ng tồn tại");
        return;
    }
    var inputLike = document.getElementById("btnLiked");
    if (type == 'like') {
        inputLike.value = "Hết thA�ch";
        inputLike.setAttribute('onclick', 'userLikePlaylist("unlike");return false;');
    } else {
        inputLike.value = "ThA�ch";
        inputLike.setAttribute('onclick', 'userLikePlaylist("like");return false;');
    }
    ajax.load(NCTInfo.ROOT_URL + 'ajax/like?type=playlist&key=' + listLike, function(data) {
        if (data.error_code == 2) {
            inputLike.value = 'ThA�ch';
            inputLike.setAttribute('onclick', 'userLikePlaylist("like");return false;');
            document.getElementById("notlogin")
                    .innerHTML = (urlCallback.length > 0) ? 'Bạn phải <a href="' + NCTInfo.ROOT_URL + 'login?r=' + urlCallback + '">đăng nhập </a> để sử dụng chức năng nA y.' : 'Bạn phải <a href="' + NCTInfo.ROOT_URL + 'login">đăng nhập </a> để sử dụng chức năng nA y.';
            document.getElementById("notlogin")
                    .style.display = "block";
            return;
        } else if (data.error_code == 0) {
            document.getElementById("notlogin")
                    .style.display = "none";
            document.getElementById("notlogin")
                    .innerHTML = "";
            if (data.result == "unlike") {
                inputLike.value = 'Hết ThA�ch';
                inputLike.setAttribute('onclick', 'userLikePlaylist("unlike");return false;');
            } else if (data.result == "like") {
                inputLike.value = 'ThA�ch';
                inputLike.setAttribute('onclick', 'userLikePlaylist("like");return false;');
            }
        } else {
            inputLike.value = 'ThA�ch';
            inputLike.setAttribute('onclick', 'userLikePlaylist("like");return false;');
            document.getElementById("notlogin")
                    .innerHTML = 'CA� lỗi xảy ra, vui lA�ng thử lại sau.';
            document.getElementById("notlogin")
                    .style.display = "block";
            return;
        }
    }, 'json', 'post');
};

userLikeMV = function(type) {
    var songLike = document.getElementById('hdSong')
            .value;
    var urlCallback = document.getElementById('hdUrlCallback')
            .value;

    if (songLike.length < 0) {
        alert("MV khA�ng tồn tại");
        return;
    }
    var inputLike = document.getElementById("btnLiked");
    if (type == 'like') {
        inputLike.value = "Hết thA�ch";
        inputLike.setAttribute('onclick', 'userLikeMV("unlike");return false;');
    } else {
        inputLike.value = "ThA�ch";
        inputLike.setAttribute('onclick', 'userLikeMV("like");return false;');
    }

    ajax.load(NCTInfo.ROOT_URL + 'ajax/like?type=mv&key=' + songLike, function(data) {
        if (data.error_code == 2) {
            inputLike.value = 'ThA�ch';
            inputLike.setAttribute('onclick', 'userLikeMV("like");return false;');
            document.getElementById("notlogin")
                    .innerHTML = (urlCallback.length > 0) ? 'Bạn phải <a href="' + NCTInfo.ROOT_URL + 'login?r=' + urlCallback + '">đăng nhập </a> để sử dụng chức năng nA y.' : 'Bạn phải <a href="' + NCTInfo.ROOT_URL + 'login">đăng nhập </a> để sử dụng chức năng nA y.';
            document.getElementById("notlogin")
                    .style.display = "block";
            return;
        } else if (data.error_code == 0) {
            document.getElementById("notlogin")
                    .style.display = "none";
            document.getElementById("notlogin")
                    .innerHTML = "";
            if (data.result == "unlike") {
                inputLike.value = 'Hết ThA�ch';
                inputLike.setAttribute('onclick', 'userLikeMV("unlike");return false;');
            } else if (data.result == "like") {
                inputLike.value = 'ThA�ch';
                inputLike.setAttribute('onclick', 'userLikeMV("like");return false;');
            }
        } else {
            inputLike.value = 'ThA�ch';
            inputLike.setAttribute('onclick', 'userLikeMV("like");return false;');
            document.getElementById("notlogin")
                    .innerHTML = 'CA� lỗi xảy ra, vui lA�ng thử lại sau.';
            document.getElementById("notlogin")
                    .style.display = "block";
            return;
        }
    }, 'json', 'post');
};


postComment = function() {
    document.getElementById('related')
            .className = 'related';
    document.getElementById('lyric')
            .className = 'lyric';
    document.getElementById('comment')
            .className = 'comment active';
    document.getElementById("content-result")
            .innerHTML = "<br /> Chức năng đang cập nhật";
};

userNotLogin = function() {
    var backlink = document.getElementById('hdbacklink')
            .value;
    document.getElementById("pLoginError")
            .innerHTML = 'Bạn hA�y <a href="' + NCTInfo.ROOT_URL + 'login?r=' + backlink + '">đăng nhập</a> để thA�ch bA i hA�t.';
    return;
};

//------------------------------------------
function setCookie(name, value, days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        var expires = "; expires=" + date.toGMTString();
    } else
        var expires = "";
    document.cookie = name + "=" + value + expires + "; domain=nhaccuatui.com; path=/";
}
;

function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ')
            c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0)
            return c.substring(nameEQ.length, c.length);
    }
    return null;
}
;

function deleteCookie(name) {
    setCookie(name, "", -1);
}
;


var getIndex = function() {
    var list = document.getElementById('listSong')
            .getElementsByTagName('div');
    for (i = 1; i < list.length; i++) {

        if (list[i].className == "row active")
            return i;
    }
};

var setActiveSong = function(index) {
    if (index != 'undefined') {
        var list = document.getElementById('listSong')
                .getElementsByTagName('div');
        for (var i = 1; i < list.length; i++) {
            if (i == index)
                list[i].className = "row active";
            else {
                list[i].className = (i != list.length - 1) ? "row" : "row noborder";
            }
        }
    }
};

var showSongPlaylist = function(obj) {

    setActiveTag("tag-playlist", "a", obj);
    var contentSong = document.getElementById('songList');
    var contentRelated = document.getElementById('relaredList');

    if (contentSong != 'undefined' && contentRelated != 'undefined') {
        contentSong.style.display = "block";
        contentRelated.style.display = "none";
    }
    return false;
};

var showRelatedPlaylist = function(obj) {

    setActiveTag("tag-playlist", "a", obj);
    var contentSong = document.getElementById('songList');
    var contentRelated = document.getElementById('relaredList');

    if (contentSong != 'undefined' && contentRelated != 'undefined') {
        contentSong.style.display = "none";
        contentRelated.style.display = "block";
    }
    return false;
};

var setActiveTag = function(contentTag, elementChild, currentTag) {
    var tag = document.getElementById(contentTag)
            .getElementsByTagName(elementChild);
    if (tag != null) {
        for (var i = 0; i < tag.length; i++) {
            tag[i].className = (currentTag.innerHTML == tag[i].innerHTML) ? "active" : "";
        }
    }
};


var showRelatedSong = function(obj) {

    setActiveTag("tag-song", "a", obj);
    var contentSong = document.getElementById('relatedSong');
    var contentLyric = document.getElementById('lyricSong');
    if (contentSong != 'undefined' && contentLyric != 'undefined') {
        contentSong.style.display = "block";
        contentLyric.style.display = "none";
    }
    return false;
};

var showLyric = function(obj) {

    setActiveTag("tag-song", "a", obj);
    var contentSong = document.getElementById('relatedSong');
    var contentLyric = document.getElementById('lyricSong');

    if (contentSong != 'undefined' && contentLyric != 'undefined') {
        contentSong.style.display = "none";
        contentLyric.style.display = "block";
    }
    return false;
};

var ShowMorePlayList = function() {
    var el = document.getElementById("listSong");
    if (el != null) {
        el.removeAttribute("style");
        document.getElementById("lMorelist")
                .style.display = "none";
    }
    return false;
};

var detectDivisionUserPhone = function() {
    var myAudio = document.createElement('audio');
    var canPlayMp3 = !!myAudio.canPlayType && "" != myAudio.canPlayType('audio/mpeg');
    if (canPlayMp3) {
        setCookie("DivisionAudioUserPhone", "HTML5", null);
    } else if (FlashDetect.major != -1) {
        setCookie("DivisionAudioUserPhone", "FLASH", null);
    }

    var myAudio = document.createElement('video');
    var canPlayMp4 = !!myAudio.canPlayType && "" != myAudio.canPlayType('video/mp4');
    if (canPlayMp4) {
        setCookie("DivisionVideoUserPhone", "HTML5", null);
    } else if (FlashDetect.major != -1) {
        setCookie("DivisionVideoUserPhone", "FLASH", null);
    }
};

detectDivisionUserPhone();

checkMobile();