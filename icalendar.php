<?php

require_once 'common.php';

class icalendar {
  private $calendarString;
  private $eol;
  private $currentYear;
  private $currentMonth;
  private $currentDay;
  private $currentTime;
  private $currentTimeZone;

  function __construct() {
    $this->eol = "\r\n";
    $this->calendarString = 'BEGIN:VCALENDAR' . $this->eol . 'PRODID:-//tapirs technologies//EN' . $this->eol . 'VERSION:2.0' . $this->eol . 'CALSCALE:GREGORIAN' . $this->eol;
    $this->currentYear = '2018';
    $this->currentMonth = '';
    $this->currentDay;
    $this->currentTime = '';
    $this->currentTimeZone = 'Europe/London';
    date_default_timezone_set($this->currentTimeZone);
  }

  public function getCalendarString(): string {
    return $this->calendarString . 'END:VCALENDAR';
  }

  public function addEvent(): bool {


    return true;
  }

  public function setCurrentYear($newYear): bool {
    $this->newYear = processInput($newYear);
    $this->currentYear = $newYear;

    return true;
  }

  public function getCurrentYear(): string {
    return $this->currentYear;
  }

  public function setCurrentMonth($newMonth): bool {
    $newMonth = processInput($newMonth);
    $this->currentMonth = $newMonth;

    return true;
  }

  public function getCurrentMonth(): string {
    return $this->currentMonth;
  }

  public function setCurrentDay($newDay): bool {
    $newDay = processInput($newDay);
    $this->currentDay = $newDay;

    return true;
  }

  public function getCurrentDay(): string {
    return $this->currentDay;
  }

  public function setCurrentTime($newTime): bool {
    $newTime = processInput($newTime);
    $this->currentTime = $newTime;
    return true;
  }

  public function getCurrentTime(): string {
    return $this->currentTime;
  }
}

 ?>
