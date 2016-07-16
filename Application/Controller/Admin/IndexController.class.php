<?php

/**
 * Class IndexController 主页模型
 */
class IndexController extends Controller{



    public function ShowAction()
    {

    }

    public function __call($func_name,$fun_args) //默认调用ShowAction函数
    {
        $this->ShowAction();
    }
    
    public function __destruct()
    {
        parent::__construct(); //检查登录
        $site=$this->site; //站点信息
        $reg_users=$this->reg_users; //注册用户数目
        $page_num=$this->page_num; //文章数目
        require __VIEW__.'index.html'; //引入主页
    }

    public function LogoutAction() //注销函数
    {
        session_destroy(); //清理Session
        $this->ShowMessageAction('success','注销成功!!','/index.php'); //跳转到首页
    }


}