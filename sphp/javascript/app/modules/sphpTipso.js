/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 *
 * Requires <a href="http://jquery.com/">jQuery (1.8.2)+</a> 
 */

(function ($) {
  'use strict';

  /**
   * Implements switchBoard functionality
   *
   * @memberOf jQuery.fn#
   * @method   switchBoard
   * @returns  {jQuery.fn} object for method chaining
   */
  $.fn.sphpTipso = function () {
    console.log('tipso initializing...');
    return this.each(function () {
      var $this = $(this);
      console.log('tipso initialized');
      $this.tipso({
        background: '#33312b',
        titleBackground: '#111',
        color: '#fff0c4',
        titleColor: '#FAA523',
        width: 'auto',
        size: 'small'
      });
    });
  };
  /**
   * Implements switchBoard functionality
   *
   * @memberOf jQuery.fn#
   * @method   switchBoard
   * @returns  {jQuery.fn} object for method chaining
   */
  $.fn.phpInfoTipso = function () {
    console.log('tipso initializing...');
    return this.each(function () {
      var $this = $(this), 
      $version = '<strong>PHP</strong> <var>' + $this.attr('data-version') + '</var>', 
      $mem = $this.attr('data-mem'),
      $time = $this.attr('data-time'),
      $titleContent = $($version),
      $content = $('<strong>Execution time:</strong> <var>' + $time + ' s</var><br><strong>Peak memory:</strong> <var>' + $mem + ' MB</var>');
      
      console.log('tipso initialized');
      $this.tipso({
        background: '#33312b',
        titleBackground: '#111',
        color: '#fff0c4',
        titleColor: '#FAA523',
        titleContent      : $titleContent,   
        //contentElementId: 'php-info-tipso-content',
        //titleContent      : $titleContent,     
        content           : $content,
        width: 'auto',
        size: 'small'
        
      });
    });
  };
}(jQuery));
