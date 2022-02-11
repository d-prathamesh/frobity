$(document).ready( function(){
	$("form").bind("keypress", function (e) {
	    if (e.keyCode == 13) {
	    	//preventing enter key submission
	        //add more buttons here
	        return false;
	    }
	});
});
	
