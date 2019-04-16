<?php

use Sphp\DateTime\Calendars\Diaries\MutableDiary;
use Sphp\Stdlib\Parsers\Parser;
use Sphp\DateTime\Calendars\Diaries\Holidays\Holidays;
use Sphp\Samiholck\Calendar\Model;
use Sphp\DateTime\Calendars\Diaries\Schedules\ATask;
$data = Parser::fromFile('samiholck/calendar/data/tasks.yml');
use Sphp\DateTime\Intervals;
echo '<pre>';
$t = new ATask(new Sphp\DateTime\DateTime('now'), Intervals::create('PT1H30M'));
//$foo = new Sphp\DateTime\Interval('2007-03-01T13:00:00Z/P1Y2M10DT2H30M');
var_dump($t->dateMatchesWith('now'));
print_r($data);
$diary = new MutableDiary;
$model = new Model();
print_r($model->createTask($data[0]));
$model->parseFromYml('samiholck/calendar/data/birthdays.yml');
print_r($model);
echo '</pre>';
