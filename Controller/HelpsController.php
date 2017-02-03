<?php

class HelpsController extends AppController {
    /* Helps Webadmin Add Function */

    public function webadmin_add() {
        $this->layout = 'admin_main';
        $this->loadModel('Faq');
        if ($this->request->is('post')) {
           
            $this->request->data['Help']['description'] = $this->request->data['Help']['editor1'];
            $this->set($this->request->data);
            if ($this->Help->save($this->request->data)) {
                $this->Session->setFlash('Faqs Inserted Successfully', 'success');
                $this->redirect(array('controller' => 'helps', 'action' => 'index'));
            }
        }
    }

    /* Helps Webadmin Index Function */

    public function webadmin_index() {
        $this->layout = 'admin_main';
        if (!empty($this->request->data)) {
            if (!empty($this->request->data['Help']['search'])) {
                $this->paginate = array('limit' => 4, 'conditions' => array('OR' => array('Help.title' => $this->request->data['Help']['search'])), 'order' => array('Help.id' => 'asc'));
                $search = $this->paginate('Help');
                $this->set('blog', $search);
                $text = $this->request->data['Help']['search'];
                $this->set('text', $text);
            } else {
                $this->paginate = array('limit' => 4);
                $search = $this->paginate('Help');
                $this->set('blog', $search);
            }
        } 
        else {
            $this->paginate = array('limit' => 4);

            $search = $this->paginate('Help');
            $this->set('blog', $search);
        }
    }

    /* Helps Webadmin Change Status Function */

    public function webadmin_change_status($id) {
        $this->autoRender = false;
        $data = $this->Help->find('first', array('conditions' => array('Help.id' => $id)));
        if ($data['Help']['status'] == '1') {
            $use = '0';
        } else {
            $use = '1';
        }
        $this->request->data['Help']['status'] = $use;
        $this->Help->id = $id;
        $this->set($this->request->data);
        if ($this->Help->save($this->request->data)) {
            $this->Session->setFlash('Faqs Status Changed Successfully', 'success');
            $this->redirect(array('controller' => 'helps', 'action' => 'index'));
        }
    }

    /* Helps Webadmin Changeselectall Function */

    public function webadmin_changeselectall() {
        $this->autoRender = false;
        if (!empty($this->request->data)) {
            $catr = $this->request->data['Help']['chk1'];
            if ($this->request->data['Help']['select'] == 'active') {
                foreach ($catr as $v) {
                    $this->request->data['Help']['status'] = '1';
                    $this->Help->id = $v;
                    $this->Help->save($this->request->data);
                }
                $this->Session->setFlash('Selected  Staus Changed Successfully', 'success');
            } elseif ($this->request->data['Help']['select'] == 'inactive') {
                foreach ($catr as $v) {
                    $this->request->data['Help']['status'] = '0';
                    $this->Help->id = $v;
                    $this->Help->save($this->request->data);
                }
                $this->Session->setFlash('Selected Status Changed Successfully', 'success');
            } elseif ($this->request->data['Help']['select'] == 'delete') {
                foreach ($catr as $v) {
                    $this->Help->delete($v);
                }
                $this->Session->setFlash('Selcted Values Delete Successfully', 'success');
            }
            $this->redirect(array('controller' => 'helps', 'action' => 'index'));
        }
    }

    /* Helps Webadmin Edit Function */

    public function webadmin_edit($id = null) {
        $this->layout = 'admin_main';
        $faq = $this->Help->find('first', array('conditions' => array('Help.id' => $id)));
        $this->set('faq', $faq);
        if ($this->request->is('post')) {
            $this->Help->set($this->request->data);
            $this->request->data['Help']['description'] = $this->request->data['Help']['editor1'];
            $this->Help->id = $id;
            $this->set($this->request->data);
            if ($this->Help->save($this->request->data)) {
                $this->Session->setFlash('Faqs Updated Successfully', 'success');
                $this->redirect(array('controller' => 'helps', 'action' => 'index'));
            }
        }
    }

    /* Careers Webadmin Delete Function */

    public function webadmin_delete($id) {
        $this->autoRender = false;
        $this->Help->delete($id);
        $this->Session->setFlash('Faqs Deleted Successfully', 'success');
        $this->redirect(array('controller' => 'helps', 'action' => 'index'));
    }

}

