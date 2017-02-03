<?php
class Withdrawrequest extends AppModel{
           
     public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'dependent' => true,
            'foriegn key'=>'user_id'
        ), 
        'Milestone' => array(
            'className' => 'Milestone',
            'dependent' => true,
            'foriegn key'=>'milestone_id'
        ), 
         
    );

     
      public function beforeSave($options = array()) {

        if (!empty($this->data[$this->alias]['title']) && empty($this->data[$this->alias]['slug'])) {
            if (!empty($this->data[$this->alias][$this->primaryKey])) {
                $this->data[$this->alias]['slug'] = $this->generateSlug($this->data[$this->alias]['title'], $this->data[$this->alias][$this->primaryKey]);
            } else {
                $this->data[$this->alias]['slug'] = $this->generateSlug($this->data[$this->alias]['title']);
            }
        }
        return true;
    }
     
     
     
}
?>
