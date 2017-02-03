<?php

class Paypalpayment Extends AppModel {

    var $name = 'Paypalpayment';
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

}

?>
