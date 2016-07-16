<?php
class RegisterModel extends Model{


    public function RegisterUserAction($username,$password)
    {
        $reg_time = time();
        $sql="insert into User values(null,'$username','$password',$reg_time)";
        return $this->DB->query($sql);
    }




}