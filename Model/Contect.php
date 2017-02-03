<?php
class Contect extends AppModel{
        public $belongsTo = array(
        'Job' => array(
            'counterCache' => true,
            'dependent'    => true,
            'foriegn key'=>'job_id'
        ), 
                   
    );
}
?>
