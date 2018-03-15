<?php

  function isMonth($value) {
    $reg_exp = '@(january|february|march|april|may|june|july|august|september|october|november|december)@im';
    if(preg_match($reg_exp, $value) == true) {
      return true;
    }
    return false;
  }

  function isDate($value) {
    $reg_exp = '@(sun|mon|tues|wed|thurs|fri|sat)\s+\d+@im';
    if(preg_match($reg_exp, $value) == true) {
      return true;
    }
    return false;
  }

  function isTime($value) {
    $reg_exp = '@\d+\.\d{2}\s+(am|pm)@im';
    if(preg_match($reg_exp, $value) == true) {
      return true;
    }
    return false;
  }

 ?>
