<?php
class KdsBannersAction extends Action{

    private function _checklogin() {
        $ret = false;
        if (isset($_SESSION['login']) && $_SESSION['login'] == true && $_SESSION['rule'] == 'admin') {
            $ret = true;
        }
        return $ret;
    }

	private function _getKdsBaseUrl(){
    	$url = 'http://kds1.adspirit.de/user/stat.php?&submit2=1&time=date&notoken=1&from_h=0&to_h=23&uid%5B%5D=36&beginWeek=0&weekday=0&hours=0&country=0&countryfilter=&wsid_grp=1&trkcook=1&trksesi=1&trkview=1&leaddate=0&trk_grplinked=0&tblgroup=intView,sumAP,TKPAP&imggroup=0/1/2&output=csv&kname=DS&kpass=125810cxj';

    	return $url;
    }

    private function _getKdsStats($dateRange){
    	
        $start = strtotime($dateRange['begin']);
    	$end = strtotime($dateRange['end']);
        $params = array(
            'from_d' => date('d',$start),
            'from_m' => date('m',$start),
            'from_y' => date('y',$start),
     		'to_d'   => date('d',$end),
     		'to_m'   => date('m',$end),
     		'to_y'   => date('y',$end)
        );
        
        $baseurl = $this -> _getKdsBaseUrl();
  		$url = $baseurl.'&'.http_build_query($params);
		$retcsv = file_get_contents($url, false);
		$retcsv = str_replace('"Date","Website","Views","Sum | (Publisher)","eCPM | (Publisher)"','"date","website","views","profit","cpm"',$retcsv);
		
        //file_put_contents('file.csv',$retcsv);
		//$retcsv = file_get_contents('file.csv');
		//$retcsv = str_replace('Date,Website,Views,Sum | (Publisher),eCPM | (Publisher)','date,website,views,profit,cpm',$retcsv);
				
        import('ORG.Util.parseCSV');
        $csv = new parseCSV();
        $csv->auto($retcsv);
        $ret = array();
        $ucids = $this -> _getKdsucids();
        foreach ($csv->data as $key => $row) {
            if($row['website'] != 'HWD_PB' && $row['website'] != 'HWD_Banners_Inject_CubeTest' && $row['website'] != '[Sum]'){
                $uid = $ucids[$row['website']]['o_uid'];
                $cid = $ucids[$row['website']]['o_cid'];
                $ret[] = array(
                    'date' => date('Y-m-d',strtotime($row['date'])),
                    'uid' => $uid,
                    'cid' => $cid,
                    'pop' => $row['views'],
                    'profit' => $row['profit'],
                    'cpm' => $row['cpm']
                );
            }
        }
        return $ret;
    }

    private function _setKdsStaticsToDB($statics,$t) {
        $m = M('admin_info');
        for ($i = 0, $j = count($statics); $i < $j; $i++) {
            $info = $statics[$i];
            $where = array(
                'date' => $info['date'],
                'uid' => $info['uid'],
                'cid' => $info['cid']
            );
            $item = array(
                'token' => '',
                'uid' => $info['uid'],
                'cid' => $info['cid'],
                'pop' => intval($info['pop']),
                'click' => 0,
                'convers' => 0,
                'cpm' => floatval($info['cpm']),
                'ctr' => 0,
                'date' => $info['date'],
                'profit' => floatval($info['profit']),
                'importdate' => date("Y-m-d H:i:s"),
                't' => $t
            );
            $isExist = $m -> where($where) -> find();
            if ($isExist != null) {
                $item['id'] = $isExist['id'];
                $istolocal = $isExist['istolocal'];
                if($istolocal = 0){
                    $ret = $m -> save($item);
                } 
            }else{
                $ret = $m -> add($item);
            }
            if($ret != false){
                $uid = $info['uid'];
                $cid = $info['cid'];
                $this -> _updateChannelUpdatetime($uid, $cid);
            }
        }  
        return true;
    }

    private function _updateChannelUpdatetime($uid, $cid) {
        $ac_m = M('admin_channel');
        $ac_where = array(
            'uid' => $uid,
            'cid' => $cid
        );
        $ac_ret = $ac_m -> where($ac_where) -> find();
        if ($ac_ret !== null) {
            $ac_ret['updatetime'] = date('Y-m-d H:i:s');
            $ret = $ac_m -> save($ac_ret);
        }
    }

    private function _getKdsucids(){
    	$kdsBannerToUser = file_get_contents(APP_PATH.'Conf/kdsuser.json');
		$kds = json_decode($kdsBannerToUser,true);
		$ucids = array();
		$m_u = M('user');
        foreach ($kds as $k => $v){
        	$where = array(
        		"username" => $v,
        		"t" => 'banners'
        	);
        	$ucids[$k] = $m_u -> field('o_uid,o_cid') -> join('userchannel on user.uid = userchannel.uid') -> join('channel on userchannel.cid=channel.cid') -> where($where) -> find();
        }

        return $ucids;
    }

