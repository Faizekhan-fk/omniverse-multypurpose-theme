<?php
/**
 * Interface template.
 *
 * @package Omniverse
 *
 * @var Admin $admin Admin instance.
 */

use DN\Modules\Layouts\Admin;

?>

<div class="wd-layout">
	<?php
	$admin->get_template(
		'popup',
		array(
			'btn_text'   => '',
			'title_text' => esc_html__( 'Create layout', 'omniverse' ),
			'content'    => $admin->get_form(),
		)
	);
	?>

	<?php $admin->print_condition_template(); ?>
	<?php $admin->print_tabs(); ?>
</div>
