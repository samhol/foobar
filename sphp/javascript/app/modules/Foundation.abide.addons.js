/**
 * 
 * @param {namespace} sphp
 * @param {type} $
 * @param {undefined} undefined
 * @returns {undefined}
 */
(function (sphp, $, undefined) {

  'use strict';

  sphp.setFoundationAbideAddons = function () {
    Foundation.Abide.defaults.patterns['phone'] = /^(\(?\+?[0-9]*\)?)?[0-9_\- \(\)]*$/;


  };

}(window.sphp = window.sphp || {}, jQuery));

