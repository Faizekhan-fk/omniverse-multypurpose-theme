<?php

if ( ! function_exists( 'omniverse_wcfm_stock_progress_bar_field' ) ) {
	function omniverse_wcfm_stock_progress_bar_field( $fields, $product_id ) {
		$value = get_post_meta( $product_id, 'omniverse_total_stock_quantity', true );

		$fields['omniverse_total_stock_quantity'] = array(
			'label'       => esc_html__( 'Initial number in stock', 'omniverse' ),
			'type'        => 'text',
			'class'       => 'wcfm-text',
			'label_class' => 'wcfm_title',
			'value'       => $value,
			'hints'       => esc_html__( 'Required for stock progress bar option.', 'omniverse' ),
		);

		return $fields;
	}

	add_filter( 'wcfm_product_fields_stock', 'omniverse_wcfm_stock_progress_bar_field', 10, 2 );
}

if ( ! function_exists( 'omniverse_wcfm_save_total_stock_quantity' ) ) {
	function omniverse_wcfm_save_total_stock_quantity( $post_id, $form_data ) {
		update_post_meta( $post_id, 'omniverse_total_stock_quantity', $form_data['omniverse_total_stock_quantity'] );
	}


	add_action( 'after_wcfm_products_manage_meta_save', 'omniverse_wcfm_save_total_stock_quantity', 10, 2 );
}
