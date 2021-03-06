<?php

namespace Sphp\Html;

use Sphp\Samiholck\MVC\TitleGenerator;

$html = Document::html();
$head = Document::head();
$body = Document::body();
$titleGenerator = new TitleGenerator($titles);

$redirect = filter_input(INPUT_SERVER, 'REDIRECT_URL', FILTER_SANITIZE_URL);
$title = $titleGenerator->createTitleFor(trim($redirect, '/'));
$html->setLanguage('en');

use Sphp\Html\Head\Meta;
use Sphp\Html\Head\Link;

$head->set(Meta::charset('UTF-8'));
$head->set(Meta::viewport('width=device-width, initial-scale=1.0'));
$head->setDocumentTitle($title);

$head->set(Link::stylesheet('/css/styles.all.css'));
$head->set(Link::stylesheet('https://cdn.rawgit.com/konpa/devicon/df6431e323547add1b4cf45992913f15286456d3/devicon.min.css'));
$head->set(Link::appleTouchIcon('/apple-touch-icon.png'));
$head->set(Link::icon('/favicon-32x32.png', '32x32'));
$head->set(Link::icon('/favicon-16x16.png', '16x16'));
$head->set(Link::manifest('/site.webmanifest'));
$head->set(Link::maskIcon('/safari-pinned-tab.svg', '#5bbad5'));
$head->set(Meta::namedContent('msapplication-TileColor', '#f1f1f1'));
$head->set(Meta::namedContent('theme-color', '#f1f1f1'));
$head->set(Meta::author('Sami Holck'));
$head->set(Meta::applicationName('SPHPlayground Framework'));
$head->set(Meta::keywords(['php', 'scss', 'css', 'html', 'html5', 'framework',
            'JavaScript', 'DOM', 'Web development', 'tutorials', 'programming',
            'references', 'examples', 'source code', 'demos', 'tips']));
$head->set(Meta::description('SPHP framework for web developement'));

$html->useFontAwesome();
$html->enableSPHP();

$body->addCssClass('manual');
Document::html()->scripts()->appendSrc('samiholck/js/techs.js');
$html->startBody();
