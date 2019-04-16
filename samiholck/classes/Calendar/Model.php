<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Samiholck\Calendar;

use Sphp\DateTime\Calendars\Diaries\Holidays\Fi\HolidayDiary;
use Sphp\DateTime\Calendars\Diaries\Logs;
use Sphp\DateTime\Calendars\Diaries\Holidays\Holidays;
use Sphp\DateTime\Calendars\Diaries\Schedules\RepeatingTask;
use Sphp\DateTime\Calendars\Diaries\MutableDiary;
use Sphp\DateTime\Calendars\Diaries\Sports\FitNotes;
use Sphp\Stdlib\Parsers\Parser;
use Sphp\DateTime\Calendars\Diaries\Holidays\BirthDay;
use Sphp\DateTime\Calendars\Diaries\Holidays\HolidayInterface;

/**
 * Implementation of Model
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Model {

  /**
   * @var MutableDiary
   */
  private $diary;

  public function __construct(MutableDiary $diary = null) {
    if ($diary === null) {
      $diary = new MutableDiary;
    }
    $this->diary = $diary;
  }

  public function __destruct() {
    unset($this->diary);
  }

  public function parseFromYml(string $path) {
    $data = Parser::fromFile($path);
    foreach ($data as $birthDayData) {
      $note = null;
      if (array_key_exists('birthday', $birthDayData)) {
        $note = $this->createBirthday($birthDayData);
      }
      if (array_key_exists('annual-note', $birthDayData)) {
        $note = $this->createAnnual($birthDayData);
      }
      if ($note instanceof HolidayInterface) {

        if (array_key_exists('flagday', $birthDayData)) {
          $note->isFlagDay($birthDayData['flagday']);
        }
        if (array_key_exists('national-holiday', $birthDayData)) {
          $note->isFlagDay($birthDayData['national-holiday']);
        }
        $this->diary->insertLog($note);
      }
    }
  }
  public function createTask(array $data): \Sphp\DateTime\Calendars\Diaries\Schedules\PeriodicTask {
    $period = \Sphp\DateTime\Period::fromISO($data['period']);
    $duration = \Sphp\DateTime\Intervals::fromString($data['duration']);
    $task = new \Sphp\DateTime\Calendars\Diaries\Schedules\PeriodicTask($period, $duration);
    /*$birthDay = Holidays::birthday($data['dob'], $data['birthday']);
    if (array_key_exists('flagday', $data)) {
      $birthDay->setFlagDay($data['flagday']);
    }
    if (array_key_exists('dod', $data)) {
      $birthDay->getPerson()->setDateOfDeath($data['dod']);
    }*/
    return $task;
  }
  
  public function createTask1(array $data): \Sphp\DateTime\Calendars\Diaries\Schedules\PeriodicTask {
    $period = \Sphp\DateTime\Period::fromISO($data['period']);
    $duration = \Sphp\DateTime\Intervals::fromString($data['duration']);
    $task = new \Sphp\DateTime\Calendars\Diaries\Schedules\PeriodicTask($period, $duration);
    /*$birthDay = Holidays::birthday($data['dob'], $data['birthday']);
    if (array_key_exists('flagday', $data)) {
      $birthDay->setFlagDay($data['flagday']);
    }
    if (array_key_exists('dod', $data)) {
      $birthDay->getPerson()->setDateOfDeath($data['dod']);
    }*/
    return $task;
  }
  

  public function createBirthday(array $data): BirthDay {
    $birthDay = Holidays::birthday($data['dob'], $data['birthday']);
    if (array_key_exists('flagday', $data)) {
      $birthDay->setFlagDay($data['flagday']);
    }
    if (array_key_exists('dod', $data)) {
      $birthDay->getPerson()->setDateOfDeath($data['dod']);
    }
    return $birthDay;
  }

  public function createAnnual(array $data): HolidayInterface {
    $noteName = $data['annual-note'];
    if (array_key_exists('pattern', $data)) {
      $birthDay = Holidays::varyingAnnual($data['pattern'], $noteName);
    }
    if (array_key_exists('month', $data) && array_key_exists('day', $data)) {
      $birthDay = Holidays::annual($data['month'], $data['day'], $noteName);
    }
    return $birthDay;
  }

  public function getDiaries(int $year, int $month) {

//$easter = new EasterHolidays($year);
    $fi = new HolidayDiary();

    $fi->insertLog(Logs::annual(2, 29, 'Sami, Holck'));
    $fi->insertLog(Holidays::birthday('1975-9-16', 'Sami, Holck'));
    $fi->insertLog(Holidays::birthday('1977-12-23', 'Ella, Lisko'));
    $fi->insertLog(Holidays::birthday('1947-7-21', 'Leena, Holck'));
    $fi->insertLog(Holidays::birthday('1918-1-7', 'Vilho, Koivisto', '2016-11-30'));
    $fi->setEasterFor($year);
    $misc = new MutableDiary();
    $basketball = RepeatingTask::from('19:00', '21:00');
    $basketball->setDescription('Basketball at Ruiskatu');
    $basketball->dateRule()
            ->isWeekly(7)
            ->isAfter('2017-8-31')
            ->isBefore('2018-6-1')
            ->isNotOneOf("$year-4-30", "$year-5-1");
    $misc->insertLog($basketball);
    $klu = RepeatingTask::from('20:30', '22:00');
    $klu->setDescription('Basketball at the School of Vaarniemi');
    $klu->dateRule()
            ->isWeekly(1, 3)
            ->isAfter('2018-1-1')
            ->isBefore('2019-6-1')
            ->isNotBetween('2018-6-1', '2018-8-25')
            ->isNotOneOf("$year-4-30", "$year-5-1");

    $misc->insertLog($klu);

    $normaalikoulu = RepeatingTask::from('20:30', '22:00');
    $normaalikoulu->setDescription('Basketball at Normaalikoulu');
    $normaalikoulu->dateRule()
            ->isWeekly(2)
            ->isAfter('2018-1-9')
            ->isBefore('2019-6-1')
            ->isNotBetween('2018-12-15', '2019-1-6')
            ->isNotOneOf("$year-4-30", "$year-5-1");

    $misc->insertLog($normaalikoulu);

    $edu = RepeatingTask::from('21:00', '22:30');
    $edu->setDescription('Basketball at Educarium');
    $edu->dateRule()
            ->isWeekly(4)
            ->isAfter('2018-1-9')
            ->isBefore('2019-6-1')
            ->isNotBetween('2018-12-15', '2019-1-6')
            ->isNotOneOf("$year-4-30", "$year-5-1");

    $misc->insertLog($edu);

    $vaasa = new \Sphp\DateTime\Calendars\Diaries\Schedules\SingleTask('2018-7-19', '2018-7-21');
    $vaasa->setDescription('Trip to Vaasa');

    $misc->insertLog($vaasa);

    $exercises = FitNotes::fromCsv('/home/int48291/public_html/data.samiholck.com/calendar/data/FitNotes.csv');
    /* foreach ($exercises as $excercise) {
      foreach ($excercise as $workout) {
      if ($workout instanceof \Sphp\DateTime\Calendars\Diaries\Sports\WeightLiftingExercise) {
      //var_dump($workout->totalsToString());
      //print_r($workout->toArray());
      }
      }
      } */

    $workCalendar = new \Sphp\DateTime\Calendars\Diaries\MutableDiary();
    $liucon = RepeatingTask::from('7:00', '15:30');
    $liucon->setDescription('Working as an employee for Liucon OY');
    $liucon->dateRule()
            ->isWeekly(1, 2, 3, 4, 5)
            ->isAfter('2018-5-9')
            ->isBefore('2018-8-11')
            ->isNotOneOf('2018-7-19', '2018-7-20');
    $workCalendar->insertLog($liucon);
//$liucon1 = \Sphp\DateTime\Calendars\Diaries\Schedules\PeriodicTask::from('R50/2018-05-09T07:00:00Z/P1D', 'PT7H30M');
//$liucon1->setDescription('Working as an employee for Liucon OY');
    /* $liucon1->dateConditions()
      ->isWeekly(1, 2, 3, 4, 5)
      ->isAfter('2018-5-9')
      ->isBefore('2018-8-11')
      ->isNotOneOf('2018-7-19', '2018-7-20'); */
//$workCalendar->insertLog($liucon1);
    $workCalendar->insertLog(new \Sphp\DateTime\Calendars\Diaries\Schedules\SingleTask('2018-5-20 11:00 EET', '2018-5-20 12:00 EET'));
//var_dump($exercises instanceof \Sphp\DateTime\Calendars\Diaries\DiaryInterface);
    $diaryContainer = new \Sphp\DateTime\Calendars\Diaries\DiaryContainer();

    $diaryContainer->insertDiary($fi);
    $diaryContainer->insertDiary($misc);
//$diaryContainer->insertDiary($basketball);
    $diaryContainer->insertDiary($exercises);
    $diaryContainer->insertDiary($workCalendar);

//echo '</pre>';
  }

}
