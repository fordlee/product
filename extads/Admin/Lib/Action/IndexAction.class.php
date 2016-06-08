<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {

    private function _checklogin() {
        $ret = false;
        if (isset($_SESSION['login']) && $_SESSION['login'] == true && $_SESSION['rule'] == 'admin') {
            $ret = true;
        }
        return $ret;
    }

    public function index(){
        if ($this -> _checklogin()) {
            $m = M('admin_channel');
            $adminChannels = array(
                "propeller" => 0,
                "adcash" => 0,
                "banners" => 0,
                "intext" => 0,
                "inimage" => 0,
                "superfish" => 0,
                "video" => 0,
                "search" => 0,
                "smartlinks" => 0,
                'other' => 0
            );
            $a_channels = $m -> where(array('istolocal' => 0)) -> field(array("count(*)"=>"count", "t")) -> group('t') -> select();
            for ($i = 0, $j = count($a_channels); $i < $j; $i++) {
                $adminChannels[$a_channels[$i]['t']] = $a_channels[$i]['count'];
            }
            $this -> assign('adminChannels', $adminChannels);

            $um = M('channel');
            $userChannels = array(
                "propeller" => 0,
                "adcash" => 0,
                "banners" => 0,
                "intext" => 0,
                "inimage" => 0,
                "superfish" => 0,
                "video" => 0,
                "search" => 0,
                "smartlinks" => 0,
                'other' => 0
            );
            $u_channels = $um -> where(array('isused' => 0)) -> field(array("count(*)"=>"count", "t")) -> group('t') -> select();
            for ($i = 0, $j = count($u_channels); $i < $j; $i++) {
                $userChannels[$u_channels[$i]['t']] = $u_channels[$i]['count'];
            }
            $this -> assign('userChannels', $userChannels);

            $this -> display();
        } else {
            $this -> redirect('Auth/login');
        }
    }

    public function channel() {
        if ($this -> _checklogin()) {
            $t = 'propeller';
            if (isset($_GET['t'])) {
                $t = $_GET['t'];
            }
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

    public function channellocal() {
        if ($this -> _checklogin()) {
            $t = 'propeller';
            if (isset($_GET['t'])) {
                $t = $_GET['t'];
            }
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
            $t = 'propeller';
            if (isset($_GET['t'])) {
                $t = $_GET['t'];
            }
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
                'token' => $this -> _getkey(),
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

    public function getCidsByUid() {
        if ($this -> _checklogin()) {
            if (isset($_POST['uid']) && !empty($_POST['uid'])) {
                $uid = $_POST['uid'];
                echo json_encode($this -> _getCids($uid, 'propeller'));
            } else {
                echo 2;
            }
        } else {
            echo 0;
        }
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

    private function _setStatisticsToLocalDB($uid, $cid, $discount) {
        $infom = M('admin_info');
        $limitCount = 20;
        $where = array(
            'token' => $this -> _getkey(),
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
                    'o_token' => $infoitem['token'],
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
                'token' => $this -> _getkey(),
                'uid' => $uid,
                'cid' => $cid,
                'pop' => intval($info -> show),
                'click' => intval($info -> click),
                'convers' => intval($info -> convers),
                'cpm' => floatval($info -> cpm),
                'ctr' => floatval($info -> ctr),
                'date' => $info -> date,
                'profit' => floatval($info -> profit),
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

    public function setStatistics() {
        if ($this -> _checklogin()) {
            if (isset($_POST['date_range'])
                && isset($_POST['date_start'])
                && isset($_POST['date_end'])
                && isset($_POST['uid'])
                && isset($_POST['cid'])
                && isset($_POST['t'])) {
                if (empty($_POST['cid'])) {
                    echo 2;
                } else {
                    $statics = $this -> _getStats(
                        $_POST['date_range'],
                        $_POST['date_start'],
                        $_POST['date_end'],
                        $_POST['uid'],
                        $_POST['cid']);
                    if (!empty($statics)) {
                        $this -> _setStaticsToDB($statics, $_POST['uid'], $_POST['cid'], $_POST['t']);
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

    public function addchannel() {
        if (isset($_POST['token'])) {
            $token = $_POST['token'];
            $uid = $_POST['uid'];
            $cid = $_POST['cid'];
            $platform = $_POST['platform'];
            if (empty($token)
                || empty($uid)
                || empty($cid)
                || empty($platform)) {
                $this -> error('数据不能为空！', 'channel');
            } else {
                $t = '';
                if (strpos($platform, 'propeller') !== false) {
                    $t = 'propeller';
                } else if (strpos($platform, 'adcash') !== false) {
                    $t = 'adcash';
                } else if (strpos($platform, 'advertise') !== false) {
                    $t = 'advertise';
                }
                if (empty($t)) {
                    $this -> error('平台有误！', 'channel');
                }
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

    public function setChannel() {
        if ($this -> _checklogin()) {
            if (!isset($_POST['t']) || empty($_POST['t'])) {
                echo 'params error';
                return;
            }
            $t = $_POST['t'];
            $affiliates = $this -> _getAffiliates($t);
            $channels = $this -> _getChannel($t);
            if (!empty($channels)) {
                $failCount = 0;
                $m = M('admin_channel');
                for ($i = 0, $j = count($channels); $i < $j; $i++) {
                    $channel = $channels[$i];
                    $uid = $affiliates[0] -> affiliate_id;
                    $cid = $channel -> zone_id;
                    $where = array(
                        'token' => $this -> _getkey(),
                        'uid' => $uid,
                        'cid' => $cid,
                        't' => $t
                    );
                    $isExist = $m -> where($where) -> count();
                    if ($isExist == 0) {
                        $item = array(
                            'token' => $this -> _getkey(),
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

    private function _getkey($type) {
        $ret = '22dc6d319614fa6e01f24a4fd4c627e4';
        if ($type == 'adcash') {
            $ret = '5626265313361393436303464316669343561653332693461656032623336356';
        }
        return $ret;
    }

    private function _getBaseUrl($type) {
        $ret = 'http://report.propellerads.com';
        if ($type == 'adcash') {
            $ret = 'https://www.adcash.com';
        }
        return $ret;
    }

    private function _getStats($range, $start, $end, $uid, $cids) {
        $url = $this -> _getBaseUrl();
        $data = array(
            'action' => 'getStats',
            'key' => $this -> _getkey(),
            'params[affiliate][]' => $uid,
            'params[zone][]' => $cids,
            'date_range' => 'this_month',
            'date_range' => $range,
            'date_start' => $start,
            'date_end' => $end,
            'params[stat_columns][show]' => 'show',
            'params[stat_columns][click]' => 'click',
            'params[stat_columns][convers]' => 'convers',
            'params[stat_columns][cpm]' => 'cpm',
            'params[stat_columns][ctr]' => 'ctr',
            'params[stat_columns][profit]' => 'profit'
        );
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data),
            ),
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if (!empty($result)) {
            $result = json_decode($result);
            $result = $result -> result;
            if ($result -> status) {
                $result = $result -> rows;
            } else {
                $result = array();
            }
        }
        return $result;
    }

    private function _getChannel() {
        $key = $this -> _getkey();
        $url = $this -> _getBaseUrl();
        $params = array(
            'action' => 'getZones',
            'key' => $key
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
            $result = $result -> result;
        }
        return $result;
    }

    private function _getAffiliates() {
        $key = $this -> _getkey();
        $url = $this -> _getBaseUrl();
        $params = array(
            'action' => 'getAffiliates',
            'key' => $key
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
            $result = $result -> result;
        }
        return $result;
    }

    private function _getAllIncomeDaypops($uid) {
        $uc_m = M('userchannel');
        $uc_where = array(
            'uid' => $uid
        );
        $ret = array();
        $incomeDaypops = array(
            'income' => 0,
            'daypops' => 0,
            'incomeByCids' => array()
        );
        $uc_rets = $uc_m -> where($uc_where) -> field('cid') -> select();
        $count = 0;
        for ($i = 0, $j = count($uc_rets); $i < $j; $i++) {
            $uc_ret = $uc_rets[$i];
            $cid = -1;
            if ($uc_ret !== null) {
                $cid = $uc_ret['cid'];
                $c_m = M('channel');
                $c_where = array(
                    'cid' => $cid,
                    'isused' => 1
                );
                $c_ret = $c_m -> where($c_where) -> field('o_token, o_uid, o_cid') -> find();
                if ($c_ret !== null) {
                    $i_m = M('info');
                    $i_where = array(
                        'o_token' => $c_ret['o_token'],
                        'o_uid' => $c_ret['o_uid'],
                        'o_cid' => $c_ret['o_cid'],
                    );
                    $ret = $i_m -> order('date desc') -> where($i_where) -> select();
                }
            }
            if (!empty($ret)) {
                $total = $this -> _getTotalStatics($ret);
                $allIncome = floatval($total['profit']);
                $dayPops = intval($total['pop']);
                $count = $count + count($ret);
                $incomeDaypops['income'] = $incomeDaypops['income'] + $allIncome;
                $incomeDaypops['daypops'] = $incomeDaypops['daypops'] + $dayPops;
                if ($cid != -1) {
                    $incomeDaypops['incomeByCids'][] = array(
                        'cid' => $cid,
                        'income' => $this -> _getCidLast30DayIncome($ret)
                    );
                }
            }
        }
        $incomeDaypops['daypops'] = floor($incomeDaypops['daypops'] / $count) * $j;
        return $incomeDaypops;
    }

    private function _getCidLast30DayIncome($ret) {
        $result = 0;
        if (count($ret) == 0) {
            return $result;
        }
        $date_range = $this -> _getDateRange();
        $date_min = strtotime($date_range['begin']);
        $date_max = strtotime($date_range['end']);
        $lastRetItemDate = strtotime($ret[0]['date']);
        $dateInfo = array(
            "last" => $lastRetItemDate,
            "min" => $date_min,
            "max" => $date_max
        );
        if ($lastRetItemDate < $date_min) {
            return $result;
        }
        for ($i = 0; $i < count($ret); $i++) {
            $itemDate = strtotime($ret[$i]['date']);
            if ($itemDate > $date_min && $itemDate < $date_max) {
                $result += floatval($ret[$i]['profit']);
            }
        }
        return $result;
    }

    public function user() {
        if ($this -> _checklogin()) {
            $mdb = M('user');
            $account_state_1_where = array(
                'accountstate' => 1
            );
            $users = $mdb -> where($account_state_1_where) -> order('addtime desc') -> select();

            if (!empty($users)) {
                for ($i = 0, $j = count($users); $i < $j; $i++) {
                    $useritem = $users[$i];
                    $where = array(
                        'uid' => $useritem['uid']
                    );
                    $cm = M('userchannel');
                    $cids = $cm -> where($where) -> field('cid') -> select();
                    if ($cids !== null) {
                        $users[$i]['cids'] = array();
                        $channelm = M('channel');
                        for ($m = 0, $n = count($cids); $m < $n; $m++) {
                            $channelWhere = array('cid' => $cids[$m]['cid']);
                            $channelRet = $channelm -> where($channelWhere) -> find();
                            if ($channelRet !== null) {
                                $users[$i]['cids'][] = array(
                                    'cid' => $cids[$m]['cid'],
                                    'name' => $channelRet['t'],
                                    'ocid' => $channelRet['o_cid']
                                );
                            }
                        }
                    } else {
                        $users[$i]['cids'] = array();
                    }

                    $incomeDaypops = $this -> _getAllIncomeDaypops($useritem['uid']);
                    $users[$i]['income'] = $incomeDaypops['income'];
                    $users[$i]['daypops'] = $incomeDaypops['daypops'];
                    $incomeByCids = $incomeDaypops['incomeByCids'];
                    if (!empty($incomeByCids)) {
                        for ($m = 0; $m < count($users[$i]['cids']); $m++) {
                            for ($n = 0; $n < count($incomeByCids); $n++) {
                                if ($users[$i]['cids'][$m]['cid'] == $incomeByCids[$n]['cid']) {
                                    $users[$i]['cids'][$m]['last30DaysIncome'] = $incomeByCids[$n]['income'];
                                    break;
                                }
                            }
                            if (!isset($users[$i]['cids'][$m]['last30DaysIncome'])) {
                                $users[$i]['cids'][$m]['last30DaysIncome'] = 0;
                            }
                        }
                    }
                }
            }
            function sortByOrder($a, $b) {
                return floatval($b['income']) - floatval($a['income']);
            }
            usort($users, 'sortByOrder');
            $this -> assign('users', $users);

            $account_state_0_where = array(
                'accountstate' => 0
            );
            $users_0 = $mdb -> where($account_state_0_where) -> order('addtime desc') -> select();
            $this -> assign("users_0", $users_0);

            $account_state_2_where = array(
                'accountstate' => 2
            );
            $users_2 = $mdb -> where($account_state_2_where) -> order('addtime desc') -> select();
            $this -> assign("users_2", $users_2);

            $this -> display();
        } else {
            $this -> redirect('Auth/login');
        }
    }

    public function userinfo() {
        if ($this -> _checklogin()) {
            if (isset($_GET['uid'])) {
                $uid = $_GET['uid'];
                $m = M('user');
                $where = array('uid' => $uid);
                $ret = $m -> where($where) -> find();
                $this -> assign('userinfo', $ret);
                $this -> display();
            } else {
                $this -> error('参数有误！');
            }
        } else {
            $this -> redirect('Auth/login');
        }
    }

    public function modimark() {
        if ($this -> _checklogin()) {
            if (isset($_POST['uid'])) {
                $uid = $_POST['uid'];
                $mark = $_POST['mark'];
                $m = M('user');
                $where = array('uid' => $uid);
                $ret = $m -> where($where) -> find();
                if ($ret !== null) {
                    $ret['mark'] = $mark;
                    $eret = $m -> save($ret);
                    if ($eret !== flase) {
                        $this -> success('success');
                    } else {
                        $this -> error('操作失败');
                    }
                }
            } else {
                $this -> error('params error');
            }
        } else {
            $this -> redirect('Auth/login');
        }
    }

    public function enableuser() {
        if ($this -> _checklogin()) {
            if (isset($_GET['uid'])) {
                $uid = $_GET['uid'];
                $m = M('user');
                $where = array('uid' => $uid);
                $ret = $m -> where($where) -> find();
                if ($ret !== null) {
                    $ret['isactive'] = 1;
                    $ret['accountstate'] = 1;
                    $eret = $m -> save($ret);
                    if ($eret !== flase) {
                        try {
                            sendUserPassEmail($ret['username'], $ret['firstname'], $ret['username'], $ret['uid']);
                        } catch(Exception $e) {
                            echo "邮件发送失败！";
                            var_dump($e);
                        }
                        $this -> success('success');
                    } else {
                        $this -> error('操作失败');
                    }
                }
            } else {
                $this -> error('params error');
            }
        } else {
            $this -> redirect('Auth/login');
        }
    }

    public function disactiveuser() {
        if ($this -> _checklogin()) {
            if (isset($_GET['uid'])) {
                $uid = $_GET['uid'];
                $m = M('user');
                $where = array('uid' => $uid);
                $ret = $m -> where($where) -> find();
                if ($ret !== null) {
                    $ret['accountstate'] = 2;
                    $eret = $m -> save($ret);
                    if ($eret !== flase) {
                        $this -> success('success');
                    } else {
                        $this -> error('操作失败');
                    }
                }
            } else {
                $this -> error('params error');
            }
        } else {
            $this -> redirect('Auth/login');
        }
    }

    public function activeuser() {
        if ($this -> _checklogin()) {
            if (isset($_GET['uid'])) {
                $uid = $_GET['uid'];
                $m = M('user');
                $where = array('uid' => $uid);
                $ret = $m -> where($where) -> find();
                if ($ret !== null) {
                    $ret['accountstate'] = 1;
                    $eret = $m -> save($ret);
                    if ($eret !== flase) {
                        $this -> success('success');
                    } else {
                        $this -> error('操作失败');
                    }
                }
            } else {
                $this -> error('params error');
            }
        } else {
            $this -> redirect('Auth/login');
        }
    }

    public function disableuser() {
        if ($this -> _checklogin()) {
            if (isset($_GET['uid'])) {
                $uid = $_GET['uid'];
                $m = M('user');
                $where = array('uid' => $uid);
                $ret = $m -> where($where) -> find();
                if ($ret !== null) {
                    $ret['isactive'] = 0;
                    $ret['accountstate'] = 0;
                    $eret = $m -> save($ret);
                    if ($eret !== flase) {
                        $this -> success('success');
                    } else {
                        $this -> error('操作失败');
                    }
                }
            } else {
                $this -> error('params error');
            }
        } else {
            $this -> redirect('Auth/login');
        }
    }

    public function adducid() {
        if ($this -> _checklogin()) {
            if (isset($_GET['uid'])) {
                $uid = $_GET['uid'];
                $m = M('user');
                $where = array('uid' => $uid);
                $userinfo = $m -> where($where) -> find();
                $this -> assign('item', $userinfo);

                $usercids = array();
                $ucm = M('userchannel');
                $cids = $ucm -> where(array('uid' => $uid)) -> field('cid') -> select();
                if ($cids !== null) {
                    $channelm = M('channel');
                    for ($m = 0, $n = count($cids); $m < $n; $m++) {
                        $channelWhere = array('cid' => $cids[$m]['cid']);
                        $channelRet = $channelm -> where($channelWhere) -> find();
                        if ($channelRet !== null) {
                            $usercids[] = $channelRet['t'];
                        }
                    }
                }

                $cm = M('channel');
                if (!in_array('propeller', $usercids)) {
                    $cwhere = array(
                        'isused' => 0,
                        't' => 'propeller'
                    );
                    $cids = $cm -> order('id') -> where($cwhere) -> field('cid') -> select();
                    $this -> assign('propellercids', $cids);
                }

                if (!in_array('adcash', $usercids)) {
                    $adcashwhere = array(
                        'isused' => 0,
                        't' => 'adcash'
                    );
                    $adcashcids = $cm -> order('id') -> where($adcashwhere) -> field('cid') -> select();
                    $this -> assign('adcashcids', $adcashcids);
                }

                if (!in_array('superfish', $usercids)) {
                    $superfishwhere = array(
                        'isused' => 0,
                        't' => 'superfish'
                    );
                    $superfishcids = $cm -> order('id') -> where($superfishwhere) -> field('cid') -> select();
                    $this -> assign('superfishcids', $superfishcids);
                }

                if (!in_array('banners', $usercids)) {
                    $bannerswhere = array(
                        'isused' => 0,
                        't' => 'banners'
                    );
                    $bannerscids = $cm -> order('id') -> where($bannerswhere) -> field('cid') -> select();
                    $this -> assign('bannerscids', $bannerscids);
                }

                if (!in_array('intext', $usercids)) {
                    $intextwhere = array(
                        'isused' => 0,
                        't' => 'intext'
                    );
                    $intextcids = $cm -> order('id') -> where($intextwhere) -> field('cid') -> select();
                    $this -> assign('intextcids', $intextcids);
                }

                if (!in_array('inimage', $usercids)) {
                    $inimagewhere = array(
                        'isused' => 0,
                        't' => 'inimage'
                    );
                    $inimagecids = $cm -> order('id') -> where($inimagewhere) -> field('cid') -> select();
                    $this -> assign('inimagecids', $inimagecids);
                }

                if (!in_array('video', $usercids)) {
                    $videowhere = array(
                        'isused' => 0,
                        't' => 'video'
                    );
                    $videocids = $cm -> order('id') -> where($videowhere) -> field('cid') -> select();
                    $this -> assign('videocids', $videocids);
                }

                if (!in_array('search', $usercids)) {
                    $searchwhere = array(
                        'isused' => 0,
                        't' => 'search'
                    );
                    $searchcids = $cm -> order('id') -> where($searchwhere) -> field('cid') -> select();
                    $this -> assign('searchcids', $searchcids);
                }

                if(!in_array('smartlinks', $usercids)){
                    $smartlinkswhere = array(
                        'isused' => 0,
                        't' => 'smartlinks'
                    );
                    $smartlinkscids = $cm -> order('id') -> where($smartlinkswhere) -> field('cid') -> select();
                    $this -> assign('smartlinkscids',$smartlinkscids);
                }

                if (!in_array('other', $usercids)) {
                    $otherwhere = array(
                        'isused' => 0,
                        't' => 'other'
                    );
                    $othercids = $cm -> order('id') -> where($otherwhere) -> field('cid') -> select();
                    $this -> assign('othercids', $othercids);
                }

                $this -> display();
            } else if (isset($_POST['uid'])) {
                $uid = $_POST['uid'];
                $ext = $_POST['ext'];
                $pcid = $_POST['pcid'];
                $acid = $_POST['acid'];
                $dcid = $_POST['dcid'];
                $scid = $_POST['scid'];
                $bcid = $_POST['bcid'];
                $itcid = $_POST['itcid'];
                $iicid = $_POST['iicid'];
                $vicid = $_POST['vicid'];
                $secid = $_POST['secid'];
                $slcid = $_POST['slcid'];
                $ocid = $_POST['ocid'];
                if (!empty($pcid)) {
                    $this -> _addUserCidDB($uid, $pcid, $ext, 'pop');
                }
                if (!empty($acid)) {
                    $this -> _addUserCidDB($uid, $acid, $ext, 'pop');
                }
                if (!empty($dcid)) {
                    $this -> _addUserCidDB($uid, $dcid, $ext, 'pop');
                }
                if (!empty($scid)) {
                    $this -> _addUserCidDB($uid, $scid, $ext, 'superfish');
                }
                if (!empty($bcid)) {
                    $this -> _addUserCidDB($uid, $bcid, $ext, 'banners');
                }
                if (!empty($itcid)) {
                    $this -> _addUserCidDB($uid, $itcid, $ext, 'intext');
                }
                if (!empty($iicid)) {
                    $this -> _addUserCidDB($uid, $iicid, $ext, 'inimage');
                }
                if (!empty($vicid)) {
                    $this -> _addUserCidDB($uid, $vicid, $ext, 'video');
                }
                if (!empty($secid)) {
                    $this -> _addUserCidDB($uid, $secid, $ext, 'search');
                }
                if (!empty($slcid)) {
                    $this -> _addUserCidDB($uid, $slcid, $ext, 'smartlinks');
                }
                if (!empty($ocid)) {
                    $this -> _addUserCidDB($uid, $ocid, $ext, 'other');
                }
                $this -> success('添加成功！', 'user');
            } else {
                $this -> redirect('user');
            }
        } else {
            $this -> redirect('Auth/login');
        }
    }

    private function _addUserCidDB($uid, $cid, $ext, $types) {
        $ucm = M('userchannel');
        $ucm -> startTrans();
        $ucitem = array(
            'uid' => $uid,
            'cid' => $cid,
            'ext' => $ext,
            'types' => $types,
            'addtime' => date('Y-m-d H:i:s')
        );
        $ucret = $ucm -> add($ucitem);
        if ($ucret > 0) {
            $cm = M('channel');
            $cwhere = array('cid' => $cid);
            $cret = $cm -> where($cwhere) -> find();
            if ($cret !== null) {
                $cret['isused'] = 1;
                $saveret = $cm -> save($cret);
                if ($saveret > 0) {
                    $ucm -> commit();
                    $isSuccess = true;
                } else {
                    $ucm -> rollback();
                    $this -> error('添加失败_channel_update！', 'user');
                }
            } else {
                $ucm -> rollback();
                $this -> error('添加失败_channel！', 'user');
            }
        } else {
            $ucm -> rollback();
            $this -> error('添加失败！', 'user');
        }
    }

    //删除释放账号子渠道
    public function delchannel(){
        if ($this -> _checklogin()) {
            $useruid=$_GET['uid'];
            $cid=$_GET['cid'];
            if(isset($useruid) && isset($cid) ){
                //删除用户数据
                $channel=M('channel');
                $oucid = $channel -> field('o_uid,o_cid') -> where("cid='$cid'") -> find();
                $delinfo = array(
                    'o_uid' => $oucid['o_uid'],
                    'o_cid' => $oucid['o_cid']
                );
                $info = M('info');
                $iret = $info -> where($delinfo) -> delete();
                
                $a_info =M('admin_info');
                $deladmin = array(
                    'uid' => $oucid['o_uid'],
                    'cid' => $oucid['o_cid']
                );
                $a_iret = $a_info -> where($deladmin) -> delete();

                //释放用户渠道
                $deluc = array(
                    'uid' => $useruid,
                    'cid' => $cid
                );
                $userchannel=M('userchannel');
                $ucret = $userchannel->where($deluc)->delete();

                //更新用户渠道为可用状态
                $delc['cid'] = $cid;
                $data['isused'] = 0;
                $cret = $channel->where($delc)->save($data);

                if ($cret !=false && $iret !=false && $ucret != false){
                    echo 1;
                }else{
                    echo 2;
                }
            }else{
                $this->redirect('user');
            }

        }else{
            echo 0;
            $this -> redirect('Auth/login');
        }
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

    public function userchannel() {
        if ($this -> _checklogin()) {
            if (isset($_GET['cid'])) {
                $cid = $_GET['cid'];
                $c_m = M('channel');
                $c_where = array(
                    'cid' => $cid,
                    'isused' => 1
                );
                $c_ret = $c_m -> where($c_where) -> find();
                if ($c_ret !== null) {
                    $dateRange = $this -> _getDateRange();
                    if (isset($_POST['dateRange'])) {
                        $this -> assign('currrange', $_POST['dateRange']);
                    } else {
                        $this -> assign('currrange', 'last_30_days');
                    }
                    $i_m = M('info');
                    $i_where = array(
                        'o_token' => $c_ret['o_token'],
                        'o_uid' => $c_ret['o_uid'],
                        'o_cid' => $c_ret['o_cid'],
                        'date' => array('between', array($dateRange['begin'], $dateRange['end']))
                    );
                    $i_ret = $i_m -> order('date desc') -> where($i_where) -> select();
                    $total = $this -> _getTotalStatics($i_ret);
                    $this -> assign('total', $total);

                    $o_i_m = M('admin_info');
                    $o_i_where = array(
                        'token' => $c_ret['o_token'],
                        'uid' => $c_ret['o_uid'],
                        'cid' => $c_ret['o_cid'],
                        'date' => array('between', array($dateRange['begin'], $dateRange['end']))
                    );
                    $o_i_ret = $o_i_m -> order('date desc') -> where($o_i_where) -> select();
                    $o_total = $this -> _getTotalStatics($o_i_ret);
                    $this -> assign('o_total', $o_total);

                    for ($i = 0, $j = count($i_ret); $i < $j; $i++) {
                        $i_ret[$i]['o_cpm'] = $o_i_ret[$i]['cpm'];
                        $i_ret[$i]['o_profit'] = $o_i_ret[$i]['profit'];
                    }

                    $this -> assign('ret', $i_ret);

                }
            }
            $this -> display();
        } else {
            $this -> redirect('Auth/login');
        }
    }

    private function _getInfoRet($dateRange, $uid) {
        $uc_m = M('userchannel');
        $uc_where = array(
            'uid' => $uid
        );
        $ret = array();
        $uc_rets = $uc_m -> where($uc_where) -> field('cid') -> select();
        $ucRets = array();
        for ($i = 0, $j = count($uc_rets); $i < $j; $i++) {
            $uc_ret = $uc_rets[$i];
            if ($uc_ret !== null) {
                $cid = $uc_ret['cid'];
                $c_m = M('channel');
                $c_where = array(
                    'cid' => $cid,
                    'isused' => 1
                );
                $c_ret = $c_m -> where($c_where) -> field('o_token, o_uid, o_cid') -> find();
                if ($c_ret !== null) {
                    $i_m = M('info');
                    $i_where = array(
                        'o_token' => $c_ret['o_token'],
                        'o_uid' => $c_ret['o_uid'],
                        'o_cid' => $c_ret['o_cid'],
                        'date' => array('between', array($dateRange['begin'], $dateRange['end']))
                    );
                    $ucRet = $i_m -> order('date desc') -> where($i_where) -> field('pop,click,cpm,ctr,profit,date') -> select();
                    if (!empty($ucRet)) {
                        $ucRets[] = $ucRet;
                    }
                }
            }
        }
        if (count($ucRets) == 0) {
        } else {
            $ret = $this -> _mergeStaticsByDate($ucRets, $dateRange);
        }
        if (!empty($ret)) {
            $total = $this -> _getTotalStatics($ret);
            $this -> assign('total', $total);
        } else {
            $ret = null;
        }
        return $ret;
    }

    private function _getOriInfoRet($dateRange, $uid) {
        $uc_m = M('userchannel');
        $uc_where = array(
            'uid' => $uid
        );
        $ret = array();
        $uc_rets = $uc_m -> where($uc_where) -> field('cid') -> select();
        $ucRets = array();
        for ($i = 0, $j = count($uc_rets); $i < $j; $i++) {
            $uc_ret = $uc_rets[$i];
            if ($uc_ret !== null) {
                $cid = $uc_ret['cid'];
                $c_m = M('channel');
                $c_where = array(
                    'cid' => $cid,
                    'isused' => 1
                );
                $c_ret = $c_m -> where($c_where) -> field('o_token, o_uid, o_cid') -> find();
                if ($c_ret !== null) {
                    $i_m = M('admin_info');
                    $i_where = array(
                        'token' => $c_ret['o_token'],
                        'uid' => $c_ret['o_uid'],
                        'cid' => $c_ret['o_cid'],
                        'date' => array('between', array($dateRange['begin'], $dateRange['end']))
                    );
                    $ucRet = $i_m -> order('date desc') -> where($i_where) -> field('pop,click,cpm,ctr,profit,date') -> select();
                    if (!empty($ucRet)) {
                        $ucRets[] = $ucRet;
                    }
                }
            }
        }
        if (count($ucRets) == 0) {
        } else {
            $ret = $this -> _mergeStaticsByDate($ucRets, $dateRange);
        }
        if (!empty($ret)) {
            $total = $this -> _getTotalStatics($ret);
            $this -> assign('o_total', $total);
        } else {
            $ret = null;
        }
        return $ret;
    }

    private function _mergeStaticsByDate($rets, $dateRange) {
        $ret = array();
        $begin = $dateRange['begin'];
        $end = $dateRange['end'];
        $datediff = strtotime($end) - strtotime($begin);
        $days = floor($datediff/(60*60*24)) + 1;
        for ($i = 0, $j = $days; $i < $j; $i++) {
            $date = date('Y-m-d', strtotime('+'.$i.' day', strtotime($begin)));
            $arrItem = array(
                "pop" => 0,
                "click" => 0,
                "cpm" => 0,
                "ctr" => 0,
                "profit" => 0,
                "date" => $date,
            );
            for ($m = 0, $n = count($rets); $m < $n; $m++) {
                $retitem = $rets[$m];
                for ($l = 0, $k = count($retitem); $l < $k; $l++) {
                    if ($retitem[$l]['date'] == $date) {
                        $arrItem['pop'] = intval($arrItem['pop']) + intval($retitem[$l]['pop']);
                        $arrItem['click'] = intval($arrItem['click']) + intval($retitem[$l]['click']);
                        $arrItem['ctr'] = floatval($arrItem['ctr']) + floatval($retitem[$l]['ctr']);
                        $arrItem['profit'] = floatval($arrItem['profit']) + floatval($retitem[$l]['profit']);
                    }
                }
            }
            $arrItem['cpm'] = floor((floatval($arrItem['profit']) * 1000 / intval($arrItem['pop'])) * 10000) / 10000;
            $ret[] = $arrItem;
        }
        $ret = array_reverse($ret);
        return $ret;
    }

    public function profitinfo() {
        if ($this -> _checklogin()) {
            if (isset($_GET['uid'])) {
                $uid = $_GET['uid'];
                $dateRange = $this -> _getDateRange();
                if (isset($_POST['dateRange'])) {
                    $this -> assign('currrange', $_POST['dateRange']);
                } else {
                    $this -> assign('currrange', 'last_30_days');
                }

                $i_ret = $this -> _getInfoRet($dateRange, $uid);

                $o_ret = $this -> _getOriInfoRet($dateRange, $uid);

                for ($i = 0, $j = count($i_ret); $i < $j; $i++) {
                    $i_ret[$i]['o_cpm'] = $o_ret[$i]['cpm'];
                    $i_ret[$i]['o_profit'] = $o_ret[$i]['profit'];
                    $i_ret[$i]['income'] = $o_ret[$i]['profit'] - $i_ret[$i]['profit'];
                }

                $this -> assign('uid', $uid);

                $this -> assign('ret', $i_ret);
            }
            $this -> display();
        } else {
            $this -> redirect('Auth/login');
        }
    }

    public function setdiscount() {
        if ($this -> _checklogin()) {
            if (isset($_POST['uid']) && !empty($_POST['uid'])
                 && isset($_POST['discount']) && !empty($_POST['discount'])) {
                $uid = $_POST['uid'];
                $discount = floatval($_POST['discount']);
                $m = M('user');
                $where = array(
                    'uid' => $uid
                );
                $item = $m -> where($where) -> find();
                if ($item !== null) {
                    $item['discount'] = $discount;
                    $ret = $m -> save($item);
                    if ($ret > 0) {
                        echo 1;
                    } else {
                        echo 3;
                    }
                } else {
                    echo 4;
                }
            } else {
                echo 2;
            }
        } else {
            echo 0;
        }
    }

    public function setchecktime(){
        if ($this -> _checklogin()) {
            if (isset($_POST['uid']) && !empty($_POST['uid'])
                 && isset($_POST['checktime']) && !empty($_POST['checktime'])) {
                $uid = $_POST['uid'];
                $checktime = floatval($_POST['checktime']);
                $m = M('user');
                $where = array(
                    'uid' => $uid
                );
                $item = $m -> where($where) -> find();
                if ($item !== null) {
                    $item['checkcycle'] = $checktime;
                    $ret = $m -> save($item);
                    if ($ret > 0) {
                        echo 1;
                    } else {
                        echo 3;
                    }
                } else {
                    echo 4;
                }
            } else {
                echo 2;
            }
        } else {
            echo 0;
        }
    }

    public function setusertype(){
        if ($this -> _checklogin()) {
            if (isset($_POST['uid']) && !empty($_POST['uid'])
                 && isset($_POST['usertype']) && !empty($_POST['usertype'])) {
                $uid = $_POST['uid'];
                $usertype = floatval($_POST['usertype']);
                $m = M('user');
                $where = array(
                    'uid' => $uid
                );
                $item = $m -> where($where) -> find();
                if ($item !== null) {
                    $item['usertype'] = $usertype;
                    $ret = $m -> save($item);
                    if ($ret > 0) {
                        echo 1;
                    } else {
                        echo 3;
                    }
                } else {
                    echo 4;
                }
            } else {
                echo 2;
            }
        } else {
            echo 0;
        }
    }

    public function payment($s = '0') {
        if ($this -> _checklogin()) {
            $m = D('PaymentView');
            $where = array();
            if ($s !== 'all') {
                $where['status'] = $s;
            }
            $ret = $m -> where($where) -> order('addtime desc') -> select();
            $this -> assign('payRet', $ret);
            $this -> assign('status', $s);
            $this -> display();
        } else {
            $this -> redirect('Auth/login');
        }
    }

    //管理员后台添加手动付款
    public function addManualPayment(){
        if($this -> _checklogin()){
            $username = $_POST['username'];
            $paycount = $_POST['paycount'];
            $m = D('PaymentView');
            $where = array(
                "username" => $username,
                "isactive" => 1
            );
            $ret = $m -> order('addtime desc') -> where($where) -> find();

            if($ret !== null){
                $usertype = $ret['usertype'];
                if($usertype == 1){
                    $item = array(
                        "uid" => $ret['uid'],
                        "paycount" => $paycount,
                        "status" => 0,
                        "addtime" => date('Y-m-d H:i:s'),
                        "paytype" => 1,
                        "name" => $ret['name'],
                        "account" => $ret['account'],
                        "cp_address" => $ret['cp_address']
                    );
                }elseif($usertype == 2){
                    $item = array(
                        "uid" => $ret['uid'],
                        "paycount" => $paycount,
                        "status" => 0,
                        "addtime" => date('Y-m-d H:i:s'),
                        "paytype" => 2,
                        "swift" => $ret['swift'],
                        "owner" => $ret['owner'],
                        "cp_address" => $ret['cp_address'],
                        "number"=> $ret['number'],
                        "bank" => $ret['bank'],
                        "address" => $ret['address']
                    );
                }
                $m_p = M('payment');
                $payret = $m_p -> add($item);
                if($payret !== false){
                    $this -> success('手动添加该用户付款额成功！','payment');
                }else{
                    $this -> error('手动添加该用户付款额失败！','payment');
                }
            }else{
                $this -> error('该用户未激活或不存在','payment');
            }
        }else{
            $this -> redirect('Auth/login');
        }
    }

    public function del($id) {
        if ($this -> _checklogin()) {
            $m = M('payment');
            $item = array(
                "id" => $id,
                "status" => array('NEQ', '2')
            );
            $ret = $m -> where($item) -> delete();
            if ($ret == 1) {
                echo 1;
            } else {
                echo -1;
            }
        } else {
            echo 0;
        }
    }

    public function addpaymentnote($id, $note) {
        if ($this -> _checklogin()) {
            $m = M('payment');
            $item = array(
                "id" => $id,
                "note" => $note
            );
            $ret = $m -> save($item);
            if ($ret == 1) {
                echo 1;
            } else {
                echo -1;
            }
        } else {
            echo 0;
        }
    }

    public function passpayment() {
        if ($this -> _checklogin()) {
            if (isset($_POST['id']) && !empty($_POST['id'])
                 && isset($_POST['status']) && !empty($_POST['status'])) {
                $id = intval($_POST['id']);
                $status = intval($_POST['status']);
                $m = M('payment');
                $item = array(
                    'id' => $id,
                    'status' => $status
                );
                if ($status === 1) {
                    $item['checktime'] = date('Y-m-d H:i:s');
                    $item['checkuser'] = $_SESSION['username'];
                }
                $ret = $m -> save($item);
                if ($ret > 0) {
                    echo 1;
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

    public function payedpayment() {
        if ($this -> _checklogin()) {
            if (isset($_POST['id']) && !empty($_POST['id'])) {
                $id = intval($_POST['id']);
                $status = 2;
                $m = M('payment');
                $item = array(
                    'id' => $id,
                    'status' => $status,
                    'paytime' => date('Y-m-d H:i:s')
                );
                $ret = $m -> save($item);
                if ($ret > 0) {
                    echo 1;
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

    private function _syncPropellerToLocal() {
        $cm = M('channel');
        $cwhere = array(
            'isused' => 1,
            't' => 'propeller'
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

    private function _syncPropeller() {
        $date_range = 'custom';
        $date_start = date('Y-m-d', strtotime("-1 day", strtotime(date('Y-m-d'))));
        $date_end = date('Y-m-d');
        $t = 'propeller';
        $uids = $this -> _getUids($t);
        $isUpdate = false;
        for ($i = 0, $j = count($uids); $i < $j; $i++) {
            $uid = $uids[$i]['uid'];
            $cids = $this -> _getCids($uid, $t);
            for ($m = 0, $n = count($cids); $m < $n; $m++) {
                $cid = $cids[$m]['cid'];
                $statics = $this -> _getStats($date_range, $date_start, $date_end, $uid, $cid);
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
            $this -> _syncPropellerToLocal();
        }
    }

    public function syncinfofrombash() {
        if (isset($_GET['token']) && $_GET['token'] === '98a8cbb2a66ddfca4db65a35eea43f65') {
            $this -> _syncPropeller();
            echo 'end';
        } else {
            echo 'permission deny';
        }
    }

    private function _download_send_headers($filename) {
        // disable caching
        $now = gmdate("D, d M Y H:i:s");
        header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
        header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
        header("Last-Modified: {$now} GMT");

        // force download
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");

        // disposition / encoding on response body
        header("Content-Disposition: attachment;filename={$filename}");
        header("Content-Transfer-Encoding: binary");
    }

    private function _array2csv($array) {
        if (count($array) == 0) {
            return null;
        }
        $keys = array('Date', 'Impressions', 'Clicks', 'CPM', '原CPM', 'CTR', 'Profit', '原Profit', 'Income');
        echo implode(',', $keys) . PHP_EOL;
        for ($i = 0, $j = count($array); $i < $j; $i++) {
            $row = $array[$i];
            echo $row['date'] . ','
                 . '"' . number_format($row['pop']) . '",'
                 . '"' . number_format($row['click']) . '",'
                 . '"' . number_format($row['cpm'], 4) . '",'
                 . '"' . number_format($row['o_cpm'], 4) . '",'
                 . '"' . number_format($row['ctr'], 4) . '",'
                 . '"$' . number_format($row['profit'], 2) . '",'
                 . '"$' . number_format($row['o_profit'], 2) . '",'
                 . '"$' . number_format($row['income'], 2) . '"'
                 . PHP_EOL;
        }
    }

    private function _getExDateRange() {
        $yestoday = strtotime('-1 day', strtotime(date('Y-m-d')));
        $ret = array (
            'begin' => date('Y-m-d', strtotime('-29 day', $yestoday)),
            'end' => date('Y-m-d', $yestoday)
        );
        if (isset($_POST['ex_dateRange'])) {
            $dateRange = $_POST['ex_dateRange'];
            if ($dateRange == 'today') {
                $ret['begin'] = date('Y-m-d');
                $ret['end'] = date('Y-m-d');
            } else if ($dateRange == 'last_7_days') {
                $ret['begin'] = date('Y-m-d', strtotime('-6 day', $yestoday));
            } else if ($dateRange == 'last_30_days') {

            } else if ($dateRange == 'this_month') {
                $ret['begin'] = date('Y-m-01');
                $ret['end'] = date('Y-m-d');
            } else if ($dateRange == 'last_month') {
                $ret['begin'] = date('Y-m-d', strtotime('-1 month', strtotime(date('Y-m-01'))));
                $ret['end'] = date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-01'))));
            } else if ($dateRange == 'custom') {
                if (isset($_POST['timebegin']) && isset($_POST['timeend'])) {
                    $ret['begin'] = $_POST['ex_timebegin'];
                    $ret['end'] = $_POST['ex_timeend'];
                }
            }
        }
        return $ret;
    }

    public function saveAsCsv() {
        if ($this -> _checklogin()) {
            $dateRange = $this -> _getExDateRange();
            $uid = $_POST['uid'];
            $i_ret = $this -> _getInfoRet($dateRange, $uid);
            $o_ret = $this -> _getOriInfoRet($dateRange, $uid);
            for ($i = 0, $j = count($i_ret); $i < $j; $i++) {
                $i_ret[$i]['o_cpm'] = $o_ret[$i]['cpm'];
                $i_ret[$i]['o_profit'] = $o_ret[$i]['profit'];
                $i_ret[$i]['income'] = $o_ret[$i]['profit'] - $i_ret[$i]['profit'];
            }
            $i_total = $this -> _getTotalStatics($i_ret);
            $o_total = $this -> _getTotalStatics($o_ret);

            $i_total['date'] = "total";
            $i_total['o_cpm'] = $o_total['cpm'];
            $i_total['o_profit'] = $o_total['profit'];
            $i_total['income'] = $o_total['profit'] - $i_total['profit'];
            array_push($i_ret, $i_total);

            $this -> _download_send_headers("adonads_profit_data_export_" . date("Y-m-d") . ".csv");
            $this -> _array2csv($i_ret);
        } else {
            echo 0;
        }
    }

    public function sendEmailTest() {
        var_dump(sendEmail("durongjian@gmail.com", "register success", "adonads register success"));
    }

    public function st() {
        $zones = array(
            "America/New_York" =>   "America/New_York",
            "Europe/London" =>      "Europe/London",
            "Europe/Paris" =>       "Europe/Paris",
            "Europe/Berlin" =>      "Europe/Berlin",
            "Asia/Jerusalem" =>     "Asia/Jerusalem",
            "Europe/Moscow" =>      "Europe/Moscow",
            "Asia/Beijing" =>      "Asia/Shanghai",
            "Asia/Tokyo" =>         "Asia/Tokyo",
        );
        $timelist = array();
        foreach ($zones as $key => $value) {
            $d = new DateTime("now", new DateTimeZone($value));
            $fd = $d->format('Y-m-d H:i:00');
            $timelist[] = array(
                "name" => $key,
                "time" => $fd
            );
        }
        $this -> assign('timelist', $timelist);
        $this -> display();
    }
}