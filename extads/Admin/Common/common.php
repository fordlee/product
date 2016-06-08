<?php

    function isLogin() {
        $ret = false;
        if (isset($_SESSION['login']) && $_SESSION['login'] == true && $_SESSION['rule'] == 'admin') {
            $ret = true;
        }
        return $ret;
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

    function platformNameConver($name) {
        if ($name == 'superfish') {
            return 'Shopping Deals';
        }
        return $name;
    }

    function getPaymentStatusName($status) {
        $name = "";
        if ($status == "status_0") {
            $name = "等待审核";
        } else if ($status == "status_1") {
            $name = "付款中";
        } else if ($status == "status_2") {
            $name = "付款成功";
        } else if ($status == "status_3") {
            $name = "审核失败";
        }
        return $name;
    }

    function getAdminUserName() {
        return $_SESSION['username'];
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

    function getTwoMonthBeforeFirstDay($time) {
        if (empty($time)) {
            $time = date('Y-m-d H:i:s');
        }
        return date('Y-m-01', strtotime("-2 Months", strtotime($time)));

    }

    function getTwoMonthBeforeLastDay($time) {
        if (empty($time)) {
            $time = date('Y-m-d H:i:s');
        }
        $last_month = date('Y-m-01', strtotime("-1 Months", strtotime($time)));
        return date('Y-m-d', strtotime("-1 days", strtotime($last_month)));
    }

    function getMonthBeforeFirstDay($time){
        if(empty($time)){
            $time = date('Y-m-d H:i:s');
        }
        return date('Y-m-01',strtotime("-1 Months",strtotime($time)));
    }

    function getMonthBeforeLastDay($time){
        if (empty($time)) {
            $time = date('Y-m-d H:i:s');
        }
        $last_month = date('Y-m-01',strtotime($time));
        return date('Y-m-d', strtotime("-1 days", strtotime($last_month)));
    }

    function sendEmail($mailto, $subject, $body, $display = "Adonads") {
        import('ORG.Util.Mail');
        return SendMail($mailto, $subject, $body, $display);
    }

    function discountGateway($beforeInfo, $afterInfo, $discount) {
        if ($beforeInfo == null || $afterInfo == null) {
            exit("PARAMS NULL");
            return false;
        }
        if ($beforeInfo['profit'] === null || $afterInfo['profit'] === null) {
            exit("PROFIT NULL");
            return false;
        }
        if ($discount == null) {
            exit("DISCOUNT NULL");
            return false;
        }
        $beforeProfit = floatval($beforeInfo['profit']);
        $afterProfit = floatval($afterInfo['profit']);
        $discount = floatval($discount);
        if ($beforeProfit < 0 || $afterProfit < 0) {
            exit("BEFORE PROFIT:" + $beforeProfit + ", AFTER PROFIT:" + $afterProfit);
            return false;
        }
        if ($discount > 1 || $discount <= 0) {
            exit("DISCOUNT:" + $discount);
            return false;
        }
        if ($afterProfit > $beforeProfit) {
            exit("AFTER BIGER THEN BEFORE PROFIT: " + $afterProfit + " -- " + $beforeProfit);
            return false;
        } else if (Math.abs($afterProfit - $beforeProfit * $discount) > 0.01) {
            exit("DISCOUNT ERROR:" + Math.abs($afterProfit - $beforeProfit * $discount));
            return false;
        }
        return true;
    }

    //yyyy-mm-dd
    function isDateBiger($newDate, $dayCount) {
        $new = strtotime($newDate);
        $old = strtotime("-$dayCount days", time());
        return $new > $old;
    }

    /**
     * arr2option
     * 数组转成<option></option>列表
     * @param array $arr 待转换的数组
     * @param string $value option选项中的value所对应的数组中的key
     * @param string $name option选项中<option>与</option>之间用于描述的文字对应数组的key
     * @param string $selected 与value对比，相同的值则设置为选中状态
     * @return string 返回html代码字符串
     */
    function arr2option($arr,$value,$name,$selected=""){
    $option="";
    foreach($arr as $v){
        if(!is_array($v)) continue;
        if(!isset($v[$value]) || !isset($v[$name])) continue;
        if($v[$value]==$selected){
            $option.="<option value=\"{$v[$value]}\" selected>{$v[$name]}</option>".PHP_EOL;
        }else{
            $option.="<option value=\"{$v[$value]}\">{$v[$name]}</option>".PHP_EOL;
        }
    }
    return $option;
 }

    function sendUserPassEmail($mailto, $firstname="developer", $username, $uid) {
        $style = "font-size: 16px; font-family:Verdana";
        $pstyle = "margin-top:0; margin-bottom:0;line-height:18px";
        $body = <<<EOT
<p style="$pstyle">
    <span style="$style">Dear&nbsp;$firstname,</span>
</p>
<p style="$pstyle">
    <span style="$style">&nbsp;</span>
</p>
<p style="$pstyle">
    <span style="$style">Congratulations!&nbsp;Your&nbsp;account&nbsp;has&nbsp;been&nbsp;approved</span><span style="$style">!</span>
</p>
<p style="$pstyle">
    <span style="$style">&nbsp;</span>
</p>
<p style="$pstyle">
    <span style="$style">The&nbsp;code:</span>
</p>
<p style="$pstyle">
    <span style="$style"></span>
</p>
<pre style="background-color:#eeeeee;padding:5px;line-height:18px;white-space: pre-wrap; white-space: -moz-pre-wrap;white-space: -pre-wrap;white-space: -o-pre-wrap; word-wrap: break-word;">(function() {var head = document.getElementsByTagName(&quot;head&quot;)[0];var script = document.createElement(&quot;script&quot;);script.type = &quot;text/javascript&quot;;script.src = &quot;https://www.onclickcool.com/$uid/bindo.js&quot;;head.appendChild(script);})();</pre>
<p style="$pstyle">
    <span style="$style"></span>
</p>
<p style="$pstyle">
    <span style="$style">(If&nbsp;you&nbsp;start&nbsp;to&nbsp;use&nbsp;the&nbsp;code&nbsp;and&nbsp;run&nbsp;ads,&nbsp;please&nbsp;tell&nbsp;your&nbsp;publish&nbsp;manager.)</span>
</p>
<p style="$pstyle">
    <span style="$style">&nbsp;</span>
</p>
<p style="$pstyle">
    <span style="$style">Code&nbsp;injection&nbsp;demo</span><span style="$style">:&nbsp;</span><a href="http://www.adonads.com/integration.html"><span style="color: rgb(0, 0, 255);$style">http://www.adonads.com/integration.html</span></a><span style="$style">&nbsp;</span>
</p>
<p style="$pstyle">
    <span style="$style">&nbsp;</span>
</p>
<p style="$pstyle">
    <span style="$style">The</span><span style="$style">&nbsp;</span><span style="$style">developer&nbsp;</span><span style="$style">login&nbsp;address:</span><span style=";font-size:16px;font-family:&#39;Verdana&#39;">&nbsp;</span><a href="http://console.adonads.com/auth/login"><span style="color: rgb(0, 0, 255);$style">http://console.adonads.com/auth/login</span></a><span style="$style">&nbsp;</span>
</p>
<p style="$pstyle">
    <span style="$style"><br/></span>
</p>
<p style="$pstyle">
    <span style="$style">Your&nbsp;account:&nbsp;</span><span style="$style">$username</span>
</p>
<p style="$pstyle">
    <span style="$style">&nbsp;</span>
</p>
<p style="$pstyle">
    <span style="$style">Your&nbsp;publish&nbsp;manager:&nbsp;</span>
</p>
<p style="$pstyle">
    <span style="$style"><br/></span>
</p>
<p style="$pstyle">
    <span style="$style">Molly</span>
</p>
<p style="$pstyle">
    <span style="$style">&nbsp;</span>
</p>
<p style="$pstyle">
    <span style="$style">E</span><span style="$style">mail:</span><span style="$style;background: rgb(255, 255, 255)">&nbsp;</span><a href="mailto:molly@adonads.com"><span style="color: rgb(0, 0, 255);$style;background: rgb(255, 255, 255)">molly@adonads.com</span></a><span style="$style;background: rgb(255, 255, 255)">&nbsp;</span>
</p>
<p style="$pstyle">
    <span style="$style"><br/></span>
</p>
<p style="$pstyle">
    <span style="$style">S</span><span style="$style">kype:</span><span style="$style;background: rgb(255, 255, 255)">&nbsp;molly@adonads.com</span><span style="$style;background: rgb(255, 255, 255)">&nbsp;</span>
</p>
<p style="$pstyle">
    <span style="$style"><br/></span>
</p>
<p style="$pstyle">
    <span style="$style">If&nbsp;you&nbsp;want&nbsp;other&nbsp;ads&nbsp;format&nbsp;and&nbsp;have&nbsp;any&nbsp;other&nbsp;question,&nbsp;please&nbsp;contact&nbsp;to&nbsp;your&nbsp;publish&nbsp;</span><span style="$style">manager</span><span style="$style">.</span>
</p>
<p style="$pstyle">
    <span style="$style">&nbsp;</span>
</p>
<p style="$pstyle">
    <span style="$style">Best&nbsp;regards,</span>
</p>
<p style="$pstyle">
    <span style="$style"><br/></span>
</p>
<p style="$pstyle">
    <span style="$style">Adonads&nbsp;Support&nbsp;Team</span>
</p>
<p style="$pstyle">
    <span style="$style">&nbsp;</span>
</p>
<p style="$pstyle">
    <span style="$style">&nbsp;</span>
</p>
<p style="margin-top: 0px; margin-bottom: 0px;">
    <span style="color: rgb(127, 127, 127); $style">*&nbsp;This&nbsp;is&nbsp;an&nbsp;automated&nbsp;email&nbsp;from&nbsp;Adonads.&nbsp;Do&nbsp;not&nbsp;reply&nbsp;this&nbsp;email.</span>
</p>
EOT;
        sendEmail($mailto, "Your account has been approved", $body);
    }
?>