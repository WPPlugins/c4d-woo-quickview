!function(t){t(document).ready(function(){t("a.c4d-woo-qv__link").fancybox({transitionIn:"elastic",transitionOut:"elastic",speedIn:600,speedOut:200,overlayShow:!1,width:"100%",height:"100%",maxWidth:1200,maxHeight:1e3,autoSize:!1,scrolling:"yes"}),t(".c4d-woo-qv form.cart").each(function(){t(this).submit(function(e){return e.preventDefault(),t.ajax({type:"POST",url:woocommerce_params.wc_ajax_url,data:t(this).serialize()}),!1})})})}(jQuery);