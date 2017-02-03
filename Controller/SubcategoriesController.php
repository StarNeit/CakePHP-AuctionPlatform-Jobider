<?php

class SubcategoriesController extends AppController {
    /* Subcategories Webadmin Index Function */

    public function webadmin_index($id) {
        $this->layout = 'admin_main';
        if (!empty($this->request->data)) {
            if (!empty($this->request->data['Subcategory']['search'])) {
                $this->paginate = array('limit' => 4, 'conditions' => array('OR' => array('Subcategory.category_name LIKE' => '%' . $this->request->data['Subcategory']['search'] . '%')), 'AND' => array('Subcategory.category_id' => $id), 'order' => array('Subcategory.id' => 'asc'));
                $search = $this->paginate('Subcategory');
                $this->set('blog', $search);
                $text = $this->request->data['Subcategory']['search'];
                $this->set('text', $text);
            } else {
                $this->paginate = array('limit' => 4, 'conditions' => array('Subcategory.category_id' => $id));
                $search = $this->paginate('Subcategory');
                $this->set('blog', $search);
            }
        } else {
            $this->paginate = array('limit' => 4, 'conditions' => array('Subcategory.category_id' => $id));
            $search = $this->paginate('Subcategory');
            $this->set('blog', $search);
        }
    }

    /* Subcategories Webadmin Add Function */

    public function webadmin_add() {
        $this->layout = 'admin_main';
        $this->loadModel('Category');
        $cat_data = $this->Category->find('list', array('fields' => 'Category.name'));
        $this->set('data', $cat_data);
        if ($this->request->is('post')) {
            If ($this->Subcategory->save($this->request->data)) {
                $this->Session->setFlash('Sub Category Added Successfully', 'success');
                $this->redirect(array('controller' => 'subcategories', 'action' => 'index', $this->request->data['Subcategory']['category_id']));
            }
        }
    }

    /* Subcategories Webadmin Edit Function */

    public function webadmin_edit($id = null) {
        $this->layout = 'admin_main';
        $this->loadModel('Category');
        $category_data = $this->Category->find('list', array('fields' => 'Category.name'));
        $this->set('data', $category_data);
        $us_data = $this->Subcategory->find('first', array('conditions' => array('Subcategory.id' => $id)));
        $this->set('user_data', $us_data);
        if ($this->request->is('post')) {
            $this->set($this->request->data);
            $this->Subcategory->id = $id;
            if ($this->Subcategory->save($this->request->data)) {
                $this->Session->setFlash('Sub Category Updated Successfully', 'success');
                $this->redirect(array('controller' => 'subcategories', 'action' => 'index', $us_data['Subcategory']['category_id']));
            }
        }
    }

    /* Subcategories Webadmin Change Status Function */

    public function webadmin_change_status($id) {
        $this->autoRender = false;
        $use_data_value = $this->Subcategory->find('first', array('conditions' => array('Subcategory.id' => $id)));
        if ($use_data_value['Subcategory']['status'] == '1') {
            $use_status = '0';
        } else {
            $use_status = '1';
        }
        $this->request->data['Subcategory']['status'] = $use_status;
        $this->Subcategory->id = $id;
        $this->set($this->request->data);
        if ($this->Subcategory->save($this->data)) {
            $this->Session->setFlash('Sub Category Status Changed Successfully', 'success');
            $this->redirect(array('controller' => 'subcategories', 'action' => 'index', $use_data_value['Subcategory']['category_id']));
        }
    }

    /* Subcategories Webadmin Changeselectall Function */

    public function webadmin_changeselectall($id) {
        $this->autoRender = false;
        if (!empty($this->request->data)) {
            $catar = $this->request->data['Subcategory']['chk1'];
            if ($this->request->data['Subcategory']['select'] == 'active') {
                foreach ($catar as $v) {
                    $this->request->data['Subcategory']['status'] = '1';
                    $this->Subcategory->id = $v;
                    $this->Subcategory->save($this->request->data);
                }
                $this->Session->setFlash('Subcategory Status Activated Successfully', 'success');
            } elseif ($this->request->data['Subcategory']['select'] == 'inactive') {
                foreach ($catar as $v) {
                    $this->request->data['Subcategory']['status'] = '0';
                    $this->Subcategory->id = $v;
                    $this->Subcategory->save($this->request->data);
                }
                $this->Session->setFlash('Subcategory Status Inactivated successfully', 'success');
            } elseif ($this->request->data['Subcategory']['select'] == 'delete') {
                foreach ($catar as $v) {
                    $this->Subcategory->delete($v);
                }
                $this->Session->setFlash('Subcategory Deleted Successfully', 'success');
            }
            $this->redirect(array('controller' => 'subcategories', 'action' => 'index', $id));
        }
    }

    /* Subcategories Webadmin Delete Function */

    public function webadmin_delete($id) {
        $this->autoRender = false;
        $use = $this->Subcategory->findById($id);
        $this->Subcategory->delete($id);
        $this->Session->setFlash('Subcategory Deleted Successfully', 'success');
        $this->redirect(array('controller' => 'subcategories', 'action' => 'index', $use['Subcategory']['category_id']));
    }

}
