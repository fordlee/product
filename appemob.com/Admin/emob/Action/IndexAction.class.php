<?php

// 本类由系统自动生成，仅供测试用途
class IndexAction extends CommonAction {
  //构造函数，验证Session
    public function __construct() {
        parent::__construct(); //一定要注意这一行，这一行是为了执行父类中的构造函数，否则运行是会出错的
        $this->CheckmSession(); 
    }
    
    private function CheckmSession(){
        if(isset($_SESSION['admin_login']) && $_SESSION['admin_login'] == true){
            
            $level = $_SESSION['level'];
            $item = file_get_contents(APP_PATH.'Conf/level/'.$level.'.json');
            $levelArr = json_decode($item,true);
            if(!in_array(ACTION_NAME, $levelArr)){
                //die('permissin deny!');
            }       
        }else{
            $url=str_replace('.html', '', U('Auth/login'));
            $this->error('当前用户未登录或登录超时，请重新登录',$url);
        }
    }

    public function index(){
    	$name=$_POST['name'];
    	$pw=$_POST['password'];

    	$this->display('index2');
    }
}