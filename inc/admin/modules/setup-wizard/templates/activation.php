<?php
/**
 * Activation template.
 *
 * @package omniverse
 */

?>

<div class="dn-wizard-content-inner">
	<?php DN\Registry::getInstance()->activation->form(); ?>
</div>

<div class="dn-wizard-footer">
	<?php $this->get_prev_button( 'welcome' ); ?>

	<div>
		<?php if ( omniverse_is_license_activated() ) : ?>
			<?php $this->get_next_button( 'child-theme' ); ?>
		<?php else : ?>
			<?php $this->get_skip_button( 'child-theme' ); ?>
		<?php endif; ?>
	</div>
</div>