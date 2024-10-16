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