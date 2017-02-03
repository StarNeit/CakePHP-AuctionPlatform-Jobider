<?php

class Jobdetail extends AppModel {

    public $belongsTo = array(
        'Job' => array(
            'counterCache' => true,
            'dependent' => true,
            'foriegn key' => 'job_id'
        ),
        'User' => array(
            'className' => 'User',
            'dependent' => true,
            'foreignKey' => 'freelancer_id'
        ),);
    public $validate = array(
        'porpose_terms' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Please Enter The Porpose Terms'
            )
        ),
        'upfront_payment' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Please Enter The Upfront Payment'
            )
        ),
        'duration' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Please Select The Duration',
                'allowEmpty' => false
            )
        ),
        'cover_letter' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Please Enter The Cover Letters'
            )
        ),
        'additional_question' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Please Enter The Additional Questions '
            )
        )
    );

}

?>
