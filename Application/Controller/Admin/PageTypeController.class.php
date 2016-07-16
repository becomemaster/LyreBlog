<?php
class PageTypeController extends Controller{
    private $PageTypeModel;
    private $pagetype;
    public function __construct(){
        parent::__construct();
        $this->PageTypeModel=new PageTypeModel();
        $this->pagetype=$this->PageTypeModel->GetPageTypeAction();
    }

    public function __call($func_name,$func_args)
    {
        $page_type=$this->pagetype;
        $site=$this->site;
        $reg_users=$this->reg_users;
        $page_num=$this->page_num;
        $users=$this->users;
        require __VIEW__.'page_type.html';
    }



    public function EditTypeAction()
    {
        $id = isset($_GET['id']) && intval($_GET['id']) && $_GET['id']>0?intval($_GET['id']):'';
        if(empty($id)){$this->ShowMessageAction('danger','亲，请误非法访问！','?p=admin&c=Index');}
        $res=$this->PageTypeModel->GetName($id);
        $page_type=$this->pagetype;
        $site=$this->site;
        $reg_users=$this->reg_users;
        $page_num=$this->page_num;
        $users=$this->users;
        if(isset($_POST['typename'])){
            $typename=$this->PageTypeModel->ConvertStrAction($_POST['typename']);
            $this->PageTypeModel->Update($id,$typename);
            $this->ShowMessageAction('success','修改成功！','?p=admin&c=Index');
        }
        require __VIEW__.'edittype.html';
    }

    public function DelTypeAction()
    {

        if(isset($_GET['del']))
        {
            $del=intval($_GET['del'])&&$_GET['del']>0?intval($_GET['del']):null;
            if(empty($del)){$this->ShowMessageAction('danger','操作错误！','?p=admin&c=Index');}
            $this->PageTypeModel->Del($del);
            $this->ShowMessageAction('success','删除成功！','?p=admin&c=Index');
        }else
        {
            $this->ShowMessageAction('danger','亲，请误非法访问！','?p=admin&c=Index');
        }
    }

    public function AddTypeAction()
    {
        if(isset($_POST['typename'])){
            $typename=$this->PageTypeModel->ConvertStrAction($_POST['typename']);
            $this->PageTypeModel->AddType($typename);
            $this->ShowMessageAction('success','添加成功！','?p=admin&c=Index');
        }

        $page_type=$this->pagetype;
        $site=$this->site;
        $reg_users=$this->reg_users;
        $page_num=$this->page_num;
        $users=$this->users;
        require __VIEW__.'addtype.html';

    }

}