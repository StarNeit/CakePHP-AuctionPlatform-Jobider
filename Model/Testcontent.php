<?php
class Testcontent extends AppModel{
       public $validate = array(
        'category_id' => array(
            'rule' => 'notempty',
            'message' => 'Please Select Category.'
        ), 
          'test_id' => array(
            'rule' => 'notempty',
           'message' => 'Please Select Test.'
        ), 
         'test_content' => array(
            'notEmpty' => array(
                'rule' => 'notempty',
                'message' => 'Please Enter Title  Test content !'
            )),
        );
        
     public $belongsTo = array(
        'Test' => array(
            'className' => 'Test',
            'dependent' => true,
            'foriegn key'=>'id'
        ), 
    );
     
//        var $hasMany = array(
//        'Result' => array(
//            'className' => 'Result',
//            'dependent' => true,
//            'foriegn key' => 'topic_id',
//           
//           
//        ),
//    );
     
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
