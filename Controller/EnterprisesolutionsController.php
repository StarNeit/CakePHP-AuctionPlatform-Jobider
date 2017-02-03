<?php

App::uses('CakeEmail', 'Network/Email');

class EnterprisesolutionsController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('index', 'marketing', 'Human_Recources', 'Procurement', 'operation', 'certified_program_concultants', 'ajax_save_operation'));
    }

    public function index() {
        $this->layout = 'front';
        $this->loadModel('Solution');
        if ($this->request->is('post')) {
            $Data['Solution']['first_name'] = $this->request->data['Solution']['first_name'];
            $Data['Solution']['last_name'] = $this->request->data['Solution']['last_name'];
            $Data['Solution']['email'] = $this->request->data['Solution']['email'];
            $Data['Solution']['phone'] = $this->request->data['Solution']['phone'];
            $Data['Solution']['company'] = $this->request->data['Solution']['company'];
            $Data['Solution']['job_title'] = $this->request->data['Solution']['job_title'];
            $Data['Solution']['employes'] = $this->request->data['Solution']['employes'];
            $Data['Solution']['notes'] = $this->request->data['Solution']['notes'];
            $Data['Solution']['type'] = 'Enterprise_solution';
            $this->set($Data);
            if ($this->Solution->save($Data)) {
                $Email = new CakeEmail();
                $Email->template('enterprisesolution');
                $Email->emailFormat('html');
                $Email->viewVars(array('sender_firstname' => $Data['Solution']['first_name'], 'sender_lastname' => $Data['Solution']['last_name']));
                $Email->from(array('info@jobider.com'));
                $Email->to($this->request->data['Solution']['email']);
                $Email->subject('Thank you for contacting us about our Private Talent Cloud', 'success');
                $Email->send();
                $this->set('success', 'Hello Hie');
            }
        }
    }

    public function marketing() {
        $this->layout = 'front';
        $this->loadModel('Solution');
        if ($this->request->is('post')) {
            $Data['Solution']['first_name'] = $this->request->data['Solution']['first_name'];
            $Data['Solution']['last_name'] = $this->request->data['Solution']['last_name'];
            $Data['Solution']['email'] = $this->request->data['Solution']['email'];
            $Data['Solution']['phone'] = $this->request->data['Solution']['phone'];
            $Data['Solution']['company'] = $this->request->data['Solution']['company'];
            $Data['Solution']['job_title'] = $this->request->data['Solution']['job_title'];
            $Data['Solution']['employes'] = $this->request->data['Solution']['employes'];
            $Data['Solution']['notes'] = $this->request->data['Solution']['notes'];
            $Data['Solution']['type'] = 'Marketing';
            $this->set($Data);
            if ($this->Solution->save($Data)) {
                $Email = new CakeEmail();
                $Email->template('enterprisesolution');
                $Email->emailFormat('html');
                $Email->viewVars(array('sender_firstname' => $Data['Solution']['first_name'], 'sender_lastname' => $Data['Solution']['last_name']));
                $Email->from(array('info@jobider.com'));
                $Email->to($this->request->data['Solution']['email']);
                $Email->subject('Thank you for contacting us about our Private Talent Cloud', 'success');
                $Email->send();
                $this->set('success', 'Hello Hie');
            }
        }
    }

    public function Human_Recources() {
        $this->layout = 'front';
        $this->set('title_for_layout', 'Human Resources');
        $this->loadModel('Solution');
        if ($this->request->is('post')) {
            $Data['Solution']['first_name'] = $this->request->data['Solution']['first_name'];
            $Data['Solution']['last_name'] = $this->request->data['Solution']['last_name'];
            $Data['Solution']['email'] = $this->request->data['Solution']['email'];
            $Data['Solution']['phone'] = $this->request->data['Solution']['phone'];
            $Data['Solution']['company'] = $this->request->data['Solution']['company'];
            $Data['Solution']['job_title'] = $this->request->data['Solution']['job_title'];
            $Data['Solution']['employes'] = $this->request->data['Solution']['employes'];
            $Data['Solution']['notes'] = $this->request->data['Solution']['notes'];
            $Data['Solution']['type'] = 'Human_Recources';
            $this->set($Data);
            if ($this->Solution->save($Data)) {
                $Email = new CakeEmail();
                $Email->template('enterprisesolution');
                $Email->emailFormat('html');
                $Email->viewVars(array('sender_firstname' => $Data['Solution']['first_name'], 'sender_lastname' => $Data['Solution']['last_name']));
                $Email->from(array('info@jobider.com'));
                $Email->to($this->request->data['Solution']['email']);
                $Email->subject('Thank you for contacting us about our Private Talent Cloud', 'success');
                $Email->send();
                $this->set('success', 'Hello Hie');
            }
        }
    }

    public function Procurement() {
        $this->layout = 'front';
         $this->set('title_for_layout', 'Procurement');
        $this->loadModel('Solution');
        if ($this->request->is('post')) {
            $Data['Solution']['first_name'] = $this->request->data['Solution']['first_name'];
            $Data['Solution']['last_name'] = $this->request->data['Solution']['last_name'];
            $Data['Solution']['email'] = $this->request->data['Solution']['email'];
            $Data['Solution']['job_title'] = $this->request->data['Solution']['job_title'];
            $Data['Solution']['company'] = $this->request->data['Solution']['company'];
            $Data['Solution']['employes'] = $this->request->data['Solution']['employes'];
            $Data['Solution']['phone'] = $this->request->data['Solution']['phone'];
            $Data['Solution']['notes'] = $this->request->data['Solution']['notes'];
            $Data['Solution']['type'] = 'procurement';
            $this->set($Data);
            if ($this->Solution->save($Data)) {
                $Email = new CakeEmail();
                $Email->template('enterprisesolution');
                $Email->emailFormat('html');
                $Email->viewVars(array('sender_firstname' => $Data['Solution']['first_name'], 'sender_lastname' => $Data['Solution']['last_name']));
                $Email->from(array('info@jobider.com'));
                $Email->to($this->request->data['Solution']['email']);
                $Email->subject('Thank you for contacting us about our Private Talent Cloud', 'success');
                $Email->send();
                $this->set('success', 'record inserted');
            }
        }
    }

    public function operation() {
        $this->layout = 'front';
        $this->loadModel('Solution');
        if ($this->request->is('post')) {
            $Data['Solution']['first_name'] = $this->request->data['Solution']['first_name'];
            $Data['Solution']['last_name'] = $this->request->data['Solution']['last_name'];
            $Data['Solution']['email'] = $this->request->data['Solution']['email'];
            $Data['Solution']['phone'] = $this->request->data['Solution']['phone'];
            $Data['Solution']['company'] = $this->request->data['Solution']['company'];
            $Data['Solution']['job_title'] = $this->request->data['Solution']['job_title'];
            $Data['Solution']['employes'] = $this->request->data['Solution']['employes'];
            $Data['Solution']['notes'] = $this->request->data['Solution']['notes'];
            $Data['Solution']['type'] = 'operation';
            $this->set($Data);
            if ($this->Solution->save($Data)) {
                $Email = new CakeEmail();
                $Email->template('enterprisesolution');
                $Email->emailFormat('html');
                $Email->viewVars(array('sender_firstname' => $Data['Solution']['first_name'], 'sender_lastname' => $Data['Solution']['last_name']));
                $Email->from(array('info@jobider.com'));
                $Email->to($this->request->data['Solution']['email']);
                $Email->subject('Thank you for contacting us about our Private Talent Cloud', 'success');
                $Email->send();
                $this->set('success', 'Hello Hie');
            }
        }
    }

    public function ajax_save_operation() {
        $this->autoRender = false;
        $this->layout = 'ajax';
        $this->loadModel('Solution');
        if (!empty($_POST)) {
            $Data['Solution']['first_name'] = $_POST['first_name'];
            $Data['Solution']['last_name'] = $_POST['last_name'];
            $Data['Solution']['email'] = $_POST['email'];
            $Data['Solution']['job_title'] = $_POST['jobtitle'];
            $Data['Solution']['company'] = $_POST['company'];
            $Data['Solution']['employes'] = $_POST['employ'];
            $Data['Solution']['phone'] = $_POST['phone'];
            $Data['Solution']['notes'] = $_POST['Note'];
            $Data['Solution']['type'] = 'operation';
            $this->set($Data);
            $this->Solution->save($Data);
        }
    }

    public function certified_program_concultants() {
        $this->layout = 'front';
         $this->set('title_for_layout', 'Certified Program Consultant');
        $this->loadModel('Solution');
        if ($this->request->is('post')) {
            $Data['Solution']['first_name'] = $this->request->data['Solution']['first_name'];
            $Data['Solution']['last_name'] = $this->request->data['Solution']['last_name'];
            $Data['Solution']['email'] = $this->request->data['Solution']['email'];
            $Data['Solution']['phone'] = $this->request->data['Solution']['phone'];
            $Data['Solution']['company'] = $this->request->data['Solution']['company'];
            $Data['Solution']['job_title'] = $this->request->data['Solution']['job_title'];
            $Data['Solution']['employes'] = $this->request->data['Solution']['employes'];
            $Data['Solution']['notes'] = $this->request->data['Solution']['notes'];
            $Data['Solution']['type'] = 'certified_program_concultants';
            $this->set($Data);
            if ($this->Solution->save($Data)) {
                $Email = new CakeEmail();
                $Email->template('enterprisesolution');
                $Email->emailFormat('html');
                $Email->viewVars(array('sender_firstname' => $Data['Solution']['first_name'], 'sender_lastname' => $Data['Solution']['last_name']));
                $Email->from(array('info@jobider.com'));
                $Email->to($this->request->data['Solution']['email']);
                $Email->subject('Thank you for contacting us about our Private Talent Cloud', 'success');
                $Email->send();
                $this->set('success', 'Hello Hie');
            }
        }
    }

    public function webadmin_index() {
        $this->layout = 'admin_main';
        $this->loadModel('Solution');
        if (!empty($this->request->data)) {
            if (!empty($this->request->data['Solution']['search'])) {
                $this->paginate = array('limit' => 4, 'conditions' => array('OR' => array('Solution.first_name' => $this->request->data['Solution']['search'], 'Solution.last_name' => $this->request->data['Solution']['search'], 'Solution.email' => $this->request->data['Solution']['search'])), 'order' => array('Solution.id' => 'asc'));
                $search = $this->paginate('Solution');
                $this->set('blog', $search);
                $test = $this->request->data['Solution']['search'];
                $this->set('text', $test);
            } else {
                $this->paginate = array('limit' => 4, 'conditions' => array('Solution.type' => 'freelancer'), 'order' => array('Solution.id' => 'asc'));
                $search = $this->paginate('Solution');
                $this->set('blog', $search);
            }
        } else {
            $this->paginate = array('limit' => 4, 'order' => array('Solution.id' => 'asc'));
            $search = $this->paginate('Solution');
            $this->set('blog', $search);
        }
    }

    public function webadmin_reply($id = NULL) {
        $this->layout = 'admin_main';
        $this->loadModel('Solution');
        $find = $this->Solution->findById($id);
        $this->set('value', $find);
        if (!empty($this->data)) {
            $to = $find['Solution']['email'];
            $subject = 'Reply From Admin.';
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            // More headers//
            $headers .= 'From: <info@jobider.com>' . "\r\n";
            $message = $this->data['Solution']['message'];
            mail($to, $subject, $message, $headers);
            $Success = 'Message Sent Successfully !';
            $this->set('success', $Success);
        } else {
            $error = 'Error Occured !';
            $this->set('error', $error);
        }
    }

    /* Enterprise Webadmin Change Status Function */


    /* Enterprise Webadmin Changeselectall Function */

    public function webadmin_changeselectall() {
        $this->autoRender = false;
        $this->loadModel('Solution');
        if ($this->request->is('post')) {
            $this->Solution->type = $this->request->data['Solution']['type'];
            $catAr = $this->request->data['Solution']['chk1'];
            if (!empty($catAr)) {
                if ($this->request->data['Solution']['select'] == 'delete') {
                    foreach ($catAr as $v) {
                        $this->Solution->delete($v);
                    }
                    $this->Session->setFlash('Record deleted successfully', 'success');
                }
                $this->redirect('/webadmin/Enterprisesolutions');
            }
        }
    }

    /* Enterprise Webadmin Delete Function */

    public function webadmin_delete($id) {
        $this->autoRender = false;
        $this->loadModel('Solution');
        $Solution = $this->Solution->findById($id);
        $sol_id = $Solution['Solution']['id'];
        if ($this->Solution->delete($sol_id)) {
            $this->redirect('/webadmin/Enterprisesolutions');
        }
    }

    public function WithdrawRequest($id=null) {
        $this->layout='front';
        
    }

}
