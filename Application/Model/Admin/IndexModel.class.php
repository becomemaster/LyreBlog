<?php
class IndexModel extends Model{


    /**获取注册用户数量
     * @return mixed
     */
    public function GetRegUsers()
    {
        $users='select count(*) from User';
       return $this->DB->feach_row($users);
    }

    /**获取站点信息
     * @return array|null
     */
    public function GetSiteinfo()
    {
        $site='select * from Site';
        return $this->DB->feach_assoc($site);
    }

    /**获取文章数目
     * @return mixed
     */
    public function GetPageNum()
    {
        $page_num='SELECT COUNT(*) from page';
        $page_num=$this->DB->feach_row($page_num);
       return $page_num[0];
    }

    /**更新站点访问次数
     * @return bool|mysqli_result
     */
    public function upNum()
    {
        $u='update site set site_num=site_num+1';
        return $this->DB->query($u);
    }

    /**获取所有用户信息
     * @return bool|mysqli_result
     */
    public function GetUsers()
    {
        $users="select * from User";
        return $this->DB->query($users);
    }

}