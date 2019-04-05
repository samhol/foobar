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
use Sphp\Validators\Email;
use Sphp\Validators\NotEmpty;
use Sphp\Samiholck\Contact\ContactDataMailer;
use Sphp\Samiholck\Contact\ContactData;
use Sphp\Security\ReCAPTCHAv3;
use Sphp\Network\Headers\Location;
use Sphp\Stdlib\Datastructures\DataObject;
use Sphp\Stdlib\Parsers\Parser;

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
    $this->data = new DataObject();
    $this->validator = new FormValidator();
    $this->validator->setValidator('email', new Email());
    $this->validator->setValidator('subject', new NotEmpty());
    $this->validator->setValidator('message', new NotEmpty());
  }

  public function __destruct() {
    unset($this->data);
  }

  protected function getData(): ContactData {
    return $this->data;
  }

  public function getContactData() {
    $raw = $this->getRawMessage();
    $this->data->validMail = true;
    if (!$this->validator->isValid($raw)) {
      $this->data->validMail = false;
      $this->data->mailErrors = new ContactData($this->validator->errorsToArray());
    }
    $contact = new Contact();
    $contact->setEmail($raw['email'])
            ->setContacter($raw['name'])
            ->setPhone($raw['phone'])
            ->setSubject($raw['subject'])
            ->setMessage($raw['message']);
    return $contact;
  }

  public function getRawMessage(): array {
    $args = [
        'name' => FILTER_SANITIZE_STRING,
        'email' => FILTER_SANITIZE_STRING,
        'phone' => FILTER_SANITIZE_STRING,
        'subject' => FILTER_SANITIZE_STRING,
        'message' => FILTER_SANITIZE_STRING,
    ];
    return filter_input_array(INPUT_POST, $args);
  }

  public function verifyTokens(): bool {
    $valid = true;
    $conf = Parser::fromFile('samiholck/config/private/contact-form.yml');
    $reCaptchav3 = new ReCAPTCHAv3($conf['reCAPTCHAv3']['site_key'], $conf['reCAPTCHAv3']['secret']);
    $crsfToken = new CRSFToken();
    if (!$crsfToken->verifyPostToken('contact_token')) {
      $this->data->errors = 'Session failure!';
      $this->data->crsfToken = 'CRSFToken does not match!';
      $valid = false;
    }
    try {
      $score = $reCaptchav3->getScoreFor('g-recaptcha-response');
      $this->data->humanScore = $score;
      if ($score <= 0.5) {
        $this->data->submitted = true;
        $valid = false;
      }
    } catch (Sphp\Exceptions\InvalidStateException $ex) {
      $this->data->reCaptchav3Error = $ex->getMessage();
      $this->data->errors = $ex->getMessage();
      $valid = false;
    } catch (\Exception $ex) {
      $this->data->errors = $ex->getMessage();
      $valid = false;
    }
    return $valid;
  }

  public function process() {
    if (!$this->verifyTokens()) {
      $this->data->submitted = false;
    } else {
      $raw = $this->getRawMessage();
      $this->data->validMail = true;
      if ($this->validator->isValid($raw)) {
        $contact = new Contact();
        $contact->setEmail($raw['email'])
                ->setContacter($raw['name'])
                ->setPhone($raw['phone'])
                ->setSubject($raw['subject'])
                ->setMessage($raw['message']);
        $mailer = new ContactDataMailer('contact_form@samiholck.com', 'sami.holck@samiholck.com');
        $mailer->sendMessage($contact);
        $this->data->submitted = true;
        $this->data->mailErrors = new ContactData($this->validator->errorsToArray());
      } else {
        $this->data->submitted = false;
      }
    }
    $_SESSION['contactFornResult'] = $this->data;
    (new Location('http://foobar.samiholck.com/contact'))->execute();
  }

}
