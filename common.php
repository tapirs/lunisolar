<?php
declare(strict_types=1);

  require 'vendor/autoload.php';

  function isMonth($value): bool {
    $reg_exp = '@^(january|february|march|april|may|june|july|august|september|october|november|december)$@i';
    if(preg_match($reg_exp, $value) == true) {
      return true;
    }
    return false;
  }

  function isDate($value): bool {
    $reg_exp = '@^(sun|mon|tues|wed|thurs|fri|sat)\s+\d{1,2}$@i';
    if(preg_match($reg_exp, $value) == true) {
      return true;
    }
    return false;
  }

  function isTime($value): bool {
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

 ?>
