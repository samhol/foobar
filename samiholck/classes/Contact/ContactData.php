<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Samiholck\Contact;

/**
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class ContactData {

  /**
   * @var mixed 
   */
  private $name;

  /**
   * @var mixed 
   */
  private $email;

  /**
   * @var mixed 
   */
  private $phone;

  /**
   * @var Person 
   */
  private $contacter;

  /**
   * @var mixed 
   */
  private $subject;

  /**
   * @var mixed 
   */
  private $message;

  /**
   * Constructs a new instance
   * 
   * @param array $data
   */
  public function __construct(array $data) {
    foreach ($data as $k => $v) {
      $this->{$k} = $v;
    }
    $this->contacter = new \Sphp\Data\Person($data);
  }

  /**
   * 
   * @return mixed
   */
  public function getName(): ?string {
    return $this->name;
  }

  /**
   * 
   * @return mixed
   */
  public function getEmail() {
    return $this->email;
  }

  /**
   * 
   * @return boolean
   */
  public function hasPhoneNumber(): bool {
    return !empty($this->phone);
  }

  /**
   * 
   * @return mixed
   */
  public function getPhoneNumber() {
    return $this->phone;
  }

  function getSubject() {
    return $this->subject;
  }

  function getMessage() {
    return $this->message;
  }

}
