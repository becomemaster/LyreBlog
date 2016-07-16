<?php
class PageModel extends Model{
    public function ShowIndexAction() //获取站点信息
    {
       return $this->DB->feach_assoc('select * from Site');
    }

    public function GetPageTypeAction() //获取站点文章类型
    {
      return $this->DB->query('select * from Page_type');
    }

    public function GetRegisterAction() //获取站点注册用户数目
    {
        return $this->DB->feach_row('select count(*) from User');
    }

    public function GetPageNumAction()  //获取站点文章数目
    {
        $page_num=$this->DB->feach_row('SELECT COUNT(*) from page');
        return $page_num[0];
    }

    /**分页获取文章
     * @param $page_start 文章起始ID
     * @param $page_size  每页显示数目
     * @return mixed      返回资源
     */
    public function GetPagesAction($page_start,$page_size) //分页获取文章
    {
        $get_pages="select * from Page limit $page_start,$page_size";
        return $this->DB->query($get_pages);
    }

    public function GetPagesTypeAction($type)  //获取指定类别文章
    {
        $gettype=$this->DB->query("select * from page where page_type = $type");
        return $gettype;
    }

    /**获取一个文章信息
     * @param $page  文章ID
     * @return mixed 返回文章数组
     */
    public function GetPageinfoAction($page)  //获取一个文章信息
    {
        return $this->DB->feach_assoc("select * from page where Pageid = $page");
    }

    /**获取文章留言
     * @param $pageid  文章ID
     * @return mixed   返回资源
     */
    public function GetPageMsgAction($pageid)
    {
        return $this->DB->query("select * from page_msg where Pageid = $pageid");
    }

    public function AddMessage($username,$Page_msg,$Pageid,$email)
    {
        $sql="insert into page_msg VALUES ('$username','$Page_msg',$Pageid,'$email',null)";
        return $this->DB->query($sql);
    }




}