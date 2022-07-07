<?php

require_once('view/calendarView.php');
require_once('model/eventModel.php');

class calendarController {

    function __construct() {
        $this->view = new calendarView();
        $this->model = new eventModel();
    }

    function buildCalendarStructure() {
        $dayArray = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');
        $this->view->renderCalendar(1, 31, $dayArray);
    }

}

?>