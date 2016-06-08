<?php
	function show_dialog($string){
		echo '<script type="text/javascript">window.alert("'.$string.'");</script>';
	}

	function page(){
	    
	}

	/*function sendSingupSuccessEmail($email,$fullname,$token){
		import('ORG.Util.smtp');//导入本类
		$smtpserver = "smtp.126.com"; //SMTP服务器
	    $smtpserverport = 25; //SMTP服务器端口
	    $smtpusermail = "huli_yangthze@126.com"; //SMTP服务器的用户邮箱
	    $smtpuser = "huli_yangthze@126.com"; //SMTP服务器的用户帐号
	    $smtppass = "8872240hl"; //SMTP服务器的用户密码
	    $smtp = new Smtp($smtpserver, $smtpserverport, true, $smtpuser, $smtppass); //这里面的一个true是表示使用身份验证,否则不使用身份验证.
	    $emailtype = "HTML"; //信件类型，文本:text；网页：HTML
	    $smtpemailto = $email;
	    $smtpemailfrom = $smtpusermail;
	    $emailsubject = "用户帐号激活";
	    $emailbody = "亲爱的".$fullname."：<br/>感谢您在我站注册了新帐号。<br/>请点击链接激活您的帐号。<br/><a href='http://localhost:9888/console.php/Auth/activeUser?verify=".$token."' target='_blank'>http://localhost:9888/console.php/Auth/activeUser?verify=".$token."</a><br/>如果以上链接无法点击，请将它复制到你的浏览器地址栏中进入访问，该链接24小时内有效。<br/>如果此次激活请求非你本人所发，请忽略本邮件。<br/><p style='text-align:right'>-------- Hellwd.com 敬上</p>";
	    $rs = $smtp->sendmail($smtpemailto, $smtpemailfrom, $emailsubject, $emailbody, $emailtype);
		if($rs==1){
			$msg = '恭喜您，注册成功！<br/>请登录到您的邮箱及时激活您的帐号！';	
		}else{
			$msg = $rs;	
		}
		//echo $msg;
	}*/

	function sendSingupSuccessEmail($email,$fullname,$token){
		import('ORG.Util.smtp');//导入本类
		$smtpserver = "mail.appemob.com"; //SMTP服务器
	    $smtpserverport = 25; //SMTP服务器端口
	    $smtpusermail = "do-not-reply@appemob.com"; //SMTP服务器的用户邮箱
	    $smtpuser = "do-not-reply@appemob.com"; //SMTP服务器的用户帐号
	    $smtppass = "weekmovie2013"; //SMTP服务器的用户密码
	    $smtp = new Smtp($smtpserver, $smtpserverport, true, $smtpuser, $smtppass); //这里面的一个true是表示使用身份验证,否则不使用身份验证.
	    $emailtype = "HTML"; //信件类型，文本:text；网页：HTML
	    $smtpemailto = $email;
	    $smtpemailfrom = $smtpusermail;
	    $emailsubject = "User Account Activation";
	    $emailbody = "Dear ".$fullname."：<br/>Thank you for registering a new account at my station.<br/>Please click on the link to activate your account.<br/><a href='".C('MAIL_DOMAIN')."/console.php/Auth/activeUser?verify=".$token."' target='_blank'>".C('MAIL_DOMAIN')."/console.php/Auth/activeUser?verify=".$token."</a><br/>If the above link is not clickable, copy it into your browser address bar enter access, within the link valid for 24 hours.<br/>If the activation request is issued by a non-yourself, please ignore this message.<br/><p style='text-align:right'>-------- Hellwd.com yours truly</p>";
	    $rs = $smtp->sendmail($smtpemailto, $smtpemailfrom, $emailsubject, $emailbody, $emailtype);
		if($rs==1){
			$msg = 'Congratulations, you successfully registered! <br/> log in to your mailbox promptly activate your account!';	
		}else{
			$msg = $rs;	
		}
		//echo $msg;
	}

	/*function sendAppbrainSuccessEmail($email,$appname,$token,$userid){
		import('ORG.Util.smtp');//导入本类
		$smtpserver = "smtp.126.com"; //SMTP服务器
	    $smtpserverport = 25; //SMTP服务器端口
	    $smtpusermail = "huli_yangthze@126.com"; //SMTP服务器的用户邮箱
	    $smtpuser = "huli_yangthze@126.com"; //SMTP服务器的用户帐号
	    $smtppass = "8872240hl"; //SMTP服务器的用户密码
	    $smtp = new Smtp($smtpserver, $smtpserverport, true, $smtpuser, $smtppass); //这里面的一个true是表示使用身份验证,否则不使用身份验证.
	    $emailtype = "HTML"; //信件类型，文本:text；网页：HTML
	    $smtpemailto = $email;
	    $smtpemailfrom = $smtpusermail;
	    $emailsubject = "开发帐号激活";
	    $emailbody = "亲爱的".$appname."：<br/>感谢您在我站添加了开发帐号。<br/>请点击链接激活您的帐号。<br/><a href='http://localhost:9888/console.php/Auth/activeDev?verify=".$token."&id=".$userid."' target='_blank'>http://localhost:9888/console.php/Auth/activeDev?verify=".$token."&id=".$userid."</a><br/>如果以上链接无法点击，请将它复制到你的浏览器地址栏中进入访问，该链接24小时内有效。<br/>如果此次激活请求非你本人所发，请忽略本邮件。<br/><p style='text-align:right'>-------- Hellwd.com 敬上</p>";
	    $rs = $smtp->sendmail($smtpemailto, $smtpemailfrom, $emailsubject, $emailbody, $emailtype);
	}*/

	function sendAppbrainSuccessEmail($email,$appname,$token,$userid){
		import('ORG.Util.smtp');//导入本类
		$smtpserver = "mail.appemob.com"; //SMTP服务器
	    $smtpserverport = 25; //SMTP服务器端口
	    $smtpusermail = "do-not-reply@appemob.com"; //SMTP服务器的用户邮箱
	    $smtpuser = "do-not-reply@appemob.com"; //SMTP服务器的用户帐号
	    $smtppass = "weekmovie2013"; //SMTP服务器的用户密码
	    $smtp = new Smtp($smtpserver, $smtpserverport, true, $smtpuser, $smtppass); //这里面的一个true是表示使用身份验证,否则不使用身份验证.
	    $emailtype = "HTML"; //信件类型，文本:text；网页：HTML
	    $smtpemailto = $email;
	    $smtpemailfrom = $smtpusermail;
	    $emailsubject = "Development Account Activation";
	    $emailbody = "Dear ".$appname."：<br/>I appreciate your stand to add a development account.<br/>Please click on the link to activate your account.<br/><a href='".C('MAIL_DOMAIN')."/console.php/Auth/activeDev?verify=".$token."&id=".$userid."' target='_blank'>".C('MAIL_DOMAIN')."/console.php/Auth/activeDev?verify=".$token."&id=".$userid."</a><br/>If the above link is not clickable, copy it into your browser address bar enter access, within the link valid for 24 hours.<br/>If the activation request is issued by a non-yourself, please ignore this message.<br/><p style='text-align:right'>-------- Hellwd.com yours truly</p>";
	    $rs = $smtp->sendmail($smtpemailto, $smtpemailfrom, $emailsubject, $emailbody, $emailtype);
	}

    function getCountry(){
        $m = M('cpilist');
        $countries = $m -> field('country') -> select();
        return $countries;
    }

    function getLanguage(){
    	$languages = array(
    		"af"=>"Afrikaans",
			"sq"=>"Albanian",
			"am"=>"Amharic",
			"ar"=>"Arabic",
			"hy"=>"Armenian",
			"az"=>"Azerbaijani",
			"eu"=>"Basque",
			"be"=>"Belarusian",
			"bn"=>"Bengali",
			"bs"=>"Bosnian",
			"bg"=>"Bulgarian",
			"ca"=>"Catalan",
			"ceb"=>"Cebuano",
			"ny"=>"Chichewa",
			"zh-CN"=>"Chinese (Simplified)",
			"zh-TW"=>"Chinese (Traditional)",
			"co"=>"Corsican",
			"hr"=>"Croatian",
			"cs"=>"Czech",
			"da"=>"Danish",
			"nl"=>"Dutch",
			"en"=>"English",
			"eo"=>"Esperanto",
			"et"=>"Estonian",
			"tl"=>"Filipino",
			"fi"=>"Finnish",
			"fr"=>"French",
			"fy"=>"Frisian",
			"gl"=>"Galician",
			"ka"=>"Georgian",
			"de"=>"German",
			"el"=>"Greek",
			"gu"=>"Gujarati",
			"ht"=>"Haitian Creole",
			"ha"=>"Hausa",
			"haw"=>"Hawaiian",
			"iw"=>"Hebrew",
			"hi"=>"Hindi",
			"hmn"=>"Hmong",
			"hu"=>"Hungarian",
			"is"=>"Icelandic",
			"ig"=>"Igbo",
			"id"=>"Indonesian",
			"ga"=>"Irish",
			"it"=>"Italian",
			"ja"=>"Japanese",
			"jw"=>"Javanese",
			"kn"=>"Kannada",
			"kk"=>"Kazakh",
			"km"=>"Khmer",
			"ko"=>"Korean",
			"ku"=>"Kurdish (Kurmanji)",
			"ky"=>"Kyrgyz",
			"lo"=>"Lao",
			"la"=>"Latin",
			"lv"=>"Latvian",
			"lt"=>"Lithuanian",
			"lb"=>"Luxembourgish",
			"mk"=>"Macedonian",
			"mg"=>"Malagasy",
			"ms"=>"Malay",
			"ml"=>"Malayalam",
			"mt"=>"Maltese",
			"mi"=>"Maori",
			"mr"=>"Marathi",
			"mn"=>"Mongolian",
			"my"=>"Myanmar (Burmese)",
			"ne"=>"Nepali",
			"no"=>"Norwegian",
			"ps"=>"Pashto",
			"fa"=>"Persian",
			"pl"=>"Polish",
			"pt"=>"Portuguese",
			"pa"=>"Punjabi",
			"ro"=>"Romanian",
			"ru"=>"Russian",
			"sm"=>"Samoan",
			"gd"=>"Scots Gaelic",
			"sr"=>"Serbian",
			"st"=>"Sesotho",
			"sn"=>"Shona",
			"sd"=>"Sindhi",
			"si"=>"Sinhala",
			"sk"=>"Slovak",
			"sl"=>"Slovenian",
			"so"=>"Somali",
			"es"=>"Spanish",
			"su"=>"Sundanese",
			"sw"=>"Swahili",
			"sv"=>"Swedish",
			"tg"=>"Tajik",
			"ta"=>"Tamil",
			"te"=>"Telugu",
			"th"=>"Thai",
			"tr"=>"Turkish",
			"uk"=>"Ukrainian",
			"ur"=>"Urdu",
			"uz"=>"Uzbek",
			"vi"=>"Vietnamese",
			"cy"=>"Welsh",
			"xh"=>"Xhosa",
			"yi"=>"Yiddish",
			"yo"=>"Yoruba",
			"zu"=>"Zulu"
		);
		return $languages;
    }


	



?>