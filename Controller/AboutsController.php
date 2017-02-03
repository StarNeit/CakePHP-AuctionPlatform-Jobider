<?php

class AboutsController extends AppController {
    /* About Webadmin Add Function */

    public function webadmin_add() {
        $this->layout = 'admin_main';
        $this->loadModel('About');
        if ($this->request->is('post')) {
            $this->About->set($this->request->data);
            $slug = preg_replace("/-$/", "", preg_replace('/[^a-z0-9]+/i', "_", strtolower($this->request->data['About']['name'])));
            $this->request->data['About']['name'] = $slug;
            $this->request->data['About']['description'] = $this->request->data['About']['editor1'];
            if ($this->About->save($this->request->data)) {
                $this->Session->setFlash('Pages are insert successfully', 'success');
                $this->redirect(array('controller' => 'abouts', 'action' => 'index'));
            }
        }
    }

    /* About Webadmin Index Function */

    public function webadmin_index() {
        $this->layout = 'admin_main';
        if (!empty($this->request->data)) {
            if (!empty($this->request->data['About']['search'])) {
                $this->paginate = array('limit' => 4, 'conditions' => array('OR' => array('About.title' => $this->request->data['About']['search'])), 'order' => array('About.id' => 'asc'));
                $search = $this->paginate('About');
                $this->set('blog', $search);
                $text = $this->request->data['About']['search'];
                $this->set('text', $text);
            } else {
                $this->paginate = array('limit' => 4);
                $search = $this->paginate('About');
                $this->set('blog', $search);
            }
        } else {
            $this->paginate = array('limit' => 4);

            $search = $this->paginate('About');
            $this->set('blog', $search);
        }
    }

    /* About Webadmin Change Status Function */

    public function webadmin_change_status($id) {
        $this->autoRender = false;
        $data = $this->About->find('first', array('conditions' => array('About.id' => $id)));
        if ($data['About']['status'] == '1') {
            $use = '0';
        } else {
            $use = '1';
        }
        $this->request->data['About']['status'] = $use;
        $this->About->id = $id;
        $this->set($this->request->data);
        if ($this->About->save($this->request->data)) {
            $this->Session->setFlash('Abouts status has been changed successfully', 'success');
            $this->redirect(array('controller' => 'abouts', 'action' => 'index'));
        }
    }

    /* About Webadmin Changeselectall Function */

    public function webadmin_changeselectall() {
        $this->autoRender = false;
        if (!empty($this->request->data)) {
            $catr = $this->request->data['About']['chk1'];
            if ($this->request->data['About']['select'] == 'active') {
                foreach ($catr as $v) {
                    $this->request->data['About']['status'] = '1';
                    $this->About->id = $v;
                    $this->About->save($this->request->data);
                }
                $this->Session->setFlash('Selected  Staus Changed Successfully', 'success');
            } elseif ($this->request->data['About']['select'] == 'inactive') {
                foreach ($catr as $v) {
                    $this->request->data['About']['status'] = '0';
                    $this->About->id = $v;
                    $this->About->save($this->request->data);
                }
                $this->Session->setFlash('Selected Status Changed Successfully', 'success');
            } elseif ($this->request->data['About']['select'] == 'delete') {
                foreach ($catr as $v) {
                    $this->About->delete($v);
                }
                $this->Session->setFlash('Selcted Values Delete Successfully', 'success');
            }
            $this->redirect(array('controller' => 'abouts', 'action' => 'index'));
        }
    }

    /* About Webadmin Edit Function */

    public function webadmin_edit($id = NULL) {
        $this->layout = 'admin_main';
        $value = $this->About->find('first', array('conditions' => array('About.id' => $id)));
        $this->set('blog', $value);
        if ($this->request->is('post')) {
            $this->About->set($this->request->data);
            $slug = preg_replace("/-$/", "", preg_replace('/[^a-z0-9]+/i', "_", strtolower($this->request->data['About']['name'])));
            $this->request->data['About']['name'] = $slug;
            $this->request->data['About']['description'] = $this->request->data['About']['editor1'];
            $this->About->id = $id;
            $this->set($this->request->data);
            if ($this->About->save($this->request->data)) {
                $this->Session->setFlash('Abouts Updated Successfully', 'success');
                $this->redirect(array('controller' => 'abouts', 'action' => 'index'));
            }
        }
    }

    /* About Webadmin Delete Function */

    public function webadmin_delete($id) {
        $this->autoRender = false;
        $this->About->delete($id);
        $this->Session->setFlash('Pages Deleted Successfully', 'success');
        $this->redirect(array('controller' => 'abouts', 'action' => 'index'));
    }

}

?>
