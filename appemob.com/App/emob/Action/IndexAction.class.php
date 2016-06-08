<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {

    //构造函数
    public function __construct() {
        parent::__construct();
        $this->checkParams();
    }

    private function checkParams(){
    	
    }

    public function index(){
    	$this -> display();
    }

    public function login(){
        if (isset($_POST['username']) && !empty($_POST['username'])) {
            $email = $_POST['username'];
            $pwd = $_POST['password'];
            $m = M('userlisttemp');
            $where = array(
                    'email' => $email,
                    'passwd' => $pwd,
            );
            $useritem = $m -> where($where) -> find();
            
            if ($useritem !== null) {
                if ($useritem['status']) {
                    $_SESSION['login'] = true;
                    $_SESSION['email'] = $email;
                    $_SESSION['id'] = $useritem['id'];
                    //$url = "/console.php/Index/index";
                    $url ="/index.php/Index/index";
                    $this -> _sendredirect($url);
                } else {
                    $this -> error('账号未激活，请先登录注册邮箱激活！','Index/index');
                }
            } else {
                $this -> error('email or password error!', 'login');
            }
        } else {
            $this -> display();
        }
    }

    public function register(){
        $business_name = $_POST['company_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password1 = $_POST['password1'];
        $regtime = time();

        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            if($password == $password1){
                $token = md5($business_name.$password.$regtime); //创建用于激活识别码
                $token_exptime = time()+60*60*24;//过期时间为24小时后

                $data['business_name'] = $business_name;
                $data['email'] = $email;
                $data['passwd'] = $password;
                $data['token'] = $token;
                $data['token_exptime'] = $token_exptime;
                $data['time'] = date('Y-m-d H:i:s');

                $m = M('userlisttemp');
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
                    sendSingupSuccessEmail($email, $business_name,$token);
                    $url = "/index.php/Index/index";
                    $this -> _sendredirect($url);
                }else {
                    $rmid = $m -> add($data);
                    if ($rmid > 0 ) {
                        try{
                            sendSingupSuccessEmail($email, $business_name,$token);
                        } catch(Exception $e) {
                            Log::write('email send failed '.$email, Log::WARN);
                        }
                        $url = "/index.php/Index/index";
                        $this -> _sendredirect($url);
                    } else {
                        $this -> error('Register error, please try again later!', 'register');
                    }
                }
            }else{
                $this ->error('密码输入不一致!','register');
            }
        }else{
            $this -> display();
        }        
    }


    
    public function active(){
        $verify = stripslashes(trim($_GET['verify']));
        $nowtime = time();

        $m = M('userlisttemp');
        $ret = $m->query("select id,token_exptime from userlisttemp where status='0' and `token`='$verify'");
        //var_dump($ret);die();
        if($ret){
            if($nowtime>$ret[0]['token_exptime']){ //24小时激活有效
                $msg = '您的激活有效期已过，请重新注册您的帐号发送激活邮件.';
            }else{
                $row = $m->execute("update userlisttemp set status=1 where id=".$ret[0]['id']);
                if($row !=1) die(0);
                $msg = '激活成功！';
                $url = "/index.php/Index/index";
                $this -> _sendredirect($url);
                //$url = "/console.php/Index/index";
                //$this -> _sendredirect($url);
            }
        }else{
            $msg = 'error.';    
        }
    }


    public function resetpwd(){
        $email = $_POST['email'];
        $resetpwd = $_POST['resetpwd'];
        var_dump($_POST);die();
        if(!empty($_POST['email']) && !empty($_POST['resetpwd'])){
            $ut_m = M('userlisttemp');
            $item = array(
                'email' => $email,
                'passwd' => $resetpwd
            );

            $ut_m -> where("email='$email'") -> save($item);
            if ($ut_m >0 ) {
                $url = "/index.php/Index/index";
                $this -> _sendredirect($url);
            }
        }
    }


    public function contact(){
        $email = $_POST['email'];
        $company_name = $_POST['company_name'];
        $message = $_POST['message'];
        $ut_m = M('userlisttemp');
        $ustemp_id = $ut_m -> where("email='$email'") -> getField('id');

        $data['ustemp_id'] = $ustemp_id;
        $data['company_name'] = $company_name;
        $data['contact_message'] = $message;
        $c_m = M('contactlist');
        $ret = $c_m -> add($data);
        
        if($ret > 0){
            $url = "/index.php/Index/index";
            $this -> _sendredirect($url);
        }
        
    }

    //Success! Our workers will contact you later!
    private function _sendredirect($url){
        $msg = "Success! Our publisher manager will contact you later!";
        echo '<script type="text/javascript">top.location.href="'.$url.'";window.alert("'.$msg.'");</script>';
    }


    public function show(){
        $string = "helloworldAppmobShow";
        $id= $_GET['id'];
        if($id !== $string){
            die();
        }
        $m = M('userlisttemp');
        $ret = $m -> select();
    $html=
<<<EOT
<div class="row">
<table id="example1" class="table table-bordered table-striped">          
<thead>
<tr>
<th>Id&nbsp;</th>
<th>Company</th>
<th>Email</th>
<th>Password</th>
</tr>
</thead>
<tbody>
EOT;
foreach ($ret as $k => $vo){
    $html.=
'<tr>'.
'<th>'.$vo["id"].'&nbsp;&nbsp;</th>'.
'<th>'.$vo["business_name"].'&nbsp;&nbsp;</th>'.
'<th>'.$vo["email"].'&nbsp;&nbsp;</th>'.
'<th>'.$vo["passwd"].'&nbsp;&nbsp;</th>'.
'</tr>';
}
$html.=<<<EOT
<div class="row">
</tbody>
</table>
</div> 
EOT;
echo $html;
}

}
?>