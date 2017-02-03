<?php
class Blog extends AppModel{
  public $validate=array(
        'author'=>array(
            'notempty'=>array(
                'rule'=>array('notempty'),
                'message'=>'Please enter the author name',
            )
        ),
        'editor1'=>array(
            'notempty'=>array(
                'rule'=>array('notempty'),
                'message'=>'Please enter the description'
            )
        ), 
      'category_id'=>array(
            'notempty'=>array(
                'rule'=>array('notempty'),
                'message'=>'Please select the category',
            )
        ),
        'tags'=>array(
            'notempty'=>array(
                'rule'=>array('notempty'),
                'message'=>'Please enter the tags',
            )
        ),
//        'image_name'=>array(
//          'rule' => array('extension',array('jpeg','jpg','png','gif')),
//            'allowEmpty'=>'false',
//                'message'=>'Please choose the image',
//            ),
        'title'=>array(
            'notempty'=>array(
                'rule'=>array('notempty'),
                'message'=>'Please enter the title',
            )
        )
      
    );
}
?>
