<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

session_start();
get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

?>
<header class="woocommerce-products-header">
	<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
		<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
	<?php endif; ?>

	<?php
	/**
	 * Hook: woocommerce_archive_description.
	 *
	 * @hooked woocommerce_taxonomy_archive_description - 10
	 * @hooked woocommerce_product_archive_description - 10
	 */
	do_action( 'woocommerce_archive_description' );
	?>
</header>
<?php
if ( woocommerce_product_loop() ) {


	if(is_shop()) : ?>
		<ul class="categories">
			<?php

			$userCategories = array(
				
			);

			if(is_user_logged_in()){
				$userCategories = $_SESSION["stautas-client"]->company->categoriesToShow;
			}


			$product_cat_array = get_terms( 'product_cat' );
			//echo '<pre>'; print_r( $product_cat_array ); echo '</pre>';

			foreach ($product_cat_array as $curr_product_cat) : ?>
				<?php if(in_array($curr_product_cat->slug, $userCategories) || empty($userCategories)) : ?>
					<a href="<?php echo get_term_link($curr_product_cat->term_id) ?>">
						<li>
							<div class="category-image-wrap">
							<?php woocommerce_subcategory_thumbnail( $curr_product_cat);?> 
							</div>
							<p class="category-name"> <?php echo $curr_product_cat->name ?> </p>
						</li>
					</a>
				<?php endif; ?>
			<?php endforeach; ?>
		</ul>

		<style type="text/css">
			.categories{
				display: grid;
  				grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  				grid-gap: 20px;
				list-style: none;
				text-align: center;
			}

			.category-image-wrap img{
				height: 200px;
				object-fit: cover;
				width: 100%;
			}
		</style>


	<?php else : 
		do_action( 'woocommerce_before_shop_loop' );

		woocommerce_product_loop_start();

		if ( wc_get_loop_prop( 'total' ) ) {
			while ( have_posts() ) {
				the_post();

				/**
				 * Hook: woocommerce_shop_loop.
				 */
				do_action( 'woocommerce_shop_loop' );

				wc_get_template_part( 'content', 'product' );
			}
		}

		woocommerce_product_loop_end();

		/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	do_action( 'woocommerce_after_shop_loop' );

	endif;

	

	
} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );
