<?php

use Sphp\Html\Foundation\Sites\Buttons\ButtonGroup;
use Sphp\Stdlib\Parsers\Parser;
use Sphp\Network\URL;
use Sphp\Html\Media\Icons\FA;

$links = Parser::fromFile('samiholck/config/linkBar.yml');
$linkBar = new ButtonGroup();
$url = URL::getCurrent();

foreach ($links as $link) {
  $text = FA::get($link['icon']) . ' ' . $link['text'];
  $hyperLink = $linkBar->appendHyperlink($link['href'], $text);
  //var_dump($url->getPath(),$link['href']);
  if ($url->getPath() === $link['href']) {
    $hyperLink->addCssClass('disabled');
  }
}

echo "<hr>$linkBar";
