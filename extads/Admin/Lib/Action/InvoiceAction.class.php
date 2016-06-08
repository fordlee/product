<?php

class InvoiceAction extends Action {

    //pid/1/pay_time_begin/2015-09-01/pay_time_end/2015-09-30
    public function index($pid, $ispre = 1, $pay_time_begin = '', $pay_time_end = '') {
        if (isLogin()) {
            $m = D('PaymentView');
            $ret = $m -> where(array("id" => $pid, "status" => 1, "isactive" => 1)) -> find();

            if (empty($ret)) {
                echo -3;
                return;
            }
            if (empty($ret['paytype'])) {
                echo -5;
                return;
            }
            if (empty($pay_time_begin)) {
                if (empty($ret['addtime'])) {
                    echo -4;
                    return;
                }
                $pay_time_month = date('m Y', strtotime("-1 Months", strtotime($ret['addtime'])));
                $pay_time_begin = date('01/m/Y', strtotime("-1 Months", strtotime($ret['addtime'])));
            } else {
                $pay_time_month = date('m Y', strtotime($pay_time_begin));
                $pay_time_begin = date('d/m/Y', strtotime($pay_time_begin));
            }
            if (empty($pay_time_end)) {
                if (empty($ret['addtime'])) {
                    echo -4;
                    return;
                }
                $pay_last_month = date('Y-m-01', strtotime($ret['addtime']));
                $pay_time_end = date('d/m/Y', strtotime("-1 days", strtotime($pay_last_month)));
            } else {
                $pay_time_end = date('d/m/Y', strtotime($pay_time_end));
            }

            $voicename = $this -> _createInvoice(
                $ret['uid'],
                $pid,
                $ret['username'],
                isset($ret['name']) ? $ret['name']: $ret['owner'],
                $pay_time_begin,
                $pay_time_end,
                $pay_time_month,
                intval($ret['paytype']),
                date('d-m-Y',strtotime($ret['addtime'])),
                date('d-m-Y', strtotime($ret['checktime'])),
                number_format($ret['paycount'], 2),
                $ret['name'],
                $ret['account'],
                $ret['swift'],
                $ret['owner'],
                $ret['number'],
                $ret['bank'],
                $ret['address'],
                $ret['cp_address'],
                $ret['tel'],
                $ispre);
            if ($ispre) {
                return;
            }
            if (!empty($voicename) && file_exists($voicename)) {
                $invoice = basename($voicename);
                $um = M('payment');
                $item = array(
                    "id" => $pid,
                    "invoice" => $invoice
                );
                $uret = $um -> save($item);
                if ($uret == 1) {
                    echo 1;
                } else {
                    echo -2;
                }
            } else {
                echo -1;
            }
        } else {
            echo 0;
        }
    }

