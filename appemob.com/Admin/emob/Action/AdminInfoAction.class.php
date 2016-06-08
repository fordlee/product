<?php
class AdminInfoAction extends Action {

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

	public function showlist(){
		$m = M('adminlist');
        $level = $_SESSION['level'];
        if($level == 0 || $level ==1){
            $adminInfo = $m -> select();
        }else{
            $adminInfo = $m -> where('level='.$level) -> select();
            $this -> assign('level',$level);
        }
		$this -> assign('adminInfo',$adminInfo);
        $this -> display('showlist');
	}

    public function showlevellist(){
        $level = $_POST['level'];
        if($level == 0){
            $this -> assign('level',$level);
            $this -> showlist();
        }else{
            $m = M('adminlist');
            $adminInfo = $m -> where('level='.$level) -> select();
            $this -> assign('level',$level);
            $this -> assign('adminInfo',$adminInfo);
            $this -> display('showlist');

            //echo json_encode($adminInfo,true);
        }
              
    }

	public function add(){
        
        $data['name'] = $_POST['name'];
        $data['email'] = $_POST['email'];
        $data['passwd'] = $_POST['passwd'];
        $data['time'] = $_POST['time'];
        $data['level'] = $_POST['level'];

        if (isset($_POST['email']) && isset($_POST['passwd']) &&isset($_POST['name']) &&isset($_POST['level'])) {
            $m = M('adminlist');
            if($_SESSION['level'] < $_POST['level'] || $_SESSION['level'] ===0){
                $ret = $m -> add($data);
                $this -> success('添加成功！','showlist');
            }else{
                unset($_POST);
                $this -> error("您的权限等级不够！",'add');
            }
        }else{
            $this -> display();
        }       	
	}

	public function del(){
		$levelid = $this -> _getlevelid();
        if($_SESSION['level'] < $levelid['level'] || $_SESSION['level'] ==0){
            $m = M('adminlist');
            $id = $levelid['id'];
            $ret = $m -> where('id='.$id) -> delete();
            if($ret!==false){
                $this -> success('删除成功！','showlist');
            }
        }else{
            unset($id);
            $this -> error("您的权限等级不够！",'showlist');
        }
	}

    public function edit(){
        $id = $_POST['id'];
        $data['name'] = $_POST['name'];
        $data['email'] = $_POST['email'];
        $data['passwd'] = $_POST['passwd'];
        $data['time'] = $_POST['time'];
        $data['level'] = $_POST['level'];

        if(isset($_POST['email']) && isset($_POST['passwd']) &&isset($_POST['name'])&&isset($_POST['level'])){
            if($_SESSION['level'] <= $_POST['level']){
                $m = M('adminlist');
                $ret = $m -> where('id='.$id) -> save($data);
                if($ret!==false){
                    $this -> success('修改成功！','showlist');
                }
            }            
        }else{
            $levelid = $this -> _getlevelid();
            if($_SESSION['level'] <= $levelid['level'] || $_SESSION['level'] ==0){
                $m = M('adminlist');
                $id = $levelid['id'];
                $adminInfo = $m -> where('id='.$id) ->find();
                $this ->assign('adminInfo',$adminInfo);
                $this -> display();
            }else{
                unset($_POST);
                $this -> error("您的权限等级不够！",'showlist');
            }
        }     
    }

    private function _getlevelid(){
        $m = M('adminlist');
        $id = $_GET['id'];
        if(!isset($id)){$id=$_POST['id'];}
        $level = $m -> where("id='$id'") -> getField('level');
        $levelid=array('id'=>$id,'level'=>$level);
        return $levelid;
    }

    public function showlog(){

        $this -> display();
    }

    
}
?>