    private function _getDateRange() {
        $today = strtotime(date('Y-m-d'));
        $ret = array (
            'begin' => date('Y-m-d', strtotime('-1 day', $today)),
            'end' => date('Y-m-d')
        );
        if (isset($_POST['dateRange'])) {
            $dateRange = $_POST['dateRange'];
            if ($dateRange == 'today') {
                $ret['begin'] = date('Y-m-d');
                $ret['end'] = date('Y-m-d');
            }else if($dateRange == 'yesterday'){
                
            } else if ($dateRange == 'last_7_days') {
                $ret['begin'] = date('Y-m-d', strtotime('-7 day', $today));
                $ret['end'] = date('Y-m-d', strtotime('-1 day', $today));
            } else if ($dateRange == 'last_30_days') {
                $ret['begin'] = date('Y-m-d', strtotime('-30 day', $today));
                $ret['end'] = date('Y-m-d', strtotime('-1 day', $today));
            } else if ($dateRange == 'this_month') {
                $ret['begin'] = date('Y-m-01');
                $ret['end'] = date('Y-m-d');
            } else if ($dateRange == 'last_month') {
                $ret['begin'] = date('Y-m-d', strtotime('-1 month', strtotime(date('Y-m-01'))));
                $ret['end'] = date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-01'))));
            } else if ($dateRange == 'custom') {
                if (isset($_POST['date_start']) && isset($_POST['date_end'])) {
                    $ret['begin'] = $_POST['date_start'];
                    $ret['end'] = $_POST['date_end'];
                }
            }
        }
        return $ret;
    }

    private function _setStatisticsToLocalDB($uid, $cid, $discount) {
        $infom = M('admin_info');
        $limitCount = 20;
        $where = array(
            'uid' => $uid,
            'cid' => $cid,
            'istolocal' => 0
        );
        $ret = $infom -> where($where) -> order('date desc') -> limit($limitCount) -> select();
        if (!empty($ret)) {
            $localm = M('info');
            $failCount = 0;
            for ($i = 0, $j = count($ret); $i < $j; $i++) {
                $infoitem = $ret[$i];

                $localitem = $this -> _getDiscountInfo($infoitem, $discount);
                if (!discountGateway($infoitem, $localitem, $discount)) {
                    exit('ERROR GATEWAY');
                }
                $localwhere = array(
                    'o_uid' => $infoitem['uid'],
                    'o_cid' => $infoitem['cid'],
                    'date' => $infoitem['date']
                );
                $existitem = $localm -> where($localwhere) -> find();
                $isSuccess = false;
                if ($existitem !== null) {
                    $localitem['id'] = $existitem['id'];
                    $localret = $localm -> save($localitem);
                    if ($localret !== false) {
                        $isSuccess = true;
                    } else {
                        $failCount = $failCount + 1;
                    }
                } else {
                    $localret = $localm -> add($localitem);
                    if ($localret !== false) {
                        $isSuccess = true;
                    } else {
                        $failCount = $failCount + 1;
                    }
                }
                if ($isSuccess) {
                    if (isDateBiger($infoitem['date'], 5)) {
                        continue;
                    }

                    if ($j != $limitCount && $i == 0) {
                        continue;
                    }
                    $infoitem['istolocal'] = 1;
                    $infoitem['discount'] = $discount;
                    $inforet = $infom -> save($infoitem);
                    if ($inforet === false) {
                        $failCount = $failCount + 1;
                    }
                }
            }
            if ($failCount == 0) {
                return 1;
            } else {
                return '部分转换失败，失败数：' . $failCount;
            }
        } else {
            return 4;
        }
    }

    private function _getDiscountInfo($infoitem, $discount) {
        $ret = array(
            'o_token' => $infoitem['token'],
            'o_uid' => $infoitem['uid'],
            'o_cid' => $infoitem['cid'],
            'o_t' => $infoitem['t'],
            'pop' => $infoitem['pop'],
            'click' => $infoitem['click'],
            'convers' => $infoitem['convers'],
            'ctr' => $infoitem['ctr'],
            'date' => $infoitem['date'],
            'importdate' => date('Y-m-d H:i:s')
        );
        $pops = intval($infoitem['pop']);
        $profit = $infoitem['profit'];
        $newprofit = floor(floatval($profit) * $discount * 10000) / 10000;
        $newcpm = floor(($newprofit * 1000 / $pops) * 100) / 100;
        $ret['cpm'] = $newcpm;
        $ret['profit'] = $newprofit;
        return $ret;
    }

    private function _getDiscount($uid,$cid){
        $cm = M('channel');
        $cwhere = array(
            'o_uid' => $uid,
            'o_cid' => $cid,
            'isused' => 1,
            't' => 'banners'
        );
        $cret = $cm -> where($cwhere) -> find();
        //var_dump($cret);
        $ucm = M('userchannel');
        $ucwhere = array('cid' => $cret['cid']);
        $ucret = $ucm -> where($ucwhere) -> find();
        //var_dump($ucret);
        if($ucret !== null){
            $uwhere = array('uid' => $ucret['uid'], 'isactive' => 1);
            $um = M('user');
            $discount = $um -> where($uwhere) -> getField('discount');
            //var_dump($discount);
            return $discount;
        }
    }

    //同步数据
    public function setKdsStatistics(){
        if($this -> _checklogin()){
            if(isset($_POST['dateRange']) && isset($_POST['date_start']) && isset($_POST['date_end'])){
                $dateRange = $this -> _getDateRange();
                $statics = $this -> _getKdsStats($dateRange);
            }
            if (!empty($statics)) {
                $isToDB = $this -> _setKdsStaticsToDB($statics,'banners');
                if($isToDB){
                    foreach ($statics as $k => $v) {
                        $uid = $v['uid'];
                        $cid = $v['cid'];
                        //var_dump($v);
                        $discount = $this -> _getDiscount($uid,$cid);
                        $this -> _setStatisticsToLocalDB($uid, $cid, $discount);
                    }
                    echo 1;
                }else{
                    echo 2;
                }
            } else {
                echo 3;
            }
        }else{
            echo 0;
        }
    }


}
?>