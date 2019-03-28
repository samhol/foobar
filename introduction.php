<?php

namespace Sphp\Html;

error_reporting(E_ALL);
ini_set("display_errors", "1");

require_once('samiholck/settings.php');

use Sphp\Samiholck\MVC\TitleGenerator;

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

$head->set(Link::stylesheet('/css/styles.all.css'));
$head->set(Link::stylesheet('https://cdnjs.cloudflare.com/ajax/libs/motion-ui/1.1.1/motion-ui.min.css'));

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
$head->set(Meta::description('Introduction toPersonal homepage of Sami Holck'));

$html->useFontAwesome();
/* if ($redirect === 'contactTest') {
  Document::html()->scripts()->appendSrc('https://www.google.com/recaptcha/api.js')->setAsync()->setDefer();
  } */

//Document::body()->inlineStyles()->setProperty('visibility', 'hidden');
//Document::html()->scripts()->appendSrc('samiholck/js/techs.js');
Document::html()->startBody();



$cacheSuffix = str_replace(['.', '/'], ['-', ''], $redirect) . "-cache";
?>
<div class="intro">
  <a class="skip-button" href='/'>Skip intro!</a>
  <div class="orbit" role="region" aria-label="Who is Sami Holck" data-orbit data-options="autoPlay:false;animInFromLeft:fade-in; animInFromRight:fade-in; animOutToLeft:fade-out; animOutToRight:fade-out;">
    <div class="orbit-wrapper">
      <div class="orbit-controls">
        <button class="orbit-previous">
          <span class="show-for-sr">Previous Slide</span>
          <i class="nav fa fa-chevron-left fa-3x"></i>
        </button>
        <button class="orbit-next">
          <span class="show-for-sr">Next Slide</span>
          <i class="nav fa fa-chevron-right fa-3x"></i>
        </button>
      </div>
      <ul class="orbit-container">
        <li class="orbit-slide burning">
          <div class="content">
            <h3>Burning desire</h3>
            <p>Web design is my passion. I do it daily . . . and I want to learn more about it!</p>
            <p>Do you need a developer capable of Full-Stack development? <a href="/contact" class="button contact">Contact me</a></p>
          </div>
        </li>

        <li class="orbit-slide cow">
          <div class="content">
            <h3>Eye on beauty and details</h3>
            <p>I am a pedant software designer! I prefer optimized and tested code. I also enjoy responsive WEB layout design</p>
            <a href="#" class="button yellow">Contact me</a>
          </div>
        </li>
        <li class="orbit-slide fullstack">
          <div class="content">
            <h3>Full Stack Web developer</h3>
            <p>I am comfortable working with client-side and on server-side 
              a WEB application to a finished product. I am familiar with all the 
              phases of WEB development . . . and I have fair knowledge of Networking, 
              Databases, Security etc. . . .</p>
            <div class="button-group">
              <a href="https://www.php.net/" class="button yellow"><i class="fab fa-php"></i><span class="show-for-sr">php.net</span></a>
              <a href="https://www.php.net/" class="button yellow"><i class="fab fa-nodejs"></i><span class="show-for-sr">php.net</span></a>
              <a href="#" class="button yellow"><i class="fab fa-js-square"></i> javascript.com</a>
            </div>
          </div>
        </li>
        <li class="orbit-slide projects">
          <div class="content">
            <h3>Projects</h3>
            <p>Obviously this list does not contain every project . . .</p>

            <ul>
              <li>See my projects on <a href="http:www.samiholck.com/" class=" yellow">GitHub</a></li>
              <li><a href="http:www.samiholck.com/" class=" yellow">samiholck.com</a> is my homepage</li>
              <li><a href="http:playground.samiholck.com/" class=" yellow">SPHPlayground</a> is the framework I'm developing</li>
              <li><a href="http://raisionveneseura.fi/" class=" yellow">Raision veneseura</a> </li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
    <nav class="orbit-bullets">
      <button data-slide="0"><span class="show-for-sr">Burning Desire</span></button>
      <button data-slide="1"><span class="show-for-sr">Eye on details</span></button>
      <button class="is-active" data-slide="2"><span class="show-for-sr">Full Stack Web Developer</span></button>
      <button data-slide="3"><span class="show-for-sr">Projects</span></button>
    </nav>
  </div>
</div>
<?php
$html->documentClose();
