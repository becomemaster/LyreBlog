<?php
class PageModel extends Model{

    public function GetPageNum()
    {
        $sql='SELECT COUNT(*) from page';
       return $this->DB->feach_row($sql);
    }

    public function GetPages($page_start,$page_size)
    {
        $sql="select * from Page limit $page_start,$page_size";
        return $this->DB->query($sql);

    }

    public function DelPage($id)
    {
        $sql="delete from page where Pageid=$id";
        $this->DB->query($sql);
        $this->DelPagesMsg($id);
    }

    private function DelPagesMsg($id)
    {
        $sql="delete from page_msg where Pageid=$id";
        $this->DB->query($sql);

    }


}