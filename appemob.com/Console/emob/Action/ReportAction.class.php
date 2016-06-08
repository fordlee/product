<?php
// 本类由系统自动生成，仅供测试用途
class ReportAction extends Action {
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

    public function report(){
        if (isset($_POST['dateRange']) && !empty($_POST['dateRange'])) {
            $dateRange = $_POST['dateRange'];
            $dateRange = $this -> _getDateSwap($dateRange);
        }else{
            //$dateRange = $this -> _getDateRange();
            $today = strtotime(date('Y-m-d'));
            $dateRange = array (
                'begin' => date('Y-m-d', strtotime('-7 day', $today)),
                'end' => date('Y-m-d', strtotime('-1 day', $today)),
            );
        }
        $where = array(
            'date' => array('between', array($dateRange['begin'], $dateRange['end']))
        );
        
        $m_rd = M('report_detail');
        
        if(!empty($_GET['k']) && !empty($_GET['d'])){
            $key = $_GET['k'];
            $direction = $_GET['d'];
            $order = $key.' '.$direction;
            $data = $m_rd -> order($order) -> field('date,sum(imp) as imp,sum(clicks) as clicks,round(sum(clicks)/sum(imp)*100,2) as ctr,sum(installs) as installs,round(sum(installs)/sum(imp)*100,2) as ir,round(sum(installs)/sum(clicks)*100,2) as cr,round(sum(cost)/sum(installs),2) as avgCPI,sum(cost) as cost') -> where($where) -> group('date') -> select();
            $ret = $m_rd -> order($order) -> field('appid,date,imp,clicks,round(clicks/imp*100,2) as ctr,installs,round(installs/imp*100,2) as ir,round(installs/clicks*100,2) as cr,round(cost/installs,2) as avgCPI,cost') -> where($where) ->group('date,appid') -> select();
            $this -> assign('d_'.$key,$direction);
        }else{
            $data = $m_rd -> field('date,sum(imp) as imp,sum(clicks) as clicks,round(sum(clicks)/sum(imp)*100,2) as ctr,sum(installs) as installs,round(sum(installs)/sum(imp)*100,2) as ir,round(sum(installs)/sum(clicks)*100,2) as cr,round(sum(cost)/sum(installs),2) as avgCPI,sum(cost) as cost') -> where($where) -> group('date') -> select();
            $ret = $m_rd -> field('appid,date,imp,clicks,round(clicks/imp*100,2) as ctr,installs,round(installs/imp*100,2) as ir,round(installs/clicks*100,2) as cr,round(cost/installs,2) as avgCPI,cost') -> where($where) ->group('date,appid') -> select();
        }
        
        $appsdata = $data;
        foreach ($data as $k1 => $v1) {
            foreach ($ret as $k2 => $v2) {
                if($v2['date'] == $v1['date']){
                    $appsdata[$k1]['apps'][$k2] = $v2;
                }
            }
        }
        //var_dump($appsdata);die();
        $this -> assign('appsdata',$appsdata);
        $xdate = $this -> _getXDate($data);

        $imp = $this -> _getKindData($data,'imp');
        $clicks = $this -> _getKindData($data,'clicks');
        $installs = $this -> _getKindData($data,'installs');
        $cost = $this -> _getKindData($data,'cost');
        $ctr = $this -> _getKindData($data,'ctr');
        $ir = $this -> _getKindData($data,'ir');
        $cr = $this -> _getKindData($data,'cr');
        $avgCPI = $this -> _getKindData($data,'avgCPI');
        
        $dateRanges = $this -> _getDateSwap($dateRange);
        $this -> assign('dateRange',$dateRanges);
        $this -> assign('appid',$appid);
        $this -> assign('data',$data);
        $this -> assign('xdate',$xdate);
        
        $this -> assign('imp',$imp);
        $this -> assign('clicks',$clicks);
        $this -> assign('installs',$installs);
        $this -> assign('cost',$cost);
        $this -> assign('ctr',$ctr);
        $this -> assign('ir',$ir);
        $this -> assign('cr',$cr);
        $this -> assign('avgCPI',$avgCPI);
        
        $this -> display();
    }


    public function reportDetail(){
        
        if (isset($_POST['dateRange']) && !empty($_POST['dateRange'])) {
            $dateRange = $_POST['dateRange'];
            $appid = $_POST['appid'];
            $dateRange = $this -> _getDateSwap($dateRange);
        }else{
            $appid = $_GET['id'];
            $dateRange = $this -> _getDateRange();
        }
        $where = array(
            'appid' => $appid,
            'date' => array('between', array($dateRange['begin'], $dateRange['end']))
        );
        
        $m_rd = M('report_detail');
        
        if(!empty($_GET['k']) && !empty($_GET['d'])){
            $key = $_GET['k'];
            $direction = $_GET['d'];
            $order = $key.' '.$direction;
            $data = $m_rd -> order($order) -> field('date,imp,clicks,round(clicks/imp*100,2) as ctr,installs,round(installs/imp*100,2) as ir,round(installs/clicks*100,2) as cr,round(cost/installs,2) as avgCPI,cost') -> where($where) -> select();
            $this -> assign('d_'.$key,$direction);
        }else{
            $data = $m_rd -> field('date,imp,clicks,round(clicks/imp*100,2) as ctr,installs,round(installs/imp*100,2) as ir,round(installs/clicks*100,2) as cr,round(cost/installs,2) as avgCPI,cost') -> where($where) -> select();
        }
        
        //var_dump($data);die();
        $xdate = $this -> _getXDate($data);

        $imp = $this -> _getKindData($data,'imp');
        $clicks = $this -> _getKindData($data,'clicks');
        $installs = $this -> _getKindData($data,'installs');
        $cost = $this -> _getKindData($data,'cost');
        $ctr = $this -> _getKindData($data,'ctr');
        $ir = $this -> _getKindData($data,'ir');
        $cr = $this -> _getKindData($data,'cr');
        $avgCPI = $this -> _getKindData($data,'avgCPI');
        
        $dateRanges = $this -> _getDateSwap($dateRange);
        $this -> assign('dateRange',$dateRanges);
        $this -> assign('appid',$appid);
        $this -> assign('data',$data);
        $this -> assign('xdate',$xdate);
        
        $this -> assign('imp',$imp);
        $this -> assign('clicks',$clicks);
        $this -> assign('installs',$installs);
        $this -> assign('cost',$cost);
        $this -> assign('ctr',$ctr);
        $this -> assign('ir',$ir);
        $this -> assign('cr',$cr);
        $this -> assign('avgCPI',$avgCPI);
        
        $this -> display();
    }

