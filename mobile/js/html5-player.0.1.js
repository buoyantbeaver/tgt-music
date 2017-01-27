var audio;
var playControl;
var progressControl;
var progressHolder;
var playProgressBar;
var playProgressInterval;
var currentTimeDisplay;
var handControl;

var bodyLoaded = function() {
    audio = document.getElementById("audio");
    playControl = document.getElementById("play");
    progressControl = document.getElementById("progress");
    progressHolder = document.getElementById("progress_box");
    progressBuffer = document.getElementById("load_progress");
    playProgressBar = document.getElementById("play_progress");
    currentTimeDisplay = document.getElementById("current_time_display");
    handControl = document.getElementById("hand_progress");
    if (audio != null) {
        setTimeSong();
        pauseAudio();

        playControl.addEventListener("click", function() {
            if (audio.paused) {
                playAudio();
            } else {
                pauseAudio();
            }
        }, true);

        progressHolder.addEventListener("mouseup", function(e) {
            setPlayProgress(e.pageX);
        }, true);


        handControl.addEventListener("mousedown", function() {
            blockTextSelection();
            document.onmousemove = function(e) {
                stopTrackingPlayProgress();
                setPlayProgress(e.pageX);
            };
            document.onmouseup = function() {
                unblockTextSelection();
                document.onmousemove = null;
                document.onmouseup = null;
                trackPlayProgress();
            };
        }, true);

        handControl.addEventListener("mouseup", function(e) {
            setPlayProgress(e.pageX);
        }, true);
    }
};

function playAudio() {
    audio.play();
    playControl.className = "pause control";
    trackPlayProgress();
}

function pauseAudio() {
    audio.pause();
    playControl.className = "play control";
    stopTrackingPlayProgress();
}

function setTimeSong() {
    if (audio.duration)
        currentTimeDisplay.innerHTML = formatTime(audio.duration);
}

function trackPlayProgress() {
    playProgressInterval = setInterval(updatePlayProgress, 33);
}

function stopTrackingPlayProgress() {
    clearInterval(playProgressInterval);
}

function updatePlayProgress() {
    updateLoading();
    playProgressBar.style.width = ((audio.currentTime / audio.duration) * (progressHolder.offsetWidth - 2)) + "px";
    handControl.style.left = (((audio.currentTime / audio.duration) * (progressHolder.offsetWidth - 2)) - 7) + "px";
    updateTimeDisplay();
}

function updateLoading() {
    var precentLoad;
    if ((audio.buffered != undefined) && (audio.buffered.length != 0)) {
        precentLoad = parseInt(((audio.buffered.end(0) / audio.duration) * 100), 10);
        progressBuffer.style.width = precentLoad + "%";
    }
}

function setPlayProgress(clickX) {
    updateLoading();
    var newPercent = Math.max(0, Math.min(1, (clickX - findPosX(progressHolder)) / progressHolder.offsetWidth));
    audio.currentTime = newPercent * audio.duration;
    playProgressBar.style.width = newPercent * (progressHolder.offsetWidth - 2) + "px";
    handControl.style.left = ((newPercent * (progressHolder.offsetWidth - 2)) - 7) + "px";
    updateTimeDisplay();
}

function updateTimeDisplay() {
    if (audio.duration) {
        currentTimeDisplay.innerHTML = formatTime(audio.duration - audio.currentTime);
    }
}

function blockTextSelection() {
    document.body.focus();
    document.onselectstart = function() {
        return false;
    };
}

function unblockTextSelection() {
    document.onselectstart = function() {
        return true;
    };
}

function formatTime(seconds) {
    seconds = Math.round(seconds);
    minutes = Math.floor(seconds / 60);
    minutes = (minutes >= 10) ? minutes : "0" + minutes;
    seconds = Math.floor(seconds % 60);
    seconds = (seconds >= 10) ? seconds : "0" + seconds;
    return minutes + ":" + seconds;
}

function findPosX(obj) {
    var curleft = obj.offsetLeft;
    while (obj = obj.offsetParent) {
        curleft += obj.offsetLeft;
    }
    return curleft;
}