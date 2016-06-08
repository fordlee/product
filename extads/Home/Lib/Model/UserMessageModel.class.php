<?php
    class UserMessageModel extends ViewModel {
        public $viewFields = array (
            'usermsg' => array('id', 'uid', 'mid', 'isread', 'readtime'),
            'msg' => array('title', 'type', 'addtime', 'isactive', '_on' => 'usermsg.mid = msg.id')
        );
    }
?>