<?php
class Jobcategory extends AppModel{
//var $name='Jobcategory';
 var $hasMany=array(
        'Jobsubcategory'=>array(
            'className' => 'Jobsubcategory',
            'dependent' => true,
            'foriegn key'=>'jobcategory_id',
            'fields'=>array('id','jobsubcategory_name'),
												'limit'=>'8'
            
        ), 
        );

public $validate = array(
        'category_name' => array(
          'notempty' => array(
            'rule' => array('notempty'),
            'message' => 'Enter your Category  Name.',          
        )
       )
    );

}
?>