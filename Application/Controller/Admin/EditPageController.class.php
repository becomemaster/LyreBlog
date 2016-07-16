<?php
class EditPageController extends Controller{

    private $EditPageModel; //编辑文章模型
    private $page; //文章信息
    private $pageid; //文章ID
    public function __construct()
    {
        parent::__construct();  //检查登录
        $this->EditPageModel=new EditPageModel(); //实例化编辑文章模型
        $pageid = isset($_GET['page_id']) && $_GET['page_id']>0?intval($_GET['page_id']):NULL; //获取文章ID
        if(empty($pageid)){$this->ShowMessageAction('danger','亲，请误非法访问！','?p=admin&c=Index');}
        $this->page=$this->EditPageModel->Pageinfo($pageid); //获取文章内容
        $this->pageid=$pageid;

    }


    public function EditPageAction()
    {

    }

    public function UpdatePageAction() //更新文章内容
    {
        if(isset($_POST['content'])&&isset($_POST['title']))  //获取内容和标题
        {
            $content=$_POST['content'];
            $title=$_POST['title'];
            $title=$this->EditPageModel->ConvertStrAction($title); //过滤标题
            $this->EditPageModel->UpdatePage($title,$content,$this->pageid); //调用编辑文章模型中的更新文章函数
            $this->ShowMessageAction('success','修改成功！','?p=admin&c=Index'); //提示修改成功
        }
    }


    public function __call($fun_name,$fun_args)
    {
        $this->EditPageAction(); //自动调用
    }


    public function __destruct()
    {
        $page=$this->page; //返回文章信息
        $site=$this->site; //站点信息
        $reg_users=$this->reg_users; //注册用户数量
        $page_num=$this->page_num; //文章数量
        $users=$this->users; //注册用户信息
        $pageid=$this->pageid; //当前文章ID
        require __VIEW__.'page_edit.html';

    }




}