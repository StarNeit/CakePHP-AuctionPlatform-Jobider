<?php

class Media extends AppModel {

    var $name = 'Media';
    public $useTable = 'medias';
    public $validate = array(
        'title' => array(
            'mustNotBeBlank' => array(
                'rule' => 'notempty',
                 'required' => false,
                'message' => 'Please Enter  title !',
            ),
        ),
         'url' => array(
            'mustNotBeBlank' => array(
                'rule' => 'notempty',
                 'required' => false,
                'message' => 'Please Enter  URL !',
            ),
        ),
        'name' => array(
            'mustNotBeBlank' => array(
                'rule' => 'notempty',
                 'required' => false,
                'message' => 'Please Enter  name !',
            ),
            'special' => array(
                'rule' => '/^[\W  a-zA-Z]+$/',
                'allowEmpty' => false,
                 'required' => false,
                'message' => 'Only letters and special characters  allowed',
            ),
        ),
        'editor1' => array(
            'rule' => 'notempty',
             'required' => false,
            'allowEmpty' => false,
            'message' => 'Please enter description  !'
        ),
           'image_name' => array(
            'rule' => array('extension',array('jpeg','jpg','png','gif')),
            'required' => false,
            'allowEmpty' => true,
            'message' => 'Please choose your image! '
        ),
    );

}

?>
