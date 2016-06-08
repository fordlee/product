<?php
// 本类由系统自动生成，仅供测试用途
class InfoAction extends Action {

    private function _checklogin() {
        $ret = false;
        if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
            $isMultiAds = isHasMultiAds();
            if (count($isMultiAds) > 1) {
                for ($i = 0, $j = count($isMultiAds); $i < $j; $i++) {
                    $this -> assign('multiads_' . $isMultiAds[$i]['types'], 1);
                }
                $adt = initAdt();
                $this -> assign('adt', $adt);
                $this -> assign('multiads', 1);
            }
            $ret = true;
        }
        return $ret;
    }

    private function _getUid() {
        return $_SESSION['uid'];
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

    private function _getInfoRet($dateRange) {
        $uc_m = M('userchannel');
        $uc_where = array(
            'uid' => $this -> _getUid()
        );
        $adt = getAdt();
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
            $this -> assign('total', $total);
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

    public function revenue() {
        if ($this -> _checklogin()) {
            $this -> assign('username', $_SESSION['username']);
            $dateRange = $this -> _getDateRange();
            $today = date('Y-m-d');
            $this -> assign('today', $today);

            if (isset($_POST['dateRange'])) {
                $this -> assign('currrange', $_POST['dateRange']);
            } else {
                $this -> assign('currrange', 'last_30_days');
            }

            $ret = $this -> _getInfoRet($dateRange);

            $isShowTotalTip = $this -> _isShowTip($ret);
            $this -> assign('isShowTotalTip', $isShowTotalTip);

            $this -> assign('ret', $ret);
            $this -> display();
        } else {
            $this -> redirect('Auth/login');
        }
    }

    private function _isShowTip(&$ret) {
        $isShowTotalTip = 0;
        $today = date('Y-m-d');
        $yestoday = date('Y-m-d', strtotime('-1 day', strtotime($today)));
        $yestoday_yestoday = date('Y-m-d', strtotime('-1 day', strtotime($yestoday)));
        $yestoday_yestoday_yestoday = date('Y-m-d', strtotime('-1 day', strtotime($yestoday_yestoday)));
        $yestoday_yestoday_yestoday_y = date('Y-m-d', strtotime('-1 day', strtotime($yestoday_yestoday_yestoday)));
        $yestoday_yestoday_yestoday_yy = date('Y-m-d', strtotime('-1 day', strtotime($yestoday_yestoday_yestoday_y)));
        for ($i = 0, $j = count($ret); $i < $j; $i++) {
            if ($ret[$i]['date'] == $today
                || $ret[$i]['date'] == $yestoday
                || $ret[$i]['date'] == $yestoday_yestoday
                || $ret[$i]['date'] == $yestoday_yestoday_yestoday
                || $ret[$i]['date'] == $yestoday_yestoday_yestoday_y
                || $ret[$i]['date'] == $yestoday_yestoday_yestoday_yy) {
                $ret[$i]['tipnum'] = 1;
                $isShowTotalTip = 1;
            }
        }
        return $isShowTotalTip;
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
            'profit' => $sum['profit'],
            'date' => 'total'
        );
        return $ret;
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
        $keys = array('Date', 'Impressions', 'Clicks', 'CPM', 'CTR', 'Profit');
        echo implode(',', $keys) . PHP_EOL;
        for ($i = 0, $j = count($array); $i < $j; $i++) {
            $row = $array[$i];
            echo $row['date'] . ',"' . number_format($row['pop']) . '","' . number_format($row['click']) . '","' . number_format($row['cpm'], 4) . '","' . number_format($row['ctr'], 4) . '","$' . number_format($row['profit'], 2) . '"' . PHP_EOL;
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
            $ret = $this -> _getInfoRet($dateRange);
            $total = $this -> _getTotalStatics($ret);
            array_push($ret, $total);

            $this -> _download_send_headers("adonads_data_export_" . date("Y-m-d") . ".csv");
            $this -> _array2csv($ret);
        } else {
            echo 0;
        }
    }
}