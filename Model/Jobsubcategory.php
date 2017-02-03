<?php

class Jobsubcategory extends AppModel {

    //var $name = 'Jobsubcategory';
    public $belongsTo = array(
        'Jobcategory' => array(
            'className' => 'Jobcategory',
            'dependent' => true,
            'foriegn key' => 'id'
        ),
    );
    public $validate = array(
        'jobcategory_id' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Please select the  category !',
                'allowEmpty' => false,
            //'required'=>true,
            )
        ),
        'jobsubcategory_name' => array(
            'mustNotBeBlank' => array(
                'rule' => 'notempty',
                'message' => 'Please enter the name ! ',
            ))
    );

}

?>
