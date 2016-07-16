<?php
class Controller{

    private  $PageModel;
    private $Model;
    public function __construct()  //初始化 获取所有数据
    {
        session_start();
        $this->PageModel=new PageModel();
        if(!isset($_COOKIE['site'])){   //如果客户端没有cookie就增加访问量
            setcookie("site",1, time()+3600*24);  //设置一个cookie 24小时过期
            $this->PageModel->upNum(); //更新站点访问次数
        }
        //下次用户访问的时候就 不增加浏览次数。

        if (isset($_SESSION['USER'])) {  //判断用户是否登录
            $this->user = $_SESSION['USER'];  //赋值Session
            $this->login = '<li><a href="/?p=home&c=Login&a=Logout">退出</a></li>';
        } else {
            $this->user = '匿名用户';
            $this->login = '<li><a href="?p=home&c=Login&a=Login">登录</a></li>';
        }
        $this->Model = new Model();
        $this->site = $this->Model->GetSiteinfo();  //获取站点信息
        $this->page_type = $this->Model->GetPageTypeAction(); //获取站点文章类型
        $this->reg_users = $this->Model->GetRegUsers(); //获取所有注册用户数目
        $this->page_num = $this->Model->GetPageNum();  //获取文章数目

    }


  public  function  ShowMessageAction($type,$info,$url='')
    {
        echo <<<STR
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="refresh" content="2;url={$url}">
            <title>提示</title>
            <link href="/Public/styles/bootstrap.min.css" rel="stylesheet">
            <link href="/Public/styles/bootstrap-theme.css" rel="stylesheet">
            <script src="/Public/js/bootstrap.min.js"></script>
            <script src="/Public/js/bootstrap.js"></script>
            <script src="/Public/js/jquery.min.js"></script>
            </head>
            <body>
            <div class='alert alert-{$type}'>{$info}</div>
            </body>
            </html>
STR;
        exit;
    }


}