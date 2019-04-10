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
use Sphp\Security\ReCAPTCHAv3;
use Sphp\Stdlib\Datastructures\DataObject;

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
   * @var ReCAPTCHAv3
   */
  private $reCaptchav3;

  /**
   * @var CRSFToken
   */
  private $crsfToken;

  /**
   * @var ResultData 
   */
  private $data;

  /**
   * @var DataObject
   */
  private $config;

  /**
   * @var FormValidator 
   */
  private $validator;

  /**
   * @var View
   */
  private $view;

  /**
   * @var ContactDataMailer
   */
  private $mailer;

  public function __construct(DataObject $config) {

    $this->config = $config;
    $this->mailer = new ContactDataMailer($this->config->contact_form_email, $this->config->to);
    $this->crsfToken = new CRSFToken();
    $this->reCaptchav3 = new ReCAPTCHAv3($this->config->reCAPTCHAv3->site_key, $this->config['reCAPTCHAv3']['secret']);
    $this->data = new ResultData;
    $this->view = new View;
    $this->validator = new FormValidator();
    $this->validator->setValidator('email', new Email('Email address is required and must be valid!'));
    $this->validator->setValidator('subject', new NotEmpty(NotEmpty::STRING_TYPE, 'A message subject is required'));
    $this->validator->setValidator('message', new NotEmpty(NotEmpty::STRING_TYPE, 'A message is required'));
  }

  public function __destruct() {
    unset($this->data);
  }

  public function getContactData() {
    $raw = $this->getRawMessage();
    if (!$this->validator->isValid($raw)) {
      $this->data->setErrors($this->validator->getInputErrors());
    }
    $contact = new Contact();
    $contact->setEmail($raw['email'])
            ->setContacter($raw['name'])
            ->setPhone($raw['phone'])
            ->setSubject($raw['subject'])
            ->setMessage($raw['message']);
    $this->data->setFormData($contact);
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
    if (!$this->crsfToken->verifyPostToken('contact_token')) {
      $this->data->addError('CRSFToken does not match!');
      $valid = false;
    }
    try {
      $score = $this->reCaptchav3->getScoreFor('g-recaptcha-response');
      $this->data->setHumanScore($score);
      if ($score <= 0.5) {
        $this->data->addError('Not human');
        $valid = false;
      }
    } catch (\Exception $ex) {
      $this->data->addError($ex->getMessage());
      $valid = false;
    }
    return $valid;
  }

  public function process(): void {
    if ($this->verifyTokens()) {
      $this->getContactData();
      if ($this->data->isValid()) {
        $this->mailer->sendMessage($this->data->getFormData());
        $this->data->setSubmitted(true);
      }
    }
    $_SESSION['contactFormResult'] = $this->data;
  }

  public function doView(): void {
    if (array_key_exists('contactFormResult', $_SESSION)) {
      $data = $_SESSION['contactFormResult'];
      if ($data instanceof ResultData) {
        echo $this->view->getResultView($data);
      }
      unset($_SESSION['contactFormResult']);
    }
    $form = $this->view->buildForm();
    $this->crsfToken->insertIntoForm($form, 'contact_token');
    $this->reCaptchav3->insertIntoForm($form, 'contact_form');
    echo $form;
  }

}
