<?php
class ImageModel extends Model{

    public function getUserimg(){
        $sql="select * from user_img";
        return $this->DB->query($sql);
    }



}