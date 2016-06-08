<?php
class MessageAction extends Action{
    
    public function __construct() {
        parent::__construct(); //一定要注意这一行，这一行是为了执行父类中的构造函数，否则运行是会出错的
        $this->CheckmSession(); 
    }

    private function CheckmSession(){
        if(!isset($_SESSION['login']) && $_SESSION['login'] !== true){
            $this -> error('Sorry! You have not logged or login timeout, please sign in again!',U('Auth/login'));
        }
    }

    public function message(){
        $ret = $this -> _getmessage();
        $this -> assign('ret', $ret);
        $this -> display('Account/message');
    }

    public function msgshow(){
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $message_id = $_GET['id'];
            $m = M('message');
            $type = $m -> where('id='.$message_id) ->getField('type');
            
            if($type == 1){
                $where = array(
                    "isactive" => 1,
                    "type" => 1,
                    "id" => $message_id
                );
                $ret = $m -> where($where) -> find();
            }else{
                $where = array(
                    "isactive" => 1,
                    "type" => 0,
                    "to_userid" => $this -> _getUid(),
                    "message_id" => $message_id
                );
                $ret = $m -> where($where) -> find();
            }
            
            if ($ret !== null) {
                $ms = M('message_status');
                $where = array(
                    "message_id" => $message_id,
                    "user_id" => $this -> _getUid(),
                );
                $t = $ms -> where($where) -> find();
                $msitem = array(
                    "message_id" => $message_id,
                    "user_id" => $this -> _getUid(),
                    "isread" => 1,
                    "readtime" => date('Y-m-d H:i:s')
                );
                if($t == null){
                    $ms -> add($msitem);
                }else{
                    $ms -> save($msitem);
                }               
                $ret['message'] = str_replace('src="/ueditor', 'src="/Public/ueditor', $ret['message']);
                $this -> assign('item', $ret);
            }
        }
        $this -> display('Account/msgshow');
    }

	private function _getUid(){
		return $_SESSION['id'];
	}

    private function _getmessage(){
        $m = M('message');
        $where1 = array(
            "isactive" => 1,
            "to_userid" => $this -> _getUid(),
            "type" => 0
        );
        $ret1 = $m -> order('id desc') -> where($where1) -> select();

        $um = D('UserMessage');
        $w = array(
            "isactive" => 1,
            "user_id" => $this -> _getUid(),
            "isread" => 2
        );
        $item = $um -> where($w) -> select();        
        foreach ($item as $k => $v) {
            $ret3[$k]['id'] = $v['message_id'];
            $ret3[$k]['title'] = $v['title'];
            $ret3[$k]['message'] = $v['message'];
            $ret3[$k]['to_userid'] = $v['to_userid'];
            $ret3[$k]['isactive'] =$v['isactive'];
            $ret3[$k]['type'] =$v['type'];
            $ret3[$k]['addtime'] =$v['addtime'];
        }
        $where2 = array(
            "isactive" => 1,
            "type" => 1
        );        
        $item2 = $m -> order('id desc') -> where($where2) -> select();
        $ret2 = array();
        foreach ($item2 as $k => $v) {
            if(!in_array($v, $ret3)){
                array_push($ret2, $v);
            }
        }
        if($ret1 == null){
            $ret = $ret2;
        }elseif($ret2 == null){
            $ret = $ret1;
        }else{
            $ret = array_merge_recursive($ret1,$ret2);
        }
        return $ret;
    }

    public function delmsg(){
        $where = array(
            "message_id" => $_GET['id'],
            "user_id" => $_SESSION['id']
        );
        $ms = M('message_status');
        $t = $ms -> where($where) -> save(array("isread" => 2));
        $w = array(
            "id" => $_GET['id'],
            "to_userid" => $_SESSION['id']
        );
        $m = M('message');
        $k = $m -> where($w) -> save(array("isactive" => 0));
        if($t !== false){
            $this -> success('successfully deleted!');
        }else{
            $this -> error('failed to delete!');
        }
    }

    public function loadMessage(){
        $ret = $this -> _getmessage();
        $numbers = count($ret);
        $retm = json_encode($numbers);
        echo $retm;
    }

    public function getMessage(){
        $ret = $this -> _getmessage();
        $retm = json_encode($ret);
        echo $retm;
    }

}

?>