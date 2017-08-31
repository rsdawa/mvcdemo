<?php
class IndexController extends BaseController
{
    public function Index()
    {
        $M    = ModelFactory::M("IndexModel");
        $data = $M->GetHello();
        include VIEW_PATH . 'login.html';
    }

    public function CheckLogin()
    {
        //1.获取表单信息（用户名、密码）
        $user = $_POST['username'];
        $pass = $_POST['password'];

        //2.调用模型进行验证
        $model  = ModelFactory::M("IndexModel");
        $result = $model->CheckLogin($user, $pass);
        //3.返回结果
        if ($result) {
            echo '<h1>欢迎进入管理后台</h1>';
        } else {
            $this->MsgAndGo('用户名和密码不匹配', '?m=Back&c=Index');
        }
    }
}
