/* 
* Skeleton V1.0.2
* Copyright 2011, Dave Gamache
* www.getskeleton.com
* Free to use under the MIT license.
* http://www.opensource.org/licenses/mit-license.php
* 5/20/2011
*/	
	

$(document).ready(function() {


	/* Fade in
	================================================== */

	$(document).ready(function () {
		$('.container').hide().delay(400).fadeIn(1000);
	});


	
	/* Scroll To Top
	================================================== */
	
	
	$(document).ready(function() {
   
 		$('a[href=#top]').click(function(){
        	$('html, body').animate({scrollTop:0}, 'slow');
        	return false;
		});

	});


	/* Fade Label
	================================================== */

	$(document).ready(function(){
		$("label").inFieldLabels();
	});

	

});