<?php

use Sphp\Html\Adapters\TipsoAdapter;

$tipso = new TipsoAdapter(new Sphp\Html\Span('tipso'));
$tipso['titleContent'] = 'title';
$tipso['content'] = 'content';

$tipso->printHtml();
//$tipso->setTitle(null);
$tipso['content'] = null;

$tipso->printHtml();
