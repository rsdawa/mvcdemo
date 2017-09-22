<?php
header("content-type:text/html;charset=utf-8");
//模块变量
$m = !empty($_GET['m']) ? ($_GET['m']) : 'Front';
//控制器变量
$c = !empty($_GET['c']) ? ($_GET['c']) : 'User';

$modelPath      = "./Application/{$m}/Models/{$c}Model.class.php";
$controllerPath = "./Application/{$m}/Controllers/{$c}Controller.class.php";
if (!file_exists($controllerPath)) {

    echo "<b>`{$c}Controller.class.php`</b>控制器不存在!";
    die();
}
/*
if (!file_exists($modelPath)) {

echo "<b>`{$c}Model.class.php`</b>模型不存在!";
die();
}
//*/

//为了简化代码，定义常量
define("DS", DIRECTORY_SEPARATOR); //DIRECTORY_SEPARATOR表示目录分隔符，'/'或'\'
define("ROOT", __DIR__ . DS); //用root常量表示当前index.php页面所在的绝对路径
define("PLAT", $m); //当前平台名（模块）
define("PLAT_PATH", ROOT . 'Application' . DS . PLAT . DS); //当前平台（模块）目录
define("CTRL_PATH", PLAT_PATH . 'Controllers' . DS); //当前控制器目录
define("MODEL_PATH", PLAT_PATH . 'Models' . DS); //当前模型目录
define("VIEW_PATH", PLAT_PATH . 'Views' . DS); //当前视图目录
define("FRAME", ROOT . 'Framework' . DS); //框架公共目录
define("UPLOAD_PATH", "web/back/uploadFiles/"); //上传文件目录

//自动加载
function __autoload($name)
{
    //若干个mvc控制类
    $arr = array("MySQLDB", "BaseModel", "BaseController", "ModelFactory", "Session", "Upload", "ValidCode");
    if (in_array($name, $arr)) {
        require_once FRAME . "{$name}.class.php";
    } else if (substr($name, -5) == 'Model') {
        require_once MODEL_PATH . "{$name}.class.php";
    } else if (substr($name, -10) == 'Controller') {
        require_once CTRL_PATH . "{$name}.class.php";
    }
}
//控制器
$c_name     = $c . 'Controller';
$controller = new $c_name();
//方法
$action = !empty($_GET['a']) ? $_GET['a'] : "Index";
$controller->$action();
