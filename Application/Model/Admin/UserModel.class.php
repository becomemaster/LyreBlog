<?php
class UserModel extends Model{


    public function DelUser($id)
    {
        $sql="delete from User where Uid= $id";
        $this->DB->query($sql);
    }




}