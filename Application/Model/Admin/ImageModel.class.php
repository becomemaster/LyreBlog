<?php
class ImageModel extends Model{

    public function AddImage($username,$photoName,$photoRed,$url){
        $sql="insert into user_img VALUES (null,'$username','$photoName','$photoRed','$url')";
        return $this->DB->query($sql);
    }

    public function get_user_Img($username)
    {
        $sql="select * from user_img where username='$username'";
        return $this->DB->query($sql);
    }

    public function Delimg($id,$current_user){
        $sql='delete from user_img where img_id= '.$id ." AND username='$current_user'";
        return $this->DB->query($sql);
    }
}