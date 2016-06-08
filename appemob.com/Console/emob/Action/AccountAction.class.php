<?php
class AccountAction extends Action {

    public function __construct() {
        parent::__construct(); //一定要注意这一行，这一行是为了执行父类中的构造函数，否则运行是会出错的
        $this->CheckmSession(); 
    }

    private function CheckmSession(){
        if(!isset($_SESSION['login']) && $_SESSION['login'] !== true){
            $this -> error('Sorry! You have not logged or login timeout, please sign in again!',U('Auth/login'));
        }
    }

	private function _checklogin() {
        $ret = false;
        if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
            $ret = true;
        }
        return $ret;
    }

	public function accountInfo(){
		
		if($this -> _checklogin()){
			$data['id'] = $_SESSION['id'];
			$data['email'] = $_SESSION['email'];

			$m = M('userlist');
			$info = $m -> where($data) -> find();
			$this -> assign('info',$info);
			$this -> display();
		}else{
			$this -> redirect('Auth/login');
		}		
	} 

	public function accountSave(){
		if ($this -> _checklogin()) {
			$data['id'] = $_POST['id'];
			$data['name'] = $_POST['fullname'];
        	$data['business_name'] = $_POST['company'];
        	$data['email'] = $_POST['email'];
        	$data['passwd'] = $_POST['password'];
        	$data['address'] = $_POST['address'];
        	$data['post_code'] = $_POST['postcode'];
        	$data['city'] = $_POST['city'];
        	$data['country'] = $_POST['country'];

        	$m = M('userlist');
        	$where = array(
        		'id' => $data['id'],
        		'email' => $data['email']
        	);
        	$m -> where($where) -> save($data);
        	if($m !== false){
        		$this -> success('Successfully modified!',U('Index/index'));
        	}else{
        		$this -> error('fail modified!');
        	}        	
		}else{
			$this -> redirect('Auth/login');
		}
	}

}