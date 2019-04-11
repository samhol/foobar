<?php

use Sphp\Html\Foundation\Sites\Navigation\MenuBuilder;
use Sphp\Stdlib\Parsers\Parser;

$menuData = Parser::fromFile('samiholck/config/topbar.yml');
echo '<pre>';
print_r($menuData);
echo '</pre>';
$menuBuilder = new MenuBuilder();
