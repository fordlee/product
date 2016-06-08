<?php

/*function sendSingupSuccessEmail($email,$business_name,$token){
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
	    $emailbody = "亲爱的".$business_name."：<br/>感谢您在我站注册了新帐号。<br/>请点击链接激活您的帐号。<br/><a href='http://localhost:9888/index.php/Index/active?verify=".$token."' target='_blank'>http://localhost:9888/app.php/Index/active?verify=".$token."</a><br/>如果以上链接无法点击，请将它复制到你的浏览器地址栏中进入访问，该链接24小时内有效。<br/>如果此次激活请求非你本人所发，请忽略本邮件。<br/><p style='text-align:right'>-------- Hellwd.com 敬上</p>";
	    $rs = $smtp->sendmail($smtpemailto, $smtpemailfrom, $emailsubject, $emailbody, $emailtype);
		if($rs==1){
			$msg = '恭喜您，注册成功！<br/>请登录到您的邮箱及时激活您的帐号！';	
		}else{
			$msg = $rs;	
		}
		//echo $msg;
	}*/

	function sendSingupSuccessEmail($email,$business_name,$token){
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
	    $emailsubject = "Congratulations!";
	    $emailbody = "Dear ".$business_name."：<br/>
	    			Congratulations! You Have Successfully Registered With appemob.com! Our team will appoint a dedicated publisher manager to you soon.<br/>
	    			You can know more about us in our website: <a href='http://www.appemob.com/' target='_blank'>http://www.appemob.com/</a><br/>
	    			If you have any questions, you can send email to: support@appemob.com<br/>
	    			This is an automated email from appemob. Do not reply this email. Please ignore this email if you did not get registered by your own. <br/>
	    			<p style='text-align:right'>Thank you for support!<br/>Best regards,<br/>Appemob Support Team!</p>";
	    $rs = $smtp->sendmail($smtpemailto, $smtpemailfrom, $emailsubject, $emailbody, $emailtype);
		if($rs==1){
			$msg = 'Congratulations, you successfully registered! <br/> log in to your mailbox promptly activate your account!';
		}else{
			$msg = $rs;	
		}

		//return $msg;
		echo $msg;
	}

?>