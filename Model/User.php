<?php

class User extends AppModel {

//  public $belongsTo = array(
//      'Acceptinterview'=>array(
//          'classname'=>'Acceptinterview',
//          'foreignKey'=>'freelancer_id'
//      )
//      );
//        public $belongsTo = array(
//      
//      );

    public $hasMany = array(
        'Acceptinterview' => array(
            'className' => 'Acceptinterview',
            'dependent' => true,
            'foreignKey' => 'freelancer_id'
        ),
        'Client' => array(
            'className' => 'Acceptinterview',
            'dependent' => true,
            'foreignKey' => 'client_id'
        ),
        'Milestone' => array(
            'className' => 'Milestone',
            'dependent' => true,
            'foreignKey' => 'freelancer_id'
        ),
        'Milestone_client' => array(
            'className' => 'Milestone',
            'dependent' => true,
            'foreignKey' => 'client_id'
        ),
         'Job' => array(
            'className' => 'Job',
            'dependent' => true,
            'foreignKey' => 'user_id',
             
        ),
    );
    public $validate = array(
        'first_name' => array(
            'rule' => 'notEmpty',
            'message' => 'Enter Your First Name.'
        ),
        'last_name' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Enter Your Last Name.'
            )),
        'email' => array(
            'email' => array(
                'rule' => array('email'),
                'message' => 'Please enter valid email',
            ),
            'unique' => array(
                'rule' => array('isUnique'),
                'message' => 'Email already exists',
                'on' => 'create',
            ),
        ),
        'country' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Please Select Country.',
                'allowEmpty' => false
            )
        ),
        'username' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Enter Your User Name.'
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'This Username Has Already Been Taken.'
            )),
        'password' => array(
            'notempty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Please enter password',
            ),
        ),
        'reference_from' => array(
            'rule' => 'notEmpty',
            'message' => 'Please Select Reference.'
        ),
        'agree' => array(
            'rule' => 'notEmpty',
            'message' => 'Please Check Terms And Conditions.'
        ),
        'company' => array(
            'rule' => 'notEmpty',
            'message' => 'Enter Your Company Name.'
        ),
        'pro_img' => array(
            'rule' => array('extension', array('jpeg', 'jpg', 'png', 'gif')),
            'required' => false,
            'allowEmpty' => true,
            'message' => 'Choose  Profile Photo. '
        ),
        'email_on_edit' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Please enter email.'
            ),
            'email' => array(
                'rule' => array('email'),
                'message' => 'Please enter the valid email address.'
            ),
            'employer_type'=>array(
                'rule'=>array('notEmpty'),
                'message'=>'Please select the user type'
            )
        ),
    );

}
