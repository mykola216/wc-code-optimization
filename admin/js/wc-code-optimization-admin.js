(function ($) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	$(function () {
		$('#selected_exclude_css').select2();


		// $('#select_page').change(function () {
		// 	$.ajax({
		// 		url: ajaxurl,
		// 		type: 'POST',
		// 		data: {
		// 			action: 'wc_get_the_entire_css_code'
		// 		},
		// 		success: function (data) {
		// 			//console.log(data);
		// 			$('#selected_exclude_css').html(data);
		// 		}
		// 	});
		// });
		let selectElement = $('#selected_exclude_css');
		
		//$('#generate-optimized-css-code').click(function () {
		$('.wc-optimized-cached-file').click(function () {
			let optimizedPage = $(this).text();
			console.log(optimizedPage);
			let selectedCss = selectElement.val();
			let selectedOption = [...selectElement.find('option:selected')];
			let cssUrl = selectedOption.map(e => $(e).attr('css_url'));


            $(this).addClass('send_ajax_text action');

			$.ajax({
				url: ajaxurl,
				type: 'POST',
				data: {
					action: 'wc_optimized_css_action',
					selectedCss: selectedCss,
					css_url: cssUrl,
					optimizedPage: optimizedPage
				},
				success: function (data) {
					console.log('Result: ' + data);

					$('#optimization-css').text(data);

                    $('div.send_ajax_text').removeClass('action');

				},
				error: function () {
					console.log('Error sending a request to the server');
				}
			});
		});

		// $('#send-data-server').click(function () {
		// 	$('.lds-roller').show();
		// 	$.ajax({
		// 		url: ajaxurl,
		// 		type: 'POST',
		// 		data: {
		// 			action: 'wc_send_data_server_action',
		// 		},
		// 		success: function (data) {
		// 			$('.lds-roller').hide();

		// 			console.log('Result: ' + data);
		// 			$('#optimization-css').text(data);
		// 		},
		// 		error: function () {
		// 			console.log('Error sending a request to the server');
		// 		}
		// 	});
		// });

		// $('#saveButton').on('click', function () {
		// 	let selectedCss = selectElement.val();
		// 	console.log(selectedCss);
		// 	console.log(selectElement);
		// 	$.ajax({
		// 		type: 'POST',
		// 		url: ajaxurl,
		// 		data: {
		// 			action: 'wc_optimized_css_save',
		// 			selectedCss: selectedCss
		// 		},
		// 		success: function (data) {
		// 			console.log('Результат: ' + data);
		// 		},
		// 		error: function () {
		// 			console.log('Помилка при відправці запиту на сервер');
		// 		}
		// 	});
		// });

	});
})(jQuery);
