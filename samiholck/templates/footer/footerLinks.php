<?php

use Sphp\Stdlib\Parsers\Parser;
use Sphp\Html\Foundation\Sites\Navigation\MenuBuilder;

$footerData = Parser::yaml()->readFromFile('/home/int48291/public_html/playground/manual/yaml/footer.yml');
/* echo '<pre>';
  print_r($footerData);
  echo "</pre>";
 */
$mb = new MenuBuilder();

include 'samiholck/templates/footer/linksForSmall.php';
include 'samiholck/templates/footer/linksForMediumUp.php';
