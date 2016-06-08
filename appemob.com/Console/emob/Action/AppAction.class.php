<?php
// 本类由系统自动生成，仅供测试用途
class AppAction extends Action {
  //构造函数，验证Session
    public function __construct() {
        parent::__construct(); //一定要注意这一行，这一行是为了执行父类中的构造函数，否则运行是会出错的
        $this->CheckmSession();
    }

    private function CheckmSession(){
        if(!isset($_SESSION['login']) && $_SESSION['login'] !== true){
            $this -> error('Sorry! You have not logged or login timeout, please sign in again!',U('Auth/login'));
        }
    }
    
    public function index(){
		$this->display('index');
    }

    public function manage(){
        $userid = $_SESSION['id'];

        $uda = D('UserDevApp');
        $retapplist = $uda -> where('userid='.$userid) -> select();
        foreach ($retapplist as $k => $v) {
            $item=json_decode($v['promoter_title'],true);
            if($item['active'] ==1){
                    //var_dump($item);
                    $retapplist[$k]['promoter_title']=$item;
            }else{
                foreach ($item as $k2 => $v2) {
                    if(is_array($v2) && $v2['active']==1){
                        //var_dump($v2);
                        $retapplist[$k]['promoter_title']=$v2;
                    }
                }
            }     
        }

        $applist = array();
        foreach ($retapplist as $k => $v) {
            if($v['devid'] !== NULL){
                array_push($applist, $v);
            }
        }
        
        //var_dump($applist);die();
        $this -> assign('applist',$applist);

        $udat = D('UserDevAppTemp');
        $ret = $udat -> order('time desc') -> where('userid='.$userid) -> select();
        
        foreach ($ret as $k => $v) {
            $item=json_decode($v['promoter_title'],true);
            if($itemt['active'] ==1){
                    //var_dump($item);
                    $ret[$k]['promoter_title']=$item;
            }else{
                foreach ($item as $k2 => $v2) {
                    if(is_array($v2) && $v2['active']==1){
                        //var_dump($v2);
                        $ret[$k]['promoter_title']=$v2;
                    }
                }
            }
        }
        
        $applisttemp = array();
        foreach ($ret as $k => $v) {
            if($v['devid'] !== NULL){
                array_push($applisttemp, $v);
            }
        }
        //var_dump($applisttemp);die();
        $this -> assign('applisttemp',$applisttemp);
        
        $this->display();
    }

    public function showAppInfo(){
        $m = M('applist');
        $appid = $_GET['id'];
        
        $appinfo = $m -> order('id desc') -> where("appid='$appid'") -> find();
        $item=json_decode($appinfo['promoter_title'],true);
        
        if($item['active'] ==1){
            $appinfo['promoter_title']=$item;
        }else{
            foreach ($item as $k => $v) {
                if(is_array($v) && $v['active'] ==1){
                    $appinfo['promoter_title']=$v;
                }
            }
        }
        
        if($appinfo !== NULL){
            $this -> assign('appinfo',$appinfo);
            $this -> assign('item',$item);
            $languages = getLanguage();
            $this -> assign('languages',$languages);
        }else{
            $this -> redirect('manage');
        }

        $this -> display();
    }

    public function appInfoUpdate(){
        $id = I("post.id");
        $data['active'] = I("post.active");
        $data['bid'] = I("post.bid");
        $data['status'] = I("post.active");    
        $data['budget'] = I("post.budget");
        
        if($data !== NULL){
            $m = M('applist');
            $ret = $m -> where("id='$id'") -> save($data);
            if($ret > 0){
                echo 1;
            }            
        }else{
            echo 0;
        }
    }

    public function savetitle(){
        $m = M('applist');
        $id = I("post.id");
        $array1 = I("post.promoter_title");
        $ret = $m -> where('id='.$id) -> getField('promoter_title');
        $array2 = json_decode($ret,true);
        foreach ($array2 as $k => $v) {
            if($array1['active'] == 1){
                $array2[$k]['active'] = '0';
            }
        }
        array_push($array2,$array1);
        $json = json_encode($array2);
        
        $data['promoter_title'] = $json;
        $ret1 = $m -> where('id='.$id) -> save($data);
        if($ret1 > 0){
            echo 1;
        }
    }

