<?php
/**
 * Condition template.
 *
 * @package Omniverse
 */

?>
<div class="dn-layout-condition-template dn-hidden">
	<div class="dn-layout-condition">
		<select class="dn-layout-condition-comparison" name="wd_layout_condition_comparison" aria-label="<?php esc_attr_e( 'Condition comparison', 'omniverse' ); ?>">
			<option value="include">
				<?php esc_html_e( 'Include', 'omniverse' ); ?>
			</option>
			<option value="exclude">
				<?php esc_html_e( 'Exclude', 'omniverse' ); ?>
			</option>
		</select>

		<select class="dn-layout-condition-type" name="wd_layout_condition_type" data-type="shop_archive" aria-label="<?php esc_attr_e( 'Condition type', 'omniverse' ); ?>">
			<option value="all">
				<?php esc_html_e( 'All product archives', 'omniverse' ); ?>
			</option>
			<option value="shop_page">
				<?php esc_html_e( 'Shop page', 'omniverse' ); ?>
			</option>
			<option value="product_search">
				<?php esc_html_e( 'Shop search results', 'omniverse' ); ?>
			</option>
			<option value="product_cats">
				<?php esc_html_e( 'Product categories', 'omniverse' ); ?>
			</option>
			<option value="product_tags">
				<?php esc_html_e( 'Product tags', 'omniverse' ); ?>
			</option>
			<option value="product_attr">
				<?php esc_html_e( 'Product attribute', 'omniverse' ); ?>
			</option>
			<option value="product_term">
				<?php esc_html_e( 'Product term (category, tag, attribute)', 'omniverse' ); ?>
			</option>
			<option value="product_cat_children">
				<?php esc_html_e( 'Child product categories', 'omniverse' ); ?>
			</option>
			<option value="filtered_product_term">
				<?php esc_html_e( 'Filtered by attribute', 'omniverse' ); ?>
			</option>
			<option value="filtered_product_term_any">
				<?php esc_html_e( 'Filtered by any attribute', 'omniverse' ); ?>
			</option>
			<option value="filtered_product_stock_status">
				<?php esc_html_e( 'Filtered by stock status', 'omniverse' ); ?>
			</option>
		</select>

		<select class="dn-layout-condition-type" name="wd_layout_condition_type" data-type="single_product" aria-label="<?php esc_attr_e( 'Condition type', 'omniverse' ); ?>">
			<option value="all">
				<?php esc_html_e( 'All products', 'omniverse' ); ?>
			</option>
			<option value="product">
				<?php esc_html_e( 'Single product id', 'omniverse' ); ?>
			</option>
			<option value="product_cat">
				<?php esc_html_e( 'Product category', 'omniverse' ); ?>
			</option>
			<option value="product_cat_children">
				<?php esc_html_e( 'Child product categories', 'omniverse' ); ?>
			</option>
			<option value="product_tag">
				<?php esc_html_e( 'Product tag', 'omniverse' ); ?>
			</option>
			<option value="product_attr_term">
				<?php esc_html_e( 'Product attribute', 'omniverse' ); ?>
			</option>
			<option value="product_type">
				<?php esc_html_e( 'Product type', 'omniverse' ); ?>
			</option>
		</select>

		<select class="dn-layout-condition-type" name="wd_layout_condition_type" data-type="checkout_form" aria-label="<?php esc_attr_e( 'Condition type', 'omniverse' ); ?>">
			<option value="checkout_form">
				<?php esc_html_e( 'Checkout page form', 'omniverse' ); ?>
			</option>
		</select>

		<select class="dn-layout-condition-type" name="wd_layout_condition_type" data-type="checkout_content" aria-label="<?php esc_attr_e( 'Condition type', 'omniverse' ); ?>">
			<option value="checkout_content">
				<?php esc_html_e( 'Checkout page content', 'omniverse' ); ?>
			</option>
		</select>

		<select class="dn-layout-condition-type" name="wd_layout_condition_type" data-type="cart" aria-label="<?php esc_attr_e( 'Condition type', 'omniverse' ); ?>">
			<option value="cart">
				<?php esc_html_e( 'Cart page', 'omniverse' ); ?>
			</option>
		</select>

		<select class="dn-layout-condition-query dn-hidden" name="wd_layout_condition_query" placeholder="<?php echo esc_attr__( 'Start typing...', 'omniverse' ); ?>" aria-label="<?php esc_attr_e( 'Condition query', 'omniverse' ); ?>"></select>

		<a href="javascript:void(0);" class="dn-layout-condition-remove dn-bordered-btn dn-color-warning dn-style-icon dn-i-close" title="<?php esc_html_e( 'Remove condition', 'omniverse' ); ?>"></a>
	</div>
</div>
