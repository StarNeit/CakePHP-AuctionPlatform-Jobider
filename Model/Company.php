<?php

class Company extends AppModel {

    public $validate = array(
        'first_name' => array(
            'rule' => 'notEmpty',
            //'required' => true,
            'message' => 'Add your First Name.'
        ), 
         'last_name' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Add your Last name.'
            )),
        'email' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                //  'required' => true,
                'message' => 'Add your Email id.'
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'This Email Id already Exists'
            )
            , 'email' => array(
                'rule' => array(
                    'email', true
                ), 'message' => 'Enter a Valid Email address'
            )
        ),
//          'country' => array(
//            'rule' => 'notEmpty',
//            'message' => 'Add your Country.'
//        ),
//         'username' => array(
//            'notEmpty' => array(
//                'rule' => 'notEmpty',
//                //  'required' => true,
//                'message' => 'Please enter username.'
//            ),
//             'unique' => array(
//                'rule' => 'isUnique',
//                'message' => 'This username has already been taken.'
//            )),
         'password' => array(
            'rule' => 'notEmpty',
            //     'required' => true,
            'message' => 'Please enter your password.'
        ),
//          'reference_from' => array(
//            'rule' => 'notEmpty',
//            //     'required' => true,
//            'message' => 'Please Select Reference.'
//        ),
          'agree' => array(
            'rule' => 'notEmpty',
            //     'required' => true,
            'message' => 'Please Check terms and conditions.'
        ),
         'company' => array(
            'rule' => 'notEmpty',
            //     'required' => true,
            'message' => 'Please enter your Company Name.'
        ),
        );
}