<?php
class IndexModel extends BaseModel
{
    public function GetHello()
    {
        return "欢迎来到后台";
    }

    public function CheckLogin($user, $pass)
    {
        $sql    = "select count(*) as c from user_list where user_name='$user' and user_pass='$pass'";
        $result = $this->db->getOneData($sql);
        if ($result == 1) {
            return true;
        } else {
            return false;
        }

    }
}
