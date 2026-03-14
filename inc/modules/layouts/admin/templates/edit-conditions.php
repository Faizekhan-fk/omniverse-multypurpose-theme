<?php
/**
 * Edit conditions template.
 *
 * @package Omniverse
 *
 * @var Admin  $admin      Admin instance.
 * @var string $type       Layout type.
 * @var array  $conditions Conditions.
 * @var int    $post_id    Post id.
 */

use DN\Modules\Layouts\Admin;

$conditions = $conditions ? wp_json_encode( $conditions, JSON_HEX_APOS ) : '';

ob_start();
?>
<div class="dn-layout-conditions" data-type="<?php echo esc_attr( $type ); ?>" data-conditions='<?php echo
$conditions; ?>' data-id="<?php echo esc_attr( $post_id ); ?>">
	<a href="javascript:void(0);" class="dn-layout-conditions-edit-add dn-hidden dn-inline-btn dn-color-primary dn-i-add">
		<?php esc_html_e( 'Add condition', 'omniverse' ); ?>
	</a>

	<div class="dn-popup-actions dn-layout-submit-wrap">
		<a href="javascript:void(0);" class="dn-layout-conditions-edit-save dn-btn dn-color-primary dn-i-save dn-hidden">
			<?php esc_html_e( 'Save conditions', 'omniverse' ); ?>
		</a>
	</div>

</div>
<?php
$content = ob_get_clean();

$admin->get_template(
	'popup',
	array(
		'btn_text'    => esc_html__( 'Edit conditions', 'omniverse' ),
		'btn_classes' => ' dn-layout-conditions-edit dn-i-edit-write',
		'title_text'  => esc_html__( 'Edit conditions', 'omniverse' ),
		'content'     => $content,
	)
);
