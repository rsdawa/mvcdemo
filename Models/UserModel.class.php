<?php
require_once './Base/BaseModel.class.php';
class UserModel extends BaseModel
{
    public function getAllUser()
    {
        //$db     = MySQLDB::getDB($this->conf);
        $sql    = "select * from user_list order by user_id desc";
        $result = $this->db->getRows($sql);
        return $result;
    }
    public function getAllUserCount()
    {
        //$db  = MySQLDB::getDB($this->conf);
        $sql = "select count(*) from user_list";
        $sum = $this->db->getOneData($sql);
        return $sum;
    }
    public function getOneUser($id)
    {
        //$db     = MySQLDB::getDB($this->conf);
        $sql    = "select * from user_list where user_id=$id";
        $result = $this->db->getOneRow($sql);
        return $result;
    }
    public function deleteUser($id)
    {
        //$db     = MySQLDB::getDB($this->conf);
        $sql    = "delete from user_list where user_id=$id";
        $result = $this->db->exec($sql);
        return $result;
    }
    public function insertUser($arr)
    {
        //var_dump($arr);
        $sql = "insert into user_list (user_name,user_pass,age,edu,xingqu,`from`,reg_time)";
        $sql .= "values ('{$arr['username']}','{$arr['password']}',{$arr['age']},'{$arr['xueli']}','{$arr['aihao']}','{$arr['from']}',now())";
        $result = $this->db->exec($sql);
        return true;
    }
    public function updateUser($arr)
    {
        $sql    = "update user_list set user_name='{$arr['username']}',user_pass='{$arr['password']}',age={$arr['age']},edu='{$arr['xueli']}',xingqu='{$arr['aihao']}',`from`='{$arr['from']}',reg_time=now() where user_id={$arr['user_id']}";
        $result = $this->db->exec($sql);
        return true;
    }
}
