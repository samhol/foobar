<?php

namespace Sphp\MVC;

use Sphp\Html\Foundation\Sites\Core\ThrowableCalloutBuilder;

$loadPage = function ($par, string $file = 'index') {
  //var_dump(func_get_args());
  try {
    ob_start();
    $page = "samiholck/pages/$file.php";
    if (is_file($page)) {
      $class = $file;
      include $page;
    } else {
      $class = 'error';
      include "samiholck/pages/error.php";
    }
    include "samiholck/templates/linkBar.php";
    $content = ob_get_contents();
  } catch (\Throwable $e) {
    $content .= (new ThrowableCalloutBuilder())->showInitialFile()->showTrace()->showPreviousException()->build($e);
  } catch (\Exception $e) {
    $content .= (new ThrowableCalloutBuilder())->showInitialFile()->showTrace()->showPreviousException()->build($e);
  }
  ob_end_clean();
  echo "<main class=\"container $class\">$content</main>";
};
$loadCalendar = function ()use ($loadPage) {
  $loadPage('',"calendar-app");
};
$loadNotFound = function () {
  echo '<main class="container error">';
  include "samiholck/pages/error.php";
  echo '</main>';
};
$loadIndex = function () use ($loadPage) {
  $loadPage('index');
};

$router = (new Router())
        ->setDefaultRoute($loadNotFound)
        ->route('/', $loadIndex)
        ->route('/index.php', $loadIndex, 10)
        ->route('/calendar', $loadCalendar, 11)
        ->route('/calendar/<*categories>', $loadCalendar, 8)
        ->route('/<!category>', $loadPage, 9);
