<?php

class Partner extends AppModel {

    var $name = 'Partner';
    public $validate = array(
        'name' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Please enter the name !',
            )
        ),
        'image_name' => array(
            'rule' => array('extension', array('jpeg', 'jpg', 'png', 'gif')),
            'required' => false,
            'allowEmpty' => true,
            'message' => 'Please Choose Your Image! '
        ),
    );

}

?>
