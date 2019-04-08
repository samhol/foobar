<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('../settings.php');

use Sphp\Samiholck\Contact\Controller;
use Sphp\Network\Headers\Location;
use Sphp\Stdlib\Datastructures\DataObject;
use Sphp\Stdlib\Parsers\Parser;

$config = DataObject::fromArray(Parser::fromFile('samiholck/config/private/contact-form.yml'));
$controller = new Controller($config);

$controller->process();

(new Location('http://foobar.samiholck.com/contact'))->execute();
