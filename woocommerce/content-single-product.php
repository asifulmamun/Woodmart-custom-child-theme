<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

$product_images_attr = $product_image_summary_class = '';

$product_images_class  = woodmart_product_images_class();
$product_summary_class = woodmart_product_summary_class();
$single_product_class  = woodmart_single_product_class();
$content_class         = woodmart_get_content_class();
$product_design        = woodmart_product_design();
$breadcrumbs_position  = woodmart_get_opt( 'single_breadcrumbs_position' );
$image_width           = woodmart_get_opt( 'single_product_style' );
$full_height_sidebar   = woodmart_get_opt( 'full_height_sidebar' );
$page_layout           = woodmart_get_opt( 'single_product_layout' );
$tabs_location         = woodmart_get_opt( 'product_tabs_location' );
$reviews_location      = woodmart_get_opt( 'reviews_location' );
$product_background    = woodmart_get_opt( 'product-background' );
$single_full_width     = woodmart_get_opt( 'single_full_width' );

if ( 'alt' === $product_design ) {
	woodmart_enqueue_inline_style( 'woo-single-prod-design-centered' );

	$product_summary_class .= ' text-center';
}

if ( 'default' === $product_design ) {
	if ( is_rtl() ) {
		$product_summary_class .= ' text-right';
	} else {
		$product_summary_class .= ' text-left';
	}
}

woodmart_enqueue_inline_style( 'woo-single-prod-predefined' );
woodmart_enqueue_inline_style( 'woo-single-prod-and-quick-view-predefined' );
woodmart_enqueue_inline_style( 'woo-single-prod-el-tabs-predefined' );

// Full width image layout.

if ( '4' === $image_width || '5' === $image_width ) {
	woodmart_enqueue_inline_style( 'woo-single-prod-opt-gallery-full-width' );
}

if ( '5' === $image_width ) {
	if ( 'wpb' === woodmart_get_current_page_builder() ) {
		$product_images_class .= ' vc_row vc_row-fluid wd-section-stretch-content-no-pd';
	} else {
		$product_images_class .= ' wd-section-stretch-content';
	}
}

$container_summary = $container_class = $full_height_sidebar_container = 'container';

if ( $full_height_sidebar && $page_layout != 'full-width' ) {
	$single_product_class[] = $content_class;
	$product_image_summary_class = 'col-lg-12 col-md-12 col-12';
} else {
	$product_image_summary_class = $content_class;
}

if ( $single_full_width ) {
	$container_summary = 'container-fluid';
	$full_height_sidebar_container = 'container-fluid';
}

if ( $full_height_sidebar && $page_layout != 'full-width' ) {
	$container_summary = 'container-none';
	$container_class = 'container-none';
}

if ( (bool) woodmart_get_opt( 'product_sticky' ) || woodmart_get_opt( 'product_summary_shadow' ) || ! empty( $product_background['color'] ) || ! empty( $product_background['id'] ) || ! empty( get_post_meta( $product->get_id(), '_woodmart_extra_content', true ) ) || $single_full_width ) {
	woodmart_enqueue_inline_style( 'woo-single-prod-opt-base' );
}

?>


<!-- Breadcrumbs -->
<div class="container-fluid custom_breadcrumbs">
	<div class="row">
		<div class="col-lg-12 col-12 col-md-12 text-center" style="">
			<?php
				
				// Product Title
				woocommerce_template_single_title();


				/**
				 * @package woodmart
				 * Product Breadcrumbs by asifulmaun
				  */
				
				// Get the product category IDs
				$product_cats_ids = get_the_terms( get_the_ID(), 'product_cat' );

				// If product belongs to at least one category
				if ( $product_cats_ids && ! is_wp_error( $product_cats_ids ) ) {
					// Get the first category ID
					$product_cat_id = reset($product_cats_ids)->term_id;
					// Get the category object
					$product_cat = get_term( $product_cat_id, 'product_cat' );
					
					// Output category name
					$custom_breadcrumbs = '<a href="' . get_home_url() . '">Home</a>';
					$custom_breadcrumbs .= ' / ';
					$custom_breadcrumbs .= '<a href="' . get_term_link($product_cat) . '">' . $product_cat->name . '</a>';
					echo $custom_breadcrumbs;
				}
			?>
		</div>
	</div><!-- /.row -->
</div>
<!-- / Breadcrumbs -->


<!-- Product Mini Status -->
<section class="container product_mini_status">
	<ul class="row">


		<li class="col-6 col-lg-3 col-md-3">
			<img src="https://i.postimg.cc/MTYbBMPP/Screenshot-from-2024-03-15-00-28-42.png" alt="Auto Update">
			<div class="mini_status_desc">
				<div>Auto Update</div>
				<div><a target="_blank" href="/how-to-update/">Yes (1 Year)?</a></div>
			</div>
		</li>
		<li class="col-6 col-lg-3 col-md-3">
			<img src="https://i.postimg.cc/MTYbBMPP/Screenshot-from-2024-03-15-00-28-42.png" alt="Auto Update">
			<div class="mini_status_desc">
				<div>Mannual Update</div>
				<div><a target="_blank" href="/how-to-update-manually/">Yes (1 Year)?</a></div>
			</div>
		</li>

		<li class="col-6 col-lg-3 col-md-3">
			<img src="https://i.postimg.cc/hj38MWnT/Screenshot-from-2024-03-15-00-44-35.png" alt="Auto Update">
			<div class="mini_status_desc">
				<div>Version</div>
				<div>20.0.2 <sup><a target="_blank" href="/contact-version">Update?</a></sup></div>
			</div>
		</li>
		
		<li class="col-6 col-lg-3 col-md-3">
			<img src="https://i.postimg.cc/pV4YFHqt/Screenshot-from-2024-03-15-00-45-15.png" alt="Auto Update">
			<div class="mini_status_desc">
				<div>Update On</div>
				<div>March 14, 2024</div>
			</div>
		</li>
	</ul>
