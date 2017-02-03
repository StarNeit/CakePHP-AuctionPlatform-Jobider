<?php

class DashboardController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
    }

    /* Dashboard Webadmin Index Function */

    public function webadmin_index() {
       $this->layout = 'admin_main';
       //pr($_SESSION);
 
    }

    public function webadmin_contact_us_details() {

        $this->layout = 'admin_main';
        $this->loadModel('Contact');
        if (!empty($this->request->data)) {
            if (!empty($this->request->data['Contact']['search'])) {
                $this->paginate = array('limit' => 2, 'conditions' => array('OR' => array('Contact.name' => $this->request->data['Contact']['search'], 'Contact.email' => $this->request->data['Contact']['search'])), 'order' => array('Contact.id' => 'asc'));
                $message_Info = $this->paginate('Contact');
                $this->set('blog', $message_Info);
                $text = $this->request->data['Contact']['search'];
                $this->set('text', $text);
            } else {
                $this->paginate = array('limit' => 2);
                $search = $this->paginate('Contact');
                $this->set('blog', $search);
            }
        } else {
            $this->paginate = array('limit' => 5);
            $message_Info = $this->paginate('Contact');
            $this->set('blog', $message_Info);
        }
    }

    /* Dashboard Webadmin Delete Function */

    public function webadmin_delete($id) {
        $this->autoRender = false;
        $this->loadModel('Contact');
        $this->Contact->delete($id);
        $this->Session->setFlash('Meassge Deleted Successfully', 'success');
        $this->redirect(array('controller' => 'dashboard', 'action' => 'index'));
    }

    /* Dashboard Webadmin Reply Function */

    function webadmin_reply($id) {
        $this->layout = 'admin_main';
        $this->loadModel('Contact');
        $find = $this->Contact->findById($id);
        $this->set('value', $find);
        if (!empty($this->data)) {
            $to = $find['Contact']['email'];
            $subject = 'Reply From Admin.';
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            /* More headers */https://www.youtube.com/watch?v=Qx_saMz2zj8
            $headers .= 'From: <info@jobider.com>' . "\r\n";
            $message = $this->data['Contact']['message'];
            mail($to, $subject, $message, $headers);
            $Success = 'Message Sent Successfully !';
            $this->set('success', $Success);
        } else {
            $error = 'Error Occured !';
            $this->set('error', $error);
        }
    }

    public function webadmin_membership_plans() {
        $this->layout = 'admin_main';
        $this->loadModel('Membershipplan');
        $this->loadModel('User');
//        $Membership_plans = $this->Membershipplan->find('all', array('conditions' => array('Membershipplan.status' => 1)));
        $this->paginate = array('limit'=>5,'conditions' => array('Membershipplan.status' => 1));
        $Membership_plans = $this->Paginate('Membershipplan');
//  pr($Membership_plans);
        $freelancer_id = array();
        foreach ($Membership_plans as $key => $val) {
            $freelancer_id[] = $val['Membershipplan']['user_id'];
            $user_record = $this->User->find('first',array('conditions'=>array('User.id'=>$freelancer_id,'User.type'=>'freelancer')));
//            pr($user_record);
            $Membership_plans[$key]['freelancer']=$user_record;
//            pr($Membership_plans);
        }
        $this->set('Plandata',$Membership_plans);
    }

}
