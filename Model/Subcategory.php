<?php
class Subcategory extends AppModel{
       //public $primaryKey = 'id';
     public $belongsTo = array(
        'Category' => array(
            'className' => 'Category',
            'dependent' => true,
            'foriegn key'=>'id'
        ), 
    );
     
    public $validate=array(
        'category_id'=>array(
            'notempty'=>array(
                'rule'=>array('notempty'),
                'message'=>'Please select the category !'
            )
        ),
        'category_name'=>array(
            'notempty'=>array(
                'rule'=>array('notempty'),
                'message'=>'Please enter the category name !'
            )
        )
    );
     
}
?>
