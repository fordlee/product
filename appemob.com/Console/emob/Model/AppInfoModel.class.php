<?php
    class AppInfoModel extends ViewModel {
        public $viewFields = array (
            'bidlist' => array('id', 'applistid', 'countryid','bid','_type'=>'LEFT'),
            'cpilist' => array('country'=>'bid_country','name','code','cpi','_on' => 'bidlist.countryid = cpilist.id','_type'=>'RIGHT'),
            'applist' => array('devid','appid','name','img','promoter_title','description','sort','country'=>'app_country','install','size','os_version','active_status','status','date','_on' => 'bidlist.applistid = applist.id')
        );
    }
?>