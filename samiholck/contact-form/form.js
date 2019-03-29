
(function (sphp, $, undefined) {
  var $cont = $('#form-container'), abideForm, $form, $validForm = false;


  loadCaptcha = function () {
    grecaptcha.render('example3', {
      'sitekey': 'your_site_key',
      'callback': verifyCallback,
      'theme': 'dark'
    });
  };

  /**
   * 
   * @param   {jQuery.fn} $form object
   * @returns {undefined}
   */
  function trapSubmit($form) {
    $form = $cont.find('form');
    $form.submit(function (e) {
      e.preventDefault();
      //$form.foundation('validateForm');
      console.log('trapping contact form submission...');
      if ($validForm) {
        console.log('valid form fields...');
        postData($form);
      }
    });
  }

  /**
   * 
   * @param   {jQuery.fn} $form object
   * @returns {undefined}
   */
  function postData($form) {
    $.post($form.attr('action'), $form.serialize(), function (data) {
      console.log('posting contact form data to server...:');
      console.table(data);
      console.log(data);
      if (data.submitted === true) {
        console.log('contact form data submitted successfully');
        $form.trigger('reset');
        //grecaptcha.reset();
        createPopup('Form submitted succesfully', 'Thank you for contacting me');
      } else {
        errorHanding(data);
      }
      grecaptcha.reset();
    });
  }

  /**
   * 
   * @param   {string} $heading
   * @param   {string} $content
   * @param   {Object} $options
   * @returns {undefined}
   */
  function createPopup($heading, $content, $options) {
    var $h2 = '<h2>' + $heading + '</h2>',
            $p = '<p>' + $content + '</p>';
    $cont.sphpPopup($h2 + $p, $options);
  }
  
  /**
   * 
   * @protected
   * @static
   * @param {Object} $data
   * @returns {undefined}
   */
  function errorHanding($data) {
    var $heading = 'Form was not submitted',
            $message = 'Unspecified error';
    console.log('contact form submission failed');
    if ($data.error === 'CRSF') {
      console.log('CRSF: Session expired?');
      $message = 'Session expired';
    } else if ($data.error === 'ROBOT') {
      console.log('reCAPTCHA failure');
      $message = 'Please Check reCAPTCHA';
    } else if ($data.error === 'FORM-DATA') {
      console.log('Invalid Form Values');
      $message = 'Please Check your input';
    }
    createPopup($heading, $message, {classes: 'error'});
  }
  /**
   * 
   * @public
   * @static
   * @param   {string} $url
   * @returns {undefined}
   */
  sphp.initContactForm = function ($url) {
    console.log("Loading contact form....");
    $(document).on("formvalid.zf.abide", function (ev, form) {
      console.log('Form fields are valid...');
      $validForm = true;
    }).on("forminvalid.zf.abide", function (ev, form) {
      console.log('Form fields are invalid...');
      $validForm = false;
    });
    $cont.load($url, function () {
      $form = $cont.find('form');
      abideForm = new Foundation.Abide($form);

      trapSubmit($form);
    });

  };
  sphp.initContactForm('http://www.samiholck.com/contact-form/form-html.php');
}(window.sphp = window.sphp || {}, jQuery));

