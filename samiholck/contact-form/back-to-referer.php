<?php

use Sphp\Http\Headers\Location;
$correct = ['http://samiholck.com/whoTest', 'http://www.samiholck.com/who'];
$referer = filter_input(INPUT_SERVER, 'HTTP_REFERER', FILTER_SANITIZE_URL);
if ($referer === null || !in_array($referer, $correct)) {
    (new Location('http://www.samiholck.com/contact'))->execute();
} else {
    (new Location($referer))->execute();
}
//(new Location(Config::instance()->get('ROOT_URL') . "contactTest"))->execute();
