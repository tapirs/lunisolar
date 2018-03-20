<?php
declare(strict_types=1);

  require_once('common.php');
  require_once('icalendar.php');

  use PHPUnit\Framework\TestCase;

  class icalendarTest extends TestCase {
    private $calendar;
    private $eol = "\r\n";

    public function setUp(){
      $this->calendar = new icalendar();
    }
    public function tearDown(){ }

    public function testGetCalendarString(): void {
      $this->assertEquals($this->calendar->getCalendarString(), 'BEGIN:VCALENDAR' . $this->eol
      . 'PRODID:-//tapirs technologies//EN' . $this->eol
      . 'VERSION:2.0' . $this->eol
      . 'CALSCALE:GREGORIAN' . $this->eol
      . 'METHOD:PUBLISH' . $this->eol
      . 'X-WR-TIMEZONE:Europe/London' . $this->eol
      . 'END:VCALENDAR');
    }

    public function testSetCalendarName(): void {
      $this->calendar->setCalendarName("calendar@name.com");
      $this->assertEquals($this->calendar->getCalendarString(), 'BEGIN:VCALENDAR' . $this->eol
      . 'PRODID:-//tapirs technologies//EN' . $this->eol
      . 'VERSION:2.0' . $this->eol
      . 'CALSCALE:GREGORIAN' . $this->eol
      . 'METHOD:PUBLISH' . $this->eol
      . 'X-WR-TIMEZONE:Europe/London' . $this->eol
      . 'X-WR-CALNAME:calendar@name.com' . $this->eol
      . 'END:VCALENDAR');
    }

    public function testSetSequenceNumber(): void {
      $this->assertTrue($this->calendar->setSequenceNumber("JHSpring18Calendar161017-1.xlsx"));
    }

    /**
     * @depends testSetSequenceNumber
     */
    public function testGetSequenceNumber(): void {
      $this->calendar->setSequenceNumber("JHSpring18Calendar161017-1.xlsx");
      $this->assertEquals($this->calendar->getSequenceNumber(), 1);
    }

    /**
     * @depends testSetSequenceNumber
     */
    public function testGetZeroSequenceNumber(): void {
      $this->calendar->setSequenceNumber("JHSpring18Calendar161017.xlsx");
      $this->assertEquals($this->calendar->getSequenceNumber(), 0

    );
    }

    public function testSetCurrentYear(): void {
      $this->assertTrue($this->calendar->setCurrentYear("2016"));
    }

    /**
     * @depends testSetCurrentYear
     */
    public function testGetCurrentYear(): void {
      $this->calendar->setCurrentYear("2016");
      $this->assertEquals($this->calendar->getCurrentYear(), "2016");
    }

    public function testSetCurrentMonth(): void {
      $this->assertTrue($this->calendar->setCurrentMonth("january"));
    }

    /**
     * @depends testSetCurrentMonth
     */
    public function testGetCurrentMonth(): void {
      $this->calendar->setCurrentMonth("january");
      $this->assertEquals($this->calendar->getCurrentMonth(), "january");
    }

    public function testSetCurrentDay(): void {
      $this->assertTrue($this->calendar->setCurrentDay("mon 2"));
    }

    /**
     * @depends testSetCurrentDay
     */
    public function testGetCurrentDay(): void {
      $this->calendar->setCurrentDay("mon 2");
      $this->assertEquals($this->calendar->getCurrentDay(), "2");
    }

    public function testSetCurrentTime(): void {
      $this->assertTrue($this->calendar->setCurrentTime("10.30 am"));
    }

    /**
     * @depends testSetCurrentTime
     */
    public function testGetCurrentTime(): void {
      $this->calendar->setCurrentTime("10.30 am");
      $this->assertEquals($this->calendar->getCurrentTime(), "10.30 am");
    }

    public function testSetCurrentTimeZone(): void {
      $this->assertTrue($this->calendar->setCurrentTimeZone("Europe/London"));
    }

    /**
     * @depends testSetCurrentTime
     */
    public function testGetCurrentTimeZone(): void {
      $this->calendar->setCurrentTimeZone("Europe/London");
      $this->assertEquals($this->calendar->getCurrentTimeZone(), "Europe/London");
    }

    public function testGenerateCurrentDateTime(): void {
      $this->calendar->setCurrentYear("2018");
      $this->calendar->setCurrentMonth("march");
      $this->calendar->setCurrentDay("fri 16");
      $this->calendar->setCurrentTime("6:12 pm");
      $this->assertTrue($this->calendar->generateCurrentDateTime());
    }

    /**
     * @depends testGenerateCurrentDateTime
     */
    public function testGetCurrentDateTime(): void {
      $this->calendar->setCurrentYear("2018");
      $this->calendar->setCurrentMonth("march");
      $this->calendar->setCurrentDay("fri 16");
      $this->calendar->setCurrentTime("6:12 pm");
      $this->calendar->generateCurrentDateTime();
      $this->assertEquals($this->calendar->getCurrentDateTime(), "20180316T181200");
    }
  }

 ?>
