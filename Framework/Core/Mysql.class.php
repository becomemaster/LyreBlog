<?php
class Mysql{
    private $DB_HOST;
    private $DB_USER;
    private $DB_PASS;
    private $DB_PORT;
    private $DB_NAME;
    private $DB_CHAR;
    private $DB_LINK;
    private static $DB_obj;

    private function __construct($config)
    {
        $this->setOptions($config);
        $this->Connect();
        $this->setChar();
    }

    private function __clone()
    {

    }

    private function Connect()
    {
        $this->DB_LINK=@mysqli_connect($this->DB_HOST,$this->DB_USER,$this->DB_PASS,$this->DB_NAME,$this->DB_PORT);
        if(!$this->DB_LINK){die('数据库连接失败！');}
    }
    public function query($sql)
    {
        $result=mysqli_query($this->DB_LINK,$sql);
        if(!$result && DEBUG){
            $this->getError($sql);
        }
        return $result;
    }

    public function fetch_data($sql,$fetch_type='assoc')
    {
        $result=$this->query($sql);
        $res=array();
        $type=array('assoc','row','array');
        if(!in_array($fetch_type,$type)){
            $fetch_type='assoc';
        }
        $foreach_fun='mysqli_fetch_'.$fetch_type;
        while($row=$foreach_fun($result))
        {
            $res[]=$row;
        }
        return $res;
    }

    public function getRow($sql){
        $row=$this->query($sql);
        $row=mysqli_fetch_array($row);
        return $row[0];
    }

    public function feach_row($sql)
    {
        $row=$this->fetch_data($sql,'row');
        return $row[0];
    }

    private function setChar()
    {
        $sql='set names '.$this->DB_CHAR;
        $this->query($sql);
    }

    public function feach_assoc($sql)
    {
        $result=$this->query($sql);
        return mysqli_fetch_assoc($result);
    }

    private function getError($sql)
    {
        header('Content-type:text/html;charset=utf-8');
        echo '<pre><div style="font-size: 40px;">:(  SQL执行出错啦！ </div>';
        echo '<div style="color: darkred;font-size: 20px;">错误代码:'.mysqli_errno($this->DB_LINK).'<br />';
        echo '错误信息:'.mysqli_error($this->DB_LINK).'<br />';
        echo '执行语句:'.$sql;
        echo '</div></pre>';
        exit;

    }

    private function setOptions($config)
    {
        $this->DB_HOST=isset($config['DB_HOST'])?$config['DB_HOST']:'';
        $this->DB_USER=isset($config['DB_USER'])?$config['DB_USER']:'';
        $this->DB_PASS=isset($config['DB_PASS'])?$config['DB_PASS']:'';
        $this->DB_PORT=isset($config['DB_PORT'])?$config['DB_PORT']:'3306';
        $this->DB_NAME=isset($config['DB_NAME'])?$config['DB_NAME']:'';
        $this->DB_CHAR=isset($config['DB_CHAR'])?$config['DB_CHAR']:'utf8';

    }

    public static function getSqlObj($config)
    {
        if(!self::$DB_obj instanceof self){
            self::$DB_obj = new self($config);
        }
        return self::$DB_obj;
    }

    public function ReturnSafestr($str)
    {
        $str=mysqli_real_escape_string($this->DB_LINK,$str);
        return $str;
    }


}


