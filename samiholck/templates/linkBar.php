<?php

use Sphp\Html\Foundation\Sites\Buttons\ButtonGroup;
use Sphp\Stdlib\Parsers\Parser;
use Sphp\Network\URL;
use Sphp\Stdlib\Strings;

$links = Parser::fromFile('samiholck/config/linkBar.yml');
$linkBar = new ButtonGroup();
$linkBar->addCssClass('sphp', 'linkbar');
$url = URL::getCurrent();

foreach ($links as $link) {
  if ($url->getPath() === $link['href'] ||
          $link['href'] === '/calendar' &&
          Strings::startsWith($url->getPath(), $link['href'])) {
    $hyperLink = $linkBar->appendButton(new Sphp\Html\Span($link['text']));
    $hyperLink->addCssClass('disabled');
  } else {
    $hyperLink = $linkBar->appendHyperlink($link['href'], $link['text']);
    //$hyperLink->setAttribute('data-sphp-tipso')->setAttribute('data-tipso', $link['data-tipso'])->setAttribute('data-tipso-title', $link['data-tipso-title'])->setAttribute('title', 'foobar');
  }
}

echo "<hr>$linkBar";
