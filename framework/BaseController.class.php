<?php
class BaseController
{
    public function __construct()
    {
        header("content-type:text/html;charset=utf-8");
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
