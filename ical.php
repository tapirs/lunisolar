<?php

  require_once 'common.php';
  require_once 'vendor/autoload.php';
  require_once 'icalendar.php';

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
    header("Content-Disposition: inline; filename=$calendarFilename.ics");
    header("Content-Transfer-Encoding: binary");

    $calendar = new icalendar();

    $calendar->setCalendarName($calendarFilename);
    $calendar->setSequenceNumber($filename);

    for ($row = 2; $row <= $highestRow; ++$row) {
        for ($col = 1; $col <= $highestColumnIndex; ++$col) {
            $value = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
            if($value != "") {
              if(isMonth($value)) {
                $calendar->setCurrentMonth($value);
              } elseif (isDate($value)) {
                $calendar->setCurrentDay($value);
              } elseif (isTime($value)) {
                $calendar->setCurrentTime($value);
              } elseif (trim($value) == "AM") {
                $calendar->setCurrentTime("8.30 AM");
              } elseif (trim($value) == "PM") {
                $calendar->setCurrentTime("12.00 PM");
              } elseif (trim($value) == "time tbc") {
                $calendar->setCurrentTime("8.30 AM");
              } else {
                $calendar->addEvent($value);
              }
            }
        }
    }

    echo $calendar->getCalendarString();


  }
?>
