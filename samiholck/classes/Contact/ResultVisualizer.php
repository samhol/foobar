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
 * Implementation of ErrorManager
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class ResultVisualizer {

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

  public function generate() {
    $resultGrid = new DivGrid();
    $callout = new ContentCallout();
    $callout->setClosable(true);
    echo "<pre>contactdata:\n";
    print_r($this->data);
    echo '</pre>';
    if ($this->data->submitted !== true) {
      $callout->appendMd('## An Unspecified error occured!');
      $callout->addCssClass('contact-form-error');
    } else {
      $callout->appendMd('## Thank you for your interest!');
      $callout->appendMd("I'll get back to you as soon as possible!");
    }
    $resultGrid->append($callout);
    $cell = new ContainerCell();
    $cell->getContent()->appendMd('You can send another message to me if you wish');
    $resultGrid->append($cell);
    echo $resultGrid;
  }

}
