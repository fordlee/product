<?php

// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
  //构造函数，验证Session
    public function __construct() {
        parent::__construct(); //一定要注意这一行，这一行是为了执行父类中的构造函数，否则运行是会出错的
        $this->CheckmSession();
    }

    private function CheckmSession(){
        if(!isset($_SESSION['email'])&& !isset($_SESSION['login']) && $_SESSION['login'] !== true){
            $this -> error('Sorry! You have not logged or login timeout, please sign in again!',U('Auth/login'));
        }
    }

    public function index(){
        $userid = $_SESSION['id'];
        $dateRange = $this -> _getDateRange();
        $where = array(
            'id' => $userid,
            'date' => array('between', array($dateRange['begin'], $dateRange['end']))
        );
        $udailead = D('UserDevAppInstallDetailLead'); 
        $item = $udailead -> field("sum(cost) as points,count('load_appid') as earning") -> where($where) -> find();
        $this -> assign('item',$item);

        $udaiload = D('UserDevAppInstallDetailLoad');
        $ret = $udaiload -> field("sum(cost) as points,count('load_appid') as earning") -> where($where) -> find();
        $this -> assign('ret',$ret);

        $m_u = M('userlist');
        $ret1 = $m_u -> field('balance+balance_temp as restPoints') -> where('id='.$userid) -> find();
        $this -> assign('ret1',$ret1);

        $ret2 = $udaiload -> order('c_cost desc') -> field('country_code,sum(cost) as c_cost') -> where($where) -> group('country_code,install_detail.appid') ->select();
        $installCountry = $this -> _getInstallCountry($ret2);
        $this -> assign('installCountry',$installCountry);
        $ctops = array();
        for($i=0;$i<3;$i++){
            $m_c = M('cpilist');
            $code = $ret2[$i]['country_code'];
            $countrys = $m_c -> field('country') -> where("code='$code'") -> find();
            $ret2[$i]['country'] = $countrys['country'];
            array_push($ctops, $ret2[$i]);
        }
        //var_dump($ctops);die();
        $this -> assign('ctops',$ctops);
        
        $udard = D('UserDevAppReportDetail');
        $aitops = $udard -> order('installs desc') -> field('applistid,appid,img,installs,status') -> limit(5) -> where($where) -> select();
        $this -> assign('aitops',$aitops);
        $actops = $udard -> order('cost desc') -> field('applistid,appid,img,cost,status') -> limit(5) -> where($where) -> select();
    	$this -> assign('actops',$actops);

        $uda = D('UserDevApp');
        $w = array(
            'id' => $userid,
            'time' => array('between', array($dateRange['begin'], $dateRange['end']))
        );
        $recentAddApp = $uda -> order('time desc') -> field('applistid,appid,img,name,description') -> limit(5) -> where($w) -> select();
        $this -> assign('recentAddApp',$recentAddApp);
        
        $this->display('index2');
    }


    private function _getDateRange() {
        $today = strtotime(date('Y-m-d'));
        $ret = array (
            'begin' => date('Y-m-d', strtotime('-30 day', $today)),
            'end' => date('Y-m-d', strtotime('-1 day', $today)),
        );
        return $ret;
    }

    private function _getInstallCountry($data){
        foreach ($data as $k => $v) {
            $i_c .= '"'.$v['country_code'].'":'.$v['c_cost'].',';
        }
        $installCountry = '{'.substr($i_c,0,-1).'}';
        return $installCountry;
    }


}