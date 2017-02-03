<?php

class Job extends AppModel {   
 var $hasMany=array(
        'Contect'=>array(
            'className' => 'Contect',
            'dependent' => true,
            'foreignKey'=>'job_id',
         ),
      'Acceptinterview'=>array(
            'className' => 'Acceptinterview',
            'dependent' => true,
            'foreignKey'=>'job_id',
         ),
      'Milestone'=>array(
            'className' => 'Milestone',
            'dependent' => true,
            'foreignKey'=>'job_id',
         ),
     'Hire'=>array(
         'className'=>'Hire',
         'dependent'=>true,
         'forignKey'=>'job_id'
     ),
//     'User'=>array(
//            'className' => 'User',
//            'dependent' => true,
//            'foriegn key'=>'user_id',
//         ),
     
        );
  public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'dependent' => true,
            'foreignKey' => 'user_id'
        ),
       
    );


    public $validate = array(
        'category_id' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Please Select The Category',
                'allowEmpty' => false
            )
        ),
        'job_title' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Please Enter The Job Title'
            )
        ),
        'subcategory_id' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Please Select The Sub Category'
            )
        ),
        'budget' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Please Enter the Budget',
            )
        ),
        'start_date' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Please Enter The Date'
            )
        ),
        'duration' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Please Select The Duration Time'
            )
        ),
        'description' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Please Enter The Description '
            )
        ),
        'image_name' => array(
            'rule' => array('notEmpty'),
            //'rule' => array('extension', array('pdf', 'doc', 'txt', 'mp3')),
            'required' => false,
             'on'=>'create',
            'message' => 'Please choose the correct document  file. '
        ),
        'skills' => array(
            'rule' => array('notEmpty'),
            'required' => false,
            'allowEmpty' => true,
            'message' => 'Please Enter The Skills. '
        )
    );

}

?>
