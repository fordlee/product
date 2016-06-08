<?php
// 本类由系统自动生成，仅供测试用途
class AdvertiseAction extends Action {

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

    public function channel() {
        if ($this -> _checklogin()) {
            $t = 'adcash';
            $where = array(
                't' => $t
            );
            $m = M('admin_channel');
            $channels = $m -> where($where)-> select();
            $this -> assign('t', $t);
            $this -> assign('channels', $channels);
            $this -> display();
        } else {
            $this -> redirect('Auth/login');
        }
    }

    public function setChannel() {
        if ($this -> _checklogin()) {
            $t = 'adcash';
            $affiliates = $this -> _getAffiliates();
            if (empty($affiliates)) {
                echo 3;
                return;
            }
            $channels = array();
            for ($i = 0, $j = count($affiliates); $i < $j; $i++) {
                $ch = $this -> _getChannel($affiliates[$i] -> site);
                if (!empty($ch)) {
                    for ($m = 0, $n = count($ch); $m < $n; $m++) {
                        $channels[] = array(
                            'uid' => $affiliates[$i] -> site,
                            'cid' => $ch[$m] -> zone
                        );
                    }
                }
            }
            if (!empty($channels)) {
                $failCount = 0;
                $m = M('admin_channel');
                for ($i = 0, $j = count($channels); $i < $j; $i++) {
                    $channel = $channels[$i];
                    $uid = $channel['uid'];
                    $cid = $channel['cid'];
                    $where = array(
                        'token' => '',
                        'uid' => $uid,
                        'cid' => $cid,
                        't' => $t
                    );
                    $isExist = $m -> where($where) -> count();
                    if ($isExist == 0) {
                        $item = array(
                            'token' => '',
                            'uid' => $uid,
                            'cid' => $cid,
                            'platform' => $this -> _getBaseUrl(),
                            'addtime' => date("Y-m-d H:i:s"),
                            't' => $t
                        );
                        $ret = $m -> add($item);
                        if ($ret === false) {
                            $failCount = $failCount + 1;
                        }
                    }
                }
                if ($failCount > 0) {
                    echo '部分同步失败，失败数：' . $failCount;
                } else {
                    echo 1;
                }
            } else {
                echo 2;
            }
        } else {
            echo 0;
        }
    }

    public function addchannel() {
        if (isset($_POST['token'])) {
            $token = '';
            $uid = $_POST['uid'];
            $cid = $_POST['cid'];
            $platform = $_POST['platform'];
            if (empty($uid)
                || empty($cid)
                || empty($platform)) {
                $this -> error('数据不能为空！', 'channel');
            } else {
                $t = 'adcash';
                $item = array(
                    'token' => $token,
                    'uid' => $uid,
                    'cid' => $cid,
                    'platform' => $platform,
                    'addtime' => date("Y-m-d H:i:s"),
                    't' => $t
                );
                $m = M('admin_channel');
                $ret = $m -> add($item);
                if ($ret !== false) {
                    $this -> success('添加成功', 'channel');
                } else {
                    $this -> error('添加失败', 'channel');
                }
            }
        }
        $this -> redirect('channel');
    }

    public function locationChannel() {
        $a_m = M('admin_channel');
        $where = array(
            'istolocal' => 0
        );
        $channels = $a_m -> where($where) -> select();
        if (!empty($channels)) {
            $l_m = M('channel');
            $failCount = 0;
            for ($i = 0, $j = count($channels); $i < $j; $i++) {
                $item = $channels[$i];
                $localitem = array(
                    'o_uid' => $item['uid'],
                    'o_cid' => $item['cid'],
                    'o_token' => $item['token'],
                    'cid' => $item['uid'] . $item['cid'],
                    'addtime' => date('Y-m-d H:i:s'),
                    't' => $item['t']
                );
                $l_ret = $l_m -> add($localitem);
                if ($l_ret !== false) {
                    $item['istolocal'] = 1;
                    $m_ret = $a_m -> save($item);
                    if ($m_ret === false) {
                        $failCount = $failCount + 1;
                    }
                } else {
                    $failCount = $failCount + 1;
                }
            }
            if ($failCount == 0) {
                echo 1;
            } else {
                echo 2;
            }
        } else {
            echo 1;
        }
    }

    public function channellocal() {
        if ($this -> _checklogin()) {
            $t = 'adcash';
            $m = M('channel');
            $where = array('t' => $t);
            $channels = $m -> where($where) -> select();
            $this -> assign('t', $t);
            $this -> assign('channels', $channels);
            $this -> display();
        } else {
            $this -> redirect('Auth/login');
        }
    }

