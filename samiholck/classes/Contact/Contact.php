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

/**
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Contact implements Arrayable {

  /**
   * @var string
   */
  private $contacter;

  /**
   * @var string
   */
  private $phone;

  /**
   * @var string
   */
  private $email;

  /**
   * @var string
   */
  private $message;

  /**
   * @var string
   */
  private $subject;

  public function getContacter(): ?string {
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

  public function getEmail(): ?string {
    return $this->email;
  }

  public function getMessage(): ?string {
    return $this->message;
  }

  public function getSubject(): ?string {
    return $this->subject;
  }

  public function setEmail(string $contacterMail) {
    $this->email = $contacterMail;
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

  public function toArray(): array {
    return get_object_vars($this);
  }

}
