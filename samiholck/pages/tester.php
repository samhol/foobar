<?php

use Sphp\DateTime\Calendars\Diaries\MutableDiary;
use Sphp\Stdlib\Parsers\Parser;
use Sphp\DateTime\Calendars\Diaries\Holidays\Holidays;
use Sphp\Samiholck\Calendar\Model;
$data = Parser::fromFile('samiholck/calendar/data/birthdays.yml');
echo '<pre>';
$diary = new MutableDiary;
$model = new Model();
$model->parseFromYml('samiholck/calendar/data/birthdays.yml');
print_r($model);
echo '</pre>';