    public function info() {
        if ($this -> _checklogin()) {
            $t = 'adcash';
            $this -> assign('t', $t);
            $this -> assign('today', date('Y-m-d'));
            $cid = '';
            $uid = '';
            if (isset($_GET['cid'])) {
                $cid = $_GET['cid'];
                $uid = $_GET['uid'];
            } else if (isset($_POST['cid'])) {
                $cid = $_POST['cid'];
                $uid = $_POST['uid'];
            } else {
                $where = array(
                    't' => $t
                );
                $m = M('admin_channel');
                $first = $m -> order('id desc') -> where($where) -> find();
                if ($first) {
                    $uid = $first['uid'];
                    $cid = $first['cid'];
                }
            }

            $dateRange = $this -> _getDateRange();
            if (isset($_POST['dateRange'])) {
                $this -> assign('currrange', $_POST['dateRange']);
            } else {
                $this -> assign('currrange', 'last_30_days');
            }

            $infom = M('admin_info');
            $where = array(
                'uid' => $uid,
                'cid' => $cid,
                't' => $t,
                'date' => array('between', array($dateRange['begin'], $dateRange['end']))
            );
            $ret = $infom -> where($where) -> order('date desc') -> select();
            $total = $this -> _getTotalStatics($ret);
            $this -> assign('cid', $cid);
            $this -> assign('uid', $uid);
            $this -> assign('ret', $ret);
            $this -> assign('total', $total);

            $uids = $this -> _getUids($t);
            $this -> assign('uids', $uids);

            $cids = $this -> _getCids($uid, $t);
            $this -> assign('cids', $cids);

            $usercid = $uid . $cid;
            $userinfo = $this -> _getUsernameDiscount($usercid);
            $this -> assign('userinfo', $userinfo);
            $this -> display();
        } else {
            $this -> redirect('Auth/login');
        }
    }

    public function setStatistics() {
        if ($this -> _checklogin()) {
            if (isset($_POST['dateRange'])
                && isset($_POST['date_start'])
                && isset($_POST['date_end'])
                && isset($_POST['uid'])
                && isset($_POST['cid'])) {
                if (empty($_POST['cid'])) {
                    echo 2;
                } else {
                    $dateRange = $this -> _getDateRange();
                    $start_date = $dateRange['begin'];
                    $end_date = $dateRange['end'];
                    $statics = $this -> _getStats(
                        $start_date,
                        $end_date,
                        $_POST['uid'],
                        $_POST['cid']);
                    if (!empty($statics)) {
                        $this -> _setStaticsToDB($statics, $_POST['uid'], $_POST['cid'], 'adcash');
                        echo 1;
                    } else {
                        echo 3;
                    }
                }
            } else {
                echo 4;
            }
        } else {
            echo 0;
        }
    }

