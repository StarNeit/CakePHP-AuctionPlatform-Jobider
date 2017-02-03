<?php
class Page extends AppModel{
    public $validate=array(
        'name'=>array(
            'notempty'=>array(
                'rule'=>array('notempty'),
                'message'=>'Please enter the name !',
            )
        ),
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
        ),
          'image_name'=>array(
          'rule' => array('extension',array('jpeg','jpg','png','gif')),
            'allowEmpty'=>'false',
                'message'=>'Please choose the image',
            )
    );
}
?>
