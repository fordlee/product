<?php
// 本类由系统自动生成，仅供测试用途
class IntextAction extends Action {

    private function _checklogin() {
        $ret = false;
        if (isset($_SESSION['login']) && $_SESSION['login'] == true && $_SESSION['rule'] == 'admin') {
            $ret = true;
        }
        return $ret;
    }

    private function _getBaseUrl($type) {
        return 'intext';
    }

    public function channel() {
        if ($this -> _checklogin()) {
            $t = 'intext';
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
                $t = 'intext';
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
            $t = 'intext';
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
            $t = 'intext';
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
            $ret = $this -> _getCids($_POST['uid'], 'intext');
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
            'ctr' => floor(floatval($sum['click'] / intval($sum['pop'])) * 10000) / 10000,
            'profit' => $sum['profit']
        );
        return $ret;
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

    private function _addStaticToDB($uid, $cid, $impression, $click, $profit, $date) {
        $t = 'intext';
        $infoitem = array(
            'token' => '',
            'uid' => $uid,
            'cid' => $cid,
            'pop' => $impression,
            'click' => $click,
            'convers' => 0,
            'cpm' => floor(($profit * 1000 / $impression) * 10000) / 10000,
            'ctr' => floor(($click / $impression) * 10000) / 10000,
            'profit' => $profit,
            'date' => $date,
            'importdate' => date('Y-m-d H:i:s'),
            't' => $t
        );

        $m = M('admin_info');
        $where = array(
            'uid' => $uid,
            'cid' => $cid,
            'date' => $date,
            't' => $t
        );
        $aiitem = $m -> where($where) -> find();
        if ($aiitem !== null) {
            $infoitem['id'] = $aiitem['id'];
            $ret = $m -> save($infoitem);
            if ($ret > 0) {
                return 3;
            } else {
                return 4;
            }
        } else {
            $ret = $m -> add($infoitem);
            if ($ret > 0) {
                return 1;
            } else {
                return 2;
            }
        }
    }

    public function addstatic() {
        if ($this -> _checklogin()) {
            if (isset($_POST['uid'])) {
                $uid = $_POST['uid'];
                $cid = $_POST['cid'];
                $impression = intval($_POST['impression']);
                $click = intval($_POST['click']);
                $profit = floatval($_POST['profit']);
                $date = $_POST['date'];
                $t = 'intext';

                $returnUrl = U('Intext/info', array('cid' => $cid, 'uid' => $uid));
                $ret = $this -> _addStaticToDB($uid, $cid, $impression, $click, $profit, $date);
                $convertRet = "";
                if ($ret == 3 || $ret == 1) {
                    $discount = isset($_POST['discount']) ? $_POST['discount'] : 0;
                    if (!is_numeric($discount) || $discount <= 0 || $discount > 1) {
                        $convertRet = '转换失败，折扣参数有误：' . $discount;
                    } else {
                        $conRet = $this -> _setStatisticsToLocalDB($uid, $cid, $discount);
                        if ($conRet == 1) {
                            $convertRet = '转换成功';
                        } else {
                            $convertRet = '转换失败，转换失败代码：' . $conRet;
                        }
                    }
                }
                if ($ret == 3) {
                    $this -> success('修改成功' . $convertRet, $returnUrl);
                } else if ($ret == 4) {
                    $this -> error('修改失败', $returnUrl);
                } else if ($ret == 1) {
                    $this -> success('添加成功' . $convertRet, $returnUrl);
                } else {
                    $this -> error('添加失败', $returnUrl);
                }
            } else {
                $this -> error('参数有误', 'info');
            }
        } else {
            $this -> redirect('Auth/login');
        }
    }

    public function uploadstatic() {
        if ($this -> _checklogin()) {
            if (isset($_FILES['stafile'])
                && isset($_POST['uid']) && isset($_POST['cid'])) {
                $uid = $_POST['uid'];
                $cid = $_POST['cid'];
                import('ORG.Util.parseCSV');
                $file = $_FILES['stafile']['tmp_name'];
                $csv = new parseCSV();
                $csv->auto($file);
                $ret = array();
                foreach ($csv->data as $key => $row) {
                    if ($row['uid'] != $uid || $row['cid'] != $cid) {
                        continue;
                    }
                    $ret[] = array(
                        'date' => $row['date'],
                        'uid' => $row['uid'],
                        'cid' => $row['cid'],
                        'pop' => $row['impressions'],
                        'click' => $row['clicks'],
                        'profit' => $row['profit']
                    );
                }
                $failCount = 0;
                for ($i = 0, $j = count($ret); $i < $j; $i++) {
                    $item = $ret[$i];
                    $addret = $this -> _addStaticToDB(
                        $item['uid'],
                        $item['cid'],
                        $item['pop'],
                        $item['click'],
                        $item['profit'],
                        $item['date']);
                    if ($addret == 2 || $addret == 4) {
                        $failCount = $failCount + 1;
                    }
                }
                $returnUrl = U('Intext/info', array('cid' => $cid, 'uid' => $uid));
                if ($failCount == 0) {
                    $discount = isset($_POST['discount']) ? $_POST['discount'] : 0;
                    if (!is_numeric($discount) || $discount <= 0 || $discount > 1) {
                        $this -> error('导入成功，转换失败，折扣参数有误：' . $discount);
                    } else {
                        $conRet = $this -> _setStatisticsToLocalDB($uid, $cid, $discount);
                        if ($conRet == 1) {
                            $this -> success('导入成功，转换成功', $returnUrl);
                        } else {
                            $this -> error('导入成功，转换失败，转换失败代码：', $conRet);
                        }
                    }
                } else {
                    $this -> error('导入失败，失败数：' . $failCount, $returnUrl);
                }
            } else {
                $this -> error('参数有误', 'info');
            }
        } else {
            $this -> redirect('Auth/login');
        }
    }
}