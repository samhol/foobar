<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Samiholck\MVC\Content;

use Sphp\Html\Foundation\Sites\Core\ThrowableCalloutBuilder;

/**
 * Description of PageLoader
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class PageLoader extends AbstractContentLoader {

  public function modifyMain(string $par = null, string $file = 'index'): string {
    //var_dump(func_get_args());
    try {
      ob_start();
      $page = "samiholck/pages/$file.php";
      if (is_file($page)) {
        $class = $file;
        include $page;
      } else {
        $this->getMain()->addCssClass('error');
        include 'samiholck/pages/error.php';
      }
      $content = ob_get_contents();
    } catch (\Throwable $e) {
      $content .= (new ThrowableCalloutBuilder())->showInitialFile()->showTrace()->showPreviousException()->build($e);
    }
    ob_end_clean();
    return $content;
  }

}
