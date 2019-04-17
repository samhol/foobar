<?php

use Sphp\DateTime\Calendars\Diaries\MutableDiary;
use Sphp\Stdlib\Parsers\Parser;
use Sphp\DateTime\Calendars\Diaries\Holidays\Holidays;
use Sphp\Samiholck\Calendar\Model;
use Sphp\DateTime\Intervals;
use Sphp\DateTime\Calendars\Diaries\Schedules\ATask;

$data = Parser::fromFile('samiholck/calendar/data/tasks.yml');
$task = [];
foreach (Parser::fromFile('samiholck/calendar/data/tasks.yml') as $data) {
  if (array_key_exists('task', $data)) {
    $t = new ATask($data['task']);
    $duration = Intervals::fromString($data['duration']);
    $t->setDuration($duration);
    if (array_key_exists('rules', $data)) {
      $rules = $data['rules'];
      if (array_key_exists('weekdays', $rules)) {
        $t->dateRule()->isWeekly($rules['weekdays']);
      }
      if (array_key_exists('between', $rules)) {
        $t->dateRule()->isBetween($rules['between'][0], $rules['between'][1]);
      }
    }
    var_dump($t->dateMatchesWith('now'));
    $task[] = $t;
  }
}
$singleTask = new Sphp\DateTime\Calendars\Diaries\Schedules\SingleTask('2019-3-1', 'now');
echo '<pre>';
//$foo = new Sphp\DateTime\Interval('2007-03-01T13:00:00Z/P1Y2M10DT2H30M');
//var_dump($t->dateMatchesWith('now'));
//print_r($task->getDuration());
print_r($singleTask);
print_r($singleTask->getDuration());
print_r($task);
/* $diary = new MutableDiary;
  $model = new Model();
  //print_r($model->createTask($data[0]));
  $model->parseFromYml('samiholck/calendar/data/birthdays.yml');
  print_r($model); */
echo '</pre>';
