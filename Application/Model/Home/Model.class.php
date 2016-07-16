<?php
class Model{
    protected $DB;
    protected $APP;
    public function __construct(){
        $config=require CONFIG_PATH.'config.php';
        $this->DB=Mysql::getSqlObj($config);
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

    public function upPage_num($id)
    {
        $u="update page set page_read=page_read+1 where Pageid=$id";
        return $this->DB->query($u);
    }

    public function UpdateLoginTimeAction($username)
    {
        $time=time();
        $sql="update User set Login_time= $time where username='$username'";
        $this->DB->query($sql);
    }

    public function GetPageTypeAction() //获取站点文章类型
    {
        return $this->DB->query('select * from Page_type');
    }

}