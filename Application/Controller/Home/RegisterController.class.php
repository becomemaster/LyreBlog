<?php
class RegisterController extends Controller
{
    private $RegisterModel;

    public function __construct()
    {
        $this->RegisterModel = new RegisterModel();
    }

    public function __call($argv, $argvs)
    {
        //魔术方法  在类被实例化后 调用了类中不存在的方法时 自动运行
    }

    public function RegisterUserAction()
    {
        @session_start();
        if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['code'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $code = $_POST['code'];
           if ($code != $_SESSION['code']) {
             $this->ShowMessageAction('danger', '验证码错误!!', '/?p=home&c=Login');
          }
            if (empty($username) || empty($password)) {
                $this->ShowMessageAction('danger', '用户名或密码为空!!', '/?p=home&c=Login');
                die;
            }
            $username = $this->RegisterModel->ConvertStrAction($username);
            $password = md5($this->RegisterModel->ConvertStrAction($password));
            if($this->RegisterModel->RegisterUserAction($username, $password)){
                $this->RegisterModel->UpdateLoginTimeAction($username);
                $this->ShowMessageAction('success', '注册成功！', '/?p=home&c=Login');
            }else{
                $this->ShowMessageAction('danger','用户名已存在！注册失败！ 请更换用户名~ :)','/?p=home&c=Register');
            }

        } else
            $this->ShowMessageAction('danger', '参数不完整', '/?p=home&c=Login');
    }


    public function __destruct()
    {
        require __VIEW__ . 'register.html';

    }

}