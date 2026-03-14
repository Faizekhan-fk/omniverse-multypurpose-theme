<?php if ( ! defined( 'OMNIVERSE_THEME_DIR' ) ) exit( 'No direct script access allowed' );


/**
 * ------------------------------------------------------------------------------------------------
 * Actions
 * ------------------------------------------------------------------------------------------------
 */
//Save Edit Table Action
add_action( 'save_post_omniverse_size_guide', 'omniverse_sguide_table_save' );
add_action( 'edit_post_omniverse_size_guide', 'omniverse_sguide_table_save' );

add_action( 'save_post_omniverse_size_guide', 'omniverse_sguide_hide_table_save' );
add_action( 'edit_post_omniverse_size_guide', 'omniverse_sguide_hide_table_save' );

//Save Edit Product Action
add_action( 'save_post', 'omniverse_sguide_dropdown_save' );
add_action( 'edit_post', 'omniverse_sguide_dropdown_save' );

//Add size guide to product page
add_action( 'woocommerce_single_product_summary', 'omniverse_sguide_display', 38 );


//Metaboxes template
if( ! function_exists( 'omniverse_sguide_metaboxes' ) ) {
    function omniverse_sguide_metaboxes( $post ) {

        if ( get_current_screen()->action == 'add' ) {
            $tables = array(
                array( 'Size', 'UK', 'US', 'EU', 'Japan' ),
                array( 'XS', '6 - 8', '4', '34', '7' ),
                array( 'S', '8 -10', '6', '36', '9'  ),
                array( 'M', '10 - 12', '8', '38', '11'  ),
                array( 'L', '12 - 14', '10', '40', '13'  ),
                array( 'XL', '14 - 16', '12', '42', '15'  ),
                array( 'XXL', '16 - 28', '14', '44', '17'  )
            );
        } else {
            $tables = get_post_meta( $post->ID, 'omniverse_sguide', true );
        }

		if ( ! $tables ) {
			$tables = array(
				array( 'Size' ),
				array( 'XS' ),
			);
		}

        omniverse_sguide_table_template( $tables );
    }
}

/**
 * ------------------------------------------------------------------------------------------------
 * Table
 * ------------------------------------------------------------------------------------------------
 */
//Table template
if( ! function_exists( 'omniverse_sguide_table_template' ) ) {
    function omniverse_sguide_table_template( $tables ) {
		wp_enqueue_script( 'wd-edit-table', OMNIVERSE_ASSETS . '/js/libs/jquery.edittable.min.js', array(), OMNIVERSE_VERSION, true );
		wp_enqueue_style( 'omniverse-edittable-style', OMNIVERSE_ASSETS . '/css/jquery.edittable.min.css', array(), OMNIVERSE_VERSION );
		wp_enqueue_style( 'wd-admin-page-size-guides', OMNIVERSE_ASSETS . '/css/parts/page-size-guides.min.css', array(), OMNIVERSE_VERSION );
        ?>
        <textarea class="omniverse-sguide-table-edit" name="omniverse-sguide-table" style="display:none;">
            <?php echo json_encode( $tables ); ?>
        </textarea>
        <?php
    }
}

//Save table action
if( ! function_exists( 'omniverse_sguide_table_save' ) ) {
    function omniverse_sguide_table_save( $post_id ){

        if ( !isset( $_POST['omniverse-sguide-table'] ) ) return;

        $size_guide = json_decode( stripslashes( $_POST['omniverse-sguide-table'] ) );

        update_post_meta( $post_id, 'omniverse_sguide', $size_guide );
        
        //Save product category
        omniverse_sguide_save_category( $post_id );
    }
}

/**
 * ------------------------------------------------------------------------------------------------
 * Dropdown
 * ------------------------------------------------------------------------------------------------
 */
//Dropdown template
if( ! function_exists( 'omniverse_sguide_dropdown_template' ) ) {
    function omniverse_sguide_dropdown_template( $post ){
        $arg = array(
            'post_type' => 'omniverse_size_guide',
            'numberposts' => -1
        );

        $sguide_list = get_posts( $arg );

        $sguide_post_id = get_post_meta( $post->ID, 'omniverse_sguide_select' );

        $sguide_post_id = isset( $sguide_post_id[0] ) ? $sguide_post_id[0] : '';
        
        ?>
            <select name="omniverse_sguide_select">
                <option value="none" <?php selected( 'none', $sguide_post_id ); ?>><?php esc_html_e( '— None —', 'omniverse' ); ?></option>
                
                <?php foreach ( $sguide_list as $sguide_post ): ?>
                    <option value="<?php echo esc_attr( $sguide_post->ID ); ?>" <?php selected( $sguide_post_id, $sguide_post->ID ); ?>>
						<?php echo wp_kses( $sguide_post->post_title, omniverse_get_allowed_html() ); ?>
					</option>
                <?php endforeach; ?>
                
            </select><br><br>
            
            <label>
                <input type="checkbox" name="omniverse_disable_sguide" id="omniverse_disable_sguide" <?php checked( 'disable', $sguide_post_id, true ); ?>> 
                <?php esc_html_e( 'Hide size guide from this product', 'omniverse' ) ?>
            </label>
        <?php
    }
}

