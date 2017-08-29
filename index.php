<?php
require_once "./Framework/ModelFactory.class.php";
require_once "./Framework/BaseController.class.php";
//模块变量
$m = !empty($_GET['m']) ? ($_GET['m']) : 'Front';
//控制器变量
$c = !empty($_GET['c']) ? ($_GET['c']) : 'User';

$modelPath      = "./Application/{$m}/Models/{$c}Model.class.php";
$controllerPath = "./Application/{$m}/Controllers/{$c}Controller.class.php";

if (!file_exists($modelPath) || !file_exists($controllerPath)) {
    header("content-type:text/html;charset=utf-8");
    echo "控制器不存在!";
    die();
}

require_once $modelPath;
require_once $controllerPath;

$c_name     = $c . 'Controller';
$controller = new $c_name();
$action     = !empty($_GET['a']) ? $_GET['a'] : "Index";
$controller->$action();
