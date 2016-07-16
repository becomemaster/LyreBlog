<?php
class EditPageModel extends Model{ //编辑文章模型
    /**查询文章内容
     * @param $Pageid 文章ID
     * @return array|null
     */
    public function Pageinfo($Pageid) //查询文章内容
    {
        $sql="select * from page where Pageid = $Pageid";
        return $this->DB->feach_assoc($sql);
    }

    /**更新文章
     * @param $title 标题
     * @param $content 内容
     * @param $pageid 文章ID
     */
    public function UpdatePage($title,$content,$pageid)
    {
        $sql="update page set Page_title='$title',Page_content='$content' where Pageid = $pageid";
        $this->DB->query($sql);
    }


}