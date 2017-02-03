<?php

class Projectfeedback Extends AppModel {

    var $name = 'Projectfeedback';
    var $belongsTo = array(
        'Client' => array(
            'className' => 'User',
            'dependent' => true,
            'foreignKey' => 'client_id'
        ),
        'Freelancer' => array(
            'className' => 'User',
            'dependent' => true,
            'foreignKey' => 'freelancer_id'
        ),
        'Job' => array(
            'className' => 'Job',
            'dependent' => true,
            'foreignKey' => 'job_id'
        )
    );
    
    
      public $validate = array(
        'score' => array(
            'rule' => 'notempty',
            'message' => 'Score Field is required !'
        ),
        'feedback' => array(
            'rule' => 'notempty',
            'message' => 'Feedback Field is required !'
        ),
     
    );
    
    

}