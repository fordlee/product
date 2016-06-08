<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {

    private function _checklogin() {
        $ret = false;
        if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
            $ret = true;
            $isMultiAds = isHasMultiAds();
            if (count($isMultiAds) > 1) {
                for ($i = 0, $j = count($isMultiAds); $i < $j; $i++) {
                    $this -> assign('multiads_' . $isMultiAds[$i]['types'], 1);
                }
                $adt = initAdt();
                $this -> assign('adt', $adt);
                $this -> assign('multiads', 1);
            }
        }
        return $ret;
    }

    private function _getUid() {
        return $_SESSION['uid'];
    }

    public function index(){
        if ($this -> _checklogin()) {
            $this -> assign('username', $_SESSION['username']);

            $todayret = $this -> _getInfoRet($this -> _getDateRange('today'), 'todaytotal');
            $this -> assign('todayret', $todayret);

            $ret = $this -> _getInfoRet($this -> _getDateRange('this_month'), 'total');
            $this -> assign('ret', $ret);

            $this -> display();
        } else {
            $this -> redirect('Auth/login');
        }
    }

    private function _getDateRange($dateRange) {
        $today = strtotime(date('Y-m-d'));
        $ret = array (
            'begin' => date('Y-m-d', strtotime('-30 day', $today)),
            'end' => date('Y-m-d', strtotime('-1 day', $today)),
        );
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
        return $ret;
    }

    private function _getInfoRet($dateRange, $totalname) {
        $adt = getAdt();
        $uc_m = M('userchannel');
        $uc_where = array(
            'uid' => $this -> _getUid()
        );
        if ($adt == 'impressions') {
            $uc_where['types'] = 'pop';
        } else if ($adt == 'superfish'
            || $adt == 'banners'
            || $adt == 'intext'
            || $adt == 'inimage') {
            $uc_where['types'] = $adt;
        }
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
        $otherRets = getOtherStaticInfo($dateRange, $this -> _getUid(), $adt);
        if ($otherRets !== null) {
            $ucRets[] = $otherRets;
        }
        if (count($ucRets) == 0) {
        } else {
            $ret = $this -> _mergeStaticsByDate($ucRets, $dateRange);
        }
        if (!empty($ret)) {
            $total = $this -> _getTotalStatics($ret);
            $this -> assign($totalname, $total);
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

    public function faq() {
        if ($this -> _checklogin()) {
            $this -> assign('username', $_SESSION['username']);
            $this -> display();
        } else {
            $this -> redirect('Auth/login');
        }
    }

    public function message() {
        if ($this -> _checklogin()) {
            $m = D('UserMessage');
            $where = array(
                "isactive" => 1,
                "uid" => $this -> _getUid()
            );
            $ret = $m -> order('isread') -> where($where) -> select();
            $this -> assign('ret', $ret);
            $this -> display();
        } else {
            $this -> redirect('Auth/login');
        }
    }

    public function msgshow() {
        if ($this -> _checklogin()) {
            if (isset($_GET['id']) && !empty($_GET['id'])) {
                $mid = $_GET['id'];
                $m = D('UserMessage');
                $where = array(
                    "isactive" => 1,
                    "uid" => $this -> _getUid(),
                    "mid" => $mid
                );
                $ret = $m -> where($where) -> find();
                if ($ret !== null) {
                    $msgm = M('msg');
                    $item = $msgm -> where(array("id" => $mid)) -> find();
                    if ($item !== null) {
                        $um = M('usermsg');
                        $umitem = array(
                            "id" => $ret['id'],
                            "isread" => 1,
                            "readtime" => date('Y-m-d H:i:s')
                        );
                        $um -> save($umitem);
                        if ($item['type'] == 'link') {
                            header('Location:' . $item['href']);
                            die();
                        } else {
                            $item['content'] = str_replace('src="/ueditor', 'src="http://admin.adonads.com/ueditor', $item['content']);
                            $this -> assign('item', $item);
                        }
                    }
                }
            }
            $this -> display();
        } else {
            $this -> redirect('Auth/login');
        }
    }

    public function support() {
        if ($this -> _checklogin()) {
            $this -> display();
        } else {
            $this -> redirect('Auth/login');
        }
    }

    public function f(){
        $this -> display();
    }
}