<?php
class LoginModel extends Model{

    public function ConvertStrAction($str)
    {

        $str=trim($str); //去除字符串两边的空格
        $str=htmlspecialchars($str);// 将字符串转换为html实体符
        $str=$this->DB->ReturnSafestr($str);  //将字符串中的mysql语句特殊字符转义
        return $str;
    }

    public function CheckLoginAction($username,$password)
    {
        $sql = "select * from User where username='$username' AND password= '$password'";
        $num=mysqli_num_rows($this->DB->query($sql));
        return $num;
    }

    public function RegisterUserAction($username,$password)
    {
        $reg_time = time();
        $sql="insert into User values(null,'$username','$password',$reg_time)";
        $this->DB->query($sql);
    }

}