<?php

class eventModel {

    function __construct() {
        $this->db = new PDO('mysql:host=localhost;'
                    .'dbname=clean_calendar;charset=utf8'
                    ,'root','');
    }

}

?>