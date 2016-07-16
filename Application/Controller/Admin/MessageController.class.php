<?php
class MessageController extends Controller{
    private $MessageModel; //留言模型
    public function __construct()
    {
        parent::__construct(); //检查登录
        $this->MessageModel=new MessageModel(); //实例化留言模型

    }

    public function __call($func_name,$func_args) //访问未知方法时调用如下代码
    {
        $site=$this->site; //站点信息
        $reg_users=$this->reg_users; //注册用户数目
        $page_num=$this->page_num; //文章数目
        $users=$this->users; //用户信息
        $msg=$this->MessageModel->GetMsg(); //获取所有留言（评论）
        require __VIEW__.'message.html'; //引入模板文件

    }

    public function DelMsgAction()  //删除留言
    {
        if(isset($_GET['del'])) {  //获取留言ID
            $del = intval($_GET['del']) && $_GET['del'] > 0 ? intval($_GET['del']) : null;
            if (empty($del)) {
                $this->ShowMessageAction('danger', '操作错误！', '?p=admin&c=Index');
            }

            $this->MessageModel->Del_msg($del);  //删除留言

            $this->ShowMessageAction('success','删除成功！','?p=admin&c=Index');
    }




    }



}