    private function _createInvoice(
        $uid,
        $pid,
        $username,
        $name,
        $pay_time_begin,
        $pay_time_end,
        $pay_time_month,
        $pay_type,
        $pay_add_time,
        $pay_check_time,
        $pay_total,
        $pay_name,
        $pay_account,
        $pay_swift,
        $pay_owner,
        $pay_number,
        $pay_bank,
        $pay_address,
        $pay_cp_address,
        $pay_tel,
        $ispre){

        $check_year = explode("-",$pay_check_time)[2];
        $check_month = explode("-",$pay_check_time)[1];
        $voiceid = $this -> _genInvoiceId($pay_check_time);
        $voicename = $this -> _getInvoiceName($voiceid, $check_year, $check_month);
        $paytype = $this -> _getPaytype($pay_type);
        $pay_add_time = str_replace('-', '/', $pay_add_time);

        // Include the main TCPDF library (search for installation path).
        require_once('tcpdf/tcpdf.php');

        // create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('ADONADS');
        $pdf->SetTitle('ADONADS INVOICE');
        $pdf->SetSubject('ADONADS INVOICE');
        $pdf->SetKeywords('ADONADS, INVOICE, PDF');

        // remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // ---------------------------------------------------------

        // set font
        $pdf->SetFont('times', '', 15);

        // add a page
        $pdf->AddPage();

        if($username == "renjing@navigation-network.com" 
            || $username == "rj13661327997@gmail.com" 
            || $username == "lizhuo@oasgames.com"){
            // set some html to print
            $payinfohtml = '
            <h1 style="text-align: center;margin-top: 50px;">invoice</h1>
            <div style="text-align: right;text-decoration: underline;padding-right: 30px;">
                Date:
                <span>'.$pay_add_time.'</span>
            </div>
            <div style="margin-bottom: 40px;">
                <div style="font-weight: 700;font-size: 14px;margin-bottom: 20px;">Bill To: </div>
                <div style="font-weight: 700;font-size: 14px;">ADONADS TECHNOLOGY CO., LIMITED </div>';
            }else{
                // set some html to print
                $payinfohtml = '
                <h1 style="text-align: center;margin-top: 50px;">invoice</h1>
                <div style="text-align: right;text-decoration: underline;padding-right: 30px;">
                    Date:
                    <span>'.$pay_add_time.'</span>
                </div>
                <div style="margin-bottom: 40px;">
                    <div style="font-weight: 700;font-size: 14px;margin-bottom: 20px;">Bill To: </div>
                    <div style="font-weight: 700;font-size: 14px;">WUHAN HELLO WORLD NETWORK TECHNOLOGY CO, LTD.</div>';
            }
        
            
            $pdf->SetFont('helvetica','',14);
            // output the HTML content
            $pdf->writeHTML($payinfohtml, true, false, true, false, '');

            if($username == "renjing@navigation-network.com"
            || $username == "rj13661327997@gmail.com" 
            || $username == "lizhuo@oasgames.com"){
                $addresshtml = '<div style="font-weight: 400;font-size: 14px;margin-top: 5px;">Unit 04,7/F Bright Way Tower, No.33 Mong Kok Road, Kowloon, HK </div>';
            }else{
                $addresshtml = '<div style="font-weight: 400;font-size: 14px;margin-top: 5px;">Suite 1302, Block C,Chuangyi Building Guanshan Street, Hongshan District Wuhan, Hubei, China</div>';
            }
            
            $pdf->SetFont('times','',14); 
            // output the HTML content
            $pdf->writeHTML($addresshtml, true, false, true, false, '');

        $paytohtml = '<br><div style="margin-top: 40px;margin-bottom: 40px;font-weight: 700;font-size: 14px;">Pay To:</div>';

            $pdf->SetFont('helvetica','',14);
            // output the HTML content
            $pdf->writeHTML($paytohtml, true, false, true, false, '');

        $payswifthtml = '<br>
        <div style="line-height: 20px;font-size: 14px;font-weight: 500;">SWIFT:
            <span  style="text-decoration: underline;">'.$pay_swift.'</span>
        </div>
        <div style="line-height: 20px;font-size: 14px;font-weight: 500;">Owner:
            <span  style="text-decoration: underline;">'.$pay_owner.'</span>
        </div>
        <div style="line-height:20px;font-size:14px;font-weight: 500;">Company/Personal Address:
            <span  style="text-decoration:underline;">'.$pay_cp_address.'</span>
        </div>
        <div style="line-height: 20px;font-size: 14px;font-weight: 500;">Bank Account Number:
            <span  style="text-decoration: underline;">'.$pay_number.'</span>
        </div>
        <div style="line-height: 20px;font-size: 14px;font-weight: 500;">Bank Name:
            <span  style="text-decoration: underline;">'.$pay_bank.'</span>
        </div>
        <div style="line-height: 20px;font-size: 14px;font-weight: 500;">Bank Address:
            <span style="text-decoration: underline;">'.$pay_address.'</span>
        </div>
    </div>';

    //print wire transfer
    if(!empty($pay_swift) 
        && !empty($pay_owner) 
        //&& !empty($pay_cp_address)
        && !empty($pay_number) 
        && !empty($pay_bank) 
        && !empty($pay_address)){

        $pdf->SetFont('times','',14); 
        // output the HTML content
        $pdf->writeHTML($payswifthtml, true, false, true, false, '');
    }

    $paypalnamehtml = '<span  style="text-decoration: underline;"><u>'.$pay_name.'</u></span>';
    $paypalaccounthtml= '<br><div style="line-height: 20px;font-size: 14px;font-weight: 500;">Account:
            <span  style="text-decoration: underline;">'.$pay_account.'</span>
        </div>
        <div style="line-height: 20px;font-size: 14px;font-weight: 500;">Country:
            <span  style="text-decoration: underline;">'.$pay_cp_address.'</span>
        </div>
    </div>';

    //print paypal
    if(!empty($pay_name)
        //&& !empty($pay_cp_address)
        && !empty($pay_account)){
        $pdf -> SetFont('times','',12);
        $pdf -> ln(5);
        $pdf -> Cell(14, 0, 'Name:', 0, 0, 'L', 0, '', 1);

        $pdf->SetFont('stsongstdlight', '', 14);
        $pdf->writeHTML($paypalnamehtml, true, false, true, false, '');
        $pdf->SetFont('times', '', 14);
        $pdf->writeHTML($paypalaccounthtml, true, false, true, false, '');
    }

    $html = '<table style="width: 80%;border: 1px solid rgb(166,166,166);" cellspacing="0" border="0">
        <tr>
            <th height="24" style="line-height:22px;width: 70%;border-left: 1px solid rgb(166,166,166);border-top: 1px solid rgb(166,166,166);border-right: 1px solid rgb(166,166,166);border-bottom: 1px solid rgb(166,166,166);background-color: rgb(219,228,240);text-align: center;">DESCRIPTION</th>
            <th height="24" style="line-height:22px;width: 30%;border-top: 1px solid rgb(166,166,166);border-right: 1px solid rgb(166,166,166);border-bottom: 1px solid rgb(166,166,166);background-color: rgb(219,228,240);text-align: center;">TOTAL</th>
        </tr>
        <tr>
            <td height="180" style="width: 70%;border-right: 1px solid rgb(166,166,166);vertical-align: top;padding-left: 10px;padding-top: 10px;">Advertising revenue from '.$pay_time_begin.' to '.$pay_time_end.'</td>
            <td height="180" style="width: 30%;">$'.$pay_total.'</td>
        </tr>
    </table>
    <table style="width: 80%;" cellspacing="0" border="0">
        <tr>
            <td style="width: 70%;text-align: right;border-right: 1px solid rgb(166,166,166);font-size: 12px;font-weight: 600;color: rgb(73,119,142);padding-right: 5px;line-height:24px;height: 24px;">TOTAL DUE</td>
            <td style="width: 30%;border-bottom: 1px solid rgb(166,166,166);border-right: 1px solid rgb(166,166,166);height: 24px;line-height:24px;">$'.$pay_total.'</td>
        </tr>
    </table>';
        
        $pdf->ln(5);
        $pdf->SetFont('helvetica', '', 12); 
        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');

        $sign = <<<EOD


Signature:____________________
EOD;
        $pdf->SetFont('helvetica','',12);
        $pdf->Write(0,$sign,'',0,'R',true,0,false,false,0);

        //Close and output PDF document
        if ($ispre) {
            $pdf -> Output($voiceid . '.pdf', 'I');
        } else {
            //Close and output PDF document
            $pdf->Output($voicename, 'F');
        }

        return $voicename;
    }

    private function _getPaytype($paytype) {
        $ret = '';
        switch ($paytype) {
            case 1:
                $ret = 'paypal';
                break;
            case 2:
                $ret = 'wire transfer';
                break;
            case 3:
                $ret = 'wester nunion';
                break;
            case 4:
                $ret = 'alipay';
                break;
        }
        return $ret;
    }

    private function _getInvoiceName($voiceid, $year, $month) {
        $folder = ROOTPATH . '/invoice/' . $year . '/' . $month;
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }
        return $folder . '/' . strtolower($voiceid) . '.pdf';
    }

    private function _genInvoiceId($time) {
        return strtoupper(uniqid()) . "-$time";
    }

}