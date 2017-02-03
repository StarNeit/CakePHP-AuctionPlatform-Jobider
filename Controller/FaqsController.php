<?php

class FaqsController extends AppController {
    /*Faqs Webadmin Add Function*/
    public function webadmin_add() {
        $this->layout = 'admin_main';
        if ($this->request->is('post')) {
            $this->request->data['Faq']['answer'] = strip_tags($this->request->data['Faq']['answer']);
            $this->request->data['Faq']['addedon'] = time();
            $this->set($this->request->data);
            if ($this->Faq->save($this->request->data)) {
                $this->Session->setFlash('Faqs Added Successfully', 'success');
                $this->redirect('/webadmin/faqs');
            }
        }
    }
    /*Faqs Webadmin Index Function*/
    public function webadmin_index() {
        $this->layout = 'admin_main';
        if (!empty($this->request->data)) {
            if (!empty($this->request->data['Faq']['search'])) {
                $this->paginate = array('limit' => 4, 'conditions' => array('OR' => array('Faq.question LIKE' => '%' . $this->request->data['Faq']['search'] . '%')), 'order' => array('Faq.id' => 'asc'));
                $search = $this->paginate('Faq');
                $this->set('blog', $search);
                $text = $this->request->data['Faq']['search'];
                $this->set('text', $text);
            } else {
                $this->paginate = array('limit' => 4);
                $search = $this->paginate('Faq');
                $this->set('blog', $search);
            }
        } else {
            $this->paginate = array('limit' => 4);

            $search = $this->paginate('Faq');
            $this->set('blog', $search);
        }
    }
    /*Faqs Webadmin Change Status Function*/
    public function webadmin_change_status($id) {
        $this->autoRender = false;
        $faq_data = $this->Faq->findById($id);
        if ($faq_data['Faq']['status'] == '1') {
            $faq_status = '0';
        } else {
            $faq_status = '1';
        }
        $this->request->data['Faq']['status'] = $faq_status;
        $this->Faq->id = $id;
        $this->set($this->request->data);
        if ($this->Faq->save($this->request->data)) {
            $this->Session->setFlash('Faq Status Changed Successfully', 'success');
            $this->redirect('/webadmin/faqs');
        } else {
            $this->Session->setFlash('Faq Status Not Changed, Please Try Again ', 'error');
        }
    }
    /*Faqs Webadmin Changeselectall Function*/
    public function webadmin_changeselectall() {
        $this->autoRender = false;
        if (!empty($this->request->data)) {
            $faq_id = $this->request->data['Faq']['chk1'];
            if ($this->request->data['Faq']['select'] == 'active') {
                foreach ($faq_id as $f_id) {
                    $this->request->data['Faq']['status'] = '1';
                    $this->Faq->id = $f_id;
                    $this->set($this->request->data);
                    $this->Faq->save($this->request->data);
                }
                $this->Session->setFlash('Faq Status Activated Successfully', 'success');
            } elseif ($this->request->data['Faq']['select'] == 'inactive') {
                foreach ($faq_id as $f_id) {
                    $this->request->data['Faq']['status'] = '0';
                    $this->Faq->id = $f_id;
                    $this->set($this->request->data);
                    $this->Faq->save($this->request->data);
                }
                $this->Session->setFlash('Faq Status Deactivated Successfully', 'success');
            } elseif ($this->request->data['faq']['select'] == 'delete') {
                foreach ($faq_id as $f_id) {
                    $this->Faq->delete($f_id);
                }
                $this->Session->setFlash('Faq Deleted Successfully', 'success');
            }
        }
        $this->redirect('/webadmin/faqs');
    }
    /*Faqs Webadmin Edit Function*/
    public function webadmin_edit($id) {
        $this->layout = 'admin_main';
        $faq_edit_data = $this->Faq->findById($id);
        $this->set('faq_edit_data', $faq_edit_data);
        if ($this->request->is('post')) {
            $this->request->data['Faq']['addedon'] = time();
            $this->request->data['faq']['answer'] = strip_tags($this->request->data['Faq']['answer']);
            $this->set($this->request->data);
            $this->Faq->id = $id;
            if ($this->Faq->save($this->request->data)) {
                $this->Session->setFlash('Faqs Updated Successfully', 'success');
                $this->redirect('/webadmin/faqs');
            } else {
                $this->Session->setFlash('Faqs Not Updated, please try again', 'error');
            }
        }
    }
    /*Faqs Webadmin Delete Function*/
    public function webadmin_delete($faq_id) {
        $this->autoRender = false;
        $this->Faq->delete($faq_id);
        $this->Session->setFlash('Faq Deleted Successfully', 'success');
        $this->redirect('/webadmin/faqs');
    }
     /*Faqs Webadmin Show Data Function*/
    public function webadmin_showdata() {
        $this->layout = 'popup_model';
        $this->loadModel('Faq');
        $faq_id = $_POST['select'];
        $faq_data = $this->Faq->find('first', array('conditions' => array('Faq.id' => $faq_id)));

        $this->set('faq_data', $faq_data);
        //	pr($faq_data);
    }
    /*Faqs Webadmin Preview Function*/
    public function webadmin_preview($id = null) {
        $this->autoRender = false;
        $this->loadModel('Faq');
        $found = $this->Faq->findById($id);
        //	pr($found); die;
        if ($this->request->is('post')) {
            if ($found['Faq']['status'] == '1') {
                $use_status = '0';
            } else {
                $use_status = '1';
            }
            $this->request->data['Faq']['status'] = $use_status;
            $this->Faq->id = $id;
            if ($this->Faq->save($this->request->data)) {
                $this->Session->setFlash('Faq Status Changed Successfully', 'success');
                $this->redirect('/webadmin/faqs');
            }
        }
    }

}
