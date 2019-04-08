<?php



echo '<pre>';
$mailer = new \Sphp\Samiholck\Contact\Mailer();
$mailer->setFrom('contact_form@samiholck.com')
            ->addTo('sami.holck@samiholck.com')
            ->setSubject('foo')->setSubject('**Contacter:**');
echo '</pre>';

