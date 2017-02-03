<?php
class Banner extends AppModel{
  public $validate=array(
 
        'name'=>array(
            'notempty'=>array(
                'rule'=>array('notempty'),
                'message'=>'Please enter the name',
            )
        ),
        'image_name'=>array(
          'rule' => array('extension',array('jpeg','jpg','png','gif')),
            'allowEmpty'=>'false',
                'message'=>'Please choose the image',
            ),
        'title'=>array(
            'notempty'=>array(
                'rule'=>array('notempty'),
                'message'=>'Please enter the title',
            )
        ),
        'description'=>array(
            'notempty'=>array(
                'rule'=>array('notempty'),
                'message'=>'Please enter the description',
            )
        )
      
    );
}
?>
