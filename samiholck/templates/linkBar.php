<?php

use Sphp\Html\Foundation\Sites\Buttons\ButtonGroup;
use Sphp\Stdlib\Parsers\Parser;
use Sphp\Network\URL;
use Sphp\Stdlib\Strings;

$links = Parser::fromFile('samiholck/config/linkBar.yml');
$linkBar = new ButtonGroup();
$url = URL::getCurrent();

foreach ($links as $link) {
  $hyperLink = $linkBar->appendHyperlink($link['href'], $link['text']);
  //var_dump($url->getPath(),$link['href']);
  if ($url->getPath() === $link['href'] ||
          $link['href'] === '/calendar' &&
          Strings::startsWith($url->getPath(), $link['href'])) {

    $hyperLink->addCssClass('disabled');
  }
}

echo "<hr>$linkBar";
