<?php
class LoginController extends Controller{

    private $LoginModel;
    private $UserModel;
    public function __construct()
    {
        session_start();
        $this->LoginModel=new LoginModel();
        $this->UserModel=new UserModel();

    }

    public function LoginAction()
    {

        require __VIEW__.'login.html'; //引入登录的界面
    }

    public function RegisterAction()
    {
        require __VIEW__.'register.html';
    }

    public function __call($func_name,$func_args)
    {
        $this->LoginAction();
    }

    public function CheckLoginAction()
    {
        if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['code'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $code = $_POST['code'];
            if ($code != $_SESSION['code']) {
                $this->ShowMessageAction('danger', '验证码错误!!', '/?p=admin&c=Login');
            }
            if (empty($username) || empty($password)) {
                $this->ShowMessageAction('danger', '用户名或密码为空!!', '/?C=Login');
                die;
            }
            $this->CheckLoginName($username, $password);
            //为真的时候
        }
    }

    private function CheckLoginName($username,$password)
    {
        $username = $this->LoginModel->ConvertStrAction($username);
        $password = md5($this->LoginModel->ConvertStrAction($password));
        $status=$this->LoginModel->CheckLoginAction($username,$password);
        if($status !=1 ){$this->ShowMessageAction('danger','用户名或密码错误！','/?&p=home&c=Login');}
        unset($_SESSION['code']);
        $_SESSION['USER']=$username;
        $this->UserModel->UpdateLoginTimeAction($username);
        $this->ShowMessageAction('success','登录成功！','index.php');
    }


    public function LogoutAction()
    {
        session_destroy();
        $this->ShowMessageAction('success','注销成功!!','/index.php');
    }



}