    public function edittitle(){
        $m = M('applist');
        $id = I("post.id");
        $oldlanguage = I("post.oldlanguage");
        $array1 = I("post.promoter_title");
        
        $ret = $m -> where('id='.$id) -> getField('promoter_title');
        $array2 = json_decode($ret,true);
        
        foreach ($array2 as $k => $v) {
            if($array1['active'] == 1){
                $array2[$k]['active'] = '0';
            }
            if($oldlanguage == $v['language']){
                $array2[$k] = $array1;
            }
        }
        
        $json = json_encode($array2);
        $data['promoter_title'] = $json;
        
        $ret1 = $m -> where('id='.$id) -> save($data);
        
        if($ret1 > 0){
            echo 1;
        }

    }

    public function deltitle(){
        $id = I("post.id");
        $language = I("post.language");
        $active = I("post.active");
        $m = M('applist');
        $ret = $m -> where('id='.$id) -> getField('promoter_title');
        $titles = json_decode($ret,true);
        //var_dump($active ==1);die();
        foreach ($titles as $k => $v) {   
            if($v['language']==$language){
                //unset($titles[$k]);
                if($active == 1){
                    echo 0;
                }else{
                    array_splice($titles, $k,1);
                }
            }
        }
        
        $data['promoter_title'] = json_encode($titles);
        $ret1 = $m -> where('id='.$id) -> save($data);
        if($ret1 > 0){
            echo 1;
        }
    }

    public function addCountry(){
        $applistid = $_GET['id'];
        $m_c = M('cpilist');
        $m_a = M('applist');
        $m_b = M('bidlist');

        if(isset($_GET['id'])&&!empty($_GET['id'])){            
            $countries = $m_c -> where('cpi!=0') -> select();
            $appinfo = $m_a -> join('bidlist on applist.id = bidlist.applistid') -> field('name,applistid,countryid') -> where('applistid='.$applistid) -> select();
            //var_dump($appinfo);die();  
            $this -> assign('applistid',$applistid);
            $this -> assign('appinfo',$appinfo);
            $this -> assign('countries',$countries);
            $this -> display();
        }else{
            $applistid = $_POST['applistid'];
            $countrids = $_POST['countryid'];
            $m_b -> where('applistid='.$applistid) -> delete();
            foreach ($countrids as $k => $v) {
                $data = array(
                    "applistid" => $applistid,
                    "countryid" => $v
                );
                
                $m_b -> add($data);
            }
            $this -> success("Success!","addCountry?id=$applistid");
        }
    }

    public function showbidinfo(){
        $applistid = $_GET['id'];
        
        $ai = D('AppInfo');
        $cbids = $ai -> field('id,applistid,countryid,bid,bid_country,cpi') -> where('applistid='.$applistid) -> select();
        foreach ($cbids as $k => $v) {
            $cbids[$k]['finalbid'] = $v['cpi']*((100+$v['bid'])/100);
        }

        $counts = count($cbids);
        $this -> assign('applistid',$applistid);
        $this -> assign('counts',$counts);
        $this -> assign('cbids',$cbids);
        $this -> display();
    }

    public function setbid(){
        $applistid = $_POST['applistid'];
        $id = $_POST['id'];
        $data['id'] = $_POST['id'];
        $data['applistid'] = $_POST['applistid'];
        $data['countryid'] = $_POST['countryid'];
        $data['bid'] = $_POST['bid'];

        $m = M('bidlist');
        if(!empty($_POST['id']) && !empty($_POST['bid'])){
            $ret = $m -> where('id='.$id) -> save($data);
        }else{
            $ret = $m -> add($data);
        }
        $this -> success('Success!',"showbidinfo?id=$applistid");   
    }

    public function setbidAll(){
        $item = $_POST;
        $applistid = $_GET['id'];
        $checkall = $item['checkall'];
        $counts = $item['counts'];
        
        $m_b = M('bidlist');
        
        for($i=0;$i<$counts;$i++){
            $id = $item['id'][$i];
            $data['bid'] = $item['bid'][$i];
            $m_b -> where('id='.$id) -> save($data);     
        }
        
        $this -> success('Success!',"showbidinfo?id=$applistid");
        
    }

    public function sendAppbrainEmail(){
        $devid = I("post.devid");
        $app_name = I("post.app_name");
        $devemail = I("post.devemail");
        $img = I("post.img");
        $time = time();
        $token = md5($app_name.$devemail.$time); //创建用于激活识别码
        $token_exptime = time()+60*60*24;//过期时间为24小时后
        
        $data['token'] = $token;
        $data['token_exptime'] = $token_exptime;
        if(!empty($data)){
            $m = M('devlist');
            $ret = $m -> where("devid='$devid'") -> save($data);
            if($ret > 0){
                echo 1;
                $userid = $_SESSION['id'];
                sendAppbrainSuccessEmail($devemail,$app_name,$token,$userid);
            }
        }else{
            echo 0;
        }
    }

    

    
}