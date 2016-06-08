<?php
class TestAction extends Action{
	private $token;

	private function _checklogin() {
        $ret = false;
        if (isset($_SESSION['login']) && $_SESSION['login'] == true && $_SESSION['rule'] == 'admin') {
            $ret = true;
        }
        return $ret;
    }

    private function _getBaseUrl($type) {
        return 'https://myadcash.com/console/api_proxy.php';
    }

    private function _getAdcashToken() {
        if (!empty($this -> token)) {
            return $this -> token;
        }
        $url = 'https://www.myadcash.com/console/login_proxy.php';
        $params = array(
            'login' => 'alex.webstore.com@gmail.com',
            'password' => 'doriscxj125810'
        );
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($params),
            ),
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if (!empty($result)) {
            $result = json_decode($result);
            $result = $result -> token;
            $this -> token = $result;
        } else {
            $result = '';
        }
        return $result;
    }

    private function _getStats($start, $end, $uid, $cid) {
        $url = $this -> _getBaseUrl();
        $params = array(
            'call' => 'get_publisher_detailed_statistics',
            'token' => $this -> _getAdcashToken(),
            'filters[sites]' => $uid,
            'filters[zones]' => $cid,
            'grouping' => 'date',
            'start_date' => $start,
            'end_date' => $end
        );
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($params),
            ),
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if (!empty($result)) {
            $result = json_decode($result);
            if (property_exists($result, "rows")) {
                $result = $result -> rows;
            } else {
                $result = array();
            }
        }
        return $result;
    }

    private function _syncAdcashToLocal() {
        $cm = M('channel');
        $cwhere = array(
            'isused' => 1,
            't' => 'adcash'
        );
        $cret = $cm -> where($cwhere) -> select();
        if ($cret !== null) {
            $um = M('user');
            for ($i = 0, $j = count($cret); $i < $j; $i++) {
                $uid = $cret[$i]['o_uid'];
                $cid = $cret[$i]['o_cid'];
                $ucm = M('userchannel');
                $ucwhere = array('cid' => $cret[$i]['cid']);
                $ucret = $ucm -> where($ucwhere) -> find();
                if ($ucret !== null) {
                    $uwhere = array('uid' => $ucret['uid'], 'isactive' => 1);
                    $uret = $um -> where($uwhere) -> select();
                    if ($uret !== null) {
                        for ($m = 0, $n = count($uret); $m < $n; $m++) {
                            $discount = $uret[$m]['discount'];
                            $this -> _setStatisticsToLocalDB($uid, $cid, $discount);
                        }
                    }
                }
            }
        }
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
                $today = date('Y-m-d');
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
                    if ($infoitem['date'] == $today) {
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

    public function syncAdcash() {
        // $date_start = date('Y-m-d', strtotime("-1 day", strtotime(date('Y-m-d'))));
        // $date_end = date('Y-m-d');
        $date_start=date('Y-m-d', strtotime("-3 day", strtotime(date('Y-m-d'))));
        $date_end=date('Y-m-d', strtotime("-2 day", strtotime(date('Y-m-d'))));
        $t = 'adcash';
        //$uids = $this -> _getUids($t);
        //$uid='127518';
		//$cid='316091';
		//181130 426875   181132 426877   194119 448551   194123 448558
		//$uid='194123';
		//$cid='448558';
		$uid = '127518';
        $cid = '316091';

		$statics = $this -> _getStats($date_start, $date_end, $uid, $cid);
		//var_dump($statics);
		$isUpdate = false;
		if (!empty($statics)) {
            $isUpdate = true;
            $this -> _setStaticsToDB($statics, $uid, $cid, $t);
        } else {
            $this -> _updateChannelUpdatetime($uid, $cid);
        }

       /* $isUpdate = false;
        for ($i = 0, $j = count($uids); $i < $j; $i++) {
            $uid = $uids[$i]['uid'];
            //$cids = $this -> _getCids($uid, $t);
            for ($m = 0, $n = count($cids); $m < $n; $m++) {
                $cid = $cids[$m]['cid'];
                $statics = $this -> _getStats($date_start, $date_end, $uid, $cid);
                
                if (!empty($statics)) {
                    $isUpdate = true;
                    $this -> _setStaticsToDB($statics, $uid, $cid, $t);
                } else {
                    $this -> _updateChannelUpdatetime($uid, $cid);
                }
            }
            break;
        }*/
        if ($isUpdate) {
            $this -> _syncAdcashToLocal();
        }
    }

    private function _setStaticsToDB($statics, $uid, $cid, $t) {
        $m = M('admin_info');
        for ($i = 0, $j = count($statics); $i < $j; $i++) {
            $info = $statics[$i];
            var_dump($info);
            $where = array(
                'date' => $info -> date,
                'uid' => $uid,
                'cid' => $cid
            );
            $item = array(
                'token' => '',
                'uid' => $uid,
                'cid' => $cid,
                'pop' => intval($info -> impressions),
                'click' => intval($info -> clicks),
                'convers' => 0,
                'cpm' => floatval($info -> ecpm),
                'ctr' => floatval($info -> ctr),
                'date' => $info -> date,
                'profit' => floatval($info -> earnings),
                'importdate' => date("Y-m-d H:i:s"),
                't' => $t
            );
            var_dump($item);

            if ($item['date']=='2016-02-25') {
            	$ret = $m -> save($item);
            }
            //$ret = $m -> add($item);
            //var_dump($item);
            $isExist = $m -> where($where) -> find();
            if ($isExist === null) {
                $ret = $m -> add($item);
            } else {
                $item['id'] = $isExist['id'];
                $ret = $m -> save($item);
            }
        }

        $this -> _updateChannelUpdatetime($uid, $cid);

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


}