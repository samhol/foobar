<?php

use Sphp\Samiholck\Contact\ContactData;

$data = new ContactData();
echo '<pre>';
var_dump($data);
var_dump($data->email, isset($data->email));
$data->email = 'foo@bar.fo';
var_dump($data->email, isset($data->email));
echo '</pre>';
