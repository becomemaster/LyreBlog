<?php
class ImageController extends Controller{
    private $ImageModel;
    private $imgs;
    public function __construct(){
        parent::__construct();
        if(!isset($_SESSION['USER'])){
            $this->ShowMessageAction('danger','登录后才可以查看相册！','/index.php?p=home&c=Login');
        }
        $this->ImageModel=new ImageModel();
        $this->imgs=$this->ImageModel->getUserimg();
    }

    public function ShowImgAction(){
        $site=$this->site; //返回站点信息
        $reg_users=$this->reg_users;//返回用户数目
        $page_type=$this->page_type;//返回文章类别
        $user=$this->user;//返回当前用户
        $login=$this->login;//返回登录状态
        $page_num=$this->page_num;//返回文章数目
        $imgs=$this->imgs;
        require __VIEW__.'image.html';

    }

    public function __call($a,$b){
        $this->ShowImgAction();

    }



}