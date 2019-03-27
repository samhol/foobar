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
$head->setBaseAddr('http://www.samiholck.com/', '_self');

$head->setCssSrc('http://www.samiholck.com/css/intro/styles.all.css');
$head->setCssSrc('https://cdnjs.cloudflare.com/ajax/libs/motion-ui/1.1.1/motion-ui.min.css');
$head->setCssSrc('https://cdn.rawgit.com/konpa/devicon/master/devicon.min.css');

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

<div class="orbit clean-hero-slider" role="region" aria-label="Who is Sami Holck" data-orbit>
  <div class="orbit-wrapper">
    <div class="orbit-controls">
      <button class="orbit-previous"><span class="show-for-sr">Previous Slide</span>&#9664;&#xFE0E;</button>
      <button class="orbit-next"><span class="show-for-sr">Next Slide</span>&#9654;&#xFE0E;</button>
    </div>
    <ul class="orbit-container">
      <li class="orbit-slide">
        <figure class="orbit-figure">
          <img class="orbit-image" src="intro/burning.jpg" alt="Falmes in Mellilä">
          <figcaption class="orbit-caption">
            <h3>Burning desire</h3>
            <p>I do WEB desing related things almost every day. Web is my passion 
              and hobby and hopefully also a work soon!</p>
            <a href="#" class="button yellow">Contact me</a>
          </figcaption>
        </figure>
      </li>
      <li class="orbit-slide">
        <figure class="orbit-figure">
          <img class="orbit-image" src="intro/fullstack.jpg" alt="Summer night in Mellilä">
          <figcaption class="orbit-caption">
            <h3>Full Stack Web developer</h3>
            <p>I am comfortable working with all the technologies required to get 
              a WEB application to a finished product. I am familiar with all the 
              layers of WEB development... and I have fair knowledge of Networking, 
              Databases, Security etc....</p>
            <div class="button-group">
              <a href="#" class="button yellow"><i class="fab fa-php"></i> php.net</a>
              <a href="#" class="button yellow">w3c.org</a>
              <a href="#" class="button yellow"><i class="fab fa-js-square"></i> javascript.com</a>
            </div>
          </figcaption>
        </figure> 
      </li>
      <li class="orbit-slide">
        <figure class="orbit-figure">
          <img class="orbit-image" src="intro/project.jpg" alt="Painting the barn">
          <figcaption class="orbit-caption">
            <h3>Projects</h3>
            <p>I have been working with several WEB sites and WEB related projects, like...</p>
            <div class="button-group">
              <a href="http:www.samiholck.com/" class="button yellow">GitHub</a>
              <a href="http:www.samiholck.com/" class="button yellow">samiholck.com</a>
              <a href="http:playground.samiholck.com/" class="button yellow">SPHPlayground</a>
              <a href="http://raisionveneseura.fi/" class="button yellow">Raision veneseura</a>
            </div>
          </figcaption>
        </figure>
      </li>
    </ul>
  </div>
  <nav class="orbit-bullets">
    <button class="is-active" data-slide="0"><span class="show-for-sr">Burning Desire</span></button>
    <button data-slide="1"><span class="show-for-sr">Full Stack Web Developer</span></button>
    <button data-slide="2"><span class="show-for-sr">Projects</span></button>
  </nav>
</div>

<?php
$html->documentClose();
