<?php
class LoginModel extends Model{


    public function CheckLoginAction($username,$password) //检查登录
    {
        $sql = "select * from admin where username='$username' AND password= '$password'";
        $num=mysqli_num_rows($this->DB->query($sql));
        return $num;
    }



}