    private function _setStaticsToDB($statics, $uid, $cid, $t) {
        $m = M('admin_info');
        for ($i = 0, $j = count($statics); $i < $j; $i++) {
            $info = $statics[$i];
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

    private function _getDateRange() {
        $today = strtotime(date('Y-m-d'));
        $ret = array (
            'begin' => date('Y-m-d', strtotime('-30 day', $today)),
            'end' => date('Y-m-d', strtotime('-1 day', $today)),
        );
        if (isset($_POST['dateRange'])) {
            $dateRange = $_POST['dateRange'];
            if ($dateRange == 'today') {
                $ret['begin'] = date('Y-m-d');
                $ret['end'] = date('Y-m-d');
            } else if ($dateRange == 'last_7_days') {
                $ret['begin'] = date('Y-m-d', strtotime('-7 day', $today));
                $ret['end'] = date('Y-m-d', strtotime('-1 day', $today));
            } else if ($dateRange == 'last_30_days') {

            } else if ($dateRange == 'this_month') {
                $ret['begin'] = date('Y-m-01');
                $ret['end'] = date('Y-m-d');
            } else if ($dateRange == 'last_month') {
                $ret['begin'] = date('Y-m-d', strtotime('-1 month', strtotime(date('Y-m-01'))));
                $ret['end'] = date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-01'))));
            } else if ($dateRange == 'custom') {
                if (isset($_POST['timebegin']) && isset($_POST['timeend'])) {
                    $ret['begin'] = $_POST['timebegin'];
                    $ret['end'] = $_POST['timeend'];
                }
            }
        }
        return $ret;
    }

    public function getCidsByUid() {
        if (isset($_POST['uid'])) {
            $ret = $this -> _getCids($_POST['uid'], 'adcash');
            echo json_encode($ret);
        } else {
            echo json_encode(array());
        }
    }

    private function _getUids($t) {
        $m = M('admin_channel');
        $where = array('t' => $t);
        $ret = $m -> where($where) -> distinct(true)->field('uid')->select();
        return $ret;
    }

    private function _getCids($uid, $t) {
        $m = M('admin_channel');
        $ret = $m -> where(array('uid' => $uid, 't' => $t)) -> order('updatetime') -> distinct(true)->field('cid, updatetime')->select();
        return $ret;
    }

    private function _getUsernameDiscount($ucid) {
        $m = M('userchannel');
        $where = array('cid' => $ucid);
        $ucitem = $m -> where($where) -> find();
        $ret = array(
            'username' => '未分配',
            'discount' => 0
        );
        if ($ucitem !== null) {
            $um = M('user');
            $u_where = array('uid' => $ucitem['uid']);
            $uitem = $um -> where($u_where) -> find();
            if ($uitem !== false) {
                $ret['username'] = $uitem['username'];
                $ret['discount'] = $uitem['discount'];
            }
        }
        return $ret;
    }

    private function _getTotalStatics($data) {
        $sum = array(
            'pop' => 0,
            'click' => 0,
            'cpm' => 0,
            'ctr' => 0,
            'profit' => 0
        );
        for ($i = 0, $j = count($data); $i < $j; $i++) {
            $item = $data[$i];
            $sum['pop'] = $sum['pop'] + $item['pop'];
            $sum['click'] = $sum['click'] + $item['click'];
            $sum['cpm'] = $sum['cpm'] + $item['cpm'];
            $sum['ctr'] = $sum['ctr'] + $item['ctr'];
            $sum['profit'] = $sum['profit'] + $item['profit'];
        }
        $ret = array(
            'pop' => $sum['pop'],
            'click' => $sum['click'],
            'cpm' => floor((floatval($sum['profit']) * 1000 / intval($sum['pop'])) * 10000) / 10000,
            'ctr' => $sum['ctr'] / $j,
            'profit' => $sum['profit']
        );
        return $ret;
    }

    private function _getAffiliates() {
        $result = array(
            array('site' => 'alexwebstore')
        );
        return $result;
    }

    private function _getChannel($site) {
        $key = $this -> _getAdcashToken();
        $url = $this -> _getBaseUrl();
        $params = array(
            'action' => 'get_publisher_detailed_statistics',
            'token' => $key,
            'grouping' => 'zone',
            'filters[sites]' => $site
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

    public function statisticstolocal() {
        if ($this -> _checklogin()) {
            if (isset($_POST['uid']) && isset($_POST['cid'])){
                $uid = $_POST['uid'];
                $cid = $_POST['cid'];
                $discount = $_POST['discount'];
                if (!empty($uid) && !empty($cid)) {
                    echo $this -> _setStatisticsToLocalDB($uid, $cid, $discount);
                } else {
                    echo 3;
                }
            } else {
                echo 2;
            }
        } else {
            echo 0;
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

    private function _syncAdcashToLocal() {
        $cm = M('channel');
        $cwhere = array(
            'isused' => 1
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

    private function _syncAdcash() {
        $date_start = date('Y-m-d', strtotime("-1 day", strtotime(date('Y-m-d'))));
        $date_end = date('Y-m-d');
        $t = 'adcash';
        $uids = $this -> _getUids($t);
        $isUpdate = false;
        for ($i = 0, $j = count($uids); $i < $j; $i++) {
            $uid = $uids[$i]['uid'];
            $cids = $this -> _getCids($uid, $t);
            for ($m = 0, $n = count($cids); $m < $n; $m++) {
                $cid = $cids[$m]['cid'];
                $statics = $this -> _getStats($date_start, $date_end, $uid, $cid);
                if (!empty($statics)) {
                    $isUpdate = true;
                    $this -> _setStaticsToDB($statics, $uid, $cid, $t);
                } else {
                    $this -> _updateChannelUpdatetime($uid, $cid);
                }
                break;
            }
        }
        if ($isUpdate) {
            $this -> _syncAdcashToLocal();
        }
    }

    public function syncinfofrombash() {
        if (isset($_GET['token']) && $_GET['token'] === '98a8cbb2a66ddfca4db65a35eea43f65') {
            $this -> _syncAdcash();
            echo 'end';
        } else {
            echo 'permission deny';
        }
    }
}