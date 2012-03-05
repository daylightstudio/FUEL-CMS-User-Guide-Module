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
	
	$('.func_close').click(function(){
		$('.func_name').next().slideDown('fast');
		return false;
	})
	$('.func_open').click(function(){
		$('.func_name').next().slideUp('fast');
		return false;
	})
	$('.func_name').css('cursor', 'pointer').toggle(
		function(){
			$(this).next().slideDown('fast');
		},
		function(){
			$(this).next().slideUp('fast');
		}
	)
})