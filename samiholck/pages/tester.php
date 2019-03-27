<?php

use Sphp\Mail\ContactMessage;
use Sphp\Mail\ContactMailer;
$data = [
    'subject' => 'Hello foo',
    'message' => 'Foo is foo-ish',
    'fname' => 'Sami',
    'lname' => 'Holck',
    'email' => 'sami.holck@gmail.com',
    'street' => 'Rakuunatie 59 A 3',
    'zipcode' => '20720',
    'city' => 'Turku',
    'country' => 'Finland',
    'phonenumber' => '+358 44 298 6738'
];
$message = new ContactMessage($data);
echo "<pre>";
print_r($message->toArray());
$mailer = new ContactMailer('sami.holck@samiholck.com', 'sami.holck@gmail.com');
echo $message->getSubject()."\nmessage:";
echo $mailer->createMailBody($message);
echo "</pre>";
?>



