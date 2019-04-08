<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Samiholck\Contact;

use Sphp\Html\AbstractContent;
use Sphp\Html\AbstractContent;
use Sphp\Html\Foundation\Sites\Forms\Inputs\ValidableInlineInput;
use Sphp\Html\Foundation\Sites\Forms\GridForm;
use Sphp\Html\Foundation\Sites\Grids\BasicRow;
use Sphp\Html\Foundation\Sites\Buttons\ButtonGroup;
use Sphp\Security\ReCAPTCHAv3;
use Sphp\Html\Foundation\Sites\Containers\ContentCallout;
use Sphp\Html\Foundation\Sites\Grids\DivGrid;
use Sphp\Html\Foundation\Sites\Grids\ContainerCell;

/**
 * Description of ContactForm
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ContactForm {

  public function __construct() {
    
  }

  protected function buildNameRow() {
    
  }

  protected function buildButtonRow(): BasicRow {
    $buttons = new ButtonGroup();
    $buttons->appendPushButton('<i class="fas fa-envelope"></i> Submit')->addCssClass('success', 'submitter');
    $buttons->appendResetter('<i class="fas fa-undo-alt"></i> Reset')->addCssClass('alert');
    $buttons->addCssClass('text-center');

    $buttonRow = new BasicRow();
    $buttonRow->appendCell($buttons);
    return $buttonRow;
  }


}
