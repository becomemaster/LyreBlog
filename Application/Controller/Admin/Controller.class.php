<?php
class Controller{
    protected $IndexModel; //主页模型
    protected $reg_users; //注册用户数目
    protected $site; //站点信息
    protected $page_num; //总文章数目
    protected $users; //所有用户
    protected $Current_user;//当前用户
    public function __construct() //验证登录
    {

        @session_start(); //开启Session
        if(!isset($_SESSION['ADMIN']))
        {
            header('Location:?p=admin&c=Login'); //如果没有登录则跳转到登录
            exit;
        }

        $this->Current_user=$_SESSION['ADMIN']; //获取当前用户
        $this->IndexModel=new IndexModel();  //载入主页模型
        $this->reg_users=$this->IndexModel->GetRegUsers(); //获取注册用户数量
        $this->site=$this->IndexModel->GetSiteinfo(); //获取站点信息
        $this->page_num=$this->IndexModel->GetPageNum(); //获取文章数量
        $this->users=$this->IndexModel->GetUsers(); //获取所有用户信息
    }


    /**
     * @param $type 类别
     * @param $info 提示信息
     * @param string $url 跳转地址
     */
    public  function  ShowMessageAction($type,$info,$url='') //提示信息函数。用于输出提醒
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