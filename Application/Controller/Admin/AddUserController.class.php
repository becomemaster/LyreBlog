<?php
class AddUserController extends Controller
{
    public $AddUserModel; //添加用户模型

    public function __construct()
    {
        parent::__construct(); //检查用户登录
        $this->AddUserModel=new AddUserModel(); //实例化添加用户模型
    }

    public function __call($fun_name,$fun_args)
    {
        $this->AddNewUserAction(); //若没有明确方法，则自动调用添加用户函数
    }

    public function AddNewUserAction()  //添加用户函数
    {
        if(isset($_POST['username']) && isset($_POST['password'])){
          $username = $_POST['username']; //获取用户名
          $password = $_POST['password']; //获取密码
          $username = $this->AddUserModel->ConvertStrAction($username);//过滤安全
          $password = md5($this->AddUserModel->ConvertStrAction($password)); //过滤安全
          $this->AddUserModel->AddUserAction($username,$password); //调用添加用户模型函数
          $this->ShowMessageAction('success','添加用户成功！','?p=admin&c=AddUser'); //提示添加成功并跳转到首页
        }

    }

    public function __destruct() //析构函数
    {
        $site=$this->site; //站点信息
        $reg_users=$this->reg_users; //注册用户
        $page_num=$this->page_num; //文章数目
        $users=$this->users; //所有用户
        require __VIEW__.'adduser.html'; //引入模板

    }

}