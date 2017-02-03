<?php

class JobcategoryController extends AppController {

    //var $uses = array('Jobcategory');
    var $uses = array('Jobcategory');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index');
    }
    /*Jobscategories Webadmin Index Function*/
    public function webadmin_index() {
        $this->layout = 'admin_main';
        $find = $this->Jobcategory->find('all');
//        pr($find);
//        die('ghasfdhgsfadfsh');
        if (!empty($this->request->data)) {
            if (!empty($this->request->data['Jobcategory']['search'])) {
                $this->paginate = array('limit' => 4, 'conditions' => array('OR' => array('Jobcategory.category_name' => $this->request->data['Jobcategory']['search'])), 'order' => array('Jobcategory.id' => 'asc'));
                $search = $this->paginate('Jobcategory');
                $this->set('blog', $search);
                $text = $this->request->data['Jobcategory']['search'];
                $this->set('text', $text);
            } else {
                $this->paginate = array('limit' => 4);
                $search = $this->paginate('Jobcategory');
                $this->set('blog', $search);
            }
        } else {
            $this->paginate = array('limit' => 4);

            $search = $this->paginate('Jobcategory');
            $this->set('blog', $search);
        }
    }
    /*Jobscategories Webadmin Add Function*/
    public function webadmin_add() {
        $this->layout = 'admin_main';
        $this->loadModel('Jobcategory');
        if ($this->request->is('post')) {
//            pr($this->request->data);
//            die('sdjfhjsd');
            if ($this->Jobcategory->save($this->request->data)) {
                $this->Session->setFlash('Categories insert successfully', 'success');
                $this->redirect(array('controller' => 'jobcategory', 'action' => 'index'));
            }
        }
    }
    /*Jobscategories Webadmin Change Status Function*/
    public function webadmin_change_status($id) {
        $this->autoRender = false;
        $data_value = $this->Jobcategory->find('first', array('conditions' => array('Jobcategory.id' => $id)));
        if ($data_value['Jobcategory']['status'] == '1') {
            $us = '0';
        } else {
            $us = '1';
        }
        $this->request->data['Jobcategory']['status'] = $us;
        $this->Jobcategory->id = $id;
        $this->set($this->request->data);
        if ($this->Jobcategory->save($this->request->data)) {
            $this->Session->setFlash('Category Status Changed Successfully', 'success');
            $this->redirect(array('controller' => 'jobcategory', 'action' => 'index'));
        }
    }
    /*Jobcategories Webadmin Edit Function*/
    public function webadmin_edit($id = null) {
        $this->layout = 'admin_main';
        $category_data = $this->Jobcategory->find('first', array('conditions' => array('Jobcategory.id' => $id)));
        $this->set('category', $category_data);
        if (empty($this->request->data)) {
            $this->request->data = $this->Jobcategory->read();
        } else {
            $this->Jobcategory->id = $id;
            $this->set($this->request->data);
            if ($this->Jobcategory->save($this->request->data)) {
                $this->Session->setFlash('Categories Updated Successfully', 'success');
                $this->redirect(array('controller' => 'jobcategory', 'action' => 'index'));
            }
        }
    }
    /*Jobscategories Webadmin Changeselectall Function*/
    public function webadmin_changeselectall() {
        $this->autoRender = false;
        $this->loadModel('Jobcategory');
        if (!empty($this->request->data)) {
            $catr = $this->request->data['Jobcategory']['chk1'];
            if ($this->request->data['Jobcategory']['select'] == 'active') {
                foreach ($catr as $v) {
                    $this->request->data['Jobcategory']['status'] = '1';
                    $this->Jobcategory->id = $v;
                    $this->Jobcategory->save($this->request->data);
                }
                $this->Session->setFlash('Categories Status Activated Successfully', 'success');
            } elseif ($this->request->data['Jobcategory']['select'] == 'inactive') {
                foreach ($catr as $v) {
                    $this->request->data['Jobcategory']['status'] = '0';
                    $this->Jobcategory->id = $v;
                    $this->Jobcategory->save($this->request->data);
                }
                $this->Session->setFlash('Categories Status Inactivated Successfully', 'success');
            } elseif ($this->request->data['Jobcategory']['select'] == 'delete') {
                foreach ($catr as $v) {
                    $this->Jobcategory->delete($v);
                }
                $this->Session->setFlash('Categories Deleted Successfully', 'success');
            }
            $this->redirect(array('controller' => 'jobcategory', 'action' => 'index'));
        }
    }
    /*Jobscategories Webadmin Delete Function*/
    public function webadmin_delete($id) {
        $this->autoRender = false;
        $this->Jobcategory->delete($id);
        $this->Session->setFlash('Categories Deleted Successfully', 'success');
        $this->redirect(array('controller' => 'jobcategory', 'action' => 'index'));
    }
    /*Jobscategories Webadmin Addsubcategory Function*/
    public function webadmin_addSubcategory() {
        $this->layout = 'admin_main';
        $this->loadModel('Jobcategory');
        $this->loadModel('Jobsubcategory');
        $cat_data = $this->Jobcategory->find('list', array('fields' => 'Jobcategory.category_name'));
               $this->set('data', $cat_data);
        if ($this->request->is('post')) {
            $this->set($this->request->data);
            If ($this->Jobsubcategory->save($this->request->data)) {
                $this->Session->setFlash('Sub Category Added Successfully', 'success');
                $this->redirect(array('controller' => 'jobcategory', 'action' => 'subcategory', $this->request->data['Jobsubcategory']['jobcategory_id']));
            } 
        }
    }
    /*Jobcategories Webadmin Subcategory Function*/
    public function webadmin_subcategory($id = NULL) {
        $this->layout = 'admin_main';
        $this->loadModel('Jobcategory');
        $this->loadModel('Jobsubcategory');
        $name = $this->Jobcategory->find('first', array('conditions' => array('Jobcategory.id' => $id)));
        $this->set('name', $name);
        if (!empty($this->request->data)) {
            if (!empty($this->request->data['Jobsubcategory']['search'])) {
                $this->paginate = array('limit' => 4, 'conditions' => array('OR' => array('Jobsubcategory.jobsubcategory_name LIKE' => '%' . $this->request->data['Jobsubcategory']['search'] . '%')), 'AND' => array('Jobsubcategory.jobcategory_id' => $id), 'order' => array('Jobsubcategory.id' => 'asc'));
                $search = $this->paginate('Jobsubcategory');
                $this->set('blog', $search);
                $text = $this->request->data['Jobsubcategory']['search'];
                $this->set('text', $text);
            } else {
                $this->paginate = array('limit' => 4, 'conditions' => array('Jobsubcategory.jobcategory_id' => $id));
                $search = $this->paginate('Jobsubcategory');
                $this->set('blog', $search);
            }
        } else {
            $this->paginate = array('limit' => 4, 'conditions' => array('Jobsubcategory.jobcategory_id' => $id));
            $search = $this->paginate('Jobsubcategory');
            $this->set('blog', $search);
        }
    }
    /*Jobscategories Webadmin Delete Subcategory Function*/
    public function webadmin_deletesubcategory($id) {
        $this->autoRender = false;
        $this->loadModel('Jobsubcategory');
        $jobdata = $this->Jobsubcategory->find('first', array('conditions' => array('Jobsubcategory.id' => $id)));
        //	pr($jobdata); die;
        $this->Jobsubcategory->delete($id);
        $this->Session->setFlash('Sub Categories Deleted Successfully', 'success');
        $this->redirect(array('controller' => 'jobcategory', 'action' => 'subcategory', $jobdata['Jobsubcategory']['jobcategory_id']));
    }
    /*Jobscategories Webadmin Change Status Subcategory Function*/
    public function webadmin_change_status_subcategory($id) {
        $this->autoRender = false;
        $this->loadModel('Jobsubcategory');
        $data_value = $this->Jobsubcategory->find('first', array('conditions' => array('Jobsubcategory.id' => $id)));
        if ($data_value['Jobsubcategory']['status'] == '1') {
            $us = '0';
        } else {
            $us = '1';
        }
        $this->request->data['Jobsubcategory']['status'] = $us;
        $this->Jobsubcategory->id = $id;
        $this->set($this->request->data);
        $this->Jobsubcategory->save($this->request->data);
        $this->redirect(array('controller' => 'jobcategory', 'action' => 'subcategory/' . $data_value['Jobsubcategory']['jobcategory_id']));
    }
    /*Jobscategories Webadmin Changeselectall Subcategory Function*/
    public function webadmin_changeselectallsubcategory($id) {
        $this->autoRender = false;
        $this->loadModel('Jobcategory');
        $this->loadModel('Jobsubcategory');
        if (!empty($this->request->data)) {
            $catr = $this->request->data['Jobsubcategory']['chk1'];
            if ($this->request->data['Jobsubcategory']['select'] == 'active') {
                foreach ($catr as $v) {
                    $this->request->data['Jobsubcategory']['status'] = '1';
                    $this->Jobsubcategory->id = $v;
                    $this->Jobsubcategory->save($this->request->data);
                }
                $this->Session->setFlash('Categories Status Activated Successfully', 'success');
            } elseif ($this->request->data['Jobsubcategory']['select'] == 'inactive') {
                foreach ($catr as $v) {
                    $this->request->data['Jobsubcategory']['status'] = '0';
                    $this->Jobsubcategory->id = $v;
                    $this->Jobsubcategory->save($this->request->data);
                }
                $this->Session->setFlash('Categories Status Inactivated Successfully', 'success');
            } elseif ($this->request->data['Jobsubcategory']['select'] == 'delete') {
                foreach ($catr as $v) {
                    $this->Jobsubcategory->delete($v);
                }
                $this->Session->setFlash('Categories Deleted Successfully', 'success');
            }
            $this->redirect(array('controller' => 'jobcategory', 'action' => 'subcategory', $id));
        }
    }
    /*Jobscategories Webadmin Edit Subcategory Function*/
    public function webadmin_editSubcategory($id = NULL) {
        $this->layout = 'admin_main';
        $this->loadModel('Jobcategory');
        $this->loadModel('Jobsubcategory');
        $category_data = $this->Jobcategory->find('list', array('fields' => 'Jobcategory.category_name'));
        $this->set('data', $category_data);
        $us_data = $this->Jobsubcategory->find('first', array('conditions' => array('Jobsubcategory.id' => $id)));
        $this->set('user_data', $us_data);
        if ($this->request->is('post')) {
            $this->set($this->request->data);
            $this->Jobsubcategory->id = $id;
            if ($this->Jobsubcategory->save($this->request->data)) {
                $this->Session->setFlash('Sub Category Updated Successfully', 'success');
                $this->redirect(array('controller' => 'jobcategory', 'action' => 'subcategory/' . $us_data['Jobsubcategory']['jobcategory_id']));
            }
        }
    }

}
