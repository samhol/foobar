
<?php

\Sphp\Manual\md('# Contact Form');

use Sphp\Html\Foundation\Sites\Forms\Inputs\ValidableInlineInput;
use Sphp\Html\Foundation\Sites\Forms\GridForm;
use Sphp\Html\Foundation\Sites\Grids\BasicRow;
use Sphp\Html\Foundation\Sites\Buttons\ButtonGroup;

$email = ValidableInlineInput::text('email');
$email->setRequired(true);
$email->setLeftInlineLabel('<i class="fas fa-envelope"></i>');
$email->setLabel('Email address');
$email->setPlaceholder('somebody@email.com');
$email->setErrorMessage('Email address is required!');
$email->setRequired(true);

$fullname = ValidableInlineInput::text('name');
//$fullname->setRequired(true);
$fullname->setLeftInlineLabel('<i class="fa fa-user"></i>');
$fullname->setLabel('Full name');
$fullname->setPlaceholder('Full Name');
//$fullname->setErrorMessage('First name is required!');
//$fullname->setRequired(true);

$lname = ValidableInlineInput::text('lname');
$lname->setRequired(true);
$lname->setLeftInlineLabel('<i class="fa fa-user"></i>');
$lname->setLabel('Last name');
$lname->setPlaceholder('Last name');
$lname->setErrorMessage('Last name is required!');
$lname->setRequired(true);

$message = ValidableInlineInput::textarea('message');
$message->setLabel('Message');
$message->setPlaceholder('Message body . . .');
$message->setRows(6);
$message->setErrorMessage('A message is required');
$message->setRequired(true);
//$message->setLeftInlineLabel('<i class="fas fa-car"></i>');


$messageTitle = ValidableInlineInput::text('title');
$messageTitle->setRequired(true);
$messageTitle->setLeftInlineLabel('<i class="fas fa-heading"></i>');
$messageTitle->setLabel('Message title');
$messageTitle->setPlaceholder('Message title');
$messageTitle->setErrorMessage('Message title is required');

$form = new GridForm();
$form->validation(true);

$nameRow = new BasicRow();
$nameRow->appendCell($email)->small(12)->medium(6);
$nameRow->appendCell($fullname)->small(12)->medium(6);
$form->append($nameRow);


$carRow = new BasicRow();
$carRow->appendCell($messageTitle)->small(12);
$carRow->appendCell($message)->small(12);
$form->append($carRow);

$form->appendHiddenVariable('hidden1', 'I am hidden!');

$buttonRow = new BasicRow();
$buttons = new ButtonGroup();
$buttons->appendSubmitter('Submit')->addCssClass('success');
$buttons->appendResetter('Reset form')->addCssClass('alert');
$buttons->setExtended();
$buttonRow->appendCell($buttons);
$form->append($buttonRow);
$form->liveValidate();
echo $form;

