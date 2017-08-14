<?php
global $post, $woocommerce, $product;
?>
<div class="c4d-woo-qv__gallery">
	<div class="c4d-woo-qv__gallery_inner">
		<?php
			if ( has_post_thumbnail() ) {

			$image_title = esc_attr( get_the_title( get_post_thumbnail_id() ) );
			$image_link  = wp_get_attachment_url( get_post_thumbnail_id() );
			$image       = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
				'title' => $image_title
				) );

			$attachment_count = count( $product->get_gallery_attachment_ids() );

			if ( $attachment_count > 0 ) {
				$gallery = '[product-gallery]';
			} else {
				$gallery = '';
			}

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a>', $image_link, $image_title, $image ), $post->ID );

			} else {

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce-lightbox' ) ), $post->ID );

			}
		?>
	</div>
</div>
<div class="c4d-woo-qv__info">
	<div class="c4d-woo-qv__info_inner">
		<h2 class="title"><?php echo the_title();?></h2>
		
 		<?php echo woocommerce_template_single_price(); ?>
		<?php echo woocommerce_template_single_excerpt(); ?>
		<?php echo woocommerce_template_single_add_to_cart(); ?>
	</div>
</div>