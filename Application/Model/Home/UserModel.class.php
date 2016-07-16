<?php
class UserModel extends Model{

    public function UpdateLoginTimeAction($username)
    {
        $time=time();
        $sql="update User set Login_time= $time where username='$username'";
        $this->DB->query($sql);
    }




}