<?php


class PageController{
    protected $PageModel; //存储Page模型对象
    protected $page_size=3; //每页显示数目
    protected $pages;  //总文章数目
    protected $site;   //站点信息
    protected $page_type;//站点类别
    protected $reg_users; //注册用户数目
    protected $page_content; //文章
    protected $page_start; //分页起始数目
    protected $page_num; //文章数目
    protected $user;//返回当前用户
    protected $login; //登录状态
    protected $pageinfo;//文章信息


    public function __construct()  //初始化 获取所有数据
    {
        session_start();
        $this->PageModel=new PageModel();

        if(isset($_SESSION['USER'])){  //判断用户是否登录
            $this->user=$_SESSION['USER'];  //赋值Session
            $this->login='<li><a href="/?p=home&c=Login&a=Logout">退出</a></li>';
        }else{
            $this->user  = '匿名用户';
            $this->login = '<li><a href="?p=home&c=Login&a=Login">登录</a></li>';
        }
        $this->site=$this->PageModel->ShowIndexAction();  //获取站点信息
        $this->page_type=$this->PageModel->GetPageTypeAction(); //获取站点文章类型
        $this->reg_users=$this->PageModel->GetRegisterAction(); //获取所有注册用户数目
        $this->page_num=$this->PageModel->GetPageNumAction();  //获取文章数目
        $this->pages =ceil($this->page_num / $this->page_size); //获取分页显示的总页数
        $page_start=isset($_GET['page'])&&intval($_GET['page'])&&$_GET['page']>0&&$_GET['page']<=$this->pages&&is_numeric($_GET['page'])?intval($_GET['page']):1;
        $this->page_start=$page_start=($page_start-1)*$this->page_size;
        $this->page_content=$page_content=$this->PageModel->GetPagesAction($page_start,$this->page_size);
    }

    public function ShowMessage($type,$info,$url='') //输出提示信息
    {
        echo <<<STR
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="refresh" content="2;url={$url}">
            <title>提示</title>
            <link href="/template/style/css/bootstrap.min.css" rel="stylesheet">
            <link href="/template/style/css/bootstrap-theme.css" rel="stylesheet">
            <script src="/template/style/js/bootstrap.min.js"></script>
            <script src="/template/style/js/bootstrap.js"></script>
            <script src="/template/style/js/jquery.js"></script>
            </head>
            <body>
            <div class='alert alert-{$type}'>{$info}</div>
            </body>
            </html>
STR;
        exit;
    }

    public function __call($fun_name,$fun_args) //如果方法不存在，则提示消息
    {
        $this->IndexAction();
    }

    public function IndexAction() //默认方法。 获得分页
    {
        $page_start=isset($_GET['page'])&&intval($_GET['page'])&&$_GET['page']>0&&$_GET['page']<=$this->pages&&is_numeric($_GET['page'])?intval($_GET['page']):0;
        $this->page_content=$this->PageModel->GetPagesAction($page_start,$this->page_size);
    }

    public function PagetypeAction() //获取指定类别文章
    {
      $type = isset($_GET['type']) && intval($_GET['type']) && $_GET['type']>0&&is_numeric($_GET['type'])?intval($_GET['type']):'';
       if(empty($type)){$this->ShowMessage('danger','亲，请误非法访问！','/index.php');}
      $this->page_content=$this->PageModel->GetPagesTypeAction($type);//获取指定类别文章
      $this->pages=0; //格式化页码 不显示
    }



    public function __destruct() //销毁
    {
        $site=$this->site; //返回站点信息
        $reg_users=$this->reg_users;//返回用户数目
        $page_num=$this->page_num;//返回文章数目
        $page_type=$this->page_type;//返回文章类别
        $pages=$this->pages; //返回文章页数
        $page_content=$this->page_content;//返回当前所有文章内容
        $user=$this->user;//返回当前用户
        $login=$this->login;//返回登录状态
        $page_type=$this->page_type;//返回文章类别
        require __VIEW__.'/index.html';
    }

}
