<?php

class eventModel {

    function __construct() {
        $this->db = new PDO('mysql:host=localhost;'
                    .'dbname=clean_calendar;charset=utf8'
                    ,'root','');
    }

    function getEvents($cal_id) {
        $query = $this->db->prepare('SELECT * FROM event WHERE event.calendar_id = ?');
        $query->execute([$cal_id]);
        $events = $query->fetchAll(PDO::FETCH_OBJ);
        return $events;
    }

    function getEventsByMonth($cal_id, $month) {
        $query = $this->db->prepare('SELECT * FROM event where event.calendar_id = ? AND extract(month FROM event.start_date) = ?');
        $query->execute(array($cal_id, $month));
        $events = $query->fetchAll(PDO::FETCH_OBJ);
        return $events;
    }

}

?>