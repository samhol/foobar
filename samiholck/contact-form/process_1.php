<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('../settings.php');

use Sphp\Network\Headers\Location;

$submitted = false;
/*
  // required header
  $headers = new Headers();
  $headers->allowOrigin('http://samiholck.com');
  $headers->contentType('application/json; charset=UTF-8');
  $headers->allowMethods('POST');
  $headers->execute();
 */

//header("Access-Control-Allow-Origin: http://www.samiholck.com");
//header("Content-Type: application/json; charset=UTF-8");
//unset($_SESSION['contact-form']);
use Sphp\Security\CRSFToken;
use Sphp\Validators\FormValidator;
use Sphp\Validators\NotEmpty;
use Sphp\Samiholck\Contact\ContactMailer;
use Sphp\Samiholck\Contact\ContactData;
use Sphp\Security\ReCAPTCHAv3;

$args = [
    'name' => FILTER_SANITIZE_STRING,
    'email' => FILTER_SANITIZE_STRING,
    'phone' => FILTER_SANITIZE_STRING,
    'subject' => FILTER_SANITIZE_STRING,
    'message' => FILTER_SANITIZE_STRING,
        //'contact_token' => FILTER_SANITIZE_STRING,
        //'g-recaptcha-response' => FILTER_SANITIZE_STRING,
];
$formData = filter_input_array(INPUT_POST, $args);
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
  }
  catch (\Exception $ex) {
    $data->errors = $ex->getMessage();
  }
  $_SESSION['contactFornResult'] = $data;
}
//$result['messageData'] = (object) $vals;
/* if (!CRSFToken::instance()->verifyPostToken('contact-form')) {
  //CRSFToken::instance()->unsetToken('contact-form');
  $response['error'] = 'CRSF';
  } else if (!ReCaptcha::isValid('6Lfh6U4UAAAAAADk_T1MpBhlLy72QTMES2z_I9QB')) {
  //CRSFToken::instance()->unsetToken('contact-form');
  $response['error'] = 'ROBOT';
  } else if (!$validator->isValid($vals)) {
  $response['error'] = 'FORM-DATA';
  } else {
  $data = new ContactMessage();
  $data->setSubject($vals['subject']);
  $data->setMessage($vals['message']);
  $data->setContacter(new Sphp\Data\Person($vals));
  //$mailer = new ContactMailer('sami.holck@samiholck.com', 'sami.holck@gmail.com');
  //$mailer->sendContactData($data);
  // $_SESSION['contact-form']['submitted'] = true;
  $response['submitted'] = true;
  //CRSFToken::instance()->unsetToken('contact-form');
  } */

//$_SESSION['contact-form']['submitted'] = true;

(new Location('http://foobar.samiholck.com/contact'))->execute();
//echo json_encode($response);
//use Sphp\Stdlib\Parsers\Json;

//include 'contact-form/back-to-referer.php';
