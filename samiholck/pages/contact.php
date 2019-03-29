
<?php

\Sphp\Manual\md('# Contact Form');

use Sphp\Html\Foundation\Sites\Forms\Inputs\ValidableInlineInput;
use Sphp\Html\Foundation\Sites\Forms\GridForm;
use Sphp\Html\Foundation\Sites\Grids\BasicRow;
use Sphp\Html\Foundation\Sites\Buttons\ButtonGroup;

$form = new GridForm();
$form->validation(true);
$form->setMethod('post');
$form->setAction('/samiholck/contact-form/process.php');

$email = ValidableInlineInput::text('email');
$email->setRequired(true);
$email->setLeftInlineLabel('<i class="fas fa-at"></i>');
$email->setLabel('Email address');
$email->setPlaceholder('somebody@email.com');
$email->setErrorMessage('Email address is required!');
$email->setRequired(true);

$fullname = ValidableInlineInput::text('name');
$fullname->setLeftInlineLabel('<i class="fa fa-user"></i>');
$fullname->setLabel('Name');
$fullname->setPlaceholder('Name or Company');


$phone = ValidableInlineInput::text('phone');
$phone->setLeftInlineLabel('<i class="fas fa-phone"></i>');
$phone->setLabel('Phone number');
$phone->setPlaceholder('+358 44 298 6738');
$phone->setRequired(true);


$message = ValidableInlineInput::textarea('message');
$message->setLabel('Message body');
$message->setPlaceholder('Message body . . .');
$message->setRows(6);
$message->setErrorMessage('A message is required');
$message->setRequired(true);
//$message->setLeftInlineLabel('<i class="fas fa-car"></i>');


$messageTitle = ValidableInlineInput::text('subject');
$messageTitle->setRequired(true);
$messageTitle->setLeftInlineLabel('<i class="fas fa-heading"></i>');
$messageTitle->setLabel('Message title');
$messageTitle->setPlaceholder('Message title');
$messageTitle->setErrorMessage('Message title is required');


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

$form->appendHiddenVariable('hidden1', 'I am hidden!');

$buttons = new ButtonGroup();
$buttons->appendSubmitter('<i class="fas fa-envelope"></i> Submit')->addCssClass('success');
$buttons->appendResetter('Reset form')->addCssClass('alert');
$buttons->setExtended();

$buttonRow = new BasicRow();
$buttonRow->appendCell($buttons);


$form->append($buttonRow);
$form->liveValidate();
echo $form;
echo '<pre>';
print_r($_SESSION);
echo '</pre>';