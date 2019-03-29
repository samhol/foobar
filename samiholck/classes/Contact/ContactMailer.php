<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Samiholck\Contact;

use Sphp\Data\ContactMessage;

/**
 * 
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class ContactMailer {

  /**
   * @var string 
   */
  private $sender;

  /**
   * @var string 
   */
  private $receiver;

  /**
   * @var Mailer 
   */
  private $mailer;

  /**
   * Constructs a new instance
   * 
   * @param string $receiver
   */
  public function __construct(string $sender, string $receiver) {
    $this->sender = $sender;
    $this->receiver = $receiver;
    $this->mailer = new Mailer();
  }

  /**
   * 
   * @param  ContactMessage $data
   * @return $this for a fluent interface
   */
  public function sendMessage(ContactData $data) {
    $this->mailer
            ->setFrom($this->sender)
            ->setTo($this->receiver)
            ->setSubject($data->getSubject())
            ->setBody($this->createMailBody($data))
            ->send();
    return $this;
  }

  /**
   * 
   * @param  ContactData $data
   * @return $this for a fluent interface
   */
  protected function replyTo(ContactData $data) {
    $this->getMessage()->setFrom($this->sender);
    $this->getMessage()->addTo($data->getEmail());
    $this->getMessage()->setSubject("Thank you for your message");
    $this->getMessage()->setBody('I will get back to you as soon as possible');
    $this->getMessage()->setEncoding('UTF-8');
    $this->send();
    return $this;
  }

  /**
   * 
   * @param  ContactMessage $data
   * @return string mail body as a string
   */
  protected function createMailBody(ContactData $data): string {
    $mailBody = "Message:\n";
    $mailBody .= $data->getMessage();
    $mailBody .= $this->createContacterData($data);
    return $mailBody;
  }

  protected function createContacterData(ContactData $data): string {
    $output = '';
    $output .= "\n\n----------------------\n";
    $output .= "Contacter:\n";
    if (!empty($data->getName())) {
      $output .= "\n" . $data->getName();
    }
    $output .= "\nemail:   " . $data->getEmail();
    $output .= "\nphone:   " . $data->getPhonenumber();
    $output .= "\n----------------------\n";
    return $output;
  }

}