//Dropdown Save
if( ! function_exists( 'omniverse_sguide_dropdown_save' ) ) {
    function omniverse_sguide_dropdown_save( $post_id ){
        if ( isset( $_POST['omniverse_sguide_select'] ) && $_POST['omniverse_sguide_select'] ) {
			
            if ( isset( $_POST['omniverse_disable_sguide'] ) && $_POST['omniverse_disable_sguide'] == 'on' ) {
                update_post_meta( $post_id, 'omniverse_sguide_select', 'disable' );
            } else {
                update_post_meta( $post_id, 'omniverse_sguide_select', sanitize_text_field( $_POST['omniverse_sguide_select'] ) );
            }
            
        }
    }
}

/**
 * ------------------------------------------------------------------------------------------------
 * Display
 * ------------------------------------------------------------------------------------------------
 */

// Size guide display.
if ( ! function_exists( 'omniverse_sguide_display' ) ) {
	function omniverse_sguide_display( $post_id = false, $args = array() ) {
		$post_id        = ( $post_id ) ? $post_id : get_the_ID();
		$sguide_post_id = get_post_meta( $post_id, 'omniverse_sguide_select' );

		if ( isset( $sguide_post_id[0] ) && 'disable' === $sguide_post_id[0] ) {
			return;
		}

		if ( isset( $sguide_post_id[0] ) && ! empty( $sguide_post_id[0] ) && 'none' !== $sguide_post_id[0] ) {
			$sguide_post_id = $sguide_post_id[0];
		} else {
			$sguide_post_id = '';
			$terms          = wp_get_post_terms( $post_id, 'product_cat' );
			if ( $terms ) {
				foreach ( $terms as $term ) {
					if ( get_term_meta( $term->term_id, 'omniverse_chosen_sguide', true ) ) {
						$sguide_post_id = get_term_meta( $term->term_id, 'omniverse_chosen_sguide', true );
					}
				}
			}
		}

		$sguide_post_id = apply_filters( 'wpml_object_id', $sguide_post_id, 'omniverse_size_guide', true );

		if ( $sguide_post_id ) {
			$sguide_post = get_post( $sguide_post_id );
			$size_tables = get_post_meta( $sguide_post_id, 'omniverse_sguide', true );

			omniverse_sguide_display_table_template( $sguide_post, $size_tables, $args );
		}
	}
}

// Size guide display template.
if ( ! function_exists( 'omniverse_sguide_display_table_template' ) ) {
	function omniverse_sguide_display_table_template( $sguide_post, $size_tables, $args = array() ) {
		$is_quick_view = omniverse_loop_prop( 'is_quick_view' );

		if ( ! isset( $args['builder_classes'] ) || empty( $args['builder_classes'] ) ) {
			$args['builder_classes'] = ' wd-style-text';
		}

		if ( ! omniverse_get_opt( 'size_guides' ) || $is_quick_view || ! $size_tables || ! $sguide_post ) {
			return;
		}

		$show_table = get_post_meta( $sguide_post->ID, 'omniverse_sguide_hide_table' );
		$show_table = isset( $show_table[0] ) ? $show_table[0] : 'show';

		omniverse_enqueue_js_library( 'magnific' );
		omniverse_enqueue_js_script( 'popup-element' );
		omniverse_enqueue_inline_style( 'mfp-popup' );
		omniverse_enqueue_inline_style( 'size-guide' );
		?>
			<style data-type="vc_shortcodes-custom-css">
				<?php echo get_post_meta( $sguide_post->ID, '_wpb_shortcodes_custom_css', true ); ?>
				<?php echo get_post_meta( $sguide_post->ID, 'omniverse_shortcodes_custom_css', true ); ?>
			/* */
			</style>
			<div id="wd_sizeguide" class="mfp-with-anim mfp-hide wd-popup wd-sizeguide <?php echo omniverse_get_old_classes( ' omniverse-content-popup' ); ?>">
				<h4 class="wd-sizeguide-title">
					<?php echo esc_html( $sguide_post->post_title ); ?>
				</h4>
				<div class="wd-sizeguide-content">
					<?php echo do_shortcode( $sguide_post->post_content ); ?>
				</div>
				<?php if ( 'show' === $show_table ) : ?>
					<div class="responsive-table">
						<table class="wd-sizeguide-table">
							<?php foreach ( $size_tables as $row ) : ?>
								<tr>
									<?php foreach ( $row as $col ) : ?>
										<td>
											<?php echo esc_html( $col ); ?>
										</td>
									<?php endforeach; ?>
								</tr>
							<?php endforeach; ?>
						</table>
					</div>
				<?php endif; ?>
			</div>

			<div class="wd-sizeguide-btn wd-action-btn wd-sizeguide-icon<?php echo esc_attr( $args['builder_classes'] ); ?>">
				<a class="wd-open-popup" rel="nofollow" href="#wd_sizeguide">
					<span><?php esc_html_e( 'Size Guide', 'omniverse' ); ?></span>
				</a>
			</div>
		<?php
	}
}

