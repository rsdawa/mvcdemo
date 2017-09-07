<?php

//单例工厂类，保证所产生的对象只有一份
class ModelFactory
{
    static $arr = array();
    public static function M($class_name)
    {
        if (empty($arr[$class_name])) {
            self::$arr[$class_name] = new $class_name();
        }
        return self::$arr[$class_name];
    }
}
