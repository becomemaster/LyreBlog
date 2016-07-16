<?php
class PageController extends Controller{

    private $PageModel;
    private $page_size=10;
    private $page;
    public function __construct()
    {
        parent::__construct();
       $this->PageModel=new PageModel();
    }

    public function ShowPageAction()
    {
        $page_start=isset($_GET['page'])&&intval($_GET['page'])&&$_GET['page']>0?intval($_GET['page']):1;
        $page_start=($page_start-1)*$this->page_size;
        $this->page=$this->PageModel->GetPages($page_start,$this->page_size);
    }

    public function __call($func_name,$func_args)
    {
        $this->ShowPageAction();
    }


    public function DeletePageAction()
    {
        $this->ShowPageAction();
        $pageid = isset($_GET['del_id']) && $_GET['del_id']>0?intval($_GET['del_id']):NULL;
        if(empty($pageid)){$this->ShowMessageAction('danger','亲，请误非法访问！','?p=admin&c=Index');}
        $this->PageModel->DelPage($pageid);

        $this->ShowMessageAction('danger','删除成功！！','?p=admin&c=Index');

    }


    public function __destruct()
    {
        $site=$this->site;
        $reg_users=$this->reg_users;
        $page_num=$this->page_num;
        $page_size=$this->page_size; //文章每页显示数目
        $pages = ceil($page_num / $page_size);
        $page= $this->page;
        require __VIEW__.'pages.html';

    }

}