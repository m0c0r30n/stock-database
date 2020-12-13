<?php

namespace App\Lib;
use Carbon\Carbon;

class EventFunction
{
  public static function getCurrentDate()
  {
    $current_date = new Carbon();
    return $current_date;
  }

  public static function makeCalendar()
  {
    $current_date = EventFunction::getCurrentDate();
    $start_add_day = 6 - $current_date->copy()->startOfMonth()->dayOfWeek;
    $last_add_day = 6 - $current_date->copy()->endOfMonth()->dayOfWeek;

    $current_date->copy()->startOfMonth()->subDay($start_add_day);

  }


}
