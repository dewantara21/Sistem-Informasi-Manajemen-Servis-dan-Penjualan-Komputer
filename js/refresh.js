$.ajaxSetup ({
	cache: false	//use for i.e browser to clean cache
});
$(setInterval(function(){
	$('.refresh').load('view.php'); //this means that the items loaded by display.php will be prompted into the class refresh 
	$('.refresh').attr({ scrollTop: $('.refresh').attr('scrollHeight') }) //if the messages overflowed this line tells the textarea to focus the latest message	
}, 3000));