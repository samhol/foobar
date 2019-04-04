<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Samiholck\Contact;

use Sphp\Html\Foundation\Sites\Containers\ContentCallout;

/**
 * Implementation of ResultCalloutBuilder
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
abstract class ResultCalloutBuilder {

  abstract public function generateCalloutHeading(): string;
  abstract public function generateCalloutContent(): string;

  public function generateCallout(): ContentCallout {
    $callout = new ContentCallout();
    $callout->setClosable();
    $callout->append($this->generateCalloutHeading());
    $callout->append($this->generateCalloutContent());
    //$callout->printHtml();
    return $callout;
  }

}
