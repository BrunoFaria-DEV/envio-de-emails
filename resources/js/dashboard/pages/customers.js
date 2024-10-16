$(document).on('change', '#type', function(e) {
	let type = $(this).val();
	if(type == 0) {
		$('[data-section="pf"]').find('input, select, textarea').removeAttr('disabled');
		$('[data-section="pf"]').fadeIn();
		$('[data-section="pj"]').find('input, select, textarea').attr('disabled','disabled');
		$('[data-section="pj"]').hide();
	} else {
		$('[data-section="pj"]').find('input, select, textarea').removeAttr('disabled');
		$('[data-section="pj"]').fadeIn();
		$('[data-section="pf"]').find('input, select, textarea').attr('disabled','disabled');
		$('[data-section="pf"]').hide();
	}
});

$('#type').trigger('change');