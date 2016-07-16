<?php
class Model{
    public $DB;  //数据库对象
    public function __construct(){

        $config=require CONFIG_PATH.'config.php'; //读取配置文件
        $this->DB=Mysql::getSqlObj($config);  //获取数据库对象

    }
    public function GetRegUsers()
    {
        $users='select count(*) from User';
        return $this->DB->feach_row($users);
    }

    public function GetSiteinfo()
    {
        $site='select * from Site';
        return $this->DB->feach_assoc($site);
    }

    public function GetPageNum()
    {
        $page_num='SELECT COUNT(*) from page';
        $page_num=$this->DB->feach_row($page_num);
        return $page_num[0];
    }

    public function upNum()
    {
        $u='update site set site_num=site_num+1';
        return $this->DB->query($u);
    }

    public function ConvertStrAction($str)
    {
        $str=trim($str);
        $str=htmlspecialchars($str);
        $str=$this->DB->ReturnSafestr($str);
        return $str;
    }


}