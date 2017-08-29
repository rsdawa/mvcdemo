<?php
class UserController extends BaseController
{
    //显示所有用户
    public function Index()
    {
        //$obj1   = new UserModel();
        $obj1   = ModelFactory::M("UserModel");
        $result = $obj1->getAllUser();
        $sum    = $obj1->getAllUserCount();
        include "./Views/userlist.html";
    }
    //显示单个用户
    public function Detail()
    {
        $obj1 = ModelFactory::M("UserModel");
        if (!empty($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            die();
        }
        $row = $obj1->getOneUser($id);
        include_once "./Views/userdetail.html";
    }
    //删除用户
    public function Delete()
    {
        $id  = $_GET['id'];
        $obj = ModelFactory::M("UserModel");
        $obj->deleteUser($id);
        $this->MsgAndGo("删除成功!", "?", 2);
    }
    //添加用户表单
    public function AddUser()
    {
        include './Views/user_form.html';
    }
    //添加用户方法
    public function InsertUser()
    {
        $arr          = $_POST;
        $arr['aihao'] = implode(',', $arr['aihao']);
        $obj          = ModelFactory::M("UserModel");
        $obj->insertUser($arr);
        $this->MsgAndGo("添加成功!", "?", 2);
    }
    //显示要修改的用户信息
    public function Modify()
    {
        $id   = $_GET['id'];
        $obj  = ModelFactory::M("UserModel");
        $user = $obj->getOneUser($id);
        //兴趣字符串转换成数组
        $xingqu = explode(',', $user['xingqu']);
        include "./Views/user_modify.html";

    }
    //更新数据库用户信息
    public function UpdateUser()
    {
        $arr          = $_POST;
        $arr['aihao'] = implode(',', $arr['aihao']);
        $obj          = ModelFactory::M("UserModel");
        $obj->updateUser($arr);
        $this->MsgAndGo("更新成功!", "?", 2);
    }

}
