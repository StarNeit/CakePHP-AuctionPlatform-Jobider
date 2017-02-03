<?php

class CategoriesController extends AppController {
    /* Categories Webadmin Index Function */

    public function webadmin_index() {
        $this->layout = 'admin_main';
        if (!empty($this->request->data)) {
            if (!empty($this->request->data['Category']['search_cat'])) {
                $this->paginate = array('limit' => 4, 'conditions' => array('OR' => array('Category.name LIKE' => '%' . $this->request->data['Category']['search_cat'] . '%')), 'order' => array('Category.id' => 'asc'));
                $search = $this->paginate('Category');
                $this->set('blog', $search);
                $text = $this->request->data['Category']['search_cat'];
                $this->set('text', $text);
            } else {
                $this->paginate = array('limit' => 4);
                $search = $this->paginate('Category');
                $this->set('blog', $search);
            }
        } else {
            $this->paginate = array('limit' => 4);

            $search = $this->paginate('Category');
            $this->set('blog', $search);
        }
    }

    /* Categories Webadmin Add Function */

    public function webadmin_add(){
        $this->layout = 'admin_main';
        if ($this->request->is('post')) {
            $this->request->data['Category']['image'] = time() . '_' . $this->request->data['Category']['image_name']['name'];
            if (move_uploaded_file($this->request->data['Category']['image_name']['tmp_name'], WWW_ROOT . 'uploads/' . time() . '_' . $this->request->data['Category']['image_name']['name']))
                $this->set($this->request->data);
            if ($this->Category->save($this->request->data)) {
                $this->Session->setFlash('Categories insert successfully', 'success');
                $this->redirect(array('controller' => 'categories', 'action' => 'index'));
            }
        }
    }

    /* Categories Webadmin Change Status Function */

    public function webadmin_change_status($id) {
        $this->autoRender = false;
        $data_value = $this->Category->find('first', array('conditions' => array('Category.id' => $id)));
        if ($data_value['Category']['status'] == '1') {
            $us = '0';
        } else {
            $us = '1';
        }
        $this->request->data['Category']['status'] = $us;
        $this->Category->id = $id;
        $this->set($this->request->data);
        if ($this->Category->save($this->request->data)) {
            $this->Session->setFlash('Category Status Changed Successfully', 'success');
            $this->redirect(array('controller' => 'categories', 'action' => 'index'));
        }
    }

    /* Categories Webadmin Edit Function */

    public function webadmin_edit($id = null) {
        $this->layout = 'admin_main';
        $category_data = $this->Category->find('first', array('conditions' => array('Category.id' => $id)));
        $this->set('category', $category_data);
        if (empty($this->request->data)) {
            $this->request->data = $this->Category->read();
        } else {
            if (!empty($this->request->data['Category']['file']['name'])) {
                $this->request->data['Category']['image'] = time() . '_' . $this->request->data['Category']['file']['name'];
                move_uploaded_file($this->request->data['Category']['file']['tmp_name'], WWW_ROOT . 'uploads/' . time() . '_' . $this->request->data['Category']['file']['name']);
            }
            $this->Category->id = $id;
            $this->set($this->request->data);
            if ($this->Category->save($this->request->data)) {
                $this->Session->setFlash('Categories Updated Successfully', 'success');
                $this->redirect(array('controller' => 'categories', 'action' => 'index'));
            }
        }
    }

    /* Categories Webadmin Changeselectall Function */

    public function webadmin_changeselectall() {
        $this->autoRender = false;
        if (!empty($this->request->data)) {
            $catr = $this->request->data['Category']['chk1'];
            if ($this->request->data['Category']['select'] == 'active') {
                foreach ($catr as $v) {
                    $this->request->data['Category']['status'] = '1';
                    $this->Category->id = $v;
                    $this->Category->save($this->request->data);
                }
                $this->Session->setFlash('Categories Status Activated Successfully', 'success');
            } elseif ($this->request->data['Category']['select'] == 'inactive') {
                foreach ($catr as $v) {
                    $this->request->data['Category']['status'] = '0';
                    $this->Category->id = $v;
                    $this->Category->save($this->request->data);
                }
                $this->Session->setFlash('Categories Status Inactivated Successfully', 'success');
            } elseif ($this->request->data['Category']['select'] == 'delete') {
                foreach ($catr as $v) {
                    $this->Category->delete($v);
                }
                $this->Session->setFlash('Categories Deleted Successfully', 'success');
            }
            $this->redirect(array('controller' => 'categories', 'action' => 'index'));
        }
    }

    /* Categories Webadmin Delete Function */

    public function webadmin_delete($id) {
        $this->autoRender = false;
        $this->Category->delete($id);
        $this->Session->setFlash('Categories Deleted Successfully', 'success');
        $this->redirect(array('controller' => 'categories', 'action' => 'index'));
    }

}
