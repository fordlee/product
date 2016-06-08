<?php
    class UserDevAppInstallDetailLeadModel extends ViewModel {
        public $viewFields = array (
            'userlist' => array('id', 'name'=>'username', 'business_name','email'=>'useremail','address','_type'=>'LEFT'),
            'devlist' => array('id'=>'devlistid','userid','devid','name'=>'appname','email'=>'devemail','address','website','level','_on' => 'devlist.userid = userlist.id','_type'=>'LEFT'),
            'applist' => array('id'=>'applistid','devid','appid','name','img','promoter_title','description','sort','install','size','os_version','active_status','status','date' => 'time','_on' => 'devlist.devid = applist.devid'),
            'install_detail' => array('id'=>'install_detailid','lead_appid','appid'=>'load_appid','cost','date','_on' => 'applist.appid = install_detail.lead_appid')
        );
    }
?>