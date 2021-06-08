
console.clear();

class musicPlayer {
    constructor() {
        this.play = this.play.bind(this);
        this.playBtn = document.getElementById('youtube-audio');
        this.playBtn.addEventListener('click', this.play);
        this.controlPanel = document.getElementById('control-panel');
        this.infoBar = document.getElementById('info');
    }

    play() {
        let controlPanelObj = this.controlPanel,
            infoBarObj = this.infoBar
        Array.from(controlPanelObj.classList).find(function(element){
            return element !== "active" ? controlPanelObj.classList.add('active') : 		controlPanelObj.classList.remove('active');
        });

        Array.from(infoBarObj.classList).find(function(element){
            return element !== "active" ? infoBarObj.classList.add('active') : 		infoBarObj.classList.remove('active');
        });
    }
}

const newMusicplayer = new musicPlayer();
function onYouTubeIframeAPIReady() {
    var e = document.getElementById("youtube-audio"), t = document.createElement("img");
    t.setAttribute("id", "youtube-icon"), t.style.cssText = "cursor:pointer;cursor:hand", e.appendChild(t);
    var a = document.createElement("div");
    a.setAttribute("id", "youtube-player"), e.appendChild(a);

    e.onclick = function () {
        r.getPlayerState() === YT.PlayerState.PLAYING || r.getPlayerState() === YT.PlayerState.BUFFERING ? (r.pauseVideo(), o(!1)) : (r.playVideo(), o(!0))
    };
    var r = new YT.Player("youtube-player", {
        height: "0",
        width: "0",
        videoId: e.dataset.video,
        playerVars: {autoplay: e.dataset.autoplay, loop: e.dataset.loop},
        events: {
            onReady: function (e) {
                r.setPlaybackQuality("small"), o(r.getPlayerState() !== YT.PlayerState.CUED)
            }, onStateChange: function (e) {
                e.data === YT.PlayerState.ENDED && o(!1)
            }
        }
    })
}
