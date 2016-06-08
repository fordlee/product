<?php
//所有开发者总展示，总点击，开发者收入，公司收入，分成比率
class FinanceAction extends Action {

    public function index() {
        if (isLogin()) {
            $rets = $this -> _getTotalInfo();
            $this -> assign("rets", $rets);

            $total = $this -> _getTotalStatics($rets);
            $this -> assign("total", $total);

            $dateRange = 'last_7_days';
            if (isset($_POST['dateRange'])) {
                $dateRange = $_POST['dateRange'];
            }
            $this -> assign('currrange', $dateRange);

            $this -> display();
        } else {
            $this -> redirect('Auth/login');
        }
    }

    private function _getTotalInfo() {
        $dateRange = $this -> _getDateRange();
        $userRets = $this -> _getInfoRet($dateRange);
        $totalRets = $this -> _getOriInfoRet($dateRange);
        if (count($userRets) != count($totalRets)) {
            return array();
        } else {
            for ($i=0; $i < count($userRets); $i++) {
                $userRets[$i]['userprofit'] = $userRets[$i]['profit'];
                $userRets[$i]['totalprofit'] = $totalRets[$i]['profit'];
                unset($userRets[$i]['profit']);
                $userRets[$i]['avgdiscount'] = floor((floatval($userRets[$i]['userprofit']) / floatval($totalRets[$i]['profit'])) * 10000) / 10000;
            }
        }
        return $userRets;
    }

    private function _getDateRange() {
        $today = strtotime(date('Y-m-d'));
        $ret = array (
            'begin' => date('Y-m-d', strtotime('-7 day', $today)),
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
                $ret['begin'] = date('Y-m-d', strtotime('-30 day', $today));
                $ret['end'] = date('Y-m-d', strtotime('-1 day', $today));
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
        $i_m = M('info');
        $i_where = array(
            'date' => array('between', array($dateRange['begin'], $dateRange['end']))
        );
        $ucRet = $i_m -> order('date desc') -> where($i_where) -> field('pop,click,cpm,ctr,profit,date') -> select();

        if (count($ucRet) == 0) {
            $ret = array();
        } else {
            $ret = $this -> _mergeStaticsByDate($ucRet, $dateRange);
        }
        if (!empty($ret)) {
            $total = $this -> _getTotalStatics($ret);
        } else {
            $ret = null;
        }
        return $ret;
    }

    private function _getOriInfoRet($dateRange) {
        $i_m = M('admin_info');
        $i_where = array(
            'date' => array('between', array($dateRange['begin'], $dateRange['end']))
        );
        $ucRet = $i_m -> order('date desc') -> where($i_where) -> field('pop,click,cpm,ctr,profit,date') -> select();

        if (count($ucRet) == 0) {
        } else {
            $ret = $this -> _mergeStaticsByDate($ucRet, $dateRange);
        }
        if (!empty($ret)) {
            $total = $this -> _getTotalStatics($ret);
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
                "profit" => 0,
                "date" => $date,
            );
            for ($m = 0, $n = count($rets); $m < $n; $m++) {
                $retitem = $rets[$m];
                if ($retitem['date'] == $date) {
                    $arrItem['pop'] = intval($arrItem['pop']) + intval($retitem['pop']);
                    $arrItem['click'] = intval($arrItem['click']) + intval($retitem['click']);
                    $arrItem['profit'] = floatval($arrItem['profit']) + floatval($retitem['profit']);
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
            'avgdiscount' => 0,
            'userprofit' => 0,
            'totalprofit' => 0
        );
        for ($i = 0, $j = count($data); $i < $j; $i++) {
            $item = $data[$i];
            $sum['pop'] = $sum['pop'] + $item['pop'];
            $sum['click'] = $sum['click'] + $item['click'];
            $sum['avgdiscount'] = $sum['avgdiscount'] + $item['avgdiscount'];
            $sum['userprofit'] = $sum['userprofit'] + $item['userprofit'];
            $sum['totalprofit'] = $sum['totalprofit'] + $item['totalprofit'];
        }
        $ret = array(
            'pop' => $sum['pop'],
            'click' => $sum['click'],
            'cpm' => floor((floatval($sum['userprofit']) * 1000 / intval($sum['pop'])) * 10000) / 10000,
            'avgdiscount' => $sum['avgdiscount'] / $j,
            'userprofit' => $sum['userprofit'],
            'totalprofit' => $sum['totalprofit'],
        );
        return $ret;
    }
}

?>