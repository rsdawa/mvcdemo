<?php
require_once "./Base/ModelFactory.class.php";
require_once "./Base/BaseController.class.php";
$c = !empty($_GET['c']) ? ($_GET['c']) : 'User';
require_once "./Models/{$c}Model.class.php";
require_once "./Controllers/{$c}Controller.class.php";

$c_name     = $c . 'Controller';
$controller = new $c_name();
$action     = !empty($_GET['a']) ? $_GET['a'] : "Index";
$controller->$action();
