<?php
declare(strict_types=1);

  require_once('common.php');

  use PHPUnit\Framework\TestCase;

  class commonTest extends TestCase {
    public function setUp(){

    }
    public function tearDown(){ }

    public function testInputCanBeProcessed(): void {
      $this->assertEquals(processInput("hello"), "hello");
      $this->assertEquals(processInput("  hello  "), "hello");
      $this->assertEquals(processInput("\'\\hello\\"), "'hello");
      $this->assertEquals(processInput("<hello>"), "&lt;hello&gt;");

      $this->assertEquals(processInput("  \'<hello>\'   "), "'&lt;hello&gt;'");
    }

    public function testCanReturnAnError(): void {
      $this->expectOutputString( "<form id=\"error_form\" action=\"index.php\" method=\"post\">
    <input type=\"hidden\" name=\"error\" value=\"this is a test error message\">
    <input type=\"hidden\" name=\"formname\" value=\"error_form\">
  </form>

  <script type=\"text/javascript\">
    document.getElementById('error_form').submit();
  </script>");

      returnError("this is a test error message", "index.php");
    }

    public function testCanReturnAnSuccess(): void {
      $this->expectOutputString( "<form id=\"success_form\" action=\"index.php\" method=\"post\">
    <input type=\"hidden\" name=\"success\" value=\"this is a test success message\">
    <input type=\"hidden\" name=\"formname\" value=\"success_form\">
  </form>

  <script type=\"text/javascript\">
    document.getElementById('success_form').submit();
  </script>");

      returnSuccess("this is a test success message", "index.php");
    }

    public function testCanReturnToLogin(): void {
      $this->expectOutputString( "<form id=\"login_form\" action=\"login.php\" method=\"post\">
    <input type=\"hidden\" name=\"error\" value=\"please login before continuing.\">
    <input type=\"hidden\" name=\"redirect\" value=\"index.php\">
    <input type=\"hidden\" name=\"formname\" value=\"login_form\">
  </form>

  <script type=\"text/javascript\">
    document.getElementById('login_form').submit();
  </script>");

      returnToLogin("login.php", "index.php");
    }

    public function testCanLogout(): void {
      $this->expectOutputString( "<form id=\"logout_form\" action=\"index.php\" method=\"post\">
    <input type=\"hidden\" name=\"success\" value=\"you have logged out\">
  </form>

  <script type=\"text/javascript\">
    document.getElementById('logout_form').submit();
  </script>");

      logout();
    }

    public function CanCheckLogin(): void {
      $username = "andrew.partis@tapirs-technologies.co.uk";
      $auth_hash = password_hash("andrew.partis@tapirs-technologies.co.uk" . "test", PASSWORD_BCRYPT);

      $this->assertTrue(checkLogin($username, $auth_hash));
    }

    public function testCanCheckIsYear(): void {
      $this->assertTrue(isYear("2018"));

      $this->assertFalse(isYear("gnnuaguraghur"));

      $this->assertFalse(isYear("uahgruag ragrao;hgra 2018 vjriao;rha;gr gr aragr"));
    }

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
      $filename = "uploads/JHSpring18Calendar161017-7.xlsx";

      #lets check the test file exists before we start
      $this->assertFileExists($filename);

      #then we'll try and load it up
      $this->assertThat(readSpreadsheet($filename), $this->logicalNot($this->IsNull()));

      #check an excpetion is thrown when the file doesnt exist

      $this->expectException(InvalidArgumentException::class);
      $this->expectExceptionMessage("File \"uploads/JHSpring18Calendar161017-7.xlsx.bak\" does not exist.");

      readSpreadsheet($filename . ".bak");
    }

    public function testCanGetWorkSheet(): void {
      $filename = "uploads/JHSpring18Calendar161017-7.xlsx";
      $spreadSheet = readSpreadsheet($filename);
      $this->assertThat(getWorksheet($spreadSheet, 0), $this->logicalNot($this->IsNull()));
    }

    public function testCanGetCalendarFilename(): void {
      $filename = "uploads/JHSpring18Calendar161017-7.xlsx";
      $spreadSheet = readSpreadsheet($filename);
      $worksheet = getWorksheet($spreadSheet, 0);

      $this->assertEquals(getCalendarFilename($worksheet), "SPRING_TERM_2018_JUNIOR_HOUSE_CALENDAR");
    }
  }

 ?>
