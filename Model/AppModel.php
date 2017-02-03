<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
    
     public function generateSlug($title = null, $id = null) {
        if (!$title) {
            throw new NotFoundException(__('Invalid Title'));
        }
        $title = strtolower($title);
        $slug  = Inflector::slug($title, '-');
        $conditions = array();
        $conditions[$this->alias . '.slug'] = $slug;

        if ($id) {
            $conditions[$this->primaryKey. ' NOT'] = $id;
        }

        $total = $this->find('count', array('conditions' => $conditions, 'recursive' => -1));
        if ($total > 0) {
            for ($number = 2; $number > 0; $number ++) {
                $conditions[$this->alias . '.slug'] = $slug . '-' . $number;

                $total = $this->find('count', array('conditions' => $conditions, 'recursive' => -1));
                if ($total == 0) {
                    return $slug . '-' . $number;
                }
            }
        }

        return $slug;
    }
    
    
}
