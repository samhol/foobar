<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Samiholck\Contact;

use Sphp\Html\Foundation\Sites\Grids\DivGrid;
use Sphp\Html\Foundation\Sites\Containers\ContentCallout;
use Sphp\Html\Foundation\Sites\Grids\ContainerCell;

/**
 * Implementation of ProcessErrorVisualizer
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class ProcessErrorVisualizer extends ResultCalloutBuilder {

  /**
   *
   * @var ContactData 
   */
  private $data;

  public function __construct(ContactData $data) {
    $this->data = $data;
  }

  public function __destruct() {
    unset($this->data);
  }

  protected function getData(): ContactData {
    return $this->data;
  }

  public function generateCalloutContent(): string {
    if ($this->data) {
      
    }
    return "I'll get back to you as soon as possible!";
  }

  public function generateCalloutHeading(): string {
    
  }

}
