<?php

class Acceptinterview Extends AppModel{
 var $name='Acceptinterview';
 
   public $belongsTo = array(
      'User'=>array(
          'className'=>'User',
          'foreignKey'=>'freelancer_id'
      ),
      'Job'=>array(
          'className'=>'Job',
          'foreignKey'=>'job_id'
      )
      );
          
}

