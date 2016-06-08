<?php

    function isHasMultiAds() {
        $m = M('userchannel');
        $uid = $_SESSION['uid'];
        $where = array('uid' => $uid);
        $ret = $m -> where($where) -> field("types") -> group("types") -> select();
        return $ret;
    }

    function initAdt() {
        if (isset($_GET['adt'])) {
            $adt = $_GET['adt'];
            if ($adt !== 'total'
                && $adt !== 'sn'
                && $adt !== 'sd'
                && $adt !== 'banners'
                && $adt !== 'intext'
                && $adt !== 'inimage') {
                $adt = 'total';
            }
            if ($adt == 'sn') {
                $adt = 'impressions';
            } else if ($adt == 'sd') {
                $adt = 'superfish';
            }
            $_SESSION['adt'] = $adt;
        }
        return getAdt();
    }

    function getAdt() {
        $adt = $_SESSION['adt'];
        if (empty($adt)) {
            $adt = 'total';
        }
        return $adt;
    }

    function getOtherStaticInfo($dateRange, $uid, $adt) {
        if ($adt == 'total') {
            return null;
        } else {
            $uc_m = M('userchannel');
            $uc_where = array(
                'uid' => $uid,
                'types' => 'other'
            );
            $ret = array();
            $uc_ret = $uc_m -> where($uc_where) -> field('cid') -> find();
            if ($uc_ret == null) {
                return null;
            }
            $ucRets = array();
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
                    $ucRet = $i_m -> order('date desc') -> where($i_where) -> field('pop,click,cpm,ctr,profit,date,mark') -> select();
                    if (!empty($ucRet)) {
                        for ($i = 0, $j = count($ucRet); $i < $j; $i++) {
                            if ($ucRet[$i]['mark'] == $adt ||
                                ($ucRet[$i]['mark'] == 'pop' && $adt == 'impressions')) {
                                $ucRets[] = $ucRet[$i];
                            }
                        }
                    }
                }
            }
            return empty($ucRets) ? null : $ucRets;
        }
    }

    function createUserId($length = 32) {
        $token = "";
        $codeAlphabet = "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        for($i=0;$i<$length;$i++){
            $token .= $codeAlphabet[crypto_rand_secure(0,strlen($codeAlphabet))];
        }
        return $token;
    }

    function crypto_rand_secure($min, $max) {
        $range = $max - $min;
        if ($range < 0) return $min; // not so random...
        $log = log($range, 2);
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd >= $range);
        return $min + $rnd;
    }

    function p_getInfoRet() {
        $uc_m = M('userchannel');
        $uc_where = array(
            'uid' => $_SESSION['uid']
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

    function p_getAllIncome($infos) {
        $allIncome = 0;
        if (!empty($infos)) {
            $total = p_getTotalStatics($infos);
            $allIncome = floatval($total['profit']);
        }
        return $allIncome;
    }

    function p_getTotalStatics($data) {
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

    function getIncome() {
        $allIncome = p_getAllIncome(p_getInfoRet());

        $m = M('payment');
        $where = array(
            'uid' => $_SESSION['uid']
        );
        $allpayments = $m -> where($where) -> select();
        $paid = 0;
        for ($i = 0, $j = count($allpayments); $i < $j; $i++) {
            $paid = $paid + floatval($allpayments[$i]['paycount']);
        }
        return $allIncome - $paid;
    }

    function getUnReadMsgCount() {
        $ret = 0;
        $m = D('UserMessage');
        $where = array(
            'uid' => $_SESSION['uid'],
            'isread' => 0,
            'isactive' => 1
        );
        $ret = $m -> where($where) -> count();
        return $ret;
    }

    function getInvoicePath($invoice) {
        if (empty($invoice)) {
            return $invoice;
        }
        $newinvoice = str_replace(".pdf", "", $invoice);
        $year = explode("-",$newinvoice)[3];
        $month = explode("-",$newinvoice)[2];
        return "invoice/$year/$month/$invoice";
    }

    function getSignInvoicePath($upinvoice){
        if(empty($upinvoice)){
            return $invoice;
        }
        $newinvoice = str_replace(".pdf", "", $upinvoice);
        $newinvoices = explode("-",$newinvoice);
        $year  = $newinvoices[3];
        $month = $newinvoices[2];
        if(!empty($year) && !empty($month)){
            return "upinvoice/$year/$month/$upinvoice";
        }else{
            return "upinvoice/newname/$upinvoice";
        }
    }

    function sendEmail($mailto, $subject, $body, $display = "Adonads") {
        import('ORG.Util.Mail');
        return SendMail($mailto, $subject, $body, $display);
    }

    function sendResetPwdEmail($mailto,$firstname,$password){
        $body = <<<EOT
<p style="margin-top:0;margin-bottom:0;line-height:18px">
    <span style="font-size: 16px;font-family: Verdana">Dear&nbsp;$firstname,</span>
</p>
<p style="margin-top:0;margin-bottom:0;line-height:18px">
    <span style="font-size: 16px;font-family: Verdana">Your&nbsp;account&nbsp;is&nbsp;$mailto</span>
</p>
<p style="margin-top:0;margin-bottom:0;line-height:18px">
    <span style="font-size: 16px;font-family: Verdana">Your&nbsp;password&nbsp;is&nbsp;$password</span>
</p>
EOT;
    return sendEmail($mailto, "To Get Your Account Password", $body);
    }

    function sendSingupSuccessEmail($mailto, $username="developer") {
        $body = <<<EOT
<p style="margin-top:0;margin-bottom:0;line-height:18px">
    <span style="font-size: 18px;font-weight:bold;font-family: Verdana">Congratulations!</span>
</p>
<p style="margin-top:0;margin-bottom:0;line-height:18px">
    <span style="font-size: 16px;">&nbsp;</span>
</p>
<p style="margin-top:0;margin-bottom:0;line-height:18px">
    <span style="font-size: 16px;font-family: Verdana">You&nbsp;Have&nbsp;Successfully&nbsp;Registered&nbsp;With&nbsp;Adonads.com!</span>
</p>
<p style="margin-top:0;margin-bottom:0;line-height:18px">
    <span style="font-size: 16px;">&nbsp;</span>
</p>
<p style="margin-top:0;margin-bottom:0;line-height:18px">
    <span style="font-size: 16px;font-family: Verdana">Our&nbsp;team&nbsp;will&nbsp;try&nbsp;to&nbsp;review&nbsp;your&nbsp;application&nbsp;as&nbsp;quickly&nbsp;as&nbsp;possible&nbsp;and&nbsp;appoint&nbsp;a&nbsp;dedicated&nbsp;account&nbsp;manager&nbsp;to&nbsp;you.</span>
</p>
<p style="margin-top:0;margin-bottom:0;line-height:18px">
    <span style="font-size: 16px;">&nbsp;</span>
</p>
<p style="margin-top:0;margin-bottom:0;line-height:18px">
    <span style="font-size: 16px;font-family: Verdana">You&nbsp;can&nbsp;know&nbsp;more&nbsp;about&nbsp;us&nbsp;in&nbsp;our&nbsp;website:&nbsp;<a href="http://www.adonads.com/"><span style="color: rgb(0, 0, 255);">http://www.adonads.com/</span></a></span>
</p>
<p style="margin-top:0;margin-bottom:0;line-height:18px">
    <span style="font-size: 16px;font-family: Verdana">&nbsp;</span>
</p>
<p style="margin-top:0;margin-bottom:0;line-height:18px">
    <span style="font-size: 16px;font-family: Verdana">If&nbsp;you&nbsp;have&nbsp;any&nbsp;questions,&nbsp;you&nbsp;can&nbsp;send&nbsp;email&nbsp;to:&nbsp;<a href="mailto:support@adonads.com"><span style="color: rgb(0, 0, 255);">support@adonads.com</span></a></span>
</p>
<p style="margin-top:0;margin-bottom:0;line-height:18px">
    <span style="font-size: 16px;">&nbsp;</span>
</p>
<p style="margin-top:0;margin-bottom:0;line-height:18px">
    <span style="font-size: 16px;font-family: Verdana">Thank&nbsp;you&nbsp;for&nbsp;support!</span>
</p>
<p style="margin-top:0;margin-bottom:0;line-height:18px">
    <span style="font-size: 16px;font-family: Verdana">Best&nbsp;regards,</span>
</p>
<p style="margin-top:0;margin-bottom:0;line-height:18px">
    <span style="font-size: 16px;font-family: Verdana">Adonads&nbsp;Support&nbsp;Team</span>
</p>
<p style="margin-top:0;margin-bottom:0;line-height:18px">
    <span style="font-size: 16px;">&nbsp;</span>
</p>
<p style="margin-top: 0px; margin-bottom: 0px;color:#aaa;">
    <span style="font-size: 16px;font-family: Verdana">*&nbsp;This&nbsp;is&nbsp;an&nbsp;automated&nbsp;email&nbsp;from&nbsp;Adonads.&nbsp;Do&nbsp;not&nbsp;reply&nbsp;this&nbsp;email.&nbsp;Please&nbsp;ignore&nbsp;this&nbsp;email&nbsp;if&nbsp;you&nbsp;did&nbsp;not&nbsp;get&nbsp;registered&nbsp;by&nbsp;your&nbsp;own.&nbsp;</span>
</p>
EOT;
        return sendEmail($mailto, "Thank you for your registered", $body);
    }

    function sendPaymentRequestEmail($mailto, $firstname="developer") {
        $nextMonth = intval(date('m', strtotime('+1 month')));
        $body = <<<EOT
<p style="margin-top:0;margin-bottom:0;line-height:18px">
    <span style="font-size: 16px;font-family: Verdana">Dear&nbsp;$firstname,</span>
</p>
<p style="margin-top:0;margin-bottom:0;line-height:18px">
    <span style="font-size: 16px;font-family: Verdana">&nbsp;</span>
</p>
<p style="margin-top:0;margin-bottom:0;line-height:18px">
    <span style="font-size: 16px;font-family: Verdana">We&nbsp;had&nbsp;received&nbsp;your&nbsp;request&nbsp;of&nbsp;payment.&nbsp;</span><span style="font-size: 16px;font-family: Verdana">We&nbsp;will&nbsp;pay&nbsp;the&nbsp;money&nbsp;at&nbsp;the&nbsp;beginning&nbsp;of&nbsp;$nextMonth&nbsp;month<span style="font-family:Verdana">.</span></span>
</p>
<p style="margin-top:0;margin-bottom:0;line-height:18px">
    <span style="font-size: 16px;font-family: Verdana">&nbsp;</span>
</p>
<p style="margin-top:0;margin-bottom:0;line-height:18px">
    <span style="font-size: 16px;font-family: Verdana">Best&nbsp;regards,</span>
</p>
<p style="margin-top: 0px; margin-bottom: 0px; line-height: 18px;">
    <span style="font-size: 16px;font-family: Verdana">Adonads&nbsp;Support&nbsp;Team</span>
</p>
EOT;
        sendEmail($mailto, "About your payment request", $body);
    }

?>