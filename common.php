<?php
declare(strict_types=1);

  require 'vendor/autoload.php';

  function processInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
  }

  function returnError($errorMessage, $returnPage) {
    echo "<form id=\"error_form\" action=\"$returnPage\" method=\"post\">
    <input type=\"hidden\" name=\"error\" value=\"$errorMessage\">
    <input type=\"hidden\" name=\"formname\" value=\"error_form\">
  </form>

  <script type=\"text/javascript\">
    document.getElementById('error_form').submit();
  </script>";
  }

  function returnSuccess($successMessage, $returnPage) {
    echo "<form id=\"success_form\" action=\"$returnPage\" method=\"post\">
    <input type=\"hidden\" name=\"success\" value=\"$successMessage\">
    <input type=\"hidden\" name=\"formname\" value=\"success_form\">
  </form>

  <script type=\"text/javascript\">
    document.getElementById('success_form').submit();
  </script>";
  }

  function returnToLogin($loginPage, $returnPage) {
    echo "<form id=\"login_form\" action=\"$loginPage\" method=\"post\">
    <input type=\"hidden\" name=\"error\" value=\"please login before continuing.\">
    <input type=\"hidden\" name=\"redirect\" value=\"$returnPage\">
    <input type=\"hidden\" name=\"formname\" value=\"login_form\">
  </form>

  <script type=\"text/javascript\">
    document.getElementById('login_form').submit();
  </script>";
  }

  function logout() {
    echo "<form id=\"logout_form\" action=\"index.php\" method=\"post\">
    <input type=\"hidden\" name=\"success\" value=\"you have logged out\">
  </form>

  <script type=\"text/javascript\">
    document.getElementById('logout_form').submit();
  </script>";
  }

  function checkLogin($username, $authHash) {
    $servername = "db711602684.db.1and1.com";
    $username = "dbo711602684";
    $password = "ZAQ!2wsx####";
    $dbname = "db711602684";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e) {
      returnError("Server error, please try again later", "index.php");

    }

    try {
      $sql = "SELECT username, auth_hash FROM user_db WHERE username= :email AND auth_hash= :auth_hash";

      $get_user = $conn->prepare($sql);
      $get_user->bindValue(':email', $username);
      $get_user->bindValue(':auth_hash', $authHash);
      $get_user->execute();

      $result = $get_user->fetch(PDO::FETCH_ASSOC);

      if ($result['username'] == $username) {
        return true;
      } else {
        return false;
      }
    }
    catch(PDOException $e) {
      returnError("Server error, please try again later" . $e->getMessage(), "index.php");
    }
  }

  function isYear($value): bool {
    $value = processInput($value);
    $reg_exp = '@^\d{4}$@i';
    if(preg_match($reg_exp, $value) == true) {
      return true;
    }
    return false;
  }

  function isMonth($value): bool {
    $value = processInput($value);
    $reg_exp = '@^(january|february|march|april|may|june|july|august|september|october|november|december)$@i';
    if(preg_match($reg_exp, $value) == true) {
      return true;
    }
    return false;
  }

  function isDate($value): bool {
    $value = processInput($value);
    $reg_exp = '@^(sun|mon|tues|wed|thurs|fri|sat)\s+\d{1,2}$@i';
    if(preg_match($reg_exp, $value) == true) {
      return true;
    }
    return false;
  }

  function isTime($value): bool {
    $value = processInput($value);
    $reg_exp = '@^[0-9][0-2]?(\.{1}[0-5][0-9])?\s+(am|pm)$@i';
    if(preg_match($reg_exp, $value) == true) {
      return true;
    }
    return false;
  }

  function readSpreadsheet($filename): PhpOffice\PhpSpreadsheet\Spreadsheet {
    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($filename);
    $reader->setReadDataOnly(true);
    $spreadsheet = $reader->load($filename);

    return $spreadsheet;
  }

  function getWorksheet($spreadSheet, $worksheetIndex): PhpOffice\PhpSpreadsheet\Worksheet\worksheet {
    $worksheet = $spreadSheet->getSheet($worksheetIndex);

    return $worksheet;
  }

  function getCalendarFilename($worksheet): string {
    $calendarFilename = $worksheet->getCellByColumnAndRow(1,1)->getValue();
    $calendarFilename = str_replace(" ", "_", $calendarFilename);
    $calendarFilename = $calendarFilename . ".ics";

    return $calendarFilename;
  }

 ?>
