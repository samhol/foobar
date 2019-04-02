<?php

use Sphp\Html\Media\Icons\FA;
?>

<div class="contacts">
  <div class="media-object">
    <div class="media-object-section">
      <div class="thumbnail">
        <img style="height:100px" src="samiholck/pics/face.jpg" alt="Photo of Sami Holck">
      </div>
    </div>
    <div class="media-object-section main-section">
      <h6>Contact information:</h6>
      <ul class="fa-ul">
        <li><span class="fa-li"><?php FA::phone('phonenumber')->printHtml() ?></span> +358 44 298 6738</li>
        <li><span class="fa-li"><?php FA::envelope('Email address')->printHtml() ?></span> sami.holck@gmail.com</li>
        <li><span class="fa-li"><?php FA::get('fa fa-map-marker-alt', 'Email address')->printHtml() ?></span> Rakuunatie 59 A3, Turku, Finland</li>
      </ul>
    </div>
  </div>
</div>
<div class="social">
  <h6>Follow</h6>
  <a href="https://www.facebook.com/sami.holck">
    <i class="fab fa-github-square fa-4x" aria-hidden="true"></i>
    <span class="show-for-sr">GitHub repository</span>
  </a>
  <a href="https://www.facebook.com/Sami.Petteri.Holck.Playground/">
    <i class="fab fa-facebook-square fa-4x" aria-hidden="true"></i>
    <span class="show-for-sr">Facebook page</span>
  </a>
  <a href="https://plus.google.com/b/113942361282002156141/113942361282002156141">
    <i class="fab fa-google-plus-square fa-4x" aria-hidden="true"></i>
    <span class="show-for-sr">Google plus page</span>
  </a>
  <a href="https://twitter.com/SPHPframework">
    <i class="fab fa-twitter-square fa-4x" aria-hidden="true"></i>
    <span class="show-for-sr">Twitter page</span>
  </a>
</div>
