<?php
header("content-type:text/html;charset=utf-8");
class Session
{
    /*
    session表设计：

    create table session(
    sess_id varchar(50) primary key,
    sess_data text comment 'session数据',
    sess_time int comment '时间，用int类型存储为时间戳'
    )charset utf8;
     */
    static $pdo = null;
    public function __construct()
    {
        //自定义session回收机制

        ini_set("session.gc_probability", 1); //随着新访问的回收概率1/2
        ini_set("session.gc_divisor", 2);
        ini_set("session.gc_maxlifetime", 1440); //超过20秒即超时回收

        /*
        session自定义存储
        该函数一次性设定6个函数名，分别代表session运行时要做的6个事情：
        开始、结束、读、写、删除、回收
        函数名可以自己定，但每个函数名，也都必需要去定义对应函数。
         */
        ini_set("session.save_handler", "user");
        //在类（对象）中，应该用如下形式定义6个方法:
        session_set_save_handler(
            array($this, "sessBegin"),
            array($this, "sessEnd"),
            array($this, "sessRead"),
            array($this, "sessWrite"),
            array($this, "sessDelete"),
            array($this, "sessGc")
        );

        $dsn       = "mysql:host=localhost;port=3306;dbname=php39";
        $opt       = array(PDO::MYSQL_ATTR_INIT_COMMAND => "set names utf8");
        self::$pdo = new pdo($dsn, "root", "root", $opt);
    }

    public function sessBegin()
    {
        //echo "<p>session 开始...</p>";
    }
    public function sessEnd()
    {
        //echo "<p>session 结束...</p>";
    }

    public function sessRead($session_id) //系统会自动传入要读取的sessionid

    {
        //echo "<p>读取sessionID=[$session_id]的数据库内容</p>";

        $data   = "";
        $sql    = "select sess_data from session where sess_id='$session_id'";
        $result = self::$pdo->query($sql); //pdo的结果集
        if ($result) {
            $data = $result->fetchColumn();
        }
        return $data;
    }
    //将当前session数据，以session_id的名字存入文本文件
    //系统会自动传入要写入的sessionid及session值
    public function sessWrite($session_id, $session_data)
    {
        //echo "<p>将session内容写入数据库</p>";
        $t1  = time();
        $sql = "replace into session (sess_id,sess_data,sess_time)";
        $sql .= " values ('$session_id','$session_data',$t1)";
        //上述replace into语句，如果该session存在就先删除，再插入。如果不存在，就直接插入。
        self::$pdo->exec($sql);
    }
    //系统会自动传入要删除的sessionid
    public function sessDelete($session_id)
    {
        //echo "<p>删除了session:{$session_id}</p>";
        $sql = "delete from session where sess_id='$session_id'";
        self::$pdo->exec($sql);
    }
    //自定义回收
    //系统会自动传入最大的超时时间
    //$maxlifetime其实就是php.ini中的session.gc_lifemaxtime
    public function sessGc($maxlifetime)
    {
        //echo "<p style='color:red'>session进行了一次回收。</p>";
        $sql    = "delete from session where now()-sess_time>$maxlifetime";
        $result = self::$pdo->exec($sql);
    }
}
