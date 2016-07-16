<?php
class SiteInfoController extends Controller{
    private $SiteInfoModel;
    public function __construct()
    {
        parent::__construct();
        $this->SiteInfoModel=new SiteInfoModel();
    }


    public function UpdateSiteInfoAction()
    {
        if(isset($_POST['site_name'])&&isset($_POST['site_user']) && isset($_POST['site_num']) && isset($_POST['site_info']))
        {
            $site_name=$this->SiteInfoModel->ConvertStrAction($_POST['site_name']);
            $site_user=$this->SiteInfoModel->ConvertStrAction($_POST['site_user']);
            $site_num=$this->SiteInfoModel->ConvertStrAction($_POST['site_num']);
            $site_info=$this->SiteInfoModel->ConvertStrAction($_POST['site_info']);
            $this->SiteInfoModel->Update($site_name,$site_user,$site_num,$site_info);
            $this->ShowMessageAction('success','修改成功！','?p=admin&c=Index');
        }else{
            $this->ShowMessageAction('danger','请正确访问！','?p=admin&c=Index');
        }

    }

    public function __call($fun_name,$fun_args)
    {

        //

    }

    public function __destruct()
    {

        $site=$this->site;
        $reg_users=$this->reg_users;
        $page_num=$this->page_num;
        $users=$this->users;
        require __VIEW__.'site.html';
    }


}