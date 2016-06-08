<?php
    class UserDevAppReportDetailModel extends ViewModel {
        public $viewFields = array (
            'userlist' => array('id', 'name'=>'username', 'business_name','email'=>'useremail','address','_type'=>'LEFT'),
            'devlist' => array('id'=>'devlistid','userid','devid','name'=>'appname','email'=>'devemail','address','website','level','_on' => 'devlist.userid = userlist.id','_type'=>'LEFT'),
            'applist' => array('id'=>'applistid','devid','appid','name','img','promoter_title','description','sort','install','size','os_version','status','date' => 'time','_on' => 'devlist.devid = applist.devid'),
            'report_detail' => array('id'=>'report_detailid','appid'=>'reportDetail_appid','imp','clicks','installs','cost','date','_on' => 'applist.appid = report_detail.appid')
        );
    }
?>