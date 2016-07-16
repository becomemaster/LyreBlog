<?php

/**登录控制器
 * Class LoginController
 */
class LoginController extends Controller{
    private $LoginModel; //登录模型
    private $AdminModel; //管理员模型

    public function __construct()
    {
       // parent::__construct(); //检查登录
        $this->LoginModel=new LoginModel(); //实例化登录模型
        $this->AdminModel=new AdminModel(); //实例化管理员模型

    }

    public function CheckLoginAction() //检查登录函数
    {
       session_start(); //开启Session


        //获取用户名和密码
        if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['code'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $code = $_POST['code'];
            if ($_SESSION['code'] =! $code) {
                $this->ShowMessageAction('danger', '验证码错误!!', '?p=admin&c=Login'); //判断验证码是否正确
            }
            if (empty($username) || empty($password)) {
                $this->ShowMessageAction('danger', '用户名或密码为空!!', '?p=admin&c=Login'); //判断账号或密码是否为空
                die;
            }

            $this->CheckLoginName($username,$password); //检查登录
        }else{
            $this->ShowMessageAction('danger', '参数不完整', '?C=Login');
        }
    }



    private function CheckLoginName($username,$password){  //检查登录函数
        $username = $this->LoginModel->ConvertStrAction($username); //过滤
        $password = md5($this->LoginModel->ConvertStrAction($password)); //过滤
        $status=$this->LoginModel->CheckLoginAction($username,$password); //调用模型 检查登录
        if($status !=1 ){$this->ShowMessageAction('danger','用户名或密码错误！','/?p=admin&c=Login');} //提示错误
        unset($_SESSION['code']); //销毁验证码
        $_SESSION['ADMIN']=$username; //设置Session
        $this->AdminModel->UpdateLoginTimeAction($username); //更新登录时间
        $this->ShowMessageAction('success','登录成功！ Admin','?p=admin&c=Index'); //成功跳转

    }

    public function __call($func_name,$func_args)  //防止访问未知方法
    {

    }

    public function LogoutAction() //注销函数
    {
        session_start();  //开启Session
        unset($_SESSION['ADMIN']); //销毁Session
        session_destroy(); //调回session
        $this->ShowMessageAction('success','注销成功!!','index.php'); //提示注销成功

    }

    public function __destruct()
    {
        require __VIEW__.'login.html'; //引入模板文件
    }








}