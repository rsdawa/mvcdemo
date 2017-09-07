<?php

class BaseController
{
    public function __construct()
    {
        header("content-type:text/html;charset=utf-8");
        //这是session对象，并不需要我们用它来调用它的那些方法，所以无需赋值给一个变量
        new Session(); //设定了session的处理机制是我们自己的数据库
        session_start(); //启动session
    }
    /*
    提供一个可实现简短信息并自动跳转的功能
    $msg:显示消息
    $time:跳转等待时间
     */
    protected function MsgAndGo($msg, $url, $time = 3)
    {
        echo "<h1>$msg</h1>";
        //也可以制作专门视图页来显示信息
        //include './show_msg.html';
        header("refresh:$time;url=$url");
    }
}
