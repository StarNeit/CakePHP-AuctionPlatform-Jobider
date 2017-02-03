<?php
class Career extends AppModel{
    public $validate=array(
        'title'=>array(
            'notempty'=>array(
                'rule'=>array('notempty'),
                'message'=>'Please enter the title !',
            )
        ),
        'editor1'=>array(
            'notempty'=>array(
                'rule'=>array('notempty'),
                'message'=>'Please enter the description !'
            )
        )
    );
}
?>
