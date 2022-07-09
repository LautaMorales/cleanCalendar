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
        //timey stuff
        $daysInMonth = date('t');
        $currentMonth = date('m');

        //calendar get got
        $calendar = $this->calendarModel->getFirstCalendar();
        $calendarNames = $this->calendarModel->getCalendarNames();
        $events = $this->eventModel->getEventsByMonth($calendar->calendar_id, $currentMonth);
        
        $eventDays = $this->getEventDaysArray($events);

        $this->view->assignCalendarNamesSelect($calendarNames);
        $this->view->assignEvents($events);
        
        $this->buildCalendarStructure($calendar, $daysInMonth, $eventDays);
    }

    function buildCalendarStructure($calendar, $daysInMonth, $eventDays) {
        $dayArray = $this->getDayArray();
        $this->view->renderCalendar(2, $daysInMonth, $dayArray, $calendar, $eventDays);
    }

    private function getEventDaysArray($events) {
        $eventDays = array();
        foreach ($events as $event) {
            $day = DateTime::createFromFormat('Y-m-d', $event->start_date)->format('d');
            if (!isset($events[$day]))
                $eventDays[$day] = $event->color;
        }
        return $eventDays;
    }

    private function getDayArray() {
        return array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');
    }

}

?>