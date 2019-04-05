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

/**
 * Description of ContactDataMailer
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ContactDataMailer {

  /**
   * @var string 
   */
  private $sender;

  /**
   * @var string 
   */
  private $receiver;

  /**
   * @var Sendmail 
   */
  private $mailer;

  /**
   * Constructs a new instance
   * 
   * @param string $receiver
   */
  public function __construct(string $autoSender, string $receiver) {
    $this->sender = $autoSender;
    $this->receiver = $receiver;
    $this->mailer = new Sendmail();
  }

  public function __destruct() {
    unset($this->mailer);
  }

  /**
   * 
   * @param  Contact $data
   * @return $this for a fluent interface
   */
  public function sendMessage(Contact $data) {
    $message = new Message();
    $message->setFrom($this->sender)
            ->addTo($this->receiver)
            ->setSubject($data->getSubject())
            ->setBody($this->createMailBody($data));
    $contentTypeHeader = $message->getHeaders()->get('Content-Type');
    $contentTypeHeader->setType('multipart/alternative');
    if (!$message->isValid()) {
      throw new InvalidArgumentException('Invalid contact data');
    }
    $this->mailer->send($message);
    return $this;
  }

  /**
   * 
   * @param  Contact $data
   * @return $this for a fluent interface
   */
  public function replyTo(Contact $data) {
    $this->getMessage()->setFrom($this->sender);
    $this->getMessage()->addTo($data->getReceiver());
    $this->getMessage()->setSubject("Thank you for your message");
    $this->getMessage()->setBody('I <strong>will get back to you as soon as possible</strong>');
    $this->getMessage()->setEncoding('UTF-8');
    $this->send();
    return $this;
  }

  protected function createMailBody(Contact $data): MimeMessage {
    $body = new MimeMessage();
    $body->setParts([$this->createMailBodyText($data), $this->createMailBodyHtml($data)]);
    return $body;
  }

  /**
   * 
   * @param  Contact $data
   * @return MimePart mail body as plain text
   */
  protected function createMailBodyText(Contact $data): MimePart {
    $text = $data->getMessage();
    $text .= "\n__________________\n";
    $text .= "Contacter:\n";
    if (!empty($data->getContacter())) {
      $text .= "\n  " . $data->getContacter();
    }
    $text .= "\n  email: " . $data->getEmail();
    if (!empty($data->getPhone())) {
      $text .= "\n  phone: " . $data->getPhone();
    }
    $mime = new MimePart($text);
    $mime->type = Mime::TYPE_TEXT;
    $mime->charset = 'utf-8';
    $mime->encoding = Mime::ENCODING_QUOTEDPRINTABLE;
    return $mime;
  }

  /**
   * 
   * @param  Contact $data
   * @return MimePart mail body as HTML
   */
  protected function createMailBodyHtml(Contact $data): MimePart {
    $raw = $data->getMessage();
    $raw .= "\n---";
    $raw .= "**Contacter:**\n";
    if (!empty($data->getContacter())) {
      $raw .= "\n * " . $data->getContacter();
    }
    $raw .= "\n * email: " . $data->getEmail();
    if (!empty($data->getPhone())) {
      $raw .= "\n * phone: " . $data->getPhone();
    }
    $parsed = "<html><body>" . Parser::fromString($raw, 'md') . "</body></html>";
    $html = new MimePart($parsed);
    $html->type = Mime::TYPE_HTML;
    $html->charset = 'utf-8';
    $html->encoding = Mime::ENCODING_QUOTEDPRINTABLE;
    return $html;
  }

}
