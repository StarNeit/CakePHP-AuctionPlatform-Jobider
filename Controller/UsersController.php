<?php

App::uses('CakeEmail', 'Network/Email');

class UsersController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('index', 'client', 'freelancer', 'activationlink'));
    }

    /* Users Generate Random String Function */

    function generateRandomString($length = 10) {

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    /* Users Index Function */

    public function index() {
        $this->layout = 'front';
    }

    /* Users Client Sign Up Function */

    public function client($type = null) {

       // pr($_SESSION);

        if (!empty($_SESSION['google_data'])) {

            $this->set('gplus_info', $_SESSION['google_data']);
        }

        if (!empty($_SESSION['facebook_info'])) {
//       pr($_SESSION['facebook_info']);die('here');
            $this->set('facebook_info', $_SESSION['facebook_info']);
        }
        if (!empty($_SESSION['linkedIn_info'])) {
            // pr($this->params['named']['gplus_info']); die;
            $this->set('linkedIn_info', $_SESSION['linkedIn_info']);
        }
        $this->layout = 'front';
        $this->loadModel('User');
        $this->loadModel('Admin');
        $this->loadModel('AdminNotification');
        $x = uniqid();
        $y = $this->generateRandomString();
        $emp_token = $x . $y;
        $admin = $this->Admin->find('first');
        if ($this->request->is('post')) {
            $this->User->set($this->request->data);
            if ($this->User->validates()) {
                if (!isset($_SESSION['google_data']) and !isset($_SESSION['facebook_info']) and !isset($_SESSION['linkedIn_info'])) {
                    $this->request->data['User']['status'] = 0;
                } else {
                    $this->request->data['User']['status'] = 1;
                }
                if (isset($_SESSION['facebook_info']) && !empty($_SESSION['facebook_info'])) {
                    $this->request->data['User']['facebook_id'] = $_SESSION['facebook_info']['id'];
                }
                if (isset($_SESSION['linkedIn_info']) && !empty($_SESSION['linkedIn_info'])) {
                    $this->request->data['User']['linkedin_id'] = $_SESSION['linkedIn_info']->id;
                }
                if (isset($_SESSION['google_data']) && !empty($_SESSION['google_data'])) {
                    $this->request->data['User']['googleplus_id'] = $_SESSION['google_data']['id'];
                }
                $this->request->data['User']['token'] = $emp_token;
                $password = $this->request->data['User']['password'];
                $hpassword = Security::hash($password, null, true);
                $this->request->data['User']['password'] = $hpassword;
                $data = $this->request->data;
                if (!empty($this->request->data['User']['agree']) and $this->request->data['User']['agree'] = 'on') {
                    if ($this->User->save($data)) {
                        $user_id = $this->User->getLastInsertId();
                        if (!isset($_SESSION['google_data']) and !isset($_SESSION['facebook_info']) and !isset($_SESSION['linkedIn_info'])) {
                            $Email = new CakeEmail();
                            $Email->template('employer');
                            $Email->emailFormat('html');
                            $Email->viewVars(array('tocken' => $emp_token, 'data' => $data));
                            $Email->from(array('info@jobider.com' => 'www.jobider.com'));
                            $Email->to($data['User']['email']);
                            $Email->to($data['User']['email']);
                            $Email->subject('Jobider - No reply', 'success');
                            //$this->set('data', $data);
                            $Email->send();
                            /* Email For Admin */
                            $Email->template('admin_data');
                            $Email->emailFormat('html');
                            $Email->viewVars(array('data' => $data));
                            $Email->from(array('info@jobider.com' => 'www.jobider.com'));
                            $Email->to($admin['Admin']['email']);
                            $Email->subject('Jobider - No reply', 'success');
                            $Email->send();
                            $admin_data['AdminNotification']['admin_id'] = $admin['Admin']['id'];
                            $admin_data['AdminNotification']['user_id'] = $user_id;
                            $admin_data['AdminNotification']['message'] = $data['User']['first_name'] . ' has  newly registered on jobider as a  ' . $data['User']['type'];
                            $this->AdminNotification->save($admin_data);
                            $this->Session->setFlash('Please check your email address.
A confirmation email has been sent to your email address. Click on the confirmation link in the email to activate your account. Please check your spam folder in case you don`t find the message in Inbox.', 'success');
                            return $this->redirect(array('action' => 'index'));
                        }
                        $Email = new CakeEmail();
                        $Email->template('admin_data');
                        $Email->emailFormat('html');
                        $Email->viewVars(array('data' => $data));
                        $Email->from(array('info@jobider.com' => 'www.jobider.com'));
                        $Email->to($admin['Admin']['email']);
                        $Email->subject('Jobider - No reply', 'success');
                        $Email->send();
                        $admin_data['AdminNotification']['admin_id'] = $admin['Admin']['id'];
                        $admin_data['AdminNotification']['user_id'] = $user_id;
                        $admin_data['AdminNotification']['message'] = $data['User']['first_name'] . ' has  newly registered on jobider as a  ' . $data['User']['type'];
                        $this->AdminNotification->save($admin_data);
                        unset($_SESSION['facebook_info']);
                        unset($_SESSION['google_data']);
                        unset($_SESSION['linkedIn_info']);
                        $this->Session->setFlash('You have registered successfully', 'success');
                        return $this->redirect(array('controller' => 'login', 'action' => 'index'));
                    }
                } else {
                    $this->Session->setFlash('Please check the terms and conditions.', 'error');
                }
            } else {
                $errors = $this->User->validationErrors;
            }
        }
    }

    /* Users Freelancer Sign Up Function */

    public function freelancer() {
        $this->loadModel('User');
        $this->layout = 'front';
        $this->loadModel('Country');
        $this->loadModel('Admin');
        $this->loadModel('AdminNotification');
        $find = $this->Country->find('list', array('fields' => 'Country.name'));
        $this->set('find', $find);
        $x = uniqid();
        $y = $this->generateRandomString();
        $token = $x . $y;
        $admin = $this->Admin->find('first');
        $current_date = date('Y-m-d');
        if ($this->request->is('post')) {
            $this->User->set($this->request->data);
            if ($this->User->validates()) {
                //pr($this->request->data); die;
                $this->request->data['User']['status'] = 0;
                $this->request->data['User']['token'] = $token;
                $this->request->data['User']['total_jobs'] = '10';
                $this->request->data['User']['jobs_in_account'] = '0';
                $this->request->data['User']['available'] = '10';
                $password = $this->request->data['User']['password'];
                $hpassword = Security::hash($password, null, true);
                $this->request->data['User']['password'] = $hpassword;
                if ($this->request->data['User']['employer_type'] == 'company') {
                    $this->request->data['User']['employer_type'] = $this->request->data['User']['employer_type'];
                    $this->request->data['User']['company'] = $this->request->data['User']['company_name'];
                    $this->request->data['User']['connects'] = '50';
                    $this->request->data['User']['membership_type'] = 'free';
                    $this->request->data['User']['add_time'] = $current_date;
                } else {
                    $this->Session->setFlash('Please select the user type ', 'error');
                }
                if ($this->request->data['User']['employer_type'] == 'individual') {
                    $this->request->data['User']['connects'] = '50';
                    $this->request->data['User']['membership_type'] = 'free';

                    $this->request->data['User']['add_time'] = $current_date;
                    $this->request->data['User']['employer_type'] = $this->request->data['User']['employer_type'];
                } else {
                    $this->Session->setFlash('Please select the user type', 'error');
                }
                $data = $this->request->data;
                $this->set($data);
                if (!empty($data['User']['agree']) and $data['User']['agree'] == 'on') {
                    if ($this->User->save($data)) {
                        $user_id = $this->User->getLastInsertId();
                        $Email = new CakeEmail();
                        $Email->template('employer');
                        $Email->emailFormat('html');
                        $Email->viewVars(array('tocken' => $token, 'data' => $data));
                        $Email->from(array('info@jobider.com' => 'www.jobider.com'));
                        $Email->to($data['User']['email']);
//                        $Email->subject('Congratulations you are Successfully Registered.', 'success');
                        $Email->subject('Jobider - No Reply', 'success');
                        $Email->send();

                        $Email->template('admin_data');
                        $Email->emailFormat('html');
                        $Email->viewVars(array('data' => $data));
                        $Email->from(array('info@jobider.com' => 'www.jobider.com'));
                        $Email->to($admin['Admin']['email']);
                        $Email->subject('Jobider - No reply', 'success');
                        $Email->send();
                        $admin_data['AdminNotification']['admin_id'] = $admin['Admin']['id'];
                        $admin_data['AdminNotification']['user_id'] = $user_id;
                        $admin_data['AdminNotification']['message'] = $data['User']['first_name'] . ' has  newly registered on jobider as a  ' . $data['User']['type'];
                        $this->AdminNotification->save($admin_data);
                        $this->Session->setFlash('Please check your email address.
A confirmation email has been sent to your email address. Click on the confirmation link in the email to activate your account.', 'success');
                        return $this->redirect(array('action' => 'index'));
                    }
                } else {
                    $this->Session->setFlash('Please check the terms and conditions.', 'error');
                    // return $this->redirect(array('action' => 'freelancer'));
                }
            } else {
                $errors = $this->User->validationErrors;
                //pr($errors);die;
                //$this->Session->setFlash('Unable to add Freelancer User.','error');
            }
        }
    }

    /* Users Activate On  Click Function */

    public function activationlink($token) {
        $find_user = $this->User->find('first', array('conditions' => array('token' => $token)));
        $x = uniqid();
        $y = $this->generateRandomString();
        $new_token = $x . $y;
        // pr($find_user);die;
        if (!empty($find_user)) {
            $u_id = $find_user['User']['id'];
            $this->User->id = $u_id;
            $this->User->status = 1;
            $dataToSave['User']['status'] = 1;
            $dataToSave['User']['token'] = $new_token;
            if ($this->User->save($dataToSave)) {
                $this->Session->setFlash('Your account Successfully activated.', 'success');
                return $this->redirect(array('controller' => 'login', 'action' => 'index'));
            }
        } else {
            $this->Session->setFlash('Your account already activated.', 'error');
            return $this->redirect(array('controller' => 'login', 'action' => 'index'));
        }
    }

    //****************** Admin Pannel **************************//
    /* Users Webadmin index Function */
    public function webadmin_index() {
        $this->layout = 'admin_main';
        if (!empty($this->request->data)) {
            if (!empty($this->request->data['User']['search'])) {
                $this->paginate = array('limit' => 4, 'conditions' => array('OR' => array('User.first_name' => $this->request->data['User']['search'], 'User.last_name' => $this->request->data['User']['search'], 'User.email' => $this->request->data['User']['search']), 'AND' => array('User.type' => 'freelancer')), 'order' => array('User.id' => 'asc'));
                $search = $this->paginate('User');
                $this->set('blog', $search);
                $test = $this->request->data['User']['search'];
                $this->set('text', $test);
            } else {
                $this->paginate = array('limit' => 4, 'conditions' => array('User.type' => 'freelancer'), 'order' => array('User.id' => 'asc'));
                $search = $this->paginate('User');
                $this->set('blog', $search);
            }
        } else {
            $this->paginate = array('limit' => 4, 'conditions' => array('User.type' => 'freelancer'), 'order' => array('User.id' => 'asc'));
            $search = $this->paginate('User');
//            pr($search);
//            die('djfjdsjd');
            $this->set('blog', $search);
        }
    }

    /* Users Webadmin Change Status Function */

    public function webadmin_change_status($id) {
        $this->autoRender = false;
        $this->loadModel('User');
        $this->User->recursive=-1;
        $find = $this->User->findById($id);
       // pr($find); 
        if ($find['User']['status'] == '1') {
            $use = '0';
        } else {
            $use = '1';
        }
        $this->request->data['User']['status'] = $use;
        $this->User->id = $id;
        //pr($this->request->data); die;
        $this->set($this->request->data);
        if ($this->User->save($this->request->data)) {
            $this->Session->setFlash('Users status change successfully', 'success');
            if ($find['User']['type'] == 'client') {
                $this->redirect(array('controller' => 'users', 'action' => 'employer'));
            }
            if ($find['User']['type'] == 'freelancer') {
                $this->redirect(array('controller' => 'users', 'action' => 'index'));
            }
        }
    }

    /* Users Webadmin Edit Function */

    public function webadmin_edit($id = NULL) {
        $this->layout = 'admin_main';
        $user = $this->User->find('first', array('conditions' => array('User.id' => $id)));
        //pr($user);
        $this->set('user', $user);
        if ($this->request->is('post')) {
            $this->User->id = $id;
            $this->set($this->request->data);
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash('Users updated successfully', 'success');
                if ($this->request->data['User']['type'] == 'freelancer') {
                    $this->redirect('/webadmin/users');
                }
                if ($this->request->data['User']['type'] == 'client') {
                    $this->redirect('/webadmin/users/employer');
                }
            }
        }
    }

    /* Users Webadmin Delete Function */

    public function webadmin_delete($id=null) {

        $this->autoRender = false;
        $this->loadModel('User');
        $this->User->recursive=-1;   
        $user = $this->User->findById($id);
        //pr($user);
        if($this->User->delete($id)) {
            if ($user['User']['type'] == 'freelancer') {
                $this->redirect('/webadmin/users');
            }
            if ($user['User']['type'] == 'client') {
                $this->redirect('/webadmin/users/employer');
            }
        }
    }

    /* Users Webadmin Changeselectall Function */

    public function webadmin_changeselectall() {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $this->User->type = $this->request->data['User']['type'];
            $catAr = $this->request->data['User']['chk1'];
            pr($catAr); 
            die('here');
            if (!empty($catAr)) {
                if ($this->request->data['User']['select'] == 'active') {
                    foreach ($catAr as $v) {
                        $this->request->data['User']['status'] = '1';
                        $this->User->id = $v;
                        $this->User->save($this->request->data);
                    }
                    $this->Session->setFlash('Users status activated successfully', 'success');
                } elseif ($this->request->data['User']['select'] == 'inactive') {
                    foreach ($catAr as $v) {
                        $this->request->data['User']['status'] = '0';
                        $this->User->id = $v;
                        $this->User->save($this->request->data);
                    }
                    $this->Session->setFlash('Users status deactivated successfully', 'success');
                } elseif ($this->request->data['User']['select'] == 'delete') {
                    foreach ($catAr as $v) {
                        $this->User->delete($v);
                    }
                    $this->Session->setFlash('Users deleted successfully', 'success');
                }
                if ($this->request->data['User']['type'] == 'freelancer') {
                    $this->redirect('/webadmin/users');
                }
                if ($this->request->data['User']['type'] == 'client') {
                    $this->redirect('/webadmin/users/employer');
                }
            }
        }
    }

    /* Users Webadmin Employer Function */

    public function webadmin_employer() {
        $this->layout = 'admin_main';
        if (!empty($this->request->data)) {
            if (!empty($this->request->data['User']['search'])) {
                $this->paginate = array('limit' => 4, 'conditions' => array('OR' => array('User.first_name' => $this->request->data['User']['search'], 'User.last_name' => $this->request->data['User']['search'], 'User.email' => $this->request->data['User']['search']), 'AND' => array('User.type' => 'client')), 'order' => array('User.id' => 'asc'));
                $search = $this->paginate('User');
                $this->set('blog', $search);
                $test = $this->request->data['User']['search'];
                $this->set('text', $test);
            } else {
                $this->paginate = array('limit' => 5, 'conditions' => array('User.type' => 'client'), 'order' => array('User.id' => 'asc'));
                $search = $this->paginate('User');
                $this->set('blog', $search);
            }
        } else {
            $this->paginate = array('limit' => 5, 'conditions' => array('User.type' => 'client'), 'order' => array('User.id' => 'asc'));
            $search = $this->paginate('User');
            $this->set('blog', $search);
        }
    }

    /* Users Webadmin Change Password Function */

    public function webadmin_changepassword() {
        $this->layout = 'admin_main';
        $this->loadModel('Admin');
        $session = $this->Session->read();

        $admin = $session['Auth']['Admin']['id'];
        $use_data = $this->Admin->find('first', array('conditions' => array('Admin.id' => $admin)));
        $this->set('user_data', $use_data);
        if ($this->request->is('post')) {
            $this->User->set($this->request->data);
            $password_back = $this->request->data['Admin']['old_password'];
            $hpassword_back = Security::hash($password_back, null, true);
            $this->request->data['Admin']['old_password'] = $hpassword_back;
            if ($this->request->data['Admin']['old_password'] == $use_data['Admin']['password']) {
                if ($this->request->data['Admin']['new_password'] == $this->request->data['Admin']['confirm_password']) {
                    $password_will_be = $this->request->data['Admin']['new_password'];
                    $hpassword_back_with = Security::hash($password_will_be, null, true);
                    $this->request->data['Admin']['new_password'] = $hpassword_back_with;
                    $this->request->data['Admin']['password'] = $this->request->data['Admin']['new_password'];
                    $this->Admin->id = $admin;
                    $this->set($this->request->data);
                    if ($this->Admin->save($this->request->data)) {
                        $this->Session->setFlash('Password Successfully Changed', 'success');
                        $this->redirect(array('controller' => 'users', 'action' => 'changepassword'));
                    } else {
                        $this->Session->setFlash('Password Does Not Change, Please Try Again', 'error');
                    }
                } else {
                    $this->Session->setFlash('Password Does Not Match , Please Enter The Correct Password', 'error_unverify');
                }
            }

//            else {
//                $this->Session->setFlash('Please Fill all the fields', 'error_unverify');
//            }
        }
    }

    public function webadmin_membership_plan($id = null) {
        $this->layout = 'admin_main';
        $this->loadModel('User');
        $this->loadModel('Membershipplan');
        $Find_user_record = $this->User->find('first',array('conditions'=>array('User.id'=>$id)));
      if(!empty($Find_user_record)){
           $total_connects = $Find_user_record['User']['connects'];
           $used_connects = $Find_user_record['User']['used_connects'];
           $available_connects = $total_connects - $used_connects;
           $member = $this->Membershipplan->find('first',array('conditions'=>array('Membershipplan.user_id'=>$id)));
           $this->set('available_connects',$available_connects);
           $this->set('User_data',$Find_user_record);
           $this->set('result',$member);
       }
        
    }

}