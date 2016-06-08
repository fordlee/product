<?php
class AuthAction extends Action {
	
	public function login() {
		
		if (isset($_POST['email']) && !empty($_POST['email'])) {
			$email = $_POST['email'];
			$pwd = $_POST['password'];
			$m = M('userlist');
			$where = array(
					'email' => $email,
					'passwd' => $pwd,
			);
			$useritem = $m -> where($where) -> find();
			
			if ($useritem !== null) {
				if ($useritem['status']) {
					$_SESSION['login'] = true;
					$_SESSION['email'] = $email;
					$_SESSION['name'] = $useritem['name'];
					$_SESSION['id'] = $useritem['id'];
					$this -> redirect('Index/index');
				} else {
					$this -> error('Inactive account, Login Register mailbox activated!','Auth/login');
				}
			} else {
				$this -> error('email or password error!', 'login');
			}
		} else {
			$this -> display();
		}		
	}

	public function logout() {
        unset($_SESSION['login']);
        unset($_SESSION['email']);
        unset($_SESSION['name']);
        unset($_SESSION['id']);
        $this -> redirect('Auth/login');
    }
	
	public function register(){
		 if (isset($_POST['email']) && !empty($_POST['email'])) {
			$fullname = $_POST['fullname'];
			$email = $_POST['email'];
			$passwd = $_POST['password'];
			$passwdrp = $_POST['repassword'];
			$regtime = time();

			if($passwd == $passwdrp){
				$token = md5($fullname.$password.$regtime); //创建用于激活识别码
				$token_exptime = time()+60*60*24;//过期时间为24小时后

	        	$data['name'] = $_POST['fullname'];
	        	$data['token'] = $token;
	        	$data['token_exptime'] = $token_exptime;
	        	$data['business_name'] = $_POST['company'];
	        	$data['email'] = $_POST['email'];
	        	$data['passwd'] = $_POST['password'];
	        	$data['address'] = $_POST['address'];
	        	$data['post_code'] = $_POST['postcode'];
	        	$data['city'] = $_POST['city'];
	        	$data['country'] = $_POST['country'];
	        	$data['status'] = 0;
	        	$data['time'] = date('Y-m-d H:i:s');

				$m = M('userlist');
				$where = array(
						'email' => $email
				);
				$useritem = $m -> where($where) -> find();
				if ($useritem !== null && $useritem['status'] == 1) {
					$this -> error('the login email is used!', 'register');
				}else if ($useritem !== null && $useritem['status'] == 0){
					$token=$useritem['token'];
					$item['token_exptime'] = time()+60*60*24;
                    $m -> where('email='.$email) ->save($item);
					sendSingupSuccessEmail($email, $fullname,$token);
					$this -> redirect('login');
				}else {
					$rmid = $m -> add($data);
					if ($rmid > 0 && $rmid !== false) {
						try{
							sendSingupSuccessEmail($email, $fullname,$token);
						} catch(Exception $e) {
							Log::write('email send failed '.$email, Log::WARN);
						}
						$this -> redirect('login');
					} else {
						$this -> error('Register error, please try again later!', 'register');
					}
				}
			}else{
				$this ->error('Passwords do not match!','register');
			}			
		} else {
			$this -> display();
		}
	}

	public function activeUser(){
		$verify = stripslashes(trim($_GET['verify']));
		$nowtime = time();

		$m = M('userlist');
		$ret = $m->query("select id,token_exptime from userlist where status='0' and `token`='$verify'");
		
		if($ret){
			if($nowtime>$ret[0]['token_exptime']){ //24小时激活有效
				$msg = 'Your activation has expired, please re-register your account to send activation email.';
			}else{
				$row = $m->execute("update userlist set status=1 where id=".$ret[0]['id']);
				if($row !=1) die(0);
				$msg = 'Activation Successful!';
				$this -> redirect('login');
			}
		}else{
			$msg = 'error.';	
		}
		show_dialog($msg);
	}

	public function activeDev(){
        $verify = stripslashes(trim($_GET['verify']));
        $userid = stripcslashes(trim($_GET['id']));
        $nowtime = time();

        $m = M('devlist');
        $where = array(
            'token' => $verify,
            'status' => 0
        );
        $dev = $m -> where($where) -> find();
        
        if($dev !== NULL){
            if($nowtime>$dev['token_exptime']){ //24小时激活有效
                $msg = 'Your activation has expired, please re-register your account to send activation email.';
            }else{
                $row = $m->execute("update devlist set status=1 where id=".$dev['id']);
                $m_at = M('applisttemp');
                $ret = $m_at -> where(array('devid' => $dev['devid'])) -> select();
                if($ret !== NULL){
                    $m_a = M('applist');
                    $ad_control_default = C('AD_CONTROL_DEFAULT');
                    foreach ($ret as $k => $v) {
                       $data = array(
                            'devid' => $v['devid'],
                            'appid' => $v['appid'],
                            'name' => $v['name'],
                            'img' => $v['img'],
                            'promoter_title' => $v['promoter_title'],
                            'description' => $v['description'],
                            'rate' => $v['rate'],
                            'sort' => $v['sort'],
                            'country' => $v['country'],
                            'install' => $v['install'],
                            'size' => $v['size'],
                            'os' => $v['os'],
                            'os_version' => $v['os_version'],
                            'status' => 1,
                            'ad_control' => $ad_control_default,
                            'time' => date('Y-m-d H:i:s')
                        );
                       $m_a -> add($data);
                       $where = array(
                            'devid' => $v['devid'],
                            'appid' => $v['appid']
                        );
                       $m_at -> where($where) -> delete();
                    }
                    $this -> redirect('Auth/login',array('cate_id' => 2),3,'Activation Successful!');
                }else{
                    $msg = "Network busy, activation fails!Please try again later!";
                }
            }
        }else{
            $msg = 'error!The developer account has been activated, do not try again!';
        }
        show_dialog($msg);
    }


	

	
}