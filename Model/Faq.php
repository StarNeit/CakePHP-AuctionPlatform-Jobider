<?php
class Faq extends AppModel{
    public $validate=array(
        'question'=>array(
            'notempty'=>array(
                'rule'=>array('notempty'),
                'message'=>'Please enter the question',
            )
        ),
        'answer'=>array(
            'notempty'=>array(
                'rule'=>array('notempty'),
                'message'=>'Please enter the answer'
            )
        )
    );
}
?>
