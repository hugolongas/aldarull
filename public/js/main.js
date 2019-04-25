$(document).ready(function () {

	$('#submit_contact').click(function (e) {
		e.preventDefault();
		if ($('#contact-form').valid()) {
			$('#loading').show();
			$('#submit_contact').attr('disabled', 'disabled');
			var form_data = new FormData();
			var name = $('#contact_name').val();
			var email = $('#contact_email').val();
			var message = $('#contact_message').val();
			form_data.append('name', name);
			form_data.append('email', email);
			form_data.append('message', message);
			$.ajaxSetup({
				headers:
					{ 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
			});
			$.ajax({
				url: '/contact',
				dataType: 'text', // what to expect back from the PHP script
				type: 'post',
				data: form_data,
				processData: false,
				contentType: false,
				success: function (response) {
					$('#loading').fadeOut('slow');
					$('#contact-form')[0].reset();
					$('#response').html("<h3>S'ha enviat l'email correctament</h3>").fadeIn('slow');
					$('#submit_contact').removeAttr('disabled');
					setTimeout(function () {
						$('#response').empty();
					}, 5000);
				},
				error: function (jqXHR, textStatus, errorThrown) {
					$('#loading').fadeOut('slow');
					$('#submit_contact').removeAttr('disabled');
					$('#response').text('Error Thrown: ' + errorThrown + '<br>jqXHR: ' + jqXHR + '<br>textStatus: ' + textStatus).show();
				}
			});
		}
		else {
			$('label.error').hide().fadeIn('slow');
		}
	});



	$("#cart").click(function () {
		if ($("#sidebar").hasClass("cart-open")) {
			$("#sidebar").removeClass("cart-open");
			$("#main").removeClass("main-open-cart");
		}
		else {
			$("#sidebar").addClass("cart-open");
			$("#main").addClass("main-open-cart");
		}
	});

	$("#close-cart").click(function () {
		$("#sidebar").removeClass("cart-open");
		$("#main").removeClass("main-open-cart");
	});

});