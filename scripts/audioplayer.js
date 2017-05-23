/* mmmnmnm, mmn */
function playButton(button_ID,player_in)  {
/* global d3, document */
this.el= document.querySelector(button_ID);
this.SCplayer=player_in;

/*append svg template within button element */
var mySvg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
mySvg.setAttribute("height", "100%");
mySvg.setAttribute("width", "100%");
mySvg.setAttribute("viewBox", "0 0 36 36");
var myPath = document.createElementNS("http://www.w3.org/2000/svg", "path");
myPath.setAttribute("id", "player-icon");
myPath.setAttribute("d", "");
mySvg.appendChild(myPath);
this.el.appendChild(mySvg);

this.states= {
    playing: {
        nextState: "paused",
        iconEl: "M11,10 L17,10 17,26 11,26 M20,10 L26,10 26,26 20,26" /*pause-icon*/
    },
    paused:  {
        nextState: "playing",
        iconEl: "M11,10 L18,13.74 18,22.28 11,26 M18,13.74 L26,18 26,18 18,22.28" /*play-icon*/
    }
};

this.animationDuration= 350;

this.init = function () {
  if (this.SCplayer.options.protocols[0] === 'rtmp') {
      this.SCplayer.options.protocols.splice(0, 1);
    }
    this.setInitialState();
    this.el.addEventListener("click", this.goToNextState.bind(this));
    //add following lines for some mobile browsers, e.g. Chrome
    //this.SCplayer.play();
    //this.SCplayer.pause();

};

this.setInitialState= function () {
    this.setState("paused");
    this.el.querySelector("#player-icon").setAttribute("d",this.stateIconPath());
};

this.goToNextState= function () {
      this.setState(this.state.nextState);

      d3.select(this.el.querySelector("#player-icon")).transition()
          .duration(this.animationDuration)
          .attr("d", this.stateIconPath());


      if (this.state.nextState=="playing"){
        this.SCplayer.pause();
        running_player = undefined; //no player is running <- only this player could have been running
      } else {
        this.SCplayer.play();
        if (typeof running_player != 'undefined') {//other player is running
          running_player.goToNextState(); //stop other player
        }
        running_player = this;
      }

  };

  this.setState= function(stateName) {
      this.state = this.states[stateName];
  };

  this.stateIconPath= function () {
      return this.state.iconEl;
  };
};

function initSC(){
  SC.initialize({
    client_id: 'FDXT2vur4COrcQLjVtcOfO6r2iCF8Y0U',
    redirect_uri: 'http://example.com/callback'
  });

  var running_player;
}

function addButton(buttonID){
  SC.stream('/tracks/' + buttonID).then(function(player){
	   var myPlayButton = new playButton("#Button_"+ buttonID,player);
	    myPlayButton.init();
    });
}
