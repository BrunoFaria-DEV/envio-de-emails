import '../bootstrap';
import './sidebar';

// ==============================================================
// Imports
// ==============================================================
import 'jquery-mask-plugin';
import 'pickadate-webpack/lib/compressed/picker';
import 'pickadate-webpack/lib/compressed/picker.date';
import 'pickadate-webpack/lib/compressed/picker.time';
import 'pickadate-webpack/lib/compressed/translations/pt_BR';
import '@selectize/selectize/dist/js/selectize';
import 'jquery-toast-plugin';
import Swal from 'sweetalert2';
window.Swal = Swal;
// import 'summernote/dist/summernote-lite';
// import 'summernote/dist/lang/summernote-pt-BR';

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

$(function () {
	init();

  // ==============================================================
  // Select2
  // ==============================================================
  $('.select2').each(function () {
    let options = {},
        placeholder = $(this).data('placeholder');

    if(placeholder)
      options['placeholder'] = placeholder;

    $(this).select2(options);
    $(this).select2({theme: "bootstrap-5"});
  });
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
  // Pickadate
  // ==============================================================
  $('.datepicker').each(function () {
    let options = {},
        format = $(this).data('format'),
        min = $(this).data('min');

    if(format)
      options['format'] = format;

    if(min)
      options['min'] = moment(min);

    $(this).pickadate(options);
  });

  $('.timepicker').each(function () {
    let options = {},
        format = $(this).data('format'),
        interval = $(this).data('interval');

    if(format)
      options['format'] = format;

    if(interval)
      options['interval'] = interval;

    $(this).pickatime(options);
  });

  // ==============================================================
  // Summernote
  // ==============================================================
  // $('.summernote').summernote({
  //   height: 200,
  //   lang: 'pt-BR',
  //   toolbar: [
  //     ['style', ['bold', 'italic', 'underline', 'clear']],
  //     ['font', ['strikethrough', 'superscript', 'subscript']],
  //     ['fontname', ['fontname']],
  //     ['fontsize', ['fontsize']],
  //     ['color', ['color']],
  //     ['para', ['ul', 'ol', 'paragraph']],
  //     ['table', ['table']],
  //     ['insert', ['picture', 'link', 'video']],
  //     ['misc', ['fullscreen', 'codeview', 'help']]
  //   ],
  //   callbacks: {
  //     onImageUpload: function(files) {
  //       sendFile(files[0]);
  //     },
  //     onPaste: function (e) {
  //       let bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
  //       e.preventDefault();
  //       // Firefox fix
  //       setTimeout(function () {
  //           document.execCommand('insertText', false, bufferText);
  //       }, 10);
  //     }
  //   }
  // });

  // $('.summernote-sm').summernote({
  //   height: 100,
  //   lang: 'pt-BR',
  //   toolbar: [
  //     ['style', ['bold', 'italic', 'underline', 'clear']]
  //   ]
  // });

  // ==============================================================
  // Disable submit button after first click
  // ==============================================================
  $('form').submit(function(e) {
    $(this).find('[type="submit"]').attr('disabled', true);
  });

  $('form [type="submit"]').removeAttr('disabled');
}

// Show register
$(document).on('click', '.show-item', function(e) {
  e.preventDefault();

  var url = $(this).data('url'),
      large = $(this).data('large'),
      title = $(this).data('title');

  if(large == true) {
    $('#modal-show').find('.modal-dialog').addClass('modal-lg');
  }

  $('#modal-show').find('.modal-title').html(title);
  $('#modal-show').find('.modal-body').html('<div class="p-4 text-center"><i class="fas fa-spinner fa-spin"></i></div>');

  $('#modal-show').find('.modal-body').load(url, function(responseTxt, statusTxt, xhr) {

  }).on('show.bs.modal', function (event) {

  });
});

// Show register
$(document).on('click', '.list-items', function(e) {
  e.preventDefault();

  var url = $(this).data('url'),
      large = $(this).data('large'),
      title = $(this).data('title');

  if(large == true) {
    $('#modal-list').find('.modal-dialog').addClass('modal-lg');
  }

  $('#modal-list').find('.modal-title').html(title);
  $('#modal-list').find('.modal-body').html('<div class="p-4 text-center"><i class="fas fa-spinner fa-spin"></i></div>');

  $('#modal-list').find('.modal-body').load(url, function(responseTxt, statusTxt, xhr) {

  }).on('show.bs.modal', function (event) {

  });
});

// Delete register
$(document).on('click', '.delete', function(e) {
  let url = $(this).data('url');

  $('#modal-delete').on('shown.bs.modal', function (event) {
    $(this).find('.modal-title').text('Apagar');
    $(this).find('.modal-body').html('<p class="text-center">Deseja realmente apagar este item?</p>');
    $(this).find('form').attr('action', url);
  });
});

// Banned Acount
$(document).on('click', '.banned', function(e) {
  let url = $(this).data('url');

  $('#modal-banned').on('shown.bs.modal', function (event) {
    $(this).find('.modal-title').text('Suspender');
    $(this).find('.modal-body').html('<p class="text-center">Deseja realmente Suspender este Usuário?</p>');
    $(this).find('form').attr('action', url);
  });
});

// Active Acount
$(document).on('click', '.active-acount', function(e) {
  let url = $(this).data('url');

  $('#modal-active-acount').on('shown.bs.modal', function (event) {
    $(this).find('.modal-title').text('Ativar');
    $(this).find('.modal-body').html('<p class="text-center">Deseja Ativar Esta Conta de Usuário?</p>');
    $(this).find('form').attr('action', url);
  });
});

// SHOW LIST EMAIL ERRORS
$(document).on('click', '.shipping-error', function(e) {
  e.preventDefault();

  var url = $(this).data('url'),
      title = $(this).data('title');

  $('#shipping-error').find('.modal-title').html(title);
  $('#shipping-error').find('.modal-body').html('<div class="p-4 text-center"><i class="fas fa-spinner fa-spin"></i></div>');

  $('#shipping-error').find('.modal-body').load(url, function(responseTxt, statusTxt, xhr) {

  }).on('show.bs.modal', function (event) {

  });
});

// Update status
window.updateStatus = function(that, e) {
  let url = $(that).attr('action'),
      data = $(that).serialize();

  $.ajax({
    url: url,
    type: 'POST',
    data: data,
    success: function(result) {
      notify(result.message, 'success');
    },
    error: function(xhr) {
      notify(xhr.responseText, 'error');
    }
  });
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
