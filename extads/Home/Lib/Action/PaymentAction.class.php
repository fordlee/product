<?php
// 本类由系统自动生成，仅供测试用途
class PaymentAction extends Action {

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

    private function _getInfoRet() {
        $uc_m = M('userchannel');
        $uc_where = array(
            'uid' => $this -> _getUid()
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
                        'o_cid' => $c_ret['o_cid']
                    );
                    $ucRet = $i_m -> order('date desc') -> where($i_where) -> field('pop,click,cpm,ctr,profit,date') -> select();
                    if (!empty($ucRet)) {
                        $ucRets[] = $ucRet;
                    }
                }
            }
        }
        if (count($ucRets) == 1) {
            $ret = $ucRets[0];
        } else if (count($ucRets) == 0) {
        } else {
            for ($i = 0, $j = count($ucRets); $i < $j; $i++) {
                for ($m = 0, $n = count($ucRets[$i]); $m < $n; $m++) {
                    $ret[] = $ucRets[$i][$m];
                }
            }
        }
        return $ret;
    }

    private function _getAllIncome($infos) {
        $allIncome = 0;
        if (!empty($infos)) {
            $total = $this -> _getTotalStatics($infos);
            $allIncome = floatval($total['profit']);
        }
        return $allIncome;
    }

    private function _getIncome($allpayments, $allIncome) {
        $paid = 0;
        for ($i = 0, $j = count($allpayments); $i < $j; $i++) {
            $paid = $paid + floatval($allpayments[$i]['paycount']);
        }
        return $allIncome - $paid;
    }

    private function _getCanPaymentIncome($infos, $income) {
        $lastMonth = strtotime(date('Y-m-01'));
        $paid = 0;
        for ($i = 0, $j = count($infos); $i < $j; $i++) {
            if (strtotime($infos[$i]['date']) >= $lastMonth) {
                $paid = $paid + floatval($infos[$i]['profit']);
            }
        }
        return $income - $paid;
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

    public function payments(){
        if ($this -> _checklogin()) {
            $this -> assign('username', $_SESSION['username']);
            $m = M('payment');
            $where = array(
                'uid' => $this -> _getUid()
            );
            $ret = $m -> order('id desc') -> where($where) -> select();

            $infos = $this -> _getInfoRet();
            $allIncome = $this -> _getAllIncome($infos);
            $this -> assign('totalIncome', $allIncome);

            $income = $this -> _getIncome($ret, $allIncome);
            $this -> assign('income', $income);

            $im = M('info');
            $canPaymentIncome = $this -> _getCanPaymentIncome($infos, $income);
            $this -> assign('canPaymentIncome', $canPaymentIncome);

            $m_u = M('user');
            $uid = $this -> _getUid();
            $userinfo = $m_u -> field('checkcycle,usertype') -> where(array("uid" => $uid)) -> find();
            $this -> assign('userinfo',$userinfo);

            $accountInfo = $this -> _getAccountinfo($m,$where);
            $this -> assign('account',$accountInfo);
            $this -> assign('ret', $ret);
            $this -> display();
        } else {
            $this -> redirect('Auth/login');
        }
    }

    private function _getAccountinfo($m,$where){
        $ret = $m -> where($where) -> select();
        foreach ($ret as $key => $value) {
            if(is_array($value)){
                if($value['swift'] != null
                    && $value['owner'] != null
                    //&& $value['cp_address'] != null
                    && $value['number'] != null
                    && $value['bank'] != null
                    && $value['address'] != null
                    && $value['paytype'] == 2){
                    $data['swift'] = $value['swift'];
                    $data['owner'] = $value['owner'];
                    $data['cp_address'] = $value['cp_address'];
                    $data['number'] = $value['number'];
                    $data['bank'] = $value['bank'];
                    $data['address'] = $value['address'];
                }elseif($value['name'] != null
                    && $value['account'] != null
                    //&& $value['cp_address'] != null
                    && $value['paytype'] == 1){
                    $data['name'] = $value['name'];
                    $data['account'] = $value['account'];
                    $data['cp_address'] = $value['cp_address'];
                }
            }
        }
        $accountInfo = $data;
        
        return $accountInfo;
    }

    public function uploadSignedInvoice(){
        if (($_FILES["file"]["type"] == "application/pdf")){
            if ($_FILES["file"]["error"] > 0){
                $this -> error("Return Code: " . $_FILES["file"]["error"],'payments');
            }else{
                $upinvoicename = $_FILES["file"]["name"];
                $newinvoice = str_replace(".pdf", "", $upinvoicename);
                $newinvoices = explode("-",$newinvoice);
                $year  = $newinvoices[3];
                $month = $newinvoices[2];
                if(!empty($year) && !empty($month)){
                    $folder = ROOTPATH.'/upinvoice/' . $year . '/' . $month;
                    $newupinvoicename = $upinvoicename;
                }else{
                    $folder = ROOTPATH.'/upinvoice/newname';
                    $newupinvoicename = strtoupper(uniqid()).'-'.$upinvoicename;
                }
                if (!file_exists($folder)){
                    mkdir($folder, 0777, true);
                }
                
                $pid = $_POST['pid'];
                $this -> _delUpinvoiceFile($pid,$folder);

                $is_up = move_uploaded_file($_FILES["file"]["tmp_name"],$folder.'/'.$newupinvoicename);
                if($is_up != 1){
                    $newupinvoicename = strtoupper(uniqid()).'.pdf';
                    $is_up = move_uploaded_file($_FILES["file"]["tmp_name"],$folder.'/'.$newupinvoicename);
                }
                $ret = $this -> _updateUpinvoice($is_up,$newupinvoicename,$pid);
                if($ret){
                    $this -> success('upload invoice success!','payments');
                }else{
                    $this -> error('upload invoice failed!','payments');
                }
            }
        }else{
            $this -> error('Invalid file type','payments');
        }
    }

    private function _delUpinvoiceFile($pid,$folder){
        $m_p = M('payment');
        $upinvoice = $m_p -> where('id='.$pid) -> getField('upinvoice');
        if($upinvoice != null){
            $file = ROOTPATH.'/upinvoice/newname/'.$upinvoice;
            $filename = $folder.'/'.$upinvoice;
            if(file_exists($file)){
                @unlink($file);
            }
            if(file_exists($filename)){
                @unlink($filename);
            }
        }
    }

    private function _updateUpinvoice($is_up,$upinvoice,$pid){
        if($is_up){
            $m_p = M('payment');
            $where = array(
                "id"  => $pid,
                "uid" => $this -> _getUid()
            );
            //$ret = $m_p -> where($where) -> save(array("upinvoice" => $upinvoice));
            
            $Tb=M();
            $query = "UPDATE `payment` SET `upinvoice`=\"$upinvoice\" WHERE `id` = $pid";
            $ret=$Tb->execute($query);
            $ret=$ret!==false?true:false;
            
            return $ret;
        }else{
            $this -> error('upload invoice failed!','payments');
        }
    }

    public function addpayment_paypal() {
        if (isset($_POST['name']) && !empty($_POST['name'])
            && isset($_POST['account']) && !empty($_POST['account'])
            && isset($_POST['cp_address']) && !empty($_POST['cp_address'])) {
            $params = array(
                "paytype" => 1,
                "name" => $_POST['name'],
                "account" => $_POST['account'],
                "cp_address" => $_POST['cp_address'],
            );
            $this -> _addpayment($params);
        } else {
            $this -> error('error', 'payments');
        }
    }

    public function addpayment_wiretransfer() {
        if (isset($_POST['swift']) && !empty($_POST['swift'])
            && isset($_POST['owner']) && !empty($_POST['owner'])
            && isset($_POST['cp_address']) && !empty($_POST['cp_address'])
            && isset($_POST['number']) && !empty($_POST['number'])
            && isset($_POST['bank']) && !empty($_POST['bank'])
            && isset($_POST['address']) && !empty($_POST['address'])) {
            $params = array(
                "paytype" => 2,
                "swift" => $_POST['swift'],
                "owner" => $_POST['owner'],
                "cp_address" => $_POST['cp_address'],
                "number" => $_POST['number'],
                "bank" => $_POST['bank'],
                "address" => $_POST['address']
            );
            $this -> _addpayment($params);
        } else {
            $this -> error('error', 'payments');
        }
    }

    //手动付款用户保存账户信息
    public function savepayment_info(){
        if (isset($_POST['swift']) && !empty($_POST['swift'])
            && isset($_POST['owner']) && !empty($_POST['owner'])
            && isset($_POST['cp_address']) && !empty($_POST['cp_address'])
            && isset($_POST['number']) && !empty($_POST['number'])
            && isset($_POST['bank']) && !empty($_POST['bank'])
            && isset($_POST['address']) && !empty($_POST['address'])) {
            $params = array(
                "uid" => $this -> _getUid(),
                "paytype" => 2,
                "paycount" => 0,
                "swift" => $_POST['swift'],
                "owner" => $_POST['owner'],
                "cp_address" => $_POST['cp_address'],
                "number" => $_POST['number'],
                "bank" => $_POST['bank'],
                "address" => $_POST['address']
            );
            $m_p = M('payment');
            $ret = $m_p -> order("addtime desc") -> where($params) -> find();
            if($ret == NULL){
                $m_p -> where(array("uid" => $this -> _getUid(), "paycount" => 0)) -> delete();
                $params['status'] = 0;
                $params['addtime'] = date('Y-m-d H:i:s');
                $m_p -> add($params);
            }
            $this -> success('success', 'payments');
        }elseif(isset($_POST['name']) && !empty($_POST['account'])){
            $params = array(
                "uid" => $this -> _getUid(),
                "paytype" => 1,
                "paycount" => 0,
                "cp_address" => $_POST['cp_address'],
                "name" => $_POST['name'],
                "account" => $_POST['account']
            );
            $m_p = M('payment');
            $ret = $m_p -> order("addtime desc") -> where($params) -> find();
            if($ret == NULL){
                $m_p -> where(array("uid" => $this -> _getUid(), "paycount" => 0)) -> delete();
                $params['status'] = 0;
                $params['addtime'] = date('Y-m-d H:i:s');
                $m_p -> add($params);
            }
            $this -> success('success', 'payments');
        } else {
            $this -> error('error', 'payments');
        }
    }

    public function addpayment_westernunion() {
        if (isset($_POST['name']) && !empty($_POST['name'])
            && isset($_POST['address']) && !empty($_POST['address'])
            && isset($_POST['tel']) && !empty($_POST['tel'])) {
            $params = array(
                "paytype" => 3,
                "name" => $_POST['name'],
                "address" => $_POST['address'],
                "tel" => $_POST['tel']
            );
            $this -> _addpayment($params);
        } else {
            $this -> error('error', 'payments');
        }
    }

    public function addpayment_alipay() {
        if (isset($_POST['name']) && !empty($_POST['name'])
            && isset($_POST['account']) && !empty($_POST['account'])) {
            $params = array(
                "paytype" => 4,
                "name" => $_POST['name'],
                "account" => $_POST['account']
            );
            $this -> _addpayment($params);
        } else {
            $this -> error('error', 'payments');
        }
    }

    private function _addpayment($exparams) {
        if ($this -> _checklogin()) {
            if (isset($_POST['paycount']) && !empty($_POST['paycount'])) {
                $paycount = floatval($_POST['paycount']);
                if ($paycount < 100) {
                    $this -> error('money error(100)', 'payments');
                    exit(0);
                }
                $m = M('payment');
                $where = array(
                    'uid' => $this -> _getUid()
                );
                $ret = $m -> order('id desc') -> where($where) -> select();
                $infos = $this -> _getInfoRet();
                $allIncome = $this -> _getAllIncome($infos);
                $income = $this -> _getIncome($ret, $allIncome);

                if ($paycount > round($income, 2)) {
                    $this -> error('money error', 'payments');
                    exit(0);
                }

                $item = array(
                    'uid' => $this -> _getUid(),
                    'paycount' => $paycount,
                    'status' => 0,
                    'addtime' => date('Y-m-d H:i:s')
                );
                $item = array_merge($item, $exparams);
                $addret = $m -> add($item);
                if ($addret > 0) {
                    try {
                        $userm = M('user');
                        $userinfo = $userm -> where(array("uid" => $this -> _getUid())) -> find();
                        if ($userinfo !== null) {
                            sendPaymentRequestEmail($userinfo['username'], $userinfo['firstname']);
                        }
                    } catch(Exception $e) {

                    }
                    $this -> success('add success', 'payments');
                } else {
                    $this -> error('error, please contact us', 'payments');
                }
            } else {
                $this -> error('error', 'payments');
            }
        } else {
            $this -> redirect('Auth/login');
        }
    }
}