<?php

class Feedback extends AppModel {

    var $name = 'Feedback';
    public $validate = array(
        'name' => array(
            'mustNotBeBlank' => array(
                'rule' => 'notEmpty',
                'message' => 'Please Enter your Name !',
            ),
            'special' => array(
                'rule' => '/^[\W  a-zA-Z]+$/',
                'allowEmpty' => false,
                'message' => 'Only letters and special characters  allowed',
            ),
        ),
        'email' => array(
            'rule' => 'email',
            'allowEmpty' => false,
            'message' => 'Please enter your valid  E-mail address !'
        ),
              'comment' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Please enter your Comments  !',
            )
        ),
    );

}

?>
