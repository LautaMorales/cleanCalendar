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

    function getCalendarAndEvents($params = null) {
        //checking for calendar name
        if (isset($_POST['calendar-select'])) {
            $cal_name = $_POST['calendar-select'];
            $calendar = $this->calendarModel->getCalendar($cal_name);
        } else
            $calendar = $this->calendarModel->getFirstCalendar();
        //checking for month and year
        if (isset($params[0]) && $params[0] < 13 && $params[0] > 0) {
            $month = DateTime::createFromFormat('n', $params[0])->format('m');
        } else
            $month = date('m');
        if (isset($params[1]) && $params[1] < 2100 && $params[1] > 1900) {
            $year = $params[1];
        } else
            $year = date('Y');

        //days in month and how many empty cells I need
        $daysInMonth = date('t');           
        $offset = DateTime::createFromFormat('d-m-Y', '1'.'-'.$month.'-'.$year)->format('N');
        if ($offset >= 7)
            $offset -= 7;        
        
        $events = $this->eventModel->getEventsByMonth($calendar->calendar_id, $month, $year);
        $calendarNames = $this->calendarModel->getCalendarNames();
        $eventDays = $this->getEventDaysArray($events);
        
        $this->view->assignCalendarNamesSelect($calendarNames);
        $this->view->assignEvents($events);

        
        $this->buildCalendarStructure($offset, $calendar, $daysInMonth, $eventDays);
        
    }

    function buildCalendarStructure($offset, $calendar, $daysInMonth, $eventDays) {
        $dayArray = $this->getDayArray();
        $this->view->renderCalendar($offset, $daysInMonth, $dayArray, $calendar, $eventDays);
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
        return $dayArray = array( 'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');
        // while ($dayArray[0] != $firstDayOfTheMonth) {
        //     array_unshift($dayArray, array_shift($dayArray));
        // }
        // return $dayArray;
    }

}

?>