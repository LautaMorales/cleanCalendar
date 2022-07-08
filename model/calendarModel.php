<?php

class calendarModel {

    function __construct() {
        $this->db = new PDO('mysql:host=localhost;'
        .'dbname=clean_calendar;charset=utf8'
        ,'root','');
    }

    function getFirstCalendar() {
        $query = $this->db->prepare('SELECT * FROM calendar LIMIT 1');
        $query->execute();
        $calendar = $query->fetch(PDO::FETCH_OBJ);
        return $calendar;
    }

    function getAllCalendars() {
        $query = $this->db->prepare('SELECT * FROM calendar');
        $query->execute();
        $calendars = $query->fetchAll(PDO::FETCH_OBJ);
        return $calendars;
    }

    function getCalendarNames() {
        $query = $this->db->prepare('SELECT name FROM calendar');
        $query->execute();
        $calendarNames = $query->fetchAll(PDO::FETCH_OBJ);
        return $calendarNames;
    }

    function getCalendar($cal_name) {
        $query = $this->db->prepare('SELECT * FROM calendar WHERE calendar.name = ?');
        $query->execute([$cal_name]);
        $calendar = $query->fetch(PDO::FETCH_OBJ);
        return $calendar;
    }

}