<?php

class Creditpayment Extends AppModel {

    var $name = 'Creditpayment';
    public $belongsTo = array(
        'Freelancer' => array(
            'className' => 'User',
            'dependent' => true,
            'foreignKey' => 'freelancer_id'
        ),
        'Client' => array(
            'className' => 'User',
            'dependent' => true,
            'foreignKey' => 'client_id'
        ),
        'Job' => array(
            'className' => 'Job',
            'dependent' => true,
            'foreignKey' => 'job_id'
        )
    );
    
    public $validate=array(
        'card_type'=>array(
            'notempty'=>array(
                'rule'=>array('notempty'),
                'message'=>'Please Select The Card Type',
            )
        ),
        'card_number'=>array(
            'notempty'=>array(
                'rule'=>array('notempty'),
                'message'=>'Please Enter Card Number',
            )
        ),
        'cvv'=>array(
            'notempty'=>array(
                'rule'=>array('notempty'),
                'message'=>'Please Enter Cvv Number'
            )
        ),
        'start_date'=>array(
            'notempty'=>array(
                'rule'=>array('notempty'),
                'message'=>'Please Select Start Date',
            )
        ),
        'end_date'=>array(
            'notempty'=>array(
                'rule'=>array('notempty'),
                'message'=>'Please Select End Date'
            )
        )
    );

}

?>
