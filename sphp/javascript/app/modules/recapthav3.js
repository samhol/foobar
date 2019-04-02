
(function (sphp, $, undefined) {


  sphp.initReCAPTCHAv3sForm = function () {
    $('#contact_form').submit(function () {
      console.log("#contact_form submitted");
    });
    console.log("run initReCAPTCHAv3sForm");
    grecaptcha.ready(function () {
      $('form[data-sphp-grecaptcha-v3]').each(function () {
        var $form = $(this), $formId = $form.attr('id'), $clientId = $form.attr('data-sphp-grecaptcha-v3-clientId');
        grecaptcha.execute($clientId, {action: $formId}).then(function (token) {

          console.log("insert hidden input to #contact_form");
          $form.prepend('<input type="hidden" name="g-recaptcha-response" value="' + token + '">');
        });
      });
    });
  };


  /**
   * 
   * @public
   * @static
   * @param   {string} $url
   * @returns {undefined}
   */
  sphp.initReCAPTCHAv3s = function () {
    console.log("run initReCAPTCHAv3s");
    $('form[data-sphp-grecaptcha-v3]').each(function () {
      var $form = $(this), $formId = $form.attr('id'), $clientId = $form.attr('data-sphp-grecaptcha-v3-clientId');
      console.log("Using clientid: " + $clientId);
      grecaptcha.ready(function () {
        console.log("execute grecaptcha for: " + $form.attr('id'));
        grecaptcha.execute($clientId, {action: $formId}).then(function (token) {
          $form.prepend('<input type="hidden" name="g-recaptcha-response" value="' + token + '">');
        })
      });
    });
  };

}(window.sphp = window.sphp || {}, jQuery));

