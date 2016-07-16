<?php
class MessageModel extends Model{

    public function GetMsg() //取出所有留言（评论）
    {
        $msg="select * from page_msg";
        return $this->DB->query($msg);
    }

    /**要删除的ID
     * @param $del
     */
    public function Del_msg($del) //删除指定留言（评论）
    {
        $del_msg="delete from page_msg where msg_id=$del";
        $this->DB->query($del_msg);
    }

    public function getMessagetitle($page_id){
        $sql="select Page_title from page where Pageid=".$page_id;
      return $this->DB->getRow($sql);
    }


}