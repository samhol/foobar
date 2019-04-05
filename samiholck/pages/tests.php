<?php

use Sphp\Samiholck\Contact\Contact;
use Sphp\Samiholck\Contact\ContactDataMailer;

echo '<pre>';
$contact = new Contact;
$contact->setSubject('Lorem ipsum')
        ->setContacter('John Doe')
        ->setPhone('+298 44 2986738')
        ->setEmail('sami.holck@gmail.com')
        ->setMessage('Lorem ipsum dolor sit amet.');

$contacMailer = new ContactDataMailer('contact_form@samiholck.com', 'sami.holck@samiholck.com');
$contacMailer->sendMessage($contact);
echo '</pre>';

