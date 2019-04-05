<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('../settings.php');

$controller = new \Sphp\Samiholck\Contact\Controller();

$controller->process();