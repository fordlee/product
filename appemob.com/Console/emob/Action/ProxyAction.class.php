<?php
class ProxyAction extends Action{
	public function __construct() {
        parent::__construct(); //一定要注意这一行，这一行是为了执行父类中的构造函数，否则运行是会出错的
        $this->CheckmSession();
    }

    private function CheckmSession(){
        if(!isset($_SESSION['login']) && $_SESSION['login'] !== true){
        	$this -> error('Sorry! You have not logged or login timeout, please sign in again!',U('Auth/login'));
        }
    }
	
	public function appbrain(){
		//通过输入Appname搜索
		/*$appname = strval($_POST['appname']);
        $appid = $this -> appsearch($appname);
        echo $appid;die();
        if($appid===false){
        	$this -> redirect('App/manage',array('cate_id' => 2),1,'Sorry!Can not find it!Please check it!');
        }*/

        $appid = strval($_POST['appname']);
        //检查输入是否为空
        if(empty($_POST['appname'])){
        	echo 3;die();
        }
        //检查是否appid是否存在，防止重复添加
        $m_at = M('applisttemp');
		$ret = $m_at -> where("appid='$appid'") -> find();

		$m_a = M('applist');
		$app = $m_a -> where("appid='$appid'") -> find();
		
		if($ret !== NULL or $app !== NULL){
			echo 0;die();
		}
		
		//开始抓取页面
        $gp_url = 'https://play.google.com/store/apps/details';
		$data = array(
		        'id' => $appid,
		        'hl' => 'en'
		);

		$html = $this -> curl_use_get($gp_url, $data);
		//$html=file_get_contents('data.txt');

		preg_match('/<div class="id-app-title" tabindex="0">(.*?)<\/div>/i',$html,$title);
		$name = $title[1];
		$item['promoter_title'] = '[{"active": "1","language": "en","title": "'.addslashes($title[1]).'","subtitle": ""}]';

		preg_match('/<img class="cover-image" src="(.*?)" alt="Cover art" aria-hidden="true" itemprop="image">/i',$html,$img);
		$imgs = explode('/',$img[1]);
		$item['img'] = preg_replace("/w30.*?$/i", "", $imgs[count($imgs)-1]);

		preg_match('/<div jsname="C4s9Ed">(.*?)<\/div>/i',$html,$description);
		$item['description'] = addslashes(strip_tags($description[1]));

		preg_match('/<div class="score" aria-label="(.*?)">(.*?)<\/div>/i',$html,$rate);
		$item['rate'] = $rate[2];

		preg_match('/<span itemprop="genre">(.*?)<\/span>/i',$html,$sort);
		$item['sort'] = $sort[1];

		preg_match('/<a class="document-subtitle primary" href="\/store\/apps\/dev\?id=(.*?)"> <span itemprop="name">(.*?)<\/span> <\/a>/i',$html,$devids);
		if($devids==NULL){
			preg_match('/<a class="document-subtitle primary" href="\/store\/apps\/developer\?id=(.*?)"> <span itemprop="name">(.*?)<\/span> <\/a>/i',$html,$devids);
		}
		
		$item['devid'] = $devids[1];
		$dev['devid'] = $devids[1];
		$dev['name'] = $devids[2];
		$devid = $devids[1];

		preg_match('/<div class="content" itemprop="fileSize">(.*?)<\/div>/i',$html,$size);		
		$item['size'] = trim($size[1]);

		preg_match('/<div class="content" itemprop="numDownloads">(.*?)<\/div>/i',$html,$install);		
		$item['install'] = trim($install[1]);

		preg_match('/<div class="content" itemprop="operatingSystems">(.*?)<\/div>/i',$html,$os_version);		
		$item['os_version'] = trim($os_version[1]);

		preg_match('/<span class="badge-title">(.*?)<\/span>/i',$html,$level);		
		if($level[1] == 'Top Developer'){
			$dev['level'] = 1;
		}else{
			$dev['level'] = 2;
		}
		

		preg_match('/<a class="dev-link" href="https:\/\/www.google.com\/url\?q=(.*?)" rel="nofollow" target="_blank">(.*?)<\/a>/i',$html,$websites);
		$website_array = explode('&amp', $websites[1]);
		$dev['website'] = $website_array[0];

		preg_match('/<a class="dev-link" href="mailto:(.*?)" rel="nofollow" target="_blank">(.*?)<\/a>/i', $html, $email);		
		$dev['email'] = $email[1];

		preg_match('/<div class="content physical-address">([.\s\S]*?)<\/div>/im', $html, $address);		
		$dev['address'] = $address[1];

		$item['appid'] = $appid;
		$item['name'] = $name;
		$item['date'] = date('Y-m-d H:i:s');
		
		$reta = $this -> insertApp($devid,$item);
		$retd = $this -> insertDev($devid,$dev);
		
		if($reta !== false && $retd !== false){
			echo 1;	
		}else{
			echo 3;
		}
		
    }

    private function insertApp($devid,$item){	
		$m_d = M('devlist');
		$devlist = $m_d -> where(array("devid" => $devid)) -> find();

		if($devlist['status'] == 1){
			$item['status'] = 1;
			$m_a = M('applist');			
			$reta = $m_a -> add($item);
		}else{
			$m_at = M('applisttemp');
			$reta = $m_at -> add($item);
		}

		return $reta;
    }

    private function insertDev($devid,$dev){
    	$m_d = M('devlist');
    	$ret = $m_d -> where(array("devid" => $devid)) -> find();
    	if($ret == NULL){
    		$dev['userid'] = $_SESSION['id'];
    		$dev['date'] = date('Y-m-d H:i:s');
    		$retd = $m_d -> add($dev);
    	}else{
    		$retd = true;
    	}

    	return $retd;
    }

    private function appsearch($appname){
		$url = 'https://play.google.com/store/search';
		$data = array(
			'q' => $appname,
			'c' => 'apps',
			'hl' => 'en'
		);
		$ret = $this -> curl_use_get($url,$data);
		
		preg_match('/<a class="title" href="\/store\/apps\/details\?id=(.*?)" title="(.*?)" aria-hidden="true" tabindex="-1">(.*?)<span class="paragraph-end"><\/span> <\/a>/i',$ret,$appids);
		$appname_rule = strval('/'.$appname.'/i');
		/*echo $appname_rule;
		var_dump($appids);*/
		$rule1 = preg_match($appname_rule, $appids[1]);
		$rule2 = preg_match($appname_rule, $appids[2]);
		if($rule1 or $rule2){
			return $appids[1];
		}else{
			return false;
		}
	}

    private function curl_use_get($url, $data){
	    if(empty($url) OR empty($data)){
	        return 'Data cannot be empty!';
	    }
	 
	    $fields_string = '';
	    foreach($data as $key=>$value){
	        $fields_string[]=$key.'='.urlencode($value);
	    }
	    $urlStringData = $url.'?'.implode('&amp;',$fields_string);
	    
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,30);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查 
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, true); // 从证书中检查SSL加密算法是否存在
	    curl_setopt($ch, CURLOPT_URL, $urlStringData );
	    $ret = curl_exec($ch);
	    curl_close($ch);
	    return $ret;
	}


}


?>