<?php
class AddPageModel extends Model{

    public function GetPagetype() //取出站点所有文章类别
    {
        $sql="select * from Page_type";
        return $this->DB->query($sql);
        
    }

    public function AddPage($title,$user,$content,$type) //添加文章
    {
        $time=time();
        $sql="insert into page values(null,'$title','$user','$content',$type,null,0,$time)";
        $this->DB->query($sql);

    }




}