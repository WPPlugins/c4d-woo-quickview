(function($){
	$(document).ready(function(){
		$("a.c4d-woo-qv__link").fancybox({
			'transitionIn'	:	'elastic',
			'transitionOut'	:	'elastic',
			'speedIn'		:	600, 
			'speedOut'		:	200, 
			'overlayShow'	:	false,
			'width'           : '100%',
        	'height'          : '100%',
        	'maxWidth'		: 1200,
        	'maxHeight'		: 1000,
        	'autoSize'		: 	false,
        	'scrolling'		: 'yes'
		});

		// quickview add to cart by ajax
		$('.c4d-woo-qv form.cart').each(function(){
			$(this).submit(function(event){
				event.preventDefault();
				$.ajax({
		           type: "POST",
		           url: woocommerce_params.wc_ajax_url,
		           data: $(this).serialize()
		        });
				return false;
			});
		});
	});
})(jQuery);