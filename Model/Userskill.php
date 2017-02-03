<?php
class Userskill extends AppModel{
    
       public $primaryKey = 'id';
     public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'dependent' => true,
            'foriegn key'=>'user_id'
        ), 
    );
     
}
?>
