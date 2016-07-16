<?php
class ImageController extends Controller{

    private $ImageModel;
    private $imgs;
    public function MyimagesAction(){
        $current_user= $_SESSION['ADMIN']; //当前用户
        $this->ImageModel=new ImageModel();
        $this->imgs=$this->ImageModel->get_user_Img($this->ImageModel->ConvertStrAction($current_user));
        $this->displayAction('image');
    }


    public function __call($args,$args_arr){
        $this->MyimagesAction();
    }



    public function AddimageAction(){
    $this->displayAction('addimage'); //引入添加相片页面
    $current_user= $_SESSION['ADMIN']; //当前用户
    $current_path=PUBLIC_PATH.'users'.DS.$current_user;  //确定用户图片存储目录
    if(!is_dir($current_path)) {  //如果没有创建用户活动目录
        @mkdir($current_path); //创建目录
        touch($current_path.DS.'index.html'); //防止遍历目录文件 创建默认主页
    }
     if(!empty($_POST)){
         if(empty($_POST['photoName'])|| empty($_POST['photoRed'])){
             $this->ShowMessageAction('danger','提交数据不合法！','?p=admin&c=image&a=Addimage');
         }
         if($_FILES['photoFile']['error'] > 0){
             $this->ShowMessageAction('danger','提交数据不合法！','?p=admin&c=image&a=Addimage');
         }
         if($_FILES["photoFile"]["size"] > 2000000){
             $this->ShowMessageAction('danger','文件过大！！','?p=admin&c=image&a=Addimage');
         }
         $this->ImageModel=new ImageModel();  //实例化相册模型
         $photoName=$this->ImageModel->ConvertStrAction($_POST['photoName']);  //过滤名称
         $photoRed=$this->ImageModel->ConvertStrAction($_POST['photoRed']);   //过滤说明
         $tmp_photo=$_FILES['photoFile']['tmp_name']; //确定文件名
         $photo=$_FILES['photoFile']['name'];
         //=========================================判断文件是否合法===============================//
         switch(substr($photo,-4,4)){
              case '.jpg':
                  move_uploaded_file($tmp_photo,$current_path.DS.md5(time().md5($current_user)).'.jpg');
                  $img_url='Public/users/'.$current_user.'/'.md5(time().md5($current_user)).'.jpg';
                  break;
              case '.gif':
                  move_uploaded_file($tmp_photo,$current_path.DS.md5(time().md5($current_user)).'.gif');
                  $img_url='Public/users/'.$current_user.'/'.md5(time().md5($current_user)).'.gif';
                  break;
              case '.bmp':
                  move_uploaded_file($tmp_photo,$current_path.DS.md5(time().md5($current_user)).'.bmp');
                  $img_url='Public/users/'.$current_user.'/'.md5(time().md5($current_user)).'.bmp';
                  break;
              case '.png':
                  move_uploaded_file($tmp_photo,$current_path.DS.md5(time().md5($current_user)).'.png');
                  $img_url='Public/users/'.$current_user.'/'.md5(time().md5($current_user)).'.png';
                  break;
              default:
                echo substr($photo,-4,4);
                  $this->ShowMessageAction('danger','上传文件不合法','?p=admin&c=image&a=Addimage');
          }
         //=========================================判断文件是否合法===============================//
        //用户相片的相对路径需要写入数据库
             if(isset($img_url)){
                 if($this->ImageModel->AddImage($current_user,$photoName,$photoRed,$this->ImageModel->ConvertStrAction($img_url))){
                     $this->ShowMessageAction('success','添加成功！  :)','?p=admin&c=image');
                 }else{
                     $this->ShowMessageAction('danger','添加失败！  :(','?p=admin&c=image&a=Addimage');
                 }
             }
    }

}

    public function DelimgAction(){
      $current_user=$_SESSION['ADMIN'];
      $id=isset($_GET['id'])&&is_numeric($_GET['id'])?intval($_GET['id']):'';
          if(empty($id)){
              $this->ShowMessageAction('danger','参数缺少 :)','?p=admin&c=image');
          }
          $this->ImageModel=new ImageModel();
          if($this->ImageModel->Delimg($id,$current_user)){
              $this->ShowMessageAction('success','删除成功！ :)','?p=admin&c=image');
          }else{
              $this->ShowMessageAction('danger','删除失败！ :(','?p=admin&c=image');
          }
    }

    private function displayAction($html){
        $site=$this->site; //返回站点信息
        $reg_users=$this->reg_users;//返回用户数目
        $page_num=$this->page_num;//返回文章数目
        $imgs=$this->imgs;
        require __VIEW__.$html.'.html';
    }

}