<?php
    header('Content-Type: text/javascript; charset=utf-8');
    $cb = 'ext335cb';
    if (isset($_GET['cb'])) {
        $cb = $_GET['cb'];
    }
    if (isset($_GET['uid'])) {
        $uid = $_GET['uid'];
        $link = @mysqli_connect("mysql.adonads.com","thehotgames","weekmovie2013","adonads");
        //$link = @mysqli_connect("localhost","root","admin","extads");
        if(!$link){
            die($cb . '({"err": "1"});');
        } else {
            $query = "SELECT `o_cid`,`t` FROM `channel` where `cid` in (SELECT `cid` from `userchannel` WHERE `uid`= ? )";
            $stmt = $link -> prepare($query);
            $stmt->bind_param('s', $uid);
            $stmt -> execute();
            $result = $stmt->get_result();
            $ucs = array();
            while($row = $result->fetch_assoc()) {
                $type = $row["t"];
                if ($type == 'propeller') {
                    $ucs['p'] = $row["o_cid"];
                } else if ($type == 'adcash') {
                    $ucs['a'] = $row["o_cid"];
                } else if ($type == 'advertise') {
                    $ucs['d'] = $row["o_cid"];
                } else if ($type == 'superfish') {
                    $ucs['s'] = $row["o_cid"];
                }
            }
            $ret = $cb . '(';
            $ret = $ret . json_encode($ucs) . ');';
            echo $ret;
        }
    } else {
        die($cb . '({"err": "2"});');
    }
?>