/**
 * ------------------------------------------------------------------------------------------------
 * Category
 * ------------------------------------------------------------------------------------------------
 */
 
//Size guide save category
if( ! function_exists( 'omniverse_sguide_save_category' ) ) {
	function omniverse_sguide_save_category( $post_id ) {
		if ( isset( $_POST['omniverse_sguide_category'] ) ) {
			$selected_sguide_category = omniverse_clean( $_POST['omniverse_sguide_category'] );
			update_post_meta( $post_id, 'omniverse_chosen_cats', $selected_sguide_category );

			$terms = get_terms( 'product_cat' );
			foreach ( $selected_sguide_category as $selected_sguide_cat ) {
				update_term_meta( $selected_sguide_cat, 'omniverse_chosen_sguide', $post_id );
			}
			foreach( $terms as $term ){
				if ( ! in_array( $term->term_id, $selected_sguide_category ) ) {
					if ( $post_id == get_term_meta( $term->term_id, 'omniverse_chosen_sguide', true ) ) {
						update_term_meta( $term->term_id, 'omniverse_chosen_sguide', '' );
					}
				}
			}
		}
		else{
			update_post_meta( $post_id, 'omniverse_chosen_cats', '' );
			$terms = get_terms( 'product_cat' );
			foreach( $terms as $term ){
				if ( $post_id == get_term_meta( $term->term_id, 'omniverse_chosen_sguide', true ) ) {
					update_term_meta( $term->term_id, 'omniverse_chosen_sguide', '' );
				}
			}
		}
	}
}

//Size guide category template
if( ! function_exists( 'omniverse_sguide_category_template' ) ) {
    function omniverse_sguide_category_template( $post ) {
        $arg = array(
            'taxonomy'     => 'product_cat',
            'orderdby'     => 'name',
            'hierarchical' => 1,
			'hide_empty'   => false,
        );

        $chosen_cats = get_post_meta( $post->ID, 'omniverse_chosen_cats' );
        
        if ( ! empty( $chosen_cats ) ) $chosen_cats = $chosen_cats[0];

        $sguide_cat_list = get_categories( $arg );
        
        ?>
        <ul>
            <?php foreach ( $sguide_cat_list as $sguide_cat ): ?>
                <?php $checked = false; ?>
                <?php if ( is_array( $chosen_cats ) && in_array( $sguide_cat->term_id, $chosen_cats ) ) $checked = 'checked'; ?>
                <li>
                    <input type="checkbox" name="omniverse_sguide_category[]" value="<?php echo esc_attr( $sguide_cat->term_id ); ?>" <?php echo esc_attr( $checked ); ?>>
					<?php echo wp_kses( $sguide_cat->name, omniverse_get_allowed_html() ); ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php
    }
}

/**
 * ------------------------------------------------------------------------------------------------
 * Hide table
 * ------------------------------------------------------------------------------------------------
 */
//Size guide hide table template
if( ! function_exists( 'omniverse_sguide_hide_table_template' ) ) {
    function omniverse_sguide_hide_table_template( $post ) {
        $disable_table = get_post_meta( $post->ID, 'omniverse_sguide_hide_table' );
        $disable_table = isset( $disable_table[0] ) ? $disable_table[0] : 'show';
        ?>
        <label>
            <input type="checkbox" name="omniverse_sguide_hide_table" id="omniverse_sguide_hide_table" <?php checked( 'hide', $disable_table, true ); ?> > 
            <?php esc_html_e( 'Hide size guide table', 'omniverse' ) ?>
        </label>
        <?php
    }
}
//Size guide hide table save
if( ! function_exists( 'omniverse_sguide_hide_table_save' ) ) {
    function omniverse_sguide_hide_table_save( $post_id ){
        if ( isset( $_POST['omniverse_sguide_hide_table'] ) && $_POST['omniverse_sguide_hide_table'] == 'on' ) {
            update_post_meta( $post_id, 'omniverse_sguide_hide_table', 'hide' );
        } else {
            update_post_meta( $post_id, 'omniverse_sguide_hide_table', 'show' );
        }
    }
}
