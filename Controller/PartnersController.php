<?php

class PartnersController extends AppController {

    var $uses = array('Partner');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('partner_request', 'partner');
    }

    /* Partners Webadmin Index Function */

    public function webadmin_index() {
        $this->layout = 'admin_main';
        $this->loadModel('Partnerrequest');
        if (!empty($this->request->data)) {
            if (!empty($this->request->data['Partnerrequest']['search'])) {
                $this->paginate = array('limit' => 2, 'conditions' => array('OR' => array('Partnerrequest.name' => $this->request->data['Partnerrequest']['search'], 'Partnerrequest.email ' => $this->request->data['Partnerrequest']['search'])), 'order' => array('Partnerrequest.id' => 'asc'));
                $message_Info = $this->paginate('Partnerrequest');
                $this->set('Partner_Request', $message_Info);
                $text = $this->request->data['Partnerrequest']['search'];
                $this->set('text', $text);
            } else {
                $this->paginate = array('limit' => 2);
                $search = $this->paginate('Partnerrequest');
                $this->set('blog', $search);
            }
        } else {
            $this->paginate = array('limit' => 5);
            $Partner_Req = $this->paginate('Partnerrequest');
            $this->set('Partner_Request', $Partner_Req);
        }
    }

    /* Partners Webadmin Add Function */

    public function webadmin_add() {
        $this->layout = 'admin_main';
        $this->loadModel('Partner');

        if ($this->request->is('post')) {
            $this->request->data['Partner']['image'] = time() . '_' . $this->request->data['Partner']['image_name']['name'];
            if (move_uploaded_file($this->request->data['Partner']['image_name']['tmp_name'], WWW_ROOT . 'uploads/' . time() . '_' . $this->request->data['Partner']['image_name']['name']))
                $this->set($this->request->data);
            if ($this->Partner->save($this->request->data)) {
                $this->Session->setFlash('Partner Added successfully', 'success');
                $this->redirect(array('controller' => 'partners', 'action' => 'partner'));
            }
        }
    }

    /* Partners Webadmin Partner Function */

    public function webadmin_partner() {
        $this->layout = 'admin_main';

        $this->loadModel('Partner');
        if (!empty($this->request->data)) {
            if (!empty($this->request->data['Partner']['search'])) {
                $this->paginate = array('limit' => 5, 'conditions' => array('OR' => array('Partner.name' => $this->request->data['Partner']['search'])), 'order' => array('Partner.id' => 'asc'));
                $search = $this->paginate('Partner');
                $this->set('blog', $search);
                $text = $this->request->data['Partner']['search'];
                $this->set('text', $text);
            } else {
                $this->paginate = array('limit' => 5);
                $search = $this->paginate('Partner');
                $this->set('blog', $search);
            }
        } else {
            $this->paginate = array('limit' => 5);

            $search = $this->paginate('Partner');
            $this->set('blog', $search);
        }
    }

    /* Partners Webadmin Change Status Function */

    public function webadmin_change_status($id) {
        $this->autoRender = false;
        $page_data = $this->Partner->findById($id);
        if ($page_data['Partner']['status'] == '1') {
            $page_status = '0';
        } else {
            $page_status = '1';
        }
        $this->request->data['Partner']['status'] = $page_status;
        $this->Partner->id = $id;
        $this->set($this->request->data);
        if ($this->Partner->save($this->request->data)) {
            $this->Session->setFlash('Page Status Changed Successfully', 'success');
            $this->redirect(array('controller' => 'partners', 'action' => 'partner'));
        }
    }

    /* Partners Webadmin Changeselectall Function */

    public function webadmin_changeselectall() {
        $this->autoRender = false;
        if (!empty($this->request->data)) {
            $cater = $this->request->data['Partner']['chk1'];
            if ($this->request->data['Partner']['select'] == 'active') {
                foreach ($cater as $val) {
                    $this->request->data['Partner']['status'] = '1';
                    $this->Partner->id = $val;
                    $this->Partner->save($this->request->data);
                }
                $this->Session->setFlash('Partner Status Active Successfully', 'success');
            } elseif ($this->request->data['Partner']['select'] == 'inactive') {
                foreach ($cater as $val) {
                    $this->request->data['Partner']['status'] = '0';
                    $this->Partner->id = $val;
                    $this->Partner->save($this->request->data);
                }
                $this->Session->setFlash('Partner Status Inactive Successfully', 'success');
            } elseif ($this->request->data['Partner']['select'] == 'delete') {
                foreach ($cater as $val) {
                    $this->Partner->delete($val);
                }
                $this->Session->setFlash('Partner Deleted Successfully', 'success');
            }
            $this->redirect(array('controller' => 'partners', 'action' => 'partner'));
        }
    }

    /* Partners Webadmin Delete Function */

    public function webadmin_delete($id) {
        $this->autoRender = false;
        $this->Partner->delete($id);
        $this->Session->setFlash('Pages Deleted Successfully', 'success');
        $this->redirect(array('controller' => 'partners', 'action' => 'partner'));
    }

    /* Partners Webadmin Delete Function */

    public function webadmin_edit($id = null) {
        $this->layout = 'admin_main';
        $value = $this->Partner->find('first', array('conditions' => array('Partner.id' => $id)));
        $this->set('blog', $value);
        if ($this->request->is('post')) {

            $this->Partner->set($this->request->data);

            if (!empty($this->request->data['Partner']['file']['name'])) {
                $this->request->data['Partner']['image'] = time() . '_' . $this->request->data['Partner']['file']['name'];
                move_uploaded_file($this->request->data['Partner']['file']['tmp_name'], WWW_ROOT . 'uploads/' . time() . '_' . $this->request->data['Partner']['file']['name']);
            }
            $this->Partner->id = $id;
            $this->set($this->request->data);
            if ($this->Partner->save($this->request->data)) {
                $this->Session->setFlash('Partner Updated Successfully', 'success');
                $this->redirect(array('controller' => 'partners', 'action' => 'partner'));
            }
        }
    }

    /* Partners Webadmin Reply Function */

    function webadmin_reply($id) {
        $this->layout = 'admin_main';
        $this->loadModel('Partnerrequest');
        $find = $this->Partnerrequest->findById($id);
        $this->set('value', $find);
        if (!empty($this->data)) {
            $to = $find['Partnerrequest']['email'];
            $subject = 'Reply From Admin.';
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            // More headers//
            $headers .= 'From: <admin@Jobider.com>' . "\r\n";
            $message = $this->data['Partnerrequest']['message'];
            mail($to, $subject, $message, $headers);
            $Success = 'Message Sent Successfully !';
            $this->set('success', $Success);
        } else {
            $error = 'Error Occured !';
            $this->set('error', $error);
        }
    }

    /* Partners Index Function */

    public function partner() {
        $this->layout = 'front';
        $this->loadModel('Partner');
        $this->loadModel('Page');
        $Find_Partners = $this->Partner->find('all', array('conditions' => array('Partner.status' => 1), 'fields' => array('Partner.image')));
        $find_Page = $this->Page->find('first', array('conditions' => array('Page.id' => 16)));
        $this->set('partner_image', $Find_Partners);
        $this->set('page_info', $find_Page);
    }

    /* Partners Request Function */

    public function partner_request() {
        $this->layout = 'front';
        $this->loadModel('Partnerrequest');
        if ($this->request->is('post')) {
            // $this->Partner->set($this->request->data);
            $this->request->data['Partnerrequest']['image'] = time() . '_' . $this->request->data['Partnerrequest']['image_name']['name'];
            if (move_uploaded_file($this->request->data['Partnerrequest']['image_name']['tmp_name'], WWW_ROOT . 'uploads/' . time() . '_' . $this->request->data['Partnerrequest']['image_name']['name']))
                $this->set($this->request->data);
            if ($this->Partnerrequest->save($this->request->data)) {
                $this->Session->setFlash('Request Sent Successfully', 'success');
                $this->redirect(array('controller' => 'partners', 'action' => 'partner'));
            }
        }
    }

}