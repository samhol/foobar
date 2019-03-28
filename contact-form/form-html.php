<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('../samiholck/settings.php');

use Sphp\Html\Foundation\Sites\Forms\GridForm;
use Sphp\Security\CRSFToken;
use Sphp\Security\ReCaptcha;
use Sphp\Html\Foundation\Sites\Forms\Inputs\InputColumn;
use Sphp\Html\Foundation\Sites\Buttons\ButtonGroup;
use Sphp\Html\Media\Icons\FontAwesome;

$newToken = CRSFToken::instance()->generateToken('contact-form');

$form = (new GridForm())
        ->addCssClass('contact-form')
        ->setMethod('post')
        ->useValidation()
        ->setFormErrorMessage(FontAwesome::ban() . ' There are errors in your submission')
        ->setAction('contact-form/send.php');
// ->validateOnBlur()
// ->liveValidate();
$form->attributes()->setIdentifier('id', 'submit-form');

$form->appendHiddenVariable('contact-form', $newToken);

$fnameField = InputColumn::text('name')
        ->setLabel('Name')
        ->setPlaceholder('your name');
$form->append($fnameField);
$emailField = InputColumn::email('email')
        //->setSubmitValue('sami.holck@gmail.com')
        ->setRequired()
        ->setErrorField('You need to give your Email address')
        ->setLabel('Email address')
        ->setPlaceholder('Email address');
$form->append($emailField);

$subjectField = InputColumn::text('subject')
        //->setSubmitValue('sami.holck@gmail.com')
        ->setRequired()
        ->setErrorField('You need to set a subject')
        ->setLabel('Message subject')
        ->setPlaceholder('subject');
$form->append($subjectField);

$messageField = InputColumn::textarea('message', null, 5)
        //->setSubmitValue(' df')
        ->setLabel('Contact message')
        ->setRequired()
        ->setPlaceholder('Message text')
        ->setErrorField('You need to write a message');
$form->append($messageField);
$reCaptcha = ReCaptcha::createObject('6Lfh6U4UAAAAADLo3tCgAn27Zqam37ZsOBx41yt-');
$form->append($reCaptcha);
$form->append('<hr>');

$bGroup = new ButtonGroup;
$bGroup->appendSubmitter(FontAwesome::envelope() . ' Submit form')->setColor('success');
$bGroup->appendResetter(FontAwesome::eraser() . ' Reset form')->setColor('alert');
$row = new Sphp\Html\Foundation\Sites\Grids\Row();
$row->append($bGroup)->addCssClass('text-center');
$form->append($row);

$form->setAttribute('data-validators', 'capV.setValid');
echo $form . ReCaptcha::createScripts();
