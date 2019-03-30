<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Samiholck\MVC\Content;

use Sphp\Html\Flow\Main;

/**
 * Description of AbstractContentLoader
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
abstract class AbstractContentLoader {

  /**
   * @var Main
   */
  private $main;

  public function __construct() {
    $this->main = new Main();
    $this->main->addCssClass('container');
  }

  public function getMain(): Main {
    return $this->main;
  }

  public function __invoke(string $par = null, string $file = 'index') {
    $this->main->append($this->modifyMain($par, $file));
    $this->main->appendPhpFile('samiholck/templates/linkBar.php');
    echo $this->main;
  }

  abstract public function modifyMain(): string;
}
