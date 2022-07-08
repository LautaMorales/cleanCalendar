<?php

require_once('view/calendarView.php');
require_once('model/eventModel.php');
require_once('model/calendarModel.php');

class calendarController {

    function __construct() {
        $this->view = new calendarView();
        $this->eventModel = new eventModel();
        $this->calendarModel = new calendarModel();
    }

    function home() {
        //gets first calendar in table and events on current month
        $dayArray = $this->getDayArray();

        //timey stuff
        $daysInMonth = date('t');
        $currentMonth = date('m');

        //calendar get got
        $calendar = $this->calendarModel->getFirstCalendar();
        $calendarNames = $this->calendarModel->getCalendarNames();
        $events = $this->eventModel->getEventsByMonth($calendar->calendar_id, $currentMonth);

        $eventDays = array();

        foreach ($events as $event) {
            $day = DateTime::createFromFormat('Y-m-d', $event->start_date)->format('d');
            $eventDays[$day] = $event->color;
            //array_push($eventDays, DateTime::createFromFormat('Y-m-d', $event->start_date)->format('d'), $event->color);
        }

        $this->view->assignCalendarNamesSelect($calendarNames);
        
        $this->buildCalendarStructure($calendar, $events, $daysInMonth, $eventDays);
    }

    function test($calendarName, $month) {
        $dayArray = $this->getDayArray();
        $calendar = $this->calendarModel->getCalendar($calendarName);
        $events = $this->eventModel->getEventsByMonth($calendar->calendar_id, $month);
    }

    function getDayArray() {
        return array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');
    }

    function buildCalendarStructure($calendar, $events, $daysInMonth, $eventDays) {
        $dayArray = $this->getDayArray();
        $this->view->renderCalendar(2, $daysInMonth, $dayArray, $events, $calendar, $eventDays);
    }

}

?>