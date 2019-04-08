<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */


namespace Sphp\Samiholck\Contact;

use Sphp\Html\AbstractContent;
use Sphp\Html\Foundation\Sites\Forms\Inputs\ValidableInlineInput;
use Sphp\Html\Foundation\Sites\Forms\GridForm;
use Sphp\Html\Foundation\Sites\Grids\BasicRow;
use Sphp\Html\Foundation\Sites\Buttons\ButtonGroup;
use Sphp\Security\ReCAPTCHAv3;
use Sphp\Html\Foundation\Sites\Containers\ContentCallout;
use Sphp\Html\Foundation\Sites\Grids\DivGrid;
use Sphp\Html\Foundation\Sites\Grids\ContainerCell;

/**
 * Description of View
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class View {

  public function getResultView(ResultData $data) {
    $resultGrid = new DivGrid();
    $callout = new ContentCallout();
    $callout->setClosable(true);
    if ($data->isSubmitted()) {
      $callout->appendMd('## Thank you for your interest!');
      $callout->appendMd("I'll get back to you as soon as possible!");
    } else if (!$data->isValid()) {
      $callout->appendMd('## An error occured!');
      foreach (\Sphp\Stdlib\Arrays::flatten($data->getErrors()) as $error) {
        $callout->appendMd($error);
      }
      $callout->addCssClass('contact-form-error');
    }
    $resultGrid->append($callout);
    $cell = new ContainerCell();
    $resultGrid->append($cell);
    echo $resultGrid;
  }

  public function buildForm(Contact $initialData = null): GridForm {
    $required = true;
    $form = new GridForm();
    $form->useValidation(true);
    $form->setMethod('post');
    $form->setAction('/samiholck/contact-form/process.php');

    $email = ValidableInlineInput::text('email');
    $email->setLeftInlineLabel('<i class="fas fa-at"></i>');
    $email->setLabel('Email address');
    $email->setPlaceholder('somebody@email.com');
    $email->setErrorMessage('Email address is required and must be valid!');
    $email->setRequired($required);
    $email->setPattern('email');

    $name = ValidableInlineInput::text('name');
    $name->setLeftInlineLabel('<i class="fa fa-user"></i>');
    $name->setLabel('Name');
    $name->setPlaceholder('Name or Company');


    $nameRow = new BasicRow();
    $nameRow->appendCell($name)->small(12);
    $form->append($nameRow);

    $phone = ValidableInlineInput::text('phone');
    $phone->setLeftInlineLabel('<i class="fas fa-phone"></i>');
    $phone->setLabel('Phone number');
    $phone->setPlaceholder('+358 44 298 6738');
    $phone->setErrorMessage('Invalid Phone number given');
    $phone->setPattern('phone');


    $message = ValidableInlineInput::textarea('message');
    $message->setLabel('Message body');
    $message->setPlaceholder('Message body . . .');
    $message->setRows(6);
    $message->setErrorMessage('A message is required');
    $message->setRequired($required);


    $messageTitle = ValidableInlineInput::text('subject');
    $messageTitle->setLeftInlineLabel('<i class="fas fa-heading"></i>');
    $messageTitle->setLabel('Message title');
    $messageTitle->setPlaceholder('Message title');
    $messageTitle->setErrorMessage('Message title is required');
    $messageTitle->setRequired($required);



    $contactRow = new BasicRow();
    $contactRow->appendCell($email)->small(12)->medium(6);
    $contactRow->appendCell($phone)->small(12)->medium(6);
    $form->append($contactRow);


    $carRow = new BasicRow();
    $carRow->appendCell($messageTitle)->small(12);
    $carRow->appendCell($message)->small(12);
    $form->append($carRow);
    
    $buttons = new ButtonGroup();
    $buttons->appendPushButton('<i class="fas fa-envelope"></i> Submit')->addCssClass('success', 'submitter');
    $buttons->appendResetter('<i class="fas fa-undo-alt"></i> Reset')->addCssClass('alert');
    $buttons->addCssClass('text-center');

    $buttonRow = new BasicRow();
    $buttonRow->appendCell($buttons);
    $form->append($buttonRow);
    $form->liveValidate();
    return $form;
  }

}