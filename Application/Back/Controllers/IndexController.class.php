<?php
class IndexController extends BaseController
{
    public function login()
    {
        $M = ModelFactory::M("IndexModel");
        //查看用户名有没有写入cookie，并传给登录表单显示
        $cookie_user = !empty($_COOKIE['user_name']) ? $_COOKIE['user_name'] : '';
        include VIEW_PATH . 'login.html';
    }

    public function checkLogin()
    {
        //1.获取表单信息（用户名、密码）
        $user = $_POST['username'];
        $pass = $_POST['password'];

        //2.调用模型进行验证
        $model  = ModelFactory::M("IndexModel");
        $result = $model->checkLogin($user, $pass);
        //3.返回结果
        if ($result) {

            $_SESSION['isLogin'] = 'OK';

            //在用户浏览器中存储用户名，下次登录自动输入
            setcookie('user_name', $user, time() + 7 * 24 * 3600, "/");
            $this->MsgAndGo('登录成功,3秒后跳转后台首页...', '?m=Back&c=Index&a=index');
        } else {
            $this->MsgAndGo('用户名和密码不匹配', '?m=Back&c=Index&a=login');
        }
    }
    public function index()
    {
        //session判断
        if (!empty($_SESSION['isLogin']) && $_SESSION['isLogin'] == 'OK') {
            include VIEW_PATH . 'index.html';
        } else {
            $this->MsgAndGo('请先登录,3秒后跳转登录页...', '?m=Back&c=Index&a=login');
        }

    }
    public function top()
    {
        include VIEW_PATH . 'top.html';
    }
    public function main()
    {
        include VIEW_PATH . 'main.html';
    }
    public function menu()
    {
        include VIEW_PATH . 'menu.html';
    }
    public function drag()
    {
        include VIEW_PATH . 'drag.html';
    }
    public function logOut()
    {
        session_destroy();
        header("location:?m=Back&c=Index&a=login");
    }
}
