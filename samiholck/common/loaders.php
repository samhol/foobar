<?php

namespace Sphp\MVC;

use Sphp\Samiholck\MVC\Content\IndexLoader;
use Sphp\Samiholck\MVC\Content\PageLoader;
use Sphp\Samiholck\MVC\Content\CalendarLoader;
use Sphp\Samiholck\MVC\Content\NotFound;

$calendarLoader = new CalendarLoader();
$indexLoader = new IndexLoader();
$router = (new Router())
        ->setDefaultRoute(new NotFound())
        ->route('/', $indexLoader)
        ->route('/index.php', $indexLoader, 10)
        ->route('/calendar', $calendarLoader, 11)
        ->route('/calendar/<*categories>', $calendarLoader, 8)
        ->route('/<!category>', new PageLoader(), 5);
