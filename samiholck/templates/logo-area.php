<?php

namespace Sphp\Html\Foundation\Sites\Navigation;
?>
<div class="grid-x  sphp-logo-area">
  <div class="cell small-auto medium-6">
    <ul class="logo">
      <li>
        <img src="samiholck/pics/samiholck.com.png" width="358" height="46" alt="samiholck.com logo">
      </li>
    </ul>
  </div>
  <div class="cell small-12 medium-6 icon-col hide-for-small-only">
    <?php

    use Sphp\Html\Media\Icons\IconButtons;

    $bi = new IconButtons();
    $bi->github('https://github.com/samhol/SPHP-framework', 'Gihub repository');
    $bi->facebookF('https://www.facebook.com/Sami.Petteri.Holck.Playground/', 'Facebook page');
    $bi->twitter('https://twitter.com/SPHPframework', 'Twitter page');
    $bi->addCssClass('radius')->printHtml();
    ?>
  </div>
</div>
