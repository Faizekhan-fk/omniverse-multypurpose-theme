<?php
/**
 * Admin setting page template.
 *
 * @var array $args Arguments for render template.
 * @var array $current_args Arguments from databased.
 * @var string $max_priority Max saved priority.
 * @package Omniverse
 */

use DN\Modules\Dynamic_Discounts\Admin;

$discount_rules              = ! empty( $current_args['discount_rules'] ) ? $current_args['discount_rules'] : $args['discount_rules'];
$discount_condition          = ! empty( $current_args['discount_condition'] ) ? $current_args['discount_condition'] : $args['discount_condition'];
$selected_discount_condition = array();
?>

<div class="dn-box dn-options dn-metaboxes dn-theme-style">
	<?php wp_nonce_field( 'save_wd_woo_discounts', 'zs_woo_discounts_meta_boxes_nonce' ); ?>

	<div class="dn-box-content">
		<div class="dn-row dn-sp-20">
			<div class="dn-col">
				<div class="dn-section dn-active-section" data-id="general">
					<div class="dn-fields">
						<div class="dn-field dn-settings-field dn-_omniverse_rule_type-field <?php echo count( $args['_omniverse_rule_type'] ) <= 1 ? 'dn-hidden' : ''; ?>">
							<div class="dn-option-title">
								<label for="_omniverse_rule_type">
									<?php echo esc_html__( 'Rule type', 'omniverse' ); ?>
								</label>
							</div>
							<div class="dn-option-control">
								<select id="_omniverse_rule_type" class="dn-select" name="_omniverse_rule_type" aria-label="<?php esc_attr_e( 'Rule type', 'omniverse' ); ?>">
									<?php foreach ( $args['_omniverse_rule_type'] as $key => $label ) : ?>
										<option value="<?php echo esc_attr( $key ); ?>" <?php echo isset( $current_args['_omniverse_rule_type'] ) ? selected( $current_args['_omniverse_rule_type'], $key ) : ''; ?>>
											<?php echo esc_html( $label ); ?>
										</option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>

						<div class="dn-field dn-settings-field dn-omniverse_discount_priority-field dn-col-6">
							<div class="dn-option-title">
								<label for="omniverse_discount_priority">
									<?php echo esc_html__( 'Priority', 'omniverse' ); ?>
								</label>
							</div>
							<div class="dn-option-control">
								<input type="number" name="omniverse_discount_priority" id="omniverse_discount_priority" class="dn-col-6" min="1" placeholder="<?php esc_attr_e( 'Priority', 'omniverse' ); ?>" aria-label="<?php esc_attr_e( 'Discount priority', 'omniverse' ); ?>" value="<?php echo ! empty( $current_args['omniverse_discount_priority'] ) ? esc_attr( $current_args['omniverse_discount_priority'] ) : esc_attr( (int) $max_priority + 1 ); ?>">
							</div>
							<p class="dn-field-description">
								<?php esc_html_e( 'Set priority for current discount rules. This will be useful if several rules apply to one product.', 'omniverse' ); ?>
							</p>
						</div>

						<div class="dn-field dn-settings-field dn-discount_quantities-field dn-col-6 <?php echo count( $args['discount_quantities'] ) <= 1 ? 'dn-hidden' : ''; ?>">
							<div class="dn-option-title">
								<label for="discount_quantities">
									<?php echo esc_html__( 'Quantities', 'omniverse' ); ?>
								</label>
							</div>
							<div class="dn-option-control">
								<select id="discount_quantities" class="dn-select" name="discount_quantities" aria-label="<?php esc_attr_e( 'Quantities', 'omniverse' ); ?>">
									<?php foreach ( $args['discount_quantities'] as $key => $label ) : ?>
										<option value="<?php echo esc_attr( $key ); ?>" <?php echo isset( $current_args['discount_quantities'] ) ? selected( $current_args['discount_quantities'], $key ) : ''; ?>>
											<?php echo esc_html( $label ); ?>
										</option>
									<?php endforeach; ?>
								</select>
							</div>
							<p class="dn-field-description">
								<?php esc_html_e( 'Choose "Individual variation" to have variations of a variable product count as an individual product.', 'omniverse' ); ?>
							</p>
						</div>

						<div class="dn-group-title">
							<span>
								<?php echo esc_html__( 'Discount rules', 'omniverse' ); ?>
							</span>
						</div>
						<div class="dn-fields-group dn-group">

							<div class="dn-field dn-settings-field dn-select_with_table-control dn-_omniverse_discount_rules-field" data-dependency="_omniverse_rule_type:equals:bulk;">
								<div class="dn-option-control">
									<div class="dn-item-template dn-hidden">
										<div class="dn-table-controls dn-discount">
											<div class="dn-discount-from">
												<input type="number" name="discount_rules[{{index}}][_omniverse_discount_rules_from]" id="_omniverse_discount_rules_from_{{index}}" class="dn-col-6" min="0" placeholder="<?php esc_attr_e( 'From', 'omniverse' ); ?>" aria-label="<?php esc_attr_e( 'Discount rules from', 'omniverse' ); ?>" disabled>
											</div>
											<div class="dn-discount-to">
												<input type="number" name="discount_rules[{{index}}][_omniverse_discount_rules_to]" id="_omniverse_discount_rules_to_{{index}}" class="dn-col-6" min="0" placeholder="<?php esc_attr_e( 'To', 'omniverse' ); ?>" aria-label="<?php esc_attr_e( 'Discount rules to', 'omniverse' ); ?>" disabled>
											</div>
											<div class="dn-discount-type">
												<select id="_omniverse_discount_type_{{index}}" class="dn-select" name="discount_rules[{{index}}][_omniverse_discount_type]" aria-label="<?php esc_attr_e( 'Discount type', 'omniverse' ); ?>" disabled>
													<?php foreach ( $args['discount_rules'][0]['_omniverse_discount_type'] as $key => $label ) : ?>
														<option value="<?php echo esc_attr( $key ); ?>">
															<?php echo esc_html( $label ); ?>
														</option>
													<?php endforeach; ?>
												</select>
											</div>
											<div class="dn-discount-amount-value">
												<div class="dn-option-control">
													<input type="number" name="discount_rules[{{index}}][_omniverse_discount_amount_value]" id="_omniverse_discount_amount_value_{{index}}" class="dn-col-6" min="0" placeholder="0.00" step="0.01" aria-label="<?php esc_attr_e( 'Discount amount value', 'omniverse' ); ?>" disabled>
												</div>
											</div>
											<div class="dn-discount-percentage-value dn-hidden">
												<div class="dn-option-control">
													<input type="number" name="discount_rules[{{index}}][_omniverse_discount_percentage_value]" id="_omniverse_discount_percentage_value_{{index}}" class="dn-col-6" min="0" max="100" placeholder="0.00" step="0.01" aria-label="<?php esc_attr_e( 'Discount percentage value', 'omniverse' ); ?>" disabled>
												</div>
											</div>
											<div class="dn-discount-close">
												<a href="#" class="dn-remove-item dn-bordered-btn dn-color-warning dn-style-icon dn-i-close"></a>
											</div>
										</div>
									</div>
									<div class="dn-controls-wrapper">
										<div class="dn-table-controls dn-discount title">
											<div class="dn-discount-from">
												<label><?php echo esc_html__( 'From', 'omniverse' ); ?></label>
											</div>
											<div class="dn-discount-to">
												<label><?php echo esc_html__( 'To', 'omniverse' ); ?></label>
											</div>
											<div class="dn-discount-type">
												<label><?php echo esc_html__( 'Type', 'omniverse' ); ?></label>
											</div>
											<div class="dn-discount-value">
												<label><?php echo esc_html__( 'Value', 'omniverse' ); ?></label>
											</div>
											<div class="dn-discount-remove"></div>
										</div>
										<?php foreach ( $discount_rules as $id => $rule_args ) : //phpcs:ignore. ?>
											<div class="dn-table-controls dn-discount">
												<div class="dn-discount-from">
													<input type="number" name="discount_rules[<?php echo esc_attr( $id ); ?>][_omniverse_discount_rules_from]" id="_omniverse_discount_rules_from_<?php echo esc_attr( $id ); ?>" class="dn-col-6" min="0" placeholder="<?php esc_attr_e( 'From', 'omniverse' ); ?>" aria-label="<?php esc_attr_e( 'Discount rules from', 'omniverse' ); ?>" value="<?php echo isset( $current_args['discount_rules'][ $id ]['_omniverse_discount_rules_from'] ) ? esc_attr( $current_args['discount_rules'][ $id ]['_omniverse_discount_rules_from'] ) : ''; ?>">
												</div>
												<div class="dn-discount-to">
													<input type="number" name="discount_rules[<?php echo esc_attr( $id ); ?>][_omniverse_discount_rules_to]" id="_omniverse_discount_rules_to_<?php echo esc_attr( $id ); ?>" class="dn-col-6" min="0" placeholder="<?php esc_attr_e( 'To', 'omniverse' ); ?>" aria-label="<?php esc_attr_e( 'Discount rules to', 'omniverse' ); ?>" value="<?php echo isset( $current_args['discount_rules'][ $id ]['_omniverse_discount_rules_to'] ) ? esc_attr( $current_args['discount_rules'][ $id ]['_omniverse_discount_rules_to'] ) : ''; ?>">
												</div>
												<div class="dn-discount-type">
													<select id="_omniverse_discount_type_<?php echo esc_attr( $id ); ?>" class="dn-select" name="discount_rules[<?php echo esc_attr( $id ); ?>][_omniverse_discount_type]" aria-label="<?php esc_attr_e( 'Discount type', 'omniverse' ); ?>">
														<?php foreach ( $args['discount_rules'][0]['_omniverse_discount_type'] as $key => $label ) : ?>
															<option value="<?php echo esc_attr( $key ); ?>" <?php echo isset( $current_args['discount_rules'][ $id ]['_omniverse_discount_type'] ) ? selected( $current_args['discount_rules'][ $id ]['_omniverse_discount_type'], $key, false ) : ''; ?>>
																<?php echo esc_html( $label ); ?>
															</option>
														<?php endforeach; ?>
													</select>
												</div>
												<div class="dn-discount-amount-value <?php echo isset( $current_args['discount_rules'][ $id ] ) && isset( $current_args['discount_rules'][ $id ]['_omniverse_discount_type'] ) && 'amount' === $current_args['discount_rules'][ $id ]['_omniverse_discount_type'] || ! isset( $current_args['discount_rules'][ $id ] ) ? '' : 'dn-hidden'; ?>">
													<div class="dn-option-control">
														<input type="number" name="discount_rules[<?php echo esc_attr( $id ); ?>][_omniverse_discount_amount_value]" id="_omniverse_discount_amount_value_<?php echo esc_attr( $id ); ?>" class="dn-col-6" min="0" placeholder="0.00" step="0.01" aria-label="<?php esc_attr_e( 'Discount amount value', 'omniverse' ); ?>" value="<?php echo isset( $current_args['discount_rules'][ $id ]['_omniverse_discount_amount_value'] ) ? esc_attr( $current_args['discount_rules'][ $id ]['_omniverse_discount_amount_value'] ) : ''; ?>">
													</div>
												</div>
												<div class="dn-discount-percentage-value <?php echo isset( $current_args['discount_rules'][ $id ] ) && isset( $current_args['discount_rules'][ $id ]['_omniverse_discount_type'] ) && 'percentage' === $current_args['discount_rules'][ $id ]['_omniverse_discount_type'] ? '' : 'dn-hidden'; ?>">
													<div class="dn-option-control">
														<input type="number" name="discount_rules[<?php echo esc_attr( $id ); ?>][_omniverse_discount_percentage_value]" id="_omniverse_discount_percentage_value_<?php echo esc_attr( $id ); ?>" class="dn-col-6" min="0" max="100" placeholder="0.00" step="0.01" aria-label="<?php esc_attr_e( 'Discount percentage value', 'omniverse' ); ?>" value="<?php echo isset( $current_args['discount_rules'][ $id ]['_omniverse_discount_percentage_value'] ) ? esc_attr( $current_args['discount_rules'][ $id ]['_omniverse_discount_percentage_value'] ) : ''; ?>">
													</div>
												</div>
												<div class="dn-discount-close">
													<a href="#" class="dn-remove-item dn-bordered-btn dn-color-warning dn-style-icon dn-i-close"></a>
												</div>
											</div>
										<?php endforeach; ?>
									</div>
									<a href="#" class="dn-add-row dn-inline-btn dn-color-primary dn-i-add">
										<?php esc_html_e( 'Add new rule', 'omniverse' ); ?>
									</a>
								</div>
							</div>
						</div>

						<div class="dn-group-title">
							<span>
								<?php echo esc_html__( 'Discount condition', 'omniverse' ); ?>
							</span>
						</div>
						<div class="dn-fields-group dn-group">
							<div class="dn-field dn-settings-field dn-select_with_table-control dn-_omniverse_discount_condition-field">
								<div class="dn-option-control">
									<div class="dn-item-template dn-hidden">
										<div class="dn-table-controls dn-discount">
											<div class="dn-discount-comparison-condition">
												<select class="dn-discount-comparison-condition" name="discount_condition[{{index}}][comparison]" aria-label="<?php esc_attr_e( 'Comparison condition', 'omniverse' ); ?>" disabled>
													<?php foreach ( $args['discount_condition'][0]['comparison'] as $key => $label ) : ?>
														<option value="<?php echo esc_attr( $key ); ?>">
															<?php echo esc_html( $label ); ?>
														</option>
													<?php endforeach; ?>
												</select>
											</div>
											<div class="dn-discount-condition-type">
												<select class="dn-discount-condition-type" name="discount_condition[{{index}}][type]" aria-label="<?php esc_attr_e( 'Condition type', 'omniverse' ); ?>" disabled>
													<?php foreach ( $args['discount_condition'][0]['type'] as $key => $label ) : ?>
														<option value="<?php echo esc_attr( $key ); ?>">
															<?php echo esc_html( $label ); ?>
														</option>
													<?php endforeach; ?>
												</select>
											</div>
											<div class="dn-discount-condition-query dn-hidden">
												<select class="dn-discount-condition-query" name="discount_condition[{{index}}][query]" placeholder="<?php esc_attr_e( 'Start typing...', 'omniverse' ); ?>" aria-label="<?php esc_attr_e( 'Condition query', 'omniverse' ); ?>" disabled></select>
											</div>
											<div class="dn-discount-product-type-condition-query dn-hidden">
												<select class="dn-discount-product-type-condition-query" name="discount_condition[{{index}}][product-type-query]" aria-label="<?php esc_attr_e( 'Product type condition query', 'omniverse' ); ?>" disabled>
													<?php foreach ( $args['discount_condition'][0]['product-type-query'] as $key => $label ) : ?>
														<option value="<?php echo esc_attr( $key ); ?>">
															<?php echo esc_html( $label ); ?>
														</option>
													<?php endforeach; ?>
												</select>
											</div>

											<div class="dn-discount-close">
												<a href="#" class="dn-remove-item dn-bordered-btn dn-color-warning dn-style-icon dn-i-close"></a>
											</div>
										</div>
									</div>

									<div class="dn-controls-wrapper">
										<div class="dn-table-controls dn-discount title">
											<div class="dn-discount-comparison-condition">
												<label><?php esc_html_e( 'Comparison condition', 'omniverse' ); ?></label>
											</div>
											<div class="dn-discount-condition-type">
												<label><?php esc_html_e( 'Condition type', 'omniverse' ); ?></label>
											</div>
											<div class="dn-discount-condition-query <?php echo empty( $selected_discount_condition ) ? 'dn-hidden' : ''; ?>">
												<label><?php esc_html_e( 'Condition query', 'omniverse' ); ?></label>
											</div>
											<div class="dn-discount-remove"></div>
										</div>
				                        <?php foreach ( $discount_condition as $id => $condition_args ) : //phpcs:ignore. ?>
											<?php
											if ( ! empty( $current_args['discount_condition'][ $id ]['query'] ) && ! empty( $current_args['discount_condition'][ $id ]['type'] ) ) {
												$selected_discount_condition = Admin::get_instance()->get_saved_conditions_query( $current_args['discount_condition'][ $id ]['query'], $current_args['discount_condition'][ $id ]['type'] );
											}
											?>

											<div class="dn-table-controls dn-discount">
												<div class="dn-discount-comparison-condition">
													<select class="dn-discount-comparison-condition" name="discount_condition[<?php echo esc_attr( $id ); ?>][comparison]" aria-label="<?php esc_attr_e( 'Comparison condition', 'omniverse' ); ?>">
														<?php foreach ( $args['discount_condition'][0]['comparison'] as $key => $label ) : ?>
															<option value="<?php echo esc_attr( $key ); ?>" <?php echo isset( $current_args['discount_condition'][ $id ]['comparison'] ) ? selected( $current_args['discount_condition'][ $id ]['comparison'], $key, false ) : ''; ?>>
																<?php echo esc_html( $label ); ?>
															</option>
														<?php endforeach; ?>
													</select>
												</div>
												<div class="dn-discount-condition-type">
													<select class="dn-discount-condition-type" name="discount_condition[<?php echo esc_attr( $id ); ?>][type]" aria-label="<?php esc_attr_e( 'Condition type', 'omniverse' ); ?>">
														<?php foreach ( $args['discount_condition'][0]['type'] as $key => $label ) : ?>
															<option value="<?php echo esc_attr( $key ); ?>" <?php echo isset( $current_args['discount_condition'][ $id ]['type'] ) ? selected( $current_args['discount_condition'][ $id ]['type'], $key, false ) : ''; ?>>
																<?php echo esc_html( $label ); ?>
															</option>
														<?php endforeach; ?>
													</select>
												</div>
												<div class="dn-discount-condition-query <?php echo empty( $selected_discount_condition ) ? 'dn-hidden' : ''; ?>">
													<select class="dn-discount-condition-query" name="discount_condition[<?php echo esc_attr( $id ); ?>][query]" placeholder="<?php echo esc_attr__( 'Start typing...', 'omniverse' ); ?>" aria-label="<?php esc_attr_e( 'Condition query', 'omniverse' ); ?>">
														<?php if ( ! empty( $selected_discount_condition ) ) : ?>
															<option value="<?php echo esc_attr( $selected_discount_condition['id'] ); ?>" selected>
																<?php echo esc_html( $selected_discount_condition['text'] ); ?>
															</option>
														<?php endif; ?>
													</select>
												</div>
												<div class="dn-discount-product-type-condition-query <?php echo isset( $current_args['discount_condition'][ $id ] ) && ( 'product_type' !== $current_args['discount_condition'][ $id ]['type'] || ! isset( $current_args['discount_condition'][ $id ]['product-type-query'] ) ) || ! isset( $current_args['discount_condition'][ $id ] ) ? 'dn-hidden' : ''; ?>">
													<select class="dn-discount-product-type-condition-query" name="discount_condition[<?php echo esc_attr( $id ); ?>][product-type-query]" aria-label="<?php esc_attr_e( 'Product type condition query', 'omniverse' ); ?>">
														<?php foreach ( $args['discount_condition'][0]['product-type-query'] as $key => $label ) : ?>
															<option value="<?php echo esc_attr( $key ); ?>" <?php echo isset( $current_args['discount_condition'][ $id ]['product-type-query'] ) ? selected( $current_args['discount_condition'][ $id ]['product-type-query'], $key, false ) : ''; ?>>
																<?php echo esc_html( $label ); ?>
															</option>
														<?php endforeach; ?>
													</select>
												</div>

												<div class="dn-discount-close">
													<a href="#" class="dn-remove-item dn-bordered-btn dn-color-warning dn-style-icon dn-i-close"></a>
												</div>
											</div>
										<?php endforeach; ?>
									</div>
									<a href="#" class="dn-add-row dn-inline-btn dn-color-primary dn-i-add">
										<?php esc_html_e( 'Add new condition', 'omniverse' ); ?>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
