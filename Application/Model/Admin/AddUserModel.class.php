<?php
class AddUserModel extends Model{

    public function UpdateLoginTimeAction($username) //更新用户登录时间
    {
        $time=time();
        $sql="update User set Login_time= $time where username='$username'";
        $this->DB->query($sql);
    }

    public function AddUserAction($username,$password) //添加用户
    {
        $reg_time = time();
        $sql="insert into User values(null,'$username','$password',$reg_time)";
        $this->DB->query($sql);
    }
}