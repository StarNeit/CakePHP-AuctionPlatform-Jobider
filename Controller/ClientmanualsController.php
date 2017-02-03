<?php

class ClientmanualsController extends AppController {

    public function webadmin_add() {
        $this->layout = 'admin_main';
        $this->loadModel('Clientmanual');
        if ($this->request->is('post')) {
            $this->request->data['Clientmanual']['answer'] = $this->request->data['Clientmanual']['answer'];
            $this->set($this->request->data);
            if ($this->Clientmanual->save($this->request->data)) {
                $this->Session->setFlash('Content added Successfully', 'success');
                $this->redirect('/webadmin/clientmanuals');
            }
        }
    }

    public function webadmin_index() {
        $this->layout = 'admin_main';
        $this->loadModel('Clientmanual');
        if (!empty($this->request->data)) {
            if (!empty($this->request->data['Clientmanual']['search'])) {
                $this->paginate = array('limit' => 5, 'conditions' => array('OR' => array('Clientmanual.question LIKE' => '%' . $this->request->data['Clientmanual']['search'] . '%')), 'order' => array('Clientmanual.id' => 'asc'));
                $search = $this->paginate('Clientmanual');
                $this->set('blog', $search);
                $text = $this->request->data['Clientmanual']['search'];
                $this->set('text', $text);
            } else {
                $this->paginate = array('limit' => 5);
                $search = $this->paginate('Clientmanual');
                $this->set('blog', $search);
            }
        } else {
            $this->paginate = array('limit' => 5);
            $search = $this->paginate('Clientmanual');
            $this->set('blog', $search);
        }
    }

    public function webadmin_change_manual_status($id) {
        $this->autoRender = FALSE;
        $this->loadModel('Clientmanual');
        $find = $this->Clientmanual->findById($id);
        if ($find['Clientmanual']['status'] == '1') {
            $faq_status = '0';
        } else {
            $faq_status = '1';
        }
        $this->request->data['Clientmanual']['status'] = $faq_status;
        $this->Clientmanual->id = $id;
        $this->set($this->request->data);
        if ($this->Clientmanual->save($this->request->data)) {
            $this->Session->setFlash('Status Changed Successfully', 'success');
            $this->redirect('/webadmin/clientmanuals');
        }
    }

    public function webadmin_changestatus() {
        $this->autoRender = false;
        $this->loadModel('Clientmanual');
        if (!empty($this->request->data)) {
            $cater = $this->request->data['Clientmanual']['chk1'];
            if ($this->request->data['Clientmanual']['select'] == 'active') {
                foreach ($cater as $val) {
                    $this->request->data['Clientmanual']['status'] = '1';
                    $this->Clientmanual->id = $val;
                    $this->Clientmanual->save($this->request->data);
                }
                $this->Session->setFlash('manual Status Active Successfully', 'success');
            } elseif ($this->request->data['Clientmanual']['select'] == 'inactive') {
                foreach ($cater as $val) {
                    $this->request->data['Clientmanual']['status'] = '0';
                    $this->Clientmanual->id = $val;
                    $this->Clientmanual->save($this->request->data);
                }
                $this->Session->setFlash('Manual Status Inactive Successfully', 'success');
            } elseif ($this->request->data['Clientmanual']['select'] == 'delete') {
                foreach ($cater as $val) {
                    $this->Clientmanual->delete($val);
                }
                $this->Session->setFlash('Manual Deleted Successfully', 'success');
            }
            $this->redirect(array('controller' => 'clientmanuals', 'action' => 'index'));
        }
    }

    public function webadmin_deletemanuals($id) {
        $this->autoRender = false;
        $this->Clientmanual->delete($id);
        $this->Session->setFlash('Content Deleted Successfully', 'success');
        $this->redirect('/webadmin/clientmanuals');
    }

    public function webadmin_editmanuals1($id) {
        $this->layout = 'admin_main';
        $this->loadModel('Clientmanual');
        $quest = $this->Clientmanual->find('first', array('conditions' => array('Clientmanual.id' => $id)));
        $this->set('quest', $quest);
        if ($this->request->is('post')) {
            $this->request->data['Clientmanual']['answer'] = $this->request->data['Clientmanual']['answer'];
            $this->Clientmanual->id = $id;
            $this->set($this->request->data);
            if ($this->Clientmanual->save($this->request->data)) {
                $this->Session->setFlash('content updated successfully', 'success');
                $this->redirect('/webadmin/clientmanuals');
            }
        }
    }

    public function webadmin_editmanuals($id = null) {
        $this->layout = 'admin_main';
        $this->loadModel('Clientmanual');
        $quest = $this->Clientmanual->find('first', array('conditions' => array('Clientmanual.id' => $id)));
        $this->set('quest', $quest);
        if ($this->request->is('post')) {
            $this->Clientmanual->id = $id;
            $this->set($this->request->data);
//            pr($this->request->data);
//            die('sdgasdj');
            if ($this->Clientmanual->save($this->request->data)) {
                $this->Session->setFlash('content updated successfully', 'success');
                $this->redirect('/webadmin/clientmanuals');
            }
        }
    }

}