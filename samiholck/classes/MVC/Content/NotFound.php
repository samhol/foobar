<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Samiholck\MVC\Content;

use Sphp\Stdlib\Filesystem;

/**
 * Description of NotFound
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class NotFound extends AbstractContentLoader {

  public function __construct() {
    parent::__construct();
    $this->getMain()->addCssClass('error');
  }

  public function modifyMain(): string {
    return Filesystem::executePhpToString('samiholck/pages/error.php');
  }

}
