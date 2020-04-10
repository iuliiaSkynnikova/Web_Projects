$(window).on

	('load', function() {
		//activate jquery.nivo.slider plugin by using nivoSlider() on div element that contain images”
	    $('#slider').nivoSlider({
	    	effect: 'fade', //fade effect is applied
	    	animSpeed: 400, //animation timout is 0.4 sec
	    	pauseTime: 2000,//pause time is 4 sec
	    	pauseOnHover: true, //make slide pause when mouse hover
	    	
	    }); 
	}); 
