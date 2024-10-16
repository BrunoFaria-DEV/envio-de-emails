// ==============================================================
// Imports
// ==============================================================
// import 'jquery-confirm/dist/jquery-confirm.min';
import 'jquery-mask-plugin';
// import 'jquery-toast-plugin';
import '@selectize/selectize/dist/js/selectize';

import 'jquery-toast-plugin';

$(function () {
	init();

  // ==============================================================
  // Selectize
  // ==============================================================
  $('.selectize').each(function () {
    let options = {},
        placeholder = $(this).data('placeholder');

    if(placeholder)
      options['placeholder'] = placeholder;

    $(this).selectize(options);
  });
});

// ==============================================================
// Ajax complete
// ==============================================================
$(document).ajaxComplete(function() {
	init();
});

function init()
{
	// ==============================================================
	// jQuery Mask Plugin
	// ==============================================================
	$('.phone').mask('(00) 0000-0000', { clearIfNotMatch: true });
	$('.cellphone').mask('(00) 00000-0000', { clearIfNotMatch: true });
	$('.cpf').mask('000.000.000-00', { clearIfNotMatch: true });
	$('.cnpj').mask('00.000.000/0000-00', { clearIfNotMatch: true });
	$('.postal_code').mask('00000-000', { clearIfNotMatch: true });
	$('.date').mask('00/00/0000', { clearIfNotMatch: true });
	$('.date_without_year').mask('00/00', { clearIfNotMatch: true });
	$('.time').mask('00:00', { clearIfNotMatch: true });
	$('.money').mask('000.000.000.000.000,00', { reverse: true });
	$('.weight').mask('000000.00', { reverse: true });
	$('.number').mask('0#');

	let phoneCellphone = function (val) {
		return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
	},
	spOptions = {
		onKeyPress: function(val, e, field, options) {
			field.mask(phoneCellphone.apply({}, arguments), options);
		}
	};

	$('.phone_cellphone').mask(phoneCellphone, spOptions);

	// ==============================================================
	// Smooth link
	// ==============================================================
	$('.smooth-link').on('click', function(e) {
		$('html, body').animate({
			scrollTop: $($(this).attr('href')).offset().top
		}, 2000);
	});

	// ==============================================================
	// Back to top
	// ==============================================================
	$('#back-to-top').on('click', function(e) {
		e.preventDefault();
		$('html, body').animate({
			scrollTop: 0
		}, 700);
	});

	$(window).scroll(function() {
		if ($(this).scrollTop() >= 50) {
			$('#back-to-top').fadeIn(200);
		} else {
			$('#back-to-top').fadeOut(200);
		}
	});
}

// ==============================================================
// Recaptcha callbacks
// ==============================================================
window.enableSubmit = function() {
	$('[type="submit"]').removeAttr('disabled');
	$('[type="submit"]').css('pointer-events', 'auto');
}

window.disableSubmit = function() {
	$('[type="submit"]').attr('disabled', true).css('pointer-events', 'none');
}

// ==============================================================
// Notify
// ==============================================================
window.notify = function(text, color) {
	$.toast({
		heading: 'Informação',
		text: text,
		icon: 'info',
		loaderBg: color,
	});
}
