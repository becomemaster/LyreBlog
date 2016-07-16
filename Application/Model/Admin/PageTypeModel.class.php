<?php
class PageTypeModel extends Model{

    public function GetPageTypeAction() //获取站点文章类型
    {
        return $this->DB->query('select * from Page_type');
    }

    public function GetName($id)
    {
        $sql="select * from page_type where Type_id = $id";
        return $this->DB->feach_assoc($sql);
    }

    public function Update($id,$typename){
        $sql="update page_type set Page_type = '$typename' where Type_id = $id";
        $this->DB->query($sql);

    }

    public function Del($id)
    {
        $del_type="delete from page_type where Type_id=$id";
        $this->DB->query($del_type);
    }
    public function AddType($typename)
    {
        $sql="insert into  page_type values(null,'$typename')";
        $this->DB->query($sql);
    }
}