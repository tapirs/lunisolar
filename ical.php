<?php

  include 'common.php';
  require 'vendor/autoload.php';

  use PhpOffice\PhpSpreadsheet\Spreadsheet;

  if(isset($_POST['filename'])) {
    $filename = $_POST['filename'];

    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($filename);
    $reader->setReadDataOnly(true);
    $spreadsheet = $reader->load($filename);

    $worksheet = $spreadsheet->getSheet(0);

    $highestRow = $worksheet->getHighestRow();
    $highestColumn = $worksheet->getHighestColumn();
    $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);

    $currentYear = '2018';
    $currentMonth = '';
    $currentDay;
    $currentTime = '';
    $currentTimeZone = 'Europe/London';
    date_default_timezone_set($currentTimeZone);
    $eol = "\r\n";

    $filename = $worksheet->getCellByColumnAndRow(1,1)->getValue();
    $filename = str_replace(" ", "_", $filename);

    header('Content-type: text/calendar');
    header("Content-Disposition: inline; filename=$filename.ics");
    header("Content-Transfer-Encoding: binary");

    $calendar = 'BEGIN:VCALENDAR' . $eol . 'PRODID:-//tapirs technologies//EN' . $eol . 'VERSION:2.0' . $eol . 'CALSCALE:GREGORIAN' . $eol;

    for ($row = 2; $row <= $highestRow; ++$row) {
        for ($col = 1; $col <= $highestColumnIndex; ++$col) {
            $value = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
            if($value != "") {
              if(isMonth($value)) {
                $currentMonth = trim($value);
              } elseif (isDate($value)) {

                $reg_exp = '@\d+@im';
                preg_match_all($reg_exp, $value, $matches, PREG_SET_ORDER, 0);

                #var_dump($matches);
                $currentDay = $matches[0][0];
                #echo $currentDay . "<BR>";

              } elseif (isTime($value)) {
                $currentTime = $value;
              }else {
                if($currentTime == '') {
                  $currentDateTime = date_create($currentDay . " " . $currentMonth . " " . $currentYear);
                } else {
                  $currentDateTime = date_create($currentDay . " " . $currentMonth . " " . $currentYear . " " . $currentTime);
                }

                if(strlen($value) > 50) {
                  $value = substr_replace($value, "\r\n ", 50, 0);
                }

                $calendar = $calendar . 'BEGIN:VEVENT' . $eol;
                $calendar = $calendar . 'UID:' . date('Ymd\THis') . '-' . rand(10000, 99999) . '@tapirs-technologies.co.uk' . $eol;
                $calendar = $calendar . 'DTSTAMP:' . date('Ymd\THis') . $eol;
                $calendar = $calendar . 'SUMMARY:' . $value . $eol;
                $calendar = $calendar . 'DTSTART; TZID=' . $currentTimeZone . ':' . date_format($currentDateTime, "Ymd\THis") . $eol;
                if($currentTime != '') {
                    $calendar = $calendar . 'DTEND; TZID=' . $currentTimeZone . ":" . date_format(date_add($currentDateTime, date_interval_create_from_date_string("30 minutes")), "Ymd\THis") . $eol;
                }
                $calendar = $calendar . 'DESCRIPTION:' . $value . $eol;
                $calendar = $calendar . 'BEGIN:VALARM' . $eol;
                $calendar = $calendar . 'TRIGGER:-P1D' . $eol;
                $calendar = $calendar . 'DESCRIPTION:' . $value . $eol;
                $calendar = $calendar . 'ACTION:DISPLAY' . $eol;
                $calendar = $calendar . 'END:VALARM' . $eol;
                $calendar = $calendar . 'END:VEVENT' . $eol;

                $currentTime = '';
              }
            }
        }
    }

    $calendar = $calendar . 'END:VCALENDAR';

    unset($filename);
    if(unlink($filename)) {
     echo "file deleted";
   } else {
     echo "file not removed";
   }



    echo $calendar;
  }
?>
