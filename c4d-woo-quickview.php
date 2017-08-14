<?php
/*
Plugin Name: C4D Woocommerce Quickview
Plugin URI: http://coffee4dev.com/
Description: Add quickview button for product.
Author: Coffee4dev.com
Author URI: http://coffee4dev.com/
Text Domain: c4d-woo-qv
Version: 2.0.0
*/

define('C4DWQV_PLUGIN_URI', plugins_url('', __FILE__));

add_action( 'wp_enqueue_scripts', 'c4d_woo_qv_safely_add_stylesheet_to_frontsite');
add_shortcode('c4d-woo-qv', 'c4d_woo_qv_shortcode');
add_action('c4d_woo_qv_before', 'c4d_woo_qv_content__inner');
add_filter( 'plugin_row_meta', 'c4d_woo_qv_plugin_row_meta', 10, 2 );

function c4d_woo_qv_plugin_row_meta( $links, $file ) {
    if ( strpos( $file, basename(__FILE__) ) !== false ) {
        $new_links = array(
            'visit' => '<a href="http://coffee4dev.com">Visit Plugin Site</<a>',
            'forum' => '<a href="http://coffee4dev.com/forums/">Forum</<a>',
            'premium' => '<a href="http://coffee4dev.com">Premium Support</<a>'
        );
        
        $links = array_merge( $links, $new_links );
    }
    
    return $links;
}

function c4d_woo_qv_safely_add_stylesheet_to_frontsite( $page ) {
	if(!defined('C4DPLUGINMANAGER')) {
		wp_enqueue_style( 'c4d-woo-qv-frontsite-style', C4DWQV_PLUGIN_URI.'/assets/default.css' );
		wp_enqueue_script( 'c4d-woo-qv-frontsite-plugin-js', C4DWQV_PLUGIN_URI.'/assets/default.js', array( 'jquery' ), false, true ); 
	}
	wp_enqueue_style( 'fancybox', C4DWQV_PLUGIN_URI.'/libs/jquery.fancybox.min.css'); 
	wp_enqueue_script( 'fancybox', C4DWQV_PLUGIN_URI.'/libs/jquery.fancybox.min.js', array( 'jquery' ), false, true ); 
	wp_localize_script( 'jquery', 'c4d_woo_qv',
            array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}

function c4d_woo_qv_shortcode($atts) {
	global $product;
	$html = '';
	$default = array(
		'title' => 1,
		'price' => 1,
		'short_desc' => 1,
		'button_text' => esc_html__('Quickview', 'c4dwqv'),
		'button_icon' => '' 
	);

	$atts = shortcode_atts($default, $atts);
	$uid = 'c4d-woo-qv-'.uniqid();
	$html .= '<a rel="group" href="#'.esc_attr($uid).'" class="c4d-woo-qv__link" href="'.esc_attr(get_permalink()).'"><span class="icon '.esc_attr($atts['button_icon']).'"></span>'.$atts['button_text'].'</a>';
	$html .= c4d_woo_qv_content($uid);

	return $html;
}

function c4d_woo_qv_content($uid) {
	ob_start();
?>
	<div id="<?php echo esc_attr($uid); ?>" class="c4d-woo-qv">
		<?php do_action('c4d_woo_qv_before'); ?>
		<?php do_action('c4d_woo_qv_after'); ?>
	</div>
<?php	
	$html = ob_get_contents();
	ob_end_clean();
	return $html;
}

function c4d_woo_qv_content__inner() {
	$file = get_template_directory(). '/c4d-woo-quickview/templates/default.php';
	if (file_exists($file)) {
		require $file;
	} else {
		require dirname(__FILE__). '/templates/default.php';
	}
}