<?php
class UserController extends Controller{

    private $Model;
    private $UserModel;


    public function __construct()
    {
        parent::__construct();
        $this->Model=new Model();
        $this->UserModel=new UserModel();

    }

    public function DelUserAction()
    {
        if(isset($_GET['del_uid'])) {
            $del = intval($_GET['del_uid']) && $_GET['del_uid'] > 0 && $_GET['del_uid'] ? intval($_GET['del_uid']) : NULL;
            if (empty($del)) {
                $this->ShowMessageAction('danger', '操作错误！', '?p=admin&c=Index');
            }
            $this->UserModel->DelUser($del);
            $this->ShowMessageAction('success','删除成功！','?p=admin&c=Index');
        }

    }

   public function UserManagerAction()
   {

   }

    public function AddUserAction()
    {
        $site=$this->site;
        $reg_users=$this->reg_users;
        $page_num=$this->page_num;
        $users=$this->users;
        require __VIEW__.'adduser.html';
        exit;
    }

    public function __destruct()
    {

        $site=$this->site;
        $reg_users=$this->reg_users;
        $page_num=$this->page_num;
        $users=$this->users;
        require __VIEW__.'user.html';

    }

}