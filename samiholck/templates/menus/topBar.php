<?php

namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Html\Foundation\Sites\Navigation\MenuBuilder;
use Sphp\Html\Foundation\Sites\Core\ThrowableCalloutBuilder;
use Sphp\Stdlib\Parsers\Parser;
use Sphp\Html\Media\Icons\IconButtons;
use Sphp\Html\Adapters\TipsoAdapter;

$menuData = Parser::fromFile('samiholck/config/topbar.yml');

try {

  $navi = new Bars\ResponsiveBar();

  $redirect = filter_input(INPUT_SERVER, 'REDIRECT_URL', FILTER_SANITIZE_URL);
  $leftDrop = ResponsiveMenu::drilldownDropdown('medium');
  $leftDrop->setOption('autoHeight', true);
  $builder = new MenuBuilder(new MenuLinkBuilder(trim($redirect, '/')));
  $builder->buildMenu($menuData, $leftDrop);
  $navi->topbar()->left()->append($leftDrop);



  $bi = new IconButtons();
  $bi->github('https://github.com/samhol/', 'Gihub repositories');
  $bi->facebook('https://www.facebook.com/sami.holck/', 'Facebook page');
  $bi->twitter('https://twitter.com/samiholck', 'Twitter page');
  $bi->addCssClass('smooth');

  $navi->titleBar()->right()->append($bi);

  $navi->printHtml();
} catch (\Exception $e) {
  echo ThrowableCalloutBuilder::build($e, true, true);
}
