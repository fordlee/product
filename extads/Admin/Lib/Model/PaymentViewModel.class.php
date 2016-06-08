<?php

    class PaymentViewModel extends ViewModel {

        public $viewFields = array(
            'payment'=>array('id', 'uid', 'paycount', 'status', 'addtime', 'checktime', 'checkuser', 'paytime', 'paytype', 'name', 'account', 'swift', 'owner', 'number', 'bank', 'address', 'cp_address', 'tel', 'invoice','upinvoice', 'note'),
            'user'=>array('username','checkcycle','usertype', 'isactive', '_on'=>'payment.uid=user.uid')
        );
    }