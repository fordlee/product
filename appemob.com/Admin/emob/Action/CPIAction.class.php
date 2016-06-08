<?php
class CPIAction extends Action {

	public function __construct() {
        parent::__construct(); //一定要注意这一行，这一行是为了执行父类中的构造函数，否则运行是会出错的
        $this->CheckmSession(); 
    }
    
    private function CheckmSession(){
        if(isset($_SESSION['admin_login']) && $_SESSION['admin_login'] == true){
    		
    		$level = $_SESSION['level'];
    		$item = file_get_contents(APP_PATH.'Conf/level/'.$level.'.json');
    		$levelArr = json_decode($item,true);
    		if(!in_array(ACTION_NAME, $levelArr)){
    			//die('permissin deny!');
    		} 		
        }else{
        	$url=str_replace('.html', '', U('Auth/login'));
        	$this->error('当前用户未登录或登录超时，请重新登录',$url);
        }
    }

    public function showCPI(){
        $m = M('cpilist');
        $ret = $m -> order('cpi desc') -> field('cpi') -> group('cpi') -> select();

        foreach ($ret as $k => $v) {
            if($v['cpi'] != 0 && $v['cpi'] != null){
                $item[] = $m -> where('cpi='.$v['cpi']) -> select();
            }
        }
        
        $this -> assign('item',$item);
        $this -> display();
    }

    public function setCPI(){
        $ncpi = $_POST['ncpi'];
        $ocpi = $_POST['ocpi'];

        if(isset($_POST['ncpi']) && !empty($_POST['ncpi']) && $ncpi !== $ocpi){
            $data = array(
                "cpi" => $ncpi
            );
            $m = M('cpilist');
            $ret = $m -> where('cpi='.$ocpi) -> save($data);
            if($ret > 0){
                $this -> success('CPI修改成功！','showCPI');
            }
        }else{
            $this -> error('CPI修改失败！','showCPI');
        }
    }

    public function addCPIGroup(){
        $cpi = $_POST['cpi'];
        $country =$_POST['country'];
        $m = M('cpilist');

        if(isset($_POST['cpi']) && !empty($_POST['cpi'])){
            foreach ($country as $k => $v) { 
                $m -> where('id='.$v) -> save(array("cpi"=> $cpi));
            }
            $this ->success('添加成功！','showCPI');
        }else{
            $ret = $m -> field('id,name') -> where('cpi=0') -> select();
            $this -> assign('countries',$ret);
            $this -> display();
        }
        
    }

    public function addCountry(){
        $cpi = $_GET['ocpi'];
        $m = M('cpilist');

        if(isset($_GET['ocpi']) && !empty($_GET['ocpi'])){
            $ret = $m -> field('id,name,cpi') -> select();
            $this -> assign('countries',$ret);
            $this -> assign('check',$cpi);
            $this -> display();
        }else{
            $cpi = $_POST['cpi'];
            $country =$_POST['country'];
            foreach ($country as $k => $v) { 
                $m -> where('id='.$v) -> save(array("cpi"=> $cpi));
            }
            $this ->success('添加成功！','showCPI');
        }
        
        
    }

    public function delCountry(){
        $id = $_GET['id'];

        $data = array(
            "cpi" => 0
        );
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $m = M('cpilist');
            $ret = $m -> where('id='.$id) -> save($data);
            if($ret > 0){
                $this -> redirect('showCPI');
            }
        }else{
            $this -> error('移出国家失败！','showCPI');
        }       
    }


}
?>