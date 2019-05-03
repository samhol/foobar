<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Samiholck\MVC;

/**
 * Generates a page title for the given page
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class TitleGenerator {

  private $titleData = [];

  public function __construct(array $data) {
    $this->titleData = $data;
  }

  public function createTitleFor(string $url): string {
    if (array_key_exists($url, $this->titleData)) {
      $title = (string) $this->titleData[$url];
    } else {
      $title = "'$url' | samiholck.com";
    }
    return $title;
  }

}
