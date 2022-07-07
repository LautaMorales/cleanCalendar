<?php

define('ACTION', 0);
define('PARAMS', 1);

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

require_once "config/ConfigApp.php";
require_once "controller/calendarController.php";


function parseURL($url)
{
  $urlExploded = explode('/', $url);
  $arrayReturn[ConfigApp::$ACTION] = $urlExploded[ACTION];
  $arrayReturn[ConfigApp::$PARAMS] = isset($urlExploded[PARAMS]) ? array_slice($urlExploded,1) : null;
  return $arrayReturn;
}

if(isset($_GET['action'])){
  $urlData = parseURL($_GET['action']);
  $action = $urlData[ConfigApp::$ACTION]; //Home
  if(array_key_exists($action,ConfigApp::$ACTIONS)){
    $params = $urlData[ConfigApp::$PARAMS];
    $action = explode('#',ConfigApp::$ACTIONS[$action]);
    $controller = new $action[0]();
    $metodo = $action[1];
    if(isset($params[0]) && $params[0] != null){
        echo $controller->$metodo($params);
    }else{
      echo $controller->$metodo();
    }
  }
}

 ?>