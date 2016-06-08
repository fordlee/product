<?php
class MessageAction extends Action {

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

    public function listMessage(){
        $m = M('message');
        $ret = $m -> where(array('isactive' => 1)) -> order('id desc') -> limit(30) -> select();
        $this -> assign('ret', $ret);
    	$this->display();
    }

    public function addMessage(){
    	$this -> display('add');
    }

    public function edit(){
        if(isset($_POST['id'])){
            $this -> _save();
        }else{
            $id = $_GET['id'];
            $where = array(
                "id" => $id
            );
            $m = M('message');
            $item = $m -> where($where) -> find();
            $userlist = M('userlist');
            $user_id = $item['to_userid'];
            $item['email'] = $userlist -> where('id='.$user_id) -> getField('email');
            $this -> assign('item', $item);
            $this -> assign('btn', "修改");
            $this -> display();
        }
    }

    public function add(){
        if(isset($_POST['id'])){
            $this -> _save();
        }else{
            $this -> display();
        }    
    }

    private function _addUserMsg($mid,$email){
        $userlist = M('userlist');
        $where = array(
            "status" => 1,
            "email" => $email
        );
        $user_id = $userlist -> where($where) -> getField('id');
        $m = M('message');
        $data = array(
            "to_userid" => $user_id
        );
        $ret = $m -> where('id='.$mid) -> save($data);
    }

    private function _save(){
        $id = $_POST['id'];
        $title = $_POST['title'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        $type = $_POST['type'];
        
        $item = array(
            "title" => $title,
            "message" => $message,
            "type" => $type,
            "isactive" =>1,
            "addtime" => date('Y-m-d H:m:s')
        );
        $m = M('message');
        
        if(empty($id)){
            $ret = $m -> add($item);
        }else{
            $item['id'] = $id;
            $ret = $m -> save($item);
        }
        if($ret > 0 && $email !== NULL && $type == 0) {
            $this -> _addUserMsg($ret,$email);
        }
        if ($ret > 0) {
            $this -> success('成功！','listMessage');
        } else {
            $this -> error('失败！');
        }
    }

    public function detail() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $where = array(
                "id" => $id
            );
            $m = M('message');
            $item = $m -> where($where) -> find();
            $this -> assign('item', $item);
        }
        $this -> display();
    }

    public function msgdel() {
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $id = $_POST['id'];
            $m = M('message');
            $item = array(
                "id" => $id,
                "isactive" => 0
            );
            $ret = $m -> save($item);
            if ($ret == false) {
                echo "删除失败！";
            } else {
                echo 1;
            }
        } else {
            echo "参数有误！";
        }
    }


}
?>