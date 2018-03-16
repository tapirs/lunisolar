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
      $this->assertEquals($this->calendar->getCalendarString(), 'BEGIN:VCALENDAR' . $this->eol . 'PRODID:-//tapirs technologies//EN' . $this->eol . 'VERSION:2.0' . $this->eol . 'CALSCALE:GREGORIAN' . $this->eol . 'END:VCALENDAR');
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
      $this->assertEquals($this->calendar->getCurrentDay(), "mon 2");
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
  }

 ?>
