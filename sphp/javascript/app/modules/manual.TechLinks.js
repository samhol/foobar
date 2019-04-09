
/**
 * Contains sphp.TechLinks functionality
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @name manual
 * @namespace manual
 */
;
(function (manual, $, undefined) {
  "use strict";

  /**
   * 
   */
  manual.techLinksList = function () {
    //var $irs;
    console.log("manual.TechLinks() v2");
    $(".tech-links-list .jQuery").tipso({
      titleContent: 'jQuery',
      content: "version: " + $.fn.jquery
    });
    $(".tech-links-list .foundation").tipso({
      titleContent: 'Foundation for sites',
      content: "version: " + Foundation.version
    });
  };

}(window.manual = window.manual || {}, jQuery));
$(window).bind("load", function () {
  "use strict";
  manual.techLinksList();

});
