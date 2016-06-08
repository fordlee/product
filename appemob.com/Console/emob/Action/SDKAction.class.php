<?php
// 本类由系统自动生成，仅供测试用途
class SDKAction extends Action {
  //构造函数，验证Session
    public function __construct() {
        parent::__construct(); //一定要注意这一行，这一行是为了执行父类中的构造函数，否则运行是会出错的
        $this->CheckmSession(); 
    }

    private function CheckmSession(){
        if(!isset($_SESSION['login']) && $_SESSION['login'] !== true){
            $this -> error('Sorry! You have not logged or login timeout, please sign in again!',U('Auth/login'));
        }
    }

    public function setsdk(){
        $m = D('UserDevApp');
        $where = array(
            'id' => $_SESSION['id'],
            'status' => 1
        );

        $item = $m -> field('applistid,appid,name,img,active_status') -> where($where) -> select();
        //var_dump($item);die();
        $this -> assign('item',$item);
        $this -> display();
    }

    public function setad(){

        if(isset($_POST['applistid']) && isset($_POST['ad_control'])){
            $id = $_POST['applistid'];
            $adsets = $_POST['ad_control'];
            $arr1 = json_decode($adsets,true);
            
            $m_a = M('applist');
            $ads = $m_a -> where('id='.$id) -> getField('ad_control');
            $arr2 = json_decode($ads,true);
            foreach ($arr1 as $k => $v) {
                if ($k == 'a') {
                    $arr2['a'] = $v;
                }else if ($k == 'b') {
                    $arr2['b'] = $v;
                }else if ($k == 'c') {
                    $arr2['c'] = $v;
                }
            }
            
            $ad_control = json_encode($arr2);
            $data['ad_control'] = $ad_control;
            $ret = $m_a -> where('id='.$id) -> save($data);
            if($ret > 0 ){
                echo 1;
            }
        }else{
            $id = $_GET['id'];
            $m_a = M('applist');
            $ret = $m_a -> where('id='.$id) -> getField('ad_control');
            $adset = json_decode($ret,true);
            $adtype = C('AD_CONTROL_TYPE');
            $item = array();
            foreach ($adtype as $k => $v) {
                if($adset[$k] == true){
                    $item[$k] = array('adtype' => $v,'adset' => true);
                }else{
                    $item[$k] = array('adtype' => $v,'adset' => false);
                }
            }
            $this -> assign('item',$item);
            $this -> assign('applistid',$id);
            
            $this -> display();
        }
    }

}