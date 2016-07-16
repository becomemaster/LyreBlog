<?php
class SiteInfoModel extends Model{

public function Update($site_name,$site_user,$site_num,$site_info)
{
    $sql="update site set site_name='$site_name',site_user='$site_user',site_num=$site_num,site_info='$site_info'";
    $this->DB->query($sql);
}


}