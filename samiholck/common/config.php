<?php

namespace Sphp\Config;

use Sphp\Network\URL;

Config::instance()->set('CURRENT_URL', URL::getCurrentURL());
Config::instance()->set('ROOT_URL', 'http://www.samiholck.com/'); 
