import SwalAlert from 'sweetalert2';

$(document).on('change', '#newaccount', function(e) {
  let related = $(this).val();
  if(related == 'true') {
    $('[data-section="newaccount"]').find('input, textarea').removeAttr('disabled');
    $('[data-section="newaccount"]').fadeIn();
    $('[data-section="oldaccount"]').find('input, textarea').attr('disabled', 'disabled');
		$('[data-section="oldaccount"]').hide();
  } else {
    $('[data-section="oldaccount"]').find('input, textarea').removeAttr('disabled');
    $('[data-section="oldaccount"]').fadeIn();
    $('[data-section="newaccount"]').find('input, textarea').attr('disabled', 'disabled');
    $('[data-section="newaccount"]').hide();
  }
});
$('#newaccount').trigger('change');

$(document).on('change', '#related', function(e) {
  let related = $(this).val();
  if(related == 'true') {
    $('[data-section="related"]').fadeIn();
  } else {
    $('[data-section="related"]').hide();
  }
});
$('#related').trigger('change');

$(document).on('change', '#shipping_type', function(e) {
  let related = $(this).val();
  if(related == 'I') {
    $('[data-section="shipping_date"]').find('input').attr('disabled', 'disabled');
    $('[data-section="shipping_date"]').hide();
  } else {
    $('[data-section="shipping_date"]').find('input').removeAttr('disabled');
    $('[data-section="shipping_date"]').fadeIn();
  }
});
$('#shipping_type').trigger('change');

$(document).on('submit', function() {
  let file = $('#file').val();
	if (file == '') {
    SwalAlert.fire({
      title: 'Informação',
      text: 'O campo Arquivo é obrigatório.',
      icon: 'warning',
            confirmButtonText: 'Ok'
    });
    $('button[type="submit"]').removeAttr('disabled');
    return false;
  }

  let newAccount = $('#newaccount').val();
  let related = $('#related').val();
  let customerId = $('#customer_id').val();
  let customerAccountId = $('#customer_account_id').val();
  let shippingType = $('#shipping_type').val();

  if (newAccount == '') {
    SwalAlert.fire({
      title: 'Informação',
      text: 'O campo Criar Nova Conta é obrigatório.',
      icon: 'warning',
            confirmButtonText: 'Ok'
    });
    $('button[type="submit"]').removeAttr('disabled');
    return false
  }

  if (shippingType == '') {
    SwalAlert.fire({
      title: 'Informação',
      text: 'O campo Tipo de Disparo é obrigatório.',
      icon: 'warning',
            confirmButtonText: 'Ok'
    });
    $('button[type="submit"]').removeAttr('disabled');
    return false
  }

  if (newAccount == 'true') {
    if (related == '') {
      SwalAlert.fire({
        title: 'Informação',
        text: 'É necessário selecionar uma opção no campo (Vincular conta).',
        icon: 'warning',
              confirmButtonText: 'Ok'
      });
      $('button[type="submit"]').removeAttr('disabled');
      return false
    }
    if(related == 'true'){
      if (customerId == '') {
        SwalAlert.fire({
          title: 'Informação',
          text: 'É necessário selecionar um Cliente quando o campo (Vincular conta) está selecionado.',
          icon: 'warning',
                confirmButtonText: 'Ok'
        });
        $('button[type="submit"]').removeAttr('disabled');
        return false
      }
    }
  }

  if (newAccount == 'false') {
    if (customerAccountId == '') {
      SwalAlert.fire({
        title: 'Informação',
        text: 'A conta de disparo é obrigatória.',
        icon: 'warning',
              confirmButtonText: 'Ok'
      });
      $('button[type="submit"]').removeAttr('disabled');
      return false
    }
  }
});
