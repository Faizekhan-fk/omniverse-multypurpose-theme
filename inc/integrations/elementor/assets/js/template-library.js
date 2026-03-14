jQuery(function($) {
	if ('undefined' != typeof elementor && 'undefined' !== elementorCommon) {
		elementor.on('preview:loaded', function() {
			var $modal;

			// Add button.
			var $buttons = $('#tmpl-elementor-add-section');

			var text = $buttons.text().replace(
				'<div class="elementor-add-section-drag-title',
				'<div class="elementor-add-section-area-button dn-library-modal-btn" title="Zynxsol Templates">Zynxsol Templates</div><div class="elementor-add-section-drag-title'
			);

			$buttons.text(text);

			// Call modal.
			$(elementor.$previewContents[0].body).on('click', '.dn-library-modal-btn', function() {
				if ($modal) {
					$modal.show();
					return;
				}

				var modalOptions = {
					id           : 'dn-library-modal',
					headerMessage: $('#tmpl-elementor-dn-library-modal-header').html(),
					message      : $('#tmpl-elementor-dn-library-modal').html(),
					className    : 'elementor-templates-modal',
					closeButton  : true,
					draggable    : false,
					hide         : {
						onOutsideClick: true,
						onEscKeyPress : true
					},
					position     : {
						my: 'center',
						at: 'center'
					}
				};
				$modal = elementorCommon.dialogsManager.createWidget('lightbox', modalOptions);
				$modal.show();

				loadTemplates();
			});

			// Load items.
			function loadTemplates() {
				showLoader();

				$.ajax({
					url     : zs_template_library_script.demoAjaxUrl,
					method  : 'GET',
					data    : {
						action : 'omniverse_load_templates',
						builder: 'elementor'
					},
					dataType: 'json',
					success : function(response) {
						if (response && response.elements) {
							var itemTemplate = wp.template('elementor-dn-library-modal-item');
							var itemOrderTemplate = wp.template('elementor-dn-library-modal-order');
							response.elements = response.elements.reverse();
							$(itemTemplate(response)).appendTo($('#dn-library-modal #elementor-template-library-templates-container'));
							$(itemOrderTemplate(response)).appendTo($('#dn-library-modal #elementor-template-library-filter-toolbar-remote'));
							importTemplate();
							hideLoader();
						} else {
							$('<div class="dn-notice dn-warning">The library can\'t be loaded from the server.</div>').appendTo($('#dn-library-modal #elementor-template-library-templates-container'));
							hideLoader();
						}
					},
					error   : function() {
						$('<div class="dn-notice dn-warning">The library can\'t be loaded from the server.</div>').appendTo($('#dn-library-modal #elementor-template-library-templates-container'));
						hideLoader();
					}
				});
			}

			// Loader
			function showLoader() {
				$('#dn-library-modal #elementor-template-library-templates').hide();
				$('#dn-library-modal .elementor-loader-wrapper').show();
			}

			function hideLoader() {
				$('#dn-library-modal #elementor-template-library-templates').show();
				$('#dn-library-modal .elementor-loader-wrapper').hide();
			}

			function activateUpdateButton() {
				$('#elementor-panel-saver-button-publish').toggleClass('elementor-disabled');
				$('#elementor-panel-saver-button-save-options').toggleClass('elementor-disabled');
			}

			// Import.
			function importTemplate() {
				$('#dn-library-modal .elementor-template-library-template-insert').on('click', function() {
					showLoader();

					var config = {
						data   : {
							source            : 'dn',
							edit_mode         : true,
							display           : true,
							template_id       : $(this).data('id'),
							with_page_settings: false
						},
						success: function success(data) {
							if (data && data.content) {
								elementor.getPreviewView().addChildModel(data.content);
								$modal.hide();
								setTimeout(function() {
									hideLoader();
								}, 2000);
								activateUpdateButton();
							} else {
								$('<div class="dn-notice dn-warning">The element can\'t be loaded from the server.</div>').prependTo($('#dn-library-modal #elementor-template-library-templates-container'));
								hideLoader();
							}
						},
						error  : function() {
							$('<div class="dn-notice dn-warning">The element can\'t be loaded from the server.</div>').prependTo($('#dn-library-modal #elementor-template-library-templates-container'));
							hideLoader();
						}
					};

					return elementorCommon.ajax.addRequest('get_template_data', config);
				});

				// Close button.
				$('#dn-library-modal .elementor-templates-modal__header__close').on('click', function() {
					$modal.hide();
					hideLoader();
				});

				// Search.
				$('#dn-library-modal #elementor-template-library-filter-text').on('keyup', function() {
					var val = $(this).val().toLowerCase();

					$('#dn-library-modal').find('.elementor-template-library-template-block').each(function() {
						var $this = $(this);
						var title = $this.data('title').toLowerCase();
						var slug = $this.data('slug').toLowerCase();

						if (title.indexOf(val) > -1 || slug.indexOf(val) > -1) {
							$this.show();
						} else {
							$this.hide();
						}
					});
				});

				// Filters.
				$('#dn-library-modal #elementor-template-library-filter-subtype').on('change', function() {
					var val = $(this).val();

					$('#dn-library-modal').find('.elementor-template-library-template-block').each(function() {
						var $this = $(this);
						var tag = $this.data('tag').toLowerCase();

						if (tag.indexOf(val) > -1 || 'all' === val) {
							$this.show();
						} else {
							$this.hide();
						}
					});
				});
			}
		});
	}
});
