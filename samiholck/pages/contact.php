
<?php

\Sphp\Manual\md('# Contact Form');

use Sphp\Html\Foundation\Sites\Forms\Inputs\ValidableInlineInput;
use Sphp\Html\Foundation\Sites\Forms\GridForm;
use Sphp\Html\Foundation\Sites\Grids\BasicRow;
use Sphp\Html\Foundation\Sites\Buttons\ButtonGroup;
use Sphp\Security\ReCAPTCHAv3;
use Sphp\Html\Foundation\Sites\Containers\ContentCallout;

/* echo "<pre>SESSION:\n";
  print_r($_SESSION);
  echo '</pre>'; */

if (isset($_SESSION['contactFornResult'])) {

  $resultGrid = new \Sphp\Html\Foundation\Sites\Grids\DivGrid();
  $callout = new ContentCallout();
  $callout->setClosable(true);
  $data = $_SESSION['contactFornResult'];
  $resV = new Sphp\Samiholck\Contact\ResultVisualizer($data);
  echo $resV->generate();
  echo "<pre>SESSION:\n";
  print_r($_SESSION['contactFornResult']);
  echo '</pre>';
}

unset($_SESSION['contactFornResult']);

$form = new GridForm();
$form->useValidation(true);
$form->setMethod('post');
$form->setAction('/samiholck/contact-form/process.php');

$email = ValidableInlineInput::text('email');
$email->setLeftInlineLabel('<i class="fas fa-at"></i>');
$email->setLabel('Email address');
$email->setPlaceholder('somebody@email.com');
$email->setErrorMessage('Email address is required and must be valid!');
$email->setRequired(true);
$email->setPattern('email');

$fullname = ValidableInlineInput::text('name');
$fullname->setLeftInlineLabel('<i class="fa fa-user"></i>');
$fullname->setLabel('Name');
$fullname->setPlaceholder('Name or Company');


$phone = ValidableInlineInput::text('phone');
$phone->setLeftInlineLabel('<i class="fas fa-phone"></i>');
$phone->setLabel('Phone number');
$phone->setPlaceholder('+358 44 298 6738');


$message = ValidableInlineInput::textarea('message');
$message->setLabel('Message body');
$message->setPlaceholder('Message body . . .');
$message->setRows(6);
$message->setErrorMessage('A message is required');
$message->setRequired(true);


$messageTitle = ValidableInlineInput::text('subject');
$messageTitle->setLeftInlineLabel('<i class="fas fa-heading"></i>');
$messageTitle->setLabel('Message title');
$messageTitle->setPlaceholder('Message title');
$messageTitle->setErrorMessage('Message title is required');
$messageTitle->setRequired(true);


$nameRow = new BasicRow();
$nameRow->appendCell($fullname)->small(12);
$form->append($nameRow);

$contactRow = new BasicRow();
$contactRow->appendCell($email)->small(12)->medium(6);
$contactRow->appendCell($phone)->small(12)->medium(6);
$form->append($contactRow);


$carRow = new BasicRow();
$carRow->appendCell($messageTitle)->small(12);
$carRow->appendCell($message)->small(12);
$form->append($carRow);
$crsfToken = new \Sphp\Security\CRSFToken();

$form->getHiddenInputs()->insertHiddenInput($crsfToken->generateTokenInput('contact_token'));
try {

  $reCaptcha = new ReCAPTCHAv3('6Ld3H5sUAAAAAInA__yPC_24WU7OouFxJ7rbWFc5', '6Ld3H5sUAAAAADkrvgsmzfmLtbzASKAjV4SXn3RG');
  $reCaptcha->insertIntoForm($form, 'contact_form');
} catch (\Exception $ex) {
  echo $ex;
}

$buttons = new ButtonGroup();
$buttons->appendPushButton('<i class="fas fa-envelope"></i> Submit')->addCssClass('success', 'submitter');
$buttons->appendResetter('<i class="fas fa-undo-alt"></i> Reset')->addCssClass('alert');
$buttons->addCssClass('text-center');

$buttonRow = new BasicRow();
$buttonRow->appendCell($buttons);


$form->append($buttonRow);
//$form->liveValidate();

echo "$form<hr>";
include 'samiholck/templates/contact-information.php';
