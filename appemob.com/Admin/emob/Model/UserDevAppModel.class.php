<?php
    class UserDevAppModel extends ViewModel {
        public $viewFields = array (
            'userlist' => array('id'=>'userlistid', 'name'=>'username', 'business_name','email'=>'useremail','address','_type'=>'RIGHT'),
            'devlist' => array('id'=>'devlistid','userid','devid','name'=>'appname','email'=>'devemail','address','website','level','status'=>'devstatus','_on' => 'devlist.userid = userlist.id','_type'=>'LEFT'),
            'applist' => array('id'=>'applistid','devid','appid','name','img','promoter_title','description','sort','install','size','os_version','status'=>'appstatus','date'=>'time','_on' => 'devlist.devid = applist.devid')
        );
    }
?>