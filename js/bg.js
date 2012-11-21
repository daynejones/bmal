$(document).ready(function(){
	// Set the background 
	var win_height = $(window).height();
	var win_width = $(window).width();
	$("#bg").height(win_height).width(win_width);

	$(window).resize(function(){
		var win_height = $(window).height();
		var win_width = $(window).width();
		$("#bg").height(win_height).width(win_width);
	});

	var img = new Image();
	
	$(img)
    // once the image has loaded, execute this code
    .load(function () {
    	$(this).hide();

		$('#bg').fadeIn( 1500 );
    })
    
    .error(function () {
      // notify the user that the image could not be loaded
    })
    
    .attr('src', 'images/beerbg2.png');
});