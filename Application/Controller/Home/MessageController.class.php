<?php
class MessageController extends Controller{
    private $PageModel;

    public function __construct(){
        $this->PageModel=new PageModel();
    }

    public function MessageAction()
    {
        @session_start();
        $pageid = isset($_GET['page']) && intval($_GET['page']) && $_GET['page']>0?intval($_GET['page']):NULL; //获取文章ID
        if(empty($pageid)){$this->ShowMessageAction('danger','亲，请误非法访问！','/index.php');}
        if(empty($_SESSION['USER'])){$this->ShowMessageAction('danger','请登录后再评论！','/index.php?p=home&c=Login');}
        if(isset($_POST['msg']) && isset($_POST['email']))
        {
            $msg=$this->PageModel->ConvertStrAction($_POST['msg']);
            $email=$this->PageModel->ConvertStrAction($_POST['email']);
            $username=isset($_SESSION['USER'])?$_SESSION['USER']:'匿名用户';
            $this->PageModel->AddMessage($username,$msg,$pageid,$email);
            $this->ShowMessageAction('success','留言成功！！','/index.php');
        }




    }




}