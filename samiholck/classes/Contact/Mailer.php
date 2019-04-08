<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Samiholck\Contact;

use Zend\Mail\Transport\Sendmail;
use Zend\Mail\Message;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Mime;
use Zend\Mime\Part as MimePart;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Stdlib\Parsers\Parser;
use ReflectionClass;

/**
 * Implement a multipart message mailer
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Mailer {

  const TEXT_BODY = Mime::TYPE_TEXT;
  const HTML_BODY = Mime::TYPE_HTML;

  /**
   * @var Message 
   */
  private $message;

  /**
   * @var Sendmail 
   */
  private $sendMail;
  private $htmlBody;
  private $textBody;

  /**
   * @var ReflectionClass
   */
  private $inputReflector;

  /**
   * Constructs a new instance
   * 
   * @param Message $message
   * @param Sendmail $sendMail
   */
  public function __construct(Message $message = null, Sendmail $sendMail = null) {
    if ($message === null) {
      $message = new Message();
    }
    $this->message = $message;
    if ($sendMail === null) {
      $sendMail = new Sendmail();
    }
    $this->sendMail = $sendMail;
    $this->htmlBody = new MimePart();
    $this->htmlBody->type = Mime::TYPE_HTML;
    $this->htmlBody->charset = 'utf-8';
    $this->htmlBody->encoding = Mime::ENCODING_QUOTEDPRINTABLE;

    $this->textBody = new MimePart();
    $this->textBody->type = Mime::TYPE_TEXT;
    $this->textBody->charset = 'utf-8';
    $this->textBody->encoding = Mime::ENCODING_QUOTEDPRINTABLE;
  }

  public function __destruct() {
    unset($this->message, $this->sendMail);
  }

  /**
   * Returns message object
   * 
   * @return Message
   */
  public function getMesssage(): Message {
    return $this->message;
  }

  /**
   * 
   * @return Sendmail
   */
  public function getSendMail(): Sendmail {
    return $this->sendMail;
  }

  /**
   * Invokes the given public Input object method
   * 
   * @param  string $name the name of the called method
   * @param  array $arguments
   * @return mixed
   * @throws BadMethodCallException if the public method does not exixt
   */
  public function __call(string $name, array $arguments) {
    if ($this->inputReflector === null) {
      $this->inputReflector = new \ReflectionClass($this);
    }
    $ref = ReflectionClass($this);
    if (!$ref->hasMethod($name)) {
      $inputType = get_class($this->message);
      throw new BadMethodCallException("Method $name is not defined for '$inputType' object");
    }

    $methodRef = $ref->getMethod($name);
    $result = $methodRef->invokeArgs($this->message, $arguments);
    if ($result === $this->message) {
      return $this;
    } else {
      return $result;
    }
  }

  /**
   * 
   * @return $this for a fluent interface
   */
  public function send() {
    $this->message->setBody($this->createMailBody());
    $contentTypeHeader = $this->message->getHeaders()->get('Content-Type');
    $contentTypeHeader->setType('multipart/alternative');
    if (!$this->message->isValid()) {
      throw new InvalidArgumentException('Invalid contact data');
    }
    $this->sendMail->send($this->message);
    return $this;
  }

  protected function createMailBody(): MimeMessage {
    $body = new MimeMessage();
    $body->setParts([$this->textBody, $this->htmlBody]);
    return $body;
  }

  /**
   * 
   * @param  string $text
   * @return $this
   */
  public function setTextBody(string $text) {
    $this->textBody->setContent($text);
    return $this;
  }

  /**
   * 
   * @param  Contact $data
   * @return $this
   */
  public function setHtmlBodyFromMarkdown(string $data) {
    $parsed = "<html><body>" . Parser::fromString($data, 'md') . "</body></html>";
    $this->htmlBody->setContent($parsed);
    return $this;
  }

}
