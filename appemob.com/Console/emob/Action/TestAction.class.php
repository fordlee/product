<?php
class TestAction extends Action {

	/**本类仅供测试使用*/
	//App信息关联applist cpilist bidlist
	public function test(){
        $m = M('bidlist');
        $ret = $m->join('applist ON applist.id = bidlist.applistid')->join('cpilist ON cpilist.id = bidlist.countryid')->select();
        echo $m->getLastSql();
        var_dump($ret);  
    }

    //App信息关联applist cpilist bidlist
    public function test2(){
        $m = D('AppInfo');
        $ret = $m -> select();
        echo $m->getLastSql();
        var_dump($ret);
    }


    public function test3(){
        $m = D('UserDevApp');
        $ret = $m -> select();
        echo $m->getLastSql();
        var_dump($ret);
    }

    public function datetest(){
        $d='03/01/2016 - 03/31/2016';
        $a=explode(' - ', $d);
        echo $a[0];
        echo $a[1];

        $d='05/28/2014';
        $a=explode('/',$d);
        $d="$a[2]-$a[0]-$a[1]";
        echo $d;
    }

    public function reporttime(){
        $m = M('install_detail');
        $list=$m -> select();
        foreach ($list as $key => $value) {
            $date=$value['date'];
            echo $date.'<br>';
            $time=strtotime($date)+rand(10,60000);

            echo $time.'<br>';
            $m -> where("date='$date'") -> save(array('time' => $time));
        }
    } 

    public function image(){
        $string = 'lh3.googleusercontent.com/aaa/QYpnpxLl34MNSyKc_PE23MN1QBotkbKuED4RzMWLZ6_CFJwf4u6DmIy42Tw0Mtgaqw=w300-rw';
        
        echo $string.'<br>';

        $imgs = explode('/',$string);
        echo preg_replace("/w30.*?$/i", "", $imgs[count($imgs)-1]);
        exit;
        $img = substr($imgs[count($imgs)-1], 0,-7);
        var_dump($img);
    }


    public function domain(){
        $fullname = "hubery";
        $str = "Dear".$fullname."：<br/>Thank you for registering a new account at my station.<br/>Please click on the link to activate your account.<br/><a href='".C('MAIL_DOMAIN')."/console.php/Auth/activeDev?verify=".$token."&id=".$userid."' target='_blank'>".C('MAIL_DOMAIN')."/console.php/Auth/activeDev?verify=".$token."&id=".$userid."</a>";
        //$str = "Dear".$fullname."：<br/>Thank you for registering a new account at my station.<br/>Please click on the link to activate your account.<br/><a href='".C('MAIL_DOMAIN')."/console.php/Auth/activeUser?verify=".$token."' target='_blank'>".C('MAIL_DOMAIN')."/console.php/Auth/activeUser?verify=".$token."</a><br/>If the above link is not clickable, copy it into your browser address bar enter access, within the link valid for 24 hours.<br/>If the activation request is issued by a non-yourself, please ignore this message.<br/><p style='text-align:right'>-------- Hellwd.com yours truly</p>";
        echo $str;
    }

    
}