<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('../samiholck/settings.php');

use Sphp\Http\Headers\Headers;

// required header
$headers = new Headers();
$headers->allowOrigin('http://www.samiholck.com');
$headers->contentType('application/json; charset=UTF-8');
$headers->allowMethods('POST');
$headers->execute();

//header("Access-Control-Allow-Origin: http://www.samiholck.com");
//header("Content-Type: application/json; charset=UTF-8");
//unset($_SESSION['contact-form']);

use Sphp\Security\CRSFToken;
use Sphp\Config\Config;
use Sphp\Validators\FormValidator;
use Sphp\Validators\RequiredValueValidator;
use Sphp\Mail\ContactMailer;
use Sphp\Data\ContactMessage;
use Sphp\Security\ReCaptcha;
use Sphp\Data\Person;

$args = [
    'name' => FILTER_SANITIZE_STRING,
    'email' => FILTER_SANITIZE_STRING,
    'phone' => FILTER_SANITIZE_STRING,
    'subject' => FILTER_SANITIZE_STRING,
    'message' => FILTER_SANITIZE_STRING,
    'g-recaptcha-response' => FILTER_SANITIZE_STRING,
];
$vals = filter_input_array(INPUT_POST, $args);

$validator = new FormValidator();
$validator->set('email', new RequiredValueValidator());
$validator->set('subject', new RequiredValueValidator());
$validator->set('message', new RequiredValueValidator());

$response['submitted'] = false;
$response['raw_data'] = $vals;
if (!CRSFToken::instance()->verifyPostToken('contact-form')) {
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
}

echo json_encode($response);
//use Sphp\Stdlib\Parsers\Json;

//include 'contact-form/back-to-referer.php';
