<?php

class Hashtag extends AppModel {
    var $name = 'Hashtag';
    public $belongsTo = array(
        'Blog' => array(
           // 'counterCache' => true,
            'dependent'    => true,
        )
    );

}

?>
