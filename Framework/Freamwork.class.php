<?php
/**
 * Class Framework
 * 定义常量
 * 导入配置文件
 * 确定路由
 * 自定义加载类
 * 注册自动加载类
 * 请求分发
 * 运行框架
 */
class Framework{
    private static function InitConst()
    {
        define('DS',DIRECTORY_SEPARATOR); //定义路径分隔符
        define('ROOT_PATH',getcwd().DS);//定义根目录
        define('APP_PATH',ROOT_PATH.'Application'.DS); //定义Application目录
        define('FRAMEWORK_PATH',ROOT_PATH.'Framework'.DS);//定义框架目录
        define('PUBLIC_PATH',ROOT_PATH.'Public'.DS); //定义public目录
        define('CONFIG_PATH',APP_PATH.'Config'.DS); //定义配置文件目录
        define('CONTROLLER_PATH',APP_PATH.'Controller'.DS);//定义控制器目录
        define('MODEL_PATH',APP_PATH.'Model'.DS); //定义Model目录
        define('VIEW_PATH',APP_PATH.'View'.DS); //定义视图目录
        define('CORE_PATH',FRAMEWORK_PATH.'Core'.DS); //定义Core目录
        define('LIB_PATH',FRAMEWORK_PATH.'Lib'.DS); //定义li目录
    }


    private static function InitConfig()
    {
        $GLOBALS['config']=require CONFIG_PATH.'config.php';
    }

    private static function InitRoutes()
    {
        $p=isset($_REQUEST['p'])&&($_REQUEST['p']=='home'||$_REQUEST['p']=='admin')?$_REQUEST['p']:$GLOBALS['config']['App']['default_platform']; //获取平台
        $c=isset($_REQUEST['c'])?$_REQUEST['c']:$GLOBALS['config']['App']['default_controller']; //获取控制器
        $a=isset($_REQUEST['a'])?$_REQUEST['a']:$GLOBALS['config']['App']['default_action']; //获取方法
        define('DEBUG',$GLOBALS['config']['App']['DEBUG']);
        define('PLATFORM_NAME',$p); //将当前平台设置为常量
        define('CONTROLLER_NAME',$c); //将当前控制器名设置为常量
        define('ACTION_NAME',$a); //将方法名设置为常量
        define('__URL__',CONTROLLER_PATH.PLATFORM_NAME.DS); //定义当前控制器目录
        define('__VIEW__',VIEW_PATH.PLATFORM_NAME.DS);//定义当前视图目录

    }

    private static function autoLoad($class_name)
    {
        $class_map=array(
            'Mysql'   =>  CORE_PATH.'Mysql.class.php',
        );
        if(isset($class_map[$class_name])){
            require $class_map[$class_name];
        }
        elseif(substr($class_name, -5)=='Model'){
            require MODEL_PATH.PLATFORM_NAME.DS.$class_name.'.class.php';
        }
        elseif(substr($class_name, -10)=='Controller'){
            require __URL__.$class_name.'.class.php';
        }
        spl_autoload_register('self::autoLoad');
    }

    private static function initRegisterAutoLoad(){
        spl_autoload_register('self::autoLoad');
    }
    private static function initDispatch(){
        $controller_name=CONTROLLER_NAME.'Controller';	//拼接控制器名
        $action_name=ACTION_NAME.'Action';			//拼接方法名
        $controller=new $controller_name();	//实例化控制器
        $controller->$action_name();		//调用方法
    }
    public static function Go(){
        self::InitConst();
        self::InitConfig();
        self::InitRoutes();
        self::initRegisterAutoLoad();
        self::initDispatch();
    }

}




