<?php

require_once('libs/Smarty.class.php');

class calendarView {

    //start up smarty
    function __construct() {
        $this->smarty = new Smarty();
    }

    function renderCalendar($firstDayOffset, $daysInMonth, $dayArray) {
        $this->smarty->assign('dayArray', $dayArray);
        $this->smarty->assign('calOffset', $firstDayOffset);
        $this->smarty->assign('monthDays', $daysInMonth);
        $this->smarty->display('templates/calendar.tpl');
    }
}

?>