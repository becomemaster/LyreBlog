<?php
class ShowPageController extends PageController{
    private $page_time;  //用来暂时存储文章发表时间
    private $page_msg;  //用来暂时存储文章留言资源

    /**
     * 查询文章内容
     */
    public function ShowPageAction()  //查询文章内容
    {
        $pageid = isset($_GET['page']) && intval($_GET['page']) && $_GET['page']>0?intval($_GET['page']):NULL; //获取文章ID
        if(empty($pageid)){$this->ShowMessage('danger','亲，请误非法访问！','/index.php');}
        $this->pageinfo=$this->PageModel->GetPageinfoAction($pageid); //获取文章内容
        $this->page_time = date("Y-m-d",$this->pageinfo['Page_time']); //把时间戳转换为时间并且暂时存储
        $this->PageModel->upPage_num($pageid);
        $this->GetPageMsgAction($pageid); //获取此文章的所有留言

    }

    /**
     * @param $fun_name
     * @param $fun_args
     */
    public function __call($fun_name,$fun_args)  //如果方法不存在，则提示消息
    {
        $this->ShowMessage('danger','参数丢失！','index.php');
    }

    /**
     * 获取所有留言
     * @param $pageid
     */
    private function GetPageMsgAction($pageid) //获取所有留言
    {
        $this->page_msg=$this->PageModel->GetPageMsgAction($pageid);
    }


   /* public function AddMsgAction()
    {

        if(isset($_POST['email']) && isset($_POST['msg']))
        {
            echo $_GET['page'];
            $email=$_POST['email'];
            $msg=$_POST['msg'];
            $email=$this->UserModel->ConvertStrAction($email);
            $msg=$this->UserModel->ConvertStrAction($msg);
        }


    }
   */

    /**
     *销毁对象时将结果返回给模板 并且输出
     */
    public function __destruct()
    {
        $site=$this->site; //返回站点信息
        $reg_users=$this->reg_users;//返回用户数目
        $page_num=$this->page_num;//返回文章数目
        $page_type=$this->page_type;//返回文章类别
        $user=$this->user;//返回当前用户
        $login=$this->login;//返回登录状态
        $page_type=$this->page_type;//返回文章类别
        $page=$this->pageinfo; //返回文章内容
        $page_time=$this->page_time; //返回文章时间
        $page_msg=$this->page_msg; //返回当前文章留言
        require __VIEW__.'/show.html';

    }

}