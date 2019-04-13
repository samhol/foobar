<?php
\Sphp\Manual\md('# Contact Information');
?>

<div class="grid-container full">
  <div class="grid-x grid-margin-x">
    <div class="cell small-12 large-6">
      <h2>Contact form</h2>
      <?php

      use Sphp\Samiholck\Contact\Controller;
      use Sphp\Stdlib\Datastructures\DataObject;
      use Sphp\Stdlib\Parsers\Parser;

if (isset($_SESSION['contactFormResult'])) {
        /* echo "<pre>SESSION:\n";
          print_r($_SESSION['contactFormResult']);
          echo '</pre>'; */
      }

      $config = DataObject::fromArray(Parser::fromFile('samiholck/config/private/contact-form.yml'));
      $controller = new Controller($config);
      $controller->doView();
      ?>
    </div>
    <div class="cell small-12 large-6">
      <?php
      include 'samiholck/templates/contact/contact.php';
      include 'samiholck/templates/contact/social.php';
      ?>
    </div>
  </div>
</div>