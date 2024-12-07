var players = [];
var currentPlayer = null;

// This function gets called when the YouTube API is ready
function onYouTubeIframeAPIReady() {
  var iframes = document.querySelectorAll("iframe");
  iframes.forEach((iframe, index) => {
    var player = new YT.Player(iframe.id, {
      events: {
        onStateChange: onPlayerStateChange,
      },
    });
    players.push(player);
  });
}

// This function will handle the state change of a video
function onPlayerStateChange(event) {
  if (event.data == YT.PlayerState.PLAYING) {
    // Pause the current playing video
    if (currentPlayer && currentPlayer !== event.target) {
      currentPlayer.pauseVideo();
    }
    // Set the current video as the playing one
    currentPlayer = event.target;
  }
}
