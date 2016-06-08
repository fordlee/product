<?php
class AuthAction extends Action{
	public function login(){
		if (isset($_POST['email']) && isset($_POST['password'])){
			$email = $_POST['email'];
			$pwd = $_POST['password'];
			$m = M('adminlist');
			$where = array(
					'email' => $email,
					'passwd' => $pwd
			);
			$adminitem = $m -> where($where) -> find();
			
			if ($adminitem['email'] == $email && $adminitem['passwd'] == $pwd) {
					$_SESSION['admin_login'] = true;
					$_SESSION['email'] = $email;
					$_SESSION['level'] = $adminitem['level'];
					$_SESSION['id'] = $adminitem['id'];
					$this -> redirect('Index/index');
			}else {
				$this -> error('email or password error!', 'login');
			}
		} else {
			$this -> display();
		}		
	}

	public function logout() {
        unset($_SESSION['admin_login']);
        unset($_SESSION['email']);
        unset($_SESSION['level']);
        unset($_SESSION['id']);
        $this -> redirect('Auth/login');
    }


}
?>