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
        //防注入处理(三个函数):
        //addslashes()
        //mysql_real_escape_string()
        //$pdo->quote()
        $user      = addslashes($_POST['username']);
        $pass      = addslashes($_POST['password']);
        $validCode = addslashes($_POST['validCode']); //验证码

        //进行验证码判断
        if (strtoupper($validCode) != strtoupper($_SESSION['code'])) {
            $this->MsgAndGo('验证码错误', '?m=Back&c=Index&a=login');
            die();
        }

        //2.调用模型进行验证
        $model  = ModelFactory::M("IndexModel");
        $result = $model->checkLogin($user, $pass);
        //3.返回结果
        if ($result) {

            $_SESSION['isLogin'] = 'OK';
            $_SESSION['USER']    = $user;

            //在用户浏览器中存储用户名，下次登录自动输入
            setcookie('user_name', $user, time() + 7 * 24 * 3600, "/");
            //$this->MsgAndGo('登录成功,3秒后跳转后台首页...', '?m=Back&c=Index&a=index');
            header("location:?m=Back&c=Index&a=index");
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

    public function valid()
    {
        //定义验证码调用方法以使用session。
        //由于自定义session类，导致直接在验证码生成文件中写session无效
        //require_once './validCode.php';

        //调用验证码类
        $validCode = new ValidCode();
        $validCode->createCode(4); //参数为验证码位数
    }
}
