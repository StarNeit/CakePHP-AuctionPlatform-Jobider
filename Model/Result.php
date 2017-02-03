<?php

class Result extends AppModel {

//       public $belongsTo = array(
//        'Question' => array(
//            'className' => 'Question',
//            'dependent' => true,
//            'foriegn key' => 'id'
//        ),
//           'Testcontent'=>array(
//               'className'=>'Testcontent',
//               'foriegn key'=>'topic_id'
//           )
//    );
    var $belongsTo = array(
        'Question' => array(
            'foreignKey' => 'question_id',
            'counterCache' => true,
            'dependent' => true,
        ),
        'Testcontent' => array(
            'className' => 'Testcontent',
            'dependent' => true,
            'foreignKey' => 'topic_id',
        ),
    );

//    var $hasMany = array(
//        'Question' => array(
//            'className' => 'Question',
//            'dependent' => true,
//            'foriegn key' => 'id',
//           
//           
//        ),
//    );
}

?>
