<?php

namespace Sphp\Html;

error_reporting(E_ALL);
ini_set("display_errors", "1");

require_once('samiholck/settings.php');

use Sphp\Samiholck\MVC\TitleGenerator;

$redirect = filter_input(INPUT_SERVER, 'REDIRECT_URL', FILTER_SANITIZE_URL);


$html = Document::html();
$head = Document::head();
$body = Document::body();

$titleGenerator = new TitleGenerator($titles);

//echo '<pre>';
//echo \Sphp\MVC\Router::getCleanUrl();
$redirect = trim(filter_input(INPUT_SERVER, 'REDIRECT_URL', FILTER_SANITIZE_URL), '/');
$title = $titleGenerator->createTitleFor($redirect);
Document::html()->setLanguage('en')->setDocumentTitle($title);

use Sphp\Html\Head\Meta;
use Sphp\Html\Head\Link;

$html->enableSPHP()
        ->setViewport('width=device-width, initial-scale=1.0')
        ->useFontAwesome();

$head->set(Link::stylesheet('http://www.samiholck.com/css/intro/styles.all.css'));
$head->set(Link::stylesheet('https://cdnjs.cloudflare.com/ajax/libs/motion-ui/1.1.1/motion-ui.min.css'));
$head->set(Link::stylesheet('https://cdn.rawgit.com/konpa/devicon/master/devicon.min.css'));

$head->set(Link::appleTouchIcon('/apple-touch-icon.png'));
$head->set(Link::icon('/favicon-32x32.png', '32x32'));
$head->set(Link::icon('/favicon-16x16.png', '16x16'));
$head->set(Link::manifest('/site.webmanifest'));
$head->set(Link::maskIcon('/safari-pinned-tab.svg', '#5bbad5'));
$head->set(Meta::namedContent('msapplication-TileColor', '#f1f1f1'));
$head->set(Meta::namedContent('theme-color', '#f1f1f1'));
$head->set(Meta::author('Sami Holck'));
$head->set(Meta::keywords(['sami', 'holck', 'css', 'html', 'html5', 'framework',
            'JavaScript', 'DOM', 'Web development', 'tutorials', 'programming',
            'references', 'examples', 'source code', 'demos', 'tips']));
$head->set(Meta::description('Personal homepage of Sami Holck'));

$html->useFontAwesome();
/* if ($redirect === 'contactTest') {
  Document::html()->scripts()->appendSrc('https://www.google.com/recaptcha/api.js')->setAsync()->setDefer();
  } */

//Document::body()->inlineStyles()->setProperty('visibility', 'hidden');
//Document::html()->scripts()->appendSrc('samiholck/js/techs.js');
Document::html()->startBody();



$cacheSuffix = str_replace(['.', '/'], ['-', ''], $redirect) . "-cache";
?>

<div class="orbit clean-hero-slider" role="region" aria-label="Favorite Space Pictures" data-orbit>
  <div class="orbit-wrapper">
    <div class="orbit-controls">
      <button class="orbit-previous"><span class="show-for-sr">Previous Slide</span>&#9664;&#xFE0E;</button>
      <button class="orbit-next"><span class="show-for-sr">Next Slide</span>&#9654;&#xFE0E;</button>
    </div>
    <ul class="orbit-container">
      <li class="orbit-slide">
        <figure class="orbit-figure">
          <img class="orbit-image" src="//lorempixel.com/800/350/" alt="image alt text">
          <figcaption class="orbit-caption">
            <h3>Lorem Ipsum Etiam</h3>
            <p>Etiam porta sem malesuada magna mollis euismod. Vestibulum id ligula porta felis euismod semper.</p>
            <a href="#" class="button yellow">Mattis Elit</a>
          </figcaption>
        </figure>
      </li>
      <li class="orbit-slide">
        <figure class="orbit-figure">
          <img class="orbit-image" src="//lorempixel.com/800/350/" alt="image alt text">
          <figcaption class="orbit-caption">
            <h3>Ipsum Ornare Ultricies</h3>
            <p>Nullam quis risus eget urna mollis ornare vel eu leo. Donec ullamcorper nulla non metus auctor fringilla. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            <a href="#" class="button yellow">Egestas Amet</a>
          </figcaption>
        </figure>
      </li>
      <li class="orbit-slide">
        <figure class="orbit-figure">
          <img class="orbit-image" src="//lorempixel.com/800/350/" alt="image alt text">
          <figcaption class="orbit-caption">
            <h3>Malesuada Parturient</h3>
            <p>Fusce dapibus, tellus ac cursus commodo, sit amet risus. Cras mattis consectetur purus sit amet fermentum. Maecenas sed diam sit amet non magna.</p>
            <a href="#" class="button yellow">Sollicitudin</a>
          </figcaption>
        </figure>
      </li>
    </ul>
  </div>
  <nav class="orbit-bullets">
    <button class="is-active" data-slide="1"><span class="show-for-sr">Lorem Ipsum Etiam</span></button>
    <button data-slide="2"><span class="show-for-sr">Lorem Ipsum Etiam</span></button>
    <button data-slide="3"><span class="show-for-sr">Lorem Ipsum Etiam</span></button>
  </nav>
</div>

<?php
$html->documentClose();
