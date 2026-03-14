jQuery(window).on('elementor:init', function() {
	var buttons = elementor.modules.controls.BaseData.extend({
		onReady: function() {
			var self = this;
			var $set = self.$el.find('.dn-btns-set');
			$set.on('click', '.dn-set-item', function() {
				var $btn = jQuery(this);
				if ($btn.hasClass('dn-active')) {
					return;
				}
				var val = $btn.data('value');

				$set.find('.dn-active').
					removeClass('dn-active');

				$btn.addClass('dn-active');

				self.ui.input.val(val);
				self.saveValue();
			});

		},

		saveValue: function() {
			this.setValue(this.ui.input.val());
		},

		onBeforeDestroy: function() {
			this.saveValue();
		},
	});
	elementor.addControlView('wd_buttons', buttons);
});
