<?php

class Test extends AppModel {

    //public $primaryKey = 'id';

    var $hasMany = array(
        'Testcontent' => array(
            'className' => 'Testcontent',
            'dependent' => true,
            'foriegn key' => 'test_id',
            'fields' => array('id', 'test_content'),
            'limit' => '8'
        ),
    );
    public $validate = array(
        'category_id' => array(
            'rule' => 'notempty',
            //'required' => true,
            'message' => 'Please Select Category.'
        ),
        'title' => array(
            'notEmpty' => array(
                'rule' => 'notempty',
                'message' => 'Please Enter Title for the Test !'
            )),
        'question' => array(
            'notEmpty' => array(
                'rule' => 'notempty',
                //  'required' => true,
                'message' => 'Please Enter Questions for Test !'
            )),
          'editor1'=>array(
            'notempty'=>array(
                'rule'=>array('notempty'),
                'message'=>'Please enter the description'
            )
        ), 
        'test_type' => array(
            'rule' => 'notempty',
            //     'required' => true,
            'message' => 'Please Enter Value for Test Type !'
        ),
    );
    public $belongsTo = array(
        'Category' => array(
            'className' => 'Category',
            'dependent' => true,
            'foriegn key' => 'id'
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
