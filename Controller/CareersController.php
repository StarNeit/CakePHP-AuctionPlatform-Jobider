<?php

class CareersController extends AppController {

    var $uses = array('Career');
    
     public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('career','view_all');
    }
    /*Careers Webadmin Index Function*/
    public function webadmin_index() {
        $this->layout = 'admin_main';
        $this->loadModel('Career');
        if (!empty($this->request->data)) {
            if (!empty($this->request->data['Career']['search'])) {
                $this->paginate = array('limit' => 5, 'conditions' => array('OR' => array('Career.title' => $this->request->data['Career']['search'])), 'order' => array('Career.id' => 'asc'));
                $search = $this->paginate('Career');
                $this->set('blog', $search);
                $text = $this->request->data['Career']['search'];
                $this->set('text', $text);
            } else {
                $this->paginate = array('limit' => 5);
                $search = $this->paginate('Career');
                $this->set('blog', $search);
            }
        } else {
            $this->paginate = array('limit' => 5);

            $search = $this->paginate('Career');
            $this->set('blog', $search);
        }
    }
       
    /*Careers Webadmin Add Function*/
    public function webadmin_add() {
        $this->layout = 'admin_main';
        $this->loadModel('Career');
        if ($this->request->is('post')){
            $this->request->data['Career']['description'] = strip_tags($this->request->data['Career']['editor1']);
            if ($this->Career->save($this->request->data)) {
                $this->Session->setFlash('Careers are inserted Successfully', 'success');
                $this->redirect(array('controller' => 'careers', 'action' => 'index'));
            }
        }
    }
    /*Careers Webadmin Change Status Function*/
    public function webadmin_change_status($id) {
        $this->autoRender = false;
        $this->loadModel('Career');
        $page_data = $this->Career->findById($id);
        if ($page_data['Career']['status'] == '1') {
            $page_status = '0';
        } else {
            $page_status = '1';
        }
        $this->request->data['Career']['status'] = $page_status;
        $this->Career->id = $id;
        $this->set($this->request->data);
        if ($this->Career->save($this->request->data)) {
            $this->Session->setFlash('Career Status Changed Successfully', 'success');
            $this->redirect(array('controller' => 'careers', 'action' => 'index'));
        }
    }
    /*Careers Webadmin Delete Function*/
    public function webadmin_delete($id) {
        $this->autoRender = false;
        $this->Career->delete($id);
        $this->Session->setFlash('Detail Deleted Successfully', 'success');
        $this->redirect(array('controller' => 'careers', 'action' => 'index'));
    }
    /*Careers Webadmin Changeselectall Function*/
    public function webadmin_changeselectall() {
        $this->autoRender = false;
        $this->loadModel('Career');
        if (!empty($this->request->data)) {
            $catr = $this->request->data['Career']['chk1'];
            if ($this->request->data['Career']['select'] == 'active') {
                foreach ($catr as $v) {
                    $this->request->data['Career']['status'] = '1';
                    $this->Career->id = $v;
                    $this->Career->save($this->request->data);
                }
                $this->Session->setFlash(' Status Activated Successfully', 'success');
            } elseif ($this->request->data['Career']['select'] == 'inactive') {
                foreach ($catr as $v) {
                    $this->request->data['Career']['status'] = '0';
                    $this->Career->id = $v;
                    $this->Career->save($this->request->data);
                }
                $this->Session->setFlash(' Status Inactivated Successfully', 'success');
            } elseif ($this->request->data['Career']['select'] == 'delete') {
                foreach ($catr as $v) {
                    $this->Career->delete($v);
                }
                $this->Session->setFlash('Deleted Successfully', 'success');
            }
            $this->redirect(array('controller' => 'careers', 'action' => 'index'));
        }
    }
    /*Careers Webadmin Edit Function*/
    public function webadmin_edit($id = null) {
        $this->layout = 'admin_main';
        $value = $this->Career->find('first', array('conditions' => array('Career.id' => $id)));
        $this->set('blog', $value);
        if (empty($this->request->data)) {
            $this->request->data = $this->Career->read();
        } else {
            $this->Career->id = $id;
            $this->request->data['Career']['description'] = strip_tags($this->request->data['Career']['editor1']);
            $this->set($this->request->data);
            if ($this->Career->save($this->request->data)) {
                $this->Session->setFlash('Details Updated Successfully', 'success');
                $this->redirect(array('controller' => 'careers', 'action' => 'index'));
            }
        }
    }

    ///////////////////////Front End///////////////////////////////
    /*Careers Index Function*/
    public function career() {
        $this->layout = 'front';
         $this->set('title_for_layout', 'Career');
        $this->loadModel('Career');
        $this->loadModel('Page');
        $career = $this->Career->find('all');
        $Page_info = $this->Page->find('first', array('conditions' => array('Page.id' => 19)));
        $this->set('Career_Page_data', $Page_info);
        $this->set('Career_data', $career);
    }
    /*Careers View All Function*/
    public function view_all($id = NULL) {
        $this->layout = 'front';
        $view_info = $this->Career->find('first', array('conditions' => array('Career.id' => $id, 'Career.status' => 1)));
        $this->set('ViewAll', $view_info);
    }

}