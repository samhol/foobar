<?php

use Sphp\DateTime\Calendars\Diaries\MutableDiary;
use Sphp\Stdlib\Parsers\Parser;
use Sphp\DateTime\Calendars\Diaries\Holidays\Holidays;
use Sphp\Samiholck\Calendar\Model;
use Sphp\DateTime\Intervals;
use Sphp\DateTime\Calendars\Diaries\Schedules\ATask;
use Sphp\DateTime\Calendars\Diaries\Schedules\PeriodicTask;

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
    // var_dump($t->dateMatchesWith('now'));
    $task[] = $t;
  }
}
$singleTask = new Sphp\DateTime\Calendars\Diaries\Schedules\SingleTask('2019-3-1', 'now');
echo '<pre>';

$periodicTask = PeriodicTask::from('R5/2008-03-01T13:00:00Z/P1Y2M10DT2H30M', 'P1DT1H30M');
$periodicTask->setDescription('Periodic task');
var_dump($periodicTask->dateMatchesWith('2010-07-21 18:00.00'));
var_dump($periodicTask->dateMatchesWith('2010-07-22 17:59.00'));
foreach ($periodicTask->toArray() as $task) {
  echo "\ntask: " . $task->getDescription();
  echo "\n\tstart:\t" . $task->getStart()->format('Y-m-d H:i.s');
  echo "\n\tend:\t" . $task->getEnd()->format('Y-m-d H:i.s');
}
echo '</pre>';
