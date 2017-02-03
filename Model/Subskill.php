<?php
class Subskill extends AppModel{
       //public $primaryKey = 'id';
     public $belongsTo = array(
        'Skill' => array(
            'className' => 'Skill',
            'dependent' => true,
            'foriegn key'=>'id'
        ), 
    );
    public $validate=array(
        'skill_id'=>array(
            'notempty'=>array(
                'rule'=>array('notempty'),
                'message'=>'Please select the skills'
            )
        ),
        'skill_name'=>array(
            'notempty'=>array(
                'rule'=>array('notempty'),
                'message'=>'Please enter the skill name'
            )
        )
    );
     
}
?>
