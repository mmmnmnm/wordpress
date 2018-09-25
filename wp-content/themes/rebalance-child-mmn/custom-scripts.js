(function ($, root, undefined) {
	
$(function () {
	
'use strict';

/* Touch detect */

		var deviceAgent = navigator.userAgent.toLowerCase();
		var isTouchDevice = Modernizr.touch || (deviceAgent.match(/(iphone|ipod|ipad)/) || deviceAgent.match(/(android)/)  || deviceAgent.match(/(iemobile)/) || deviceAgent.match(/iphone/i) || deviceAgent.match(/ipad/i) || deviceAgent.match(/ipod/i) || deviceAgent.match(/blackberry/i) || deviceAgent.match(/bada/i));
		
if (isTouchDevice) {
	//Do something touchy
	$('body').addClass('touchy');
} else {
	//Can't touch this
	$('body').addClass('not-touchy');
}		


setTimeout(function(){ 
	jQuery(".mixcloud-footer-widget-container:not(.opened, .closed)").addClass("closed").append("<div class='closegomb'><i class='fa fa-play-circle-o' aria-hidden='true'></i></div>"); 
	jQuery(".mixcloud-footer-widget-body-wrapper:not(.closed)").addClass("closed");
    $(".mixcloud-footer-widget-container iframe").attr('id', 'mmnmixcloud');
}, 1500);



$(document).one("mouseenter tap scroll touchstart", ".mixcloud-footer-widget-container:not(.opened, .closed), .mixcloud-footer-widget-body-wrapper:not(.closed)", function() {
	jQuery(".mixcloud-footer-widget-container:not(.opened, .closed)").append("<div class='closegomb'><i class='fa fa-play-circle-o' aria-hidden='true'></i></div>"); 
	$(this).addClass("closed");
	jQuery(".mixcloud-footer-widget-body-wrapper:not(.closed)").addClass("closed");
    $(".mixcloud-footer-widget-container iframe").attr('id', 'mmnmixcloud');
});




function mixcloudPause() {
    var widget = Mixcloud.PlayerWidget(document.getElementById("mmnmixcloud"));
    widget.ready.then(function() {
        widget.pause();
    });   
}

function mixcloudPlay() {
    var widget = Mixcloud.PlayerWidget(document.getElementById("mmnmixcloud"));
    widget.ready.then(function() {
        widget.play();
    }); 
}


/* vars for preventing doubleclick */
var DELAY = 300, clicks = 0, timer = null;


/* mixcloud Pause Desktop */
jQuery(document).on("click", "body.not-touchy .mixcloud-footer-widget-container.opened .closegomb", function(e){
clicks++;  //count clicks
	if(clicks === 1) {
		timer = setTimeout(function() {

		jQuery(".mixcloud-footer-widget-container, .mixcloud-footer-widget-body-wrapper").removeClass("opened").addClass("closed");
		jQuery(".mixcloud-footer-widget-container .closegomb i").removeClass("fa-times").addClass("fa-play-circle-o");
		mixcloudPause();
		e.preventDefault;
		e.stopPropagation();

		clicks = 0;             //after action performed, reset counter
	}, DELAY);

	} else {
		clearTimeout(timer);    //prevent single-click action
		clicks = 0;             //after action performed, reset counter
	}
})
.on("dblclick", "body.not-touchy .mixcloud-footer-widget-container.opened .closegomb", function(e){
		jQuery(".mixcloud-footer-widget-container, .mixcloud-footer-widget-body-wrapper").removeClass("opened").addClass("closed");
		jQuery(".mixcloud-footer-widget-container .closegomb i").removeClass("fa-times").addClass("fa-play-circle-o");
		mixcloudPause();
		e.preventDefault;
		e.stopPropagation();
});



/* mixcloud Play Desktop */
jQuery(document).on("click", "body.not-touchy .mixcloud-footer-widget-container.closed .closegomb", function(e){

	jQuery(".mixcloud-footer-widget-container, .mixcloud-footer-widget-body-wrapper").removeClass("closed").addClass("opened");
	jQuery(".mixcloud-footer-widget-container .closegomb i").removeClass("fa-play-circle-o").addClass("fa-times");
	setTimeout(function(){ mixcloudPlay(); }, 1000);
	e.preventDefault;
	e.stopPropagation();
	
});


/* mixcloud Pause mobile */
jQuery(document).on("click", "body.touchy .mixcloud-footer-widget-container.opened .closegomb", function(e){
		jQuery(".mixcloud-footer-widget-container, .mixcloud-footer-widget-body-wrapper").removeClass("opened").addClass("closed");
		jQuery(".mixcloud-footer-widget-container .closegomb i").removeClass("fa-times").addClass("fa-play-circle-o");
		mixcloudPause();
		e.preventDefault;
		e.stopPropagation();
});



/* mixcloud Play mobile */
jQuery(document).on("click", "body.touchy .mixcloud-footer-widget-container.closed .closegomb", function(e){

	jQuery(".mixcloud-footer-widget-container, .mixcloud-footer-widget-body-wrapper").removeClass("closed").addClass("opened");
	jQuery(".mixcloud-footer-widget-container .closegomb i").removeClass("fa-play-circle-o").addClass("fa-times");
	setTimeout(function(){ mixcloudPlay(); }, 1000);
	e.preventDefault;
	e.stopPropagation();
	
});



/* close doc ready */	
});
	
})(jQuery, this);
