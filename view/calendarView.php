<?php

require_once('libs/Smarty.class.php');

class calendarView {

    //start up smarty
    function __construct() {
        $this->smarty = new Smarty();
        $this->smarty->assign('basehref', BASE_URL);
    }

    function assignCalendarNamesSelect($calendars) {
        $this->smarty->assign('calendars', $calendars);
    }

    function assignEvents($events) {
        $this->smarty->assign('events', $events);
    }

    function renderCalendar($firstDayOffset, $daysInMonth, $dayArray, $calendar, $eventDays) {
        $this->smarty->assign('calendar', $calendar);
        $this->smarty->assign('eventDays', $eventDays);
        $this->smarty->assign('dayArray', $dayArray);
        $this->smarty->assign('calOffset', $firstDayOffset);
        $this->smarty->assign('monthDays', $daysInMonth);
        $this->smarty->display('templates/calendar.tpl');
    }
}

?>