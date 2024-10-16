$(document).on('change', '#related', function(e) {
	let related = $(this).val();
	if(related == 'true') {
		$('[data-section="related"]').find('input, textarea').removeAttr('disabled');
		$('[data-section="related"]').fadeIn();
	} else {
		$('[data-section="related"]').find('input, textarea').attr('disabled','disabled');
		$('[data-section="related"]').hide();
	}
});

$('#related').trigger('change');