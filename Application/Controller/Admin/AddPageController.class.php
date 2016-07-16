<?php
class AddPageController extends Controller{
    private $page_type; //用来存储文章类别
    private $AddPageModel; //添加文章模型
    public function __construct()
    {
       parent::__construct();  //检查登录状态 并且取出有效数据
       $this->AddPageModel=new AddPageModel(); //实例化添加文章模型（操作数据库）
       $this->page_type=$this->AddPageModel->GetPagetype(); //获取所有文章类别
    }


    public function AddPageAction()  //添加文章方法
    {
        if(isset($_POST['content'])&&isset($_POST['title']) && isset($_POST['type'])) {
            if (!intval($_POST['type'])) { //获取内容、标题、类别
                $this->ShowMessageAction('danger', '类别错误！！', '?p=admin&c=AddPage');
            }
            $type = $_POST['type']; //类别
            $content = $_POST['content']; //内容
            $title = $_POST['title'];
            $title = $this->AddPageModel->ConvertStrAction($title);//使用安全函数转换
            $this->AddPageModel->AddPage($title,$this->Current_user,$content,$type); //调用添加文章函数
            $this->ShowMessageAction('success','添加成功！','?p=admin&c=AddPage'); //提示添加成功
        }

    }


    public function __call($fun_name,$fun_args)
    {

        $this->AddPageAction(); //如果没有给出明确方法，自动选择添加函数

    }

    public function __destruct()  //析构函数
    {

        $site=$this->site; //站点信息
        $reg_users=$this->reg_users; //注册用户
        $page_num=$this->page_num;//总文章数目
        $users=$this->users; //所有用户
        $page_type=$this->page_type; //文章类别
        require __VIEW__.'page_add.html';
    }


}