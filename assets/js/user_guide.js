$(function(){
	$('#nav').hide();
	$('#toc_toggle').toggle(
		function(){
			$('#nav').slideDown();
		},
		function(){
			$('#nav').slideUp();
		}
	);
	$('.toggle_container').each(function(i){
		var _this = this;
		$(this).find('.toggler').toggle(
			function(){
				$('.toggle', _this).next().slideDown('fast');
				$(this).html('-');
				return false;
			},
			function(){
				$('.toggle', _this).next().slideUp('fast');
				$(this).html('+');
				return false;
			}

		)
	})
	
	
	$('.toggle').css('cursor', 'pointer').toggle(
		function(){
			$(this).next().slideDown('fast');
		},
		function(){
			$(this).next().slideUp('fast');
		}
	)
	
	if ($(window.location.hash).size()){
		$(window.location.hash).next().slideDown('fast');
	}
	
	// keyboard shortcut for TOC
	$(document).bind('keypress', function(e){ 
		 if(e.shiftKey === true && e.charCode == 32) { //Control + Shift + T
		   $('#toc_toggle').click();
		 }
	});
})