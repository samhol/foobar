<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Adapters;

use Sphp\Html\Component;
use Sphp\Html\IdentifiableContent;
use Sphp\Html\Attributes\JsonAttribute;

/**
 * Inserts a Tipso style tooltip to the adaptee
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://tipso.object505.com/ Tipso
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class TipsoAdapter extends AbstractComponentAdapter implements \ArrayAccess {

  /**
   * @var array
   */
  private $config = [];

  /**
   * Constructor
   * 
   * @param Component $component
   * @param string|null $content the value of the title attribute
   */
  public function __construct(Component $component, string $content = null) {
    parent::__construct($component);
    $component->setAttribute('data-sphp-tipso');
    $component->attributes()
            ->setInstance(new JsonAttribute('data-sphp-tipso-options'));
    if ($content !== null) {
      $this->setTitle($content);
    }
  }

  public function setOption(string $name, $value) {
    $this[$name] = $value;
    return $this;
  }

  /**
   * Sets the value of the title attribute
   *
   * @param  string|null $title the value of the title attribute
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_global_title.asp title attribute
   */
  public function setTitle(string $title = null) {
    $this['titleContent'] = $title;
    if ($title === null) {
      $this['useTitle'] = false;
    }
    return $this;
  }

  /**
   * 
   * @param  mixed $name option name
   * @return bool
   */
  public function offsetExists($name): bool {
    return array_key_exists($name, $this->config);
  }

  /**
   * Returns the option value
   * 
   * @param  mixed $name option name
   * @return scalar|null option value or null if not present
   */
  public function offsetGet($name) {
    if ($this->offsetExists($name)) {
      return $this->config[$name];
    }
    return null;
  }

  /**
   * 
   * @param  mixed $name option name
   * @param  mixed $value
   * @return void
   * @throws InvalidArgumentException if the name or the value is invalid
   */
  public function offsetSet($name, $value): void {
    if (!is_string($name)) {
      throw new InvalidArgumentException('Invalid type given for option name');
    }
    if (!is_scalar($value) && $value !== null) {
      throw new InvalidArgumentException('Invalid type given for option value');
    }
    if ($value === null) {
      $this->offsetUnset($name);
    } else {
      $this->config[$name] = $value;
    }
    $this->getComponent()->setAttribute('data-sphp-tipso-options', $this->config);
  }

  /**
   * Removes an option
   * 
   * @param  mixed $name option name
   * @return void
   */
  public function offsetUnset($name): void {
    if ($this->offsetExists($name)) {
      unset($this->config[$name]);
    }
  }

}
