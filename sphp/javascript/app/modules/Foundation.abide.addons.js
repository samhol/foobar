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
    Foundation.Abide.defaults.patterns['phone'] = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im;


  };

}(window.sphp = window.sphp || {}, jQuery));

