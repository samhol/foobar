<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Samiholck\Contact;

use Sphp\Stdlib\Datastructures\Arrayable;
use ArrayAccess;
use IteratorAggregate;
use Countable;
use stdClass;

/**
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Contact {

  /**
   * @var string
   */
  private $contacter;
  
  private $phone;

  /**
   * @var string
   */
  private $middleMan;

  /**
   * @var string
   */
  private $contacterMail;

  /**
   * @var string
   */
  private $receiver;

  /**
   * @var string
   */
  private $message;

  /**
   * @var string
   */
  private $subject;

  /**
   * Constructs a new instance
   * 
   * @param array $data
   */
  public function __construct() {
    
  }

  public function getContacter() {
    return $this->contacter;
  }

  public function setContacter(string $contacter) {
    $this->contacter = $contacter;
    return $this;
  }
  public function getPhone(): ?string {
    return $this->phone;
  }

  public function setPhone(string $phone = null) {
    $this->phone = $phone;
    return $this;
  }

    public function getMiddleMan(): ?string {
    return $this->middleMan;
  }

  public function getContacterMail(): ?string {
    return $this->contacterMail;
  }

  public function getReceiver(): ?string {
    return $this->receiver;
  }

  public function getMessage(): ?string {
    return $this->message;
  }

  public function getSubject(): ?string {
    return $this->subject;
  }

  public function setMiddleMan(string $middleMan) {
    $this->middleMan = $middleMan;
    return $this;
  }

  public function setContacterMail(string $contacterMail) {
    $this->contacterMail = $contacterMail;
    return $this;
  }

  public function setReceiver(string $receiver) {
    $this->receiver = $receiver;
    return $this;
  }

  public function setMessage(string $message) {
    $this->message = $message;
    return $this;
  }

  public function setSubject(string $subject) {
    $this->subject = $subject;
    return $this;
  }

}
