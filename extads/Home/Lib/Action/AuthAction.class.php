<?php
// 本类由系统自动生成，仅供测试用途
class AuthAction extends Action {
    public function login() {
        if (isset($_POST['username'])) {
            $usr = $_POST['username'];
            $pwd = $_POST['password'];
            $m = M('user');
            $where = array(
                'username' => $usr,
                'password' => $pwd
            );
            $useritem = $m -> where($where) -> find();
            if ($useritem !== null) {
                if ($useritem['isactive']) {
                    $_SESSION['login'] = true;
                    $_SESSION['username'] = $usr;
                    $_SESSION['uid'] = $useritem['uid'];
                    unset($_SESSION['rule']);
                    $this -> redirect('Index/index');
                } else {
                    $this -> redirect('underreview');
                }
            } else {
                $this -> error('username or password error!', 'login');
            }
        } else {
            $this -> display();
        }
    }

    public function underreview() {
        $this -> display();
    }

    public function signup() {
        if (isset($_POST['username']) && !empty($_POST['username'])) {
            $usr = $_POST['username'];
            $pwd = $_POST['password'];
            $repwd = $_POST['repassword'];
            $country = $_POST['country'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $ext = $_POST['ext'];
            $company = $_POST['company'];
            $skype = $_POST['skype'];
            $platform = $_POST['platform'];
            $f = $_POST['f'];
            if($pwd != $repwd){
                $this -> error('The passwords you typed do not match!','signup');
            }
            $m = M('user');
            $where = array(
                'username' => $usr
            );
            $useritem = $m -> where($where) -> find();
            if ($useritem !== null) {
                $this -> error('the login username email is used!', 'signup');
            } else {
                $uid = $this -> _addUserDB($usr, $pwd, 0.6, $country, $skype, $firstname, $lastname, $ext, $company, $f,$platform);
                if ($uid !== 0) {
                    try{
                        sendSingupSuccessEmail($usr, $firstname);
                    } catch(Exception $e) {
                        Log::write('email send failed '.$usr, Log::WARN);
                    }
                    $this -> redirect('signupsuccess');
                } else {
                    $this -> error('Sign Up error, please try again later!', 'login');
                }
            }
        } else {
            $countries = $this -> _getCountry();
            $this -> assign('countries', $countries);
            $this -> display();
        }
    }

    public function signupsuccess() {
        $this -> display();
    }

    //官网浏览用户留言
    public function contact(){
        if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])){
            $date = date('Y-m-d H:i:s');
            $username = $_POST['name'];
            $email = $_POST['email'];
            $message = $date.' Msg:'.$_POST['message'].'|';
            $item = array(
                "username" => $username,
                "email"    => $email,
                "message"  => $message,
                'date'     => $date
            );
            $m = M('usercontact');
            $ret = $m -> where(array("email"=>$email)) -> find();
            if($ret !== NULL){
                $msg = $ret['message'];
                $item['message'] = $msg.$message;
                $m -> where(array("username" => $username,"email"=>$email)) -> save($item);
            }else{
                $m -> add($item);
            }
            $this -> redirect('login');
        }else{
            $this -> display();
        } 
    }

    //用户密码邮件提醒操作
    public function resetPwd(){
        if($_POST['email']){
            $email = $_POST['email'];
            $m_u = M('user');
            $useritem = $m_u -> field('firstname,password') -> where(array("username" => $email)) -> find();
            if($useritem != null){
                $firstname = $useritem['firstname'];
                $password = $useritem['password'];
                $result=sendResetPwdEmail($email,$firstname,$password);
                if($result == 1){
                    echo '<script type="text/javascript">alert("Please get your password in your account email!");</script>';
                    $this -> success('your password is sended to your account email!','login');
                }else{
                    $this -> error('your username '.$email.' is not exist!','resetPwd');
                }
            }else{
                echo '<script type="text/javascript">alert("your username '.$email.' is not exist!");</script>';
                $this -> error('your username '.$email.' is not exist!','resetPwd');
            }
        }else{
            $this -> display('reset');
        }
    }

    private function _addUserDB($username, $password, $discount, $country, $skype, $firstname, $lastname, $ext, $company, $f,$platform) {
        $m = M('user');
        $uid = createUserId(6);
        $isRepeat = $m -> where(array('uid' => $uid)) -> count();
        while ($isRepeat > 0) {
            $uid = createUserId(6);
            $isRepeat = $m -> where(array('uid' => $uid)) -> count();
        }
        $useritem = array(
            'uid' => $uid,
            'token' => md5($username),
            'username' => $username,
            'password' => $password,
            'discount' => $discount,
            'checkcycle' => 1,
            'country' => $country,
            'skype' => $skype,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'ext' => $ext,
            'company' => $company,
            'addtime' => date('Y-m-d H:i:s'),
            'isactive' => 0,
            'f' => $f,
            'platform' => $platform,
            'adtypes' => $adtypes
        );
        $mret = $m -> add($useritem);
        if ($mret > 0) {
            return $uid;
        } else {
            return 0;
        }
    }

    private function _checklogin() {
        $ret = false;
        if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
            $isMultiAds = isHasMultiAds();
            if (count($isMultiAds) > 1) {
                for ($i = 0, $j = count($isMultiAds); $i < $j; $i++) {
                    $this -> assign('multiads_' . $isMultiAds[$i]['types'], 1);
                }
                $adt = initAdt();
                $this -> assign('adt', $adt);
                $this -> assign('multiads', 1);
            }
            $ret = true;
        }
        return $ret;
    }

    private function _getUid() {
        return $_SESSION['uid'];
    }

    private function _getUserInfo() {
        $m = M('user');
        $where = array('uid' => $this -> _getUid(), 'isactive' => 1);
        $ret = $m -> where($where) -> find();
        return $ret;
    }

    private function _getCountry() {
        $countries = array(
                'Afghanistan',
                'Aland Islands',
                'Albania',
                'Algeria',
                'American Samoa',
                'Andorra',
                'Angola',
                'Anguilla',
                'Antarctica',
                'Antigua and Barbuda',
                'Argentina',
                'Armenia',
                'Aruba',
                'Asia/Pacific Region',
                'Australia',
                'Austria',
                'Azerbaijan',
                'Bahamas',
                'Bahrain',
                'Bangladesh',
                'Barbados',
                'Belarus',
                'Belgium',
                'Belize',
                'Benin',
                'Bermuda',
                'Bhutan',
                'Bolivia',
                'Bosnia and Herzegovina',
                'Botswana',
                'Bouvet Island',
                'Brazil',
                'British Indian Ocean Territory',
                'Brunei Darussalam',
                'Bulgaria',
                'Burkina Faso',
                'Burundi',
                'Cambodia',
                'Cameroon',
                'Canada',
                'Cape Verde',
                'Cayman Islands',
                'Central African Republic',
                'Chad',
                'Chile',
                'China',
                'Christmas Island',
                'Cocos (Keeling) Islands',
                'Colombia',
                'Comoros',
                'Congo',
                'Congo, The Democratic Republic of the',
                'Cook Islands',
                'Costa Rica',
                'Cote d\'Ivoire',
                'Croatia',
                'Cuba',
                'Cyprus',
                'Czech Republic',
                'Denmark',
                'Djibouti',
                'Dominica',
                'Dominican Republic',
                'Ecuador',
                'Egypt',
                'El Salvador',
                'Equatorial Guinea',
                'Eritrea',
                'Estonia',
                'Ethiopia',
                'Europe',
                'Falkland Islands (Malvinas)',
                'Faroe Islands',
                'Fiji',
                'Finland',
                'France',
                'French Guiana',
                'French Polynesia',
                'French Southern Territories',
                'Gabon',
                'Gambia',
                'Georgia',
                'Germany',
                'Ghana',
                'Gibraltar',
                'Greece',
                'Greenland',
                'Grenada',
                'Guadeloupe',
                'Guam',
                'Guatemala',
                'Guernsey',
                'Guinea',
                'Guinea-Bissau',
                'Guyana',
                'Haiti',
                'Heard Island and McDonald Islands',
                'Holy See (Vatican City State)',
                'Honduras',
                'Hong Kong',
                'Hungary',
                'Iceland',
                'India',
                'Indonesia',
                'Iran,  Islamic Republic of',
                'Iraq',
                'Ireland',
                'Isle of Man',
                'Israel',
                'Italy',
                'Jamaica',
                'Japan',
                'Jersey',
                'Jordan',
                'Kazakhstan',
                'Kenya',
                'Kiribati',
                'Korea,  Democratic People\'s Republic of',
                'Korea,  Republic of',
                'Kuwait',
                'Kyrgyzstan',
                'Lao People\'s Democratic Republic',
                'Latvia',
                'Lebanon',
                'Lesotho',
                'Liberia',
                'Libyan Arab Jamahiriya',
                'Liechtenstein',
                'Lithuania',
                'Luxembourg',
                'Macao',
                'Macedonia',
                'Madagascar',
                'Malawi',
                'Malaysia',
                'Maldives',
                'Mali',
                'Malta',
                'Marshall Islands',
                'Martinique',
                'Mauritania',
                'Mauritius',
                'Mayotte',
                'Mexico',
                'Micronesia,  Federated States of',
                'Moldova,  Republic of',
                'Monaco',
                'Mongolia',
                'Montenegro',
                'Montserrat',
                'Morocco',
                'Mozambique',
                'Myanmar',
                'Namibia',
                'Nauru',
                'Nepal',
                'Netherlands',
                'Netherlands Antilles',
                'New Caledonia',
                'New Zealand',
                'Nicaragua',
                'Niger',
                'Nigeria',
                'Niue',
                'Norfolk Island',
                'Northern Mariana Islands',
                'Norway',
                'Oman',
                'Other Country',
                'Pakistan',
                'Palau',
                'Palestinian Territory',
                'Panama',
                'Papua New Guinea',
                'Paraguay',
                'Peru',
                'Philippines',
                'Pitcairn',
                'Poland',
                'Portugal',
                'Puerto Rico',
                'Qatar',
                'Reunion',
                'Romania',
                'Russian Federation',
                'Rwanda',
                'Saint Helena',
                'Saint Kitts and Nevis',
                'Saint Lucia',
                'Saint Pierre and Miquelon',
                'Saint Vincent and the Grenadines',
                'Samoa',
                'San Marino',
                'Sao Tome and Principe',
                'Satellite Provider',
                'Saudi Arabia',
                'Senegal',
                'Serbia',
                'Seychelles',
                'Sierra Leone',
                'Singapore',
                'Slovakia',
                'Slovenia',
                'Solomon Islands',
                'Somalia',
                'South Africa',
                'South Georgia and the South Sandwich Islands',
                'Spain',
                'Sri Lanka',
                'Sudan',
                'Suriname',
                'Svalbard and Jan Mayen',
                'Swaziland',
                'Sweden',
                'Switzerland',
                'Syrian Arab Republic',
                'Taiwan',
                'Tajikistan',
                'Tanzania,  United Republic of',
                'Thailand',
                'Timor-Leste',
                'Togo',
                'Tokelau',
                'Tonga',
                'Trinidad and Tobago',
                'Tunisia',
                'Turkey',
                'Turkmenistan',
                'Turks and Caicos Islands',
                'Tuvalu',
                'Uganda',
                'Ukraine',
                'United Arab Emirates',
                'United Kingdom',
                'United States',
                'United States Minor Outlying Islands',
                'Uruguay',
                'Uzbekistan',
                'Vanuatu',
                'Venezuela',
                'Vietnam',
                'Virgin Islands,  British',
                'Virgin Islands, U.S.',
                'Wallis and Futuna',
                'Western Sahara',
                'Yemen',
                'Zambia',
                'Zimbabwe'
            );
        return $countries;
    }

    public function account() {
        if ($this -> _checklogin()) {
            $user = $this -> _getUserInfo();
            if ($user != null) {
                $this -> assign('username', $user['username']);
                $this -> assign('paypal', $user['paypal']);
                $this -> assign('firstname', $user['firstname']);
                $this -> assign('lastname', $user['lastname']);
                $this -> assign('country', $user['country']);
                $this -> assign('skype', $user['skype']);
                $this -> assign('ext', $user['ext']);
                $this -> assign('company', $user['company']);
            }
            $countries = $this -> _getCountry();
            $this -> assign('countries', $countries);
            $this -> display();
        } else {
            $this -> redirect('Auth/login');
        }
    }

    public function modifyuser() {
        if ($this -> _checklogin()) {
            if(isset($_POST['country'])) {
                $paypal = $_POST['paypal'];
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $country = $_POST['country'];
                $skype = $_POST['skype'];
                $ext = $_POST['ext'];
                $company = $_POST['company'];
                $user = $this -> _getUserInfo();
                if ($user !== null) {
                    $user['paypal'] = $paypal;
                    $user['firstname'] = $firstname;
                    $user['lastname'] = $lastname;
                    $user['country'] = $country;
                    $user['skype'] = $skype;
                    $user['ext'] = $ext;
                    $user['company'] = $company;
                    $m = M('user');
                    $ret = $m -> save($user);
                    if ($ret > 0) {
                        $this -> success('Modify Success', 'account');
                    } else {
                        $this -> error('Modify Fail, Please contact us', 'account');
                    }
                }
            }
            $this -> redirect('account');
        } else {
            $this -> redirect('Auth/login');
        }
    }

    public function changepwd() {
        if ($this -> _checklogin()) {
            if(isset($_POST['oldpwd'])) {
                $oldpwd = $_POST['oldpwd'];
                $newpwd = $_POST['newpwd'];
                $confirm = $_POST['confirm'];
                if ($newpwd != $confirm) {
                    $this -> error('the new password and confirming password disagree', 'account');
                } else if (strlen($newpwd) < 6 || strlen($newpwd) > 20) {
                    $this -> error('new password to short or to long', 'account');
                } else {
                    $user = $this -> _getUserInfo();
                    if ($user === null || $user['password'] !== $oldpwd) {
                        $this -> error('old password error', 'account');
                    } else {
                        $user['password'] = $newpwd;
                        $m = M('user');
                        $ret = $m -> save($user);
                        if ($ret > 0) {
                            $this -> success('Change Success', 'account');
                        } else {
                            $this -> error('Change Fail', 'account');
                        }
                    }
                }
            }
            $this -> redirect('account');
        } else {
            $this -> redirect('Auth/login');
        }
    }

    public function logout() {
        unset($_SESSION['login']);
        unset($_SESSION['username']);
        unset($_SESSION['uid']);
        unset($_SESSION['adt']);
        $this -> redirect('Auth/login');
    }
}