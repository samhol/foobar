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
class ContactData extends \stdClass {

  /**
   * Constructs a new instance
   * 
   * @param array $data
   */
  public function __construct(array $data = []) {
    foreach ($data as $k => $v) {
      $this->{$k} = $v;
    }
  }

  public function __get(string $name) {
    if (isset($this->$name)) {
      return $this->$name;
    } else {
      return null;
    }
  }

  public function __isset(string $name): bool {
    return isset($this->$name) && $this->$name !== null;
  }

  public function isSubmitted(): bool {
    
  }

}
