window.contact = function(that, e) {
    e.preventDefault();
  
    $(that).find('[type="submit"]').html('<i class="fas fa-sync fa-spin fa-fw"></i>');
  
    const url = $(that).attr('action');
    const data = $(that).serialize();
  
    axios.post(url, data)
      .then(function (response) {
        $(that).find('[type="submit"]').html('Enviar');
        $(that).trigger('reset');
        notify(response.data.message, '#009999');
      }).catch(function (error) {
        $(that).find('[type="submit"]').html('Enviar');
        notify(error.response.data, '#cc3300');
        grecaptcha.reset();
      });
}