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
  private $currentDateTime;
  private $sequenceNumber;

  function __construct() {
    $this->eol = "\r\n";
    $this->currentYear = '2018';
    $this->currentMonth = '';
    $this->currentDay = '';
    $this->currentTime = '';
    $this->currentTimeZone = 'Europe/London';
    $this->currentDateTime = '';
    $this->sequenceNumber = 0;

    $this->calendarString = 'BEGIN:VCALENDAR' . $this->eol
    . 'PRODID:-//tapirs technologies//EN' . $this->eol
    . 'VERSION:2.0' . $this->eol
    . 'CALSCALE:GREGORIAN' . $this->eol
    . 'METHOD:PUBLISH' . $this->eol
    . 'X-WR-TIMEZONE:' . $this->currentTimeZone . $this->eol;
  }

  public function setCalendarName($name): bool {
    $this->calendarString = $this->calendarString . 'X-WR-CALNAME:' . $name . $this->eol;
    return true;
  }

  public function getCalendarString(): string {
    return $this->calendarString  . 'END:VCALENDAR';
  }

  public function setSequenceNumber($filename): bool {
    $filenameSplit = explode(".", $filename);
    $sequenceSplit = explode("-", $filenameSplit[0]);

    if(count($sequenceSplit) > 1) {
      $newSequenceNumber = $sequenceSplit[count($sequenceSplit) - 1];
    } else {
      $newSequenceNumber = 0;
    }


    $this->sequenceNumber = $newSequenceNumber;
    return true;
  }

  public function getSequenceNumber(): int {
    return $this->sequenceNumber;
  }

  private function generateUid($value): string {
    $uid = preg_replace('/\s+/', '', $value) . '@tapirs-technologies.co.uk';
    $uid = substr($uid, 0, 50);
    $uid = preg_replace('/\(|\)|\'/', '', $uid);

    $index = 1;
    while(strpos($this->calendarString, 'UID:' . $uid)) {
      $uid = $uid . $index;
      $index = $index + 1;
    }

    return $uid;
  }

  public function addEvent($value): bool {
    $uid = $this->generateUid($value);

    if(strlen($value) > 50) {
      $value = substr_replace($value, "\r\n ", 50, 0);
    }

    $this->generateCurrentDateTime();

    $this->calendarString = $this->calendarString . 'BEGIN:VEVENT' . $this->eol;
    #$this->calendarString = $this->calendarString . 'DTSTART; TZID=' . $this->currentTimeZone . ':' . date_format($this->currentDateTime, "Ymd\THis") . $this->eol;
    $this->calendarString = $this->calendarString . 'DTSTART:' . date_format($this->currentDateTime, "Ymd\THis") . $this->eol;
    if($this->currentTime != '') {
        #$this->calendarString = $this->calendarString . 'DTEND; TZID=' . $this->currentTimeZone . ":" . date_format(date_add($this->currentDateTime, date_interval_create_from_date_string("30 minutes")), "Ymd\THis") . $this->eol;
        $this->calendarString = $this->calendarString . 'DTEND:' . date_format(date_add($this->currentDateTime, date_interval_create_from_date_string("30 minutes")), "Ymd\THis") . $this->eol;
    }
    $this->calendarString = $this->calendarString . 'DTSTAMP:' . date('Ymd\THis') . $this->eol;
    $this->calendarString = $this->calendarString . 'UID:' . $uid  . $this->eol;
    $this->calendarString = $this->calendarString . 'CREATED:' . date_format($this->currentDateTime, "Ymd\THis") . $this->eol;
    $this->calendarString = $this->calendarString . 'DESCRIPTION:' . $value . $this->eol;
    $this->calendarString = $this->calendarString . 'LAST-MODIFIED:' . date_format($this->currentDateTime, "Ymd\THis") . $this->eol;
    #LOCATION
    $this->calendarString = $this->calendarString . 'SEQUENCE:' . $this->sequenceNumber . $this->eol;
    #STATUS
    $this->calendarString = $this->calendarString . 'SUMMARY:' . $value . $this->eol;
    $this->calendarString = $this->calendarString . 'TRANSP:OPAQUE' . $this->eol;
    $this->calendarString = $this->calendarString . 'BEGIN:VALARM' . $this->eol;
    $this->calendarString = $this->calendarString . 'TRIGGER:-P1D' . $this->eol;
    $this->calendarString = $this->calendarString . 'DESCRIPTION:' . $value . $this->eol;
    $this->calendarString = $this->calendarString . 'ACTION:DISPLAY' . $this->eol;
    $this->calendarString = $this->calendarString . 'END:VALARM' . $this->eol;
    $this->calendarString = $this->calendarString . 'END:VEVENT' . $this->eol;

    $this->currentTime = '';

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
    $reg_exp = '@\d+@i';
    preg_match_all($reg_exp, $newDay, $matches, PREG_SET_ORDER, 0);
    $this->currentDay = $matches[0][0];

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

  public function setCurrentTimeZone($newZone): bool {
    $newZone = processInput($newZone);
    $this->currentTimeZone = $newZone;
    date_default_timezone_set($this->currentTimeZone);
    return true;
  }

  public function getCurrentTimeZone(): string {
    return $this->currentTimeZone;
  }

  public function generateCurrentDateTime(): bool {
    if($this->currentTime == '') {
      $this->currentDateTime = date_create($this->currentDay . " " . $this->currentMonth . " " . $this->currentYear . " " . "8.30 am");
    } else {
      $this->currentDateTime = date_create($this->currentDay . " " . $this->currentMonth . " " . $this->currentYear . " " . $this->currentTime);
    }
    if($this->currentDateTime == '') {
      return false;
    }
    return true;
  }

  public function getCurrentDateTime(): string {
    return date_format($this->currentDateTime, "Ymd\THis");
  }
}

 ?>
