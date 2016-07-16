<?php
class AdminModel extends Model{

    public function UpdateLoginTimeAction($username) //更新管理员登录时间
    {
        $time=time();
        $sql="update Admin set Login_time= $time where username='$username'";
        $this->DB->query($sql);
    }




}