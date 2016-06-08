<?php
class TestAction extends Action {

	/**本类仅供测试使用*/
	
	//插入country
    public function countrytest(){
        $item = file_get_contents(APP_PATH.'Conf/level/country.json');
        $arr = json_decode($item,true);
        var_dump($arr);
        $m = M('cpilist');
        foreach ($arr as $k => $v) {
            $m -> add($v);
        }
    }

}