</section>
<!-- / Product Mini Status -->





<style>
	/* Global */
	:root{
		--custom_breadcrumb_text_color: #fff;
		
		--custom_secondary_color: #7558a2;
		--custom_secondary_txt: gray;
		--custom_optional_color: red;

	}
	ul{
		list-style: none;
	}

	/* Breadcrumbs */
	.custom_breadcrumbs {
		background-image: url("https://wp-premium.org/wp-content/uploads/2021/09/digitals-newslatter-bg.jpg");
		padding: 3rem .8rem;
	}
	.product_title{
		margin: 0 0 .7rem 0;
	}
	.custom_breadcrumbs, .custom_breadcrumbs h1, .custom_breadcrumbs a{
		color: var(--custom_breadcrumb_text_color);
	}

	/* Product Mini Status */
	.product_mini_status{
		padding: 2rem .8rem;
	}
	.product_mini_status li{
		display: flex;
		justify-content: center;
		align-items: center;
	}

	.product_mini_status .mini_status_desc div:first-child{
		color: var(--custom_secondary_color);
		font-weight: 600;
	}
	.product_mini_status .mini_status_desc div:last-child{
		color: var(--custom_secondary_txt);
	}
	.product_mini_status .mini_status_desc div:last-child sup a{
		text-transform: uppercase;
		color: var(--custom_optional_color);
	}
</style>





<div class="container">
	
	<?php
		/**
		 * Hook: woocommerce_before_single_product.
		 */
		 do_action( 'woocommerce_before_single_product' );

		 if ( post_password_required() ) {
		 	echo get_the_password_form();
		 	return;
		 }

	?>
</div>

<?php if ( $full_height_sidebar && $page_layout != 'full-width' ) echo '<div class="' . $full_height_sidebar_container . '"><div class="row full-height-sidebar-wrap">'; ?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class( $single_product_class, $product ); ?>>

	<div class="<?php echo esc_attr( $container_summary ); ?>">

		<?php
			/**
			 * Hook: woodmart_before_single_product_summary_wrap.
			 *
			 * @hooked woocommerce_output_all_notices - 10
			 */
			do_action( 'woodmart_before_single_product_summary_wrap' );
		?>

		<div class="row product-image-summary-wrap">
			<div class="product-image-summary <?php echo esc_attr( $product_image_summary_class ); ?>">
				<div class="row product-image-summary-inner">
					<div class="<?php echo esc_attr( $product_images_class ); ?> product-images" <?php echo !empty( $product_images_attr ) ? $product_images_attr: ''; ?>>
						<?php
							/**
							 * woocommerce_before_single_product_summary hook
							 *
							 * @hooked woocommerce_show_product_sale_flash - 10
							 * @hooked woocommerce_show_product_images - 20
							 */
							do_action( 'woocommerce_before_single_product_summary' );
						?>
					</div>
					<?php if ( $image_width == 5 && 'wpb' === woodmart_get_current_page_builder() ): ?>
						<div class="vc_row-full-width"></div>
					<?php endif ?>
					<div class="<?php echo esc_attr( $product_summary_class ); ?> summary entry-summary">
						<div class="summary-inner reset-last-child">
							<?php
								/**
								 * woocommerce_single_product_summary hook
								 *
								 * @hooked woocommerce_template_single_title - 5
								 * @hooked woocommerce_template_single_rating - 10
								 * @hooked woocommerce_template_single_price - 10
								 * @hooked woocommerce_template_single_excerpt - 20
								 * @hooked woocommerce_template_single_add_to_cart - 30
								 * @hooked woocommerce_template_single_meta - 40
								 * @hooked woocommerce_template_single_sharing - 50
								 */
								do_action( 'woocommerce_single_product_summary' );
							?>
						</div>
					</div>
				</div><!-- .summary -->
			</div>

			<?php
				if ( ! $full_height_sidebar ) {
					/**
					 * woocommerce_sidebar hook
					 *
					 * @hooked woocommerce_get_sidebar - 10
					 */
					do_action( 'woocommerce_sidebar' );
				}
			?>

		</div>

		<?php
			/**
			 * woodmart_after_product_content hook
			 *
			 * @hooked woodmart_product_extra_content - 20
			 */
			do_action( 'woodmart_after_product_content' );
		?>

	</div>

	<?php if ( $tabs_location != 'summary' || $reviews_location == 'separate' ) : ?>
		<div class="product-tabs-wrapper">
			<div class="<?php echo esc_attr( $container_class ); ?>">
				<div class="row">
					<div class="col-12 poduct-tabs-inner">
						<?php
							/**
							 * woocommerce_after_single_product_summary hook
							 *
							 * @hooked woocommerce_output_product_data_tabs - 10
							 * @hooked woocommerce_upsell_display - 15
							 * @hooked woocommerce_output_related_products - 20
							 */
							do_action( 'woocommerce_after_single_product_summary' );
						?>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<?php do_action( 'woodmart_after_product_tabs' ); ?>

	<div class="<?php echo esc_attr( $container_class ); ?> related-and-upsells"><?php
		/**
		 * woodmart_woocommerce_after_sidebar hook
		 *
		 * @hooked woocommerce_upsell_display - 10
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woodmart_woocommerce_after_sidebar' );
	?></div>

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>

<?php
	if ( $full_height_sidebar && $page_layout != 'full-width' ) {
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action( 'woocommerce_sidebar' );
	}
?>

<?php if ( $full_height_sidebar && $page_layout != 'full-width' ) echo '</div></div>'; ?>
