<?php
class LeaveModel extends Model{

    public function getUserMSG($USER){
        $sql="select * from page_msg where username='$USER'";
        return $this->DB->fetch_data($sql);
    }

    public function seletcTitle($pageid){
        $sql="select Page_title from page where Pageid=".$pageid;
        return $this->DB->getRow($sql);
    }

    public function DelMsg($msg_id,$usrname){
        $sql="delete from page_msg where msg_id=$msg_id AND username='$usrname'";
        return $this->DB->query($sql);

    }

}