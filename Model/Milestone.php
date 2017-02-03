<?php

class Milestone extends AppModel {

    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'dependent' => true,
            'foreignKey' => 'freelancer_id',
        ),
        'Job' => array(
            'className' => 'Job',
            'dependent' => true,
            'foreignKey' => 'job_id'
        )
    );

}

