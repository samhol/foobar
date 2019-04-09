<?php

namespace Sphp\Html\Foundation\Sites\Navigation;

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('samiholck/settings.php');

use Sphp\Html\Document;

$redirect = filter_input(INPUT_SERVER, 'REDIRECT_URL', FILTER_SANITIZE_URL);

$cacheSuffix = str_replace(['.', '/'], ['-', ''], $redirect) . "-cache";

//if ($outputCache->start("$cacheSuffix-head") === false) {
require_once('samiholck/templates/blocks/head.php');
//  $outputCache->end();
//}
?>
<?php
//if ($outputCache->start("$cacheSuffix-topbar") === false) {
include('samiholck/templates/logo-area.php');
include('samiholck/templates/menus/topBar.php');
//  $outputCache->end();
//}
?>
<div class="grid-container"> 
  <div class="grid-x">

    <div class="mainContent small-auto cell"> 
      <?php

      use Sphp\Network\URL;

//$man_cache = "$cacheSuffix-content";
      //if ($outputCache->start($man_cache) === false) {
      $router->execute(URL::getCurrentURL());
      //   $outputCache->end();
      // }
      ?>
    </div>
  </div>
</div>
<?php
//if ($outputCache->start('footer') === false) {
include('samiholck/templates/footer/footer.php');
include('samiholck/templates/backToTopButton.php');
//  $outputCache->end();
//}

use Sphp\Stdlib\StopWatch;
$mem = number_format(memory_get_usage(true) / 1048576, 2);
$time = number_format(StopWatch::getExecutionTime(), 2);
$phpScript = new \Sphp\Html\Scripts\ScriptCode();
$phpScript[] = "var php={version: '" . phpversion() . "'};";
$phpScript[] = "php.memory=" . $mem . ";";
$phpScript[] = "php.execTime=" . $time . ";";
Document::html()->scripts()->append($phpScript);
Document::html()->documentClose();
