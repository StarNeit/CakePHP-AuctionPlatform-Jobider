<?php

App::uses('CakeEmail', 'Network/Email');

class ClientController extends AppController {

    public function beforeFilter() {  
        parent::beforeFilter();
        $this->Auth->allow(array('index', 'paypal_notify', 'payment_notify', 'viewpost', 'view_ended_contract','postajob'));
    }

    /* Client Index Function */

    public function index() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {

            $this->layout = 'front';
            $this->loadModel('User');
            $this->loadModel('Jobdetail');
            $this->loadModel('Job');
            $this->loadModel('Hire');
            $this->loadModel('Category');
            $this->loadModel('Message');
            $this->loadModel('Acceptinterview');
            $user_id = $this->Auth->User('id');
            $this->paginate = array('limit' => 4, 'conditions' => array('Hire.hiring_id' => $user_id));
            $hire_freelancers = $this->Paginate('Hire');
            $all_categories = $this->Category->find('all', array('conditions' => array('Category.status' => 1)));
            foreach ($all_categories as $k => $val) {
                $cat_id = $val['Category']['id'];
                $all_jobs_category = $this->Job->find('all', array('conditions' => array('Job.category_id' => $cat_id)));

                $count = count($all_jobs_category);
                $all_categories[$k]['jobs'] = $count;
                $text = '';
                foreach ($all_jobs_category as $key => $vv) {
                    $crnt_date = time();
                    $selected = strtotime($vv['Job']['created']);
                    $diff = $crnt_date - $selected;
                    $date = $this->secondsToTime($diff);
                    $text = 'on ' . $date['d'] . ' days ' . $date['h'] . ' hours ago';
                }
                $all_categories[$k]['time_duration'] = $text;
            }
            $this->paginate = array('limit' => 5, 'conditions' => array('Job.user_id' => $user_id), 'group' => 'Job.job_title');
            $applied_jobs = $this->Paginate('Job');
            foreach ($applied_jobs as $kk => $vv) {
                $job_id = $vv['Job']['id'];
                $hiring_data = $this->Hire->find('count', array('conditions' => array('Hire.job_id' => $job_id, 'Hire.hiring_id' => $user_id)));
                $accept_data = $this->Acceptinterview->find('count', array('conditions' => array('Acceptinterview.job_id' => $job_id, 'Acceptinterview.decline_status' => '')));

                $applied_count = $this->Jobdetail->find('count', array('conditions' => array('Jobdetail.job_id' => $job_id, 'Jobdetail.decline_status' => '')));
                // pr($applied_count);
                $invite_count = $this->Acceptinterview->find('count', array('conditions' => array('Acceptinterview.job_id' => $job_id, 'Acceptinterview.decline_status' => '')));

                $total_invitation = $applied_count + $invite_count;
                $applied_jobs[$kk]['Job']['hire_user'] = $hiring_data;
                $applied_jobs[$kk]['Job']['messaged'] = $accept_data;
                $applied_jobs[$kk]['Job']['applicants'] = $total_invitation;
            }

            $this->set('appliedJobs', $applied_jobs);
            $this->set('Category_data', $all_categories);
            $this->set('Hired_freelancer', $hire_freelancers);
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Index Function */

    /* Client Post a job Function */

    public function postajob() {
        //pr($_SESSION);
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'front';
            $sess = $this->Session->read();
            $use_id = $sess['Auth']['User']['id'];
            $user_type = $sess['Auth']['User']['type'];
            $this->loadModel('Category');
            $this->loadModel('Job');
            $this->loadModel('Subcategory');
            $this->loadModel('Subskill');
            $this->loadModel('User');
            $this->loadModel('Admin');
            $client = $this->User->find('first', array('conditions' => array('User.id' => $use_id)));
            $admin_data = $this->Admin->find('first');
            $session_data = $this->Session->read('session_post_data');
            //pr($session_data);
            $skills = explode(',', $session_data['Job']['skills']);
            $subskill = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $skills)));
            $skill_name = array();
            foreach ($subskill as $k => $v) {
                $skill_name[] = $v['Subskill']['skill_name'];
            }
            $skill_data = implode(',', $skill_name);
            $this->set('subskill', $skill_data);
            $category = $this->Category->find('all', array('fields' => 'Category.name', 'Category.id'));
            $this->set('category', $category);
            $category_data = $this->Category->find('first', array('conditions' => array('Category.id' => $session_data['Job']['category_id']), 'fields' => 'Category.name'));
            $this->set('category_data', $category_data);
            if (isset($category_data['Category']['id'])) {
                $subcategory = $this->Subcategory->find('all', array('conditions' => array('Subcategory.category_id' => $category_data['Category']['id']), 'fields' => array('Subcategory.category_name', 'Subcategory.id')));
                $this->set('subcategory', $subcategory);
            }
            $subcategory_data = $this->Subcategory->find('first', array('conditions' => array('Subcategory.id' => $session_data['Job']['subcategory_id'])));
            $this->set('subcategory_data', $subcategory_data);
            if ($this->request->is('post')) {
             //pr($session_data);
               // pr($this->request->data);die;
                $this->Job->set($this->request->data);
                if ($this->Job->validates()) {
                    if (isset($session_data['Job']['image_names']) and !empty($session_data['Job']['image_names'])) {
                        $this->request->data['Job']['image'] = $session_data['Job']['image_names']['name'];
                    } else {
 if (move_uploaded_file($this->request->data['Job']['image_names']['tmp_name'], WWW_ROOT . 'uploads/' . $this->request->data['Job']['image_names']['name']))
                            ;
                        $this->request->data['Job']['image'] = $this->request->data['Job']['image_names']['name'];
                    }
                    $skills = explode(',', $this->request->data['Job']['skills']);
                    $subskill = $this->Subskill->find('all', array('conditions' => array('Subskill.skill_name' => $skills), 'fields' => 'Subskill.id'));
                    $subskil = array();
                    foreach ($subskill as $val) {
                        $subskil[] = $val['Subskill']['id'];
                    }
                    $subskill_ids = implode(',', $subskil);
                    $additional_question = implode(',', $this->request->data['Job']['additional_question']);
                    $this->request->data['Job']['user_id'] = $use_id;
                    $this->request->data['Job']['posted_by'] = $user_type;
                    $this->request->data['Job']['additional_question'] = $additional_question;
                    $this->request->data['Job']['addedon'] = time();
                    if (isset($session_data['Job']['skills']) && !empty($session_data['Job']['skills'])) {
                        $this->request->data['Job']['skills'] = $session_data['Job']['skills'];
                    } else {
                        $this->request->data['Job']['skills'] = $subskill_ids;
                    }
                    $this->set($this->request->data);
                    if (isset($_POST['preview']) && ($_POST['preview'] == 'preview')) {
                        $this->Session->write('post_data', $this->request->data);
                        $this->redirect('/client/preview');
                    }
                    if (isset($_POST['add']) && ($_POST['add'] == 'add')) {
                        $data = $this->request->data;
                        if ($this->Job->save($this->request->data)) {
                            $job_id = $this->Job->getLastInsertId();
                            $Email = new CakeEmail();
                            $Email->template('posted');
                            $Email->emailFormat('html');
                            $Email->viewVars(array('data' => $data['Job']['job_title'], 'client_fname' => $client['User']['first_name'], 'client_lname' => $client['User']['last_name'], 'Job_id' => $job_id));
                            $Email->from(array('info@jobider.com' => $client['User']['first_name'] . '  ' . $client['User']['last_name'] . '  via  Jobider'));
                            $Email->to($client['User']['email']);
                            $Email->subject($data['Job']['job_title'], 'success');
                            $Email->send();
                            $Email->template('posted');
                            $Email->emailFormat('html');
                            $Email->viewVars(array('data' => $data['Job']['job_title'], 'client_fname' => $client['User']['first_name'], 'client_lname' => $client['User']['last_name'], 'Job_id' => $job_id));
                            $Email->from(array('info@jobider.com' => $client['User']['first_name'] . '  ' . $client['User']['last_name'] . '  via  Jobider'));
                            $Email->to($admin_data['Admin']['email']);
                            $Email->subject($data['Job']['job_title'], 'success');
                            $Email->send();
                            $this->Session->setFlash('Success! Your Job Has Submitted', 'success');
                            $this->Session->delete('session_post_data');
                            $this->redirect('/client/postedJobs');
                        }
                    }
                } else {
                    $this->Job->errorValidations;
                }
            }
        } else {
            //echo "stop here"; die;
            $this->redirect('/login');
        }
    }

    /* Client Post a job Function */

    /* Client Posted Jobs Function */

    public function postedJobs() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'front';
            $this->loadModel('Job');
            $user_id = $_SESSION['Auth']['User']['id'];
            $this->paginate = array('limit' => 4, 'conditions' => array('AND' => array('Job.user_id' => $user_id, 'Job.status' => 1)), 'order' => 'Job.id DESC');
            $Posted_Jobs = $this->paginate('Job');
            foreach ($Posted_Jobs as $kk => $vv) {
                $crnt_date = time();
                $selected = strtotime($vv['Job']['created']);
                $diff = $crnt_date - $selected;
                $date = $this->secondsToTime($diff);
                if ($date['d'] == '0' and $date['h'] == '0') {
                    $text = 'Job Posted on ' . $date['s'] . ' seconds ago';
                } elseif ($date['h'] != '0' and $date['d'] == '0') {
                    $text = 'Job Posted on ' . $date['h'] . ' hours ' . $date['s'] . ' seconds ago';
                } elseif ($date['d'] > 0) {
                    $text = 'Job Posted on ' . $date['d'] . ' days ' . $date['h'] . ' hours ago';
                }
                $Posted_Jobs[$kk]['Job']['time_duration'] = $text;
            }
            $this->set('postedJobs', $Posted_Jobs);
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Posted Jobs Function */

    /* Second  To Time Function */

    function secondsToTime($inputSeconds) {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $secondsInAMinute = 60;
            $secondsInAnHour = 60 * $secondsInAMinute;
            $secondsInADay = 24 * $secondsInAnHour;

// extract days
            $days = floor($inputSeconds / $secondsInADay);

// extract hours
            $hourSeconds = $inputSeconds % $secondsInADay;
            $hours = floor($hourSeconds / $secondsInAnHour);

// extract minutes
            $minuteSeconds = $hourSeconds % $secondsInAnHour;
            $minutes = floor($minuteSeconds / $secondsInAMinute);

// extract the remaining seconds
            $remainingSeconds = $minuteSeconds % $secondsInAMinute;
            $seconds = ceil($remainingSeconds);

// return the final array
            $obj = array(
                'd' => (int) $days,
                'h' => (int) $hours,
                'm' => (int) $minutes,
                's' => (int) $seconds,
            );
            return $obj;
        } else {
            $this->redirect('/login');
        }
    }

    /* Second  To Time Function */

    /* Client View Post Function */

    public function viewpost($id = NULL) {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'front';
            $this->loadModel('Job');
            $this->loadModel('Jobdetail');
            $this->loadModel('User');
            $this->loadModel('Country');
            $this->loadModel('Category');
            $this->loadModel('Subcategory');
            $this->loadModel('Subskill');
            $this->loadModel('Paypalpayment');
            $this->loadModel('Creditpayment');
            $this->loadModel('Projectfeedback');
            $this->loadModel('Hire');
            $last_url = $this->referer();
            $this->set('last_url', $last_url);
            $c_id = $this->Auth->user('country_id');
            $user_id = $this->Auth->user('id');
            $jobs = $this->Job->find('first', array('conditions' => array('Job.id' => $id, 'Job.status' => 1)));

            $feedback = $this->Projectfeedback->find('first', array('conditions' => array('Projectfeedback.job_id' => $id, 'Projectfeedback.user_type' => 'freelancer')));
            if (!empty($feedback)) {
                $count_data = count($feedback['Projectfeedback']['feedback']);
                $this->set('counts', $count_data);
            }
            $this->set('feedback', $feedback);
            $credit = $this->Creditpayment->find('all', array('conditions' => array('Creditpayment.client_id' => $user_id)));
            $payment = $this->Paypalpayment->find('all', array('conditions' => array('Paypalpayment.client_id' => $user_id)));
            $amount_detail = array_merge($credit, $payment);
            $pay = array();
            foreach ($amount_detail as $k => $v) {
                if (array_key_exists('Paypalpayment', $v)) {
                    $pay[] = $v['Paypalpayment']['payment_amount'];
                }
                if (array_key_exists('Creditpayment', $v)) {
                    $pay[] = $v['Creditpayment']['amount'];
                }
            }
            if (!empty($pay)) {
                $amount = array_sum($pay);
                $this->set('pay', $amount);
            }
            $hire_data = $this->Hire->find('all', array('conditions' => array('Hire.hiring_id' => $user_id)));
            $hire_count = count($hire_data);
            $Job_id = array();
            foreach ($hire_data as $kk => $vv) {
                $Job_id[] = $vv['Hire']['job_id'];
            }
            $all_open_jobs = $this->Job->find('all', array('conditions' => array('Job.id !=' => $Job_id, 'Job.user_id' => $user_id)));
            $open_jobs = count($all_open_jobs);
            $this->set('open_jobs', $open_jobs);
            $this->set('hire_count', $hire_count);
            if (!empty($jobs)) {
                $user_id = $jobs['Job']['user_id'];
                $users = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
                $country_id = $users['User']['country_id'];
                $country_name = $this->Country->find('first', array('conditions' => array('Country.id' => $country_id), 'fields' => array('Country.name')));
                $this->set('country_name', $country_name);
                $this->set('users', $users);
                $skills = $jobs['Job']['skills'];
                $Skills = explode(',', $skills);
                $subskill = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $Skills)));
                $category_data = $this->Category->find('first', array('conditions' => array('Category.id' => $jobs['Job']['category_id'])));
                $Subcategory_data = $this->Subcategory->find('first', array('conditions' => array('Subcategory.id' => $jobs['Job']['subcategory_id'])));
                $category = $this->Subcategory->find('first', array('conditions' => array('Subcategory.id' => $jobs['Job']['subcategory_id'])));
                $this->set('category', $category);
                $selected = strtotime($jobs['Job']['created']);
                $crnt_date = time();
                $diff = $crnt_date - $selected;
                $date = $this->secondsToTime($diff);
                $text = 'Posted ' . $date['s'] . ' seconds ago';
                $jobs['Job']['time_duration'] = $text;
                $this->set('skill', $subskill);
                $this->set('subcategory_data', $Subcategory_data);
                $this->set('category_data', $category_data);
            }
            $jobs_all = $this->Job->find('all', array('conditions' => array('Job.id !=' => $id, 'Job.status' => 1, 'Job.user_id' => $user_id), 'fields' => array('Job.id', 'Job.job_title'), 'order' => 'Job.id DESC'));
            $jobs_count = $this->Job->find('all', array('conditions' => array('Job.status' => 1, 'Job.user_id' => $user_id), 'fields' => array('Job.id', 'Job.job_title'), 'order' => 'Job.id DESC'));
            $cnt = count($jobs_count);
            $client_details = $this->User->find('first', array('conditions' => array('User.id' => $user_id, 'User.status' => 1)));
            $country_id = $client_details['User']['country_id'];
            $Country_data = $this->Country->find('first', array('Country.id' => $c_id, 'Country.status' => 1, 'fields' => array('Country.name')));
            $this->Session->write('job_id', $id);
            $this->set('Jobresult', $jobs);
            $this->set('clientinfo', $client_details);
            $this->set('client_country', $Country_data);
            $this->set('OtherOpenJobs', $jobs_all);
            $this->set('count', $cnt);
        } else {
            $this->redirect('/login');
        }
    }

    /* Client View Post Function */

    /* Client Edit Job Function */

    public function editjob($id = NULL) {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'front';
            $this->loadModel('Category');
            $this->loadModel('Job');
            $this->loadModel('Subskill');
            $this->loadModel('Subcategory');
            $this->loadModel('User');
            $this->loadModel('Admin');
            $session = $this->Session->read();
            $user_id = $session['Auth']['User']['id'];
            $category = $this->Category->find('all', array('fields' => 'Category.name', 'Category.id'));
            $admin_data = $this->Admin->find('first');
            $client = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
            $subcategory = $this->Subcategory->find('list', array('fields' => 'Subcategory.category_name'));
            $job_data = $this->Job->find('first', array('conditions' => array('Job.id' => $id)));
            if (!empty($job_data)) {
                $additional = explode(',', $job_data['Job']['additional_question']);
                $skills = explode(',', $job_data['Job']['skills']);
                $skill_data = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $skills)));
                $skills_name = array();
                foreach ($skill_data as $k => $val) {
                    $skills_name[] = $val['Subskill']['skill_name'];
                }
                $skill_name = implode(',', $skills_name);
                $category_data = $this->Category->find('first', array('conditions' => array('Category.id' => $job_data['Job']['category_id'])));
                $this->set('category_data', $category_data);
                $subcategory_data = $this->Subcategory->find('first', array('conditions' => array('Subcategory.id' => $job_data['Job']['subcategory_id'])));
                $this->set('subcategory_data', $subcategory_data);
                $this->set('skills', $skill_name);
                $this->set('category', $category);
                $this->set('subcategory', $subcategory);
                $this->set('additional', $additional);
            }
            $this->set('job', $job_data);

            if ($this->request->is('post')) {
                if ($this->Job->validates()) {
                    if (!empty($job_data['Job']['image'])) {
                        $this->request->data['Job']['image'] = $job_data['Job']['image'];
                    } else {
                        $this->request->data['Job']['image'] = $this->request->data['Job']['image_names']['name'];
                        if (move_uploaded_file($this->request->data['Job']['image_names']['tmp_name'], WWW_ROOT . 'uploads/' . $this->request->data['Job']['image_names']['name']))
                            ;
                    }
                    $skills = explode(',', $this->request->data['Job']['skills']);

                    $subskill = $this->Subskill->find('all', array('conditions' => array('Subskill.skill_name' => $skills), 'fields' => 'Subskill.id'));

                    $subskil = array();
                    foreach ($subskill as $val) {
                        $subskil[] = $val['Subskill']['id'];
                    }
                    $subskill_ids = implode(',', $subskil);
                    $additional_questions = implode(',', $this->request->data['Job']['additional_question']);

                    $this->request->data['Job']['user_id'] = $user_id;
                    $this->request->data['Job']['skills'] = $subskill_ids;
                    $this->request->data['Job']['additional_question'] = $additional_questions;
                    $this->set($this->request->data);
                    $this->Job->id = $id;
                    $data = $this->request->data;
                    if ($this->Job->save($this->request->data)) {

                        $Email = new CakeEmail();
                        $Email->template('posted_edit');
                        $Email->emailFormat('html');
                        $Email->viewVars(array('data' => $data['Job']['job_title'], 'client_fname' => $client['User']['first_name'], 'client_lname' => $client['User']['last_name'], 'Job_id' => $id));
                        $Email->from(array('info@jobider.com' => $client['User']['first_name'] . '  ' . $client['User']['last_name'] . '  via  Jobider'));
                        $Email->to($client['User']['email']);
                        $Email->subject($data['Job']['job_title'], 'success');
                        $Email->send();
                        $Email->template('posted_edit');
                        $Email->emailFormat('html');
                        $Email->viewVars(array('data' => $data['Job']['job_title'], 'client_fname' => $client['User']['first_name'], 'client_lname' => $client['User']['last_name'], 'Job_id' => $id));
                        $Email->from(array('info@jobider.com' => $client['User']['first_name'] . '  ' . $client['User']['last_name'] . '  via  Jobider'));
                        $Email->to($admin_data['Admin']['email']);
                        $Email->subject($data['Job']['job_title'], 'success');
                        $Email->send();
                        $this->Session->setFlash('Success! Your Job Has Submitted', 'success');
                        $this->redirect('/client/postedJobs');
                    }
                } else {
                    $this->Job->validationErrors;
                }
            }
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Edit Job Function */


    /* Client Delete Function */

    public function deletejob($id) {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
           // pr($id); die;
            $this->autoRender = false;
            $this->loadModel('Job');
            $this->Job->delete($id);
            //$this->Session->setFlash('Job deleted successfully','success');
            $this->redirect(array('controller' => 'client', 'action' => 'postedJobs'));
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Delete Function */

    /* Client Manage Myteam Function */

    public function manageMyTeam() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'front';
            $this->loadModel('Hire');
            $this->loadModel('Country');
            $user_id = $this->Auth->user('id');
            $hire_freelancer = $this->Hire->find('all', array('conditions' => array('Hire.hiring_id' => $user_id)));

            foreach ($hire_freelancer as $k => $v) {
                $c_name = $this->Country->find('first', array('conditions' => array('Country.id' => $v['Hire']['country_id'])));
                $hire_freelancer[$k]['Hire']['c_name'] = $c_name;
            }
            $this->set('freelancer', $hire_freelancer);
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Manage Myteam Function */

    /* Client Membership Plans For Clien Function */

    public function membership_plansfor_client() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'front';
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Membership Plans For Clien Function */

    /* Client Reports Function */

    public function Reports() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'front';
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Reports Function */

    /* Client Showing Work Summary Function */

    public function WorkSummary() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'front';
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Showing Work Summary Function */

    /* Client Showing Mymessages Function */

    public function mymessages() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'front';
            $this->loadModel('Message');
            $this->loadModel('User');
            $this->loadModel('Job');
            $user_id = $this->Auth->user('id');
            $messages = $this->Message->find('all', array(
                'group' => array('Message.sender'),
                'conditions' =>
                array(
                    'OR' => array('Message.status' => array('1', '2')),
                    'AND' => array('Message.reciever' => $user_id),
                )
            ));

            if ($this->request->is('post')) {
                if (isset($_POST['read']) and $_POST['read'] == 'read') {
                    $msg_id = $this->request->data['Message']['chk1'];
                    if (!empty($msg_id)) {
                        foreach ($msg_id as $v) {
                            $this->request->data['Message']['status'] = 2;
                            $this->Message->id = $v;
                            $this->Message->save($this->request->data);
                        }
                        $messages = $this->Message->find('all', array('conditions' => array('AND' => array('Message.reciever' => $user_id))));
                    }
                }
                if (isset($_POST['archive']) and $_POST['archive'] == 'archive') {
                    $mesg_id = $this->request->data['Message']['chk1'];
                    if (!empty($mesg_id)) {
                        foreach ($mesg_id as $va) {
                            $this->request->data['Message']['status'] = 0;
                            $this->Message->id = $va;
                            $this->Message->save($this->request->data);
                        }
                        $messages = $this->Message->find('all', array('conditions' => array('AND' => array('Message.reciever' => $user_id, 'Message.status' => '1'))));
                    }
                }
            }
            $count = $this->Message->find('count', array('conditions' => array('AND' => array('Message.reciever' => $user_id, 'Message.read_status' => '0'))));

            foreach ($messages as $kk => $vv) {
                $freelancer_id = $vv['Message']['sender'];
                $job_id = $vv['Message']['job_id'];
                $this->User->recursive = -1;
                $freelancer = $this->User->find('all', array('conditions' => array('User.id' => $freelancer_id)));
                $this->Job->recursive = -1;
                $jobs_data = $this->Job->find('all', array('conditions' => array('Job.id' => $job_id)));
                $send_msg = count($this->Message->find('all', array('conditions' => array('AND' => array('Message.sender' => $user_id, 'Message.reciever' => $freelancer_id)))));
                $rec_msg = count($this->Message->find('all', array('conditions' => array('AND' => array('Message.sender' => $freelancer_id, 'Message.reciever' => $user_id)))));
                $data_count = $send_msg + $rec_msg;
                $messages[$kk]['Message']['freelancer'] = $freelancer;
                $messages[$kk]['Message']['jobs'] = $jobs_data;
                $messages[$kk]['Message']['msg_count'] = $data_count;
            }

            $this->set('message', $messages);
            $this->set('count_msg', $count);
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Showing Mymessages Function */

    /* Client Send Function */

    public function send() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'front';
            $this->loadModel('Message');
            $this->loadModel('User');
            $this->loadModel('Job');
            $user_id = $this->Auth->user('id');
            $contect_value = $this->Message->find('all', array('conditions' => array('Message.sender' => $user_id), 'group' => 'Message.reciever'));
            foreach ($contect_value as $key => $val) {
                $reciever = $val['Message']['reciever'];
                $job_id = $val['Message']['job_id'];
                $jobs = $this->Job->find('all', array('conditions' => array('Job.id' => $job_id)));
                $user = $this->User->find('all', array('conditions' => array('User.id' => $reciever)));
                $send_msg = count($this->Message->find('all', array('conditions' => array('AND' => array('Message.sender' => $reciever, 'Message.reciever' => $user_id)))));
                $rec_msg = count($this->Message->find('all', array('conditions' => array('AND' => array('Message.sender' => $user_id, 'Message.reciever' => $reciever)))));
                $data_count = $send_msg + $rec_msg;
                $contect_value[$key]['Message']['user'] = $user;
                $contect_value[$key]['Message']['job'] = $jobs;
                $contect_value[$key]['Message']['count'] = $data_count;
            }
            $count = $this->Message->find('count', array('conditions' => array('AND' => array('Message.reciever' => $user_id, 'Message.read_status' => '0'))));
            $this->set('contect_data', $contect_value);
            $this->set('count_msg', $count);
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Send Function */

    /* Client Archeve Message Function */

    public function archieve_message() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'front';
            $this->loadModel('Message');
            $this->loadModel('User');
            $this->loadModel('Job');
            $user_id = $this->Auth->user('id');
            $message_data = $this->Message->find('all', array('conditions' => array('Message.status' => '0', 'Message.reciever' => $user_id)));
            foreach ($message_data as $key => $val) {
                $reciever = $val['Message']['sender'];
                $job_id = $val['Message']['job_id'];
                $jobs = $this->Job->find('all', array('conditions' => array('Job.id' => $job_id)));
                $user = $this->User->find('all', array('conditions' => array('User.id' => $reciever)));
                $message_data[$key]['Message']['user'] = $user;
                $message_data[$key]['Message']['job'] = $jobs;
            }
            $count = $this->Message->find('count', array('conditions' => array('AND' => array('Message.status' => '1', 'Message.reciever' => $user_id))));
            $this->set('contect_data', $message_data);
            $this->set('count_inbox', $count);
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Archeve Message Function */
    /* Client Single Message Function */

    public function single_message($id) {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'front';
            $this->loadModel('Message');
            $this->loadModel('Job');
            $this->loadModel('User');
            $this->loadModel('Admin');
            $user_id = $this->Auth->user('id');
//        echo '<br>'.$id;die;
            $client = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
            $admin_data = $this->Admin->find('first');
            $freelancer = $this->User->find('first', array('conditions' => array('User.id' => $id)));
            $count_inbox = $this->Message->find('count', array('conditions' => array('AND' => array('Message.reciever' => $user_id, 'Message.read_status' => '0'))));
            $messages = $this->Message->find('first', array('conditions' => array('AND' => array('Message.sender' => $user_id, 'Message.reciever' => $id))));
//        pr($messages);
//        die;
            if (!empty($messages['Message']['job_id'])) {
                $find_job = $this->Job->find('first', array('conditions' => array('Job.id' => $messages['Message']['job_id'])));
//            pr($find_job);
//            die;
                $this->set('job_value', $find_job);
            }
            $free_id = $id;
            $this->set('client_message', $messages);
            $this->set('sender_id', $user_id);
            $this->set('receiver_id', $free_id);
            $this->set('count_Inbox', $count_inbox);
            if ($this->request->is('post')) {
                $attachment = $this->request->data['Message']['attach_data'];
                $reply = nl2br($this->request->data['Message']['reply']);
                $this->request->data['Message']['reply'] = $reply;
                $this->request->data['Message']['reply'] = $reply;
                if (!empty($this->request->data['Message']['attach_data'])) {
                    $attchment_path = WWW_ROOT . 'documents/' . $this->request->data['Message']['attach_data']['name'];
                    if (move_uploaded_file($this->request->data['Message']['attach_data']['tmp_name'], $attchment_path))
                        ;
                }
                $this->request->data['Message']['attach_data'] = $this->request->data['Message']['attach_data']['name'];
                $this->request->data['Message']['sender'] = $user_id;
                $this->request->data['Message']['reciever'] = $id;
                $this->request->data['Message']['job_id'] = $find_job['Job']['id'];
                $this->request->data['Message']['status'] = 1;
                $this->request->data['Message']['read_status'] = 0;
                $this->set($this->request->data);
                $data = $this->request->data;
                if ($this->Message->save($this->request->data)) {
                    $Email = new CakeEmail();
                    $Email->template('reply_message');
                    $Email->emailFormat('html');
                    $Email->viewVars(array('data' => $find_job['Job']['job_title'], 'client_fname' => $client['User']['first_name'], 'client_lname' => $client['User']['last_name'], 'Job_id' => $find_job['Job']['id'], 'message' => $data['Message']['reply']));
                    $Email->from(array('info@jobider.com' => $client['User']['first_name'] . '' . $client['User']['last_name'] . 'via Jobider'));
                    $Email->to($freelancer['User']['email']);
                    $Email->subject($find_job['Job']['job_title'], 'success');
                    $Email->attachments(array($attachment['name'] => $attchment_path));
                    $Email->send();
                    $Email->template('reply_message');
                    $Email->emailFormat('html');
                    $Email->viewVars(array('data' => $find_job['Job']['job_title'], 'client_fname' => $client['User']['first_name'], 'client_lname' => $client['User']['last_name'], 'Job_id' => $find_job['Job']['id'], 'message' => $data['Message']['reply']));
                    $Email->from(array('info@jobider.com' => $client['User']['first_name'] . '' . $client['User']['last_name'] . 'via Jobider'));
                    $Email->to($admin_data['Admin']['email']);
                    $Email->subject($find_job['Job']['job_title'], 'success');
                    $Email->send();
                    $this->redirect(array('controller' => 'client', 'action' => 'single_message', $id));
                }
            }
            $array_merge = $this->Message->find('all', array('conditions' => array('AND' => array('Message.sender' => array($id, $user_id), 'Message.reciever' => array($user_id, $id)))));
            asort($array_merge);
            foreach ($array_merge as $kk => $vv) {
                $sender = $vv['Message']['sender'];
                $users = $this->User->find('all', array('conditions' => array('User.id' => $sender)));
                $array_merge[$kk]['Message']['user'] = $users;
            }
            $this->set('user_data', $array_merge);
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Single Message Function */


    /* Client Job Application Function */

    public function job_application($id = null) {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'front';
            $this->loadModel('Contect');
            $this->loadModel('User');
            $this->loadModel('Country');
            $this->loadModel('Subskill');
            $this->loadModel('Acceptinterview');
            $this->loadModel('Hire');
            $this->loadModel('Job');
            $this->loadModel('Admin');
            $client_id = $this->Auth->user('id');
            if (isset($_SESSION['job_id']) and !empty($_SESSION['job_id'])) {
                $job_Id = $_SESSION['job_id'];
                $this->set('job_id', $job_Id);
                $jobs = $this->Hire->find('first', array('conditions' => array('Hire.hiring_id' => $client_id, 'Hire.contractor_id' => $id, 'Hire.job_id' => $job_Id)));
                $find_job = $this->Job->find('first', array('conditions' => array('Job.id' => $job_Id, 'Job.user_id' => $client_id)));
                $client = $this->User->find('first', array('conditions' => array('User.id' => $client_id)));
                $admin_data = $this->Admin->find('first');
                $User_info = $this->User->find('first', array('conditions' => array('User.id' => $id, 'User.type' => 'freelancer')));
                //pr($User_info); 
                $free_id = $User_info['User']['id'];
                $country_id = $User_info['User']['country_id'];
                $user_skills = explode(',', $User_info['User']['skills']);
                $user_country = $this->Country->find('first', array('conditions' => array('Country.id' => $country_id)));
                $Subskill = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $user_skills)));
                $subskil = $this->Subskill->find('all', array('limit' => 3, 'conditions' => array('Subskill.id' => $user_skills)));

                $sub_data = array();
                foreach ($subskil as $kes => $vals) {
                    $sub_data[] = $vals['Subskill']['skill_name'];
                }
                $subskills = implode(',', $sub_data);
                $Contect_info = $this->Contect->find('first', array('conditions' => array('Contect.user_id' => $id, 'Contect.client_id' => $client_id, 'Contect.job_id' => $job_Id)));
                if (!empty($Contect_info)) {
                    $job_id = $Contect_info['Contect']['job_id'];

                    $all_message = $this->Message->find('all', array('conditions' => array('AND' => array('Message.sender' => array($User_info['User']['id'], $client_id), 'Message.reciever' => array($client_id, $User_info['User']['id']), 'Message.job_id' => $Contect_info['Contect']['job_id']))));
                    foreach ($all_message as $kk => $vv) {
                        $sender = $vv['Message']['sender'];
                        $all_users = $this->User->find('all', array('conditions' => array('User.id' => $sender)));
                        $all_message[$kk]['users'] = $all_users;
                    }
                    if ($this->request->is('post')) {
                        $reply = nl2br($this->request->data['Message']['reply']);
                        $this->request->data['Message']['sender'] = $client_id;
                        $this->request->data['Message']['reciever'] = $free_id;
                        $this->request->data['Message']['reply'] = $reply;
                        $this->request->data['Message']['job_id'] = $job_id;
                        $this->request->data['Message']['status'] = 1;
                        $this->request->data['Message']['read_status'] = 0;
                        $this->set($this->request->data);
                        $data = $this->request->data;
                        if ($this->Message->save($this->request->data)) {
                            $Email = new CakeEmail();
                            $Email->template('reply_message');
                            $Email->emailFormat('html');
                            $Email->viewVars(array('data' => $find_job['Job']['job_title'], 'client_fname' => $client['User']['first_name'], 'client_lname' => $client['User']['last_name'], 'Job_id' => $find_job['Job']['id'], 'message' => $data['Message']['reply']));
                            $Email->from(array('info@jobider.com' => $client['User']['first_name'] . '' . $client['User']['last_name'] . 'via Jobider'));
                            $Email->to($User_info['User']['email']);
                            $Email->subject($find_job['Job']['job_title'], 'success');
                            $Email->send();
                            $Email->template('reply_message');
                            $Email->emailFormat('html');
                            $Email->viewVars(array('data' => $find_job['Job']['job_title'], 'client_fname' => $client['User']['first_name'], 'client_lname' => $client['User']['last_name'], 'Job_id' => $find_job['Job']['id'], 'message' => $data['Message']['reply']));
                            $Email->from(array('info@jobider.com' => $client['User']['first_name'] . '' . $client['User']['last_name'] . 'via Jobider'));
                            $Email->to($admin_data['Admin']['email']);
                            $Email->subject($find_job['Job']['job_title'], 'success');
                            $Email->send();
                            $this->redirect(array('controller' => 'client', 'action' => 'job_application/' . $id));
                        }
                    }
                    $this->set('Messages', $all_message);
                }
                $this->set('Contect_result', $Contect_info);
                $this->set('freelancer_info', $User_info);
                $this->set('freelancer_country', $user_country);
                $this->set('freelancer_skill', $Subskill);
                $this->set('subskills', $subskills);
            } else {
                $client = $this->User->find('first', array('conditions' => array('User.id' => $client_id)));
                $admin_data = $this->Admin->find('first');
                $jobs = $this->Hire->find('first', array('conditions' => array('Hire.hiring_id' => $client_id, 'Hire.contractor_id' => $id)));
                $User_info = $this->User->find('first', array('conditions' => array('User.id' => $id, 'User.type' => 'freelancer')));
                $free_id = $User_info['User']['id'];
                $country_id = $User_info['User']['country_id'];
                $user_skills = explode(',', $User_info['User']['skills']);
                $user_country = $this->Country->find('first', array('conditions' => array('Country.id' => $country_id)));
                $Subskill = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $user_skills)));

                $subskil = $this->Subskill->find('all', array('limit' => 3, 'conditions' => array('Subskill.id' => $user_skills)));
                $sub_data = array();
                foreach ($subskil as $kes => $vals) {
                    $sub_data[] = $vals['Subskill']['skill_name'];
                }
                $subskills = implode(',', $sub_data);
                $Contect_info = $this->Contect->find('first', array('conditions' => array('Contect.user_id' => $id, 'Contect.client_id' => $client_id)));
                if (!empty($Contect_info)) {
                    $job_id = $Contect_info['Contect']['job_id'];
                    $find_job = $this->Job->find('first', array('conditions' => array('Job.user_id' => $client_id, 'Job.id' => $job_id)));
                    $this->set('job_id', $job_id);
                    $all_message = $this->Message->find('all', array('conditions' => array('AND' => array('Message.sender' => array($User_info['User']['id'], $client_id), 'Message.reciever' => array($client_id, $User_info['User']['id']), 'Message.job_id' => $Contect_info['Contect']['job_id']))));
                    foreach ($all_message as $kk => $vv) {
                        $sender = $vv['Message']['sender'];
                        $all_users = $this->User->find('all', array('conditions' => array('User.id' => $sender)));
                        $all_message[$kk]['users'] = $all_users;
                    }
                    if ($this->request->is('post')) {
                        $reply = nl2br($this->request->data['Message']['reply']);
                        $this->request->data['Message']['sender'] = $client_id;
                        $this->request->data['Message']['reciever'] = $free_id;
                        $this->request->data['Message']['reply'] = $reply;
                        $this->request->data['Message']['job_id'] = $job_id;
                        $this->request->data['Message']['status'] = 1;
                        $this->request->data['Message']['read_status'] = 0;
                        $this->set($this->request->data);
                        $data = $this->request->data;
                        if ($this->Message->save($this->request->data)) {
                            $Email = new CakeEmail();
                            $Email->template('reply_message');
                            $Email->emailFormat('html');
                            $Email->viewVars(array('data' => $find_job['Job']['job_title'], 'client_fname' => $client['User']['first_name'], 'client_lname' => $client['User']['last_name'], 'Job_id' => $find_job['Job']['id'], 'message' => $data['Message']['reply']));
                            $Email->from(array('info@jobider.com' => $client['User']['first_name'] . '' . $client['User']['last_name'] . 'via Jobider'));
                            $Email->to($User_info['User']['email']);
                            $Email->subject($find_job['Job']['job_title'], 'success');
                            $Email->send();
                            $Email->template('reply_message');
                            $Email->emailFormat('html');
                            $Email->viewVars(array('data' => $find_job['Job']['job_title'], 'client_fname' => $client['User']['first_name'], 'client_lname' => $client['User']['last_name'], 'Job_id' => $find_job['Job']['id'], 'message' => $data['Message']['reply']));
                            $Email->from(array('info@jobider.com' => $client['User']['first_name'] . '' . $client['User']['last_name'] . 'via Jobider'));
                            $Email->to($admin_data['Admin']['email']);
                            $Email->subject($find_job['Job']['job_title'], 'success');
                            $Email->send();
                            $this->redirect(array('controller' => 'client', 'action' => 'job_application/' . $id));
                        }
                    }
                    $this->set('Messages', $all_message);
                }
                $this->set('Contect_result', $Contect_info);
                $this->set('freelancer_info', $User_info);
                $this->set('freelancer_country', $user_country);
                $this->set('freelancer_skill', $Subskill);

                $this->set('subskills', $subskills);
            }
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Job Application Function */

    /* Client Select Subcategory Function Through Ajax */

    public function job_data() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->autoRender = false;
            $this->loadModel('Subcategory');
            $sub_id = $_POST['select'];
            $this->Subcategory->recursive = -1;
            $sub_data = $this->Subcategory->find('all', array('conditions' => array('Subcategory.category_id' => $sub_id), 'fields' => array('Subcategory.category_name', 'Subcategory.id')));
            $subcategory_html = '<option value="">Please Select....</option>';
            if ($sub_data) {
                foreach ($sub_data as $k => $v) {
                    $subcategory_html.='<option value=' . $v['Subcategory']['id'] . '>' . $v['Subcategory']['category_name'] . '</option>';
                }
                $arr['suc'] = 'yes';
            }
            $arr['subcategory'] = $subcategory_html;
            echo json_encode($arr);
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Select Subcategory Function Through Ajax */

    /* Client More Infromation For Freelancer Function */

    public function moreinfo($user_id = null) {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'front';
            $this->loadModel('User');
            $this->loadModel('Skill');
            $this->loadModel('Subskill');
            $freelancer_Detailed_info = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
            if (!empty($freelancer_Detailed_info)) {
                $category = explode(",", $freelancer_Detailed_info['User']['skills']);
                if (!empty($category)) {
                    $this->Skill->recursive = -1;
                    $skill = $this->Skill->find('all', array('fields' => array('Skill.name'), 'conditions' => array('Skill.id' => $category)));
                    $subskill = $this->Subskill->find('all', array('fields' => array('Subskill.skill_name'), 'conditions' => array('Subskill.id' => $category)));
                    $this->set('skill', $skill);
                    $this->set('subskill', $subskill);
                }
            }
            $this->set('detailed_info', $freelancer_Detailed_info);
        } else {
            $this->redirect('/login');
        }
    }

    /* Client More Infromation For Freelancer Function */

    /* Client Preview Function */

    public function preview() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'front';
            $this->loadModel('Category');
            $this->loadModel('Subcategory');
            $this->loadModel('Job');
            $this->loadModel('Admin');
            $this->loadModel('User');
            $this->loadModel('Subskill');
            $session_data = $this->Session->read();
            $user_id = $session_data['Auth']['User']['id'];
            $session = $this->Session->read('post_data');
            $client = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
            $admin_data = $this->Admin->find('first');
            $this->set('post_data', $session);
            $skills = explode(',', $session['Job']['skills']);
            $subskill = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $skills)));
            $this->set('skill_name', $subskill);
            $category_data = $this->Category->find('first', array('conditions' => array('Category.id' => $session['Job']['category_id'])));
            $this->set('category_data', $category_data);
            $subcategory_data = $this->Subcategory->find('first', array('conditions' => array('Subcategory.id' => $session['Job']['subcategory_id'])));

            $this->set('subcategory_data', $subcategory_data);
            $this->request->data = $session;
            if ($this->request->is('post')) {
                $images = $this->request->data['Job']['image_names'];
                if (move_uploaded_file($session['Job']['image_names']['tmp_name'], WWW_ROOT . 'uploads/' . $session['Job']['image_names']['name']))
                    $this->request->data['Job']['image'] = $images;
                $this->request->data['Job']['user_id'] = $user_id;
                $this->request->data['Job']['addedon'] = time();

                if (isset($_POST['change']) && ($_POST['change'] == 'change')) {
                    $this->Session->delete('post_data');
                    $this->Session->write('session_post_data', $this->request->data);
                    $this->redirect('/client/postajob');
                }
                if (isset($_POST['add']) && ($_POST['add'] == 'add')) {
                    $data = $this->request->data;
                    if ($this->Job->save($this->request->data)) {
                        $job_id = $this->Job->getLastInsertId();
                        $Email = new CakeEmail();
                        $Email->template('posted');
                        $Email->emailFormat('html');
                        $Email->viewVars(array('data' => $data['Job']['job_title'], 'client_fname' => $client['User']['first_name'], 'client_lname' => $client['User']['last_name'], 'Job_id' => $job_id));
                        $Email->from(array('info@jobider.com' => $client['User']['first_name'] . '' . $client['User']['last_name'] . '  via  Jobider'));
                        $Email->to($client['User']['email']);
                        $Email->subject($data['Job']['job_title'], 'success');
                        $Email->send();
                        $Email->template('posted',NULL);
                        $Email->emailFormat('html');
                        $Email->viewVars(array('data' => $data['Job']['job_title'], 'client_fname' => $client['User']['first_name'], 'client_lname' => $client['User']['last_name'], 'Job_id' => $job_id));
                        $Email->from(array('info@jobider.com' => $client['User']['first_name'] . '' . $client['User']['last_name'] . '  via  Jobider'));
                        $Email->to($admin_data['Admin']['email']);
                        $Email->subject($data['Job']['job_title'], 'success');
                        $Email->send();
                        $this->Session->setFlash('Success! Your Job was submitted', 'success');
                        $this->Session->delete('post_data');
                        $this->redirect('/client/postedJobs');
                    }
                }
            }
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Preview Function */

    /* Client Posted Information Function */

    public function Postinfo($job_id) {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'front';
            $this->loadModel('Jobdetail');
            $this->loadModel('Job');
            $this->loadModel('User');
            $this->loadModel('Country');
            $this->loadModel('Projectfeedback');
            $jobs = $this->Job->find('first', array('conditions' => array('Job.id' => $job_id)));
            if (!empty($jobs)) {
                $sub_text = $jobs['Job']['job_title'];
                $this->set('sub_text', $sub_text);
            }
            $job_detail = $this->Jobdetail->find('all', array('conditions' => array('Jobdetail.job_id' => $job_id)));
            foreach ($job_detail as $key => $val) {
                $freelancer_id = $val['User']['id'];
                $country_id = $val['User']['country_id'];
                $User_country = $this->Country->find('first', array('conditions' => array('Country.id' => $country_id)));
                $project_feedback = $this->Projectfeedback->find('first', array('conditions' => array('Projectfeedback.freelancer_id' => $freelancer_id, 'Projectfeedback.user_type' => 'client')));
                $job_detail[$key]['User_Country'] = $User_country;
                $job_detail[$key]['feedback'] = $project_feedback;
            }

            $jobs_data = $this->Jobdetail->find('count', array('conditions' => array('Jobdetail.job_id' => $job_id)));

            $this->set('jobs', $jobs);
            $this->set('jobs_count', $jobs_data);
            $this->set('users', $job_detail);
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Posted Information Function */

    /* Client Find Skill Function */

    public function skill_data() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->autoRender = false;
            $this->loadModel('Subskill');
            $skill_data = $this->Subskill->find('all', array('fields' => array('Subskill.skill_name', 'Subskill.id')));
            foreach ($skill_data as $k => $v) {
                $arr[$k]['id'] = $v['Subskill']['id'];
                $arr[$k]['label'] = $v['Subskill']['skill_name'];
                $arr[$k]['value'] = $v['Subskill']['skill_name'];
            }
            echo json_encode($arr);
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Find Skill Function */

    /* Client Settings Function */

    public function settings() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'front';
            $this->loadModel('User');
            $this->loadModel('Subskill');
            $session = $this->Session->read();
            $user_id = $session['Auth']['User']['id'];
            $user_data = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
            $skills = explode(',', $user_data['User']['skills']);
            $subskill_value = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $skills)));
            $this->set('userskill', $subskill_value);
            $this->set('userdata', $user_data);
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Settings Function */




    /* Client Changepassword Function */

    public function changepassword() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'front';
            $this->loadModel('User');
            $session = $this->Session->read();
            $id = $this->Auth->user('id');
            $user = $this->User->find('first', array('conditions' => array('User.id' => $id)));
            $this->set('user', $user);
            if ($this->request->is('post')) {
                $this->User->set($this->data);
                $password_back = $this->request->data['User']['old_password'];
                $hpassword_back = Security::hash($password_back, null, true);
                $this->request->data['User']['old_password'] = $hpassword_back;
                if ($this->request->data['User']['old_password'] == $user['User']['password']) {
                    if ($this->request->data['User']['new_password'] == $this->request->data['User']['confirm_password']) {
                        $password_will_be = $this->request->data['User']['new_password'];
                        $hpassword_back_with = Security::hash($password_will_be, null, true);
                        $this->request->data['User']['new_password'] = $hpassword_back_with;
                        $this->request->data['User']['password'] = $this->request->data['User']['new_password'];
                        $this->User->id = $id;
                        $this->set($this->request->data);
                        if ($this->User->save($this->request->data)) {

                            $this->Session->setFlash('Password Successfully Changed', 'success');
                            $this->redirect(array('controller' => 'client', 'action' => 'changepassword'));
                        } else {
                            $this->Session->setFlash('Password does not Changed, Please Try Again', 'error_unverify');
                        }
                    } else {
                        $this->Session->setFlash('Passowrd does not match , Please Enter The Correct Password', 'error_unverify');
                    }
                }
            }
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Changepassword Function */

    /* Client Edit Profile Function */

    public function editprofile($id) {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'front';
            $this->loadModel('User');
            $this->loadModel('Country');
            $this->loadModel('Subskill');
            $user_data = $this->User->find('first', array('conditions' => array('User.id' => $id)));
            $this->set('userdata', $user_data);
            $country = $this->Country->find('list', array('fields' => array('Country.name')));
            $this->set('country', $country);
            $country_value = $this->Country->find('first', array('conditions' => array('Country.id' => $user_data['User']['country_id'])));
            $skills = explode(',', $user_data['User']['skills']);
            $subskill_value = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $skills)));
            $skill_data = array();
            foreach ($subskill_value as $ke => $val) {
                $skill_data[] = $val['Subskill']['skill_name'];
            }
            $userskills = implode(',', $skill_data);
            $this->set('userskill', $userskills);
            $this->set('country_value', $country_value);
            $User_info = $this->User->find('first', array('conditions' => array('User.id' => $id)));
            if ($this->request->is('post')) {
                if ($this->User->validates()) {
                    if ($this->request->data['User']['pro_img'] == '4') {
                        $this->request->data['User']['image'] = $User_info['User']['image'];
                    } else {
                        $this->request->data['User']['image'] = time() . '_' . $this->request->data['User']['pro_img']['name'];
                        if (move_uploaded_file($this->request->data['User']['pro_img']['tmp_name'], WWW_ROOT . 'uploads/' . time() . '_' . $this->request->data['User']['pro_img']['name']))
                            ;
                    }
                    $this->request->data['User']['type'] = $user_data['User']['type'];
                    $this->request->data['User']['employer_type'] = $user_data['User']['employer_type'];
                    $skill_data = explode(',', $this->request->data['User']['skills']);
                    $subskill = $this->Subskill->find('all', array('conditions' => array('Subskill.skill_name' => $skill_data)));
                    $skill_id = array();
                    foreach ($subskill as $ke => $val) {
                        $skill_id[] = $val['Subskill']['id'];
                    }
                    $skills = implode(',', $skill_id);
                    $this->request->data['User']['skills'] = $skills;
                    $this->User->id = $id;
                    $this->set($this->request->data);
                    if ($this->User->save($this->request->data, array('validate' => false))) {
                        $user_data = $this->User->find('first', array('conditions' => array('User.id' => $id)));
                        $this->set('userdata', $user_data);
                        $this->Session->setFlash('Client Profile Edit Successfully ', 'success');
                    }
                } else {
                    $this->User->validationErrors;
                }
            }
            $timezone = $this->generate_timezone_list();
            foreach ($timezone as $key => $single) {
                $key = $single;
                $new[$key] = $single;
            }
            $this->set('timezone', $new);
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Edit Profile Function */

    /* Client Mypayment Function */
    public function my_payment() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'front';
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Mypayment Function */

    /* Client Active Contract Function */
    public function ActiveContract() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'front';
            $this->loadModel('User');
            $this->loadModel('Hire');
            $user_id = $this->Auth->user('id');
            $user_name = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
            $this->set('user', $user_name);
            $hire = $this->Hire->find('all', array('conditions' => array('Hire.hire_status' => 'Active', 'Hire.hiring_id' => $user_id)));

            $this->set('hire_data', $hire);
            if ($this->request->is('post')) {
                $hire = $this->Hire->find('all', array('conditions' => array('Hire.contractor_name LIKE' => '%' . $this->request->data['Hire']['search_contractor'] . '%', 'Hire.hiring_id' => $user_id, 'Hire.hire_status' => 'Active')));
                $this->set('hire_data', $hire);
            }
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Active Contract Function */
    public function view_ended_contract() {
        $this->layout = 'front';
         if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->loadModel('Hire');
           $client_id = $this->Auth->user('id');
            $Closed_contracts = $this->Hire->find('all', array('conditions' => array('Hire.hiring_id' => $client_id, 'Hire.hire_status' => 'closed')));
            $this->set('Ended_contracts', $Closed_contracts);
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Send Message To Applicant Function */
    public function SentMessageToApplicant() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'front';
            $this->loadModel('User');
            $this->loadModel('Contect');
            $user_id = $this->Auth->user('id');
            $mesages = $this->Contect->find('all', array('conditions' => array('Contect.client_id' => $user_id)));
            foreach ($mesages as $key => $val) {
                $freelancer_id = $val['Contect']['user_id'];
                $users[] = $this->User->find('all', array('conditions' => array('User.id' => $freelancer_id)));
            }
            if (!empty($users)) {
                $user_data = array();
                foreach ($users as $kk => $vv) {
                    foreach ($vv as $k => $v) {
                        $user_data[] = $v;
                    }
                }
                $input = array_map("unserialize", array_unique(array_map("serialize", $user_data)));
                $this->set('message', $input);
            }
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Send Message To Applicant Function */

    /* Client Notifications Function */
    public function notifications() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'front';
            $this->loadModel('User');
            $this->loadModel('Notificationsetting');
            $user_id = $this->Auth->user('id');
            $user = $this->User->find('first', array('conditions' => array('User.id' => $user_id), 'fields' => 'User.email'));
            $this->set('user_email', $user);
            $notify_data = $this->Notificationsetting->find('all', array('conditions' => array('Notificationsetting.user_id' => $user_id), 'fields' => 'Notificationsetting.check_value'));
            if (!empty($notify_data['0']['Notificationsetting']['check_value'])) {
                $check_data = unserialize($notify_data['0']['Notificationsetting']['check_value']);
                $this->set('check', $check_data);
            }
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Notifications Function */

    /* Client Dashboard Help Function */
    public function dashboardHelp() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'front';
            $this->loadModel('Help');
            $this->loadModel('Faq');
            if (!empty($this->request->data)) {
                if (!empty($this->request->data['Faq']['search'])) {
                    $this->paginate = array('limit' => 10, 'conditions' => array('Faq.question LIKE' => '%' . $this->request->data['Faq']['search'] . '%'));
                    $search_data = $this->paginate('Faq');
                    $this->set('faq', $search_data);
                } else {
                    $error = 'Please enter Search Keyword !';
                    $this->set('error_msg', $error);
                }
            } else {
                $this->paginate = array('limit' => 4, 'order' => 'Faq.id ASC');
                $faq = $this->paginate('Faq');
                $this->set('faq', $faq);
            }
            $Help_title = $this->Help->find('all', array('conditions' => array('Help.status' => 1)));
            $this->set('helpTitle', $Help_title);
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Dispute Function */
    public function client_Dispute() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'front';
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Single Help Topic Function */
    public function singleHelpTopic($id = NULL) {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'front';
            $this->loadModel('Help');
            $Title_help = $this->Help->find('all', array('conditions' => array('Help.status' => 1)));
            $Single_help = $this->Help->find('first', array('conditions' => array('Help.id' => $id, 'Help.status' => 1)));
            $this->set('result', $Single_help);
            $this->set('help_topic', $Title_help);
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Single Help Topic Function */


    /* Client All Notifications Function */
    public function allNotifications() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'front';
            $this->loadModel('Notification');
            $user_id = $this->Auth->user('id');
            $this->paginate = array('limit' => 5, 'conditions' => array('AND' => array('Notification.reciever_id' => $user_id, 'Notification.status' => 1)));
            $all_notifications = $this->paginate('Notification');

            $this->set('Notify', $all_notifications);
        } else {
            $this->redirect('/login');
        }
    }

    /* Client All Notifications Function */

    /* Cleint Delete Notification Function */
    public function delete_notification($id = null) {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->autoRender = false;
            $this->loadModel('Notification');
            $this->Notification->delete($id);
            $this->redirect(array('controller' => 'client', 'action' => 'allNotifications'));
        } else {
            $this->redirect('/login');
        }
    }

    /* Cleint Delete Notification Function */

    /* Client Contact For Freelancer Function */
    public function contect_for_freelancer($user_id) {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'front';
            $this->loadModel('User');
            $this->loadModel('Subskill');
            $this->loadModel('Job');
            $this->loadModel('Category');
            $this->loadModel('Contect');
            $this->loadModel('Country');
            $this->loadModel('Notification');
            $this->loadModel('Finalresult');
            $this->loadModel('Result');
            $this->loadModel('Test');
            $this->loadModel('Jobdetail');
            $this->loadModel('Admin');
            $u_id = $_SESSION['Auth']['User']['id'];
            $admin_data = $this->Admin->find('first');
            $users = $this->User->find('first', array('conditions' => array('AND' => array('User.id' => $user_id, 'User.description !=' => ''))));
            $client = $this->User->find('first', array('conditions' => array('User.id' => $u_id)));
            if (!empty($users)) {
                $country_id = $users['User']['country_id'];
                $country_name = $this->Country->find('first', array('conditions' => array('Country.id' => $country_id)));
                $skills = explode(',', $users['User']['skills']);
                $subskill = $this->Subskill->find('all', array('limit' => 10, 'conditions' => array('Subskill.id' => $skills)));
                $ski_val = array();
                foreach ($subskill as $key => $value) {
                    $ski_val[] = $value['Subskill']['skill_name'];
                }
                $skill_value = implode(',', $ski_val);
                $this->set('subskill', $skill_value);
                $this->set('Subskill', $subskill);
                $this->set('country_name', $country_name);
            }
            $task_taken = $this->Finalresult->find('all', array('conditions' => array('Finalresult.user_id' => $user_id)));

            foreach ($task_taken as $key => $val) {
                $test_id = $val['Finalresult']['test_id'];
                $test = $this->Test->find('all', array('conditions' => array('Test.id' => $test_id)));
                $result = $this->Result->find('all', array('conditions' => array('Result.user_id' => $user_id, 'Result.test_id' => $test_id)));
                $total_result = count($result);
                $result_data = $this->Result->find('all', array('conditions' => array('Result.user_id' => $user_id, 'Result.test_id' => $test_id, 'Result.status' => '1')));
                $right_ans = count($result_data);
                $percent_data = $right_ans / $total_result * 100;
                $task_taken[$key]['percent'] = $percent_data;
                $task_taken[$key]['test'] = $test;
            }
            $jobs = $this->Job->find('all', array('conditions' => array('Job.user_id' => $u_id)));
            $contects = $this->Contect->find('all', array('conditions' => array('Contect.client_id' => $u_id)));

            $job_value = $this->Job->find('first', array('conditions' => array('Job.user_id' => $u_id)));
            $category = $this->Category->find('list', array('fields' => array('Category.name')));
            $user_data = $this->User->find('first', array('conditions' => array('User.id' => $u_id)));
            $message = 'Hello !!  &#10;&#10; ';

            $message.= 'I would like to invite you to apply to my job.Please review the job post and apply if you are available.&#10;&#10;'
                    . $user_data['User']['first_name'] . ' ' . $user_data['User']['last_name'];
            $this->set('user_data', $user_data);
            $this->set('category', $category);
            $this->set('users', $users);
            $this->set('message', $message);
            $this->set('job_data', $jobs);
            $this->set('job_value', $job_value);
            $this->set('tasks', $task_taken);
            if ($this->request->is('post')) {
                if (isset($_POST['post']) and $_POST['post'] == 'post') {
                    $this->request->data['Job']['subcategory_id'] = $this->request->data['Contect']['subcategory_id'];
                    $this->request->data['Job']['job_title'] = $this->request->data['Contect']['job_title'];
                    $this->request->data['Job']['category_id'] = $this->request->data['Contect']['category_id'];
                    $this->request->data['Job']['description'] = $this->request->data['Contect']['description'];
                    $this->request->data['Job']['duration'] = $this->request->data['Contect']['duration'];
                    $this->request->data['Job']['budget'] = $this->request->data['Contect']['budget'];
                    $this->request->data['Job']['start_date'] = $this->request->data['Contect']['start_date'];
                    $this->request->data['Job']['user_id'] = $u_id;
                    $this->request->data['Job']['active_job'] = 0;

                    $data = $this->request->data;
                    if ($this->Job->save($this->request->data)) {
                        $job_id = $this->Job->lastInsertId();
                        $Email = new CakeEmail();
                        $Email->template('posted');
                        $Email->emailFormat('html');
                        $Email->viewVars(array('data' => $data['Job']['job_title'], 'client_fname' => $client['User']['first_name'], 'client_lname' => $client['User']['last_name'], 'Job_id' => $job_id));
                        $Email->from(array('info@jobider.com' => $client['User']['first_name'] . '' . $client['User']['last_name'] . '  via  Jobider'));
                        $Email->to($client['User']['email']);
                        $Email->subject($data['Job']['job_title'], 'success');
                        $Email->send();
                        $Email->template('posted');
                        $Email->emailFormat('html');
                        $Email->viewVars(array('data' => $data['Job']['job_title'], 'client_fname' => $client['User']['first_name'], 'client_lname' => $client['User']['last_name'], 'Job_id' => $job_id));
                        $Email->from(array('info@jobider.com' => $client['User']['first_name'] . '' . $client['User']['last_name'] . '  via  Jobider'));
                        $Email->to($admin_data['Admin']['email']);
                        $Email->subject($data['Job']['job_title'], 'success');
                        $Email->send();
                    }
                }
                if (isset($_POST['send']) and $_POST['send'] == 'send') {
                    $this->request->data['Contect']['user_id'] = $user_id;
                    $this->request->data['Contect']['client_id'] = $u_id;
                    $data = $this->request->data;
                    $jobs_data = $this->Job->find('first', array('conditions' => array('Job.id' => $data['Contect']['job_id'])));
                    $this->request->data['Job']['job_status'] = 0;
                    $this->Job->id = $data['Contect']['job_id'];
                    $this->set($this->request->data);
                    $this->Job->save($this->request->data);
                    $url = BASE_URL . "/freelancer/applicants/" . $jobs_data['Job']['id'];
                    $notification['Notification']['sender_id'] = $u_id;
                    $notification['Notification']['url'] = $url;
                    $notification['Notification']['reciever_id'] = $users['User']['id'];
                    $notification['Notification']['notification_msg'] = 'You have recieved an invitation to interview for the job "' . $jobs_data['Job']['job_title'] . '"';
                    $notification['Notification']['status'] = 0;
                    $notification['Notification']['job_id'] = $jobs_data['Job']['id'];
                    $this->Notification->save($notification);
                    if ($this->Contect->save($this->request->data)) {
                        $Email = new CakeEmail();
                        $Email->template('message');
                        $Email->emailFormat('html');
                        $Email->viewVars(array('data' => $jobs_data['Job']['job_title'], 'client_fname' => $user_data['User']['first_name'], 'client_lname' => $user_data['User']['last_name'], 'description' => $jobs_data['Job']['description'], 'Job_id' => $jobs_data['Job']['id'], 'budget' => $jobs_data['Job']['budget']));
                        $Email->from(array('info@jobider.com' => 'Jobider Notification'));
                        $Email->to($users['User']['email']);
                        $Email->subject('Invitation To Interview For:' . $jobs_data['Job']['job_title'], 'success');
                        $Email->send();
                        $Email->template('message');
                        $Email->emailFormat('html');
                        $Email->viewVars(array('data' => $jobs_data['Job']['job_title'], 'client_fname' => $user_data['User']['first_name'], 'client_lname' => $user_data['User']['last_name'], 'description' => $jobs_data['Job']['description'], 'Job_id' => $jobs_data['Job']['id'], 'budget' => $jobs_data['Job']['budget']));
                        $Email->from(array('info@jobider.com' => 'Jobider Notification'));
                        $Email->to($admin_data['Admin']['email']);
                        $Email->subject('Invitation To Interview For:' . $jobs_data['Job']['job_title'], 'success');
                        $Email->send();
                        $this->Session->setFlash('Invitation sent successfuly, an email is also sent.', 'success');
                        $this->redirect(array('controller' => 'client', 'action' => 'freelancer_profile', $user_id));
                    }
                }
            }
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Contact For Freelancer Function */

    /* Client Decline Freelancer Function */
    public function decline_freelancer($id = null) {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->autoRender = false;
            $this->loadModel('Contect');
            $this->loadModel('Declinefreelancer');
            $this->loadModel('User');
            $this->loadModel('Jobdetail');
            $this->loadModel('Job');
            $this->loadModel('Contect');
            $this->loadModel('Acceptinterview');
            $client_id = $this->Auth->user('id');
            $job_id = $this->request->data['Declinefreelancer']['job_id'];
            $freelancer_info = $this->User->find('first', array('conditions' => array('User.id' => $id)));
            $free_id = $freelancer_info['User']['id'];
            $applied = $this->Jobdetail->find('first', array('conditions' => array('Jobdetail.freelancer_id' => $free_id, 'Jobdetail.client_id' => $client_id, 'Jobdetail.job_id' => $job_id)));
            $invited = $this->Acceptinterview->find('first', array('conditions' => array('Acceptinterview.job_id' => $job_id, 'Acceptinterview.client_id' => $client_id, 'Acceptinterview.freelancer_id' => $id)));
            if ($this->request->is('post')) {
                $this->request->data['Declinefreelancer']['freelancer_id'] = $freelancer_info['User']['id'];
                $this->request->data['Declinefreelancer']['client_id'] = $client_id;
                $this->request->data['Declinefreelancer']['job_id'] = $this->request->data['Declinefreelancer']['job_id'];
                if (!empty($invited)) {
                    $this->request->data['Acceptinterview']['decline_status'] = 'declined by client';
                    $this->set($this->request->data);
                    $this->Acceptinterview->id = $invited['Acceptinterview']['id'];
                    $this->Acceptinterview->save($this->request->data);
                }
                if (!empty($applied)) {
                    $this->request->data['Jobdetail']['decline_status'] = 'declined by client';
                    $this->set($this->request->data);
                    $this->Jobdetail->id = $applied['Jobdetail']['id'];
                    $this->Jobdetail->save($this->request->data);
                }
                if ($this->Declinefreelancer->save($this->request->data)) {
                    $this->redirect(array('controller' => 'client', 'action' => 'view_details/' . $job_id));
                }
            }
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Decline Freelancer Function */

    /* Client Select Subcategory  Function Through Ajax */
    public function ajax_data() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->autoRender = FALSE;
            $this->loadModel('Subcategory');
            $category_id = $_POST['category'];
            $subcategory = $this->Subcategory->find('all', array('conditions' => array('Subcategory.category_id' => $category_id)));
            if ($subcategory) {
                $test_data = '<option value="">Please Select .....</option>';
                foreach ($subcategory as $key => $value) {
                    $test_data.='<option value=' . $value['Subcategory']['id'] . '>' . $value['Subcategory']['category_name'] . '</option>';
                }
                $arr['suc'] = 'yes';
            }
            $arr['subcategory_data'] = $test_data;
            echo json_encode($arr);
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Select Subcategory  Function Through Ajax */
    /* Client Ajax Function For Freelancer Invitation */

    public function ajax_contect() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->autoRender = false;
            $this->loadModel('User');
            $this->loadModel('Hire');
            $this->loadModel('Job');
            $user_id = $_POST['user_id'];
            $job_id = $_POST['job_id'];
            $contect_data = $this->Hire->find('first', array('conditions' => array('AND' => array('Hire.contractor_id' => $user_id, 'Hire.job_id' => $job_id))));

            $job_data = $this->Job->find('first', array('conditions' => array('Job.id' => $job_id)));

            if (!empty($job_data)) {
                $desc = $job_data['Job']['description'];
                $arr['desc'] = $desc;
            }
            if (!empty($contect_data)) {
                $test = '<button class="btn-lg btn-green col-md-4 col-sm-6 col-xs-12 pull-left "  type="button" name="send" value="send" disabled="disabled"> Already Hired </button>';
                $test.='<a href="' . $this->webroot . 'client/freelancer_profile/' . $user_id . '"><button class="btn-lg btn-green col-md-2 col-sm-6 col-md-offset-1 col-xs-12" type="button" > Cancel </button></a>';
                $arr['suc'] = 'yes';
                $arr['test'] = $test;
            } else {
                $tested = '<button class="btn-lg btn-green col-md-4 col-sm-6 col-xs-12 pull-left "  type="submit" name="send" value="send" > Hire</button>';
                $tested.='<a href="' . $this->webroot . 'client/freelancer_profile/' . $user_id . '"><button class="btn-lg btn-green col-md-2 col-sm-6 col-md-offset-1 col-xs-12" type="button" > Cancel </button></a>';
                $arr['suc'] = 'no';
                $arr['tested'] = $tested;
            }
            echo json_encode($arr);
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Ajax Function For Freelancer Invitation */

    /* Client Ajax Function For Hire Freelancer */
    public function ajax_contects() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->autoRender = false;
            $this->loadModel('User');
            $this->loadModel('Hire');
            $this->loadModel('Job');
            $user_id = $_POST['user_id'];
            $job_id = $_POST['job_id'];
            $contect_value = $this->Contect->find('first', array('conditions' => array('AND' => array('Contect.user_id' => $user_id, 'Contect.job_id' => $job_id))));
            $job = $this->Job->find('first', array('conditions' => array('Job.id' => $job_id)));
            $budget = $job['Job']['budget'];
            if (!empty($job)) {
                $jobs = $job['Job']['description'];
                $arr['job'] = $jobs;
                $arr['amount'] = $budget;
            }
            if (!empty($contect_value)) {
                $test = '<button class="btn-lg btn-green col-md-4 col-sm-6 col-xsalert-12 pull-left "  type="button" name="send" value="send" onClick="myFunction()"> Already Invited </button>';
                $test.='<a href="' . $this->webroot . 'client/freelancer_profile/' . $user_id . '"><button class="btn-lg btn-green col-md-2 col-sm-6 col-md-offset-1 col-xs-12" type="button" > Cancel </button></a>';
                $arr['suc'] = 'yes';
                $arr['test'] = $test;
            } else {
                $tested = '<button class="btn-lg btn-green col-md-4 col-sm-6 col-xs-12 pull-left "  type="submit" name="send" value="send" > Send Invitation</button>';
                $tested.='<a href="' . $this->webroot . 'client/freelancer_profile/' . $user_id . '"><button class="btn-lg btn-green col-md-2 col-sm-6 col-md-offset-1 col-xs-12" type="button" > Cancel </button></a>';
                $arr['suc'] = 'no';
                $arr['tested'] = $tested;
            }

            echo json_encode($arr);
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Ajax Function For Hire Freelancer */
    /* Client Contract Function */
    public function contract($id) {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'front';
            $this->loadModel('User');
            $this->loadModel('Category');
            $this->loadModel('Job');
            $this->loadModel('Hire');
            $u_id = $this->Auth->user('id');
            $client = $this->User->find('first', array('conditions' => array('User.id' => $u_id)));
            $users = $this->User->find('first', array('conditions' => array('User.id' => $id)));
            $user_data = $this->User->find('first', array('conditions' => array('User.id' => $u_id)));
            $category = $this->Category->find('list', array('fields' => array('Category.name')));
            $jobs = $this->Job->find('all', array('conditions' => array('Job.user_id' => $u_id)));
            $this->set('job_data', $jobs);
            if (isset($_SESSION['job_id']) and !empty($_SESSION['job_id'])) {
                $job_id = $_SESSION['job_id'];
                $jobs = $this->Job->find('first', array('conditions' => array('Job.id' => $job_id, 'Job.user_id' => $u_id)));
                $this->set('jobs', $jobs);
            }

            $this->set('users', $users);
            //$this->set('job_data', $jobs)
            $this->set('user_data', $user_data);
            $this->set('category', $category);
            if ($this->request->is('post')) {
                if (isset($_POST['post']) && ($_POST['post'] == 'post')) {
                    $this->request->data['Job']['category_id'] = $this->request->data['Contect']['category_id'];
                    $this->request->data['Job']['subcategory_id'] = $this->request->data['Contect']['subcategory_id'];
                    $this->request->data['Job']['job_title'] = $this->request->data['Contect']['job_title'];
                    $this->request->data['Job']['duration'] = $this->request->data['Contect']['duration'];
                    $this->request->data['Job']['budget'] = $this->request->data['Contect']['budget'];
                    $this->request->data['Job']['user_id'] = $u_id;
                    $this->request->data['Job']['start_date'] = $this->request->data['Contect']['budget'];

                    $data = $this->request->data;
                    if ($this->Job->save($this->request->data)) {
                        $job_id = $this->Job->getLastInsertId();
                        $Email = new CakeEmail();
                        $Email->template('posted');
                        $Email->emailFormat('html');
                        $Email->viewVars(array('data' => $data['Job']['job_title'], 'client_fname' => $client['User']['first_name'], 'client_lname' => $client['User']['last_name'], 'Job_id' => $job_id));
                        $Email->from(array('info@jobider.com' => $client['User']['first_name'] . '' . $client['User']['last_name'] . '  via  Jobider'));
                        $Email->to($client['User']['email']);
                        $Email->subject($data['Job']['job_title'], 'success');
                        $Email->send();
                        $this->Session->setFlash('Success! Your Job Has Submitted', 'success');
                        $this->redirect(array('controller' => 'client', 'action' => 'postedJobs'));
                        $this->Session->delete('job_id');
                    }
                }
                if (isset($_POST['send']) && ($_POST['send'] == 'send')) {
                    $this->request->data['Contect']['user_id'] = $id;
                    $err = 0;
                    if (empty($this->request->data['Contect']['time_duration'])) {
                        $err = 1;
                        $err_msg[] = "please select the time period";
                    }
                    if (empty($this->request->data['Contect']['job_id'])) {
                        $err = 1;
                        $err_msg[] = "please select the job";
                    }
                    if ($err != 1) {
                        $data = $this->request->data;
                        $this->Session->delete('job_id');
                        $this->Session->write('contract_data', $data);
                        $this->redirect(array('controller' => 'client', 'action' => 'review_hire'));
                    } else {
                        $this->set('error', $err_msg);
                    }
                }
            }
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Contract Function */

    /* Client Review Hire Function */
    public function review_hire() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'front';
            $this->loadModel('Job');
            $this->loadModel('User');
            $this->loadModel('Hire');
            $this->loadModel('Notification');
            $user_id = $_SESSION['Auth']['User']['id'];
            $contract_data = $this->Session->read('contract_data');
            if (isset($contract_data)) {
                $job_data = $this->Job->find('first', array('conditions' => array('Job.id' => $contract_data['Contect']['job_id'])));
                $user = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
                $users = $this->User->find('first', array('conditions' => array('User.id' => $contract_data['Contect']['user_id'])));
                $this->set('job_data', $job_data);
                $this->set('user', $user);
                $this->set('users', $users);
                $this->set('contract', $contract_data);
                $data['contractor_id'] = $users['User']['id'];
                $data['contractor_name'] = $users['User']['first_name'] . ' ' . $users['User']['last_name'];
                $data['contractor_image'] = $users['User']['image'];
                $data['country_id'] = $users['User']['country_id'];
                $data['company_name'] = $user['User']['company'];
                $data['hiring_id'] = $user['User']['id'];
                $data['duration'] = $contract_data['Contect']['time_duration'];
                $data['job_id'] = $job_data['Job']['id'];
                $data['job_title'] = $job_data['Job']['job_title'];
                $review_data = $data;
                if ($this->request->is('post')) {
                    $this->Session->write('review_session', $review_data);
                    $this->redirect('/client/milestone');
                }
            }
            if (!isset($contract_data)) {
                $this->redirect('/client');
            }
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Review Hire Function */

    /* Client View Help Function */
    public function view_help($id) {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'front';
            $this->loadModel('Faq');
            $faqs = $this->Faq->find('first', array('conditions' => array('Faq.id' => $id)));
            $this->set('faqs', $faqs);
        } else {
            $this->redirect('/login');
        }
    }

    /* Client View Help Function */

    /* Client Ajax Val Function For Notification Setting */
    public function ajax_val() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->autoRender = FALSE;
            $this->loadModel('Notificationsetting');
            $user_id = $this->Auth->user('id');
            $notificate = $this->Notificationsetting->find('first', array('conditions' => array('Notificationsetting.user_id' => $user_id)));
            $count = count($notificate);
            $check_data = $_POST['arr'];
            $check = serialize($check_data);
            $this->request->data['Notificationsetting']['check_value'] = $check;
            $this->request->data['Notificationsetting']['user_id'] = $user_id;
            if (isset($count) && $count > 0) {
                $this->Notificationsetting->id = $notificate['Notificationsetting']['id'];
                $this->set($this->request->data);
                if ($this->Notificationsetting->save($this->request->data)) {
                    echo "Updated";
                } else {
                    echo "Not Updated";
                }
            } else {
                $this->set($this->request->data);
                if ($this->Notificationsetting->save($this->request->data)) {
                    echo "Added";
                } else {
                    echo "Not Added";
                }
            }
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Ajax Val Function For Notification Setting */
    /* Client View Detail Function */
    public function view_details($job_id) {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'front';
            $this->loadModel('Contect');
            $this->loadModel('User');
            $this->loadModel('Country');
            $this->loadModel('Job');
            $this->loadModel('Acceptinterview');
            $login_user_id = $this->Auth->user('id');
             //accept invitation
            $contect_data = $this->Acceptinterview->find('all', array('conditions' => array('Acceptinterview.job_id' => $job_id, 'Acceptinterview.client_id' => $login_user_id, 'Acceptinterview.decline_status' => '')));
            //apply job
            $Jobdetail = $this->Jobdetail->find('all', array('conditions' => array('Jobdetail.job_id' => $job_id, 'Jobdetail.client_id' => $login_user_id, 'Jobdetail.decline_status' => '')));
//             pr($Jobdetail); die;
            $both_records = array_merge($contect_data, $Jobdetail);
            foreach ($both_records as $kk => $va) {
                if (array_key_exists('Acceptinterview', $va)) {
                    $user_id[] = $va['Acceptinterview']['freelancer_id'];
                    $jobid[] = $va['Acceptinterview']['job_id'];
                    $both_records[$kk]['User']['crnt_status'] = 'invited';
                } else {
                    $user_id[] = $va['Jobdetail']['freelancer_id'];
                    $jobid[] = $va['Jobdetail']['job_id'];
                    $both_records[$kk]['User']['crnt_status'] = 'applied';
                }
            }
            if (!empty($jobid) and !empty($user_id)) {
                $this->Job->recursive = -1;
                $this->User->recursive = -1;
                $jobs = $this->Job->find('all', array('conditions' => array('Job.id' => $jobid, 'Job.user_id' => $login_user_id)));
                $users = $this->User->find('all', array('conditions' => array('User.id' => $user_id)));
                $countuser = count($users);
                //accept invitation
                $contect_datas = $this->Acceptinterview->find('all', array('conditions' => array('Acceptinterview.job_id' => $job_id, 'Acceptinterview.freelancer_id' => $user_id)));
                //apply job
                $JObdetails = $this->Jobdetail->find('all', array('conditions' => array('Jobdetail.job_id' => $job_id, 'Jobdetail.freelancer_id' => $user_id)));
                $both_recordss = array_merge($contect_datas, $JObdetails);
                if (!empty($both_recordss)) {
                    foreach ($both_recordss as $key => $value) {

                        if (array_key_exists('Acceptinterview', $value)) {

                            $both_recordss[$key]['User']['crnt_status'] = 'invited';
                        } else {
                            $both_recordss[$key]['User']['crnt_status'] = 'applied';
                        }
                        $country_id = $value['User']['country_id'];
                        $country_name = $this->Country->find('first', array('conditions' => array('Country.id' => $country_id)));
                        if (!empty($country_name)) {
                            $countryName = $country_name['Country']['name'];

                            $both_recordss[$key]['country'] = $countryName;
                        }
                        $both_recordss[$key]['job'] = $jobs;
                    }
                }
//                pr($both_recordss);
                $this->set('contect', $both_recordss);
                $this->set('total_applicants', $countuser);
            }

            $this->set('Job_id', $job_id);
            $this->set('free_id', $both_records);
        } else {
            $this->redirect('/login');
        }
    }

    /* Client View Detail Function */
    /* Client Message Data Function */
    public function messageData() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'ajax';
            $this->loadModel('Acceptinterview');
            $this->loadModel('Job');
            $this->loadModel('Country');
            if(!empty($_POST['user_id'])){
            $msg = $this->Acceptinterview->find('all', array('conditions' => array('Acceptinterview.freelancer_id' => $_POST['user_id'], 'Acceptinterview.job_id' => $_POST['job_id'])));
            if (!empty($msg)) {
                foreach ($msg as $key => $val) {
                    $country_id = $val['User']['country_id'];
                    $find_country = $this->Country->find('first', array('conditions' => array('Country.id' => $country_id)));
                    $country = $find_country['Country']['name'];
                    $msg[$key]['Country'] = $country;
                }
                $count = count($msg);
                $this->set('count_record', $count);
                $this->set('Record', $msg);
            }
            }
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Message Data Function */

    /* Client Hire Data Function */
    public function hireData() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'ajax';
            $this->loadModel('Hire');
            $this->loadModel('Country');
            if(!empty($_POST['user_id'])){
            $hired_freelancer = $this->Hire->find('all', array('conditions' => array('Hire.contractor_id' => $_POST['user_id'], 'Hire.hire_status' => 'Active')));
            foreach ($hired_freelancer as $key => $val) {
                $country_id = $val['Contractor']['country_id'];
                $country_data = $this->Country->find('first', array('conditions' => array('Country.id' => $country_id)));
                $country = $country_data['Country']['name'];
                $hired_freelancer[$key]['Country'] = $country;
            }
            $count_hire_data = count($hired_freelancer);
            $this->set('Record', $hired_freelancer);
            $this->set('count_record', $count_hire_data);
            }
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Hire Data Function */

    /* Client Ajax Model Function */
    public function ajax_model() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'pop_data';
            $this->loadModel('User');
            $this->loadModel('Contect');
            $this->loadModel('Job');
            $this->loadModel('Message');
            $user_id = $_POST['user_id'];
            $job_id = $_POST['job_id'];
            $users = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
            $client_id = $this->Auth->user('id');
            $this->set('users', $users);
            $this->set('job', $job_id);
            $this->set('reciever', $client_id);
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Ajax Model Function */
    /* Client Send Message Function */
    public function send_message() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->autoRender = false;
            $this->loadModel('Message');
            $this->loadModel('User');
            $this->loadModel('Job');
            $this->loadModel('Admin');
            $user_id = $this->Auth->user('id');
            $admin_data = $this->Admin->find('first');
            $users = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
            if ($this->request->is('post')) {
                $attachment = $this->request->data['Message']['attach_data'];
                $reply = nl2br($this->request->data['Message']['reply']);
                $this->request->data['Message']['reply'] = $reply;
                if (!empty($this->request->data['Message']['attach_data'])) {
                    $attchment_path = WWW_ROOT . 'documents/' . $this->request->data['Message']['attach_data']['name'];
                    if (move_uploaded_file($this->request->data['Message']['attach_data']['tmp_name'], $attchment_path))
                        ;
                }
                $this->request->data['Message']['attach_data'] = $this->request->data['Message']['attach_data']['name'];
                $this->request->data['Message']['sender'] = $this->request->data['Message']['sender'];
                $this->request->data['Message']['job_id'] = $this->request->data['Message']['job_id'];
                $this->request->data['Message']['reciever'] = $this->request->data['Message']['reciever'];
                $this->request->data['Message']['read_status'] = 0;
                $this->request->data['Message']['status'] = 1;
                $this->set($this->request->data);
                $data = $this->request->data;
                $find_job = $this->Job->find('first', array('conditions' => array('Job.id' => $data['Message']['job_id'])));
                $freelancer_data = $this->User->find('first', array('conditions' => array('User.id' => $data['Message']['reciever'])));
                if ($this->Message->save($this->request->data)) {
                    $Email = new CakeEmail();
                    $Email->template('reply_message');
                    $Email->emailFormat('html');
                    $Email->viewVars(array('data' => $find_job['Job']['job_title'], 'client_fname' => $users['User']['first_name'], 'client_lname' => $users['User']['last_name'], 'Job_id' => $find_job['Job']['id'], 'message' => $data['Message']['reply']));
                    $Email->from(array('info@jobider.com' => $users['User']['first_name'] . '' . $users['User']['last_name'] . 'via Jobider'));
                    $Email->to($freelancer_data['User']['email']);
                    $Email->subject($find_job['Job']['job_title'], 'success');
                    $Email->attachments(array($attachment['name'] => $attchment_path));
                    $Email->send();
                    $Email->template('reply_message');
                    $Email->emailFormat('html');
                    $Email->viewVars(array('data' => $find_job['Job']['job_title'], 'client_fname' => $users['User']['first_name'], 'client_lname' => $users['User']['last_name'], 'Job_id' => $find_job['Job']['id'], 'message' => $data['Message']['reply']));
                    $Email->from(array('info@jobider.com' => $users['User']['first_name'] . '' . $users['User']['last_name'] . 'via Jobider'));
                    $Email->to($admin_data['Admin']['email']);
                    $Email->subject($find_job['Job']['job_title'], 'success');
                    $Email->attachments(array($attachment['name'] => $attchment_path));
                    $Email->send();
                    $this->redirect(array('controller' => 'client', 'action' => 'single_message', $this->request->data['Message']['reciever']));
                }
            }
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Send Message Function */

    /* Client Ajax Notification Function */
    public function ajax_notification() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->autoRender = false;
            $this->loadModel('Notification');
            $this->loadModel('Job');
            $notify = $this->Notification->find('first', array('conditions' => array('Notification.id' => $_POST['id'])));
            $job = $this->Job->find('first', array('conditions' => array('Job.user_id' => $notify['Notification']['reciever_id'])));
            $job_id = $notify['Notification']['job_id'];
            $this->request->data['Notification']['status'] = 1;
            $this->Notification->id = $_POST['id'];
            $this->set($this->request->data);
            if ($this->Notification->save($this->request->data)) {
                $this->Session->write('job_id', $job_id);
                $arr['suc'] = 'yes';
                $arr['url'] = $notify['Notification']['url'];
            }
            echo json_encode($arr);
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Ajax Notification Function */

    /* Client Ajax Message Function */
    public function ajax_message() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->autoRender = false;
            $this->loadModel('User');
            $this->loadModel('Message');
            $user_id = $_POST['user_id'];
            $messages = $this->Message->find('all', array('conditions' => array('Message.sender' => $user_id)));

            $url = 'http://jobider.com/client/single_message/' . $user_id;
            foreach ($messages as $k => $v) {
                $this->request->data['Message']['read_status'] = 1;
                $this->Message->id = $v['Message']['id'];
                $this->set($this->request->data);
                if ($this->Message->save($this->request->data)) {
                    $arr['suc'] = 'yes';
                    $arr['url'] = $url;
                }
            }
            echo json_encode($arr);
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Ajax Message Function */

    /* Client Milestone Function */
    public function milestone() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'front';
            $this->loadModel('Job');
            $this->loadModel('Milestone');
            $this->loadModel('Hire');
            $this->loadModel('User');
            $this->loadModel('Paypalpayment');
            $this->loadModel('Balancepayment');
            $this->loadModel('Upfrontpayment');
            $this->loadModel('Admin');
            $job_session = $this->Session->read('contract_data');
            $review_session = $this->Session->read('review_session');
            $admin_data = $this->Admin->find('first');
            if (isset($review_session)) {
                $pay = $this->Upfrontpayment->find('first', array('conditions' => array('Upfrontpayment.job_id' => $review_session['job_id'], 'Upfrontpayment.client_id' => $review_session['hiring_id'], 'Upfrontpayment.freelancer_id' => $review_session['contractor_id'])));
                $user = $this->User->find('first', array('conditions' => array('User.id' => $review_session['contractor_id'])));
                $users_data = $this->User->find('first', array('conditions' => array('User.id' => $review_session['hiring_id'])));
                $job_id = $review_session['job_id'];
                $job_data = $this->Job->find('first', array('conditions' => array('Job.id' => $job_id)));
                $remain_bal = $this->Balancepayment->find('first', array('conditions' => array('Balancepayment.job_id' => $job_id, 'Balancepayment.freelancer_id' => $review_session['contractor_id'])));
                $this->set('balance', $remain_bal);
                $this->set('job_session', $job_session);
                $this->set('job_data', $job_data);
            }
            if (!isset($review_session)) {
                $this->redirect('/client');
            }
            if ($this->request->is('post')) {
                if (!empty($this->request->data)) {
                    if (isset($_POST['hire']) and $_POST['hire'] == 'hire') {
                        if (isset($_SESSION['type']) && $_SESSION['type'] == 'full-payment') {
                            $hire_data['Hire']['contractor_id'] = $review_session['contractor_id'];
                            $hire_data['Hire']['contractor_name'] = $review_session['contractor_name'];
                            $hire_data['Hire']['contractor_image'] = $review_session['contractor_image'];
                            $hire_data['Hire']['country_id'] = $review_session['country_id'];
                            $hire_data['Hire']['company_name'] = $review_session['company_name'];
                            $hire_data['Hire']['hiring_id'] = $review_session['hiring_id'];
                            $hire_data['Hire']['duration'] = $review_session['duration'];
                            $hire_data['Hire']['job_id'] = $review_session['job_id'];
                            $hire_data['Hire']['job_title'] = $review_session['job_title'];
                            $hire_data['Hire']['payment'] = $_SESSION['payment'];
                            $hire_data['Hire']['payment_type'] = $_SESSION['type'];
                            $hire_data['Hire']['hire_status'] = 'Active';
                            if (!empty($job_data['Job']['hire_job'])) {
                                $this->request->data['Job']['hire_job'] = '1' . ',' . $job_data['Job']['hire_job'];
                                $this->Job->id = $job_id;
                                $this->set($this->request->data);
                                $this->Job->save($this->request->data);
                            } else {
                                $this->request->data['Job']['hire_job'] = 1;
                                $this->Job->id = $job_id;
                                $this->set($this->request->data);
                                $this->Job->save($this->request->data);
                            }
                            $notification['Notification']['sender_id'] = $users_data['User']['id'];
                            $notification['Notification']['reciever_id'] = $user['User']['id'];
                            $notification['Notification']['notification_msg'] = $users_data['User']['first_name'] . '  ' . $users_data['User']['last_name'] . '  hired  ' . $user['User']['first_name'] . '  ' . $user['User']['last_name'] . '  for  ' . $job_data['Job']['job_title'];
                            $notification['Notification']['status'] = 0;
                            $notification['Notification']['job_id'] = $review_session['job_id'];
                            $notification['Notification']['url'] = BASE_URL . '/freelancer/myjobs/' . $job_data['Job']['id'];
                            $this->Notification->save($notification);
                            if ($this->Hire->save($hire_data)) {
                                $Email = new CakeEmail();
                                $Email->template('hire_freelancer');
                                $Email->emailFormat('html');
                                $Email->viewVars(array('data' => $job_data['Job']['job_title'], 'client_fname' => $users_data['User']['first_name'], 'client_lname' => $users_data['User']['last_name'], 'Job_id' => $job_data['Job']['id'], 'user_firstname' => $user['User']['first_name'], 'user_lastname' => $user['User']['last_name']));
                                $Email->from(array('info@jobider.com' => $users_data['User']['first_name'] . '  ' . $users_data['User']['last_name'] . ' via  Jobider'));
                                $Email->to($user['User']['email']);
                                $Email->subject('Hire for ' . $job_data['Job']['job_title'], 'success');
                                $Email->send();
                                $Email->template('hire_freelancer');
                                $Email->emailFormat('html');
                                $Email->viewVars(array('data' => $job_data['Job']['job_title'], 'client_fname' => $users_data['User']['first_name'], 'client_lname' => $users_data['User']['last_name'], 'Job_id' => $job_data['Job']['id'], 'user_firstname' => $user['User']['first_name'], 'user_lastname' => $user['User']['last_name']));
                                $Email->from(array('info@jobider.com' => $users_data['User']['first_name'] . '  ' . $users_data['User']['last_name'] . ' via  Jobider'));
                                $Email->to($admin_data['Admin']['email']);
                                $Email->subject('Hire for ' . $job_data['Job']['job_title'], 'success');
                                $Email->send();
                                $this->Session->delete('review_session');
                                $this->Session->delete('payment');
                                $this->Session->delete('type');
                                $this->Session->setFlash('You have hired successfully', 'success');
                                $this->redirect('/client/manageMyTeam');
                            }
                        } else {
                            $hire_data['Hire']['contractor_id'] = $review_session['contractor_id'];
                            $hire_data['Hire']['contractor_name'] = $review_session['contractor_name'];
                            $hire_data['Hire']['contractor_image'] = $review_session['contractor_image'];
                            $hire_data['Hire']['country_id'] = $review_session['country_id'];
                            $hire_data['Hire']['company_name'] = $review_session['company_name'];
                            $hire_data['Hire']['hiring_id'] = $review_session['hiring_id'];
                            $hire_data['Hire']['duration'] = $review_session['duration'];
                            $hire_data['Hire']['job_id'] = $review_session['job_id'];
                            $hire_data['Hire']['job_title'] = $review_session['job_title'];
                            $hire_data['Hire']['hire_status'] = 'Active';
                            $this->request->data['Job']['hire_job'] = 1;
                            $this->Job->id = $job_id;
                            $this->set($this->request->data);
                            $this->Job->save($this->request->data);
                            $notification['Notification']['sender_id'] = $users_data['User']['id'];
                            $notification['Notification']['reciever_id'] = $user['User']['id'];
                            $notification['Notification']['notification_msg'] = $users_data['User']['first_name'] . ' ' . $users_data['User']['last_name'] . ' hired' . $user['User']['first_name'] . ' ' . $user['User']['last_name'] . ' for ' . $job_data['Job']['job_title'];
                            $notification['Notification']['status'] = 0;
                            $notification['Notification']['job_id'] = $review_session['job_id'];
                            $notification['Notification']['url'] = BASE_URL . '/freelancer/myjobs/' . $job_data['Job']['id'];
                            $this->Notification->save($notification);
                            if ($this->Hire->save($hire_data)) {
                                $Email = new CakeEmail();
                                $Email->template('hire_freelancer');
                                $Email->emailFormat('html');
                                $Email->viewVars(array('data' => $job_data['Job']['job_title'], 'client_fname' => $users_data['User']['first_name'], 'client_lname' => $users_data['User']['last_name'], 'Job_id' => $job_data['Job']['id'], 'user_firstname' => $user['User']['first_name'], 'user_lastname' => $user['User']['last_name']));
                                $Email->from(array('info@jobider.com' => $users_data['User']['first_name'] . '' . $users_data['User']['last_name'] . 'via Jobider'));
                                $Email->to($user['User']['email']);
                                $Email->subject('Hire for ' . $job_data['Job']['job_title'], 'success');
                                $Email->send();
                                $Email->template('hire_freelancer');
                                $Email->emailFormat('html');
                                $Email->viewVars(array('data' => $job_data['Job']['job_title'], 'client_fname' => $users_data['User']['first_name'], 'client_lname' => $users_data['User']['last_name'], 'Job_id' => $job_data['Job']['id'], 'user_firstname' => $user['User']['first_name'], 'user_lastname' => $user['User']['last_name']));
                                $Email->from(array('info@jobider.com' => $users_data['User']['first_name'] . '  ' . $users_data['User']['last_name'] . ' via  Jobider'));
                                $Email->to($admin_data['Admin']['email']);
                                $Email->subject('Hire for ' . $job_data['Job']['job_title'], 'success');
                                $Email->send();
                                $this->Session->delete('review_session');
                                $this->Session->setFlash('You have hired successfully', 'success');
                                $this->redirect('/client/manageMyTeam');
                            }
                        }
                    }
                } else {
                    $this->Session->setFlash('Firstly, either add milestone or pay full payment', 'error_unverify');
                }
            }
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Milestone Function */

    /* Client Add Milestone Function */
    public function add_milestone_popup_save() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->autoRender = false;
            $this->loadModel('Milestone');
            $this->loadModel('Balancepayment');
            $this->loadModel('Upfrontpayment');
            $this->loadModel('Job');
            $this->layout = "ajax";
            $milestone = $_POST['data'];
            $job_session = $this->Session->read('review_session');
            $job_value = $this->Job->find('first', array('conditions' => array('Job.user_id' => $job_session['hiring_id'], 'Job.id' => $job_session['job_id'])));
            $upfront = $this->Upfrontpayment->find('first', array('conditions' => array('Upfrontpayment.job_id' => $job_session['job_id'], 'Upfrontpayment.client_id' => $job_session['hiring_id'], 'Upfrontpayment.freelancer_id' => $job_session['contractor_id'])));
            if (!empty($upfront)) {
                $Balance_payment = $this->Balancepayment->find('first', array('conditions' => array('Balancepayment.client_id' => $upfront['Upfrontpayment']['client_id'], 'Balancepayment.job_id' => $upfront['Upfrontpayment']['job_id'], 'Balancepayment.freelancer_id' => $upfront['Upfrontpayment']['freelancer_id'])));
            }
            $Balance_payment = $this->Balancepayment->find('first', array('conditions' => array('Balancepayment.client_id' => $job_session['hiring_id'], 'Balancepayment.job_id' => $job_session['job_id'], 'Balancepayment.freelancer_id' => $job_session['contractor_id'])));
            $remain = $Balance_payment['Balancepayment']['remaining_payment'] - $milestone['Milestone']['payment_amount'];
            if (empty($Balance_payment)) {
                $remain = $job_value['Job']['budget'] - $milestone['Milestone']['payment_amount'];
                $milestone_data['Milestone']['job_id'] = $job_session['job_id'];
                $milestone_data['Milestone']['milestone_title'] = $milestone['Milestone']['milestone_title'];
                $milestone_data['Milestone']['start_date'] = $milestone['Milestone']['start_date'];
                $milestone_data['Milestone']['end_date'] = $milestone['Milestone']['end_date'];
                $milestone_data['Milestone']['payment_amount'] = $milestone['Milestone']['payment_amount'];
                $milestone_data['Milestone']['client_id'] = $job_session['hiring_id'];
                $milestone_data['Milestone']['freelancer_id'] = $job_session['contractor_id'];
                $milestone_data['Milestone']['milestone_status'] = 'Ongoing';
                $this->request->data['Balancepayment']['remaining_payment'] = $remain;
                $this->request->data['Balancepayment']['freelancer_id'] = $job_session['contractor_id'];
                $this->request->data['Balancepayment']['client_id'] = $job_session['hiring_id'];
                $this->request->data['Balancepayment']['job_id'] = $job_session['job_id'];
                $this->request->data['Balancepayment']['job_payment'] = $job_value['Job']['budget'];
                $this->set($this->request->data);
                $this->Balancepayment->save($this->request->data);
                if ($this->Milestone->save($milestone_data)) {
                    $this->Session->setFlash('You have add milestone with  ' . $milestone['Milestone']['payment_amount'] . ' and remaining is ' . $remain, 'success');
                }
            } elseif ($milestone['Milestone']['payment_amount'] < $Balance_payment['Balancepayment']['remaining_payment'] and ( $Balance_payment['Balancepayment']['remaining_payment'] > 0)) {
                $milestone_data['Milestone']['job_id'] = $job_session['job_id'];
                $milestone_data['Milestone']['milestone_title'] = $milestone['Milestone']['milestone_title'];
                $milestone_data['Milestone']['start_date'] = $milestone['Milestone']['start_date'];
                $milestone_data['Milestone']['end_date'] = $milestone['Milestone']['end_date'];
                $milestone_data['Milestone']['payment_amount'] = $milestone['Milestone']['payment_amount'];
                $milestone_data['Milestone']['client_id'] = $job_session['hiring_id'];
                $milestone_data['Milestone']['freelancer_id'] = $job_session['contractor_id'];
                $milestone_data['Milestone']['milestone_status'] = 'Ongoing';
                $this->request->data['Balancepayment']['remaining_payment'] = $remain;
                $this->Balancepayment->id = $Balance_payment['Balancepayment']['id'];
                $this->set($this->request->data);
                $this->Balancepayment->save($this->request->data);
                if ($this->Milestone->save($milestone_data)) {
                    $this->Session->setFlash('You have add milestone with  ' . $milestone['Milestone']['payment_amount'] . ' and remaining is ' . $remain, 'success');
                }
            } elseif ($milestone['Milestone']['payment_amount'] == $Balance_payment['Balancepayment']['remaining_payment']) {
                $milestone_data['Milestone']['job_id'] = $milestone['Milestone']['job_id'];
                $milestone_data['Milestone']['milestone_title'] = $milestone['Milestone']['milestone_title'];
                $milestone_data['Milestone']['start_date'] = $milestone['Milestone']['start_date'];
                $milestone_data['Milestone']['end_date'] = $milestone['Milestone']['end_date'];
                $milestone_data['Milestone']['payment_amount'] = $milestone['Milestone']['payment_amount'];
                $milestone_data['Milestone']['client_id'] = $milestone['Milestone']['client_id'];
                $milestone_data['Milestone']['freelancer_id'] = $milestone['Milestone']['freelancer_id'];
                $milestone_data['Milestone']['milestone_status'] = 'Ongoing';
                $this->request->data['Balancepayment']['remaining_payment'] = $remain;
                $this->Balancepayment->id = $Balance_payment['Balancepayment']['id'];
                $this->set($this->request->data);
                $this->Balancepayment->save($this->request->data);
                if ($this->Milestone->save($milestone_data)) {
                    $this->Session->setFlash('You have add milestone with' . $milestone['Milestone']['payment_amount'] . ' and you have no remaining balance', 'success');
                }
            } else {
                $this->Session->setFlash('Your amount is greater than budget, so you can not add milestones', 'error_unverify');
            }
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Add Milestone Function */

    /* Client Delete Milestone Function */
    public function delete_milestone() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->autoRender = false;
            $this->layout = 'ajax';
            $this->loadModel('Milestone');
            $id = $_POST['Milestone_id'];
            if ($this->Milestone->delete($id)) {
                $res['suc'] = 'yes';
                echo json_encode($res);
            }
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Delete Milestone Function */

    /* Client Edit Milestone Function */
    public function edit_milestone() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->autoRender = false;
            $this->layout = 'ajax';
            $this->loadModel('Milestone');
            $id = $_POST['Milestone_edit_id'];
            $record = $this->Milestone->findById($id);
            $res['suc'] = 'yes';
            $res['record'] = $record['Milestone'];

            echo json_encode($res);
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Edit Milestone Function */

    /* Client Edit Milestone Save Function */
    public function edit_milestone_save() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->autoRender = false;
            $this->layout = 'ajax';
            $this->loadModel('Milestone');
            $dataTaSave['Milestone']['milestone_title'] = $_POST['milestone_title'];
            $dataTaSave['Milestone']['start_date'] = $_POST['start_date'];
            $dataTaSave['Milestone']['end_date'] = $_POST['end_date'];
            $dataTaSave['Milestone']['payment_amount'] = $_POST['payment_amount'];
            $this->Milestone->id = $_POST['id'];
            if ($this->Milestone->save($dataTaSave)) {
                echo json_encode(array('success' => 'yes'));
            }
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Edit Milestone Save Function */

    /* Client Generate Order Id Function */
    public function generateOrderId($length = 7) {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->autoRender = false;
            $characters = '0123456789';
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, strlen($characters) - 1)];
            }
            return $randomString;
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Generate Order Id Function */

    /* Client Job Payment Function */
    public function job_payment() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'front';
            $this->loadModel('Job');
            $this->loadModel('Milestone');
            $this->loadModel('Balancepayment');
            $this->loadModel('Hire');
            $user_id = $this->Auth->user('id');
            $job_data = $this->Job->find('all', array('conditions' => array('Job.user_id' => $user_id, 'Job.hire_job' => 1)));
            $this->set('hire', $job_data);
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Job Payment Function */

    /* Client Braintree Payment Function */
    public function braintree_payment($details) {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->autoRender = false;
            if (!empty($details)) {
                $amount = $details['Creditpayment']['amount'];
                require_once WWW_ROOT . 'braintree/lib/Braintree.php';
//                Braintree_Configuration::environment('sandbox');
//                Braintree_Configuration::merchantId('87swswyj43gzm86x');
//                Braintree_Configuration::publicKey('myvxqnx6zwvs58md');
//                Braintree_Configuration::privateKey('e27fcf48d8ab6f7f8ee8c6122ecf2f79');
        Braintree_Configuration::environment('production');
        Braintree_Configuration::merchantId('8p35k26rz83n8k3x');
        Braintree_Configuration::publicKey('jsmwpnh45v6gccm8');
        Braintree_Configuration::privateKey('b7f76d10bccde10d6001a7ae655d1adf');
                $result = Braintree_Transaction::sale(array(
                            'amount' => $amount,
                            'creditCard' => array(
                                'number' => $details['Creditpayment']['card_number'],
                                'expirationMonth' => $details['Creditpayment']['start_date'],
                                'expirationYear' => $details['Creditpayment']['end_date']
                            ),
                            'options' => array(
                                'submitForSettlement' => true
                            )
                ));
                if ($result->success) {
                    return $result;
                } else if ($result->transaction) {
                    print_r("Error processing transaction:");
                    print_r("\n  message: " . $result->message);
                    print_r("\n  code: " . $result->transaction->processorResponseCode);
                    print_r("\n  text: " . $result->transaction->processorResponseText);
                }
//        else {
//            print_r("Message: " . $result->message);
//            print_r("\nValidation errors: \n");
//            print_r($result->errors->deepAll());
//        }
// 
            }
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Braintree Payment Function */

    /* Client View Milestones Function */
    public function view_milestones($id) {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'front';
            $this->loadModel('Milestone');
            $this->loadModel('Balancepayment');
            $user_id = $this->Auth->user('id');
            $current_date = date('d-m-Y');
            $date = strtotime($current_date);
            $remain_data = $this->Balancepayment->find('first', array('conditions' => array('Balancepayment.job_id' => $id, 'Balancepayment.client_id' => $user_id)));
            $this->set('remain', $remain_data);
            $milestone_val = $this->Milestone->find('first', array('conditions' => array('Milestone.job_id' => $id, 'Milestone.client_id' => $user_id)));
            $this->set('val', $milestone_val);
            $milestone_data = $this->Milestone->find('all', array('conditions' => array('Milestone.job_id' => $id, 'Milestone.client_id' => $user_id)));
            foreach ($milestone_data as $k => $v) {
                $end_date = strtotime($v['Milestone']['end_date']);
                if ($date == $end_date) {
                    $status = $v['Milestone']['milestone_status'];
                }
                if ($date > $end_date && ($v['Milestone']['milestone_status'] != 'Paid')) {
                    $this->Milestone->id = $v['Milestone']['id'];
                    $milestone_statue = 'Outstanding';
                    $this->Milestone->saveField('milestone_status', $milestone_statue);
                    $status = $v['Milestone']['milestone_status'];
                }
            }
            $milestone_datas = $this->Milestone->find('all', array('conditions' => array('Milestone.job_id' => $id, 'Milestone.client_id' => $user_id)));
            $this->set('milestone', $milestone_datas);
        } else {
            $this->redirect('/login');
        }
    }

    /* Client View Milestones Function */

    /* Client Ajax Pay Function */
    public function ajax_pay() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'ajax_language';
            $this->loadModel('Milestone');
            $user_id = $_POST['milestone_id'];
            $payment = $this->Milestone->findById($user_id);
            $this->set('payment', $payment);
            $this->set('milestone_id', $user_id);
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Ajax Pay Function */

    /* Client Pay Milestone Function */
    public function pay_milestone($id) {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->autoRender = false;
            $this->loadModel('Milestone');
            $milestone = $this->Milestone->find('first', array('conditions' => array('Milestone.id' => $id)));
            if (!empty($milestone)) {
                //$paypal_id = "sanjivkumarpnf-facilitator@gmail.com "; // Sandbox Business email ID
                $paypal_id = "pay-facilitator@jobider.com"; // Sandbox Business email ID
                $paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscrr?rm=2&cmd=_xclick&business=' . $paypal_id . '&amount=' . $milestone['Milestone']['payment_amount'] . '&currency_code=USD&item_name=' . $milestone['Milestone']['milestone_title'] . '&custom=' . $milestone['Milestone']['id'] . '&notify_url=' . BASE_URL . '/client/paypal_notify&return=' . BASE_URL . '/client/transactionHistory';

                header('Location:' . $paypal_url);
            }
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Pay Milestone Function */

    /* Client Paypal Notify Function */
    public function paypal_notify() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->autoRender = false;
            $this->loadModel('Paypalpayment');
            $this->loadModel('Milestone');
            $this->loadModel('Hire');
            $this->loadModel('Job');
            $this->loadModel('User');
            $this->loadModel('Admin');
            $order_id = $this->generateOrderId();
            if (!empty($_POST['custom'])) {
                $admin_data = $this->Admin->find('first');
                $milestones = $this->Milestone->find('first', array('conditions' => array('Milestone.id' => $_POST['custom'])));
                $job_data = $this->Job->find('first', array('conditions' => array('Job.id' => $milestones['Milestone']['job_id'])));
                $user = $this->User->find('first', array('conditions' => array('User.id' => $milestones['Milestone']['freelancer_id'])));
                $users_data = $this->User->find('first', array('conditions' => array('User.id' => $milestones['Milestone']['client_id'])));
                $hires = $this->Hire->find('first', array('conditions' => array('Hire.hiring_id' => $milestones['Milestone']['client_id'], 'Hire.contractor_id' => $milestones['Milestone']['freelancer_id'], 'Hire.job_id' => $milestones['Milestone']['job_id'])));
                $amount = number_format($_POST['mc_gross']);
                $pay_data = str_replace(',', '', $amount);
                $this->request->data['Paypalpayment']['payer_id'] = $_POST['payer_id'];
                $this->request->data['Paypalpayment']['payer_email'] = $_POST['payer_email'];
                $this->request->data['Paypalpayment']['transection_id'] = $_POST['txn_id'];
                $this->request->data['Paypalpayment']['payment_status'] = $_POST['payment_status'];
                $this->request->data['Paypalpayment']['address_country'] = $_POST['address_country'];
                $this->request->data['Paypalpayment']['address_city'] = $_POST['address_city'];
                $this->request->data['Paypalpayment']['milestone_id'] = $milestones['Milestone']['id'];
                $this->request->data['Paypalpayment']['custom'] = $order_id;
                $this->request->data['Paypalpayment']['payment_amount'] = $pay_data;
                $this->request->data['Paypalpayment']['freelancer_id'] = $milestones['Milestone']['freelancer_id'];
                $this->request->data['Paypalpayment']['client_id'] = $milestones['Milestone']['client_id'];
                $this->request->data['Paypalpayment']['job_id'] = $milestones['Milestone']['job_id'];
                $this->request->data['Paypalpayment']['payment_type'] = 'paypal';

                $this->request->data['Paypalpayment']['payment_date'] = date('Y-m-d h:i:s', strtotime($_POST['payment_date']));
                $this->request->data['Paypalpayment']['item_name'] = $_POST['item_name'];
                $this->request->data['Paypalpayment']['pay_status'] = 'milestone';
                $this->set($this->request->data);
                $this->request->data['Milestone']['milestone_status'] = 'Paid';
                $this->request->data['Milestone']['payment_method'] = 'Paypal';
                $this->Milestone->id = $_POST['custom'];
                $this->set($this->request->data);
                $this->Milestone->save($this->request->data);
                if (!empty($hires['Hire']['payment'])) {
                    $payment = $hires['Hire']['payment'] . ',' . $pay_data;
                    $milestone_id = $hires['Hire']['milestone_id'] . ',' . $_POST['custom'];
                    $this->request->data['Hire']['payment'] = $payment;
                    $this->request->data['Hire']['milestone_id'] = $milestone_id;
                    $this->request->data['Hire']['payment_type'] = 'milestone';
                    $this->Hire->id = $hires['Hire']['id'];
                    $this->set($this->request->data);
                    $this->Hire->save($this->request->data);
                } else {
                    $this->request->data['Hire']['payment'] = $pay_data;
                    $this->request->data['Hire']['milestone_id'] = $_POST['custom'];
                    $this->request->data['Hire']['payment_type'] = 'milestone';
                    $this->Hire->id = $hires['Hire']['id'];
                    $this->set($this->request->data);
                    $this->Hire->save($this->request->data);
                }
                $this->request->data['Job']['job_payment'] = 'Milestone';
                $this->Job->id = $milestones['Milestone']['job_id'];
                $this->set($this->request->data);
                $this->Job->save($this->request->data);
                if ($this->Paypalpayment->save($this->request->data)) {
                    $Email = new CakeEmail();
                    $Email->template('client_milestone_payment');
                    $Email->emailFormat('html');
                    $Email->viewVars(array('data' => $milestones['Milestone']['milestone_title'], 'client_fname' => $users_data['User']['first_name'], 'client_lname' => $users_data['User']['last_name'], 'Job_id' => $job_data['Job']['id'], 'user_firstname' => $user['User']['first_name'], 'user_lastname' => $user['User']['last_name'], 'amount' => $amount, 'payment_type' => 'Paypal', 'Payment_status' => 'Milestone'));
                    $Email->from(array('info@jobider.com' => $users_data['User']['first_name'] . '  ' . $users_data['User']['last_name'] . ' via  Jobider'));
                    $Email->to($user['User']['email']);
                    $Email->subject('Payment for ' . $milestones['Milestone']['milestone_title'] . 'milestone ', 'success');
                    $Email->send();
                    $Email->template('milestone_payment');
                    $Email->emailFormat('html');
                    $Email->viewVars(array('data' => $milestones['Milestone']['milestone_title'], 'client_fname' => $users_data['User']['first_name'], 'client_lname' => $users_data['User']['last_name'], 'user_firstname' => $user['User']['first_name'], 'user_lastname' => $user['User']['last_name'], 'amount' => $amount, 'payment_type' => 'Paypal'));
                    $Email->from(array('info@jobider.com' => $users_data['User']['first_name'] . '  ' . $users_data['User']['last_name'] . ' via  Jobider'));
                    $Email->to($admin_data['Admin']['email']);
                    $Email->subject('Payment  for ' . $milestones['Milestone']['milestone_title'] . ' milestone', 'success');
                    $Email->send();
                }
            }
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Paypal Notify Function */

    /* Client Showing Transaction History Function */
    public function transactionHistory() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'front';
            $this->loadModel('User');
            $this->loadModel('Hire');
            $this->loadModel('Paypalpayment');
            $this->loadModel('Creditpayment');
            $this->loadModel('Milestone');

            $users_id = $this->Auth->user('id');
            $this->paginate = array(
                'limit' => 4,
                'conditions' => array(
                    'Paypalpayment.client_id' => $users_id,
                ),
                'order' => 'Paypalpayment.id desc'
            );
            $payments = $this->paginate('Paypalpayment');
            $this->paginate = array(
                'limit' => 4,
                'conditions' => array(
                    'Creditpayment.client_id' => $users_id,
                ),
                'order' => 'Creditpayment.id desc'
            );
            $credits = $this->paginate('Creditpayment');

            $hires = $this->Hire->find('all', array('conditions' => array('Hire.hiring_id' => $users_id)));
            $this->set('hire', $hires);
            if ($this->request->is('post')) {

                if (!empty($_POST['trans']) and $_POST['trans'] == 'trans') {

                    $start_date = date('Y-m-d', strtotime($this->request->data['Paypalpayment']['start_date']));
                    $end_date = date('Y-m-d', strtotime($this->request->data['Paypalpayment']['end_date']));
                    $credits = $this->Creditpayment->find('all', array('conditions' => array('date(Creditpayment.created) between ? and ?' => array($start_date, $end_date), 'Creditpayment.freelancer_id' => $this->request->data['Paypalpayment']['freelancer'], $this->request->data['Paypalpayment']['transaction'] == 'debit', 'Creditpayment.type' => 'credit_card', 'Creditpayment.client_id' => $users_id)));
                    $payments = $this->Paypalpayment->find('all', array('conditions' => array('date(Paypalpayment.payment_date) between ? and ?' => array($start_date, $end_date), 'Paypalpayment.freelancer_id' => $this->request->data['Paypalpayment']['freelancer'], $this->request->data['Paypalpayment']['transaction'] == 'debit', 'Paypalpayment.payment_type' => 'paypal', 'Paypalpayment.client_id' => $users_id)));
                }
            }
            $amount = array();
            $budget = array();
            foreach ($payments as $kk => $vall) {
                $amount[] = $vall['Paypalpayment']['payment_amount'];
                $budget[] = $vall['Job']['budget'];
                $milestones = $this->Hire->find('all', array('conditions' => array('Hire.job_id' => $vall['Paypalpayment']['job_id'], 'Hire.hiring_id' => $vall['Paypalpayment']['client_id'], 'Hire.contractor_id' => $vall['Paypalpayment']['freelancer_id'])));
                $payments[$kk]['milestone'] = $milestones;
            }
            $sum_budget = array_sum($budget);
            $sum_paypal = array_sum($amount);
            $pay_data = array();
            $bugdte = array();
            foreach ($credits as $key => $vals) {
                $pay_data[] = $vals['Creditpayment']['amount'];
                $bugdte[] = $vals['Job']['budget'];
                $milestones = $this->Hire->find('all', array('conditions' => array('Hire.job_id' => $vals['Creditpayment']['job_id'], 'Hire.hiring_id' => $vals['Creditpayment']['client_id'], 'Hire.contractor_id' => $vals['Creditpayment']['freelancer_id'])));
                $credits[$key]['milestone'] = $milestones;
            }
            $sums = array_sum($pay_data);
            $total = $sum_paypal + $sums;
            $budgte_sum = array_sum($bugdte);
            $total_budget = $sum_budget + $budgte_sum;
            $ending_total = $total_budget - $total;
            $payment_data = array_merge($payments, $credits);
            $this->set('payment', $payment_data);
            $this->set('end_total', $ending_total);
            $this->set('total_budgte', $total_budget);
            $this->set('total_amnt', $total);
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Showing Transaction History Function */


    /* Client Payment Data Function */
    public function payment_data() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'ajax_language';
            $payment = $_POST['payment'];
            $type = $_POST['type'];
            $this->set('pay', $payment);
            $this->set('type', $type);
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Payment Data Function */

    /* Client Upfront Payment Function */
    public function upfront_payment() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->autoRender = false;
            $review_data = $this->Session->read('review_session');
            if ($this->request->is('post')) {
                if (isset($_POST['pay']) and $_POST['pay'] == 'pay') {
                    //$paypal_id = "sanjivkumarpnf-facilitator@gmail.com "; // Sandbox Business email ID
                    $paypal_id = "pay-facilitator@jobider.com"; // Sandbox Business email ID
                    $paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscrr?rm=2&cmd=_xclick&business=' . $paypal_id . '&amount=' . $this->request->data['Paypalpayment']['payment_amount'] . '&currency_code=USD&item_name=' . $review_data['job_title'] . '&custom=' . $review_data['job_id'] . ',' . $review_data['contractor_id'] . ',' . $this->request->data['Paypalpayment']['payment_type'] . '&notify_url=' . BASE_URL . '/client/payment_notify&return=' . BASE_URL . '/client/milestone';
                    $this->Session->write('payment', $this->request->data['Paypalpayment']['payment_amount']);
                    $this->Session->write('type', $this->request->data['Paypalpayment']['payment_type']);
                    header('Location:' . $paypal_url);
                }
            }
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Upfront Payment Function */

    /* Client Payment Notify Function */
    public function payment_notify() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->autoRender = false;
            $this->loadModel('Job');
            $this->loadModel('Paypalpayment');
            $this->loadModel('Hire');
            $this->loadModel('User');
            $this->loadModel('Admin');
            $this->loadModel('Balancepayment');
            $this->loadModel('Upfrontpayment');
            $order_id = $this->generateOrderId();
            if (!empty($_POST)) {
                $data = explode(',', $_POST['custom']);
                $jobs = $this->Job->find('first', array('conditions' => array('Job.id' => $data[0])));
                $admin_data = $this->Admin->find('first');
                $user = $this->User->find('first', array('conditions' => array('User.id' => $data[1], 'User.type' => 'freelancer')));
                $users_data = $this->User->find('first', array('conditions' => array('User.id' => $jobs['Job']['user_id'], 'User.type' => 'client')));
                $amount = number_format($_POST['mc_gross']);
                $pay_data = str_replace(',', '', $amount);
                $remain_bal = $jobs['Job']['budget'] - $pay_data;
                $this->request->data['Paypalpayment']['payment_status'] = $_POST['payment_status'];
                $this->request->data['Paypalpayment']['payment_type'] = 'paypal';
                $this->request->data['Paypalpayment']['payment_date'] = date('Y-m-d h:i:s', strtotime($_POST['payment_date']));
                $this->request->data['Paypalpayment']['payer_id'] = $_POST['payer_id'];
                $this->request->data['Paypalpayment']['payer_email'] = $_POST['payer_email'];
                $this->request->data['Paypalpayment']['transection_id'] = $_POST['txn_id'];
                $this->request->data['Paypalpayment']['payment_amount'] = number_format($_POST['mc_gross'], 0);
                $this->request->data['Paypalpayment']['address_country'] = $_POST['address_country'];
                $this->request->data['Paypalpayment']['address_city'] = $_POST['address_city'];
                $this->request->data['Paypalpayment']['custom'] = $order_id;
                $this->request->data['Paypalpayment']['job_id'] = $data[0];
                $this->request->data['Paypalpayment']['client_id'] = $jobs['Job']['user_id'];
                $this->request->data['Paypalpayment']['freelancer_id'] = $data[1];
                $this->request->data['Paypalpayment']['item_name'] = $_POST['item_name'];
                $this->request->data['Paypalpayment']['pay_status'] = $data[2];
                $this->set($this->request->data);
                if ($data[2] == 'Upfront') {
                    $this->request->data['Balancepayment']['client_id'] = $jobs['Job']['user_id'];
                    $this->request->data['Balancepayment']['freelancer_id'] = $data[1];
                    $this->request->data['Balancepayment']['job_id'] = $data[0];
                    $this->request->data['Balancepayment']['job_payment'] = $jobs['Job']['budget'];
                    $this->request->data['Balancepayment']['remaining_payment'] = $remain_bal;
                    $this->set($this->request->data);
                    $this->Balancepayment->save($this->request->data);
                    //$bal_id = $this->Balancepayment->getLastInsertId();
                    //$this->Session->write('Balance_id', $bal_id);
                    $payment['Upfrontpayment']['job_id'] = $data[0];
                    $payment['Upfrontpayment']['freelancer_id'] = $data[1];
                    $payment['Upfrontpayment']['client_id'] = $jobs['Job']['user_id'];
                    $payment['Upfrontpayment']['payment_type'] = 'paypal';
                    $payment['Upfrontpayment']['payment'] = $pay_data;
                    $this->Upfrontpayment->save($payment);
                }
                $this->request->data['Job']['job_payment'] = 'Full Payment';
                $this->Job->id = $data[0];
                $this->set($this->request->data);
                $this->Job->save($this->request->data);
                if ($this->Paypalpayment->save($this->request->data, array('validate' => false))) {
                    if ($data[2] == 'Upfront') {
                        $Email = new CakeEmail();
                        $Email->template('client_upfront_payment');
                        $Email->emailFormat('html');
                        $Email->viewVars(array('data' => $jobs['Job']['job_title'], 'client_fname' => $users_data['User']['first_name'], 'client_lname' => $users_data['User']['last_name'], 'user_firstname' => $user['User']['first_name'], 'user_lastname' => $user['User']['last_name'], 'amount' => $amount, 'payment_type' => 'Paypal', 'Payment_status' => $data[2], 'remain_balance' => $remain_bal));
                        $Email->from(array('info@jobider.com' => $users_data['User']['first_name'] . '  ' . $users_data['User']['last_name'] . ' via  Jobider'));
                        $Email->to($users_data['User']['email']);
                        $Email->subject('Payment  for ' . $jobs['Job']['job_title'], 'success');
                        $Email->send();
                        $Email->template('client_payment');
                        $Email->emailFormat('html');
                        $Email->viewVars(array('data' => $jobs['Job']['job_title'], 'client_fname' => $users_data['User']['first_name'], 'client_lname' => $users_data['User']['last_name'], 'user_firstname' => $user['User']['first_name'], 'user_lastname' => $user['User']['last_name'], 'amount' => $amount, 'payment_type' => 'Paypal', 'Payment_status' => $data[2]));
                        $Email->from(array('info@jobider.com' => $users_data['User']['first_name'] . '  ' . $users_data['User']['last_name'] . ' via  Jobider'));
                        $Email->to($admin_data['Admin']['email']);
                        $Email->subject('Payment  for ' . $jobs['Job']['job_title'] . ' job', 'success');
                        $Email->send();
                    } else {
                        $Email = new CakeEmail();
                        $Email->template('client_full_payment');
                        $Email->emailFormat('html');
                        $Email->viewVars(array('data' => $jobs['Job']['job_title'], 'client_fname' => $users_data['User']['first_name'], 'client_lname' => $users_data['User']['last_name'], 'user_firstname' => $user['User']['first_name'], 'user_lastname' => $user['User']['last_name'], 'amount' => $amount, 'payment_type' => 'Paypal', 'Payment_status' => $data[2]));
                        $Email->from(array('info@jobider.com' => $users_data['User']['first_name'] . '  ' . $users_data['User']['last_name'] . ' via  Jobider'));
                        $Email->to($user['User']['email']);
                        $Email->subject('Payment  for ' . $jobs['Job']['job_title'], 'success');
                        $Email->send();
                        $Email->template('client_payment');
                        $Email->emailFormat('html');
                        $Email->viewVars(array('data' => $jobs['Job']['job_title'], 'client_fname' => $users_data['User']['first_name'], 'client_lname' => $users_data['User']['last_name'], 'user_firstname' => $user['User']['first_name'], 'user_lastname' => $user['User']['last_name'], 'amount' => $amount, 'payment_type' => 'Paypal', 'Payment_status' => $data[2]));
                        $Email->from(array('info@jobider.com' => $users_data['User']['first_name'] . '  ' . $users_data['User']['last_name'] . ' via  Jobider'));
                        $Email->to($admin_data['Admin']['email']);
                        $Email->subject('Payment  for ' . $jobs['Job']['job_title'] . ' job', 'success');
                        $Email->send();
                    }
                }
            }
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Payment Notify Function */

    /* Client Credit Payment Function */

    public function credit_payment() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->autoRender = false;
            $this->loadModel('Creditpayment');
            $this->loadModel('Milestone');
            $this->loadModel('Hire');
            $this->loadModel('User');
            $this->loadModel('Job');
            $this->loadModel('Admin');
            $order_id = $this->generateOrderId();
            $client_id = $this->Auth->user('id');
            if ($this->request->is('post')) {
                $details = $this->request->data;
                if (!empty($details)) {
                    $credit_data = $this->braintree_payment($details);
                    $milestone = $this->Milestone->find('first', array('conditions' => array('Milestone.id' => $details['Creditpayment']['milestone_id'])));
                    $hire = $this->Hire->find('first', array('conditions' => array('Hire.hiring_id' => $milestone['Milestone']['client_id'], 'Hire.contractor_id' => $milestone['Milestone']['freelancer_id'], 'Hire.job_id' => $milestone['Milestone']['job_id'])));
                    $admin_data = $this->Admin->find('first');
                    $job_data = $this->Job->find('first', array('conditions' => array('JOb.id' => $milestone['Milestone']['job_id'], 'Job.user_id' => $client_id)));
                    $users_data = $this->User->find('first', array('conditions' => array('User.id' => $client_id)));
                    $user = $this->User->find('first', array('conditions' => array('User.id' => $milestone['Milestone']['freelancer_id'])));
                    if (!empty($credit_data)) {
                        if ($this->Creditpayment->validates()) {
                            $amount = number_format($credit_data->transaction->amount, 0);
                            $pay_data = str_replace(',', '', $amount);
                            $credit['Creditpayment']['freelancer_id'] = $milestone['Milestone']['freelancer_id'];
                            $credit['Creditpayment']['client_id'] = $milestone['Milestone']['client_id'];
                            $credit['Creditpayment']['job_id'] = $milestone['Milestone']['job_id'];
                            $credit['Creditpayment']['amount'] = $pay_data;
                            $credit['Creditpayment']['transaction_id'] = $credit_data->transaction->id;
                            $credit['Creditpayment']['card_type'] = $this->request->data['Creditpayment']['card_type'];
                            $credit['Creditpayment']['start_date'] = $this->request->data['Creditpayment']['start_date'];
                            $credit['Creditpayment']['milestone_id'] = $milestone['Milestone']['id'];
                            $credit['Creditpayment']['end_date'] = $this->request->data['Creditpayment']['end_date'];
                            $credit['Creditpayment']['custom'] = $order_id;
                            $credit['Creditpayment']['card_number'] = $this->Auth->password($this->request->data['Creditpayment']['card_number']);
                            $credit['Creditpayment']['cvv'] = $this->Auth->password($this->request->data['Creditpayment']['cvv']);
                            $credit['Creditpayment']['type'] = 'credit_card';
                            $credit['Creditpayment']['pay_status'] = 'milestone';
                            $this->request->data['Milestone']['payment_method'] = 'Credit_card';
                            $this->request->data['Milestone']['milestone_status'] = 'Paid';
                            $this->Milestone->id = $milestone['Milestone']['id'];
                            $this->set($this->request->data);
                            $this->Milestone->save($this->request->data);
                            if (!empty($hire['Hire']['payment'])) {
                                $payment = $hire['Hire']['payment'] . ',' . $pay_data;
                                $milestone_id = $hire['Hire']['milestone_id'] . ',' . $milestone['Milestone']['id'];
                                $this->request->data['Hire']['milestone_id'] = $milestone_id;
                                $this->request->data['Hire']['payment_type'] = 'milestone';
                                $this->request->data['Hire']['payment'] = $payment;
                                $this->Hire->id = $hire['Hire']['id'];
                                $this->set($this->request->data);
                                $this->Hire->save($this->request->data);
                            } else {
                                $this->request->data['Hire']['milestone_id'] = $milestone['Milestone']['id'];
                                $this->request->data['Hire']['payment_type'] = 'milestone';
                                $this->request->data['Hire']['payment'] = $pay_data;
                                $this->Hire->id = $hire['Hire']['id'];
                                $this->set($this->request->data);
                                $this->Hire->save($this->request->data);
                            }
                            if ($this->Creditpayment->save($credit)) {
                                $Email = new CakeEmail();
                                $Email->template('client_milestone_payment');
                                $Email->emailFormat('html');
                                $Email->viewVars(array('data' => $milestone['Milestone']['milestone_title'], 'client_fname' => $users_data['User']['first_name'], 'client_lname' => $users_data['User']['last_name'], 'Job_id' => $job_data['Job']['id'], 'user_firstname' => $user['User']['first_name'], 'user_lastname' => $user['User']['last_name'], 'amount' => $amount, 'payment_type' => 'credit card', 'Payment_status' => 'Milestone'));
                                $Email->from(array('info@jobider.com' => $users_data['User']['first_name'] . '  ' . $users_data['User']['last_name'] . ' via  Jobider'));
                                $Email->to($user['User']['email']);
                                $Email->subject('Hire for ' . $job_data['Job']['job_title'], 'success');
                                $Email->send();
                                $Email->template('milestone_payment');
                                $Email->emailFormat('html');
                                $Email->viewVars(array('data' => $milestone['Milestone']['milestone_title'], 'client_fname' => $users_data['User']['first_name'], 'client_lname' => $users_data['User']['last_name'], 'user_firstname' => $user['User']['first_name'], 'user_lastname' => $user['User']['last_name'], 'amount' => $amount, 'payment_type' => 'credit card'));
                                $Email->from(array('info@jobider.com' => $users_data['User']['first_name'] . '  ' . $users_data['User']['last_name'] . ' via  Jobider'));
                                $Email->to($admin_data['Admin']['email']);
                                $Email->subject('Payment  for ' . $milestone['Milestone']['milestone_title'] . ' milestone', 'success');
                                $Email->send();
                                $this->redirect('/client/transactionHistory');
                            }
                        } else {

                            $this->Creditpayment->validationErrors;
                        }
                    } else {
                        $this->Session->setFlash('Firstly, please enter all fields', 'error_unverify');
                        $last_url = $this->referer();
                        $this->redirect($last_url);
                    }
                }
            }
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Credit Payment Function */

    /* Client Card Payment Function */

    public function card_payment() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->autoRender = false;
            $this->loadModel('Creditpayment');
            $this->loadModel('Job');
            $this->loadModel('Upfrontpayment');
            $this->loadModel('Balancepayment');
            $this->loadModel('User');
            $this->loadModel('Balancepayment');
            $read_data = $this->Session->read('review_session');
            $jobs = $this->Job->find('first', array('conditions' => array('Job.id' => $read_data['job_id'], 'Job.user_id' => $read_data['hiring_id'])));
            $users_data = $this->User->find('first', array('conditions' => array('User.id' => $read_data['hiring_id'])));
            $user = $this->User->find('first', array('conditions' => array('User.id' => $read_data['contractor_id'])));
            $admin_data = $this->Admin->find('first');
            $order_id = $this->generateOrderId();
            if ($this->request->is('post')) {

                $details = $this->request->data;
                $card_value = $this->braintree_payment($details);
                if (!empty($card_value)) {
                    $amount = number_format($card_value->transaction->amount, 0);
                    $pay_data = str_replace(',', '', $amount);
                    $remain_bal = $jobs['Job']['budget'] - $pay_data;
                    $credit['Creditpayment']['freelancer_id'] = $read_data['contractor_id'];
                    $credit['Creditpayment']['client_id'] = $read_data['hiring_id'];
                    $credit['Creditpayment']['job_id'] = $read_data['job_id'];
                    $credit['Creditpayment']['amount'] = $pay_data;
                    $credit['Creditpayment']['transaction_id'] = $card_value->transaction->id;
                    $credit['Creditpayment']['card_type'] = $this->request->data['Creditpayment']['card_type'];
                    $credit['Creditpayment']['start_date'] = $this->request->data['Creditpayment']['start_date'];
                    $credit['Creditpayment']['end_date'] = $this->request->data['Creditpayment']['end_date'];
                    $credit['Creditpayment']['custom'] = $order_id;
                    $credit['Creditpayment']['card_number'] = $this->Auth->password($this->request->data['Creditpayment']['card_number']);
                    $credit['Creditpayment']['cvv'] = $this->Auth->password($this->request->data['Creditpayment']['cvv']);
                    $credit['Creditpayment']['type'] = 'credit_card';
                    $credit['Creditpayment']['pay_status'] = $this->request->data['Creditpayment']['payment_type'];
                    if ($this->request->data['Creditpayment']['payment_type'] == 'Upfront') {
                        $this->request->data['Balancepayment']['client_id'] = $read_data['hiring_id'];
                        $this->request->data['Balancepayment']['freelancer_id'] = $read_data['contractor_id'];
                        $this->request->data['Balancepayment']['job_id'] = $read_data['job_id'];
                        $this->request->data['Balancepayment']['job_payment'] = $jobs['Job']['budget'];
                        $this->request->data['Balancepayment']['remaining_payment'] = $remain_bal;
                        $this->set($this->request->data);
                        $this->Balancepayment->save($this->request->data);
                        $payment['Upfrontpayment']['job_id'] = $read_data['job_id'];
                        $payment['Upfrontpayment']['payment_type'] = 'credit_card';
                        $payment['Upfrontpayment']['freelancer_id'] = $read_data['contractor_id'];
                        $payment['Upfrontpayment']['client_id'] = $read_data['hiring_id'];
                        $payment['Upfrontpayment']['payment'] = $pay_data;
                        $this->Upfrontpayment->save($payment);
                    }

                    if ($this->Creditpayment->save($credit)) {
                        if ($this->request->data['Creditpayment']['payment_type'] == 'Upfront') {
                            $Email = new CakeEmail();
                            $Email->template('client_upfront_payment');
                            $Email->emailFormat('html');
                            $Email->viewVars(array('data' => $jobs['Job']['job_title'], 'client_fname' => $users_data['User']['first_name'], 'client_lname' => $users_data['User']['last_name'], 'user_firstname' => $user['User']['first_name'], 'user_lastname' => $user['User']['last_name'], 'amount' => $amount, 'payment_type' => 'credit card', 'Payment_status' => $this->request->data['Creditpayment']['payment_type'], 'remain_balance' => $remain_bal));
                            $Email->from(array('info@jobider.com' => $users_data['User']['first_name'] . '  ' . $users_data['User']['last_name'] . ' via  Jobider'));
                            $Email->to($users_data['User']['email']);
                            $Email->subject('Payment  for ' . $jobs['Job']['job_title'], 'success');
                            $Email->send();
                            $Email->template('client_payment');
                            $Email->emailFormat('html');
                            $Email->viewVars(array('data' => $jobs['Job']['job_title'], 'client_fname' => $users_data['User']['first_name'], 'client_lname' => $users_data['User']['last_name'], 'user_firstname' => $user['User']['first_name'], 'user_lastname' => $user['User']['last_name'], 'amount' => $amount, 'payment_type' => 'credit card', 'Payment_status' => $this->request->data['Creditpayment']['payment_type']));
                            $Email->from(array('info@jobider.com' => $users_data['User']['first_name'] . '  ' . $users_data['User']['last_name'] . ' via  Jobider'));
                            $Email->to($admin_data['Admin']['email']);
                            $Email->subject('Payment  for ' . $jobs['Job']['job_title'] . ' job', 'success');
                            $Email->send();
                        } else {
                            $Email = new CakeEmail();
                            $Email->template('client_full_payment');
                            $Email->emailFormat('html');
                            $Email->viewVars(array('data' => $jobs['Job']['job_title'], 'client_fname' => $users_data['User']['first_name'], 'client_lname' => $users_data['User']['last_name'], 'user_firstname' => $user['User']['first_name'], 'user_lastname' => $user['User']['last_name'], 'amount' => $amount, 'payment_type' => 'credit card', 'Payment_status' => $this->request->data['Creditpayment']['payment_type']));
                            $Email->from(array('info@jobider.com' => $users_data['User']['first_name'] . '  ' . $users_data['User']['last_name'] . ' via  Jobider'));
                            $Email->to($user['User']['email']);
                            $Email->subject('Payment for ' . $jobs['Job']['job_title'], 'success');
                            $Email->send();
                            $Email->template('client_payment');
                            $Email->emailFormat('html');
                            $Email->viewVars(array('data' => $jobs['Job']['job_title'], 'client_fname' => $users_data['User']['first_name'], 'client_lname' => $users_data['User']['last_name'], 'user_firstname' => $user['User']['first_name'], 'user_lastname' => $user['User']['last_name'], 'amount' => $amount, 'payment_type' => 'credit card', 'Payment_status' => $this->request->data['Creditpayment']['payment_type']));
                            $Email->from(array('info@jobider.com' => $users_data['User']['first_name'] . '  ' . $users_data['User']['last_name'] . ' via  Jobider'));
                            $Email->to($admin_data['Admin']['email']);
                            $Email->subject('Payment  for ' . $jobs['Job']['job_title'] . ' job', 'success');
                            $Email->send();
                        }

                        $this->Session->write('payment', $this->request->data['Creditpayment']['amount']);
                        $this->Session->write('type', $this->request->data['Creditpayment']['payment_type']);
                        $this->redirect('/client/milestone');
                    }
                } else {
                    $last_url = $this->referer();
                    $this->redirect($last_url);
                }
            }
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Card Payment Function */

    /* Client Aplicant Data Function */

    public function aplicant_data() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->autoRender = false;

            $user_id = $_POST['user_id'];
            $job_id = $_POST['job_id'];
            $this->Session->write('job_id', $job_id);
            $arr['suc'] = 'yes';
            $arr['free_id'] = $user_id;
            echo json_encode($arr);
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Aplicant Data Function */

    /* Client Add Milestones Function */

    public function add_milestones() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->autoRender = false;
            $this->loadModel('Milestone');
            $this->loadModel('Balancepayment');

            $milestone = $_POST['data'];
            if (!empty($milestone)) {
                $pay_data = $this->Balancepayment->find('first', array('conditions' => array('Balancepayment.client_id' => $milestone['Milestone']['client_id'], 'Balancepayment.freelancer_id' => $milestone['Milestone']['freelancer_id'], 'Balancepayment.job_id' => $milestone['Milestone']['job_id'])));
                $remain = $pay_data['Balancepayment']['remaining_payment'] - $milestone['Milestone']['payment_amount'];

                if ($milestone['Milestone']['payment_amount'] < $pay_data['Balancepayment']['remaining_payment'] and ( $pay_data['Balancepayment']['remaining_payment'] > 0)) {

                    $milestone_data['Milestone']['job_id'] = $milestone['Milestone']['job_id'];
                    $milestone_data['Milestone']['milestone_title'] = $milestone['Milestone']['milestone_title'];
                    $milestone_data['Milestone']['start_date'] = $milestone['Milestone']['start_date'];
                    $milestone_data['Milestone']['end_date'] = $milestone['Milestone']['end_date'];
                    $milestone_data['Milestone']['payment_amount'] = $milestone['Milestone']['payment_amount'];
                    $milestone_data['Milestone']['client_id'] = $milestone['Milestone']['client_id'];
                    $milestone_data['Milestone']['freelancer_id'] = $milestone['Milestone']['freelancer_id'];
                    $milestone_data['Milestone']['milestone_status'] = 'Ongoing';
                    $this->request->data['Balancepayment']['remaining_payment'] = $remain;
                    $this->Balancepayment->id = $pay_data['Balancepayment']['id'];
                    $this->set($this->request->data);
                    $this->Balancepayment->save($this->request->data);
                    if ($this->Milestone->save($milestone_data)) {
                        
                    }
                } elseif ($milestone['Milestone']['payment_amount'] == $pay_data['Balancepayment']['remaining_payment']) {
                    $milestone_data['Milestone']['job_id'] = $milestone['Milestone']['job_id'];
                    $milestone_data['Milestone']['milestone_title'] = $milestone['Milestone']['milestone_title'];
                    $milestone_data['Milestone']['start_date'] = $milestone['Milestone']['start_date'];
                    $milestone_data['Milestone']['end_date'] = $milestone['Milestone']['end_date'];
                    $milestone_data['Milestone']['payment_amount'] = $milestone['Milestone']['payment_amount'];
                    $milestone_data['Milestone']['client_id'] = $milestone['Milestone']['client_id'];
                    $milestone_data['Milestone']['freelancer_id'] = $milestone['Milestone']['freelancer_id'];
                    $milestone_data['Milestone']['milestone_status'] = 'Ongoing';
                    $this->request->data['Balancepayment']['remaining_payment'] = $remain;
                    $this->Balancepayment->id = $pay_data['Balancepayment']['id'];
                    $this->set($this->request->data);
                    $this->Balancepayment->save($this->request->data);
                    if ($this->Milestone->save($milestone_data)) {
                        
                    }
                }
            }
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Add Milestones Function */

    /* Client Withdraw Request Function */

    public function WithdrawRequest($id = null) {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'front';
            $this->loadModel('Withdrawrequest');
            $Request = $this->Withdrawrequest->find('first', array('conditions' => array('Withdrawrequest.milestone_id' => $id)));
            $this->set('WithdrawResult', $Request);
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Withdraw Request Function */

    /* Client Ajax Activity Function */

    public function ajax_activity() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->autoRender = false;
            $this->loadModel('Withdrawrequest');
            $this->loadModel('Admin');
            $this->loadModel('User');
            $this->loadModel('Job');
            $admin_data = $this->Admin->find('first');
            $Request = $this->Withdrawrequest->find('first', array('conditions' => array('Withdrawrequest.id' => $_POST['request_id'])));
            $freelancer = $this->User->find('first', array('User.id' => $Request['Withdrawrequest']['freelancer_id']));
            $job = $this->Job->find('first', array('conditions' => array('Job.id' => $Request['Withdrawrequest']['job_id'])));
            $Request['Withdrawrequest']['request_status'] = 'accepted';
            $this->Withdrawrequest->id = $_POST['request_id'];

            if ($this->Withdrawrequest->save($Request)) {
                $notification['Notification']['sender_id'] = $_SESSION['Auth']['User']['id'];
                $notification['Notification']['reciever_id'] = $Request['Withdrawrequest']['user_id'];
                $notification['Notification']['status'] = 0;
                $notification['Notification']['url'] = BASE_URL . '/freelancer/activity/' . $Request['Withdrawrequest']['id'];
                $notification['Notification']['notification_msg'] = 'Your request for withdraw payment has been approved.';
                $this->Notification->save($notification, array('validate' => false));
                $Email = new CakeEmail();
                $Email->template('client_withdraw_request');
                $Email->emailFormat('html');
                $Email->viewVars(array('data' => $_POST, 'session' => $_SESSION['Auth'], 'admin' => $freelancer, 'job_title' => $job['Job']['job_title']));
                $Email->from(array('info@jobider.com' => ucfirst($_SESSION['Auth']['User']['first_name']) . ' ' . ucfirst($_SESSION['Auth']['User']['last_name']) . ' via Jobider'));
                $Email->to($freelancer['User']['email']);
                $Email->subject(ucfirst($_SESSION['Auth']['User']['first_name']) . ' ' . ucfirst($_SESSION['Auth']['User']['last_name']) . 'approved request');
                $Email->send();
                $Email->template('client_withdraw_request');
                $Email->emailFormat('html');
                $Email->viewVars(array('data' => $_POST, 'session' => $_SESSION['Auth'], 'admin' => $freelancer, 'job_title' => $job['Job']['job_title']));
                $Email->from(array('info@jobider.com' => ucfirst($_SESSION['Auth']['User']['first_name']) . ' ' . ucfirst($_SESSION['Auth']['User']['last_name']) . ' via Jobider'));
                $Email->to($admin_data['Admin']['email']);
                $Email->subject(ucfirst($_SESSION['Auth']['User']['first_name']) . ' ' . ucfirst($_SESSION['Auth']['User']['last_name']) . 'approved request');
                $Email->send();


                echo json_encode(array('status' => 'true'));
            }
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Ajax Activity Function */

    /* Client Ajax Activity Decline Function */

    public function ajax_activity_decline() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->autoRender = false;
            $this->loadModel('Withdrawrequest');
            $this->loadModel('Admin');
            $this->loadModel('User');
            $this->loadModel('Job');
            $admin_data = $this->Admin->find('first');
            $Request = $this->Withdrawrequest->find('first', array('conditions' => array('Withdrawrequest.id' => $_POST['request_id'])));
            $freelancer = $this->User->find('first', array('conditions' => array('User.id' => $Request['Withdrawrequest']['freelancer_id'])));
            $job = $this->Job->find('first', array('conditions' => array('Job.id' => $Request['Withdrawrequest']['job_id'])));
            $Request['Withdrawrequest']['request_status'] = 'declined';
            $this->Withdrawrequest->id = $_POST['request_id'];
            if ($this->Withdrawrequest->save($Request)) {
                $notification['Notification']['sender_id'] = $_SESSION['Auth']['User']['id'];
                $notification['Notification']['reciever_id'] = $Request['Withdrawrequest']['user_id'];
                $notification['Notification']['status'] = 0;
                $notification['Notification']['url'] = BASE_URL . '/freelancer/activity/' . $Request['Withdrawrequest']['id'];
                $notification['Notification']['notification_msg'] = 'Your request for withdraw payment has been declined by Client.';
                $this->Notification->save($notification, array('validate' => false));
                $Email = new CakeEmail();
                $Email->template('client_decline_request');
                $Email->emailFormat('html');
                $Email->viewVars(array('data' => $_POST, 'session' => $_SESSION['Auth'], 'admin' => $freelancer, 'job_title' => $job['Job']['job_title']));
                $Email->from(array('info@jobider.com' => ucfirst($_SESSION['Auth']['User']['first_name']) . ' ' . ucfirst($_SESSION['Auth']['User']['last_name']) . ' via Jobider'));
                $Email->to($freelancer['User']['email']);
                $Email->subject(ucfirst($_SESSION['Auth']['User']['first_name']) . ' ' . ucfirst($_SESSION['Auth']['User']['last_name']) . 'rejected request');
                $Email->send();
                $Email->template('client_withdraw_request');
                $Email->emailFormat('html');
                $Email->viewVars(array('data' => $_POST, 'session' => $_SESSION['Auth'], 'admin' => $freelancer, 'job_title' => $job['Job']['job_title']));
                $Email->from(array('info@jobider.com' => ucfirst($_SESSION['Auth']['User']['first_name']) . ' ' . ucfirst($_SESSION['Auth']['User']['last_name']) . ' via Jobider'));
                $Email->to($admin_data['Admin']['email']);
                $Email->subject(ucfirst($_SESSION['Auth']['User']['first_name']) . ' ' . ucfirst($_SESSION['Auth']['User']['last_name']) . 'rejected request');
                $Email->send();
                echo json_encode(array('status' => 'true'));
            }
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Ajax Activity Decline Function */

    /* Client All Withdraw Request Function */

    public function AllWithdrawRequest() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'front';
            $this->loadModel('Withdrawrequest');
            $this->loadModel('Paypalpayment');
            $request = $this->Withdrawrequest->find('all', array('conditions' => array('Withdrawrequest.request_status' => '', 'Withdrawrequest.client_id' => $_SESSION['Auth']['User']['id'])));

            foreach ($request as $key => $val) {
                $pay_id = $val['Withdrawrequest']['milestone_id'];

                $paypal = $this->Paypalpayment->find('first', array('conditions' => array('Paypalpayment.id' => $pay_id)));
                $credit = $this->Creditpayment->find('first', array('conditions' => array('Creditpayment.id' => $pay_id)));
                $request[$key]['PaypalInfo'] = $paypal;
                $request[$key]['Creditinfo'] = $credit;
            }
            if ($request) {
                $this->set('Allrequest', $request);
            }
        } else {
            $this->redirect('/login');
        }
    }

    /* Client All Withdraw Request Function */

    /* Client Approved Request Function */

    public function ApprovedRequest() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'front';
            $this->loadModel('Withdrawrequest');
            $this->loadModel('Job');
            $request = $this->Withdrawrequest->find('all', array('conditions' => array('Withdrawrequest.request_status' => 'accepted', 'Withdrawrequest.client_id' => $_SESSION['Auth']['User']['id'])));
            foreach ($request as $key => $val) {
                $job_data = $this->Job->find('first', array('conditions' => array('Job.id' => $val['Withdrawrequest']['job_id'])));
                $request[$key]['job'] = $job_data;
            }
            $this->set('Allrequest', $request);
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Approved Request Function */

    /* Client Decline Request Function */

    public function DeclinedRequest() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'front';
            $this->loadModel('Withdrawrequest');
            $request = $this->Withdrawrequest->find('all', array('conditions' => array('Withdrawrequest.request_status' => 'declined', 'Withdrawrequest.client_id' => $_SESSION['Auth']['User']['id'])));
            $this->set('Allrequest', $request);
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Decline Request Function */

    /* Client Contracts Function */

    public function contracts($id = null) {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'front';
            $this->loadModel('Hire');
            $this->loadModel('Balancepayment');
            $this->loadModel('Milestone');
            $this->loadModel('Paypalpayment');
            $this->loadModel('Creditpayment');
            $last_url = $this->referer();
            $this->set('last_url', $last_url);
            $client_id = $this->Auth->user('id');
            if (isset($_SESSION['user_id']) and !empty($_SESSION['user_id'])) {
                $paypal = $this->Paypalpayment->find('first', array('conditions' => array('Paypalpayment.client_id' => $client_id, 'Paypalpayment.job_id' => $id, 'Paypalpayment.pay_status' => 'full-payment', 'Paypalpayment.freelancer_id' => $_SESSION['user_id'])));
                if (!empty($paypal)) {
                    $crnt_date = time();
                    $selected = strtotime($paypal['Paypalpayment']['payment_date']);
                    $diff = $crnt_date - $selected;
                    $date = $this->secondsToTime($diff);
                    if ($date['d'] > 0) {
                        $text = $date['d'] . ' days ' . 'ago';
                    } else {
                        $text = $date['d'] . ' day ' . 'ago';
                    }
                    $this->set('tect', $text);
                }
                $credit_data = $this->Creditpayment->find('first', array('conditions' => array('Creditpayment.client_id' => $client_id, 'Creditpayment.job_id' => $id, 'Creditpayment.pay_status' => 'full-payment', 'Creditpayment.freelancer_id' => $_SESSION['user_id'])));
                if (!empty($credit_data)) {
                    $crnt_date = time();
                    $selected = strtotime($credit_data['Creditpayment']['created']);
                    $diff = $crnt_date - $selected;
                    $date = $this->secondsToTime($diff);
                    if ($date['d'] > 0) {
                        $text = $date['d'] . ' days ' . 'ago';
                    } else {
                        $text = $date['d'] . ' day ' . 'ago';
                    }
                    $this->set('tect', $text);
                }
                $hire = $this->Hire->find('first', array('conditions' => array('Hire.hiring_id' => $client_id, 'Hire.job_id' => $id, 'Hire.contractor_id' => $_SESSION['user_id'])));
                if (!empty($hire)) {
                    $pay = explode(',', $hire['Hire']['payment']);
                    $pay_count = count($pay);

                    if ($pay_count > 1) {

                        $pay_data = array_sum($pay);
                    } else {

                        $pay_data = $hire['Hire']['payment'];
                    }
                    $remain = $hire['Job']['budget'] - $pay_data;
                    $this->set('remain', $remain);
                    $this->set('pay', $pay_data);
                }
                $milestone = $this->Milestone->find('all', array('conditions' => array('Milestone.client_id' => $client_id, 'Milestone.job_id' => $id, 'Milestone.freelancer_id' => $_SESSION['user_id'])));
                foreach ($milestone as $k => $v) {
                    if ($v['Milestone']['payment_method'] == "Credit_card") {
                        $Creditpayment = $this->Creditpayment->find('first', array('conditions' => array('Creditpayment.milestone_id' => $v['Milestone']['id'])));
                        if (!empty($Creditpayment)) {
                            $due_date = $Creditpayment['Creditpayment']['created'];
                            $crnt_date = time();
                            $selected = strtotime($due_date);
                            $diff = $crnt_date - $selected;
                            $date = $this->secondsToTime($diff);
                            if ($date['d'] > 0) {
                                $text = $date['d'] . ' days ' . 'ago';
                            } else {
                                $text = $date['d'] . ' day ' . 'ago';
                            }
                            $milestone[$k]['Milestone']['due_date'] = $text;
                        }
                    } else {
                        $Paypalpayment = $this->Paypalpayment->find('first', array('conditions' => array('Paypalpayment.milestone_id' => $v['Milestone']['id'])));
                        if (!empty($Paypalpayment)) {
                            $due_date = $Paypalpayment['Paypalpayment']['payment_date'];
                            $crnt_date = time();
                            $selected = strtotime($due_date);
                            $diff = $crnt_date - $selected;
                            $date = $this->secondsToTime($diff);
                            if ($date['d'] > 0) {
                                $text = $date['d'] . ' days ' . 'ago';
                            } else {
                                $text = $date['d'] . ' day ' . 'ago';
                            }
                            $milestone[$k]['Milestone']['due_date'] = $text;
                        }
                    }
                    $hire = $this->Hire->find('first', array('conditions' => array('Hire.job_id' => $v['Milestone']['job_id'], 'Hire.contractor_id' => $_SESSION['user_id'])));
                    $milestone[$k]['Milestone']['set_time'] = $hire['Hire']['created'];
                }
                $this->set('milestone', $milestone);
                $payment = $this->Balancepayment->find('first', array('conditions' => array('Balancepayment.client_id' => $client_id, 'Balancepayment.job_id' => $id)));
                $this->set('payment', $payment);
                $this->set('hire', $hire);
                $this->set('paypal', $paypal);
                $this->set('credit_data', $credit_data);
            }
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Contracts Function */

    /* Client End Contract Function */

    public function end_contract($id = Null) {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'front';
            $this->loadModel('Projectfeedback');
            $this->loadModel('Job');
            $this->loadModel('Hire');
            $client_id = $this->Auth->user('id');
            $admin_data = $this->Admin->find('first');
            $job = $this->Job->find('first', array('conditions' => array('Job.id' => $id, 'Job.user_id' => $client_id)));
            if (isset($_SESSION['user_id']) and !empty($_SESSION['user_id'])) {
                $Hire = $this->Hire->find('first', array('conditions' => array('Hire.job_id' => $id, 'Hire.contractor_id' => $_SESSION['user_id'], 'Hire.hiring_id' => $client_id)));
                $freelancer = $this->User->find('first', array('conditions' => array('User.id' => $Hire['Hire']['contractor_id'])));
                $this->set('hire', $Hire);
            }
            if ($this->request->is('post')) {
                $this->request->data["Projectfeedback"]['client_id'] = $_SESSION['Auth']['User']['id'];
                $this->request->data["Projectfeedback"]['freelancer_id'] = $Hire['Hire']['contractor_id'];
                $this->request->data["Projectfeedback"]['user_type'] = 'client';
                $this->request->data["Projectfeedback"]['job_id'] = $id;
                $data = $this->request->data;
                if ($this->Projectfeedback->save($this->request->data, array('validate' => true))) {
                    $Email = new CakeEmail();
                    $Email->template('end_contract');
                    $Email->emailFormat('html');
                    $Email->viewVars(array('session' => $_SESSION['Auth'], 'admin' => $freelancer, 'job_title' => $job['Job']['job_title'], 'rating' => $data['Projectfeedback']['score'], 'remarks' => $data['Projectfeedback']['feedback']));
                    $Email->from(array('info@jobider.com' => ucfirst($_SESSION['Auth']['User']['first_name']) . ' ' . ucfirst($_SESSION['Auth']['User']['last_name']) . ' via Jobider'));
                    $Email->to($freelancer['User']['email']);
                    $Email->subject(ucfirst($_SESSION['Auth']['User']['first_name']) . ' ' . ucfirst($_SESSION['Auth']['User']['last_name']) . 'end contract');
                    $Email->send();
                    $Email->template('end_contract');
                    $Email->emailFormat('html');
                    $Email->viewVars(array('session' => $_SESSION['Auth'], 'admin' => $freelancer, 'job_title' => $job['Job']['job_title'], 'rating' => $data['Projectfeedback']['score'], 'remarks' => $data['Projectfeedback']['feedback']));
                    $Email->from(array('info@jobider.com' => ucfirst($_SESSION['Auth']['User']['first_name']) . ' ' . ucfirst($_SESSION['Auth']['User']['last_name']) . ' via Jobider'));
                    $Email->to($admin_data['Admin']['email']);
                    $Email->subject(ucfirst($_SESSION['Auth']['User']['first_name']) . ' ' . ucfirst($_SESSION['Auth']['User']['last_name']) . 'end contract');
                    $Email->send();
                    $this->Session->delete('user_id');
                    $hirewss['Hire']['hire_status'] = 'closed';
                    $this->Hire->id = $Hire['Hire']['id'];
                    $this->Hire->save($hirewss, array('validate' => false));
                    $notification['Notification']['sender_id'] = $_SESSION['Auth']['User']['id'];
                    $notification['Notification']['url'] = BASE_URL . '/freelancer/freelancer_profile/' . $id;
                    $notification['Notification']['reciever_id'] = $Hire['Hire']['contractor_id'];
                    $notification['Notification']['notification_msg'] = 'Project has been closed and Feedback is sent';
                    $notification['Notification']['status'] = 0;
                    $this->Notification->save($notification);
                    $this->set('success', 'Feedback is sent and Project is closed.');
                } else {
                    $test = $this->Projectfeedback->validationErrors;
                    if (!empty($test)) {
                        foreach ($test as $key => $value) {
                            foreach ($value as $key => $vaslue) {
                                $arr[] = $vaslue;
                            }
                        }
                    }
                    $this->set('error', $arr);
                }
            }
        } else {
            $this->redirect('/login');
        }
    }

    /* Client End Contract Function */

    /* Client Freelancer Profile Function */

    public function freelancer_profile($user_id = NULL) {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'front';
            $this->loadModel('User');
            $this->loadModel('Subskill');
            $this->loadModel('Subcategory');
            $this->loadModel('Country');
            $this->loadModel('Finalresult');
            $this->loadModel('Result');
            $this->loadModel('Test');
            $this->loadModel('Hire');
            $this->loadModel('Projectfeedback');
            $client_id = $this->Auth->user('id');
            $total_hires = $this->Hire->find('count', array('conditions' => array('Hire.hire_status' => 'Active', 'Hire.contractor_id' => $user_id)));
            $total_completed = $this->Hire->find('count', array('conditions' => array('Hire.hire_status' => 'closed', 'Hire.contractor_id' => $user_id)));
            $Projectfeedback = $this->Projectfeedback->find('all', array('conditions' => array('Projectfeedback.user_type' => 'client', 'Projectfeedback.freelancer_id' => $user_id)));

            if (!empty($Projectfeedback)) {
                foreach ($Projectfeedback as $k => $v) {

                    $free_id = $v['Projectfeedback']['freelancer_id'];
                    $job_id = $v['Projectfeedback']['job_id'];

                    $hire_new = $this->Hire->find('first', array('conditions' => array('Hire.contractor_id' => $v['Projectfeedback']['freelancer_id'])));

                    if (!empty($hire_new)) {
                        $Projectfeedback[$k]['Projectfeedback']['start'] = $hire_new['Hire']['created'];
                    }
                }
            }

            $hire = $this->Hire->find('first', array('conditions' => array('Hire.hiring_id' => $client_id, 'Hire.contractor_id' => $user_id)));
            $this->set('hire', $hire);
            $users = $this->User->find('first', array('conditions' => array('AND' => array('User.id' => $user_id, 'User.description !=' => ''))));
            $task_taken = $this->Finalresult->find('all', array('conditions' => array('Finalresult.user_id' => $user_id, 'Finalresult.percentile' => 'Passed')));
            foreach ($task_taken as $key => $val) {
                $test_id = $val['Finalresult']['test_id'];
                $test = $this->Test->find('all', array('conditions' => array('Test.id' => $test_id)));

                $result = $this->Result->find('all', array('conditions' => array('Result.user_id' => $user_id, 'Result.test_id' => $test_id)));
                $total_result = count($result);
                $result_data = $this->Result->find('all', array('conditions' => array('Result.user_id' => $user_id, 'Result.test_id' => $test_id, 'Result.status' => '1')));
                $right_ans = count($result_data);
                $percent_data = $right_ans / $total_result * 100;
                $task_taken[$key]['percent'] = $percent_data;
                $task_taken[$key]['test'] = $test;
            }
            if (!empty($users)) {
                $skills = explode(',', $users['User']['skills']);
                $country_id = $users['User']['country_id'];
                $country_name = $this->Country->find('first', array('conditions' => array('Country.id' => $country_id)));
                $subskill = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $skills)));
                $limited_skills = $this->Subskill->find('all', array('limit' => 3, 'conditions' => array('Subskill.id' => $skills)));
                $skill_data = array();
                foreach ($limited_skills as $kk => $vv) {
                    $skill_data[] = $vv['Subskill']['skill_name'];
                }
                $value_skills = implode(',', $skill_data);


                $cat_value = array();
                foreach ($subskill as $key => $value) {
                    $cat_value[] = $value['Subskill']['skill_name'];
                }
                $skill_value = implode(',', $cat_value);
                $this->set('skill_value', $skill_value);
                $this->set('subskill', $subskill);
                $this->set('country_name', $country_name);
                $this->set('result_skill', $value_skills);
            }
            $this->set('user_data', $users);

            $this->set('tasks', $task_taken);
            $this->set('Projectfeedback', $Projectfeedback);
            $this->set('total_counts', $total_hires);
            $this->set('total_completed', $total_completed);
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Freelancer Profile Function */

    /* Client Search a freelancer Function */

    public function searchfreelancer($id = null) {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'front';
            $this->loadModel('Skill');
            $this->loadModel('Subcategory');
            $this->loadModel('Subskill');
            $this->loadModel('Country');
            $this->loadModel('User');
            $this->loadModel('Userskill');
            $this->loadModel('Hire');
            $this->loadModel('Job');
            $this->loadModel('Projectfeedback');
            $user_id = $this->Auth->user('id');
            $country_data = $this->Country->find('list', array('conditions' => array('Country.status' => 1), 'fields' => array('Country.name')));
            $Skills = $this->Skill->find('list', array('conditions' => array('Skill.status' => 1), 'fields' => array('Skill.name')));
            if (!empty($id)) {
                $this->paginate = array('limit' => 3, 'conditions' => array('User.type' => 'freelancer', 'User.description !=' => ''), 'order' => 'User.id DESC'
                );
                $search_freelancer = $this->Paginate('User');

                foreach ($search_freelancer as $k => $val) {
                    $subskill = explode(',', $val['User']['skills']);

                    $this->Subskill->recursive = -1;
                    $skillls = $this->Subskill->find('all', array('fields' => array('Subskill.skill_name'), 'conditions' => array('Subskill.id' => $subskill)));
                    $cntry_name = $this->Country->find('first', array('conditions' => array('Country.id' => $val['User']['country_id'], 'Country.status' => 1), 'fields' => array('Country.name')));
                    $subskil = $this->Subskill->find('all', array('limit' => 3, 'conditions' => array('Subskill.id' => $subskill)));
                    $sub_data = array();
                    foreach ($subskil as $kes => $vals) {
                        $sub_data[] = $vals['Subskill']['skill_name'];
                    }
                    $subskills = implode(',', $sub_data);
                    //completed Project 
                    $total_hires = $this->Hire->find('count', array('conditions' => array('Hire.hire_status' => 'Active', 'Hire.contractor_id' => $val['User']['id'])));
                    //Inprocess Project 
                    $total_completed = $this->Hire->find('count', array('conditions' => array('Hire.hire_status' => 'closed', 'Hire.contractor_id' => $val['User']['id'])));
                    //Rating score
                    $Projectfeedback = $this->Projectfeedback->find('all', array('conditions' => array('Projectfeedback.user_type' => 'client', 'Projectfeedback.freelancer_id' => $val['User']['id'])));
                    $scoreVal = 0;
                    $kk = 0;
                    if (!empty($Projectfeedback)) {
                        foreach ($Projectfeedback as $key => $value) {
                            $scoreVal+=$value['Projectfeedback']['score'];
                            $kk++;
                        }
                    }
                    if ($kk != 0) {
                        $score = $scoreVal / $kk;
                    } else {
                        $score = 0;
                    }
                    $search_freelancer[$k]['User']['score'] = $score;
                    $search_freelancer[$k]['User']['inprocess'] = $total_hires;
                    $search_freelancer[$k]['User']['completed'] = $total_completed;
                    $search_freelancer[$k]['User']['realskill'] = $skillls;
                    $search_freelancer[$k]['User']['Country_name'] = $cntry_name;
                    $search_freelancer[$k]['User']['subskills'] = $subskills;
                }

                $serach_freelancer_count = $this->User->find('count',array('conditions'=>array('User.type'=>'freelancer')));
                $this->set('search_count', $serach_freelancer_count);
                $this->set('skill', $Skills);
                $this->set('country', $country_data);
                $this->set('freelancer', $search_freelancer);
                $this->set('job_id', $id);
            } else {
                $this->paginate = array('limit' => 3, 'conditions' => array('User.type' => 'freelancer', 'User.description !=' => ''), 'order' => 'User.id DESC'
                );
                $search_freelancer = $this->Paginate('User');

                foreach ($search_freelancer as $k => $val) {
                    $subskill = explode(',', $val['User']['skills']);

                    $this->Subskill->recursive = -1;
                    $skillls = $this->Subskill->find('all', array('fields' => array('Subskill.skill_name'), 'conditions' => array('Subskill.id' => $subskill)));
                    $cntry_name = $this->Country->find('first', array('conditions' => array('Country.id' => $val['User']['country_id'], 'Country.status' => 1), 'fields' => array('Country.name')));
                    $subskil = $this->Subskill->find('all', array('limit' => 3, 'conditions' => array('Subskill.id' => $subskill)));
                    $sub_data = array();
                    foreach ($subskil as $kes => $vals) {
                        $sub_data[] = $vals['Subskill']['skill_name'];
                    }
                    $subskills = implode(',', $sub_data);
                    //completed Project 
                    $total_hires = $this->Hire->find('count', array('conditions' => array('Hire.hire_status' => 'Active', 'Hire.contractor_id' => $val['User']['id'])));
                    //Inprocess Project 
                    $total_completed = $this->Hire->find('count', array('conditions' => array('Hire.hire_status' => 'closed', 'Hire.contractor_id' => $val['User']['id'])));
                    //Rating score
                    $Projectfeedback = $this->Projectfeedback->find('all', array('conditions' => array('Projectfeedback.user_type' => 'client', 'Projectfeedback.freelancer_id' => $val['User']['id'])));
                    $scoreVal = 0;
                    $kk = 0;
                    if (!empty($Projectfeedback)) {
                        foreach ($Projectfeedback as $key => $value) {
                            $scoreVal+=$value['Projectfeedback']['score'];
                            $kk++;
                        }
                    }
                    if ($kk != 0) {
                        $score = $scoreVal / $kk;
                    } else {
                        $score = 0;
                    }
                    $search_freelancer[$k]['User']['score'] = $score;
                    $search_freelancer[$k]['User']['inprocess'] = $total_hires;
                    $search_freelancer[$k]['User']['completed'] = $total_completed;
                    $search_freelancer[$k]['User']['realskill'] = $skillls;
                    $search_freelancer[$k]['User']['Country_name'] = $cntry_name;
                    $search_freelancer[$k]['User']['subskills'] = $subskills;
                }
                

                $serach_freelancer_count = $this->User->find('count',array('conditions'=>array('User.type'=>'freelancer')));
                $this->set('search_count', $serach_freelancer_count);
                $this->set('skill', $Skills);
                $this->set('country', $country_data);
                $this->set('freelancer', $search_freelancer);
            }
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Search a freelancer Function */

    /* Client Chek Function */

    public function chek() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->autoRender = false;
            $this->loadModel('Subskill');
            $find = $this->Subskill->find('all', array('conditions' => array('Subskill.skill_id' => $_POST['provider'])));
            if ($find) {
                $test = "<select name='data[Subskill][sub_skills]' class= 'form-control sub' ><option value=''>Select Subskill</option>";
                foreach ($find as $k => $v) {
                    $test .= '<option value=' . $v['Subskill']['id'] . '>' . $v['Subskill']['skill_name'];
                }
            }
            $arr['suc'] = 'yes';
            $arr['provide'] = $test;
            echo json_encode($arr);
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Chek Function */

    /* Client Search Freelancer Function Through Ajax */

    public function Search() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'ajax';
            $this->loadModel('User');
            $this->loadModel('Country');
            $this->loadModel('Projectfeedback');
            $this->loadModel('Subskill');
            $this->loadModel('Hire');
            $category = @$_POST['provider'];
            $country = @$_POST['contry'];
            $getCheckedValue = @$_POST['getCheckedValue'];
            $datas = '';
            $c_name = $this->Country->find('first', array('conditions' => array('Country.id' => $country)));
            if (!empty($country)) {
                $this->paginate = array('limit' => 5, 'conditions' => array('User.country_id' => $country, 'User.type' => 'freelancer'));
                $search = $this->Paginate('User');
                $count_data = count($search);
            } elseif (!empty($_POST['getCheckedValue'])) {
                $arrayData = explode(',', $_POST['getCheckedValue']);
                $min = min(array_filter($arrayData));
                $projectFeedback = $this->Projectfeedback->find('all', array(
                    'conditions' => array('Projectfeedback.user_type' => 'client',
                        'Projectfeedback.score >' => $min
                )));
                if (!empty($projectFeedback)) {
                    foreach ($projectFeedback as $key => $value) {
                        $user_id[] = $value['Projectfeedback']['freelancer_id'];
                    }
                    if (!empty($user_id)) {
                        $this->paginate = array('limit' => 5, 'conditions' => array('User.id' => $user_id, 'User.type' => 'freelancer'));
                        $Search_freelancer = $this->Paginate('User');
                    }
                }
            } else {
                $this->paginate = array('limit' => 5, 'conditions' => array('User.type' => 'freelancer'));
                $Search_freelancer = $this->Paginate('User');
                if (!empty($Search_freelancer)) {
                    foreach ($Search_freelancer as $key => $value) {
                        $values = explode(',', $value['User']['skill_id']);
                        $subskills = explode(',', $value['User']['skills']);
                        if (!empty($_POST['provider'])) {
                            if (in_array($_POST['provider'], $values)) {
                                $user_id[] = $value['User']['id'];
                            }
                        }
                        if (!empty($_POST['contry'])) {
                            if ($value['User']['country_id'] == $_POST['contry']) {
                                $user_id[] = $value['User']['id'];
                            }
                        }
                        if (!empty($_POST['subskill'])) {
                            if (in_array($_POST['subskill'], $subskills)) {
                                $user_id[] = $value['User']['id'];
                            }
                        }
                    }
                    if (!empty($user_id)) {
                        $this->paginate = array('limit' => 5, 'conditions' => array('User.id' => $user_id, 'User.type' => 'freelancer'));
                        $Search_freelancer = $this->Paginate('User');
                    }
                }
            }
            if (!empty($Search_freelancer)) {
                foreach ($Search_freelancer as $key => $val) {
                    $category = explode(',', $val['User']['skill_id']);
                    $subskill = explode(',', $val['User']['skills']);
                    if (!empty($_POST['provider'])) {
                        if (in_array($_POST['provider'], $category)) {
                            $id[] = $val['User']['id'];
                        }
                    }
                    if (!empty($_POST['subskill'])) {
                        if (in_array($_POST['subskill'], $subskill)) {
                            $id[] = $val['User']['id'];
                        }
                    }
                    if (!empty($_POST['getCheckedValue'])) {
                        $id[] = $val['User']['id'];
                    }
                }
            }
            if (!empty($id)) {
                $id = array_unique($id);
                $search = $this->User->find('all', array('conditions' => array('User.id' => $id)));
                $count_data = count($search);
            }
            if (!empty($search)) {
                $datas = '';
                foreach ($search as $k => $data) {

                    $skills = explode(',', $data['User']['skills']);
                    $country_id = $data['User']['country_id'];
                    $completed = $this->Hire->find('count', array('conditions' => array('Hire.contractor_id' => $data['User']['id'], 'Hire.hire_status' => 'closed')));
                    $process = $this->Hire->find('count', array('conditions' => array('Hire.contractor_id' => $data['User']['id'], 'Hire.hire_status' => 'Active')));
                    $score = $this->Projectfeedback->find('first', array('conditions' => array('Projectfeedback.freelancer_id' => $data['User']['id'], 'Projectfeedback.user_type' => 'client')));
                    if (!empty($score)) {
                        $score_val = number_format($score['Projectfeedback']['score'], 1);
                    }
                    $subskill = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $skills)));
                    $skill_datas = $this->Subskill->find('all', array('limit' => 3, 'conditions' => array('Subskill.id' => $skills)));
                    $skill_name = array();
                    foreach ($skill_datas as $k => $va) {
                        $skill_name[] = $va['Subskill']['skill_name'];
                    }
                    $skil_name = implode(',', $skill_name);
                    $c_name = $this->Country->find('first', array('conditions' => array('Country.id' => $country_id)));
                    foreach ($subskill as $k => $v) {
                        $skill_data[] = '<button class="subskil" disabled>' . $v['Subskill']['skill_name'] . '</button>';
                    }
                    $datas .= '<div class="bg_white freelaners marg_btm30">
            <div class="green"><a href="' . $this->webroot . 'client/freelancer_profile/' . $data['User']['id'] . '" style="color:#fff; text-decoration:none;" class="makewhite">' . $data['User']['first_name'] . '    ' . $data['User']['last_name'] . '</a> <a href="' . $this->webroot . 'client/contract/' . $data['User']['id'] . '"><button class="btn-sm btn-danger btn_red11 pull-right marg_l20">Hire Me</button></a>';
                    if (empty($data['User']['job_title'])) {
                        $datas.='<span class="date pull-right"></span>';
                    } else {
                        $datas.= '<span class="date pull-right">' . '<a href="' . $this->webroot . 'client/freelancer_profile/' . $data['User']['id'] . '" style="color:#fff; text-decoration:none;" class="makewhite"><i class="mrg_r5"><img alt="" src="' . $this->webroot . 'img/deatil.png"></i>' . $data['User']['job_title'] . '</a>(' . $skil_name . ')</span>';
                    }
                    $datas.='<div class="clearfix"></div></div>
               <div class="col-md-2 col-sm-2 marg_tb15">';
                    if (!empty($data['User']['image'])) {
                        $datas.=' <a href="' . $this->webroot . 'client/freelancer_profile/' . $data['User']['id'] . '"><img class="img-thumbnail" alt=" " src="' . $this->webroot . 'uploads/' . $data['User']['image'] . '" height=auto width="100%"></a>';
                    } else {
                        $datas.='<img class="img-thumbnail" alt=" " src="' . $this->webroot . 'img/freelancer.png" height=auto width="100%">';
                    }$datas.='
               </div>';
                    if (empty($data['User']['description'])) {
                        $datas.='<div class="col-md-10 colsm-10 marg_tb15">
<p style=>No Description Found ,Please Complete your Profile !</p>
</div>';
                    } else {
                        $datas.='
               <div class="col-md-10 colsm-10 marg_tb15 lesval">
                <p>' . substr($data['User']['description'], 0, 100) . '.... 
                <a href="JavaScript:void(0);" class="more">more</a>
                </p>
               </div>
															<div class="col-md-10 colsm-10 marg_tb15 moreval hide">
                <p>' . $data['User']['description'] . '.... 
                <a href="JavaScript:void(0);" class="less">less</a>
                </p>
</div>';
                    }$datas.='
           <div class="clearfix"></div>';
                    if (empty($skill_data)) {
                        $datas.='<hr class="brder_btm1 marg_tb15">
               <div class="tabs_1 col-md-12">
                 <p style="text-align:center">No Skills Added in your profile ! </p>
</div>';
                    } else {
                        $datas.='<hr class="brder_btm1 marg_tb15">
               <div class="tabs_1 col-md-12">  <div class="col-md-10 colsm-10 less_skills ">';
                        if (!empty($skill_data)) {
                            $total_skills = count($skill_data);
                            $j = 0;
                            foreach ($skill_data as $k => $v) {
                                $datas.="$v";
                                if ($j == '5') {
                                    break;
                                }$j++;
                            }
                        }
                        if ($total_skills >= 5) {
                            $datas.='<a href="JavaScript:void(0);" class=" subskil more_skill" style="background: #2A6EB3;color:#fff;text-decoration: none;">More</a>';
                        }
                        $datas.='</div>   <div class="col-md-10 colsm-10  more_skills hide ">';
                        if (!empty($skill_data)) {
                            $total_skills = count($skill_data);
                            $j = 0;
                            foreach ($skill_data as $k => $v) {
                                $datas.="$v";
                                $j++;
                            }
                        }
                        $datas.=' <a href="JavaScript:void(0);" class=" subskil less_skill" style="background: #2A6EB3;color:#fff;text-decoration: none;">Less</a></div></div>';
                    }$datas.= '<div class="clearfix"></div>
               <div class="bg_grey1 pull-left marg_t5">
                 <div class="rating pull-left">';
                    if (!empty($score_val)) {
                        $datas.=' <span class="text_green pull-left">' . $score_val . ' Star</span>';
                    } else {
                        $datas.=' <span class="text_green pull-left"> 0.0 Star</span>';
                    }
                    if (!empty($score['Projectfeedback']['score'])) {
                        $datas.='<ul class=" list-inline pull-left ">  
                                <li> </li>';

                        $score_data = number_format($score['Projectfeedback']['score'], 0);

                        for ($n = 1; $n <= $score_data; $n++) {
                            $datas.='<li>
                                        <img alt="star" src="' . $this->webroot . 'img/star.png">
                                    </li>';
                        }

                        if (number_format($score['Projectfeedback']['score'], 1) == 3.3 or ( number_format($score['Projectfeedback']['score'], 1) == 4.4)) {
                            $datas.='<img alt="star" src="' . $this->webroot . 'img/star_2.png">';
                        }
                        $datas.='</ul>';
                    } else {
                        $datas.='<ul class=" list-inline pull-left ">  
                                <li> </li>';

                        $datas.='</ul>';
                    }
                    $datas.=' </div>
																	<div class="location pull-left">';
                    $datas.='<i><img src="' . $this->webroot . 'img/location.png" alt=""></i><span class=" text_green">' . $c_name['Country']['name'] . '</span>';
                    $datas.='</div>
              <div class="location pull-left">
                <i><img src="' . $this->webroot . 'img/check.png" alt=""></i><span class=" text_green">LAST ACTIVE ' . $date = date('M.d,Y', strtotime($data['User']['created'])) . '</span>
                </div>
                 <div class="location pull-left">
                  <i><img src="' . $this->webroot . 'img/project_img.png" alt=""></i><span class=" text_green">' . $completed . ' Completed projects</span>
                 </div>
                <div class="location pull-left">
                   <i><img src="' . $this->webroot . 'img/project_img.png" alt=""></i><span class=" text_green">' . $process . ' in process</span>
                 </div>
               </div>
              <div class="clearfix"></div>';
                }
            }
            $this->set('search', $datas);
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Search Freelancer Function Through Ajax */


    /* Client Search Function */

    public function Search_bk() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->autoRender = false;
            $this->loadModel('User');
            $this->loadModel('Country');
            $this->loadModel('Subskill');
            $this->Subskill->recursive = -1;
            $category = $_POST['provider'];
            $country = $_POST['contry'];
            $c_name = $this->Country->find('first', array('conditions' => array('Country.id' => $country)));
            if (!empty($country)) {
                $this->paginate = array('limit' => 2, 'conditions' => array('User.country_id' => $country, 'User.image !=' => '', 'User.description !=' => ''));
                $search = $this->paginate('User');

                $count_data = count($search);
            } else {
                $this->paginate = array('limit' => 2, 'conditions' => array('User.type' => 'freelancer'));
                $Search_freelancer = $this->paginate('User');
            }
            if (!empty($Search_freelancer)) {
                foreach ($Search_freelancer as $key => $val) {
                    $category = explode(',', $val['User']['skill_id']);
                    $subskill = explode(',', $val['User']['skills']);
                    if (in_array($_POST['provider'], $category)) {
                        $id[] = $val['User']['id'];
                    }
                    if (!empty($_POST['subskill'])) {
                        if (in_array($_POST['subskill'], $subskill)) {
                            $id[] = $val['User']['id'];
                        }
                    }
                }
            }
            if (!empty($id)) {
                $id = array_unique($id);
                $this->paginate = array('limit' => 2, 'conditions' => array('User.id' => $id, 'User.image !=' => '', 'User.description !=' => ''));
                $search = $this->paginate('User');

                $count_data = count($search);
            }
            if (!empty($search)) {
                $datas = '';
                foreach ($search as $k => $data) {
                    $skills = explode(',', $data['User']['skills']);
                    $country_id = $data['User']['country_id'];
                    $subskill = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $skills)));
                    $c_name = $this->Country->find('first', array('conditions' => array('Country.id' => $country_id)));
                    $subskl = $this->Subskill->find('all', array('limit' => 3, 'conditions' => array('Subskill.id' => $skills)));
                    $subskkl = array();
                    foreach ($subskl as $ks => $vb) {
                        $subskkl[] = $vb['Subskill']['skill_name'];
                    }
                    $subdata = implode(',', $subskkl);
                    $datas .= '<div class="bg_white freelaners marg_btm30">
            <div class="green"><a href="' . $this->webroot . 'client/freelancer_profile/' . $data['User']['id'] . '" class="makewhite" style="text-decoration:none;color: #fff;">' . ucfirst($data['User']['first_name']) . '    ' . ucfirst($data['User']['last_name']) . ' </a><a href="' . $this->webroot . 'client/contract/' . $data['User']['id'] . '"><button class="btn-sm btn-danger btn_red11 pull-right marg_l20">Hire Me</button></a><span class="date pull-right"><a href="' . $this->webroot . 'client/freelancer_profile/' . $data['User']['id'] . '" class="makewhite" style="text-decoration:none;color:#fff"><i class="mrg_r5"><img alt="" src="' . $this->webroot . 'img/deatil.png"></i>' . $data['User']['job_title'] . '</a>(' . $subdata . ')</span>
             <div class="clearfix"></div>  </div>
               <div class="col-md-2 col-sm-2 marg_tb15">
               <a href="' . $this->webroot . 'client/freelancer_profile/' . $data['User']['id'] . '" class="makewhite" style="text-decoration:none;color:#fff;">
                 <img class="img-thumbnail" alt=" " src="' . $this->webroot . 'uploads/' . $data['User']['image'] . '" height=auto width="100%">
                     </a>
               </div>
               <div class="col-md-10 colsm-10 marg_tb15 lesval">
                <p>' . substr($data['User']['description'], 0, 250) . '.... 
                <a href="JavaScript:void(0);" class="more">more</a>
                </p> </div>
    <div class="col-md-10 colsm-10 marg_tb15 moreval hide">
                <p>' . $data['User']['description'] . '.... 
                <a href="JavaScript:void(0);" class="less">less</a>
                </p>
               </div>
           <div class="clearfix"></div>
               <hr class="brder_btm1 marg_tb15">
               <div class="tabs_1 col-md-12">';
                    foreach ($subskill as $k => $v) {
                        $skill_data = '<button class="subskil" disabled>' . $v['Subskill']['skill_name'] . '</button>';
                        $datas.=$skill_data;
                    }
                    $datas.='</div>
                        <div class="clearfix"></div>
               <div class="bg_grey1 pull-left marg_t5">
                 
                 <div class="rating pull-left">
                 <span class="text_green pull-left">4.8 Star</span>
                  <ul class=" list-inline pull-left ">
                  <li><img src="' . $this->webroot . 'img/star.png" alt=""></li>
                  <li><img src="' . $this->webroot . 'img/star.png" alt=""></li>
                  <li><img src="' . $this->webroot . 'img/star.png" alt=""></li>
                  <li><img src="' . $this->webroot . 'img/star.png" alt=""></li>
                  <li><img src="' . $this->webroot . 'img/star.png" alt=""></li>
                  </ul>
                 </div>
																	<div class="location pull-left">';
                    $datas.='<i><img src="' . $this->webroot . 'img/location.png" alt=""></i><span class=" text_green">' . $c_name['Country']['name'] . '</span>';
                    $datas.='</div>
              <div class="location pull-left">
                <i><img src="' . $this->webroot . 'img/check.png" alt=""></i><span class=" text_green">LAST ACTIVE ' . $date = date('M.d,Y', strtotime($data['User']['created'])) . '</span>
                </div>
                 <div class="location pull-left">
                  <i><img src="' . $this->webroot . 'img/project_img.png" alt=""></i><span class=" text_green">12 Completed projects</span>
                 </div>
                <div class="location pull-left">
                   <i><img src="' . $this->webroot . 'img/project_img.png" alt=""></i><span class=" text_green">2 in process</span>
                 </div>
               </div>
              <div class="clearfix"></div>
  </div> ';
                }
            }

            if (!empty($datas)) {
                $arr['suc'] = 'yes';
                $arr['dataDiv'] = $datas;

                $arr['count'] = $count_data;
            } else {
                $arr['suc'] = 'No';
                $datasD = '<div class="bg_white freelaners marg_btm30">
      <div class="green">Search Results
             <div class="clearfix"></div>  </div>
              <div class="clearfix"></div>
               <p style="text-align:center;color:#DD5428;padding:35px;"> No Record (s) Found !</p>
               <div class="tabs_1 col-md-12">
               </div>
                        <div class="clearfix"></div>
              <div class="clearfix"></div>
  </div>';
                $count = 0;
                $arr['dataDivs'] = $datasD;
                $arr['count'] = $count;
            }
            echo json_encode($arr);
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Search Function */

    /* Client Ajax Data Function */

    public function ajax_datas() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->autoRender = false;
            $user_id = $_POST['user_id'];
            $job_id = $_POST['job_id'];

            $arr['suc'] = 'yes';
            $arr['job_id'] = $job_id;
            $this->Session->write('user_id', $user_id);
            echo json_encode($arr);
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Ajax Data Function */

    /* Client View Jobdetail Function */

    public function view_jobdetail($job_id) {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->layout = 'front';
            $this->loadModel('Job');
            $this->loadModel('Subcategory');
            $this->loadModel('Category');
            $this->loadModel('Subskill');
            $this->loadModel('Hire');
            $this->loadModel('Paypalpayment');
            $this->loadModel('Projectfeedback');
            $this->loadModel('Country');
            $client_id = $this->Auth->user('id');
            $job_data = $this->Job->find('first', array('conditions' => array('Job.id' => $job_id, 'Job.user_id' => $client_id)));
            $hires = $this->Hire->find('all', array('conditions' => array('Hire.hiring_id' => $client_id)));
            $jobs_id = array();
            foreach ($hires as $k => $v) {
                $jobs_id[] = $v['Hire']['job_id'];
            }
            $jobs = $this->Job->find('count', array('conditions' => array('Job.user_id' => $client_id)));
            $country_name = $this->Country->find('first', array('conditions' => array('Country.id' => $job_data['User']['country_id'])));
            $this->set('country_name', $country_name);
            $skils = explode(',', $job_data['Job']['skills']);
            $subskill = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $skils)));
            $cateogory = $this->Category->find('first', array('conditions' => array('Category.id' => $job_data['Job']['category_id'])));
            $subcategory = $this->Subcategory->find('first', array('conditions' => array('Subcategory.id' => $job_data['Job']['subcategory_id'])));
            $hire = $this->Hire->find('count', array('conditions' => array('Hire.hiring_id' => $client_id)));
            $spent = $this->Paypalpayment->find('first', array('conditions' => array('Paypalpayment.job_id' => $job_id, 'Paypalpayment.client_id' => $client_id)));
            $feedback = $this->Projectfeedback->find('first', array('conditions' => array('Projectfeedback.job_id' => $job_id, 'Projectfeedback.client_id' => $client_id)));
            $all_open_jobs = $this->Job->find('count', array('conditions' => array('Job.user_id' => $client_id, 'Job.id !=' => $jobs_id)));
            $this->set('OpenJobs', $all_open_jobs);
            if (!empty($feedback)) {
                $count_data = count($feedback['Projectfeedback']['feedback']);
                $this->set('count_data', $count_data);
            }
            $this->set('feedback', $feedback);
            $this->set('spent', $spent);
            $this->set('count_hire', $hire);
            $this->set('job_count', $jobs);
            $this->set('skills', $subskill);
            $this->set('subcategory', $subcategory);
            $this->set('category', $cateogory);
            $this->set('jobs', $job_data);
        } else {
            $this->redirect('/login');
        }
    }

    /* Client View Jobdetail Function */

    /* Client Freelancer Data Function */

    public function freelancer_data() {
        if (isset($_SESSION['Auth']['User']) and $_SESSION['Auth']['User']['type'] == 'client') {
            $this->autoRender = false;
            $job_id = $_POST['job_id'];
            $freelancer_id = $_POST['user_id'];
            $arr['suc'] = 'yes';
            $arr['free_id'] = $freelancer_id;
            $this->Session->write('job_id', $job_id);
            echo json_encode($arr);
        } else {
            $this->redirect('/login');
        }
    }

    /* Client Freelancer Data Function */
}

?>
