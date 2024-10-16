window.register = function(that, e) {
  e.preventDefault();

  $(that).find('[type="submit"]').html('<i class="fas fa-sync fa-spin fa-fw"></i>');

  const url = $(that).attr('action');
  const data = $(that).serialize();

  axios.post(url, data)
    .then(function (response) {
      window.location.replace(response.data.intended);
    }).catch(function (error) {
      $(that).find('[type="submit"]').html('Enviar');
      notify(error.response.data.errors, '#cc3300');
      grecaptcha.reset();
    });
}

// ==============================================================
// Notify
// ==============================================================
window.notify = function(text, color) {
  $(function() {
    let message = [];
    if ( typeof(text.name) !== "undefined" ) { message.push(text.name); }
    if ( typeof(text.email) !== "undefined" ) { message.push(text.email); }
    if ( typeof(text.cellphone) !== "undefined" ) { message.push(text.cellphone); }
    if ( typeof(text.fantasy_name) !== "undefined" ) { message.push(text.fantasy_name); }
    if ( typeof(text.cnpj) !== "undefined" ) { message.push(text.cnpj); }
    if ( typeof(text.cpf) !== "undefined" ) { message.push(text.cpf); }
    if ( typeof(text.password) !== "undefined" ) { message.push(text.password); }
    if ( typeof(text['g-recaptcha-response']) !== "undefined" ) { message.push(text['g-recaptcha-response']); }

    $.toast({
      heading: 'Informação',
      text: message,
      icon: 'info',
      loaderBg: color,
    });
    
  });

}

$(document).on('change', '#type', function(e) {
	let type = $(this).val();
	if(type == 0) {
		$('[data-section="pf"]').find('input, select, textarea').removeAttr('disabled');
		$('[data-section="pf"]').slideDown();
		$('[data-section="pj"]').find('input, select, textarea').attr('disabled','disabled');
		$('[data-section="pj"]').slideUp();
	} else {
		$('[data-section="pj"]').find('input, select, textarea').removeAttr('disabled');
		$('[data-section="pj"]').slideDown();
		$('[data-section="pf"]').find('input, select, textarea').attr('disabled','disabled');
		$('[data-section="pf"]').slideUp();
	}
});

$('#type').trigger('change');