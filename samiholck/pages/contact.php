
<?php

\Sphp\Manual\md('# Contact Form');


if (isset($_SESSION['contactFormResult'])) {
  echo "<pre>SESSION:\n";
  print_r($_SESSION['contactFormResult']);
  echo '</pre>';
}

use Sphp\Samiholck\Contact\Controller;
use Sphp\Stdlib\Datastructures\DataObject;
use Sphp\Stdlib\Parsers\Parser;

$config = DataObject::fromArray(Parser::fromFile('samiholck/config/private/contact-form.yml'));
$controller = new Controller($config);
$controller->doView();
echo "<hr>";
include 'samiholck/templates/contact-information.php';