    private function _getKindData($data,$kind){
        foreach ($data as $k => $v) {
            $str .= $v[$kind].',';
        }
        $ret = substr($str,0,-1);
        return $ret;
    }

    private function _getXDate($data){
        foreach ($data as $k => $v) {
            $xdate .= '"'.$v[date].'"'.",";
        }
        $xdate = substr($xdate, 0, -1);
        return $xdate;
    }

    private function _getDateSwap($dateRange){
        if(is_array($dateRange)){
            //将数组时间转为字符串时间
            $dateRange['begin'] = date("m/d/Y",strtotime($dateRange['begin']));
            $dateRange['end'] = date("m/d/Y",strtotime($dateRange['end']));
            $dateRange = implode(' - ',$dateRange);
        }else{
            //将字符串03/01/2016 - 03/25/2016转为数组
            $date = explode(' - ', $dateRange);
            $dateRange = array();
            $dateRange['begin'] = date('Y-m-d',strtotime($date[0]));
            $dateRange['end'] = date('Y-m-d',strtotime($date[1]));
        }
        return $dateRange;
    }

    private function _getDateRange() {
        $today = strtotime(date('Y-m-d'));
        $ret = array (
            'begin' => date('Y-m-d', strtotime('-30 day', $today)),
            'end' => date('Y-m-d', strtotime('-1 day', $today)),
        );
        return $ret;
    }

    //分国家总安装信息
    public function installCountry(){
        if (isset($_POST['dateRange']) && !empty($_POST['dateRange'])) {
            $dateRange = $_POST['dateRange'];
            $appid = $_POST['appid'];
            $dateRange = $this -> _getDateSwap($dateRange);
        }else{
            $appid = $_GET['id'];
            $dateRange = $this -> _getDateRange();
        }
        $where = array(
            'appid' => $appid,
            'date' => array('between', array($dateRange['begin'], $dateRange['end']))
        );
        
        $m_i = M('install_detail');
        $installDetail = $m_i -> order('time DESC') -> join('cpilist on install_detail.country_code = cpilist.code') -> where($where) -> select();
        
        $languages = getLanguage();
        foreach ($languages as $k1 => $v1) {
            foreach ($installDetail as $k2 => $v2) {
                if($v2['language'] == $k1){
                    $installDetail[$k2]['language'] = $v1;
                }
            }
        }
        
        $installCountry = $this -> _getInstallCountry($m_i,$where);
        $this -> assign('installCountry',$installCountry);
        $dateRanges = $this -> _getDateSwap($dateRange);
        $this -> assign('dateRange',$dateRanges);
        $this -> assign('appid',$appid);
        $this -> assign('installDetail',$installDetail);
        $this -> display();
    }

    private function _getInstallCountry($m,$w){
        $ret = $m -> field('country_code,sum(cost) as c_cost')  -> where($w) -> group('country_code,appid') -> select();
        foreach ($ret as $k => $v) {
            $i_c .= '"'.$v['country_code'].'":'.$v['c_cost'].',';
        }
        $installCountry = '{'.substr($i_c,0,-1).'}';
        return $installCountry;
    }

    //分国家明细安装信息
    public function installDetailCountry(){
        $appid = $_GET['id'];
        $country_code = $_GET['c'];
        $dateRange = $_GET['d'];
        $dateRange = $this -> _getDateSwap($dateRange);
        
        $where = array(
            'country_code' => $country_code,
            'appid' => $appid,
            'date' => array('between', array($dateRange['begin'], $dateRange['end']))
        );
        $m_i = M('install_detail');
        $installDetailCountry = $m_i -> order('date DESC') -> join('cpilist on install_detail.country_code = cpilist.code') -> where($where) -> select();
        
        $w = array(
            'appid' => $appid,
            'date' => array('between', array($dateRange['begin'], $dateRange['end']))
        );
        $installCountry = $this -> _getInstallCountry($m_i,$w);
        $this -> assign('installCountry',$installCountry);

        $dateRanges = $this -> _getDateSwap($dateRange);
        $this -> assign('dateRange',$dateRanges);
        $this -> assign('appid',$appid);
        $this -> assign('installDetail',$installDetailCountry);
        $this -> display('installCountry');
    }


}