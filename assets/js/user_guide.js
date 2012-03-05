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
	
	$('.func_toggle').toggle(
		function(){
			$('.func_name').next().slideDown('fast');
			$(this).html('-');
			return false;
		},
		function(){
			$('.func_name').next().slideUp('fast');
			$(this).html('+');
			return false;
		}
	
	)
	
	$('.func_name').css('cursor', 'pointer').toggle(
		function(){
			$(this).next().slideDown('fast');
		},
		function(){
			$(this).next().slideUp('fast');
		}
	)
})