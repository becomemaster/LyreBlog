<?php
class LeaveController extends Controller{
    private $msgs;
    private $LeaveModel;
    public function __construct(){
        parent::__construct();
        $this->LeaveModel=new LeaveModel();
        if(empty($_SESSION['USER'])){
            $this->ShowMessageAction('danger','登录后才可以管理自己的留言 :)','/index.php?p=home&c=Login');
        }
    }


    public function IndexAction(){
        $current_user=$_SESSION['USER'];
        $this->msgs=$this->LeaveModel->getUserMSG($current_user);
        $site=$this->site; //返回站点信息
        $reg_users=$this->reg_users;//返回用户数目
        $page_num=$this->page_num;//返回文章数目
        $page_type=$this->page_type;//返回文章类别
        $user=$this->user;//返回当前用户
        $login=$this->login;//返回登录状态
        $page_type=$this->page_type;//返回文章类别
        $msgs=$this->msgs;
        require __VIEW__.'/usermsg.html';

    }
    public function delAction(){
        $this->IndexAction();
        if(isset($_GET['del']) && is_numeric($_GET['del'])){
            $del=intval($_GET['del']);
            $username=$_SESSION['USER'];
            if($this->LeaveModel->DelMsg($del,$username)){
                $this->ShowMessageAction('success','删除成功！','index.php?p=home&c=Leave');
            }else{
                $this->ShowMessageAction('danger','删除失败！','index.php?p=home&c=Leave');
            }
        }
    }


}