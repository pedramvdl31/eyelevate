$(document).ready(function(){
	results.pageLoad();
	results.events();

});
results = {

	pageLoad: function() {
		$.ajaxSetup({
			headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
		});

var popupTemplate='<li class="spam-popup">Report as spam</li>';

$('.popbutton').popover({
    animation:true, 
    content:popupTemplate, 
    html:true
});

	},
	events: function() {

	
		$('.reply-text').click(function(){
			
			var state = parseInt($('#right-arr').attr('state'));

			if (state == 0) {//CLOSE
				$('#right-arr').attr('state','1');
				$('#right-arr').css('display','inline');
			}

		});

		$('#right-arr').click(function(){
			
			var state = parseInt($('#right-arr').attr('state'));

			if (state == 1) {//OPEN
				$('#right-arr').attr('state','0');
				$('#right-arr').css('display','none');
			}

		});

		$('.more').click(function(){
			var new_var = 100;
			var current_height = parseInt($(this).parents('.right-data:first').css('height'));
			var new_height = current_height + new_var;
			$(this).parents('.right-data:first').css('height',new_height);
			$(this).parents('.right-data:first').css({
		        opacity          : 1,
		        WebkitTransition : 'height 1s',
		        MozTransition    : 'height 1s',
		        MsTransition     : 'height 1s',
		        OTransition      : 'height 1s',
		        transition       : 'height 1s'
		    });
			var current_top = parseInt($('.more').css('top'));
			$('.more').css({
		        opacity          : 1,
		        WebkitTransition : 'top 1s',
		        MozTransition    : 'top 1s',
		        MsTransition     : 'top 1s',
		        OTransition      : 'top 1s',
		        transition       : 'top 1s'
		    });
			var new_top = current_top + new_var;
			$('.more').css('top',new_top);
		});
		


	// $('a #right-arr').click(function(e)
	// {
	// 	alert();
	//     // e.preventDefault();
	// });
		//FLAG WAS CLICKED
		$('.flags').click(function(){
			

			//MOUSE OVER POPUP MESSAGE
		    $(document).find( ".popover" ).mouseout(function() {
		    	var i = false;
		    	//MOUSE CAME BACK OVER MESSAGE 
 			$(document).find( ".popover" ).mouseover(function() {
 				//IF TRUE DONT HIDE PUPUP
 				over = true;
 				i = true;
 			});
			  setTimeout(function(){ 
			  	if (i == false) {//IF MOUSE DIDNT COME BACK HIDE
			  		$('.popbutton').popover('hide') ;
			  	};
			  }, 1000);
			});
			//IF MOUSE DID NOT ENTER CLOSE AFTER FEW SECONDS
			var over = false;
			$(document).find( ".popover" ).mouseover(function() {
 				over = true;
 			});
			setTimeout(function(){ 
			  	if (over == false) {//IF MOUSE DIDNT COME BACK HIDE
			  		$('.popbutton').popover('hide') ;
			  	};
			}, 3000);

		});


		


	}
}
request = {

};

