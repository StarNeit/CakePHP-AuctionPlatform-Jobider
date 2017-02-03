<?php

class Hire Extends AppModel {

    var $name = 'Hire';
    public $belongsTo = array(
        'Contractor' => array(
            'className' => 'User',
            'dependent' => true,
            'foreignKey' => 'contractor_id'
        ),
        'Job' => array(
            'className' => 'Job',
            'dependent' => true,
            'foreignKey' => 'job_id'
        ),
        'Hiring' => array(
            'className' => 'User',
            'dependent' => true,
            'foreignKey' => 'hiring_id'
        )
    );

}

