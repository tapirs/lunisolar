<?php

  require_once 'common.php';
  require_once 'vendor/autoload.php';
  require 'icalendar.php';

  use PhpOffice\PhpSpreadsheet\Spreadsheet;

  if(isset($_POST['filename'])) {
    $filename = $_POST['filename'];

    $spreadSheet = readSpreadsheet($filename);

    $worksheet = getWorksheet($spreadSheet, 0);

    $highestRow = $worksheet->getHighestRow();
    $highestColumn = $worksheet->getHighestColumn();
    $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);

    $calendarFilename = getCalendarFilename($worksheet);

    header('Content-type: text/calendar');
    header("Content-Disposition: inline; filename=$calendarFilename");
    header("Content-Transfer-Encoding: binary");

    $calendar = new icalendar();

    for ($row = 2; $row <= $highestRow; ++$row) {
        for ($col = 1; $col <= $highestColumnIndex; ++$col) {
            $value = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
            if($value != "") {
              if(isMonth($value)) {
                $calendar->setCurrentMonth($value)
              } elseif (isDate($value)) {

                $reg_exp = '@\d+@i';
                preg_match_all($reg_exp, $value, $matches, PREG_SET_ORDER, 0);

                #var_dump($matches);
                $calendar->setCurrentDay($matches[0][0]);
                #echo $currentDay . "<BR>";

              } elseif (isTime($value)) {
                $calendar->setCurrentTime($value)
              }else {
                if($currentTime == '') {
                  $currentDateTime = date_create($calendar->getCurrentDay . " " . $calendar->getCurrentMonth . " " . $calendar->getCurrentYear);
                } else {
                  $currentDateTime = date_create($calendar->getCurrentDay . " " . $calendar->getCurrentMonth . " " . $calendar->getCurrentYear . " " . $calendar->getCurrentTime);
                }

                if(strlen($value) > 50) {
                  $value = substr_replace($value, "\r\n ", 50, 0);
                }

                $calendar = $calendar . 'BEGIN:VEVENT' . $eol;
                $calendar = $calendar . 'UID:' . date('Ymd\THis') . '-' . rand(10000, 99999) . '@tapirs-technologies.co.uk' . $eol;
                $calendar = $calendar . 'DTSTAMP:' . date('Ymd\THis') . $eol;
                $calendar = $calendar . 'SUMMARY:' . $value . $eol;
                $calendar = $calendar . 'DTSTART; TZID=' . $calendar->getCurrentTimeZone . ':' . date_format($currentDateTime, "Ymd\THis") . $eol;
                if($currentTime != '') {
                    $calendar = $calendar . 'DTEND; TZID=' . $calendar->getCurrentTimeZone . ":" . date_format(date_add($currentDateTime, date_interval_create_from_date_string("30 minutes")), "Ymd\THis") . $eol;
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

   //  unset($filename);
   //  if(unlink($filename)) {
   //   echo "file deleted";
   // } else {
   //   echo "file not removed";
   // }



    echo $calendar;


  }
?>
