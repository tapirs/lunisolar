<?php
declare(strict_types=1);

  require_once('common.php');

  use PHPUnit\Framework\TestCase;

  class commonTest extends TestCase {
    public function setUp(){

    }
    public function tearDown(){ }

    public function testCanCheckIsMonth(): void {
      $this->assertTrue(isMonth("January"));

      $this->assertFalse(isMonth("gnnuaguraghur"));

      $this->assertFalse(isMonth("uahgruag ragrao;hgra January vjriao;rha;gr gr aragr"));
    }

    public function testCanCheckIsDate(): void {
      $this->assertTrue(isDate("mon 2"));

      $this->assertFalse(isDate("bob"));

      $this->assertFalse(isDate("fheue mon 2 fjeiwo;nvn VVE 22 34 GIRMAR "));
    }

    public function testCanCheckIsTime(): void {
      $this->assertTrue(isTime("10.30 am"));
      $this->assertTrue(isTime("9 pm"));

      $this->assertFalse(isTime("few 9 pm fe2 am vv"));
      $this->assertFalse(isTime("9. pm"));
      $this->assertFalse(isTime("nfuo;g"));
    }

    public function testCanReadSpreadsheet(): void {
      $filename = "uploads/JHSpring18Calendar161017.xlsx";

      #lets check the test file exists before we start
      $this->assertFileExists($filename);

      #then we'll try and load it up
      $this->assertThat(readSpreadsheet($filename), $this->logicalNot($this->IsNull()));

      #check an excpetion is thrown when the file doesnt exist

      $this->expectException(InvalidArgumentException::class);
      $this->expectExceptionMessage("File \"uploads/JHSpring18Calendar161017.xlsx.bak\" does not exist.");

      readSpreadsheet($filename . ".bak");
    }

    public function testCanGetWorkSheet(): void {
      $filename = "uploads/JHSpring18Calendar161017.xlsx";
      $spreadSheet = readSpreadsheet($filename);
      $this->assertThat(getWorksheet($spreadSheet, 0), $this->logicalNot($this->IsNull()));
    }
  }

 ?>
