<?php
class DevAction extends Action{
	public function __construct() {
        parent::__construct(); //一定要注意这一行，这一行是为了执行父类中的构造函数，否则运行是会出错的
        //$this->CheckmSession(); 
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


    public function showDevlist(){
    	$m = D('UserDevApp');
    	$devlist = $m -> field('useremail,devlistid,devid,count(appid) as appNo,appname,devemail,website,level,devstatus,time') -> group('devid') -> select();
        
    	$this -> assign('devlist',$devlist);
    	$this -> display();
    }

    public function showDevLevel(){
        $level = $_POST['level'];
        $m = D('UserDevApp');
        if($level == 0){
            $devlist = $m -> field('useremail,devlistid,devid,count(appid) as appNo,appname,devemail,website,level,devstatus,time') -> group('devid') -> select();
        }else{
            $devlist = $m -> field('useremail,devlistid,devid,count(appid) as appNo,appname,devemail,website,level,devstatus,time') -> where('level ='.$level) -> group('devid') -> select();
        }

        $this -> assign('level',$level);
        $this -> assign('devlist',$devlist);
        $this -> display('showDevlist');
    }

    public function resort(){
        $key = $_GET['k'];
        
        $direction = $_GET['d'];
        $order = $key.' '.$direction;
        
        $m = D('UserDevApp');
        $devlist = $m -> order($order) -> field('useremail,devlistid,devid,count(appid) as appNo,appname,devemail,website,level,devstatus,time') -> group('devid') -> select();
        
        $this -> assign('d_'.$key,$direction);
        $this -> assign('devlist',$devlist);
        $this -> display('showDevlist');
    }

    public function operateDev(){
        $id=$_GET['id'];
        $status=$_GET['s'];
        
        if($status == 1){
            $data['status'] = 0;
        }else{
            $data['status'] = 1;
        }
         
        $m_d = M('devlist');
        $ret = $m_d -> where('id='.$id) -> save($data);

        $m = D('UserDevApp');
        $devlist = $m -> field('useremail,devlistid,devid,count(appid) as appNo,appname,devemail,website,level,devstatus,time') -> group('devid') -> select();
        
        $this -> assign('devlist',$devlist);
        $this -> display('showDevlist');
    }

}
?>