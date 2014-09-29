$(document).ready(
    function() {
        $('.myMenu > li').mouseover(
	    function(){
		$(this).find('ul').css('visibility', 'visible');
	    }
	);
        $('.myMenu > li').mouseout(
	    function(){
		$(this).find('ul').css('visibility', 'hidden');
	    }
	);  
});
