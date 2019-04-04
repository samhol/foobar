<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Samiholck\Contact;

use Sphp\Security\CRSFToken;
use Sphp\Validators\FormValidator;
use Sphp\Validators\NotEmpty;
use Sphp\Samiholck\Contact\ContactMailer;
use Sphp\Samiholck\Contact\ContactData;
use Sphp\Security\ReCAPTCHAv3;
use Sphp\Network\Headers\Location;

/**
 * Implementation of Controller
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Controller {

  /**
   * @var ContactData 
   */
  private $data;

  /**
   * @var FormValidator 
   */
  private $validator;

  public function __construct() {
    $this->data = new ContactData;
    $this->validator = new FormValidator();
    $this->validator->setValidator('email', new Sphp\Validators\Email());
    $this->validator->setValidator('subject', new NotEmpty());
    $this->validator->setValidator('message', new NotEmpty());
  }

  public function __destruct() {
    unset($this->data);
  }

  protected function getData(): ContactData {
    return $this->data;
  }

  public function validateSubmissionData(): bool {
    $args = [
        'name' => FILTER_SANITIZE_STRING,
        'email' => FILTER_SANITIZE_STRING,
        'phone' => FILTER_SANITIZE_STRING,
        'subject' => FILTER_SANITIZE_STRING,
        'message' => FILTER_SANITIZE_STRING,
    ];
    $this->data->validMail = true;
    if (!$this->validator->isValid(filter_input_array(INPUT_POST, $args))) {
      $this->data->validMail = false;
      $this->data->mailErrors = new ContactData($this->validator->errorsToArray());
    }
    return $this->data->validMail;
  }

  public function verifySubmission() {

    $crsfToken = new CRSFToken();
    if (!$crsfToken->verifyPostToken('contact_token')) {
      $this->data->errors = 'Session failure!';
      $crsfToken->unsetToken('contact_token');
      (new Location('http://foobar.samiholck.com/contact'))->execute();
    } else if (!$validator->isValid($formData)) {
      $data->errors = 'Invalid Form input!';
    } else {
      try {
        $score = $reCaptchav3->getScoreFor('g-recaptcha-response');
        $data->humanScore = $score;
        if ($score > 0.5) {
          $mailer = new ContactMailer('contact_form@samiholck.com', 'sami.holck@samiholck.com');
          //$mailer->sendMessage($data);
          $data->submitted = true;
        }
      } catch (Sphp\Exceptions\InvalidStateException $ex) {
        $data->reCaptchav3Error = $ex->getMessage();
        $data->errors = $ex->getMessage();
      } catch (\Exception $ex) {
        $data->errors = $ex->getMessage();
      }
      $_SESSION['contactFornResult'] = $data;
    }
  }

  public  function process() {

    $formData = $this->getSubmissionData();
    $data = new ContactData($formData);
    $validator = new FormValidator();
    $validator->setValidator('email', new Sphp\Validators\Email());
    $validator->setValidator('subject', new NotEmpty());
    $validator->setValidator('message', new NotEmpty());

    $data->submitted = false;

    $reCaptchav3 = new ReCAPTCHAv3('6Ld3H5sUAAAAAInA__yPC_24WU7OouFxJ7rbWFc5', '6Ld3H5sUAAAAADkrvgsmzfmLtbzASKAjV4SXn3RG');
//$reCaptchav3->verify('6Ld3H5sUAAAAADkrvgsmzfmLtbzASKAjV4SXn3RG');

    $data->submitted = false;

    $crsfToken = new CRSFToken();
    if (!$crsfToken->verifyPostToken('contact_token')) {
      $data->errors = 'Session failure!';
      $crsfToken->unsetToken('contact_token');
      (new Location('http://foobar.samiholck.com/contact'))->execute();
    } else if (!$validator->isValid($formData)) {
      $data->errors = 'Invalid Form input!';
    } else {
      try {
        $score = $reCaptchav3->getScoreFor('g-recaptcha-response');
        $data->humanScore = $score;
        if ($score > 0.5) {
          $mailer = new ContactMailer('contact_form@samiholck.com', 'sami.holck@samiholck.com');
          //$mailer->sendMessage($data);
          $data->submitted = true;
        }
      } catch (Sphp\Exceptions\InvalidStateException $ex) {
        $data->reCaptchav3Error = $ex->getMessage();
        $data->errors = $ex->getMessage();
      } catch (\Exception $ex) {
        $data->errors = $ex->getMessage();
      }
      $_SESSION['contactFornResult'] = $data;
    }


    (new Location('http://foobar.samiholck.com/contact'))->execute();

  }

}
