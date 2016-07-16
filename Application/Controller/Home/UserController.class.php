<?php
class UserController extends Controller{
    private $UserModel;

   public function __construct()
    {

        parent::__construct();
        $this->UserModel=new UserModel();
    }

    public function AddMsgAction()
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




}
