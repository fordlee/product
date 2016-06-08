<?php
    class UserMessageModel extends ViewModel {
        public $viewFields = array (
            'message_status' => array('id', 'message_id', 'user_id', 'isread', 'readtime'),
            'message' => array('title','message','to_userid','isactive','type','addtime','_on' => 'message_status.message_id = message.id')
        );
    }
?>