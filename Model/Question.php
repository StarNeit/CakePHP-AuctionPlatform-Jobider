<?php

class Question extends AppModel {

    var $belongsTo = array(
        'Test' => array(
            'foreignKey' => 'test_id',
            'counterCache' => true,
            'dependent' => true,
        ),
        'Testcontent' => array(
            'className' => 'Testcontent',
            'dependent' => true,
            'foreignKey' => 'topic_id',
        ),
    );
    var $hasMany = array(
        'Result' => array(
            'className' => 'Result',
            'dependent' => true,
            'foriegn key' => 'question_id',
        ),
    );
    public $validate = array(
        'category_id' => array(
            'rule' => 'notempty',
            //'required' => true,
            'message' => 'Please Select the Category !'
        ),
        'test_id' => array(
            'rule' => 'notempty',
            'message' => 'Please Select the Test !'
        ),
        'topic_id' => array(
            'rule' => 'notempty',
            'message' => 'Please Select the Topic !'
        ),
        'name' => array(
            'notEmpty' => array(
                'rule' => 'notempty',
                'message' => 'Please Enter Question !'
            )),
        'options' => array(
            'notEmpty' => array(
                'rule' => 'notempty',
                'message' => ' Please Enter options for the Question  !  '
            )),
        'answers' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => ' Please enter the Answer ! '
            )
    ));

}

?>
