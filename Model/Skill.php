<?php
class Skill extends AppModel{
	 var $hasMany=array(
        'Subskill'=>array(
            'className' => 'Subskill',
            'dependent' => true,
            'foriegn key'=>'skill_id',
            'fields'=>array('id','skill_name')
            
        ), 
						);
			     
		
	
	
	
    public $validate=array(
        'name'=>array(
            'notempty'=>array(
             'rule'=>array('notempty'),
                'message'=>'Please Enter The  Skill Name',
            )
        )
    );
}
?>
