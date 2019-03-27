<?php

namespace Sphp\Validators;

$validator = new FormValidator();
$validator->set('email', new RequiredValueValidator());
$validator->set('message', new RequiredValueValidator());
return $validator;
