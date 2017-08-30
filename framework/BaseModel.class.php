<?php
class BaseModel
{
    private $conf = array(
        "host"    => "localhost",
        "port"    => "3306",
        "user"    => "root",
        "pass"    => "root",
        "charset" => "utf8",
        "dbname"  => "php39",
    );
    protected $db;
    public function __construct()
    {
        $this->db = MySQLDB::getDB($this->conf);
    }
}
