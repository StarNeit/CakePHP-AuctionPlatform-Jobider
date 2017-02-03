<?php

App::uses('CakeEmail', 'Network/Email');
ob_start();

class FreelancerController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index', 'freelancer_profile', 'paymentStatus', 'edit_basic_info', 'myapplication', 'applyjob', 'notifications', 'setupPayments_step1', 'jobdetails', 'findjobs', 'findjobsbycategory', 'send_mesg', 'decline_jobs', 'add_skills', 'applicants', 'pay_all', 'PPMassPayHttppost', 'PPHttpPost', 'pay', 'paytest', 'Response', 'view_ended_contract');
    }

    /* Freelancer Index123 Function */

    public function index123() {
        $this->layout = 'front';
        $this->loadModel('User');
        $this->loadModel('Job');
        $this->loadModel('Subcategory');
        $this->loadModel('Subskill');
        $this->loadModel('Category');
        $user_id = $this->Auth->user('id');
        if (!empty($this->request->data['Category']['search'])) {
            $category = $this->Category->find('all', array('conditions' => array('Category.name LIKE' => '%' . $this->request->data['Category']['search'] . '%')));
            $this->Session->write('cat_name', $this->request->data['Category']['search']);
            $this->redirect(array('controller' => 'freelancer', 'action' => 'findjobbycategory'));
        }
        $find_record = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
        $skills = explode(',', $find_record['User']['skills']);
        $subskill_value = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $skills), 'fields' => 'Subskill.id'));
        $subskill_id = array();
        foreach ($subskill_value as $key => $val) {
            $subskill_id[] = $val['Subskill']['id'];
        }
        $this->paginate = array('limit' => 3, 'conditions' => array('Job.skills ' => $subskill_id),
            'order' => 'Job.id DESC',
        );
        $job_detail = $this->Paginate('Job');
        $job_value = array();
        if (!empty($job_detail)) {
            foreach ($job_detail as $ke => $va) {
                foreach ($va as $kk => $vv) {
                    $job_value[] = $vv;
                }
            }
            $input = array_map("unserialize", array_unique(array_map("serialize", $job_value)));
            foreach ($input as $kk => $vv) {
                $crnt_date = time();
                $selected = strtotime($vv['Job']['created']);
                $diff = $crnt_date - $selected;
                $date = $this->secondsToTime($diff);
                $text = $date['d'] . ' days ' . $date['h'] . ' hours ago';
                $input[$kk]['Job']['time_duration'] = $text;
            }
        }
        $category_value = explode(',', $find_record['User']['categories']);
        $category = $this->Subcategory->find('all', array('conditions' => array('Subcategory.id' => $category_value)));
        $this->set('category', $category);
        $this->set('user_value', $find_record);
        $this->set('postedJobs', $input);
    }

    /* Freelancer Index12 Function */

    public function index12() {
        $this->autoRender = false;
        $this->loadModel('User');
        $this->loadModel('Job');
        $this->loadModel('Contect');
        $user_id = $this->Auth->user('id');
        $contect = $this->Contect->find('all', array('conditions' => array('Contect.user_id' => $user_id)));
        foreach ($contect as $k => $v) {
            $job_id = $v['Contect']['job_id'];
            $job = $this->Job->find('all', array('conditions' => array('Job.id' => $job_id)));
        }
        $user = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
        $skills = explode(',', $user['User']['skills']);
    }

    /* Freelancer Index Function */

    public function index() {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {


            $this->layout = 'front';
            $this->loadModel('User');
            $this->loadModel('Job');
            $this->loadModel('Subcategory');
            $this->loadModel('Subskill');
            $this->loadModel('Category');
            $user_id = $this->Auth->user('id');
            if (!empty($this->request->data['Category']['search_freelancer_job'])) {
                $category = $this->Category->find('all', array('conditions' => array('Category.name LIKE' => '%' . $this->request->data['Category']['search_freelancer_job'] . '%')));
                $this->Session->write('cat_name', $this->request->data['Category']['search_freelancer_job']);
                $this->redirect(array('controller' => 'freelancer', 'action' => 'findjobbycategory'));
            }
            $find_record = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
          // pr($find_record); die('hello sapna');
            if (!empty($find_record)) {
                $skills = explode(',', $find_record['User']['skills']);
                $skill_data = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $skills)));
                $jobs = $this->Job->find('all');
                $job_id = array();
                foreach ($jobs as $key => $value) {
                    $skills_id = explode(',', $value['Job']['skills']);
                    foreach ($skills_id as $kk => $vv) {
                        foreach ($skill_data as $k => $v) {
                            if ($v['Subskill']['id'] == $vv) {
                                $job_id[] = $value['Job']['id'];
                            }
                        }
                    }
                }
                $jobId = array_unique($job_id);
                $this->paginate = array(
                    'limit' => 5,
                    'conditions' => array(
                        'Job.id' => $jobId,
                    ),
                    'order' => 'Job.id DESC'
                );
                $data = $this->paginate('Job');
//            pr($data);die;
                foreach ($data as $kk => $vv) {
                    $crnt_date = time();
                    $selected = strtotime($vv['Job']['created']);
                    $diff = $crnt_date - $selected;
                    $date = $this->secondsToTime($diff);
                    $text = $date['d'] . ' days ' . $date['h'] . ' hours ago';
                    $data[$kk]['Job']['time_duration'] = $text;
                }

                $category_value = explode(',', $find_record['User']['categories']);
                $category = $this->Subcategory->find('all', array('conditions' => array('Subcategory.id' => $category_value)));
                $this->set('category', $category);
                $this->set('user_value', $find_record);
                $this->set('postedJobs', $data);
            }
        } else {
            $this->redirect('/login');
        }
    }

    /* Freelancer Freelancer_index Function */

    public function freelancer_index() {
        $this->autoRender = false;
        $this->loadModel('User');
        $this->loadModel('Job');
        $this->loadModel('Subskill');
        $this->Subskill->recursive = -1;
        $user_id = $this->Auth->user('id');
        $user = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
        $skills = explode(',', $user['User']['skills']);
        $skill_data = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $skills)));
        foreach ($skill_data as $key => $val) {
            $skill_id = $val['Subskill']['id'];
            $jobs[] = $this->Job->find('all', array('conditions' => array('Job.skills LIKE' => '%' . $skill_id . '%')));
        }
        $new_array = array();
        foreach ($jobs as $kk => $vv) {
            foreach ($vv as $k => $v) {
                $new_array[] = $v;
            }
        }
        $rest = array_unique($new_array, SORT_REGULAR);
        $jobId = array();
        foreach ($rest as $ke => $vs) {
            $jobId[] = $vs['Job']['id'];
        }
        $this->paginate = array(
            'limit' => 4,
            'conditions' => array(
                'Job.id' => $jobId,
            )
        );
        $data = $this->paginate('Job');
        pr($data);
        die('kdj');
    }

    /* Second To Time Function */

    function secondsToTime($inputSeconds) {

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
    }

    /*
     * Freelancer Change Password Function */

    public function settings() {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('User');
            $session = $this->Session->read();
            $id = $this->Auth->user('id');
            $user = $this->User->find('first', array('conditions' => array('User.id' => $id)));
            $this->set('user', $user);
            if ($this->request->is('post')) {
                $this->User->set($this->data);
                $password_back = $this->request->data['User']['password_old'];
                $hpassword_back = Security::hash($password_back, null, true);
                $this->request->data['User']['password_old'] = $hpassword_back;
                if ($this->request->data['User']['password_old'] == $user['User']['password']) {
                    if ($this->request->data['User']['password_new'] == $this->request->data['User']['password_confirm']) {
                        $password_will_be = $this->request->data['User']['password_new'];
                        $hpassword_back_with = Security::hash($password_will_be, null, true);
                        $this->request->data['User']['password_new'] = $hpassword_back_with;
                        $this->request->data['User']['password'] = $this->request->data['User']['password_new'];
                        $this->User->id = $id;
                        $this->set($this->request->data);
                        if ($this->User->save($this->request->data)) {
                            $this->Session->setFlash('Password Successfully Changed', 'success');
                            $this->redirect(array('controller' => 'freelancer', 'action' => 'settings'));
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

    /* Freelancer All Notification Function */

    public function allNotifications() {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('Notification');
            $user_id = $this->Auth->user('id');
            $this->paginate = array('limit' => 5, 'conditions' => array('AND' => array('Notification.reciever_id' => $user_id, 'Notification.status' => 1)), 'order' => 'Notification.id Desc');
            $all_notifications = $this->paginate('Notification');
            $this->set('Notify', $all_notifications);
        } else {
            $this->redirect('/login');
        }
    }

    /* Freelancer Dashboard Help Function */

    public function dashboardHelp() {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('Help');
            $this->loadModel('Faq');
            if (!empty($this->request->data)) {
                if (!empty($this->request->data['Faq']['search'])) {
                    $this->paginate = array('limit' => 5, 'conditions' => array('Faq.question LIKE' => '%' . $this->request->data['Faq']['search'] . '%'));
                    $search_data = $this->paginate('Faq');
                    $this->set('faq_data', $search_data);
                } else {
                    $error = 'Please enter Search Keyword !';
                    $this->set('error_msg', $error);
                }
            } else {
                $this->paginate = array('limit' => 4,
                    'order' => 'Faq.id ASC'
                );
                $faq_data = $this->paginate('Faq');
                $this->set('faq_data', $faq_data);
            }
            $help_data = $this->Help->find('all', array('conditions' => array('Help.status' => 1), 'fields' => array('Help.id', 'Help.title')));
            $this->set('Help_title', $help_data);
        } else {
            $this->redirect('/login');
        }
    }

    /* Freelancer Dispute Function */

    public function freelancer_dispute() {
        $this->layout = 'front';
    }

    /* Freelancer Single Help Topic Function */

    public function singleHelpTopic($id = NULL) {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('Help');
            $help = $this->Help->find('all', array('conditions' => array('Help.status' => 1)));
            $single_help = $this->Help->find('first', array('conditions' => array('Help.id' => $id, 'Help.status' => 1)));
            $this->set('help_topic', $help);
            $this->set('help', $single_help);
        } else {
            $this->redirect('/login');
        }
    }

    /* Freelancer Notifications Function */

    public function notifications() {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('User');
            $this->loadModel('Notificationsetting');
            $user_id = $this->Auth->user('id');

            $login_user_info = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
            $this->set('email_info', $login_user_info);
            $notificate = $this->Notificationsetting->find('all', array('conditions' => array('Notificationsetting.user_id' => $user_id), 'field' => 'Notificationsetting.check_value'));

            if (!empty($notificate['0']['Notificationsetting']['check_value'])) {
                $check_data = unserialize($notificate['0']['Notificationsetting']['check_value']);
                $this->set('check', $check_data);
            }
        } else {
            $this->redirect('/login');
        }
    }

    /*  Freelancer MemberShip Plans */

    public function Membershipplan() {
        $this->autoRender = false;
        $this->loadModel('User');
        $user_id = $this->Auth->user('id');
        $user = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
        $this->set('user', $user);
    }

    /* Freelancer Setup Payment Function */

    public function setupPayments() {
        $this->layout = 'front';
    }

    /* Freelancer Setup Paymetn Step One Function */

    public function setupPayments_step1() {
        $this->layout = 'front';
    }

    /* Freelancer Setup Payment Step Two Function */

    public function setupPayments_step2() {
        $this->layout = 'front';
    }

    /* Freelancer Edit Basic Information  Function */

    public function edit_basic_info() {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->autoRender = false;
            $this->loadModel('User');
            $session_value = $this->Session->read();
            $user_id = $this->Auth->User('id');
            if ($this->request->is('post') || $this->request->is('put')) {
                $this->User->set($this->request->data);
                if ($this->User->validates()) {
                    $this->request->data['User']['first_name'] = $this->request->data['User']['first_name'];
                    $this->request->data['User']['last_name'] = $this->request->data['User']['last_name'];
                    $this->request->data['User']['email'] = $this->request->data['User']['email_on_edit'];
                    $this->request->data['User']['country_id'] = $this->request->data['User']['country_id'];
                    $this->set($this->request->data);
                    $this->User->id = $user_id;
                    if ($this->User->save($this->request->data)) {
                        $this->redirect(array('controller' => 'freelancer', 'action' => 'editprofile'));
                    }
                } else {
                    $errors = $this->User->validationErrors;
                    $errors['url'] = 'editprofile';
                    $errors['status'] = 'error';
                    echo json_encode($errors);
                    die;
                }
            }
        } else {
            $this->redirect('/login');
        }
    }

    /* Freelancer Edit Profile Data Function */

    /* Freelancer Edit Profile  Function */

    public function editprofile() {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('Country');
            $this->loadModel('User');
            $this->loadModel('Userlanguage');
            $this->loadModel('Dataskill');
            $this->loadModel('Subskill');
            $this->loadModel('Usercategory');
            $this->loadModel('Userbudget');
            $this->loadModel('Subcategory');
            $this->loadModel('Skill');
            $this->loadModel('Category');
            /* Query For Searching */
            if (!empty($this->request->data['Category']['search'])) {
                $category = $this->Category->find('all', array('conditions' => array('Category.name    LIKE' => '%' . $this->request->data['Category']['search'] . '%')));
                $this->Session->write('cat_name', $this->request->data['Category']['search']);
                $this->redirect(array('controller' => 'freelancer', 'action' => 'findjobbycategory'));
            }
            /* Query For Country Name */
            $find = $this->Country->find('list', array('fields' => 'Country.name'));
//        pr($find);die('sdgg');
            /* Session data */
            $session_value = $this->Session->read();
            $user_id = $this->Auth->user('id');
            /* Query For  Sub Skill Name And Sub Skill Id */
            $language = array();
            $proficieny = array();
            $find_language = $this->Userlanguage->find('all', array('conditions' => array('Userlanguage.user_id' => $user_id)));
            foreach ($find_language as $k => $v) {
                $language[] = $v['Userlanguage']['language'];
                $proficieny[] = $v['Userlanguage']['proficiency'];
            }
            $edit_lang = implode(',', $language);
            $edit_pro = implode(',', $proficieny);
            $user_skills = $this->Dataskill->find('all', array('conditions' => array('Dataskill.user_id' => $user_id)));
            $new_array = array();
            foreach ($user_skills as $kk => $vv) {
                $subskill_id = explode(',', $vv['Dataskill']['subskill_id']);
                foreach ($subskill_id as $key => $value) {
                    $new_array[] = $value;
                }
            }
            $res = array_unique($new_array);
            $subskill = $this->Subskill->find('all', array('limit' => 10, 'conditions' => array('Subskill.id' => $res)));
            $skill_name = array();
            foreach ($subskill as $kk => $va) {
                $skill_name[] = $va['Subskill']['skill_name'];
            }
            $us_skill = implode(',', $skill_name);
            $this->set('user_skills', $us_skill);
            $user_skills = $this->Dataskill->find('all', array('conditions' => array('Dataskill.user_id' => $user_id)));
            $new_data = array();
            $SkilId = array();
            foreach ($user_skills as $kk => $vs) {
                $subs = explode(',', $vs['Dataskill']['subskill_id']);
                $skills = explode(',', $vs['Dataskill']['skill_id']);
                foreach ($subs as $ke => $val) {
                    $new_data[] = $val;
                }
                foreach ($skills as $ky => $vl) {
                    $SkilId[] = $vl;
                }
            }
            $SubSkill = array_unique($new_data);
            $Skill = array_unique($SkilId);
            $SubskillId = implode(',', $SubSkill);
            $SkillId = implode(',', $Skill);
            /* Query For Sub Category Name And Sub Category Id */
            $users_categories = $this->Usercategory->find('all', array('conditions' => array('User.id' => $user_id)));
            $new_cate = array();
            foreach ($users_categories as $val) {
                $skill_data = explode(',', $val['Usercategory']['categories']);
                foreach ($skill_data as $kl => $vc) {
                    $new_cate[] = $vc;
                }
            }
            $SubCategory = array_unique($new_cate);
            $data = $this->Subcategory->find('all', array('conditions' => array('Subcategory.id' => $SubCategory)));
            $CategoryName = array();
            foreach ($data as $kk => $vb) {
                $CategoryName[] = $vb['Subcategory']['category_name'];
            }
            $imp_category = implode(',', $CategoryName);
            $this->set('users_categories', $imp_category);
            $users_subcategory = $this->Usercategory->find('all', array('conditions' => array('User.id' => $user_id)));
            $new_sub = array();
            $new_id = array();
            foreach ($users_categories as $val) {
                $skill_data = explode(',', $val['Usercategory']['categories']);
                $categoryId = explode(',', $val['Usercategory']['category_id']);
                foreach ($skill_data as $kl => $vc) {
                    $new_sub[] = $vc;
                }
                foreach ($categoryId as $kks => $vvc) {
                    $new_id[] = $vvc;
                }
            }
            $SubCategoryId = array_unique($new_sub);
            $sub_categoryid = implode(',', $SubCategoryId);
            $CategoryId = array_unique($new_id);
            $category_ids = implode(',', $CategoryId);
            /* Query For Category */
            $category = $this->Category->find('all', array('fields' => array('Category.name')));
            /* Query For Skill */
            $skill_value = $this->Skill->find('all', array('fields' => array('Skill.name')));
            $budget = $this->Userbudget->find('first', array('conditions' => array('Userbudget.user_id' => $user_id)));
            // pr($budget);
            $this->set('budget', $budget);
            $this->set('category', $category);
            $this->set('skill', $skill_value);
            $this->set('find', $find);
            $useerr_value = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
            if ($this->request->is('post')) {
                if ($this->request->data['User']['pro_img']['error'] == '4') {
                    $this->request->data['User']['image'] = $useerr_value['User']['image'];
                } else {
                    $this->request->data['User']['image'] = time() . '_' . $this->request->data['User']['pro_img']['name'];
                    if (move_uploaded_file($this->request->data['User']['pro_img']['tmp_name'], WWW_ROOT . 'uploads/' . time() . '_' . $this->request->data['User']['pro_img']['name']))
                        ;
                }
                $this->request->data['User']['skills'] = $SubskillId;
                $this->request->data['User']['skill_id'] = $SkillId;
                $this->request->data['User']['categories'] = $sub_categoryid;
                $this->request->data['User']['category_id'] = $category_ids;
                $this->request->data['User']['language'] = $edit_lang;
                $this->request->data['User']['proficiency'] = $edit_pro;
                $this->request->data['User']['budget'] = $budget['Userbudget']['budget'];
                $this->User->id = $user_id;
                $this->set($this->request->data);
                if ($this->User->save($this->request->data, array('validate' => false))) {
                    $this->Session->setFlash('Freelancer Data Edit Successfully', 'success');
                }
            }
            /* Query For User */
            $userr_value = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
            /* Query  For Subcategory And Country */
            $category_value = explode(',', $userr_value['User']['categories']);
            $country_id = $userr_value['User']['country_id'];
            $country_name = $this->Country->find('first', array('conditions' => array('Country.id' => $country_id)));
            $category_data = $this->Subcategory->find('all', array('conditions' => array('Subcategory.id' => $category_value)));

            $this->set('category_data', $category_data);
            $this->set('country', $country_name);
            $this->set('user_value', $userr_value);
            $this->set('user_language', $find_language);
        } else {
            $this->redirect('/login');
        }
    }

    public function delete_language() {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->autoRender = false;
            $this->loadModel('Userlanguage');
            $id = $_POST['language'];
            if ($this->Userlanguage->delete($id)) {
                $res['suc'] = 'yes';
                echo json_encode($res);
            }
        } else {
            $this->redirect('/login');
        }
    }

    public function edit_language() {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->autoRender = false;
            $this->loadModel('Userlanguage');
            $user_id = $this->Auth->user('id');
            if ($this->request->is('post')) {
                $this->request->data['Userlanguage']['user_id'] = $user_id;
                $this->set($this->request->data);
                if ($this->Userlanguage->save($this->request->data)) {
//                $this->redirect(array('controller' => 'freelancer', 'action' => 'editprofile'));
                }
            }
        } else {
            $this->redirect('/login');
        }
    }

    public function language_popup_save() {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'ajax_language';
            $this->loadModel('Userlanguage');
            $this->autoRender = FALSE;
            $user_id = $this->Auth->user('id');
            if (!empty($_POST['language']) && !empty($_POST['radio_val'])) {
                $dataToSave['Userlanguage']['language'] = $_POST['language'];
                $dataToSave['Userlanguage']['proficiency'] = $_POST['radio_val'];
            }
            $dataToSave['Userlanguage']['user_id'] = $user_id;
            if ($this->Userlanguage->save($dataToSave)) {
                $id = $this->Userlanguage->getLastInsertId();
                $res = array();
                $res['suc'] = 'y';
                $res['id'] = $id;
                echo json_encode($res);
                die;
            }
        } else {
            $this->redirect('/login');
        }
    }

    public function language_popup() {
        $this->layout = 'ajax_language';
        $this->loadModel('Userlanguage');
        $user_id = $this->Auth->user('id');
    }

    public function edit_languages() {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->autoRender = false;
            $this->loadModel('Userlanguage');
            $user_id = $this->Auth->user('id');
            $data = $_POST['data'];
            if (!empty($data)) {
                $this->request->data['Userlanguage']['proficiency'] = $data['Userlanguage']['proficiency'];
            }
            $this->Userlanguage->id = $data['Userlanguage']['id'];
            $this->set($this->request->data);
            if ($this->Userlanguage->save($this->request->data)) {
                $language = $this->Userlanguage->find('first', array('conditions' => array('Userlanguage.user_id' => $user_id, 'Userlanguage.id' => $data['Userlanguage']['id'])));

                $res['suc'] = 'yes';
                $res['language'] = $language['Userlanguage']['language'];
                ;
                $res['proficiency'] = $language['Userlanguage']['proficiency'];
                ;
                echo json_encode($res);
            }
        } else {
            $this->redirect('/login');
        }
    }

    public function edit_language_popup() {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'ajax_language';
            $this->loadModel('Userlanguage');
            $user_id = $this->Auth->user('id');
            $lang_id = $_POST['lang_id'];
            $data = $this->Userlanguage->find('first', array('conditions' => array('Userlanguage.user_id' => $user_id, 'Userlanguage.id' => $lang_id)));
//        pr($data);
//        die('sdjhasd');
            $this->set('Language_result', $data);
        } else {
            $this->redirect('/login');
        }
    }

    /* Freelancer Find Jobs Function */

    public function findjobs() {
        $this->layout = 'front';
        $this->loadModel('Category');
        $this->loadModel('Jobsubcategory');
        $job_Category = $this->Category->find('all');
        $this->set('jobcategory', $job_Category);
    }

    /* Freelancer Skill Information Function */

    public function skill_info() {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->autoRender = false;
            $this->loadModel('Usercategory');
            $this->loadModel('User');
            $session_value = $this->Session->read();
            $user_cate_id = $this->Auth->user('id');
            if ($this->request->is('post')) {
                $data_id = implode(',', $this->request->data['Usercategory']['category_id']);
                $category_value = implode(',', $this->request->data['Usercategory']['categories']);
                $this->request->data['Usercategory']['categories'] = $category_value;
                $this->request->data['Usercategory']['user_id'] = $user_cate_id;
                $this->request->data['Usercategory']['category_id'] = $data_id;
                $this->set($this->request->data);
                if ($this->Usercategory->save($this->request->data)) {
                    $this->redirect(array('controller' => 'freelancer', 'action' => 'editprofile'));
                }
            }
        } else {
            $this->redirect('/login');
        }
    }

    /* Freelancer Category Date Function */

    public function category_data() {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->autoRender = false;
            $this->loadModel('Dataskill');
            $this->loadModel('User');
            $sess = $this->Session->read();
            $user_data_id = $this->Auth->user('id');

            if ($this->request->is('post')) {
//                pr($this->request->data); die;
                $data_vate = implode(',', $this->request->data['Dataskill']['subskill_id']);

                $data_id = implode(',', $this->request->data['Dataskill']['skill_id']);
                $this->request->data['Dataskill']['subskill_id'] = $data_vate;
                $this->request->data['Dataskill']['user_id'] = $user_data_id;
                $this->request->data['Dataskill']['skill_id'] = $data_id;
                $this->set($this->request->data);
                if ($this->Dataskill->save($this->request->data)) {
                    $this->redirect(array('controller' => 'freelancer', 'action' => 'editprofile'));
                }
            }
        } else {
            $this->redirect('/login');
        }
    }

    /* Freelancer My Application Function */

    public function myapplication123() {
        $this->layout = 'front';
        $this->loadModel('Contect');
        $this->loadModel('User');
        $this->loadModel('Job');
        $user_id = $this->Auth->user('id');
        $contects = $this->Contect->find('all', array('conditions' => array('Contect.user_id' => $user_id)));
        foreach ($contects as $key => $val) {
            $client_id = $val['Contect']['client_id'];
            $all_users = $this->User->find('all', array('conditions' => array('User.id' => $client_id)));
            $crnt_date = time();
            $selected = strtotime($val['Contect']['created']);
            $diff = $crnt_date - $selected;
            $date = $this->secondsToTime($diff);
            $text = $date['h'] . ' hours ago';
            $contects[$key]['Contect']['time_duration'] = $text;
            $contects[$key]['users'] = $all_users;
        }
        $this->set('Contect_data', $contects);
    }

    public function myapplication() {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('Contect');
            $this->loadModel('User');
            $this->loadModel('Job');
            $this->loadModel('Paypalpayment');
            $this->loadModel('Creditpayment');
            $this->loadModel('Withdrawearning');
            $user_id = $this->Auth->user('id');
            $payment_detail = $this->Paypalpayment->find('all', array('conditions' => array('Paypalpayment.freelancer_id' => $user_id)));
            $credit_detail = $this->Creditpayment->find('all', array('conditions' => array('Creditpayment.freelancer_id' => $user_id)));
            $pay_val = array_merge($payment_detail, $credit_detail);
            if (!empty($pay_val)) {
                $pay_amount = array();
                foreach ($pay_val as $kk => $vv) {
                    if (array_key_exists('Paypalpayment', $vv)) {
                        $pay_amount[] = $vv['Paypalpayment']['payment_amount'];
                    }
                    if (array_key_exists('Creditpayment', $vv)) {
                        $pay_amount[] = $vv['Creditpayment']['amount'];
                    }
                }
                $pay_data = array_sum($pay_amount);
            }
            $withdraw = $this->Withdrawearning->find('all', array('conditions' => array('Withdrawearning.freelancer_id' => $user_id)));
            if (!empty($withdraw)) {
                $earning = array();
                foreach ($withdraw as $k => $v) {
                    $earning[] = $v['Withdrawearning']['reciever_amount'];
                }
                $receiver_amount = array_sum($earning);
                //pr($receiver_amount);
            }
            if (!empty($receiver_amount)) {
                $pay_value = $pay_data - $receiver_amount;
            } elseif (!empty($pay_data)) {
                $pay_value = $pay_data;
            } else {
                $pay_value = 0;
            }
            // pr($pay_value);
            $this->set('Payment_earning', $pay_value);
            $this->Contect->recursive = -1;
            $contects = $this->Contect->find('all', array('conditions' => array('Contect.user_id' => $user_id)));
            foreach ($contects as $key => $val) {
                $client_id = $val['Contect']['client_id'];
                $job_id = $val['Contect']['job_id'];
                $this->Job->recursive = -1;
                $Find_job = $this->Job->find('all', array('conditions' => array('Job.id' => $job_id, 'Job.user_id' => $client_id, 'Job.job_status' => '1')));
                foreach ($Find_job as $kk => $vv) {
                    $created = date('d-M-Y', strtotime($val['Contect']['created']));
                    $currentdate = time();
                    $selecteddate = strtotime($val['Contect']['created']);
                    $diff = $currentdate - $selecteddate;
                    $date = $this->secondsToTime($diff);
                    $text = $date['d'] . ' days  ' . $date['h'] . ' hours ago';
                    $clnt_id = $vv['Job']['user_id'];
                    $all_users = $this->User->find('all', array('conditions' => array('User.id' => $clnt_id)));
                    $Find_job[$kk]['user'] = $all_users;
                    $Find_job[$kk]['Contect_created'] = $created;
                    $Find_job[$kk]['timeduration'] = $text;
                }
                $this->set('Contect_data', $Find_job);
            }
        } else {
            $this->redirect('/login');
        }
    }

    /* Freelancer View Contract Function */

    public function View_contract($id = null) {
        $this->layout = 'front';
    }

    /* Freelancer Archieved Application Function */

    public function archapplication() {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('Declinejob');
            $this->loadModel('Job');
            $this->loadModel('Paypalpayment');
            $this->loadModel('Withdrawearning');
            $this->loadModel('Creditpayment');
            $freelancer_id = $this->Auth->user('id');
            $payment_detail = $this->Paypalpayment->find('all', array('conditions' => array('Paypalpayment.freelancer_id' => $freelancer_id)));
            $credit_detail = $this->Creditpayment->find('all', array('conditions' => array('Creditpayment.freelancer_id' => $freelancer_id)));
            $pay_value = array_merge($payment_detail, $credit_detail);
            if (!empty($pay_value)) {
                $pay_amount = array();
                foreach ($pay_value as $kk => $vv) {
                    if (array_key_exists('Paypalpayment', $vv)) {
                        $pay_amount[] = $vv['Paypalpayment']['payment_amount'];
                    }
                    if (array_key_exists('Creditpayment', $vv)) {
                        $pay_amount[] = $vv['Creditpayment']['amount'];
                    }
                }
                $pay_data = array_sum($pay_amount);
            }
            $withdraw = $this->Withdrawearning->find('all', array('conditions' => array('Withdrawearning.freelancer_id' => $freelancer_id)));
            if (!empty($withdraw)) {
                $earning = array();
                foreach ($withdraw as $k => $v) {
                    $earning = $v['Withdrawearning']['reciever_amount'];
                }
                $receiver_amount = array_sum($earning);
            }
            if (!empty($receiver_amount)) {
                $pay_val = $pay_data - $receiver_amount;
            } elseif (!empty($pay_data)) {
                $pay_val = $pay_data;
            } else {
                $pay_val = 0;
            }
            $this->set('Payment_earning', $pay_val);
            $decline_jobs = $this->Declinejob->find('all', array('conditions' => array('Declinejob.freelancer_id' => $freelancer_id)));
            foreach ($decline_jobs as $key => $val) {
                $client_ids = $val['Declinejob']['client_id'];
                $job_ids = $val['Declinejob']['job_id'];
                $this->Job->recursive = -1;
                $Jobs_data = $this->Job->find('first', array('conditions' => array('Job.user_id' => $client_ids, 'Job.id' => $job_ids, 'Job.job_status' => '1')));
                $currentDate = time();
                $selected = strtotime($val['Declinejob']['created']);
                $diff = $currentDate - $selected;
                $date = $this->secondsToTime($diff);
                $text = $date['d'] . ' days ' . $date['h'] . ' hours ago';
                $decline_jobs[$key]['Job_result'] = $Jobs_data;
                $decline_jobs[$key]['timeduration'] = $text;
            }
            $this->set('Archieve_data', $decline_jobs);
        } else {
            $this->redirect('/login');
        }
    }

    public function declinedJobsDetails($job_id = null) {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('Job');
            $this->loadModel('User');
            $this->loadModel('Country');
            $this->loadModel('Subskill');
            $this->loadModel('Contect');
            $this->loadModel('Hire');
            $this->loadModel('Declinejob');
            $freelancer_id = $this->Auth->user('id');
            $Contect_data = $this->Contect->find('first', array('conditions' => array('Contect.user_id' => $freelancer_id, 'Contect.job_id' => $job_id)));
            $client_id = $Contect_data['Contect']['client_id'];
            $Decline_data = $this->Declinejob->find('first', array('conditions' => array('Declinejob.freelancer_id' => $freelancer_id, 'Declinejob.client_id' => $client_id)));
            $all_open_jobs = $this->Job->find('count', array('conditions' => array('Job.user_id' => $client_id, 'Job.id !=' => $job_id)));
            $all_hired = $this->Hire->find('count', array('conditions' => array('Hire.hiring_id' => $client_id)));
            $all_jobs_posted = $this->Job->find('count', array('conditions' => array('Job.user_id' => $client_id)));
            $client_info = $this->User->find('first', array('conditions' => array('User.id' => $client_id)));
            $country_id = $client_info['User']['country_id'];
            $Country = $this->Country->find('first', array('conditions' => array('Country.id' => $country_id)));
            $currentDate = time();
            $selectedDate = strtotime($Contect_data['Contect']['created']);
            $diff = $currentDate - $selectedDate;
            $date = $this->secondsToTime($diff);
            $text = $date['h'] . ' hours ago';
            $job_skills = explode(',', $Contect_data['Job']['skills']);
            $this->Subskill->recursive = -1;
            $skills = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $job_skills)));
            $this->set('Job', $Contect_data);
            $this->set('Skills', $skills);
            $this->set('TimeDuration', $text);
            $this->set('Client_Info', $client_info);
            $this->set('Decline_Info', $Decline_data);
            $this->set('countOpenJobs', $all_open_jobs);
            $this->set('countHiredJobs', $all_hired);
            $this->set('countPostedJobs', $all_jobs_posted);
            $this->set('Client_Country', $Country);
        } else {
            $this->redirect('/login');
        }
    }

    /* Freelancer Sent Application Function */

    public function sentapplication() {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('Jobdetail');
            $this->loadModel('Paypalpayment');
            $this->loadModel('User');
            $this->loadModel('Withdrawearning');
            $this->loadModel('Creditpayment');
            $user_id = $this->Auth->User('id');
            $freelancer = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
            $remain = $freelancer['User']['connects'] - $freelancer['User']['used_connects'];
            $this->set('remain', $remain);
            $this->set('freelancer', $freelancer);
            $payment_detail = $this->Paypalpayment->find('all', array('conditions' => array('Paypalpayment.freelancer_id' => $user_id)));
            $credit_detail = $this->Creditpayment->find('all', array('conditions' => array('Creditpayment.freelancer_id' => $user_id)));
            $pay_value = array_merge($payment_detail, $credit_detail);
            if (!empty($pay_value)) {
                $pay_amount = array();
                foreach ($pay_value as $kk => $vv) {
                    if (array_key_exists('Paypalpayment', $vv)) {
                        $pay_amount[] = $vv['Paypalpayment']['payment_amount'];
                    }
                    if (array_key_exists('Creditpayment', $vv)) {
                        $pay_amount[] = $vv['Creditpayment']['amount'];
                    }
                }
                $pay_data = array_sum($pay_amount);
            }
            $withdraw = $this->Withdrawearning->find('all', array('conditions' => array('Withdrawearning.freelancer_id' => $user_id)));
            if (!empty($withdraw)) {
                $earning = array();
                foreach ($withdraw as $k => $v) {
                    $earning = $v['Withdrawearning']['reciever_amount'];
                }
                $receiver_amount = array_sum($earning);
            }
            if (!empty($receiver_amount)) {
                $pay_val = $pay_data - $receiver_amount;
            } elseif (!empty($pay_data)) {
                $pay_val = $pay_data;
            } else {
                $pay_val = 0;
            }
            $this->set('Payment_earning', $pay_val);
            $Job_details = $this->Jobdetail->find('all', array('conditions' => array('Jobdetail.freelancer_id' => $user_id)));
            $count = count($Job_details);

            foreach ($Job_details as $key => $value) {
                // pr($value);
                // $remaining = $value['Jobdetail']['remaining_job'];
                $crnt_date = time();
                $selected = strtotime($value['Jobdetail']['created']);
                $diff = $crnt_date - $selected;
                $date = $this->secondsToTime($diff);
                if ($date['d'] > 0) {
                    $text = $date['d'] . '  days  ' . 'ago';
                } else {
                    $text = $date['d'] . '  day  ' . 'ago';
                }
                $Job_details[$key]['Jobdetail']['time_duration'] = $text;
            }


            $this->set('Jobdetails', $Job_details);
        } else {
            $this->redirect('/login');
        }
    }

    /* Freelancer Invitation To Interviews  Function */

    public function invinterview() {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('Job');
            $this->loadModel('User');
            $this->loadModel('Contect');
            $this->loadModel('Paypalpayment');
            $this->loadModel('Withdrawearning');
            $this->loadModel('Creditpayment');
            $free_id = $this->Auth->user('id');
            $payment_detail = $this->Paypalpayment->find('all', array('conditions' => array('Paypalpayment.freelancer_id' => $free_id)));
            $cerdit_detail = $this->Creditpayment->find('all', array('conditions' => array('Creditpayment.freelancer_id' => $free_id)));
            $pay_value = array_merge($payment_detail, $cerdit_detail);
            if (!empty($pay_value)) {
                $pay_amount = array();
                foreach ($pay_value as $kk => $vv) {
                    if (array_key_exists('Paypalpayment', $vv)) {
                        $pay_amount[] = $vv['Paypalpayment']['payment_amount'];
                    }
                    if (array_key_exists('Creditpayment', $vv)) {
                        $pay_amount[] = $vv['Creditpayment']['amount'];
                    }
                }
                $pay_data = array_sum($pay_amount);
            }
            $withdraw = $this->Withdrawearning->find('all', array('conditions' => array('Withdrawearning.freelancer_id' => $free_id)));
            if (!empty($withdraw)) {
                $earning = array();
                foreach ($withdraw as $k => $v) {
                    $earning = $v['Withdrawearning']['reciever_amount'];
                }
                $receiver_amount = array_sum($earning);
            }
            if (!empty($receiver_amount)) {
                $pay_val = $pay_data - $receiver_amount;
            } elseif (!empty($pay_data)) {
                $pay_val = $pay_data;
            } else {
                $pay_val = 0;
            }
            $this->set('Payment_earning', $pay_val);
            $this->Contect->recursive = -1;
            $all_contect_data = $this->Contect->find('all', array('conditions' => array('Contect.user_id' => $free_id)));

            foreach ($all_contect_data as $key => $val) {
                $client_id = $val['Contect']['client_id'];
                $job_id = $val['Contect']['job_id'];
                $this->Job->recursive = -1;
                $Find_job = $this->Job->find('all', array('conditions' => array('Job.user_id' => $client_id, 'Job.id' => $job_id, 'Job.job_status' => '0')));
                foreach ($Find_job as $k => $v) {
                    $created = date('d-M-Y', strtotime($val['Contect']['created']));
                    $currentDate = time();
                    $selectedDate = strtotime($created);
                    $diff = $currentDate - $selectedDate;
                    $date = $this->secondsToTime($diff);
                    $text = $date['h'] . ' hours ago';
                    $users_id = $v['Job']['user_id'];
                    $all_users = $this->User->find('all', array('conditions' => array('User.id' => $users_id)));
                    $Find_job[$k]['user'] = $all_users;
                    $Find_job[$k]['Contect_created'] = $created;
                    $Find_job[$k]['timeduration'] = $text;
                }
                $this->set('Job', $Find_job);
            }
        } else {
            $this->redirect('/login');
        }
    }

    /* Freelancer Reporting Function */

    public function reporting() {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('Paypalpayment');
            $this->loadModel('Hire');
            $this->loadModel('User');
            $this->loadModel('Paypalpayment');
            $this->loadModel('Creditpayment');
            $this->loadModel('Withdrawrequest');
            $this->loadModel('Withdrawearning');
            $this->loadModel('Creditpayment');
            $freelancer_id = $this->Auth->user('id');
            $payment_detail = $this->Paypalpayment->find('all', array('conditions' => array('Paypalpayment.freelancer_id' => $freelancer_id)));
            $credit_detail = $this->Creditpayment->find('all', array('conditions' => array('Creditpayment.freelancer_id' => $freelancer_id)));
            $pay_value = array_merge($credit_detail, $payment_detail);
            if (!empty($pay_value)) {
                $pay_amount = array();
                foreach ($pay_value as $kk => $vv) {
                    if (array_key_exists('Paypalpayment', $vv)) {
                        $pay_amount[] = $vv['Paypalpayment']['payment_amount'];
                    }
                    if (array_key_exists('Creditpayment', $vv)) {
                        $pay_amount[] = $vv['Creditpayment']['amount'];
                    }
                }
                $pay = array_sum($pay_amount);
            }
            $withdraw_earnings = $this->Withdrawearning->find('all', array('conditions' => array('Withdrawearning.freelancer_id' => $freelancer_id)));
//        pr($withdraw_earnings);
            if (!empty($withdraw_earnings)) {
                $receiver_amount = array();
                foreach ($withdraw_earnings as $k => $v) {
                    $receiver_amount[] = $v['Withdrawearning']['receiver_amount'];
                }
                $receiver_amount_sum = array_sum($receiver_amount);
            }
            if (!empty($receiver_amount_sum)) {
                $var = $pay - $receiver_amount_sum;
            } elseif (!empty($pay)) {
                $var = $pay;
            } else {
                $var = 0;
            }
            $this->set('Payment_earning', $var);
            $this->paginate = array(
                'limit' => 4,
                'conditions' => array(
                    'Paypalpayment.freelancer_id' => $freelancer_id,
                ), 'order' => 'Paypalpayment.id desc'
            );
            $payments = $this->paginate('Paypalpayment');
            $this->paginate = array(
                'limit' => 4,
                'conditions' => array(
                    'Creditpayment.freelancer_id' => $freelancer_id,
                ),
                'order' => 'Creditpayment.id desc'
            );
            $credits = $this->paginate('Creditpayment');
            if ($this->request->is('post')) {
                $start_date = date('Y-m-d', strtotime($this->request->data['Paypalpayment']['start_date']));
                $end_date = date('Y-m-d', strtotime($this->request->data['Paypalpayment']['end_date']));
                $credits = $this->Creditpayment->find('all', array('conditions' => array('date(Creditpayment.created) between ? and ?' => array($start_date, $end_date), 'Creditpayment.client_id' => $this->request->data['Paypalpayment']['freelancer'], $this->request->data['Paypalpayment']['transaction'] == 'debit', 'Creditpayment.type' => 'credit_card', 'Creditpayment.freelancer_id' => $freelancer_id)));
                $payments = $this->Paypalpayment->find('all', array('conditions' => array('date(Paypalpayment.payment_date) between ? and ?' => array($start_date, $end_date), 'Paypalpayment.client_id' => $this->request->data['Paypalpayment']['freelancer'], $this->request->data['Paypalpayment']['transaction'] == 'debit', 'Paypalpayment.payment_type' => 'paypal', 'Paypalpayment.freelancer_id' => $freelancer_id)));
            }
            $hires = $this->Hire->find('all', array('conditions' => array('Hire.contractor_id' => $freelancer_id)));
            $this->set('hire', $hires);
            $pay_id = array();
            $amount = array();
            $budget = array();
            foreach ($payments as $k => $vall) {
                $amount[] = $vall['Paypalpayment']['payment_amount'];
                $budget[] = $vall['Job']['budget'];
                $pay_id[] = $vall['Paypalpayment']['id'];
                $request = $this->Withdrawrequest->find('first', array('conditions' => array('Withdrawrequest.user_id' => $freelancer_id, 'Withdrawrequest.milestone_id' => $pay_id)));
                $payments[$k]['withdraw'] = $request;
            }
            $sum_budget = array_sum($budget);
            $sum_paypal = array_sum($amount);
            $pay_data = array();
            $bugdte = array();
            $pay_id = array();
            foreach ($credits as $k => $vals) {
                $pay_data[] = $vals['Creditpayment']['amount'];
                $bugdte[] = $vals['Job']['budget'];
                $pay_id[] = $vals['Creditpayment']['id'];
                $request = $this->Withdrawrequest->find('first', array('conditions' => array('Withdrawrequest.user_id' => $freelancer_id, 'Withdrawrequest.milestone_id' => $pay_id)));
                $credits[$k]['withdraw'] = $request;
            }
            $sums = array_sum($pay_data);
            $total = $sum_paypal + $sums;
            $budgte_sum = array_sum($bugdte);
            $total_budget = $sum_budget + $budgte_sum;
            $ending_total = $total_budget - $total;
            $this->set('end_total', $ending_total);
            $this->set('total_budgte', $total_budget);
            $this->set('total_amnt', $total);
            $payment_data = array_merge($payments, $credits);
//        pr($payment_data);
//        die;
            $this->set('payment', $payment_data);
        } else {
            $this->redirect('/login');
        }
    }

    /* Freelancer View Earning Function */

    public function viewearning() {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('Milestone');
            $this->loadModel('Job');
            $this->loadModel('User');
            $this->loadModel('Paypalpayment');
            $this->loadModel('Withdrawrequest');
            $this->loadModel('Withdrawearning');
            $this->loadModel('Creditpayment');
            $freelancer_id = $this->Auth->user('id');
            $this->paginate = array(
                'limit' => 4,
                'conditions' => array(
                    'Milestone.freelancer_id' => $freelancer_id,
                    'Milestone.milestone_status' => 'Paid'
                ),
                'order' => 'Milestone.id DESC'
            );
            $milestones = $this->paginate('Milestone');
            if ($this->request->is('post')) {
                $start = str_replace('/', '-', date('d/m/Y', strtotime($this->request->data['Milestone']['start_date'])));
                $end = str_replace('/', '-', date('d/m/Y', strtotime($this->request->data['Milestone']['end_date'])));
                $this->paginate = array(
                    'limit' => 5,
                    'conditions' => array('AND' => array(
                            'Milestone.freelancer_id' => $freelancer_id,
                            'Milestone.client_id' => $this->request->data['Milestone']['client'],
                            'Milestone.start_date' => $start,
                            'Milestone.end_date' => $end,
                        )),
                    'order' => 'Milestone.id desc'
                );
                $milestones = $this->paginate('Milestone');
            }
            $milestone_id = array();
            foreach ($milestones as $k => $v) {
                $milestone_id[] = $v['Milestone']['id'];
                $user = $this->User->find('first', array('conditions' => array('User.id' => $v['Milestone']['client_id'])));
                $balance = $v['Job']['budget'] - $v['Milestone']['payment_amount'];
                $request = $this->Withdrawrequest->find('first', array('conditions' => array('Withdrawrequest.user_id' => $freelancer_id, 'Withdrawrequest.milestone_id' => $v['Milestone']['id'], 'Withdrawrequest.status' => ' ')));
                $milestones[$k]['withdraw'] = $request;
                $milestones[$k]['user'] = $user;
                $milestones[$k]['balance'] = $balance;
            }
//        pr($milestone_id);
            //pr($milestones); die;
            $payment_detail = $this->Paypalpayment->find('all', array('conditions' => array('Paypalpayment.freelancer_id' => $freelancer_id, 'Paypalpayment.milestone_id' => $milestone_id)));
            $credit_detail = $this->Creditpayment->find('all', array('conditions' => array('Creditpayment.freelancer_id' => $freelancer_id, 'Creditpayment.milestone_id' => $milestone_id)));
            $pay_value = array_merge($credit_detail, $payment_detail);
            if (!empty($pay_value)) {
                $pay_amount = array();
                foreach ($pay_value as $kk => $vv) {
                    if (array_key_exists('Paypalpayment', $vv)) {
                        $pay_amount[] = $vv['Paypalpayment']['payment_amount'];
                    }
                    if (array_key_exists('Creditpayment', $vv)) {
                        $pay_amount[] = $vv['Creditpayment']['amount'];
                    }
                }
                $pay_amount_sum = array_sum($pay_amount);
            }
            $withdraw_earnings = $this->Withdrawearning->find('all', array('conditions' => array('Withdrawearning.freelancer_id' => $freelancer_id)));
            if (!empty($withdraw_earnings)) {
                $receiver_amount = array();
                foreach ($withdraw_earnings as $k => $v) {
                    $receiver_amount[] = $v['Withdrawearning']['receiver_amount'];
                }
                $receiver_amount_sum = array_sum($receiver_amount);
            } if (!empty($receiver_amount_sum)) {
                $var = $pay_amount_sum - $receiver_amount_sum;
            } elseif (!empty($pay_amount_sum)) {
                $var = $pay_amount_sum;
            } else {
                $var = 0;
            }
            $this->set('milestone', $milestones);
            $this->set('Payment_earning', $var);
        } else {
            $this->redirect('/login');
        }
    }

    public function viewearning1() {
        $this->layout = 'front';
        $this->loadModel('Milestone');
        $this->loadModel('Job');
        $this->loadModel('User');
        $this->loadModel('Paypalpayment');
        $this->loadModel('Withdrawrequest');
        $user_id = $this->Auth->user('id');
        $this->Job->recursive = -1;
        $this->User->recursive = -1;
        $getAllWithdrawrequestId = $this->Withdrawrequest->find('all', array('conditions' => array('Withdrawrequest.request_status !=' => '')));

        if (!empty($getAllWithdrawrequestId)) {
            foreach ($getAllWithdrawrequestId as $key => $value) {
                $withdraw_id[] = $value['Withdrawrequest']['milestone_id'];
            }
        }
        if (isset($withdraw_id) and !empty($withdraw_id)) {
            $this->paginate = array(
                'limit' => 4,
                'conditions' => array(
                    'Milestone.freelancer_id' => $user_id,
                    'Milestone.id !=' => $withdraw_id,
                    'Milestone.milestone_status' => 'Paid'
                ), 'order' => 'Milestone.id desc'
            );
        } else {
            $this->paginate = array(
                'limit' => 4,
                'conditions' => array(
                    'Milestone.freelancer_id' => $user_id,
                    'Milestone.milestone_status' => 'Paid'
                ),
                'order' => 'Milestone.id desc',
            );
        }
        $milestones = $this->paginate('Milestone');
        pr($milestones);
        if ($this->request->is('post')) {
            $start = str_replace('/', '-', date('d/m/Y', strtotime($this->request->data['Milestone']['start_date'])));
            $end = str_replace('/', '-', date('d/m/Y', strtotime($this->request->data['Milestone']['end_date'])));
            $this->paginate = array(
                'limit' => 5,
                'conditions' => array('AND' => array(
                        'Milestone.freelancer_id' => $user_id,
                        'Milestone.client_id' => $this->request->data['Milestone']['client'],
                        'Milestone.start_date' => $start,
                        'Milestone.end_date' => $end,
                    )),
                'order' => 'Milestone.id desc'
            );
            $milestones = $this->paginate('Milestone');
        }
        foreach ($milestones as $k => $v) {
            $user = $this->User->find('first', array('conditions' => array('User.id' => $v['Milestone']['client_id'])));
            $balance = $v['Job']['budget'] - $v['Milestone']['payment_amount'];
            $milestones[$k]['user'] = $user;
            $milestones[$k]['balance'] = $balance;
        }
        $payment_detail = $this->Paypalpayment->find('all', array('conditions' => array('Paypalpayment.freelancer_id' => $user_id)));
        if (!empty($payment_detail)) {
            foreach ($payment_detail as $kk => $vv) {
                $pay_amount = $vv['Paypalpayment']['payment_amount'];
            }
            $this->set('Payment_earning', $pay_amount);
        }
        $this->set('milestone', $milestones);
    }

    public function membership_plans() {
        $this->layout = 'front';
        $this->loadModel('User');
        $userdata = $this->User->find('first', array('conditions' => array('User.id' => $this->Auth->user('id'))));
        $start_date = date('M d,Y', strtotime($userdata['User']['add_time']));
        $date = strtotime($userdata['User']['add_time']);
        $end_date = date('M d,Y', strtotime('+1 month', $date));
        $this->set('start_date', $start_date);
        $this->set('end_date', $end_date);
        $this->set('userdata', $userdata);
    }

    public function previousEarnings() {
        $this->layout = 'front';
        $this->loadModel('Paypalpayment');
        $user_id = $this->Auth->user('id');
        $Payment_earning = $this->Paypalpayment->find('all', array('conditions' => array('Paypalpayment.freelancer_id' => $user_id)));
        if (!empty($Payment_earning)) {
            foreach ($Payment_earning as $key => $val) {
                $payment_amount = $val['Paypalpayment']['payment_amount'];
            }
            $this->set('earning_amount', $payment_amount);
        }
    }

    public function viewMilestoneDetail($m_id = null) {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('Milestone');
            $this->loadModel('User');
            $this->loadModel('Subskill');
            $this->loadModel('Category');
            $this->loadModel('Subcategory');
            $this->loadModel('Country');
            $this->loadModel('Hire');
            $this->loadModel('Job');
            $freelancer_id = $this->Auth->user('id');
            $last_url = $this->referer();
            $this->set('last_url', $last_url);
            $Find_record = $this->Milestone->find('first', array('conditions' => array('Milestone.id' => $m_id, 'Milestone.freelancer_id' => $freelancer_id)));
            $client_id = $Find_record['Milestone']['client_id'];
            $Client_info = $this->User->find('first', array('conditions' => array('User.id' => $client_id)));
            $country_id = $Client_info['User']['country_id'];
            $Client_country = $this->Country->find('first', array('conditions' => array('Country.id' => $country_id)));
            $job_skills = explode(',', $Find_record['Job']['skills']);
            $job_id = $Find_record['Job']['id'];
            $job_budget = $Find_record['Job']['budget'];
            $Milestone_amount = $Find_record['Milestone']['payment_amount'];
            $pending_balance = $Find_record['Job']['budget'] - $Find_record['Milestone']['payment_amount'];
            $category_id = $Find_record['Job']['category_id'];
            $subcategory_id = $Find_record['Job']['subcategory_id'];
            $Job_category = $this->Category->find('first', array('conditions' => array('Category.id' => $category_id)));
            $Job_subcategory = $this->Subcategory->find('first', array('conditions' => array('Subcategory.id' => $subcategory_id)));
            $Skill_job = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $job_skills)));
            $hired_result = $this->Hire->find('count', array('conditions' => array('Hire.contractor_id' => $freelancer_id)));
            $Posted = $this->Job->find('count', array('conditions' => array('Job.user_id' => $client_id)));
            $Job_detail_data = $this->Jobdetail->find('all', array('conditions' => array('Jobdetail.job_id' => $job_id, 'Jobdetail.freelancer_id' => $freelancer_id)));
            $jobId = array();
            if (!empty($Job_detail_data)) {
                foreach ($Job_detail_data as $key => $val) {
                    $jobId[] = $val['Jobdetail']['job_id'];
                }
            }
            $Hire_data = $this->Hire->find('all', array('conditions' => array('Hire.hiring_id' => $client_id, 'Hire.job_id' => $job_id)));
            $jobid = array();
            if (!empty($Hire_data)) {
                foreach ($Hire_data as $kk => $vv) {
                    $jobid[] = $vv['Hire']['job_id'];
                }
            }
            $all_jobids = array_merge($jobId, $jobid);
            $Open_jobs = $this->Job->find('count', array('conditions' => array('Job.id !=' => $all_jobids, 'Job.user_id' => $client_id)));
            $this->set('Detail', $Find_record);
            $this->set('Skill_info', $Skill_job);
            $this->set('Client', $Client_info);
            $this->set('Balance', $pending_balance);
            $this->set('Category', $Job_category);
            $this->set('SubCategory', $Job_subcategory);
            $this->set('Country', $Client_country);
            $this->set('Hire', $hired_result);
            $this->set('Posted', $Posted);
            $this->set('OpenJobs', $Open_jobs);
        } else {
            $this->redirect('/login');
        }
    }

    public function withdrawAmount($id = null) {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('Milestone');
            $freelancer_id = $this->Auth->user('id');
            $Data = $this->Milestone->find('first', array('conditions' => array(
                    'Milestone.freelancer_id' => $freelancer_id,
                    'Milestone.milestone_status' => 'Paid',
                    'Milestone.id' => $id,
            )));
            if (!empty($Data)) {
                $payment_amount = $Data['Milestone']['payment_amount'];
                $Amount_deducted = ($payment_amount * 8) / 100;
                $amount_to_be_withdrawn = $payment_amount - $Amount_deducted;
                $this->set('Withdrawn_amount', $amount_to_be_withdrawn);
            }
            $this->set('Result', $Data);
        } else {
            $this->redirect('/login');
        }
    }

    public function withdrawPaypalAmount($id = null) {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('Paypalpayment');
            $this->loadModel('Creditpayment');
            $paypal_record = $this->Paypalpayment->find('first', array('conditions' => array('Paypalpayment.id' => $id)));
            if (!empty($paypal_record)) {
                $payment_amount = $paypal_record['Paypalpayment']['payment_amount'];
                $Amount_deducted = ($payment_amount * 8) / 100;
                $amount_to_be_withdrawn = $payment_amount - $Amount_deducted;

                $this->set('Withdrawn_amount', $amount_to_be_withdrawn);
            }
            $credit_record = $this->Creditpayment->find('first', array('conditions' => array('Creditpayment.id' => $id)));
//             pr($credit_record);
//             die;
            if (!empty($credit_record)) {
                $payment_amount = $credit_record['Creditpayment']['amount'];
                $amount = str_replace(',', '', $payment_amount);
                $Amount_deducted = ($amount * 8) / 100;

                $amount_to_be_withdrawn = $amount - $Amount_deducted;

                $this->set('Withdrawn_amount', $amount_to_be_withdrawn);
            }
            $this->set('Credit_result', $credit_record);
            $this->set('Result', $paypal_record);
        } else {
            $this->redirect('/login');
        }
    }

    /* Freelancer Mymessage Function */

    public function mymessage() {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('Message');
            $this->loadModel('User');
            $this->loadModel('Job');
            $this->loadModel('Paypalpayment');
            $this->loadModel('Withdrawearning');
            $this->loadModel('Creditpayment');
            $freelancer_id = $this->Auth->user('id');
            $payment_detail = $this->Paypalpayment->find('all', array('conditions' => array('Paypalpayment.freelancer_id' => $freelancer_id)));
            $credit_detail = $this->Creditpayment->find('all', array('conditions' => array('Creditpayment.freelancer_id' => $freelancer_id)));
            $pay_value = array_merge($payment_detail, $credit_detail);
            if (!empty($pay_value)) {
                $pay_amount = array();
                foreach ($pay_value as $kk => $vv) {
                    if (array_key_exists('Paypalpayment', $vv)) {
                        $pay_amount[] = $vv['Paypalpayment']['payment_amount'];
                    }
                    if (array_key_exists('Creditpayment', $vv)) {
                        $pay_amount[] = $vv['Creditpayment']['amount'];
                    }
                }
                $pay_data = array_sum($pay_amount);
            }
            $withdraw = $this->Withdrawearning->find('all', array('conditions' => array('Withdrawearning.freelancer_id' => $freelancer_id)));
            if (!empty($withdraw)) {
                $earning = array();
                foreach ($withdraw as $k => $v) {
                    $earning = $v['Withdrawearning']['reciever_amount'];
                }
                $receiver_amount = array_sum($earning);
            }
            if (!empty($receiver_amount)) {
                $pay_val = $pay_data - $receiver_amount;
            } elseif (!empty($pay_data)) {
                $pay_val = $pay_data;
            } else {
                $pay_val = 0;
            }
            $this->set('Payment_earning', $pay_val);
            if (isset($this->params['pass'][0]) && !empty($this->params['pass'][0])) {
                $this->Session->setFlash('Message sent successfully', 'success');
            }
            $mesages = $this->Message->find('all', array('group' => 'Message.job_id', 'conditions' => array('OR' => array('Message.status' => array('1', '2')), 'AND' => array('Message.reciever' => $freelancer_id))));
            if ($this->request->is('post')) {
                if (isset($_POST['archive']) and $_POST['archive'] == 'archive') {
                    $chk_id = $this->request->data['Message']['chk1'];
                    foreach ($chk_id as $v) {
                        $this->request->data['Message']['status'] = 0;
                        $this->Message->id = $v;
                        $this->Message->save($this->request->data);
                    }
                    $mesages = $this->Message->find('all', array('conditions' => array('AND' => array('Message.reciever' => $freelancer_id, 'Message.status' => '1'))));
                }
                if (isset($_POST['read']) and $_POST['read'] == 'read') {
                    $msg_id = $this->request->data['Message']['chk1'];
                    foreach ($msg_id as $v) {
                        $this->request->data['Message']['status'] = 2;
                        $this->Message->id = $v;
                        $this->Message->save($this->request->data);
                    }
                    $mesages = $this->Message->find('all', array('conditions' => array('AND' => array('Message.reciever' => $freelancer_id))));
                }
            }
            $count = $this->Message->find('count', array('conditions' => array('AND' => array('Message.reciever' => $freelancer_id, 'Message.read_status' => '0'))));
            foreach ($mesages as $k => $v) {
                $user_id = $v['Message']['sender'];
                $job_id = $v['Message']['job_id'];
                $this->User->recursive = -1;
                $user = $this->User->find('all', array('conditions' => array('User.id' => $user_id)));
                $this->Job->recursive = -1;
                $job_data = $this->Job->find('all', array('conditions' => array('Job.id' => $job_id)));
                $send_msgs = count($this->Message->find('all', array('conditions' => array('AND' => array('Message.sender' => $freelancer_id, 'Message.reciever' => $user_id)))));
                $recieved_msgs = count($this->Message->find('all', array('conditions' => array('AND' => array('Message.sender' => $user_id, 'Message.reciever' => $freelancer_id)))));

                $total_count = $send_msgs + $recieved_msgs;

                $mesages[$k]['Message']['user'] = $user;
                $mesages[$k]['Message']['job'] = $job_data;
                $mesages[$k]['Message']['msg_count'] = $total_count;
            }
            $this->set('msgs', $mesages);
            $this->set('count_msg', $count);
        } else {
            $this->redirect('/login');
        }
    }

    /* Freelancer Sent Message Function */

    public function sent_message() {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('Message');
            $this->loadModel('User');
            $this->loadModel('Paypalpayment');
            $this->loadModel('Withdrawearning');
            $this->loadModel('Creditpayment');
            $freelancer_id = $this->Auth->user('id');
            $payment_detail = $this->Paypalpayment->find('all', array('conditions' => array('Paypalpayment.freelancer_id' => $freelancer_id)));
            $credit_detail = $this->Creditpayment->find('all', array('conditions' => array('Creditpayment.freelancer_id' => $freelancer_id)));
            $pay_value = array_merge($payment_detail, $credit_detail);
            if (!empty($pay_value)) {
                $pay_amount = array();
                foreach ($pay_value as $kk => $vv) {
                    if (array_key_exists('Paypalpayment', $vv)) {
                        $pay_amount[] = $vv['Paypalpayment']['payment_amount'];
                    }
                    if (array_key_exists('Creditpayment', $vv)) {
                        $pay_amount[] = $vv['Creditpayment']['amount'];
                    }
                }
                $pay_data = array_sum($pay_amount);
            }
            $withdraw = $this->Withdrawearning->find('all', array('conditions' => array('Withdrawearning.freelancer_id' => $freelancer_id)));
            if (!empty($withdraw)) {
                $earning = array();
                foreach ($withdraw as $k => $v) {
                    $earning = $v['Withdrawearning']['reciever_amount'];
                }
                $receiver_amount = array_sum($earning);
            }
            if (!empty($receiver_amount)) {
                $pay_val = $pay_data - $receiver_amount;
            } elseif (!empty($pay_data)) {
                $pay_val = $pay_data;
            } else {
                $pay_val = 0;
            }
            $this->set('Payment_earning', $pay_val);
            $mesages = $this->Message->find('all', array('conditions' => array('Message.sender' => $freelancer_id), 'group' => 'Message.reciever'));
            foreach ($mesages as $k => $v) {
                $user_id = $v['Message']['sender'];
                $c_id = $v['Message']['reciever'];
                $user = $this->User->find('first', array('conditions' => array('User.id' => $c_id)));


                $s_mesages = count($this->Message->find('all', array('conditions' => array('AND' => array('Message.sender' => $freelancer_id, 'Message.reciever' => $c_id)))));
                $r_mesages = count($this->Message->find('all', array('conditions' => array('AND' => array('Message.sender' => $c_id, 'Message.reciever' => $freelancer_id)))));
                $total_count = $r_mesages + $s_mesages;
                $mesages[$k]['Message']['user'] = $user;
                $mesages[$k]['Message']['count'] = $total_count;
            }
            $count = $this->Message->find('count', array('conditions' => array('Message.reciever' => $freelancer_id, 'Message.status' => '1')));
            $this->set('message', $mesages);
            $this->set('count_inbox', $count);
        } else {
            $this->redirect('/login');
        }
    }

    /* Freelancer Archieve message function */

    public function archieve_message() {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('Message');
            $this->loadModel('User');
            $this->loadModel('Paypalpayment');
            $this->loadModel('Withdrawearning');
            $this->loadModel('Creditpayment');
            $freelancer_id = $this->Auth->user('id');
            $payment_detail = $this->Paypalpayment->find('all', array('conditions' => array('Paypalpayment.freelancer_id' => $freelancer_id)));
            $credit_detail = $this->Creditpayment->find('all', array('conditions' => array('Creditpayment.freelancer_id' => $freelancer_id)));
            $pay_value = array_merge($payment_detail, $credit_detail);
            if (!empty($pay_value)) {
                $pay_amount = array();
                foreach ($pay_value as $kk => $vv) {
                    if (array_key_exists('Paypalpayment', $vv)) {
                        $pay_amount[] = $vv['Paypalpayment']['payment_amount'];
                    }
                    if (array_key_exists('Creditpayment', $vv)) {
                        $pay_amount[] = $vv['Creditpayment']['amount'];
                    }
                }
                $pay_data = array_sum($pay_amount);
            }
            $withdraw = $this->Withdrawearning->find('all', array('conditions' => array('Withdrawearning.freelancer_id' => $freelancer_id)));
            if (!empty($withdraw)) {
                $earning = array();
                foreach ($withdraw as $k => $v) {
                    $earning = $v['Withdrawearning']['reciever_amount'];
                }
                $receiver_amount = array_sum($earning);
            }
            if (!empty($receiver_amount)) {
                $pay_val = $pay_data - $receiver_amount;
            } elseif (!empty($pay_data)) {
                $pay_val = $pay_data;
            } else {
                $pay_val = 0;
            }
            $this->set('Payment_earning', $pay_val);
            $mesages = $this->Message->find('all', array('conditions' => array('Message.status' => '0', 'Message.reciever' => $freelancer_id)));
            foreach ($mesages as $k => $v) {
                $user_id = $v['Message']['sender'];
                $user = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
                $mesages[$k]['Message']['user'] = $user;
            }
            $count = $this->Message->find('count', array('conditions' => array('AND' => array('Message.reciever' => $freelancer_id, 'Message.status' => '1'))));
            $this->set('message', $mesages);
            $this->set('count_inbox', $count);
        } else {
            $this->redirect('/login');
        }
    }

    /* Freelancer Single Message Function */

    public function single_message($id) {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('Job');
            $this->loadModel('Contect');
            $this->loadModel('Message');
            $this->loadModel('User');
            $this->loadModel('Paypalpayment');
            $this->loadModel('Withdrawearning');
            $this->loadModel('Admin');
            $this->loadModel('Creditpayment');
            $user_id = $this->Auth->user('id');
            $admin_data = $this->Admin->find('first');
            $payment_detail = $this->Paypalpayment->find('all', array('conditions' => array('Paypalpayment.freelancer_id' => $user_id)));
            $credit_detail = $this->Creditpayment->find('all', array('conditions' => array('Creditpayment.freelancer_id' => $user_id)));
            $pay_value = array_merge($payment_detail, $credit_detail);
            if (!empty($pay_value)) {
                $pay_amount = array();
                foreach ($pay_value as $kk => $vv) {
                    if (array_key_exists('Paypalpayment', $vv)) {
                        $pay_amount[] = $vv['Paypalpayment']['payment_amount'];
                    }
                    if (array_key_exists('Creditpayment', $vv)) {
                        $pay_amount[] = $vv['Creditpayment']['amount'];
                    }
                }
                $pay_data = array_sum($pay_amount);
            }
            $withdraw = $this->Withdrawearning->find('all', array('conditions' => array('Withdrawearning.freelancer_id' => $user_id)));
            if (!empty($withdraw)) {
                $earning = array();
                foreach ($withdraw as $k => $v) {
                    $earning = $v['Withdrawearning']['reciever_amount'];
                }
                $receiver_amount = array_sum($earning);
            }
            if (!empty($receiver_amount)) {
                $pay_val = $pay_data - $receiver_amount;
            } elseif (!empty($pay_data)) {
                $pay_val = $pay_data;
            } else {
                $pay_val = 0;
            }
            $this->set('Payment_earning', $pay_val);
            $freelancer = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
            $Client_info = $this->User->find('first', array('conditions' => array('User.id' => $id)));
            $messages = $this->Message->find('first', array('conditions' => array('AND' => array('Message.reciever' => $user_id, 'Message.sender' => $id))));
            if (!empty($messages['Message']['job_id'])) {
                $job_value = $this->Job->find('first', array('conditions' => array('Job.id' => $messages['Message']['job_id'])));
                $this->set('job_value', $job_value);
            }
            //For Sender
            $arrs_merge = $this->Message->find('all', array('conditions' => array('AND' => array('Message.reciever' => array($user_id, $id), 'Message.sender' => array($id, $user_id)))));
            asort($arrs_merge);
            foreach ($arrs_merge as $k => $v) {
                $sender = $v['Message']['sender'];
                $reciever = $v['Message']['reciever'];
                $users = $this->User->find('all', array('conditions' => array('User.id' => $sender)));
                $arrs_merge[$k]['Message']['user'] = $users;
            }
            $count_inbox = $this->Message->find('all', array('conditions' => array('Message.reciever' => $user_id, 'Message.read_status' => '0')));
            $count = count($count_inbox);
            $client_id = $id;
            $this->set('client_message', $messages);
            $this->set('sender_id', $user_id);
            $this->set('reciever_id', $client_id);
            $this->set('Count', $count);
            if ($this->request->is('post')) {
                $reply = nl2br($this->request->data['Message']['reply']);
                $this->request->data['Message']['reply'] = $reply;
                $this->request->data['Message']['sender'] = $user_id;
                $this->request->data['Message']['reciever'] = $client_id;
                $this->request->data['Message']['job_id'] = $job_value['Job']['id'];
                $this->request->data['Message']['status'] = 1;
                $this->request->data['Message']['read_status'] = 0;
                $this->set($this->request->data);
                $data = $this->request->data;
                if ($this->Message->save($this->request->data)) {
                    $Email = new CakeEmail();
                    $Email->template('reply_messages');
                    $Email->emailFormat('html');
                    $Email->viewVars(array('data' => $job_value['Job']['job_title'], 'free_fname' => $freelancer['User']['first_name'], 'free_lname' => $freelancer['User']['last_name'], 'Job_id' => $job_value['Job']['id'], 'message' => $data['Message']['reply']));
                    $Email->from(array('Jobider@pnf.com' => $freelancer['User']['first_name'] . ' ' . $freelancer['User']['last_name'] . ' via Jobider'));
                    $Email->to($Client_info['User']['email']);
                    $Email->subject($job_value['Job']['job_title'], 'success');
                    $Email->send();
                    $Email->template('reply_messages');
                    $Email->emailFormat('html');
                    $Email->viewVars(array('data' => $job_value['Job']['job_title'], 'free_fname' => $freelancer['User']['first_name'], 'free_lname' => $freelancer['User']['last_name'], 'Job_id' => $job_value['Job']['id'], 'message' => $data['Message']['reply']));
                    $Email->from(array('Jobider@pnf.com' => $freelancer['User']['first_name'] . ' ' . $freelancer['User']['last_name'] . ' via Jobider'));
                    $Email->to($admin_data['Admin']['email']);
                    $Email->subject($job_value['Job']['job_title'], 'success');
                    $Email->send();
                    $this->redirect(array('controller' => 'freelancer', 'action' => 'single_message', $id));
                }
            }
            $arrs_merge = $this->Message->find('all', array('conditions' => array('AND' => array('Message.reciever' => array($user_id, $id), 'Message.sender' => array($id, $user_id)))));

            asort($arrs_merge);
            foreach ($arrs_merge as $k => $v) {
                $sender = $v['Message']['sender'];
                $reciever = $v['Message']['reciever'];
                $users = $this->User->find('all', array('conditions' => array('User.id' => $sender)));
//            pr($users);
                $arrs_merge[$k]['Message']['user'] = $users;
            }
            $this->set('message', $arrs_merge);
        } else {
            $this->redirect('/login');
        }
    }

    /* Jquery action */

    public function single_reply_msg() {
        $this->autoRender = false;
        $this->loadModel('Message');
        $this->loadModel('Contect');
        $this->loadModel('User');
        $this->loadModel('Notification');
        $sender = $_POST['sender_id'];
        $reciever = $_POST['receiver_id'];
        $job = $_POST['job_id'];
        $select = $_POST['select'];
        $contect = $this->Contect->find('first', array('conditions', array('Contect.job_id' => $job)));
        $sender_info = $this->User->find('first', array('conditions' => array('User.id' => $sender)));
        $this->request->data['Message']['sender'] = $sender;
        $this->request->data['Message']['reciever'] = $reciever;
        $this->request->data['Message']['job_id'] = $job;
        $this->request->data['Message']['reply'] = $select;
        $this->request->data['Message']['client_message'] = $contect['Contect']['messages'];
        $this->request->data['Message']['status'] = 1;
//        $notification['Notification']['sender_id'] = $sender;
//        $notification['Notification']['reciever_id'] = $reciever;
//        $notification['Notification']['notification_msg'] = 'You have recieved a message from <a href="#" style="text-decoration:none;color:#338FC5;"> ' . $sender_info['User']['first_name'] . ' ' . $sender_info['User']['last_name'] . '</a>.';
//        $this->Notification->save($notification);
        if ($this->Message->save($this->request->data)) {

            $array = array('status' => 'true');
            echo json_encode($array);
        }
    }

    /* Freelancer Withdraw Function */

    public function withdraw() {
        $this->layout = 'front';
    }

    /* Freelancer Withdraw Information Function */

    public function withdrawconfirmation() {
        $this->layout = 'front';
    }

    /* Starting Test Module  */

    /* Freelancer Take A Test Function */

    public function takeatest() {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('Category');
            $this->loadModel('Test');
            $category = $this->Category->find('list', array('conditions' => array('Category.status' => 1)));
            $this->set('categories', $category);
            if (!empty($this->request->data)) {
                if (!empty($this->request->data['Test']['select']) and !empty($this->request->data['Test']['search_keyword'])) {

                    $this->paginate = array('limit' => 10, 'conditions' => array('AND' => array('Test.category_id LIKE' => '%' . $this->request->data['Test']['select'] . '%', 'Test.title LIKE' => '%' . $this->request->data['Test']['search_keyword'] . '%', 'Test.status' => 1)));
                    $search_test = $this->paginate('Test');
                    $this->set('Test_title', $search_test);
                } else {
                    $err = 0;
                    if (empty($this->request->data['Test']['select'])) {
                        $err = 1;
                        $msg[] = "Please Select the Category !";
                    }
                    if (empty($this->request->data['Test']['search_keyword'])) {
                        $err = 1;
                        $msg[] = "Please Enter the Search Keyword ! ";
                    }
                    if ($err == 1) {
                        $this->set('errors', $msg);
                    }
//                $Added_test = $this->Test->find('all', array('conditions' => array('Test.status' => 1)));
                    $this->paginate = array('limit' => 5,
                        'conditions' => array(
                            'Test.status' => 1));
                    $Added_test = $this->paginate('Test');
                    $this->set('Test_title', $Added_test);
                }
            } else {
                if (empty($this->request->data['Test']['select'])) {
                    $err = 1;
                    $msg[] = "Please select the Category.";
                }
                if (empty($this->request->data['Test']['search_keyword'])) {
                    $err = 1;
                    $msg[] = "Please enter the search keyword.";
                }
                if ($err == 1) {
                    $this->set('error', $msg);
                }
                $this->paginate = array('limit' => 10,
                    'conditions' => array(
                        'Test.status' => 1));
                $Added_test = $this->paginate('Test');
                foreach ($Added_test as $key => $vv) {
                    $array[] = $vv['Test']['title'];
                }
                $this->set('Test_title', $Added_test);
            }
        } else {
            $this->redirect('/login');
        }
    }

    /* Freelancer Mytests Function */

    public function Mytests() {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('Category');
            $this->loadModel('Subcategory');
            $this->loadModel('User');
            $this->loadModel('Test');
            $this->loadModel('Finalresult');
            $this->Test->recursive = -1;
            $user_id = $this->Auth->user('id');
            $user_info = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
            $category = explode(',', $user_info['User']['categories']);
            $sub_cat = $this->Subcategory->find('all', array('conditions' => array('Subcategory.id' => $category)));
            $result = $this->Finalresult->find('all', array('conditions' => array('Finalresult.user_id' => $user_id)));
            foreach ($result as $kk => $va) {
                $test_id = $va['Finalresult']['test_id'];
                $score = number_format($va['Finalresult']['score'], 1);
                $test_data = $this->Test->find('all', array('conditions' => array('Test.id' => $test_id)));
                $result[$kk]['test'] = $test_data;
                $result[$kk]['score'] = $score;
            }
            $this->set('result', $result);
            $this->set('user_data', $user_info);
            $this->set('category', $sub_cat);
        } else {
            $this->redirect('/login');
        }
    }

    /* Freelancer Take Test On Click Function */

    public function TakeTestOnClick($slug = NULL) {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('Test');
            $this->loadModel('Testcontent');
            $this->loadModel('Question');
            $this->loadModel('Finalresult');
            $user_id = $this->Auth->user('id');

            $tests = $this->Test->find('first', array('conditions' => array('Test.slug' => $slug, 'Test.status' => 1), 'fields' => array('Test.id', 'Test.title', 'Test.test_type')));
            if (!empty($tests)) {
                $test_id = $tests['Test']['id'];
                $question = $this->Question->find('all', array('conditions' => array('Question.test_id' => $test_id)));
                $sum = 0;
                foreach ($question as $kk => $vv) {
                    $min = $vv['Question']['minutes'];
                    $sec = $vv['Question']['seconds'];
                    $time = $min . '.' . $sec;
                    $sum+=$time;
                }
                $sum1 = str_replace('.', ':', $sum);
                $quest = count($question);
                $testcontent = $this->Testcontent->find('all', array('conditions' => array('Testcontent.test_id' => $test_id)));

                $current_date = time();
                $this->set('test_content', $testcontent);
                $this->set('quest', $quest);
                $this->set('sum', $sum1);
            }
            if (!empty($test_id)) {
                $get_last_test_id = $this->Finalresult->find('first', array('limit' => 1, 'order' => array('Finalresult.id DESC'), 'conditions' => array('Finalresult.test_id' => $test_id, 'Finalresult.user_id' => $user_id), 'fields' => array('Finalresult.id', 'Finalresult.next_date')));

                if (!empty($get_last_test_id)) {
                    $last_given_test_id = $get_last_test_id['Finalresult']['id'];

                    $final = $this->Finalresult->find('all', array('conditions' => array('Finalresult.id' => $last_given_test_id, "UNIX_TIMESTAMP(Finalresult.next_date) >" => $current_date)));
                    $count_data = count($final);
                    $give_test = array();
                    if ($count_data > 0) {
                        $give_test['able'] = "no";
                        $give_test['next_test_date'] = $get_last_test_id['Finalresult']['next_date'];
                    } else {
                        $give_test['able'] = "yes";
                        $give_test['next_test_date'] = $get_last_test_id['Finalresult']['next_date'];
                    }

                    $this->set('able_to_test', $give_test);
                }
            }
            $this->set('tst', $tests);
        } else {
            $this->redirect('/login');
        }
    }

    /* Freelancer Start Test Function */

    public function start_test($id) {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('Test');
            $this->loadModel('Testcontent');
            $this->loadModel('Question');
            $this->loadModel('Result');
            $test = $this->Test->find('first', array('conditions' => array('Test.id' => $id)));
            $test_content = $this->Testcontent->find('all', array('conditions' => array('Testcontent.test_id' => $id)));
            $question = $this->Question->find('all', array('conditions' => array('Question.test_id' => $id)));
            $total_question = count($question);
            $sum = 0;
            foreach ($question as $kk => $va) {
                $total_time = $va['Question']['minutes'] . '.' . $va['Question']['seconds'];
                $sum+=$total_time;
            }
            $total_sum = number_format($sum, 2);
            $sum1 = str_replace('.', ':', $total_sum);
            $this->set('test', $test);
            $this->set('sum', $sum1);
            $this->set('question', $question);
            $this->set('total_question', $total_question);
            $this->set('test_content', $test_content);
        } else {
            $this->redirect('/login');
        }
    }

    /* Freelancer Take A Test Backup Function */

    public function takeatest_BackUp() {
        $this->layout = 'front';
        $this->loadModel('Category');
        $this->loadModel('Skill');
        $this->loadModel('Test');
        $Added_test = $this->Test->find('all', array('conditions' => array('Test.status' => 1)));
        if (!empty($Added_test)) {
            foreach ($Added_test as $k => $v) {
                $title[] = $v['Test']['title'];
                $cat_id[] = $v['Test']['category_id'];
            }
            $this->set('Test_title', $title);
        }
        $this->Category->recursive = -1;
        $category = $this->Category->find('all', array('fields' => array('Category.id', 'Category.name')));
        foreach ($category as $key => $value) {
            $arr[] = $value['Category']['id'];
            $arrayCat[$value['Category']['id']] = $value['Category']['name'];
        }
        $this->set('category_name', $arrayCat);
        $skill_data = $this->Skill->find('list', array('conditions' => array('Skill.category_id' => $arr)));

        $this->set('skill', $skill_data);
        if (!empty($this->request->data)) {
            $category = $this->Skill->find('all', array('conditions' => array('AND' => array('Skill.category_id' => $this->request->data['Category']['select'], 'Skill.name LIKE' => '%' . $this->request->data['Category']['skill'] . '%'))));
        }
    }

    /* Freelancer Find Jobs By Category Function */

    public function findjobsbycategory($id) {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
//        die('sdhhasdsa');
            $this->loadModel('Category');
            $this->loadModel('Subcategory');
            $this->loadModel('Job');
            include ('timefunction.php');
            include ('timefun.php');
            $category_value = array();
            $category_value = $this->Category->find('all', array('fields' => array('Category.name', 'Category.id')));
            $subcategory = $this->Subcategory->find('first', array('conditions' => array('Subcategory.id' => $id)));
            $sub_text = $subcategory['Subcategory']['category_name'];
            $this->set('sub_text', $sub_text);
            $this->set('subcategory', $subcategory);
            $sub_data = $this->Subcategory->find('all', array('conditions' => array('Subcategory.category_id' => $subcategory['Category']['id'])));
            $jobs_count = array();
            foreach ($category_value as $k => $v) {
                $jobs_count[$v['Category']['id']] = count($this->Job->find('list', array('conditions' => array('Job.category_id' => $v['Category']['id']))));
            }
            $this->set('category', $category_value);
            $this->set('jobs_count', $jobs_count);
            $this->set('sub_data', $sub_data);
            $this->paginate = array('limit' => 3, 'conditions' => array('AND' => array('Job.subcategory_id' => $id, 'Job.status' => 1)), 'order' => 'Job.id ASC');
            $job_data = $this->paginate('Job');
            $job_count = count($job_data);
            foreach ($job_data as $key => $value) {
                $end_date = $value['Job']['addedon'];
                $current_date = time();
                $current_time = time();
                $diff = $current_date - $end_date;
                $obj = secondsToTime($diff);
                $actual_days = floor($diff / (60 * 60 * 24));
                $actual_hours = floor($diff / (60 * 60));
                $actual_minutes = floor(($diff - ($actual_days * 60 * 60 * 24) - ($actual_hours * 60 * 60)) / 60);
                $job_data[$key]['Job']['days'] = $obj['d'];
                $job_data[$key]['Job']['hours'] = $obj['h'];

                $job_data[$key]['Job']['minutes'] = $obj['m'];
                $job_data[$key]['Job']['seconds'] = $obj['s'];
            }
///////Get The Data From 24 hours///////////////
            $tres = $this->Job->find('all', array('conditions' => array('Job.created >= NOW() - INTERVAL 1 DAY')));
            $job_counting_oneday = count($tres);
////////////////Get The Data From 3 Day////////////
            $day_tres = $this->Job->find('all', array('conditions' => array('Job.created >= NOW() - INTERVAL 3 DAY')));
            $job_counti_threedays = count($day_tres);
////////////Get The Data From 7 days/////////////
            $days_tres = $this->Job->find('all', array('conditions' => array('Job.created >= NOW() - INTERVAL 7 DAY')));
            $job_counties_sevendays = count($days_tres);
////////////Get The Data From 14 days/////////////
            $dayss_tres = $this->Job->find('all', array('conditions' => array('Job.created >= NOW() - INTERVAL 14 DAY')));
            $job_counts_fourteendays = count($dayss_tres);

////////////Get The Data From 30 days/////////////
            $date_tres = $this->Job->find('all', array('conditions' => array('Job.created >= NOW() - INTERVAL 30 DAY')));
            $job_counts_thirtydays = count($date_tres);

            $this->set('job_count_thirtydays', $job_counts_thirtydays);
            $this->set('job_count_fourteendays', $job_counts_fourteendays);
            $this->set('job_count_sevendays', $job_counties_sevendays);
            $this->set('job_count_threedays', $job_counti_threedays);
            $this->set('job_count_oneday', $job_counting_oneday);
            $this->set('job_data', $job_data);
            $this->set('job_count', $job_count);
        } else {
            $this->redirect('/login');
        }
    }

    /* Freelancer Job Detail Function */

    public function jobdetail($id) {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('Job');
            $this->loadModel('User');
            $this->loadModel('Hire');
            $this->loadModel('Subskill');
            $this->loadModel('Country');
            $this->loadModel('Category');
            $this->loadModel('Subcategory');
            $this->loadModel('Projectfeedback');
            $this->loadModel('Paypalpayment');
            $freelancer_id = $this->Auth->user('id');
            $last_url = $this->referer();
            $this->set('last_url', $last_url);
            $jobs = $this->Job->find('first', array('conditions' => array('Job.id' => $id, 'Job.status' => 1)));
//            pr($jobs);
//            die;
            if (!empty($jobs)) {
                $user_id = $jobs['Job']['user_id'];
                $users = $this->User->find('first', array('condtions' => array('User.id' => $user_id)));
                $this->set('users', $users);
                $jobs_all = $this->Job->find('all', array('conditions' => array('Job.id !=' => $id, 'Job.status' => 1, 'Job.user_id' => $user_id), 'fields' => array('Job.id', 'Job.job_title'), 'order' => 'Job.id DESC'));
                $all_open_jobs = $this->Job->find('all', array('conditions' => array('Job.status' => 1, 'Job.user_id' => $user_id)));
                $count_open_job = count($all_open_jobs);
                $this->set('counts', $count_open_job);
                $skills = $jobs['Job']['skills'];
                $Skills = explode(',', $skills);
                $subskill = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $Skills)));
                $client_details = $this->User->find('first', array('conditions' => array('User.id' => $user_id, 'User.status' => 1)));
                $country_id = $client_details['User']['country_id'];
                $Country = $this->Country->find('first', array('conditions' => array('Country.id' => $country_id), 'fields' => array('Country.name')));
                $category_data = $this->Category->find('first', array('conditions' => array('Category.id' => $jobs['Job']['category_id'])));
                $Subcategory_data = $this->Subcategory->find('first', array('conditions' => array('Subcategory.id' => $jobs['Job']['subcategory_id'])));
                $FeedbackToClient = $this->Projectfeedback->find('first', array('conditions' => array('Projectfeedback.client_id' => $user_id, 'Projectfeedback.freelancer_id' => $freelancer_id, 'Projectfeedback.user_type' => 'freelancer')));
                $review_client = $this->Projectfeedback->find('count', array('conditions' => array('Projectfeedback.client_id' => $user_id, 'Projectfeedback.freelancer_id' => $freelancer_id, 'Projectfeedback.user_type' => 'freelancer')));
                $crnt_date = time();
                $selected = strtotime($jobs['Job']['created']);
                $diff = $crnt_date - $selected;
                $date = $this->secondsToTime($diff);
                $text = 'Posted ' . $date['d'] . '  days  ' . $date['h'] . ' hours ' . $date['m'] . ' Minutes ago';
                $jobs['Job']['time_duration'] = $text;
                $jobs_data = $this->Job->find('all', array('conditions' => array('Job.id !=' => $id, 'Job.user_id' => $user_id)));
                $count_jobs = count($jobs_data);
                $Hire_data = $this->Hire->find('count', array('conditions' => array('Hire.hiring_id' => $user_id, 'Hire.job_id' => $id, 'Hire.contractor_id' => $freelancer_id)));
                $this->set('Hired_data', $Hire_data);
                $this->set('users', $users);
                $this->set('Hired_users', $Hire_data);
                $paypal_Payments = $this->Paypalpayment->find('all', array('conditions' => array('Paypalpayment.job_id' => $id, 'Paypalpayment.freelancer_id' => $freelancer_id)));
                $pay_data = array();
                foreach ($paypal_Payments as $key => $vv) {
                    $pay_data[] = $vv['Paypalpayment']['payment_amount'];
                }
                $pay = array_sum($pay_data);
                $this->set('pay', $pay);
                ////////////Open JObs///////////////
                $this->Session->write('job_id', $id);
                $this->set('Jobresult', $jobs);
                $this->set('clientinfo', $client_details);
                $this->set('skill', $subskill);
                $this->set('subcategory_data', $Subcategory_data);
                $this->set('client_country', $Country);
                $this->set('category_data', $category_data);
                $this->set('OtherOpenJobs', $jobs_all);
                $this->set('Feedback', $FeedbackToClient);
                $this->set('Reviews', $review_client);
                $this->set('posted_jobs', $count_jobs);
            }
        } else {
            $this->redirect('/login');
        }
    }

    /* Freelancer Job Detail  Function */

    public function jobdetails($id = NULL) {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('Job');
            $this->loadModel('Jobdetail');
            $this->loadModel('User');
            $this->loadModel('Country');
            $this->loadModel('Category');
            $this->loadModel('Subcategory');
            $this->loadModel('Subskill');
            $this->loadModel('Hire');
            $this->loadModel('Paypalpayment');
            $this->loadModel('Projectfeedback');
            $this->loadModel('Creditpayment');
            $last_url = $this->referer();
            $this->set('last_url', $last_url);
            $user = $this->Auth->user('id');
            $freelancer = $this->User->find('first', array('conditions' => array('User.id' => $user)));
            $skills = explode(',', $freelancer['User']['skills']);
            $subskil_data = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $skills)));
            $jobs_val = $this->Job->find('all', array('conditions' => array('Job.id' => $id)));
            $job_id = array();
            foreach ($jobs_val as $k => $v) {
                $skill_id = explode(',', $v['Job']['skills']);
                foreach ($skill_id as $kk => $vv) {
                    foreach ($subskil_data as $ke => $va) {
                        if ($va['Subskill']['id'] == $vv) {
                            $job_id = $v['Job']['id'];
                        }
                    }
                }
            }
            $jobs = $this->Job->find('first', array('conditions' => array('Job.id' => $job_id, 'Job.status' => 1)));

            $job_detail = $this->Jobdetail->find('first', array('conditions' => array('AND' => array('Jobdetail.freelancer_id' => $user, 'Jobdetail.job_id' => $id))));

            if (!empty($jobs)) {
                $user_id = $jobs['Job']['user_id'];
                $users = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
                $u_id = $users['User']['id'];
                $Hire_data = $this->Hire->find('count', array('conditions' => array('Hire.hiring_id' => $u_id)));
                // pr($Hire_data); 
                $this->set('users', $users);
                $this->set('Hired_users', $Hire_data);

                $payment = $this->Paypalpayment->find('all', array('conditions' => array('Paypalpayment.client_id' => $u_id)));
                $credit = $this->Creditpayment->find('all', array('conditions' => array('Creditpayment.client_id' => $u_id)));
                $pay_val = array_merge($payment, $credit);

                $pay_data = array();
                foreach ($pay_val as $k => $v) {
                    if (array_key_exists('Paypalpayment', $v)) {
                        $pay_data[] = $v['Paypalpayment']['payment_amount'];
                    }
                    if (array_key_exists('Creditpayment', $v)) {
                        $pay_data[] = $v['Creditpayment']['amount'];
                    }
                }
                $pay = array_sum($pay_data);
                $this->set('pay', $pay);
                $jobs_all = $this->Job->find('all', array('conditions' => array('Job.id !=' => $id, 'Job.status' => 1, 'Job.user_id' => $u_id), 'fields' => array('Job.id', 'Job.job_title'), 'order' => 'Job.id DESC'));
                $jobs_count = count($this->Job->find('all', array('conditions' => array('Job.status' => 1, 'Job.user_id' => $u_id), 'fields' => array('Job.id', 'Job.job_title'), 'order' => 'Job.id DESC')));

                $skills = $jobs['Job']['skills'];
                $Skills = explode(',', $skills);
                $feedback = $this->Projectfeedback->find('first', array('conditions' => array('Projectfeedback.client_id' => $u_id, 'Projectfeedback.job_id' => $id, 'Projectfeedback.freelancer_id' => $user, 'Projectfeedback.user_type' => 'freelancer')));
                $total_reviews = $this->Projectfeedback->find('count', array('conditions' => array('Projectfeedback.client_id' => $u_id, 'Projectfeedback.freelancer_id' => $user, 'Projectfeedback.job_id' => $id, 'Projectfeedback.user_type' => 'freelancer')));

                $this->set('feedback', $feedback);
                $hire_data = $this->Hire->find('all', array('conditions' => array('Hire.hiring_id' => $u_id)));
                $Job_id = array();
                foreach ($hire_data as $key => $va) {
                    $Job_id[] = $va['Hire']['job_id'];
                }
                $all_open_jobs = $this->Job->find('all', array('conditions' => array('Job.id !=' => $Job_id, 'Job.user_id' => $u_id)));
                $count_open_job = count($all_open_jobs);
                // pr($count_open_job);
                $this->set('open_jobs', $count_open_job);
                $subskill = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $Skills)));
                $country_id = $users['User']['country_id'];
                $Country_data = $this->Country->find('first', array('conditions' => array('Country.id' => $country_id), 'fields' => array('Country.name')));
                $category_data = $this->Category->find('first', array('conditions' => array('Category.id' => $jobs['Job']['category_id'])));
                $Subcategory_data = $this->Subcategory->find('first', array('conditions' => array('Subcategory.id' => $jobs['Job']['subcategory_id'])));
                $crnt_date = time();
                $selected = strtotime($jobs['Job']['created']);
                $diff = $crnt_date - $selected;
                $date = $this->secondsToTime($diff);
                $text = 'Posted ' . $date['h'] . ' hours ago';
                $jobs['Job']['time_duration'] = $text;
                $this->Session->write('job_id', $id);
                $this->set('Jobresult', $jobs);
                $this->set('skill', $subskill);
                $this->set('subcategory_data', $Subcategory_data);
                $this->set('client_country', $Country_data);
                $this->set('category_data', $category_data);
                $this->set('OtherOpenJobs', $jobs_all);
                $this->set('job_detail', $job_detail);
                $this->set('count_job', $jobs_count);
                $this->set('Reviews', $total_reviews);
            }
        } else {
            $this->redirect('/login');
        }
    }

    public function originalJobPost($id = null) {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('Job');
            $this->loadModel('Jobdetail');
            $this->loadModel('User');
            $this->loadModel('Country');
            $this->loadModel('Category');
            $this->loadModel('Subcategory');
            $this->loadModel('Subskill');
            $this->loadModel('Hire');
            $this->loadModel('Paypalpayment');
            $last_url = $this->referer();
            $this->set('last_url', $last_url);
            $user = $this->Auth->user('id');
            $job_detail = $this->Jobdetail->find('first', array('conditions' => array('AND' => array('Jobdetail.freelancer_id' => $user, 'Jobdetail.job_id' => $id))));
            $jobs = $this->Job->find('first', array('conditions' => array('Job.id' => $id, 'Job.status' => 1)));
            $payment = $this->Paypalpayment->find('all', array('conditions' => array('Paypalpayment.job_id' => $id, 'Paypalpayment.freelancer_id' => $user)));
            $pay_data = array();
            foreach ($payment as $k => $v) {
                $pay_data[] = $v['Paypalpayment']['payment_amount'];
            }
            $pay = array_sum($pay_data);
            $this->set('pay', $pay);
            if (!empty($jobs)) {
                $user_id = $jobs['Job']['user_id'];
                $users = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
                $u_id = $users['User']['id'];
                $Hire_data = $this->Hire->find('count', array('conditions' => array('Hire.hiring_id' => $u_id, 'Hire.job_id' => $id, 'Hire.contractor_id' => $user)));
                // pr($Hire_data); 
                $this->set('users', $users);
                $this->set('Hired_users', $Hire_data);
                $jobs_all = $this->Job->find('all', array('conditions' => array('Job.id !=' => $id, 'Job.status' => 1, 'Job.user_id' => $u_id), 'fields' => array('Job.id', 'Job.job_title'), 'order' => 'Job.id DESC'));
                $jobs_count = count($this->Job->find('all', array('conditions' => array('Job.status' => 1, 'Job.user_id' => $u_id), 'fields' => array('Job.id', 'Job.job_title'), 'order' => 'Job.id DESC')));
                $all_open_jobs = $this->Job->find('all', array('conditions' => array('Job.status' => 1, 'Job.user_id' => $u_id)));
                $count_open_job = count($all_open_jobs);
                $this->set('open_jobs', $count_open_job);
                $skills = $jobs['Job']['skills'];
                $Skills = explode(',', $skills);
                $subskill = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $Skills)));
                $country_id = $users['User']['country_id'];
                $Country_data = $this->Country->find('first', array('conditions' => array('Country.id' => $country_id), 'fields' => array('Country.name')));
                $category_data = $this->Category->find('first', array('conditions' => array('Category.id' => $jobs['Job']['category_id'])));
                $Subcategory_data = $this->Subcategory->find('first', array('conditions' => array('Subcategory.id' => $jobs['Job']['subcategory_id'])));
                $crnt_date = time();
                $selected = strtotime($jobs['Job']['created']);
                $diff = $crnt_date - $selected;
                $date = $this->secondsToTime($diff);
                $text = 'Posted ' . $date['d'] . '  days  ' . $date['h'] . ' hours ' . $date['m'] . ' Minutes ago';
                $jobs['Job']['time_duration'] = $text;
                $this->Session->write('job_id', $id);
                $this->set('Jobresult', $jobs);
                $this->set('skill', $subskill);
                $this->set('subcategory_data', $Subcategory_data);
                $this->set('client_country', $Country_data);
                $this->set('category_data', $category_data);
                $this->set('OtherOpenJobs', $jobs_all);
                $this->set('job_detail', $job_detail);
                $this->set('count_job', $jobs_count);
            }
        } else {
            $this->redirect('/login');
        }
    }

    /* Freelancer Apply Job Function */

    public function applyjob($job_id = null) {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('Subcategory');
            $this->loadModel('Category');
            $this->loadModel('User');
            $this->loadModel('Jobdetail');
            $this->loadModel('Job');
            $this->loadModel('Notification');
            $this->loadModel('Admin');
            $user_id = $this->Auth->user('id');
            //$login_user_id = $this->Auth->User('id');
            $admin_data = $this->Admin->find('first');
            $userData = $this->User->find('first', array('conditions' => array('User.id' => $this->Auth->user('id'))));
            $used_connects = 2;
            if ($userData['User']['used_connects'] == '0') {
                $remain = $userData['User']['connects'] - $used_connects;
            } else {
                $total_used_connects = $userData['User']['used_connects'] + $used_connects;
                $remain = $userData['User']['connects'] - $total_used_connects;
            }
            $this->set('remain', $remain);
            $this->set('used_connects', $used_connects);
            $job_datas = $this->Job->find('first', array('conditions' => array('Job.id' => $job_id)));
            $this->set('jobs', $job_datas);
            if (!empty($userData['User']['company']) and $userData['User']['employer_type'] == 'company') {
                $submember = $this->User->find('all', array('conditions' => array('User.parent_id' => $this->Auth->user('id'))));
                $sum = $userData['User']['used_connects'];
                if (!empty($submember)) {
                    foreach ($submember as $k => $v) {
                        $sum += $v['User']['used_connects'];
                    }
                }
                if ($sum < $userData['User']['connects']) {
                    $this->set('connectstatus', 'pending');
                } else {
                    $this->set('connectstatus', 'completed');
                }
            } elseif ($userData['User']['parent_id'] != '0' and $userData['User']['employer_type'] == 'individual') {
                $usercompany = $this->User->find('first', array('conditions' => array('User.id' => $userData['User']['parent_id'])));
                $submember = $this->User->find('all', array('conditions' => array('User.parent_id' => $userData['User']['parent_id'])));
                $sum = $usercompany['User']['used_connects'];
                if (!empty($submember)) {
                    foreach ($submember as $k => $v) {
                        $sum += $v['User']['used_connects'];
                    }
                }
                if ($sum < $usercompany['User']['connects']) {
                    $this->set('connectstatus', 'pending');
                } else {
                    $this->set('connectstatus', 'completed');
                }
            } else {
                $usercompany = $this->User->find('first', array('conditions' => array('User.id' => $this->Auth->user('id'))));
                if ($usercompany['User']['connects'] > $usercompany['User']['used_connects']) {
                    $this->set('connectstatus', 'pending');
                } else {
                    $this->set('connectstatus', 'completed');
                }
            }
            $this->set('userData', $userData);
            if (!empty($this->request->data['Category']['search'])) {
                $category = $this->Category->find('all', array('conditions' => array('Category.name LIKE' => '%' . $this->request->data['Category']['search'] . '%')));
                $this->Session->write('cat_name', $this->request->data['Category']['search']);
                $this->redirect(array('controller' => 'freelancer', 'action' => 'findjobbycategory'));
            }
            $job_details = $this->Jobdetail->find('first', array('conditions' => array('AND' => array('Jobdetail.freelancer_id' => $user_id, 'Jobdetail.job_id' => $job_id))));
            $job_data = $this->Jobdetail->find('all', array('conditions' => array('Jobdetail.freelancer_id' => $user_id)));
            $count = count($job_data);

            $user_info = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
            $this->Subcategory->recursive = -1;

            $category = explode(',', $user_info['User']['categories']);
            $category_data = $this->Subcategory->find('all', array('conditions' => array('Subcategory.id' => $category)));
            $job_detail = $this->Job->find('first', array('conditions' => array('Job.id' => $job_id, 'Job.status' => 1)));

            $user_data = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
            $this->set('user_data', $user_data);
            $additional = explode(',', $job_detail['Job']['additional_question']);

            if (!empty($this->request->data)) {

                $this->request->data['Jobdetail']['cover_letter'] = strip_tags($this->request->data['Jobdetail']['cover_letter']);
                $additional_questions = implode(',', $this->request->data['Jobdetail']['additional_question']);
                $this->request->data['Jobdetail']['additional_question'] = $additional_questions;
                $this->request->data['Jobdetail']['addedon'] = time();
                $this->request->data['Jobdetail']['freelancer_id'] = $user_id;
                $this->request->data['Jobdetail']['client_id'] = $user_data['User']['id'];
                $this->request->data['Jobdetail']['job_id'] = $job_id;
                $this->request->data['Jobdetail']['post_job'] = $job_detail['Job']['job_title'];
                $this->request->data['Jobdetail']['post_job'] = $job_detail['Job']['job_title'];
                $this->request->data['Jobdetail']['decline_status'] = '';
                $this->request->data['Jobdetail']['job_status'] = 'applied';
                //$TenPercentFee = $this->request->data['Jobdetail']['porpose_terms'] / 8;
                $this->request->data['Jobdetail']['jobider_percent'] = 8;
                $this->set($this->request->data);
                $notification['Notification']['sender_id'] = $user_id;
                $notification['Notification']['url'] = BASE_URL . '/client/view_details/' . $job_id;
                $notification['Notification']['status'] = '0';
                $notification['Notification']['job_id'] = $job_id;
                $notification['Notification']['reciever_id'] = $job_detail['Job']['user_id'];
                $notification['Notification']['notification_msg'] = '' . $user_info['User']['first_name'] . ' ' . $user_info['User']['last_name'] . ' has applied for your posted job  ' . $job_detail['Job']['job_title'] . ' .';
                $this->Notification->save($notification);
                if ($this->Jobdetail->save($this->request->data)) {
                    $Email = new CakeEmail();
                    $Email->template('appliedjob');
                    $Email->emailFormat('html');
                    $Email->viewVars(array('Client_FirstName' => $user_data['User']['first_name'], 'Client_LastName' => $user_data['User']['last_name'], 'data' => $job_detail['Job']['job_title'], 'freelancer_firstname' => $user_info['User']['first_name'], 'freelancer_lastname' => $user_info['User']['last_name']));
                    $Email->from($user_info['User']['email']);
                    $Email->to($user_data['User']['email']);
                    $Email->subject('Jobider - Job Bidder has Applied for your job', 'success');
                    $Email->send();
                    $Email = new CakeEmail();
                    $Email->template('appliedjob');
                    $Email->emailFormat('html');
                    $Email->viewVars(array('Client_FirstName' => $user_data['User']['first_name'], 'Client_LastName' => $user_data['User']['last_name'], 'data' => $job_detail['Job']['job_title'], 'freelancer_firstname' => $user_info['User']['first_name'], 'freelancer_lastname' => $user_info['User']['last_name']));
                    $Email->from($user_info['User']['email']);
                    $Email->to($admin_data['Admin']['email']);
                    $Email->subject('Jobider - Job Bidder has Applied for your job', 'success');
                    $Email->send();
                    $userData['User']['used_connects'] = $total_used_connects;
                    $this->User->id = $this->Auth->user('id');
                    $this->User->save($userData, array('validate' => false));
                    $this->Session->setFlash('Job applied Successfully', 'success');
                    $this->redirect(array('controller' => 'freelancer', 'action' => 'sentapplication'));
                } else {
                    $this->Session->setFlash('Job has not applied !', 'error');
                }
            }
            $this->set('JOB', $job_detail);
            $this->set('job_details', $job_details);
            $this->set('id', $job_id);
            $this->set('cat_name', $category_data);
            $this->set('user_data', $user_info);
            $this->set('additional_question', $additional);
        } else {
            $this->redirect('/login');
        }
    }

    /* Freelancer Find Job By Category Function */

    public function findjobbycategory() {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('Category');
            $this->loadModel('Subcategory');
            $this->loadModel('Job');
            $this->loadModel('User');
            $this->loadModel('Subskill');
            $first_name = $this->Auth->user('first_name');
            $last_name = $this->Auth->user('last_name');
            $session = $this->Session->read();
            if (!empty($this->request->data['Category']['search'])) {
                $category = $this->Category->find('first', array('conditions' => array('Category.name LIKE' => '%' . $session['cat_name'] . '%')));
            } else {
                $category = $this->Category->find('first', array('conditions' => array('Category.name LIKE' => '%' . $session['cat_name'] . '%')));
            }
            $category = $this->Category->find('first', array('conditions' => array('Category.name LIKE' => '%' . $session['cat_name'] . '%')));
            if (!empty($category)) {
                $category_id = $category['Category']['id'];
                $this->set('category', $category);
                $this->paginate = array('limit' => 4, 'conditions' => array('AND' => array('Job.category_id' => $category_id, 'Job.status' => 1)), 'order' => 'Job.id ASC');
                $job_value = $this->paginate('Job');
                $job_values = $this->Job->find('all', array('conditions' => array('Job.category_id' => $category_id)));
                $count_job = count($job_values);
                $this->set('count_job', $count_job);
                foreach ($job_value as $kk => $vv) {
                    $skills = explode(',', $vv['Job']['skills']);
                    $subskill = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $skills)));
                    $userId = $vv['Job']['user_id'];
                    $crnt_date = time();
                    $selected = strtotime($vv['Job']['created']);
                    $diff = $crnt_date - $selected;
                    $date = $this->secondsToTime($diff);
                    $text = 'Posted  ' . $date['h'] . ' hours ' . $date['m'] . ' Minutes ago ';
                    $job_value[$kk]['Job']['time_duration'] = $text;
                    $job_value[$kk]['Job']['skill'] = $subskill;
                }
//            pr($job_value);
//            die;
                if (!empty($userId)) {
                    $users = $this->User->find('first', array('conditions' => array('User.id' => $userId)));
                    if (!empty($users)) {
                        $this->set('postedBy', $users);
                    } else {
                        $this->set('postedBy', $users);
                    }
                }
                $cat_data = $this->Category->find('all', array('fields' => array('Category.name')));
                $this->Subcategory->recursive = -1;
                $Sub_category = $this->Subcategory->find('all', array('fields' => array('Subcategory.category_name'), 'conditions' => array('Subcategory.category_id' => $category_id)));
                $this->set('cat_data', $cat_data);
                $this->set('job_data', $job_value);
                $this->set('sub_cat', $Sub_category);
                $this->set('firstName', $first_name);
                $this->set('lastName', $last_name);
            }

            ///////Get The Data From 24 hours///////////////
            $tres = $this->Job->find('all', array('conditions' => array('Job.created >= NOW() - INTERVAL 1 DAY')));
            $job_counting_oneday = count($tres);
////////////////Get The Data From 3 Day////////////
            $day_tres = $this->Job->find('all', array('conditions' => array('Job.created >= NOW() - INTERVAL 3 DAY')));
            $job_counti_threedays = count($day_tres);
////////////Get The Data From 7 days/////////////
            $days_tres = $this->Job->find('all', array('conditions' => array('Job.created >= NOW() - INTERVAL 7 DAY')));
            $job_counties_sevendays = count($days_tres);
////////////Get The Data From 14 days/////////////
            $dayss_tres = $this->Job->find('all', array('conditions' => array('Job.created >= NOW() - INTERVAL 14 DAY')));
            $job_counts_fourteendays = count($dayss_tres);
////////////Get The Data From 30 days/////////////
            $date_tres = $this->Job->find('all', array('conditions' => array('Job.created >= NOW() - INTERVAL 30 DAY')));
            $job_counts_thirtydays = count($date_tres);
            $this->set('job_count_thirtydays', $job_counts_thirtydays);
            $this->set('job_count_fourteendays', $job_counts_fourteendays);
            $this->set('job_count_sevendays', $job_counties_sevendays);
            $this->set('job_count_threedays', $job_counti_threedays);
            $this->set('job_count_oneday', $job_counting_oneday);
        } else {
            $this->redirect('/login');
        }
    }

    /* Freelancer Find Jobs By Category Function */

    public function find_jobsby_category($id = NULL) {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('Category');
            $this->loadModel('Job');
            $this->loadModel('User');
            $this->loadModel('Subskill');
            $category = $this->Category->find('first', array('conditions' => array('Category.id' => $id), 'fields' => array('Category.name')));
            $this->paginate = array('limit' => 4, 'conditions' => array('AND' => array('Job.category_id' => $id, 'Job.status' => 1)), 'order' => 'Job.id DESC');
            $job_value = $this->paginate('Job');
            $count_job = count($job_value);
            if (!empty($job_value)) {
                foreach ($job_value as $kk => $vv) {
                    $crnt_date = time();
                    $userId = $vv['Job']['user_id'];
                    $user_info = $this->User->find('first', array('conditions' => array('User.id' => $userId)));
                    $selected = strtotime($vv['Job']['created']);
                    $diff = $crnt_date - $selected;
                    $date = $this->secondsToTime($diff);
                    $Job_skills = explode(',', $vv['Job']['skills']);
                    $Subskills = $this->Subskill->find('all', array('conditons' => array('subskill.skill_id' => $Job_skills)));
                    $text = 'Posted  ' . $date['h'] . ' hours ' . $date['m'] . ' Minutes ago ';
                    $job_value[$kk]['Job']['time_duration'] = $text;
                    $job_value[$kk]['Job']['client'] = $user_info;
                    $job_value[$kk]['Job']['skill'] = $Subskills;
                }
            }
            $this->set('count_job', $count_job);
            if (!empty($userId)) {
                $users = $this->User->find('first', array('conditions' => array('User.id' => $userId)));
                if (!empty($users)) {
                    $this->set('postedBy', $users);
                }
            }
            ///////Get The Data From 24 hours//////////
            $tres = $this->Job->find('all', array('conditions' => array('Job.created >= NOW() - INTERVAL 1 DAY')));
            $job_counting_oneday = count($tres);
            ////////////////Get The Data From 3 Day////////////
            $day_tres = $this->Job->find('all', array('conditions' => array('Job.created >= NOW() - INTERVAL 3 DAY')));
            $job_counti_threedays = count($day_tres);
            ////////////Get The Data From 7 days/////////////
            $days_tres = $this->Job->find('all', array('conditions' => array('Job.created >= NOW() - INTERVAL 7 DAY')));
            $job_counties_sevendays = count($days_tres);
            ////////////Get The Data From 14 days/////////////
            $dayss_tres = $this->Job->find('all', array('conditions' => array('Job.created >= NOW() - INTERVAL 14 DAY')));
            $job_counts_fourteendays = count($dayss_tres);
////////////Get The Data From 30 days/////////////
            $date_tres = $this->Job->find('all', array('conditions' => array('Job.created >= NOW() - INTERVAL 30 DAY')));
            $job_counts_thirtydays = count($date_tres);
            $this->set('job_count_thirtydays', $job_counts_thirtydays);
            $this->set('job_count_fourteendays', $job_counts_fourteendays);
            $this->set('job_count_sevendays', $job_counties_sevendays);
            $this->set('job_count_threedays', $job_counti_threedays);
            $this->set('job_count_oneday', $job_counting_oneday);
            $this->set('count_job', $count_job);
            $this->set('Category', $category);
            $this->set('jobdata', $job_value);
        } else {
            $this->redirect('/login');
        }
    }

    /* Freelancer Category Job Function */

    public function category_job($cate_id) {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('Category');
            $this->loadModel('Subcategory');
            $this->loadModel('Job');
            $this->loadModel('User');
            $this->loadModel('Subskill');
            include 'timefunction.php';
            $category_value = $this->Subcategory->find('first', array('conditions' => array('Subcategory.id' => $cate_id)));
            $sub_text = $category_value['Subcategory']['category_name'];
            $this->set('sub_text', $sub_text);
            $this->set('category_value', $category_value);
            $subcategory_value = $this->Subcategory->find('all', array('conditions' => array('Subcategory.category_id' => $category_value['Category']['id'])));
            $job_counts = array();
            foreach ($subcategory_value as $key => $val) {
                $job_counts[$val['Subcategory']['id']] = count($this->Job->find('all', array('conditions' => array('Job.subcategory_id' => $val['Subcategory']['id']))));
            }
            $this->set('job_counts', $job_counts);
            $this->set('subcategory', $subcategory_value);
            $categories = $this->Category->find('all', array('fields' => array('Category.name')));
            $this->set('categories', $categories);
            $this->paginate = array('limit' => 4, 'conditions' => array('Job.subcategory_id' => $cate_id,), 'order' => 'Job.id DESC');
            $job_detail = $this->paginate('Job');
            $job_count = count($job_detail);

            foreach ($job_detail as $key => $value) {
                $ids = $value['Job']['user_id'];
                $skills_id = explode(',', $value['Job']['skills']);
//            pr($skills_id);

                $Skills = $this->Subskill->find('all', array('conditiions' => array('Subskill.skill_id' => $skills_id)));
//            pr($Skills);
//            die('sadjsajdj');
                $users = $this->User->find('all', array('conditions' => array('User.id' => $ids)));
                $end_date = strtotime($value['Job']['created']);
                $current_date = time();
                $current_time = time();
                $diff = $current_date - $end_date;
                $obj = secondsToTime($diff);
                $actual_days = floor($diff / (60 * 60 * 24));
                $actual_hours = floor($diff / (60 * 60));
                $actual_minutes = floor(($diff - ($actual_days * 60 * 60 * 24) - ($actual_hours * 60 * 60)) / 60);
                $job_detail[$key]['Job']['days'] = $obj['d'];
                $job_detail[$key]['Job']['hours'] = $obj['h'];
                $job_detail[$key]['Job']['minutes'] = $obj['m'];
                $job_detail[$key]['Job']['seconds'] = $obj['s'];
                $job_detail[$key]['Job']['user_name'] = $users;
                $job_detail[$key]['Job']['skill'] = $Skills;
            }
//        pr($job_detail);
//        die('sdjhasjdhj');
///////Get The Data From 24 hours///////////////
            $tres = $this->Job->find('all', array('conditions' => array('Job.created >= NOW() - INTERVAL 1 DAY')));
            $job_counting_oneday = count($tres);
////////////////Get The Data From 3 Day////////////
            $day_tres = $this->Job->find('all', array('conditions' => array('Job.created >= NOW() - INTERVAL 3 DAY')));
            $job_counti_threedays = count($day_tres);
////////////Get The Data From 7 days/////////////
            $days_tres = $this->Job->find('all', array('conditions' => array('Job.created >= NOW() - INTERVAL 7 DAY')));
            $job_counties_sevendays = count($days_tres);
////////////Get The Data From 14 days/////////////
            $dayss_tres = $this->Job->find('all', array('conditions' => array('Job.created >= NOW() - INTERVAL 14 DAY')));
            $job_counts_fourteendays = count($dayss_tres);

////////////Get The Data From 30 days/////////////
            $date_tres = $this->Job->find('all', array('conditions' => array('Job.created >= NOW() - INTERVAL 30 DAY')));
            $job_counts_thirtydays = count($date_tres);
            $this->set('job_count_thirtydays', $job_counts_thirtydays);
            $this->set('job_count_fourteendays', $job_counts_fourteendays);
            $this->set('job_count_sevendays', $job_counties_sevendays);
            $this->set('job_count_threedays', $job_counti_threedays);
            $this->set('job_count_oneday', $job_counting_oneday);
            $this->set('job_count', $job_count);
            $this->set('job_detail', $job_detail);
        } else {
            $this->redirect('/login');
        }
    }

    /* Freelancer My Profile Function */

    public function myprofile() {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('User');
            $this->loadModel('Skill');
            $this->loadModel('Subskill');
            $this->loadModel('Country');
            $this->loadModel('Finalresult');
            $this->loadModel('Userlanguage');
            $this->loadModel('Test');
            $session = $this->Session->read();
            $user_id = $this->Auth->user('id');
            $user_data = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
            $language = $this->Userlanguage->find('all', array('conditions' => array('Userlanguage.user_id' => $user_id)));

            $skills = explode(',', $user_data['User']['skills']);
            $country_id = $user_data['User']['country_id'];
            $user_country = $this->Country->find('first', array('conditions' => array('Country.id' => $country_id)));
            $subskill = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $skills)));


            $result = $this->Finalresult->find('all', array('conditions' => array('Finalresult.status' => 1, 'Finalresult.user_id' => $user_id)));
            foreach ($result as $kk => $va) {
                $test_id = $va['Finalresult']['test_id'];
                $score = number_format($va['Finalresult']['score'], 1);
                $test_data = $this->Test->find('all', array('conditions' => array('Test.id' => $test_id)));
                $result[$kk]['test'] = $test_data;
                $result[$kk]['score'] = $score;
            }

            $this->set('result', $result);
            $this->set('userdata', $user_data);
            $this->set('userdata_country', $user_country);
            $this->set('skill', $subskill);
            $this->set('language', $language);
        } else {
            $this->redirect('/login');
        }
    }

    /* Freelancer Client Profile Function */

    public function client_profile($id = null) {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('User');
            $this->loadModel('Job');
            $this->loadModel('Country');
            $this->loadModel('Subskill');
            $last_url = $this->referer();
            $User_info = $this->User->find('first', array('conditions' => array('User.id' => $id, 'User.country_id !=' > '')));
            $cntry_id = $User_info['User']['country_id'];
            $skills = explode(',', $User_info['User']['skills']);
            $country = $this->Country->find('first', array('conditions' => array('Country.id' => $cntry_id)));
            $user_skills = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $skills), 'fields' => array('Subskill.skill_name')));
            $jobs = $this->Job->find('all', array('conditions' => array('Job.user_id' => $id, 'Job.status' => 1)));

            $this->set('client_info', $User_info);
            $this->set('Last_link', $last_url);
            $this->set('country_name', $country);
            $this->set('User_skills', $user_skills);
            $this->set('jobs_posted', $jobs);
        } else {
            $this->redirect('/login');
        }
    }

    /* Freelancer Find Job By Category Function */

    public function find_jobby_category($id = NULL) {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('Category');
            $this->loadModel('Job');
            $this->loadModel('User');
            $category = $this->Category->find('first', array('conditions' => array('Category.id' => $id), 'fields' => array('Category.name')));
            $this->paginate = array('limit' => 5, 'conditions' => array('AND' => array('Job.category_id' => $id, 'Job.status' => 1)), 'order' => 'Job.id ASC');
            $job_value = $this->paginate('Job');
            $count_job = count($job_value);
            if (!empty($job_value)) {
                foreach ($job_value as $kk => $vv) {
                    $crnt_date = time();
                    $userId[] = $vv['Job']['user_id'];
                    $selected = strtotime($vv['Job']['created']);
                    $diff = $crnt_date - $selected;
                    $date = $this->secondsToTime($diff);
                    $text = 'Posted  ' . $date['h'] . ' hours ' . $date['m'] . ' Minutes ago ';
                    $job_value[$kk]['Job']['time_duration'] = $text;
                }
            }
            $this->set('count_job', $count_job);
            if (!empty($userId)) {
                $users = $this->User->find('first', array('conditions' => array('User.id' => $userId)));
                if (!empty($users)) {
                    $this->set('postedBy', $users);
                }
            }

            ///////Get The Data From 24 hours///////////////
            $tres = $this->Job->find('all', array('conditions' => array('Job.created >= NOW() - INTERVAL 1 DAY')));
            $job_counting_oneday = count($tres);
////////////////Get The Data From 3 Day////////////
            $day_tres = $this->Job->find('all', array('conditions' => array('Job.created >= NOW() - INTERVAL 3 DAY')));
            $job_counti_threedays = count($day_tres);
////////////Get The Data From 7 days/////////////
            $days_tres = $this->Job->find('all', array('conditions' => array('Job.created >= NOW() - INTERVAL 7 DAY')));
            $job_counties_sevendays = count($days_tres);
////////////Get The Data From 14 days/////////////
            $dayss_tres = $this->Job->find('all', array('conditions' => array('Job.created >= NOW() - INTERVAL 14 DAY')));
            $job_counts_fourteendays = count($dayss_tres);
////////////Get The Data From 30 days/////////////
            $date_tres = $this->Job->find('all', array('conditions' => array('Job.created >= NOW() - INTERVAL 30 DAY')));
            $job_counts_thirtydays = count($date_tres);
            $this->set('job_count_thirtydays', $job_counts_thirtydays);
            $this->set('job_count_fourteendays', $job_counts_fourteendays);
            $this->set('job_count_sevendays', $job_counties_sevendays);
            $this->set('job_count_threedays', $job_counti_threedays);
            $this->set('job_count_oneday', $job_counting_oneday);
            $this->set('count_job', $count_job);
            $this->set('Category', $category);
            $this->set('jobdata', $job_value);
        } else {
            $this->redirect('/login');
        }
    }

    /* Freelancer Send Invitation Function */

    public function send_invitation($job_id = null) {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('Message');
            $this->loadModel('Contect');
            $this->loadModel('Country');
            $this->loadModel('User');
            $this->loadModel('Subskill');
            $user_id = $this->Auth->user('id');
            $send_invitation = $this->Contect->find('first', array('conditions' => array('Contect.job_id' => $job_id)));
            $client_msg = nl2br($send_invitation['Contect']['messages']);
            $this->set('ClientMessage', $client_msg);
            $this->set('send_invitation', $send_invitation);
            $users = $this->User->find('first', array('conditions' => array('User.id' => $send_invitation['Contect']['client_id'])));
            $client_id = $users['User']['id'];
            $this->set('users', $users);
            $cntry = $this->Country->find('first', array('conditions' => array('Country.id' => $users['User']['country_id'])));
            $this->set('cntry', $cntry);
            $skills = explode(',', $users['User']['skills']);
            $subskills = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $skills)));
            $this->set('subskills', $subskills);
            $this->set('reciever_id', $client_id);
            $this->set('sender_id', $user_id);
        } else {
            $this->redirect('/login');
        }
    }

    /* Freelancer Send Mesg Function */

    public function send_mesg() {
        $this->autoRender = false;
        $this->loadModel('Message');
        $this->loadModel('Contect');
        $this->loadModel('User');
        $this->loadModel('Notification');
        $sender = $_POST['sender_id'];
        $reciever = $_POST['receiver_id'];
        $job = $_POST['job_id'];
        $select = $_POST['select'];
        $contect = $this->Contect->find('first', array('conditions', array('Contect.job_id' => $job)));
        $sender_info = $this->User->find('first', array('conditions' => array('User.id' => $sender)));
        $this->request->data['Message']['sender'] = $sender;
        $this->request->data['Message']['reciever'] = $reciever;
        $this->request->data['Message']['job_id'] = $job;
        $this->request->data['Message']['reply'] = $select;
        $this->request->data['Message']['client_message'] = $contect['Contect']['messages'];
        $this->request->data['Message']['status'] = 1;

//        $client_notification['Notification']['sender_id'] = $sender;
//        $client_notification['Notification']['reciever_id'] = $reciever;
//        $client_notification['Notification']['notification_msg'] = 'You have recieved a message from <a href="#" style="text-decoration:none;">' . $sender_info['User']['first_name'] . ' ' . $sender_info['User']['last_name'] . '</a> .';
//
//        $this->Notification->save($client_notification);
        if ($this->Message->save($this->request->data)) {
            $array = array('status' => 'true');
            echo json_encode($array);
        }
    }

    /* Freelancer View Help Function */

    public function view_help($ques) {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('Faq');
            $faqs = $this->Faq->find('first', array('conditions' => array('Faq.id' => $ques)));
            $this->set('faqs', $faqs);
        } else {
            $this->redirect('/login');
        }
    }

    /* Freelancer Starting Test Function */

    public function starting_test($id) {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('Question');
            $this->loadModel('Result');
            $this->Question->recursive = -1;
            $user_id = $this->Auth->user('id');

            $result = $this->Result->find('first', array('conditions' => array('Result.test_id' => $id)));
            $this->set('res', $result);
            $test_count = count($this->Question->find('all', array('conditions' => array('Question.test_id' => $id))));
            $this->set('test', $test_count);

            $question = $this->Question->find('all', array('conditions' => array('Question.test_id' => $id), 'limit' => 1));

            $count_ques = count($question);

            if ($this->request->is('post')) {
                $this->Session->write('question_number', $this->request->data['Question']['question_number']);
                $count = $this->Session->read('question_number');
                $count = $count + 1;
                if (empty($this->request->data['Question']['myradio']) and ( $this->request->data['Question']['disable'] == '1')) {
                    $error_data = $this->Session->setFlash('Firstly, you have select the  answer', 'error');
                    $this->set('error_data', $error_data);
                } else {
                    $question = $this->Question->find('all', array('conditions' => array('AND' => array('Question.id >' => $this->request->data['Question']['test_id'], 'Question.test_id' => $id)), 'limit' => 1));
                    $count_qus = count($question);
                    if (!empty($this->request->data['Question']['myradio'])) {
                        $this->request->data['Result']['question_id'] = $this->request->data['Question']['test_id'];
                        $quest_data = $this->Question->findById($this->request->data['Question']['test_id']);
                        $current_question_total_time = $quest_data['Question']['minutes'] . '.' . $quest_data['Question']['seconds'];
                        $this->request->data['Result']['option_value'] = $this->request->data['Question']['myradio'];
                        $this->request->data['Result']['total_time'] = $current_question_total_time - str_replace(':', '.', $this->request->data['Question']['total_time']);
                        $this->request->data['Result']['test_id'] = $id;
                        $this->request->data['Result']['user_id'] = $user_id;
                        $this->request->data['Result']['topic_id'] = $this->request->data['Question']['topic_id'];
                        $this->request->data['Result']['status'] = '0';
                        $this->set($this->request->data);
                        $this->Result->save($this->request->data);
                    }
                    if (empty($question)) {
                        $this->redirect(array('controller' => 'freelancer', 'action' => 'test_result', $id));
                    }
                }
            }
            foreach ($question as $key => $val) {
                $options = explode(',', $val['Question']['options']);
                $question[$key]['option_data'] = $options;
                $minutes = $val['Question']['minutes'];
                $seconds = $val['Question']['seconds'];
                $millisec = $minutes * 1000 + $seconds * 1000;
            }
            if (!empty($question)) {
                $this->set('minutes', $minutes);
                $this->set('seconds', $seconds);
                $this->set('milliseconds', $millisec);
            }
            $this->set('ques', $question);

            if (isset($count)) {
                $this->set('count', $count);
            }
        } else {
            $this->redirect('/login');
        }
    }

    /* Freelancer Enteries Function */

    public function enteries() {
        $this->layout = 'front';
        $this->loadModel('Test');
    }

    /* Freelancer Test Result Function */

    public function test_result($test_id) {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('Question');
            $this->loadModel('Result');
            $this->loadModel('Testcontent');
            $this->loadModel('Finalresult');
            $this->loadModel('Test');
            $user_id = $this->Auth->user('id');
            $test = $this->Test->find('first', array('conditions' => array('Test.id' => $test_id)));
            $result_data = $this->Result->find('all', array('conditions' => array('Result.test_id' => $test_id, 'Result.user_id' => $user_id)));
            foreach ($result_data as $key => $value) {
                $option_value = $value['Result']['option_value'];
                $question_id = $value['Result']['id'];
                $answer = $value['Question']['answers'];
                if ($option_value == $answer) {
                    $this->request->data['Result']['status'] = "1";
                    $this->Result->id = $question_id;
                    $this->set($this->request->data);
                    $this->Result->save($this->request->data);
                } else {
                    $this->request->data['Result']['status'] = "0";
                    $this->Result->id = $question_id;
                    $this->set($this->request->data);
                    $this->Result->save($this->request->data);
                }
            }
            $option_data = $this->Testcontent->find('all', array('conditions' => array('Testcontent.test_id' => $test_id)));
            foreach ($option_data as $key => $val) {
                $topic_id = $val['Testcontent']['id'];
                $result_val = $this->Result->find('all', array('conditions' => array('AND' => array('Result.topic_id' => $topic_id, 'Result.test_id' => $test_id, 'Result.user_id' => $user_id))));

                $total_value = count($result_val);
                $result_value = $this->Result->find('all', array('conditions' => array('AND' => array('Result.status' => '1', 'Result.topic_id' => $topic_id, 'Result.user_id' => $user_id))));
                $appered_value = count($result_value);

                if ($appered_value == 0) {
                    $percentage = 0;
                } else {
                    $percentage = $appered_value / $total_value * 100;
                }
                $percentage_data = number_format($percentage, 0);
                $option_data[$key]['percentage'] = $percentage_data;
                $option_data[$key]['result'] = $result_val;
            }
            $test_result = $this->Result->find('all', array('conditions' => array('AND' => array('Result.status' => '1', 'Result.test_id' => $test_id, 'Result.user_id' => $user_id))));

            $right_ans = count($test_result);
            $total_result = $this->Result->find('all', array('conditions' => array('Result.test_id' => $test_id, 'Result.user_id' => $user_id)));


            $total = count($total_result);
            if ($total == 0) {
                $percent = 0;
            } else {
                $percent = $right_ans / $total * 5;
            }

            $score1 = number_format($percent, 1);
            $sum = 0;
            foreach ($total_result as $key => $val) {

                $sum+=$val['Result']['total_time'];
            }

            $current_date = date('Y-m-d');
            $time = strtotime('+1 month', time());
            $date = date('Y-m-d', $time);
            $this->set('option', $option_data);
            $this->set('result', $result_data);
            $this->set('score', $score1);
            $this->set('testid', $test_id);
            $this->set('test', $test);

            if ($this->request->is('post')) {
                if (($percent < 2.5)) {
                    $this->request->data['Finalresult']['percentile'] = 'Failed';
                } else {
                    $this->request->data['Finalresult']['percentile'] = 'Passed';
                }
                $result_id = implode(',', $this->request->data['Finalresult']['result_id']);
                $this->request->data['Finalresult']['score'] = $percent;
                $this->request->data['Finalresult']['rating'] = 5;
                $this->request->data['Finalresult']['total_time'] = str_replace('.', ':', $sum);
                $this->request->data['Finalresult']['result_id'] = $result_id;
                $this->request->data['Finalresult']['test_id'] = $test_id;
                $this->request->data['Finalresult']['user_id'] = $user_id;
                $this->request->data['Finalresult']['last_date'] = $current_date;
                $this->request->data['Finalresult']['next_date'] = $date;
                if ($this->Finalresult->save($this->request->data)) {
                    $this->redirect(array('controller' => 'freelancer', 'action' => 'finalresult', $test_id));
                }
            }
        } else {
            $this->redirect('/login');
        }
    }

    /* Freelancer Online Test Policy Function */

    public function OnlineTestPolicy() {
        $this->layout = 'front';
    }

    /* Freelancer Final Result Function */

    public function finalresult($test_ids) {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('Finalresult');
            $this->loadModel('User');
            $this->loadModel('Question');
            $this->loadModel('Testcontent');
            $this->loadModel('Result');
            $this->loadModel('Test');
            $this->Question->recursive = -1;
            $user_id = $this->Auth->user('id');
            $final_result = $this->Finalresult->find('first', array('conditions' => array('Finalresult.test_id' => $test_ids, 'Finalresult.user_id' => $user_id)));
            $this->set('result', $final_result);
            if (!empty($final_result['Finalresult']['user_id'])) {
                $user = $this->User->find('first', array('conditions' => array('User.id' => $final_result['Finalresult']['user_id']), 'order' => 'User.id DESC'));
                $this->set('user', $user);
            }
            $question = $this->Question->find('all', array('conditions' => array('Question.test_id' => $test_ids)));
            $sum = 0;
            foreach ($question as $k => $v) {
                $sec = $v['Question']['seconds'];
                $min = $v['Question']['minutes'];
                $time = $min . "." . $sec;
                $sum+=$time;
            }
            $total_time = number_format($sum, 2);
            $sum1 = str_replace('.', ':', $total_time);
            $test_content = $this->Testcontent->find('all', array('conditions' => array('Testcontent.test_id' => $test_ids)));
            foreach ($test_content as $kk => $vv) {
                $topic_id = $vv['Testcontent']['id'];
                $correct_ans = $this->Result->find('all', array('conditions' => array('AND' => array('Result.status' => '1', 'Result.topic_id' => $topic_id, 'Result.test_id' => $test_ids, 'Result.user_id' => $user_id))));
                $count = count($correct_ans);

                $total_ans = $this->Result->find('all', array('conditions' => array('AND' => array('Result.topic_id' => $topic_id, 'Result.test_id' => $test_ids, 'Result.user_id' => $user_id))));
                $count_total = count($total_ans);
                if ($count == 0) {
                    $percentage = 0;
                } else {
                    $percentage = $count / $count_total * 100;
                }
                $percetage_data = number_format($percentage, 0);

                $test_content[$kk]['total'] = $percetage_data;
            }

            $test = $this->Test->find('first', array('conditions' => array('Test.id' => $test_ids)));

            $this->set('test', $test);
            $this->set('test_id', $test_ids);
            $this->set('testdata', $test_content);

            $this->set('sum', $sum1);
        } else {
            $this->redirect('/login');
        }
    }

    /* Freelancer View Jobdetails Function */

    public function view_jobdetails($job_id) {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('Job');
            $this->loadModel('Jobdetail');
            $this->loadModel('Hire');
            $this->loadModel('Category');
            $this->loadModel('Subcategory');
            $this->loadModel('Acceptinterview');
            $this->loadModel('User');
            $this->loadModel('Country');
            $this->loadModel('ChangeTerm');
            $this->loadModel('Subskill');
            $user_id = $this->Auth->user('id');
            if (!empty($job_id)) {
                $changes = $this->ChangeTerm->find('first', array('conditions' => array('ChangeTerm.job_id' => $job_id, 'ChangeTerm.freelancer_id' => $user_id)));
                $this->set('changes', $changes);
                $job_dataa = $this->Job->find('first', array('conditions' => array('Job.id' => $job_id)));
                $category_name = $this->Subcategory->find('first', array('conditions' => array('Subcategory.id' => $job_dataa['Job']['subcategory_id'])));
                $this->set('category_name', $category_name);
                $total = $job_dataa['Job']['budget'] * 8 / 100;
                $total_budget = $job_dataa['Job']['budget'] - $total;
                $this->set('total', $total_budget);
                $jobdetail = $this->Jobdetail->find('first', array('conditions' => array('Jobdetail.freelancer_id' => $user_id, 'Jobdetail.job_id' => $job_id)));

                $crnt_date = time();
                $selected = strtotime($jobdetail['Jobdetail']['created']);
                $diff = $crnt_date - $selected;
                $date = $this->secondsToTime($diff);
                $text = 'Posted ' . $date['d'] . ' days ago';
                $jobdetail['Jobdetail']['time_duration'] = $text;
                $this->set('jobdetail', $jobdetail);
                $this->set('jobdet', $job_dataa);
            }
            if (!empty($jobdetail)) {
                $answer = explode(',', $jobdetail['Jobdetail']['additional_question']);
                $jobs = $this->Job->find('first', array('conditions' => array('Job.id' => $job_id)));
                $skills = explode(',', $jobs['Job']['skills']);
                $sub_skill = $this->Subskill->find('all', array('conditions' => array('Subskill.skill_id' => $skills)));

                $question = explode(',', $jobs['Job']['additional_question']);
                $user_data = $this->User->find('first', array('conditions' => array('User.id' => $jobs['Job']['user_id'])));
                $country_id = $user_data['User']['country_id'];
                $country_name = $this->Country->find('first', array('conditions' => array('Country.id' => $country_id)));
                $category = $this->Category->find('first', array('conditions' => array('Category.id' => $jobs['Job']['category_id'])));
                $subcategory = $this->Subcategory->find('first', array('conditions' => array('Subcategory.id' => $jobs['Job']['subcategory_id'])));
                $job_count = $this->Job->find('all', array('conditions' => array('Job.user_id' => $jobs['Job']['user_id'])));
                $hires = $this->Hire->find('count', array('conditions' => array('Hire.job_id' => $job_id, 'Hire.hiring_id' => $jobs['Job']['user_id'])));
                $hire_data = $this->Hire->find('all', array('conditions' => array('Hire.hiring_id' => $jobs['Job']['user_id'])));
                foreach ($hire_data as $k => $v) {
                    $hirejob[] = $v['Hire']['job_id'];
                    $hireclient[] = $v['Hire']['hiring_id'];
                }
                $jobs_data = $this->Jobdetail->find('all', array('conditions' => array('Jobdetail.client_id' => $jobs['Job']['user_id'])));
                foreach ($jobs_data as $k => $vv) {
                    $jobs_id[] = $vv['Jobdetail']['job_id'];
                    $jbs_id[] = $vv['Jobdetail']['client_id'];
                }
                if (!empty($hireclient) && !empty($hireclient)) {
                    $res_mer = array_merge($hirejob, $jobs_id);
                    $res_merg = array_merge($hireclient, $jbs_id);
                    $jobs_value = $this->Job->find('all', array('conditions' => array('Job.id !=' => $res_mer, 'Job.user_id' => $res_merg)));
                    $count_val = count($jobs_value);
                    $this->set('counts', $count_val);
                }
                $count_data = count($job_count);
                $this->set('jobs', $jobs);
                $this->set('skills', $sub_skill);
                $this->set('hire', $hires);
                $this->set('count', $count_data);
                $this->set('category', $category);
                $this->set('country', $country_name);
                $this->set('subcategory', $subcategory);
                $this->set('question', $question);
                $this->set('answer', $answer);
                $this->set('user', $user_data);
            }
        } else {
            $this->redirect('/login');
        }
    }

    /* Freelancer Delete Notification Function */

    public function delete_notify($notify_id) {
        $this->autoRender = FALSE;
        $this->loadModel('Notification');
        $this->Notification->delete($notify_id);
        $this->redirect(array('controller' => 'freelancer', 'action' => 'allNotifications'));
    }

    /* Freelancer Ajax Val For Notification Function */

    public function ajax_val() {
        $this->autoRender = FALSE;
        $this->loadModel('Notificationsetting');
        $user_id = $this->Auth->user('id');
        $check_data = $_POST['arr'];
        $data = serialize($check_data);
        $notify_data = $this->Notificationsetting->find('first', array('conditions' => array('Notificationsetting.user_id' => $user_id)));
        $count = count($notify_data);
        $this->request->data['Notificationsetting']['check_value'] = $data;
        $this->request->data['Notificationsetting']['user_id'] = $user_id;
        if ($count > 0) {
            $this->Notificationsetting->id = $notify_data['Notificationsetting']['id'];
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
    }

    /* Freelancer Contact Information Function */

    public function contact_info() {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('User');
            $this->loadModel('Country');
            $user_id = $this->Auth->user('id');
            $users = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
            $country_id = $users['User']['country_id'];
            $user_country = $this->Country->find('first', array('conditions' => array('Country.id' => $country_id)));
            $this->set('user', $users);
            $this->set('u_country', $user_country);
        } else {
            $this->redirect('/login');
        }
    }

    public function edit_rate() {
        $this->layout = 'ajax_language';
        $this->loadModel('User');
    }

    public function ajax_editlanguage() {
        $this->autoRender = false;
        $this->loadModel('User');
        $u_id = $this->Auth->user('id');
        $language = $_POST['language'];
        $proficiency = $_POST['prof'];
        $User_info = $this->User->find('first', array('conditions' => array('User.id' => $u_id)));
        $lng = $User_info['User']['language'];
        $prf = $User_info['User']['proficiency'];

        if (strpos($User_info['User']['language'], ',') !== false) {
            $this->request->data['User']['language'] = $lng . ',' . $language;
            $this->request->data['User']['proficiency'] = $prf . ',' . $proficiency;
        } else {
            $this->request->data['User']['language'] = $language . ',';
            $this->request->data['User']['proficiency'] = $proficiency . ',';
        }
        $this->User->id = $u_id;
        $this->set($this->request->data);
        if ($this->User->save($this->request->data)) {
            $arr['suc'] = 'yes';
        }
        echo json_encode($arr);
    }

    public function applicants($id = null) {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('Contect');
            $this->loadModel('Job');
            $this->loadModel('User');
            $this->loadModel('Subskill');
            $this->loadModel('Message');
            $this->loadModel('Country');
            $this->loadModel('Notification');
            $this->loadModel('Acceptinterview');
            $this->loadModel('Hire');
            $this->loadModel('Paypalpayment');
            $this->loadModel('Projectfeedback');
            $this->loadModel('Admin');
            $freelancer_id = $this->Auth->user('id');
            $admin_data = $this->Admin->find('first');
            $notifications = $this->Notification->find('first', array('conditions' => array('Notification.job_id' => $id, 'Notification.reciever_id' => $freelancer_id, 'Notification.url LIKE' => '%applicants/' . $id . '%')));
            if (!empty($notifications)) {
                if ($notifications['Notification']['status'] == 1) {
                    $this->request->data['Notification']['url'] = BASE_URL . '/freelancer/job_application/' . $id;
                    $this->Notification->id = $notifications['Notification']['id'];
                    $this->Notification->save($this->request->data);
                }
            }
            $freelancer = $this->User->find('first', array('conditions' => array('User.id' => $freelancer_id)));
            $findJob = $this->Contect->find('first', array('conditions' => array('Contect.job_id' => $id)));
            $currentdate = time();
            $selecteddate = strtotime($findJob['Contect']['created']);
            $diff = $currentdate - $selecteddate;
            $date = $this->secondsToTime($diff);
            $text = $date['h'] . '  hours  ' . $date['m'] . '   min ago';
            $job_id = $findJob['Contect']['job_id'];
            $client_id = $findJob['Contect']['client_id'];
            $FeedbackToClient = $this->Projectfeedback->find('first', array('conditions' => array('Projectfeedback.client_id' => $client_id, 'Projectfeedback.user_type' => 'freelancer', 'Projectfeedback.freelancer_id' => $freelancer_id)));
            $ReviewToClient = $this->Projectfeedback->find('all', array('conditons' => array('Projectfeedback.freelancer_id' => $freelancer_id, 'Projectfeedback.client_id' => $client_id, 'Projectfeedback.user_type' => 'freelancer')));
            $Count_review = count($ReviewToClient);
//        pr($Count_review);
//        die('sadvhsad');
            $this->set('Review_client', $Count_review);
            $this->set('Feedback', $FeedbackToClient);
            $job = $this->Job->find('first', array('conditions' => array('Job.id' => $id, 'Job.user_id' => $client_id)));
            $budget = $job['Job']['budget'];
            $earn = $budget * 10 / 100;
            $total_budget = $budget - $earn;
            $job_skills = explode(',', $job['Job']['skills']);
            $client_info = $this->User->find('first', array('conditions' => array('User.id' => $client_id)));
            $country = $this->Country->find('first', array('conditions' => array('Country.id' => $client_info['User']['country_id'])));
            $skills = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $job_skills)));
            $job_count = $this->Job->find('count', array('conditions' => array('Job.id' => $id, 'Job.user_id' => $job['Job']['user_id'])));
            $this->set('Job_count', $job_count);
            $hire_count = $this->Hire->find('count', array('conditions' => array('Hire.job_id' => $id, 'Hire.contractor_id' => $freelancer_id, 'Hire.hire_status' => 'Active', 'Hire.hiring_id' => $job['Job']['user_id'])));
            //  pr($hire_count); 
            $this->set('hire_count', $hire_count);
            $hire_data = $this->Hire->find('all', array('conditions' => array('Hire.hiring_id' => $job['Job']['user_id'], 'Hire.job_id' => $id, 'Hire.contractor_id' => $freelancer_id, 'Hire.hire_status' => 'Active')));

            $jobs_data = $this->Contect->find('all', array('conditions' => array('Contect.client_id' => $job['Job']['user_id'], 'Contect.job_id' => $id, 'Contect.user_id' => $freelancer_id)));
            $arr_data = array_merge($hire_data, $jobs_data);
            foreach ($arr_data as $k => $v) {
                if (array_key_exists('Hire', $v)) {
                    $client_ids[] = $v['Hire']['hiring_id'];
                    $job_ids[] = $v['Hire']['job_id'];
                } else {
                    $client_ids[] = $v['Contect']['client_id'];
                    $job_ids[] = $v['Contect']['job_id'];
                }
            }
            if (!empty($client_ids) and !empty($job_ids)) {
                $jobs_count = $this->Job->find('all', array('conditions' => array('Job.id !=' => $job_ids, 'Job.user_id' => $client_id)));
//            $jobs_count = $this->Job->find('count', array('conditions' => array('Job.id!=' => $job_ids, 'Job.user_id' => $client_id)));
                // pr($jobs_count); die;
                $jobs_count = count($jobs_count);

                $this->set('job_count', $jobs_count);
            }
            $payment = $this->Paypalpayment->find('first', array('conditions' => array('Paypalpayment.job_id' => $job_id, 'Paypalpayment.freelancer_id' => $freelancer_id)));
            $this->set('payment', $payment);
            if ($this->request->is('post')) {
                $this->request->data['Acceptinterview']['client_id'] = $client_id;
                $this->request->data['Acceptinterview']['job_id'] = $job_id;
                $this->request->data['Acceptinterview']['job_status'] = 'invited';
                $this->request->data['Acceptinterview']['decline_status'] = '';
                $this->set($this->request->data);
                $message_data['Message']['sender'] = $freelancer_id;
                $message_data['Message']['reciever'] = $client_id;
                $message_data['Message']['job_id'] = $job_id;
                $reply = nl2br($this->request->data['Acceptinterview']['message']);
                $message_data['Message']['reply'] = $reply;
                $message_data['Message']['status'] = 1;
                $message_data['Message']['read_status'] = 0;

                $this->Message->save($message_data);
                $this->request->data['Job']['job_status'] = '1';
                $this->Job->id = $job_id;
                $this->set($this->request->data);
                $this->Job->save($this->request->data);
                $notify['Notification']['sender_id'] = $freelancer_id;
                $notify['Notification']['reciever_id'] = $client_id;
                $notify['Notification']['url'] = BASE_URL . '/client/job_application/' . $freelancer_id;
                $notify['Notification']['notification_msg'] = $freelancer['User']['first_name'] . '   ' . $freelancer['User']['last_name'] . '  accepted your invitation to interview for the Job "' . $job['Job']['job_title'] . '"';
                $notify['Notification']['status'] = 0;
                $notify['Notification']['job_id'] = $job_id;
                $this->Notification->save($notify);
                if ($this->Acceptinterview->save($this->request->data)) {

                    $Email = new CakeEmail();
                    $Email->template('acceptinterview');
                    $Email->emailFormat('html');
                    $Email->viewVars(array('data' => $job['Job']['job_title'], 'client_fname' => $client_info['User']['first_name'], 'free_lname' => $freelancer['User']['last_name'], 'Job_id' => $job['Job']['id'], 'free_fname' => $freelancer['User']['first_name']));
                    $Email->from(array('Jobider@pnf.com' => 'Jobider Notification'));
                    $Email->to($client_info['User']['email']);
                    $Email->subject($client_info['User']['first_name'] . '' . $client_info['User']['last_name'] . ' has accepted your interview invitation for:' . $job['Job']['job_title'], 'success');
                    $Email->send();
                    $Email->template('acceptinterview');
                    $Email->emailFormat('html');
                    $Email->viewVars(array('data' => $job['Job']['job_title'], 'client_fname' => $client_info['User']['first_name'], 'free_lname' => $freelancer['User']['last_name'], 'Job_id' => $job['Job']['id'], 'free_fname' => $freelancer['User']['first_name']));
                    $Email->from(array('Jobider@pnf.com' => 'Jobider Notification'));
                    $Email->to($admin_data['Admin']['email']);
                    $Email->subject($client_info['User']['first_name'] . '' . $client_info['User']['last_name'] . ' has accepted your interview invitation for:' . $job['Job']['job_title'], 'success');
                    $Email->send();
                    $this->redirect(array('controller' => 'freelancer', 'action' => 'job_application/' . $job_id));
                }
            }
            $this->set('InvitationSent', $findJob);
            $this->set('Job_detail', $job);
            $this->set('skill_data', $skills);
            $this->set('timeduration', $text);
            $this->set('Client', $client_info);
            $this->set('Client_country', $country);
            $this->set('free_id', $freelancer_id);
            $this->set('budget', $budget);
            $this->set('earn', $total_budget);
        } else {
            $this->redirect('/login');
        }
    }

    public function decline_jobs($job_id = null) {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->autoRender = false;
            $this->loadModel('Contect');
            $this->loadModel('Declinejob');
            $this->loadModel('Job');
            $freelancer_id = $this->Auth->user('id');
            $find_data = $this->Job->find('first', array('conditions' => array('Job.id' => $job_id)));
            $client_id = $find_data['Job']['user_id'];
//        $Job_id = $find_data['Contect']['job_id'];
            if ($this->request->is('post')) {
                $this->request->data['Declinejob']['freelancer_id'] = $freelancer_id;
                $this->request->data['Declinejob']['client_id'] = $client_id;
                $this->request->data['Declinejob']['job_id'] = $job_id;
                $this->request->data['Declinejob']['decline_status'] = 'Declined by You';
                $find_job = $this->Job->find('first', array('conditions' => array('Job.id' => $job_id)));

                $this->request->data['Job']['job_status'] = 'in-active';
                $this->Job->id = $find_job['Job']['id'];
                $this->set($this->request->data);
                $this->Job->save($this->request->data);
                if ($this->Declinejob->save($this->request->data)) {
                    $this->redirect(array('controller' => 'freelancer', 'action' => 'applicants/' . $job_id));
                }
            }
        } else {
            $this->redirect('/login');
        }
    }

    public function viewJobPosting($id = null) {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('Contect');
            $this->loadModel('Subskill');
            $this->loadModel('Jobdetail');
            $this->loadModel('Job');
            $this->loadModel('User');
            $login_user = $this->Auth->user('id');
            $applied_applicants = $this->Jobdetail->find('all', array('conditions' => array('Jobdetail.job_id' => $id, 'Jobdetail.freelancer_id' => $login_user)));
            foreach ($applied_applicants as $kk => $vv) {
                $currentDate = time();
                $selected_Date = strtotime($vv['Jobdetail']['created']);
                $diff = $currentDate - $selected_Date;
                $date = $this->secondsToTime($diff);
                $text = $date['d'] . ' days' . $date['h'] . ' hours ' . $date['m'] . ' minutes ago ';
                $applied_applicants[$kk]['Time_duration'] = $text;
            }
            $applied_applicants_count = count($applied_applicants);
            $find_job = $this->Contect->find('first', array('conditions' => array('Contect.job_id' => $id, 'Contect.user_id' => $login_user)));
            $client_id = $find_job['Contect']['client_id'];
            $freelancer_id = $find_job['Contect']['user_id'];
            $freelancer_detail = $this->User->find('first', array('conditions' => array('User.id' => $freelancer_id)));
            $other_open_jobs = $this->Job->find('all', array('conditions' => array('Job.user_id' => $client_id, 'Job.id !=' => $id)));
            $count_of_Openjobs = count($other_open_jobs);
            $currentDate = time();
            $selectedDate = strtotime($find_job['Contect']['created']);
            $Difference = $currentDate - $selectedDate;
            $date = $this->secondsToTime($Difference);
            $text = $date['d'] . ' days ' . $date['h'] . ' hours ago ';
            $text1 = $date['d'] . ' days  ago ';
            $job_skills = explode(',', $find_job['Job']['skills']);
            $Skills = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $job_skills)));
            $apply_users = $this->Jobdetail->find('count', array('conditions' => array('Jobdetail.freelancer_id' => $login_user, 'Jobdetail.job_id' => $id)));
            $invite_user = $this->Contect->find('count', array('conditions' => array('Contect.user_id' => $login_user, 'Contect.job_id' => $id)));
            $applicants = $apply_users + $invite_user;
            $this->set('Jobs_result', $find_job);
            $this->set('timeduration', $text);
            $this->set('days', $text1);
            $this->set('Skills_result', $Skills);
            $this->set('Total_applicants', $applicants);
            $this->set('freelancer', $freelancer_detail);
            $this->set('Count_openjobs', $count_of_Openjobs);
            $this->set('openjobs', $other_open_jobs);
            $this->set('JobApplicants', $applied_applicants);
            $this->set('JobApplicants_count', $applied_applicants_count);
        } else {
            $this->redirect('/login');
        }
    }

    public function viewjob($job_id = null) {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('Job');
            $this->loadModel('Subskill');
            $this->loadModel('User');
            $this->loadModel('Jobdetail');
            $this->Job->recursive = -1;
            $freeId = $this->Auth->user('id');
            $job_applicants = $this->Jobdetail->find('all', array('conditions' => array('Jobdetail.job_id' => $job_id, 'Jobdetail.freelancer_id' => $freeId)));
            foreach ($job_applicants as $kk => $vv) {
                $currentDate = time();
                $selected_Date = strtotime($vv['Jobdetail']['created']);
                $diff = $currentDate - $selected_Date;
                $date = $this->secondsToTime($diff);
                $text = $date['d'] . ' days   ' . $date['h'] . ' hours ' . $date['m'] . ' minutes ago';
                $job_applicants[$kk]['timeduration'] = $text;
            }
            $Job_detail = $this->Job->find('first', array('conditions' => array('Job.id' => $job_id)));
            $user_id = $Job_detail['Job']['user_id'];
            $currentdate = time();
            $selected = strtotime($Job_detail['Job']['created']);
            $diff = $currentdate - $selected;
            $date = $this->secondsToTime($diff);
            $text = $date['d'] . ' days ' . $date['h'] . ' hours ago';
            $Skills_of_job = explode(',', $Job_detail['Job']['skills']);
            $all_skills = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $Skills_of_job)));
            $all_open_jobs = $this->Job->find('all', array('conditions' => array('Job.id !=' => $job_id, 'Job.user_id' => $user_id)));
            $apply_users = $this->Jobdetail->find('count', array('conditions' => array('Jobdetail.freelancer_id' => $freeId, 'Jobdetail.job_id' => $job_id)));
            $invite_user = $this->Contect->find('count', array('conditions' => array('Contect.user_id' => $freeId, 'Contect.job_id' => $job_id)));
            $applicants = $apply_users + $invite_user;
            $this->set('Job', $Job_detail);
            $this->set('allSkills', $all_skills);
            $this->set('timeDuration', $text);
            $this->set('otherjobs', $all_open_jobs);
            $this->set('applicant', $applicants);
            $this->set('Job_apply_applicant', $job_applicants);
        } else {
            $this->redirect('/login');
        }
    }

    public function job_application($job_id = null) {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('User');
            $this->loadModel('Job');
            $this->loadModel('Contect');
            $this->loadModel('Subskill');
            $this->loadModel('Country');
            $this->loadModel('Message');
            $this->loadModel('Acceptinterview');
            $this->loadModel('Changeterm');
            $this->loadModel('Hire');
            $this->loadModel('Paypalpayment');
            $this->loadModel('Projectfeedback');
            $this->loadModel('Admin');
            $freelancer_id = $this->Auth->user('id');
            $admin_data = $this->Admin->find('first');
            $accept = $this->Acceptinterview->find('first', array('conditions' => array('Acceptinterview.freelancer_id' => $freelancer_id, 'Acceptinterview.job_id' => $job_id)));
            if (isset($_SESSION['term_id']) and !empty($_SESSION['term_id'])) {
                $terms_data = $this->Changeterm->find('first', array('conditions' => array('Changeterm.job_id' => $job_id, 'Changeterm.freelancer_id' => $freelancer_id, 'Changeterm.id' => $_SESSION['term_id'])));
                $this->set('terms', $terms_data);
            }
            $freelancer = $this->User->find('first', array('conditions' => array('User.id' => $freelancer_id)));
            $find_job = $this->Contect->find('first', array('conditions' => array('Contect.job_id' => $job_id)));
            $currentDate = time();
            $selected_date = strtotime($find_job['Contect']['created']);
            $diff = $currentDate - $selected_date;
            $date = $this->secondsToTime($diff);
            $text = $date['h'] . ' hours ' . $date['m'] . ' min ago';
            $j_id = $find_job['Contect']['job_id'];
            $c_id = $find_job['Contect']['client_id'];
            $Client_info = $this->User->find('first', array('conditions' => array('User.id' => $c_id)));
            $client_country_id = $Client_info['User']['country_id'];
            $Country = $this->Country->find('first', array('conditions' => array('Country.id' => $client_country_id)));
            $job = $this->Job->find('first', array('conditions' => array('Job.id' => $j_id)));
            $job_skills = explode(',', $job['Job']['skills']);
            $this->Subskill->recursive = -1;
            $Skills = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $job_skills)));
            $job_count = $this->Job->find('count', array('conditions' => array('Job.id' => $job_id, 'Job.user_id' => $job['Job']['user_id'])));
            $this->set('Job_count', $job_count);
            $hire_count = $this->Hire->find('count', array('conditions' => array('Hire.job_id' => $job_id, 'Hire.contractor_id' => $freelancer_id, 'Hire.hire_status' => 'Active', 'Hire.hiring_id' => $job['Job']['user_id'])));
            //  pr($hire_count); 
            $this->set('hire_count', $hire_count);
            $hire_data = $this->Hire->find('all', array('conditions' => array('Hire.hiring_id' => $job['Job']['user_id'], 'Hire.job_id' => $job_id, 'Hire.contractor_id' => $freelancer_id, 'Hire.hire_status' => 'Active')));
            $jobs_data = $this->Contect->find('all', array('conditions' => array('Contect.client_id' => $job['Job']['user_id'], 'Contect.job_id' => $job_id, 'Contect.user_id' => $freelancer_id)));
            $arr_data = array_merge($hire_data, $jobs_data);
            foreach ($arr_data as $k => $v) {
                if (array_key_exists('Hire', $v)) {
                    $client_id[] = $v['Hire']['hiring_id'];
                    $job_ids[] = $v['Hire']['job_id'];
                } else {
                    $client_id[] = $v['Contect']['client_id'];
                    $job_ids[] = $v['Contect']['job_id'];
                }
            }
            if (!empty($client_id) and !empty($job_ids)) {
                $jobs_count = $this->Job->find('count', array('conditions' => array('Job.id !=' => $job_ids, 'Job.user_id' => $client_id)));
//            pr($jobs_count);
//            die;
//            $jobs_count = $this->Job->find('count', array('conditions' => array('Job.id!=' => $job_ids, 'Job.user_id' => $client_id)));
                // pr($jobs_count); die;
                foreach ($client_id as $kk => $vv) {
                    $FeedbackToClient = $this->Projectfeedback->find('first', array('conditions' => array('Projectfeedback.client_id' => $vv, 'Projectfeedback.user_type' => 'freelancer', 'Projectfeedback.freelancer_id' => $freelancer_id)));

                    $ReviewsOfClient = $this->Projectfeedback->find('all', array('conditions' => array('Projectfeedback.freelancer_id' => $freelancer_id, 'Projectfeedback.client_id' => $vv, 'Projectfeedback.user_type' => 'freelancer')));

                    $Review_count = count($ReviewsOfClient);
                    $this->set('Feedback', $FeedbackToClient);
                    $this->set('Review', $Review_count);
                    $this->set('job_count', $jobs_count);
                }
            }
            $payment = $this->Paypalpayment->find('first', array('conditions' => array('Paypalpayment.job_id' => $job_id, 'Paypalpayment.freelancer_id' => $freelancer_id)));
            $this->set('payment', $payment);
            if ($this->request->is('post')) {
                $reply = nl2br($this->request->data['Message']['reply']);
                $this->request->data['Message']['reply'] = $reply;
                $this->request->data['Message']['sender'] = $freelancer_id;
                $this->request->data['Message']['reciever'] = $c_id;
                $this->request->data['Message']['job_id'] = $job_id;
                $this->request->data['Message']['status'] = 1;
                $this->request->data['Message']['read_status'] = 0;
                $this->set($this->request->data);
                $data = $this->request->data;
                if ($this->Message->save($this->request->data)) {
                    $Email = new CakeEmail();
                    $Email->template('reply_messages');
                    $Email->emailFormat('html');
                    $Email->viewVars(array('data' => $job['Job']['job_title'], 'free_fname' => $freelancer['User']['first_name'], 'free_lname' => $freelancer['User']['last_name'], 'Job_id' => $job['Job']['id'], 'message' => $data['Message']['reply']));
                    $Email->from(array('Jobider@pnf.com' => $freelancer['User']['first_name'] . ' ' . $freelancer['User']['last_name'] . ' via Jobider'));
                    $Email->to($Client_info['User']['email']);
                    $Email->subject($job['Job']['job_title'], 'success');
                    $Email->send();
                    $Email->template('reply_messages');
                    $Email->emailFormat('html');
                    $Email->viewVars(array('data' => $job['Job']['job_title'], 'free_fname' => $freelancer['User']['first_name'], 'free_lname' => $freelancer['User']['last_name'], 'Job_id' => $job['Job']['id'], 'message' => $data['Message']['reply']));
                    $Email->from(array('Jobider@pnf.com' => $freelancer['User']['first_name'] . ' ' . $freelancer['User']['last_name'] . ' via Jobider'));
                    $Email->to($admin_data['Admin']['email']);
                    $Email->subject($job['Job']['job_title'], 'success');
                    $Email->send();
                    $this->redirect(array('controller' => 'freelancer', 'action' => 'job_application', $job_id));
                }
            }
            $all_message = $this->Message->find('all', array('conditions' => array('AND' => array('Message.sender' => array($freelancer_id, $c_id), 'Message.reciever' => array($c_id, $freelancer_id), 'Message.job_id' => $j_id))));
            $terms = $this->Changeterm->find('all', array('conditions' => array('Changeterm.job_id' => $job_id, 'Changeterm.freelancer_id' => $freelancer_id), 'order' => 'Changeterm.id ASC'));
            $all_data = array_merge($all_message, $terms);

            foreach ($all_data as $kk => $vv) {
                if (array_key_exists('Message', $vv)) {
                    $sender = $vv['Message']['sender'];
                }
                if (array_key_exists('Changeterm', $vv)) {
                    $sender = $vv['Changeterm']['freelancer_id'];
                }
                $all_users = $this->User->find('all', array('conditions' => array('User.id' => $sender)));
                $all_data[$kk]['users'] = $all_users;
            }
//        pr($all_message);
//        die('sjdgasd');
            $this->set('Job_detail', $job);
            $this->set('Contect_info', $find_job);
            $this->set('Subskill', $Skills);
            $this->set('Client_info', $Client_info);
            $this->set('Country', $Country);
            $this->set('TimeDuration', $text);
            $this->set('Messages', $all_data);
            $this->set('Accept_values', $accept);
        } else {
            $this->redirect('/login');
        }
    }

    public function ajax_notify() {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->autoRender = false;
            $this->loadModel('Notification');
            $this->loadModel('Job');
            $this->loadModel('User');
            $user_id = $this->Auth->user('id');
            $status = $this->Notification->find('first', array('conditions' => array('Notification.id' => $_POST['id'], 'Notification.reciever_id' => $user_id)));
            $jobs = $this->Job->find('first', array('conditions' => array('Job.user_id' => $status['Notification']['sender_id'])));
            $user = $this->User->find('first', array('conditions' => array('User.id' => $status['Notification']['sender_id'])));
            //$url = $status['Notification']['url'];
            if ($status['Notification']['status'] == '0') {
                $url = $status['Notification']['url'];
            } else {
                $url = BASE_URL . '/freelancer/job_application/' . $jobs['Job']['id'];
            }
            $this->request->data['Notification']['url'] = $url;
            $this->request->data['Notification']['status'] = 1;
            $this->Notification->id = $_POST['id'];
            $this->set($this->request->data);
            if ($this->Notification->save($this->request->data)) {
                //$this->Session->write('notify_id',$_POST['id']);
                $arr['suc'] = 'yes';
                $arr['url'] = $url;
            }
            echo json_encode($arr);
        } else {
            $this->redirect('/login');
        }
    }

    public function ajax_mesg() {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->autoRender = false;
            $this->loadModel('User');
            $this->loadModel('Message');
            $user_id = $_POST['user_id'];
            //pr($user_id);
            $message = $this->Message->find('all', array('conditions' => array('Message.sender' => $user_id)));
            //pr($message);
            $url = 'http://jobider.com/freelancer/single_message/' . $user_id;
            foreach ($message as $kk => $vv) {
                $this->request->data['Message']['read_status'] = 1;
                $this->Message->id = $vv['Message']['id'];
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

    public function job_applicants($jobs_id = NULL) {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->autoRender = false;
            $this->loadModel('Changeterm');
            $this->loadModel('Message');
            $this->loadModel('Job');
            $this->loadModel('User');
            $this->loadModel('Admin');
            $freelancer_id = $this->Auth->user('id');
            $admin_data = $this->Admin->find('first');
            $freelancer = $this->User->find('first', array('conditions' => array('User.id' => $freelancer_id)));
            $job_data = $this->Job->find('first', array('conditions' => array('Job.id' => $jobs_id)));
            $client_id = $job_data['Job']['user_id'];
            $Client_info = $this->User->find('first', array('conditions' => array('User.id' => $client_id)));
            $data = $this->request->data;
            if ($this->request->is('post')) {
                $data = $this->request->data;
                $this->request->data['Changeterm']['freelancer_id'] = $freelancer_id;
                $this->request->data['Changeterm']['client_id'] = $client_id;
                $this->request->data['Changeterm']['job_id'] = $jobs_id;
                $this->set($this->request->data);
                if ($this->Changeterm->save($this->request->data)) {
                    $term_id = $this->Changeterm->getLastInsertId();
                    $this->Session->write('term_id', $term_id);
                    $Email = new CakeEmail();
                    $Email->template('reply_messages');
                    $Email->emailFormat('html');
                    $Email->viewVars(array('data' => $job_data['Job']['job_title'], 'free_fname' => $freelancer['User']['first_name'], 'free_lname' => $freelancer['User']['last_name'], 'Job_id' => $job_data['Job']['id'], 'message' => $data['Acceptinterview']['message']));
                    $Email->from(array('Jobider@pnf.com' => $freelancer['User']['first_name'] . ' ' . $freelancer['User']['last_name'] . ' via Jobider'));
                    $Email->to($Client_info['User']['email']);
                    $Email->subject($job_data['Job']['job_title'], 'success');
                    $Email->send();
                    $Email->template('reply_messages');
                    $Email->emailFormat('html');
                    $Email->viewVars(array('data' => $job_data['Job']['job_title'], 'free_fname' => $freelancer['User']['first_name'], 'free_lname' => $freelancer['User']['last_name'], 'Job_id' => $job_data['Job']['id'], 'message' => $data['Acceptinterview']['message']));
                    $Email->from(array('Jobider@pnf.com' => $freelancer['User']['first_name'] . ' ' . $freelancer['User']['last_name'] . ' via Jobider'));
                    $Email->to($admin_data['Admin']['email']);
                    $Email->subject($job_data['Job']['job_title'], 'success');
                    $Email->send();
                    $this->redirect(array('controller' => 'freelancer', 'action' => 'job_application', $jobs_id));
                }
            }
        } else {
            $this->redirect('/login');
        }
    }

    public function add_skills() {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'ajax_language';
            $this->loadModel('Skill');
            $this->loadModel('Subskill');
            $skills = $this->Skill->find('all');
            //pr($skills);
            $this->set('skill_data', $skills);
        } else {
            $this->redirect('/login');
        }
    }

    public function save_skills() {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->autoRender = false;
            $this->loadModel('Dataskill');
            $this->loadModel('Subskill');
            $user_id = $this->Auth->user('id');
            $data = $_POST['data'];
            if (!empty($data)) {
                //$skls=array_unique();
                $skill_id = implode(',', $data['Dataskill']['skill_id']);
                $subskill_id = implode(',', $data['Dataskill']['subskill_id']);
                $this->request->data['Dataskill']['skill_id'] = $skill_id;
                $this->request->data['Dataskill']['subskill_id'] = $subskill_id;
            }
            $this->request->data['Dataskill']['user_id'] = $user_id;
            $this->set($this->request->data);
            if ($this->Dataskill->save($this->request->data)) {
                $id = $this->Dataskill->getLastInsertId();
                $dats = $this->Dataskill->find('first', array('conditions' => array('Dataskill.id' => $id, 'Dataskill.user_id' => $user_id)));
                $subskill = explode(',', $dats['Dataskill']['subskill_id']);
                $skill_value = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $subskill)));
                $skill_name = array();
                foreach ($skill_value as $k => $vv) {
                    $skill_name[] = $vv['Subskill']['skill_name'];
                }
                $skill_data = implode(',', $skill_name);

                $res['suc'] = 'y';
                $res['skill_data'] = $skill_data;
                echo json_encode($res);
                die;
            }
        } else {
            $this->redirect('/login');
        }
    }

    public function edit_skills() {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'ajax_language';
            $this->loadModel('Dataskill');
            $this->loadModel('Skill');
            $this->loadModel('Subskill');
            $user_id = $this->Auth->user('id');
            $skills = $this->Skill->find('all');
            $this->set('skill_data', $skills);
            $data = $this->Dataskill->find('first', array('conditions' => array('Dataskill.user_id' => $user_id)));
            $skills_data = explode(',', $data['Dataskill']['subskill_id']);
            $subskill = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $skills_data)));

            $this->set('subskill', $subskill);
        } else {
            $this->redirect('/login');
        }
    }

    public function save_editskills() {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->autoRender = false;
            $this->loadModel('Dataskill');
            $this->loadModel('Subskill');
            $data = $_POST['data'];
            $user_id = $this->Auth->user('id');
            $data_skill = $this->Dataskill->find('first', array('conditions' => array('Dataskill.user_id' => $user_id)));
            if (!empty($data)) {
                ///$skl=  array_unique( );
                $skill_id = implode(',', $data['Dataskill']['skill_id']);
                $subskill_id = implode(',', $data['Dataskill']['subskill_id']);
                $this->request->data['Dataskill']['skill_id'] = $skill_id;
                $this->request->data['Dataskill']['subskill_id'] = $subskill_id;
            }
            $this->Dataskill->id = $data_skill['Dataskill']['id'];
            $this->set($this->request->data);
            if ($this->Dataskill->save($this->request->data)) {
                $data_value = $this->Dataskill->find('first', array('conditions' => array('Dataskill.user_id' => $user_id)));
                $skills = explode(',', $data_value['Dataskill']['subskill_id']);
                $subskills = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $skills)));
                $skill_name = array();
                foreach ($subskills as $k => $v) {
                    $skill_name[] = $v['Subskill']['skill_name'];
                }
                $skill_data = implode(',', $skill_name);
                $res['suc'] = 'yes';
                $res['skill_data'] = $skill_data;
                echo json_encode($res);
            }
        } else {
            $this->redirect('/login');
        }
    }

    public function add_category() {
        $this->layout = 'ajax_language';
        $this->loadModel('Category');
        $category = $this->Category->find('all');
        $this->set('category', $category);
    }

    public function save_category() {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->autoRender = false;
            $this->loadModel('Usercategory');
            $this->loadModel('Subcategory');
            $category = $_POST['data'];
            $user_id = $this->Auth->user('id');
            if (!empty($category)) {
                $category_id = implode(',', $category['Usercategory']['category_id']);
                $subcategory_id = implode(',', $category['Usercategory']['categories']);
                $this->request->data['Usercategory']['category_id'] = $category_id;
                $this->request->data['Usercategory']['categories'] = $subcategory_id;
            }
            $this->request->data['Usercategory']['user_id'] = $user_id;
            $this->set($this->request->data);
            if ($this->Usercategory->save($this->request->data)) {
                $id = $this->Usercategory->getLastInsertId();
                $categories = $this->Usercategory->find('first', array('conditions' => array('Usercategory.id' => $id, 'Usercategory.user_id' => $user_id)));
                $category_iid = explode(',', $categories['Usercategory']['categories']);
                $subcategory = $this->Subcategory->find('all', array('conditions' => array('Subcategory.id' => $category_iid)));
                $category_name = array();
                foreach ($subcategory as $k => $v) {
                    $category_name[] = $v['Subcategory']['category_name'];
                }
                $category_data = implode(',', $category_name);
                $res['suc'] = 'yes';
                $res['category'] = $category_data;
                echo json_encode($res);
            }
        } else {
            $this->redirect('/login');
        }
    }

    public function edit_category() {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'ajax_language';
            $this->loadModel('Category');
            $this->loadModel('Subcategory');
            $this->loadModel('Usercategory');
            $user_id = $this->Auth->user('id');
            $category = $this->Category->find('all');
            $data_category = $this->Usercategory->find('first', array('conditions' => array('Usercategory.user_id' => $user_id)));
            $categories = explode(',', $data_category['Usercategory']['categories']);
            $subcategory = $this->Subcategory->find('all', array('conditions' => array('Subcategory.id' => $categories)));
            $this->set('subcategory', $subcategory);
            $this->set('category', $category);
        } else {
            $this->redirect('/login');
        }
    }

    public function save_editcategory() {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->autoRender = false;
            $this->loadModel('Usercategory');
            $this->loadModel('Subcategory');
            $usr_id = $this->Auth->user('id');
            $dats_user = $this->Usercategory->find('first', array('conditions' => array('Usercategory.user_id' => $usr_id)));
            $data_category = $_POST['data'];
            if (!empty($data_category)) {
                $category_id = implode(',', $data_category['Usercategory']['category_id']);
                $subcategory_id = implode(',', $data_category['Usercategory']['categories']);
                $this->request->data['Usercategory']['category_id'] = $category_id;
                $this->request->data['Usercategory']['categories'] = $subcategory_id;
            }
            $this->Usercategory->id = $dats_user['Usercategory']['id'];
            $this->set($this->request->data);
            if ($this->Usercategory->save($this->request->data)) {
                $categories = $this->Usercategory->find('first', array('conditions' => array('Usercategory.user_id' => $usr_id)));
                $sub_data = explode(',', $categories['Usercategory']['categories']);
                $subcategory = $this->Subcategory->find('all', array('conditions' => array('Subcategory.id' => $sub_data)));
                $category_name = array();
                foreach ($subcategory as $k => $v) {
                    $category_name[] = $v['Subcategory']['category_name'];
                }
                $category_data = implode(',', $category_name);
                $res['suc'] = 'yes';
                $res['category'] = $category_data;
                echo json_encode($res);
            }
        } else {
            $this->redirect('/login');
        }
    }

    public function save_rate() {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->autoRender = false;
            $this->loadModel('Userbudget');
            $data = $_POST['data'];
            $user_id = $this->Auth->user('id');
            if (!empty($data)) {
                $this->request->data['Userbudget']['budget'] = $data['Userbudget']['budget'];
                $this->request->data['Userbudget']['fee'] = $data['Userbudget']['fee'];
                $this->request->data['Userbudget']['earn'] = $data['Userbudget']['earn'];
            }
            $this->request->data['Userbudget']['user_id'] = $user_id;
            $this->set($this->request->data);
            if ($this->Userbudget->save($this->request->data)) {
                $id = $this->Userbudget->getLastInsertId();
                $budget = $this->Userbudget->find('first', array('conditions' => array('Userbudget.id' => $id)));
                $budget_data = $budget['Userbudget']['budget'];
                $res['suc'] = 'yes';
                $res['budget'] = $budget_data;
                echo json_encode($res);
            }
        } else {
            $this->redirect('/login');
        }
    }

    public function add_rate() {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'ajax_language';
            $this->loadModel('Userbudget');
            $user_id = $this->Auth->user('id');
            $budget = $this->Userbudget->find('first', array('conditions' => array('Userbudget.user_id' => $user_id)));
            $this->set('budget', $budget);
        } else {
            $this->redirect('/login');
        }
    }

    public function save_editrate() {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->autoRender = false;
            $this->loadModel('Userbudget');
            $data = $_POST['data'];
            // pr($data);
            $user_id = $this->Auth->user('id');
            $budget_data = $this->Userbudget->find('first', array('conditions' => array('Userbudget.user_id' => $user_id)));
            if (!empty($data)) {
                $this->request->data['Userbudget']['budget'] = $data['Userbudget']['budget'];
                $this->request->data['Userbudget']['fee'] = $data['Userbudget']['fee'];
                $this->request->data['Userbudget']['earn'] = $data['Userbudget']['earn'];
            }
            $this->Userbudget->id = $budget_data['Userbudget']['id'];
            $this->set($this->request->data);
            if ($this->Userbudget->save($this->request->data)) {
                $budget = $this->Userbudget->find('first', array('conditions' => array('Userbudget.user_id' => $user_id)));
                $budget_name = $budget['Userbudget']['budget'];
                $res['suc'] = 'yes';
                $res['budget'] = $budget_name;
                echo json_encode($res);
            }
        } else {
            $this->redirect('/login');
        }
    }

    public function PPMassPayHttppost($methodName, $nvpstr) {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            // $setting = $this->globalsetting();
            // Set up your API credentials, PayPal end point, and API version.
//        $API_Password = urlencode('FYW4T3LV59JZRMR2');
//        $API_Username = urlencode('info_api1.tramaze.com');
//        $API_Signature = urlencode('AFcWxV21C7fd0v3bYYYRCpSSRl31ADacDmWHz.iySA-SFFjpZujtYJoe');

            $API_Username = urlencode('sanjivkumarpnf-facilitator_api1.gmail.com'); // set your spi username
            $API_Password = urlencode('PMWQSEFM4J98RJH4'); // set your spi password 
            $API_Signature = urlencode('AFcWxV21C7fd0v3bYYYRCpSSRl31AV236IM1svud2aue0AWrBXKnBU3B'); // set your 
            $API_Environment = "sandbox";
            $API_Endpoint = "https://api-3t.paypal.com/nvp";
            $API_Version = '116.0';
            if ('sandbox' === $API_Environment || 'beta-sandbox' === $API_Environment) {
                $API_Endpoint = "https://api-3t.$API_Environment.paypal.com/nvp";
            }
            $version = urlencode($API_Version);
            //set curl paramaeter
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $API_Endpoint);
            curl_setopt($ch, CURLOPT_VERBOSE, 1);
            //Turn of server and pakagemanager
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            //set the API operation,version,API signature in requrest
            $nvpreq = "METHOD=$methodName&VERSION=$version&PWD=$API_Password&USER=$API_Username&SIGNATURE=$API_Signature&$nvpstr";
            //set the request as POST field for curl
            curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);
            //get the response from server
            $httpResponse = curl_exec($ch);
            if (!$httpResponse) {
                exit("$methodName failed:" . curl_error($ch) . '(' . curl_errno($ch) . ')');
            }
            //Extract the response details
            $httpResponseArray = explode('&', $httpResponse);
            $httpParsedResponseArray = array();
            foreach ($httpResponseArray as $i => $value) {
                $tmpArray = explode('=', $value);
                if (sizeof($tmpArray) > 1) {
                    $httpParsedResponseArray[$tmpArray[0]] = $tmpArray[1];
                }
            }
            if ((0 == sizeof($httpParsedResponseArray)) || !array_key_exists('ACK', $httpParsedResponseArray)) {
                exit("Invalid HTTP Response for POST request($nvpreq) to $API_Endpoint.");
            }
            return $httpParsedResponseArray;
        } else {
            $this->redirect('/login');
        }
    }

    public function pay_all() {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->autoRender = FALSE;
            // Set request-specific fields.
            $vEmailSubject = 'payment';
            $emailSubject = urlencode($vEmailSubject);
            $receiverType = urlencode('EmailAddress');
            $currency = urlencode('USD'); // or other currency ('GBP', 'EUR', 'JPY', 'CAD', 'AUD')
// Receivers
// Use '0' for a single receiver. In order to add new ones: (0, 1, 2, 3...)
// Here you can modify to obtain array data from database.
// Add request-specific fields to the request string.
            $receiverEmail = urlencode('sanjivpnf1@gmail.com');
            $amount = urlencode('2');
            $uniqueID = urlencode('23');
            $note = urlencode('dshfkdsfg');
            $nvpStr = "&EMAILSUBJECT=$emailSubject&RECEIVERTYPE=$receiverType&CURRENCYCODE=$currency&L_EMAIL=$receiverEmail&L_Amt=$amount&L_UNIQUEID=$uniqueID&L_NOTE=$note";
            pr($nvpStr);
// Execute the API operation; see the PPHttpPost function above.
            $httpParsedResponseAr = $this->PPMassPayHttppost('MassPay', $nvpStr);
            pr($httpParsedResponseAr);
            die;
            if ("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) {
                echo 'MassPay Completed Successfully: ' . $httpParsedResponseAr;
            } else {
                echo '\nMassPay failed: ';
                echo '<pre>';
                print_r($httpParsedResponseAr);
            }
        } else {
            $this->redirect('/login');
        }
    }

    public function pay() {
        $this->autoRender = FALSE;
        // =============== Another // Set request-specific fields.
        $emailSubject = urlencode('payment');
        $receiverType = urlencode('EmailAddress');
        $currency = urlencode('USD');
        // or other currency ('GBP', 'EUR', 'JPY', 'CAD', 'AUD')
// Receivers
// Use '0' for a single receiver. In order to add new ones: (0, 1, 2, 3...)
// Here you can modify to obtain array data from database.
        $receivers = array(
            'receiverEmail' => "harpreetpnf@gmail.com",
            'amount' => "20.00",
            'uniqueID' => "124", // 13 chars max
            'note' => "Test Payment for 56567");
// I recommend use of space at beginning of string.
        $receiversLenght = count($receivers);
        // Add request-specific fields to the request string.
        $nvpStr = "&EMAILSUBJECT=$emailSubject&RECEIVERTYPE=$receiverType&CURRENCYCODE=$currency";
//           pr($nvpStr);
//           die;
//        $receiversArray = array();
//
//        for ($i = 0; $i < $receiversLenght; $i++) {
//            $receiversArray[$i] = $receivers[$i];
//        }
//        foreach ($receiversArray as $i => $receiverData) {
        $receiverEmail = urlencode('receiverEmail');
        $amount = urlencode('amount');
        $uniqueID = urlencode('uniqueID');
        $note = urlencode('note');
        $nvpStr .= "&L_EMAIL=$receiverEmail&L_Amt=$amount&L_UNIQUEID=$uniqueID&L_NOTE=$note";
//        }
        pr($nvpStr);

// Execute the API operation; see the PPHttpPost function above.
        $httpParsedResponseAr = $this->PPHttpPost('MassPay', $nvpStr);
        pr($httpParsedResponseAr);
        if ("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) {
            echo 'MassPay Completed Successfully: ' . $httpParsedResponseAr;
        } else {
            echo 'MassPay failed: ' . $httpParsedResponseAr;
        }
    }

    function PPHttpPost() {
        $methodName = 'MassPay';
        $vEmailSubject = 'Pagamento Paypal';
        $environment = 'sandbox';

        // Set up your API credentials, PayPal end point, and API version.
        // How to obtain API credentials:
        // https://cms.paypal.com/us/cgi-bin/?cmd=_render-content&content_ID=developer/e_howto_api_NVPAPIBasics#id084E30I30RO

        $API_UserName = urlencode('sanjivkumarpnf-facilitator_api1.gmail.com'); // set your spi username
        $API_Password = urlencode('PMWQSEFM4J98RJH4'); // set your spi $API_Password
        $API_Signature = urlencode('AFcWxV21C7fd0v3bYYYRCpSSRl31AV236IM1svud2aue0AWrBXKnBU3B');

        $API_Endpoint = "https://api-3t.paypal.com/nvp";
        if ("sandbox" === $environment || "beta-sandbox" === $environment) {
            $API_Endpoint = "https://api-3t.$environment.paypal.com/nvp";
        }
        $version = urlencode('51.0');

        // Set the curl parameters.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $API_Endpoint);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);

        // Turn off the server and peer verification (TrustManager Concept).
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);

        // Set the API operation, version, and API signature in the request.
        $nvpreq = "METHOD=$methodName&VERSION=$version&PWD=$API_Password&USER=$API_UserName&SIGNATURE=$API_Signature";
        pr($nvpreq);
        // Set the request as a POST FIELD for curl.
        curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);
        // Get response from the server.
        $httpResponse = curl_exec($ch);
        if (!$httpResponse) {
            echo $methodName_ . ' failed: ' . curl_error($ch) . '(' . curl_errno($ch) . ')';
        }

        // Extract the response details.
        $httpResponseAr = explode("&", $httpResponse);

        $httpParsedResponseAr = array();
        foreach ($httpResponseAr as $i => $value) {
            $tmpAr = explode("=", $value);
            if (sizeof($tmpAr) > 1) {
                $httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
            }
        }

        if ((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr)) {
            exit("Invalid HTTP Response for POST request($nvpreq) to $API_Endpoint.");
        }

        return $httpParsedResponseAr;
    }

    public function test() {
        $this->autoRender = false;
        $payLoad = array();
//prepare the receivers
        $receiverList = array();
        $counter = 0;
        $receiverList["receiver"][$counter]["amount"] = 100;
        $receiverList["receiver"][$counter]["email"] = urlencode('sanjivpnf1@gmail.com');
        $receiverList["receiver"][$counter]["paymentType"] = "SERVICE"; //this could be SERVICE or PERSONAL (which makes it free!)
        $receiverList["receiver"][$counter]["invoiceId"] = '12134jcd'; //NB that this MUST be unique otherwise paypal will reject it and get shitty. However it is a totally optional field
//prepare the call
        $payLoad["actionType"] = "PAY";
        $payLoad["cancelUrl"] = "http://www.example.com"; //this is required even though it isnt used
        $payLoad["returnUrl"] = "http://swaran.pnf-sites.info/latestcake/webadmin/blog/te"; //this is required even though it isnt used
        $payLoad["currencyCode"] = "EUR";
        $payLoad["receiverList"] = $receiverList;
        $payLoad["feesPayer"] = "EACHRECEIVER"; //this could be SENDER or EACHRECEIVER
//$payLoad["fundingConstraint"]=array("allowedFundingType"=>array("fundingTypeInfo"=>array("fundingType"=>"BALANCE")));//defaults to ECHECK but this takes ages and ages, so better to reject the payments if there isnt enough money in the account and then do a manual pull of bank funds through; more importantly, echecks have to be accepted/rejected by the user and i THINK balance doesnt
        $payLoad["sender"]["email"] = urlencode('swaranpnf-facilitator_api1.gmail.com');
        ; //the paypal email address of the where the money is coming from
//run the call
        $API_Endpoint = "https://svcs.sandbox.paypal.com/AdaptivePayments/Pay";
        $payLoad["requestEnvelope"] = array("errorLanguage" => urlencode("en_US"), "detailLevel" => urlencode("ReturnAll")); //add some debugging info the payLoad and setup the requestEnvelope
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $API_Endpoint);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'X-PAYPAL-REQUEST-DATA-FORMAT: JSON',
            'X-PAYPAL-RESPONSE-DATA-FORMAT: JSON',
            'X-PAYPAL-SECURITY-USERID: swaranpnf-facilitator_api1.gmail.com',
            'X-PAYPAL-SECURITY-PASSWORD: HKG8DA39MZT6NE6H',
            'X-PAYPAL-SECURITY-SIGNATURE:AFcWxV21C7fd0v3bYYYRCpSSRl31A.zMaqvQtzO6pUwL3pdFfnZavhoB',
            'X-PAYPAL-APPLICATION-ID: APP-80W284485P519543T'
        ));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payLoad)); //
        $response = curl_exec($ch);
        $response = json_decode($response, 1);
        echo "<pre>";
        print_r($response);
        die;

//analyse the output
        $payKey = $response["payKey"];
        $paymentExecStatus = $response["paymentExecStatus"];
        $correlationId = $response["responseEnvelope"]["correlationId"];
        $paymentInfoList = isset($response["paymentInfoList"]) ? $response["paymentInfoList"] : null;

        if ($paymentExecStatus <> "ERROR") {

            foreach ($paymentInfoList["paymentInfo"] as $paymentInfo) {//they will only be in this array if they had a paypal account
                $receiverEmail = $paymentInfo["receiver"]["email"];
                $receiverAmount = $paymentInfo["receiver"]["amount"];
                $withdrawalID = $paymentInfo["receiver"]["invoiceId"];
                $transactionId = $paymentInfo["transactionId"]; //what shows in their paypal account
                $senderTransactionId = $paymentInfo["senderTransactionId"]; //what shows in our paypal account
                $senderTransactionStatus = $paymentInfo["senderTransactionStatus"];
                $pendingReason = isset($paymentInfo["pendingReason"]) ? $paymentInfo["pendingReason"] : null;
            }
        } else {

        }
    }

    public function paymentStatus() {
        $this->autoRender = false;
        pr($_POST);
        die;
    }

    public function Response() {
        $this->autoRender = false;
        require("gate/PPBootStrap.php");
        $payRequest = new PayRequest();
        $receiver = array();
        $receiver[0] = new Receiver();
        $receiver[0]->amount = "5.00";
        $receiver[0]->email = "swaranpnf-buyer@gmail.com";
        $receiverList = new ReceiverList($receiver);
        $payRequest->receiverList = $receiverList;
        $payRequest->senderEmail = "sanjivkumarpnf-facilitator@gmail.com";
        $requestEnvelope = new RequestEnvelope("en_US");
        $payRequest->requestEnvelope = $requestEnvelope;
        $payRequest->actionType = "PAY";
        $payRequest->cancelUrl = "http://www.jobider.com/freelancer/paymentStatus?cancel=true";
        $payRequest->returnUrl = "http://www.jobider.com/freelancer/paymentStatus?success=true";
        $payRequest->currencyCode = "USD";
        $payRequest->ipnNotificationUrl = "http://replaceIpnUrl.com";
        $sdkConfig = array(
            "mode" => "sandbox",
            "acct1.UserName" => "sanjivkumarpnf-facilitator_api1.gmail.com",
            "acct1.Password" => "PMWQSEFM4J98RJH4",
            "acct1.Signature" => "AFcWxV21C7fd0v3bYYYRCpSSRl31AV236IM1svud2aue0AWrBXKnBU3B",
            "acct1.AppId" => "APP-80W284485P519543T"
        );
        $adaptivePaymentsService = new AdaptivePaymentsService($sdkConfig);
        $payResponse = $adaptivePaymentsService->Pay($payRequest);
        $requestEnvelope = new RequestEnvelope("en_US");
        $paymentDetailsRequest = new PaymentDetailsRequest($requestEnvelope);
        $paymentDetailsRequest->payKey = $payResponse->payKey;
        $adaptivePaymentsService = new AdaptivePaymentsService($sdkConfig);
        $paymentDetailsResponse = $adaptivePaymentsService->PaymentDetails($paymentDetailsRequest);

//        echo "<pre>";
//        pr($paymentDetailsResponse);
//        die;
    }

    public function paytest() {

        $this->autoRender = false;
        ini_set("track_errors", true);

//set PayPal Endpoint to sandbox
        $url = trim("https://svcs.sandbox.paypal.com/AdaptivePayments/Pay");

        $api_appid = 'APP-80W284485P519543T';   // para sandbox
//PayPal API Credentials
        $API_UserName = "swaranpnf-facilitator_api1.gmail.com"; //TODO
        $API_Password = "HKG8DA39MZT6NE6H"; //TODO
        $API_Signature = "AFcWxV21C7fd0v3bYYYRCpSSRl31A.zMaqvQtzO6pUwL3pdFfnZavhoB"; //TODO
        $receiver_email = "sanjivkumarpnf-facilitator@gmail.com"; //TODO
        $amount = 25; //TODO
//Default App ID for Sandbox    
        $API_AppID = "APP-80W284485P519543T";
        $API_RequestFormat = "NV";
        $API_ResponseFormat = "NV";
        //Create request payload with minimum required parameters
        $bodyparams = array("requestEnvelope.errorLanguage" => "en_US",
            "actionType" => "PAY",
            "cancelUrl" => "http://cancelUrl",
            "returnUrl" => "http://jobider.com/freelancer/Response",
            "currencyCode" => "USD",
            "receiverList.receiver.email" => $receiver_email,
            "receiverList.receiver.amount" => $amount
        );
//        pr($bodyparams);
// convert payload array into url encoded query string
        $body_data = http_build_query($bodyparams, "", chr(38));
//        pr($body_data);  die;
        try {
//create request and add headers
            $params = array("http" => array(
                    "method" => "POST",
                    "content" => $body_data,
                    "header" => "X-PAYPAL-SECURITY-USERID: " . $API_UserName . "\r\n" .
                    "X-PAYPAL-SECURITY-SIGNATURE: " . $API_Signature . "\r\n" .
                    "X-PAYPAL-SECURITY-PASSWORD: " . $API_Password . "\r\n" .
                    "X-PAYPAL-APPLICATION-ID: " . $API_AppID . "\r\n" .
                    "X-PAYPAL-REQUEST-DATA-FORMAT: " . $API_RequestFormat . "\r\n" .
                    "X-PAYPAL-RESPONSE-DATA-FORMAT: " . $API_ResponseFormat . "\r\n"
            ));
//               pr($params);
//create stream context
            $ctx = stream_context_create($params);
//            pr($params);
//            die;
//open the stream and send request
            $fp = @fopen($url, "r", false, $ctx);

//get response
            $response = stream_get_contents($fp);
// echo '<pre>';
//$Result= json_decode($response,true);
//check to see if stream is open
            if ($response === false) {
                throw new Exception("php error message = " . "$php_errormsg");
            }
//pr($response);die;
//close the stream
            fclose($fp);
//parse the ap key from the response
            $keyArray = explode("&", $response);
            foreach ($keyArray as $rVal) {
                list($qKey, $qVal) = explode("=", $rVal);
                $kArray[$qKey] = $qVal;
            }
//            pr($kArray);
//            die;
//print the response to screen for testing purposes
            If ($kArray["responseEnvelope.ack"] == "Success") {
                foreach ($kArray as $key => $value) {
                    echo $key . ": " . $value . "<br/>";
                }
                header('location:https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_ap-payment&paykey=' . $kArray['payKey']);
//                $requestEnvelope = new RequestEnvelope("en_US");
//                $paymentDetailsRequest = new PaymentDetailsRequest($requestEnvelope);
//                $paymentDetailsRequest->payKey = $kArray['payKey'];
//
//                $sdkConfig = array(
//                    "mode" => "sandbox",
//                    "acct1.UserName" => $API_UserName,
//                    "acct1.Password" => $API_Password,
//                    "acct1.Signature" => $API_Signature,
//                    "acct1.AppId" => $API_AppID);
//                $adaptivePaymentsService = new AdaptivePaymentsService($sdkConfig);
//                $paymentDetailsResponse = $adaptivePaymentsService->PaymentDetails($paymentDetailsRequest);
//                echo 'sdhjsa';
//                pr($paymentDetailsResponse);
//                die;
            } else {
                echo 'ERROR Code: ' . $kArray["error(0).errorId"] . " <br/>";
                echo 'ERROR Message: ' . urldecode($kArray["error(0).message"]) . " <br/>";
            }
        } catch (Exception $e) {
            echo "Message: ||" . $e->getMessage() . "||";
        }
    }

    public function ajax_changeStatus() {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->autoRender = false;
            $this->loadModel('Finalresult');
            $Finalresult = $this->Finalresult->find('first', array('conditions' => array('Finalresult.id' => $_POST['id'])));
            if ($Finalresult['Finalresult']['status'] == 0) {
                $this->request->data['Finalresult']['status'] = 1;
            } else {
                $this->request->data['Finalresult']['status'] = 0;
            }
            $this->Finalresult->id = $this->request->data['id'];
            $this->Finalresult->set($this->request->data);
            if ($this->Finalresult->save($this->request->data)) {
                echo json_encode(array('status' => 'true'));
            }
        } else {
            $this->redirect('/login');
        }
    }

    public function ajax_withdraw() {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->autoRender = false;
            $this->loadModel('Withdrawrequest');
            $this->loadModel('Admin');
            $this->loadModel('User');
            $this->loadModel('Milestone');
            $this->loadModel('Paypalpayment');
            $this->loadModel('Creditpayment');
            $this->loadModel('Admin');
            $this->loadModel('Job');
            $admin_data = $this->Admin->find('first');
            $Milestone = $this->Milestone->find('first', array('conditions' => array('Milestone.id' => $_POST['milestone_id'])));
            if (!empty($Milestone)) {
                $client = $this->User->find('first', array('conditions' => array('User.id' => $Milestone['Milestone']['client_id'])));
                $job = $this->Job->find('first', array('conditions' => array('Job.id' => $Milestone['Milestone']['job_id'])));
                if (!empty($_POST)) {
                    $this->request->data['Withdrawrequest']['user_id'] = $_SESSION['Auth']['User']['id'];
                    $this->request->data['Withdrawrequest']['client_id'] = $Milestone['Milestone']['client_id'];
                    $this->request->data['Withdrawrequest']['milestone_id'] = $_POST['milestone_id'];
                    $this->request->data['Withdrawrequest']['withdraw_amount'] = $_POST['withdraw_amount'];
                    $this->request->data['Withdrawrequest']['total_amount'] = $_POST['total_amount'];
                    $this->request->data['Withdrawrequest']['receiver_email'] = $_POST['email'];
                    $this->request->data['Withdrawrequest']['job_id'] = $job['Job']['id'];
                    if ($this->Withdrawrequest->save($this->request->data)) {
                        $notification['Notification']['sender_id'] = $_SESSION['Auth']['User']['id'];
                        $notification['Notification']['reciever_id'] = $Milestone['Milestone']['client_id'];
                        $notification['Notification']['status'] = 0;
                        $notification['Notification']['url'] = BASE_URL . '/client/WithdrawRequest/' . $_POST['milestone_id'];
                        $notification['Notification']['notification_msg'] = $Milestone['User']['first_name'] . ' ' . $Milestone['User']['last_name'] . ' requested for the payment.';
                        $this->Notification->save($notification, array('validate' => false));
                        $Email = new CakeEmail();
                        $Email->template('withdraw_request');
                        $Email->emailFormat('html');
                        $Email->viewVars(array('data' => $_POST, 'session' => $_SESSION['Auth'], 'admin' => $client));
                        $Email->from(array('Jobider@pnf.com' => ucfirst($_SESSION['Auth']['User']['first_name']) . ' ' . ucfirst($_SESSION['Auth']['User']['last_name']) . ' via Jobider'));
                        $Email->to($client['User']['email']);
                        $Email->subject('Withdraw Request');
                        $Email->send();
                        $Email->template('withdraw_request');
                        $Email->emailFormat('html');
                        $Email->viewVars(array('data' => $_POST, 'session' => $_SESSION['Auth'], 'admin' => $client));
                        $Email->from(array('Jobider@pnf.com' => ucfirst($_SESSION['Auth']['User']['first_name']) . ' ' . ucfirst($_SESSION['Auth']['User']['last_name']) . ' via Jobider'));
                        $Email->to($admin_data['Admin']['email']);
                        $Email->subject('Withdraw Request');
                        $Email->send();
                        echo json_encode(array('status' => 'true', 'message' => 'Your withdraw request has been sent.'));
                    }
                }
            }

            $paypal_data = $this->Paypalpayment->find('first', array('conditions' => array('Paypalpayment.id' => $_POST['milestone_id'])));
            $admin_data = $this->Admin->find('first');
//    pr($paypal_data);
//    die;
            if (!empty($paypal_data)) {
                $client = $this->User->find('first', array('conditions' => array('User.id' => $paypal_data['Paypalpayment']['client_id'])));
                $job = $this->Job->find('first', array('conditions' => array('JOb.id' => $paypal_data['Paypalpayment']['job_id'])));
                if (!empty($_POST)) {
                    $this->request->data['Withdrawrequest']['user_id'] = $paypal_data['Freelancer']['id'];
                    $this->request->data['Withdrawrequest']['client_id'] = $paypal_data['Client']['id'];
                    $this->request->data['Withdrawrequest']['milestone_id'] = $_POST['milestone_id'];
                    $this->request->data['Withdrawrequest']['withdraw_amount'] = $_POST['withdraw_amount'];
                    $this->request->data['Withdrawrequest']['total_amount'] = $_POST['total_amount'];
                    $this->request->data['Withdrawrequest']['receiver_email'] = $_POST['email'];
                    $this->request->data['Withdrawrequest']['job_id'] = $job['Job']['id'];
                    if ($this->Withdrawrequest->save($this->request->data)) {
                        $notification['Notification']['sender_id'] = $paypal_data['Freelancer']['id'];
                        $notification['Notification']['reciever_id'] = $paypal_data['Client']['id'];
                        $notification['Notification']['status'] = 0;
                        $notification['Notification']['url'] = BASE_URL . '/client/WithdrawRequest/' . $_POST['milestone_id'];
                        $notification['Notification']['notification_msg'] = $paypal_data['Freelancer']['first_name'] . ' ' . $paypal_data['Freelancer']['last_name'] . ' requested for the payment.';
                        $this->Notification->save($notification, array('validate' => false));
                        $Email = new CakeEmail();
                        $Email->template('withdraw_request');
                        $Email->emailFormat('html');
                        $Email->viewVars(array('data' => $_POST, 'session' => $_SESSION['Auth'], 'admin' => $client));
                        $Email->from(array('Jobider@pnf.com' => ucfirst($_SESSION['Auth']['User']['first_name']) . ' ' . ucfirst($_SESSION['Auth']['User']['last_name']) . ' via Jobider'));
                        $Email->to($paypal_data['Client']['email']);
                        $Email->subject('Withdraw Request');
                        $Email->send();
                        $Email->template('withdraw_request');
                        $Email->emailFormat('html');
                        $Email->viewVars(array('data' => $_POST, 'session' => $_SESSION['Auth'], 'admin' => $client));
                        $Email->from(array('Jobider@pnf.com' => ucfirst($_SESSION['Auth']['User']['first_name']) . ' ' . ucfirst($_SESSION['Auth']['User']['last_name']) . ' via Jobider'));
                        $Email->to($admin_data['Admin']['email']);
                        $Email->subject('Withdraw Request');
                        $Email->send();
                        echo json_encode(array('status' => 'true', 'message' => 'Your withdraw request has been sent.'));
                    }
                }
            }
            $credit_data = $this->Creditpayment->find('first', array('conditions' => array('Creditpayment.id' => $_POST['milestone_id'])));
            if (!empty($credit_data)) {
                $client = $this->User->find('first', array('conditions' => array('User.id' => $credit_data['Creditpayment']['client_id'])));
                $job = $this->Job->find('first', array('conditions' => array('Job.id' => $credit_data['Creditpayment']['job_id'])));
                if (!empty($_POST)) {
                    $this->request->data['Withdrawrequest']['user_id'] = $credit_data['Freelancer']['id'];
                    $this->request->data['Withdrawrequest']['client_id'] = $credit_data['Client']['id'];
                    $this->request->data['Withdrawrequest']['milestone_id'] = $_POST['milestone_id'];
                    $this->request->data['Withdrawrequest']['withdraw_amount'] = $_POST['withdraw_amount'];
                    $this->request->data['Withdrawrequest']['total_amount'] = $_POST['total_amount'];
                    $this->request->data['Withdrawrequest']['receiver_email'] = $_POST['email'];
                    $this->request->data['Withdrawrequest']['job_id'] = $job['Job']['id'];
                    if ($this->Withdrawrequest->save($this->request->data)) {
                        $notification['Notification']['sender_id'] = $credit_data['Freelancer']['id'];
                        $notification['Notification']['reciever_id'] = $credit_data['Client']['id'];
                        $notification['Notification']['status'] = 0;
                        $notification['Notification']['url'] = BASE_URL . '/client/WithdrawRequest/' . $_POST['milestone_id'];
                        $notification['Notification']['notification_msg'] = $credit_data['Freelancer']['first_name'] . ' ' . $credit_data['Freelancer']['last_name'] . ' requested for the payment.';
                        $this->Notification->save($notification, array('validate' => false));
                        $Email = new CakeEmail();
                        $Email->template('withdraw_request');
                        $Email->emailFormat('html');
                        $Email->viewVars(array('data' => $_POST, 'session' => $_SESSION['Auth'], 'admin' => $client));
                        $Email->from(array('Jobider@pnf.com' => ucfirst($_SESSION['Auth']['User']['first_name']) . ' ' . ucfirst($_SESSION['Auth']['User']['last_name']) . ' via Jobider'));
                        $Email->to($credit_data['Client']['email']);
                        $Email->subject('Withdraw Request');
                        $Email->send();
                        $Email->template('withdraw_request');
                        $Email->emailFormat('html');
                        $Email->viewVars(array('data' => $_POST, 'session' => $_SESSION['Auth'], 'admin' => $client));
                        $Email->from(array('Jobider@pnf.com' => ucfirst($_SESSION['Auth']['User']['first_name']) . ' ' . ucfirst($_SESSION['Auth']['User']['last_name']) . ' via Jobider'));
                        $Email->to($admin_data['Admin']['email']);
                        $Email->subject('Withdraw Request');
                        $Email->send();
                        echo json_encode(array('status' => 'true', 'message' => 'Your withdraw request has been sent.'));
                    }
                }
            }
        } else {
            $this->redirect('/login');
        }
    }

    public function myjobs($id = null) {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('Hire');
            $this->loadModel('User');
            $this->loadModel('Job');
            $this->loadModel('Paypalpayment');
            $this->loadModel('Withdrawearning');
            $this->loadModel('Creditpayment');
            $user_id = $this->Auth->user('id');
            $payment_detail = $this->Paypalpayment->find('all', array('conditions' => array('Paypalpayment.freelancer_id' => $user_id)));
            $credit_detail = $this->Creditpayment->find('all', array('conditions' => array('Creditpayment.freelancer_id' => $user_id)));
            $pay_value = array_merge($payment_detail, $credit_detail);
            if (!empty($pay_value)) {
                $pay_amount = array();
                foreach ($pay_value as $kk => $vv) {
                    if (array_key_exists('Paypalpayment', $vv)) {
                        $pay_amount[] = $vv['Paypalpayment']['payment_amount'];
                    }
                    if (array_key_exists('Creditpayment', $vv)) {
                        $pay_amount[] = $vv['Creditpayment']['amount'];
                    }
                }
                $pay_data = array_sum($pay_amount);
            }
            $withdraw = $this->Withdrawearning->find('all', array('conditions' => array('Withdrawearning.freelancer_id' => $user_id)));
            if (!empty($withdraw)) {
                $earning = array();
                foreach ($withdraw as $k => $v) {
                    $earning = $v['Withdrawearning']['reciever_amount'];
                }
                $receiver_amount = array_sum($earning);
            }
            if (!empty($receiver_amount)) {
                $pay_val = $pay_data - $receiver_amount;
            } elseif (!empty($pay_data)) {
                $pay_val = $pay_data;
            } else {
                $pay_val = 0;
            }
            $this->set('Payment_earning', $pay_val);
            if (!empty($id)) {
                $hire = $this->Hire->find('all', array('conditions' => array('Hire.contractor_id' => $user_id, 'Hire.hire_status' => 'Active', 'Hire.job_id' => $id)));
                $user = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
                if ($this->request->is('post')) {
                    $hire = $this->Hire->find('all', array('conditions' => array('Hire.job_title' => $this->request->data['Job']['search_contractor'], 'Hire.contractor_id' => $user_id, 'Hire.hire_status' => 'Active')));
                    //pr($hire);
                    $this->set('hire', $hire);
                }
                $this->set('user', $user);
                $this->set('hire', $hire);
            }
            if ($this->request->is('post')) {
                $hire = $this->Hire->find('all', array('conditions' => array('Hire.job_title' => $this->request->data['Job']['search_contractor'], 'Hire.contractor_id' => $user_id, 'Hire.hire_status' => 'Active')));
                //pr($hire);
                $this->set('hire', $hire);
            }
            $hire = $this->Hire->find('all', array('conditions' => array('Hire.contractor_id' => $user_id, 'Hire.hire_status' => 'Active')));
            $user = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
            $this->set('user', $user);
            $this->set('hire', $hire);
        } else {
            $this->redirect('/login');
        }
    }

    public function view_ended_contract() {
        $this->layout = 'front';
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->loadModel('Hire');
            $this->loadModel('Paypalpayment');
            $this->loadModel('Creditpayment');
            $this->loadModel('Withdrawearning');
            $freelancer_id = $this->Auth->user('id');
            $paypal_payment = $this->Paypalpayment->find('all', array('conditions' => array('Paypalpayment.freelancer_id' => $freelancer_id)));
            $credit_payment = $this->Creditpayment->find('all', array('conditions' => array('Creditpayment.freelancer_id' => $freelancer_id)));
            $Both_array_payment = array_merge($paypal_payment, $credit_payment);
            if (!empty($Both_array_payment)) {
                $pay_amount = array();
                foreach ($Both_array_payment as $kk => $vv) {
                    if (array_key_exists('Paypalpayment', $vv)) {
                        $pay_amount[] = $vv['Paypalpayment']['payment_amount'];
                    }
                    if (array_key_exists('Creditpayment', $vv)) {
                        $pay_amount[] = $vv['Creditpayment']['payment_amount'];
                    }
                }
                $total_paid_amount = array_sum($pay_amount);
            }
                $withdraw_earning_amount = $this->Withdrawearning->find('all', array('conditions' => array('Withdrawearning.freelancer_id' => $freelancer_id)));
                if (!empty($withdraw_earning_amount)) {
                    $earning = array();
                    foreach ($withdraw_earning_amount as $k => $v) {
                        $earning = $v['Withdrawearning']['reciever_amount'];
                    }
                    $receiver_amount = array_sum($earning);
                }

                if (!empty($receiver_amount)) {
                    $pay_val = $total_paid_amount - $receiver_amount;
                } elseif (!empty($total_paid_amount)) {
                    $pay_val = $total_paid_amount;
                } else {
                    $pay_val = 0;
                }
//                pr($pay_val);
//                die;
                $this->set('Payment_earning', $pay_val);
         
            $Closed_contracts = $this->Hire->find('all', array('conditions' => array('Hire.contractor_id' => $freelancer_id, 'Hire.hire_status' => 'closed')));
            $this->set('Ended_contracts', $Closed_contracts);
        } else {
            $this->redirect('/login');
        }
    }

    public function contracts($id = null) {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('Hire');
            $this->loadModel('Balancepayment');
            $this->loadModel('Milestone');
            $this->loadModel('Paypalpayment');
            $this->loadModel('Creditpayment');
            $freelancer_id = $this->Auth->user('id');
            $paypal_data = $this->Paypalpayment->find('first', array('conditions' => array('Paypalpayment.job_id' => $id, 'Paypalpayment.freelancer_id' => $freelancer_id)));
            //pr($paypal_data);
            if (!empty($paypal_data)) {
                $crnt_date = time();
                $selected = strtotime($paypal_data['Paypalpayment']['payment_date']);
                $diff = $crnt_date - $selected;
                $date = $this->secondsToTime($diff);
                if ($date['d'] > 0) {
                    $text = $date['d'] . ' days ' . 'ago';
                } else {
                    $text = $date['d'] . ' day ' . 'ago';
                }
                $this->set('tect', $text);
            }
            $this->set('paypal_data', $paypal_data);
            $credit_data = $this->Creditpayment->find('first', array('conditions' => array('Creditpayment.freelancer_id' => $freelancer_id, 'Creditpayment.job_id' => $id)));
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
            $this->set('credit_data', $credit_data);
            $hire = $this->Hire->find('first', array('conditions' => array('Hire.contractor_id' => $freelancer_id, 'Hire.job_id' => $id)));
            if (!empty($hire)) {
                $pay = explode(',', $hire['Hire']['payment']);
                $pay_data = array_sum($pay);
                $remain = $hire['Job']['budget'] - $pay_data;
                $this->set('pay', $pay_data);
                $this->set('remain', $remain);
            }
            $milestones = $this->Milestone->find('all', array('conditions' => array('Milestone.job_id' => $id, 'Milestone.freelancer_id' => $freelancer_id)));
            foreach ($milestones as $k => $v) {
                if ($v['Milestone']['payment_method'] == 'Credit_card') {
                    $credit = $this->Creditpayment->find('first', array('conditions' => array('Creditpayment.freelancer_id' => $freelancer_id, 'Creditpayment.job_id' => $id, 'Creditpayment.milestone_id' => $v['Milestone']['id'])));
                    if ($credit) {
                        $due_date = $credit['Creditpayment']['created'];
                        $crnt_date = time();
                        $selected = strtotime($due_date);
                        $diff = $crnt_date - $selected;
                        $date = $this->secondsToTime($diff);
                        if ($date['d'] > 0) {
                            $pay_text = $date['d'] . ' days ' . 'ago';
                        } else {
                            $pay_text = $date['d'] . ' day ' . 'ago';
                        }
                        $milestones[$k]['pay_date'] = $pay_text;
                    }
                } else {
                    $paypal = $this->Paypalpayment->find('first', array('conditions' => array('Paypalpayment.freelancer_id' => $freelancer_id, 'Paypalpayment.job_id' => $id, 'Paypalpayment.milestone_id' => $v['Milestone']['id'])));
                    if (!empty($paypal)) {
                        $due_date = $paypal['Paypalpayment']['payment_date'];
                        $crnt_date = time();
                        $selected = strtotime($due_date);
                        $diff = $crnt_date - $selected;
                        $date = $this->secondsToTime($diff);
                        if ($date['d'] > 0) {
                            $pay_text = $date['d'] . ' days ' . 'ago';
                        } else {
                            $pay_text = $date['d'] . ' day ' . 'ago';
                        }
                        $milestones[$k]['pay_date'] = $pay_text;
                    }
                }

                $hire_data = $this->Hire->find('first', array('conditions' => array('Hire.job_id' => $v['Milestone']['job_id'])));
                if (!empty($hire_data)) {
                    $milestones[$k]['hire_date'] = $hire_data['Hire']['created'];
                }
            }
            //pr($milestones); die; 
            $this->set('milestone', $milestones);
            $this->set('hire', $hire);
        } else {
            $this->redirect('/login');
        }
    }

    public function WithdrawRequest($id = NULL) {
        $this->layout = 'front';
    }

    public function activity($id = NULL) {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('Withdrawrequest');
            $request = $this->Withdrawrequest->find('first', array('conditions' => array('Withdrawrequest.id' => $id)));
            $this->set('request', $request);
        } else {
            $this->redirect('/login');
        }
    }

    public function freelancer_profile($job_id = Null) {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('Job');
            $this->loadModel('Projectfeedback');
            $this->loadModel('User');
            $this->loadModel('Subskill');
            $this->loadModel('Country');
            $this->loadModel('Finalresult');
            $this->loadModel('Result');
            $this->loadModel('Test');
            $this->loadModel('Hire');
            $user_id = $this->Auth->user('id');
            if (!empty($job_id)) {
                $jobs = $this->Job->find('first', array('conditions' => array('Job.id' => $job_id)));
                $project_feedback = $this->Projectfeedback->find('all', array('conditions' => array('Projectfeedback.job_id' => $job_id, 'Projectfeedback.freelancer_id' => $user_id, 'Projectfeedback.user_type' => 'client')));
                foreach ($project_feedback as $k => $v) {
                    $hire = $this->Hire->find('first', array('conditions' => array('Hire.job_id' => $v['Projectfeedback']['job_id'], 'Hire.contractor_id' => $user_id)));
                    $project_feedback[$k]['start_date'] = $hire['Hire']['created'];
                }
                $this->set('job', $jobs);
                $this->set('project_feedback', $project_feedback);
                $user = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
                $skills = explode(',', $user['User']['skills']);
                $country_id = $user['User']['country_id'];
                $subskill = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $skills)));
                $skill_data = $this->Subskill->find('all', array('limit' => 3, 'order' => 'Subskill.id DESC', 'conditions' => array('Subskill.id' => $skills)));
                $skil_name = array();
                foreach ($skill_data as $k => $v) {
                    $skil_name[] = $v['Subskill']['skill_name'];
                }
                $skill_name = implode(',', $skil_name);
                $this->set('skill_name', $skill_name);
                $country = $this->Country->find('first', array('conditions' => array('Country.id' => $country_id)));
                $final_result = $this->Finalresult->find('all', array('conditions' => array('Finalresult.user_id' => $user_id)));
                foreach ($final_result as $key => $val) {
                    $test_id = $val['Finalresult']['test_id'];
                    $test = $this->Test->find('all', array('conditions' => array('Test.id' => $test_id)));

                    $result = $this->Result->find('all', array('conditions' => array('Result.user_id' => $user_id, 'Result.test_id' => $test_id)));
                    $total_result = count($result);
                    $result_data = $this->Result->find('all', array('conditions' => array('Result.user_id' => $user_id, 'Result.test_id' => $test_id, 'Result.status' => '1')));
                    $right_ans = count($result_data);
                    $percent_data = $right_ans / $total_result * 100;
                    $final_result[$key]['percent'] = $percent_data;
                    $final_result[$key]['test'] = $test;
                }
                $total_jobs = $this->Hire->find('count', array('conditions' => array('Hire.contractor_id' => $user_id, 'Hire.hire_status' => 'closed', 'Hire.job_id' => $job_id)));
                $remain_job = $this->Hire->find('count', array('conditions' => array('Hire.contractor_id' => $user_id, 'Hire.hire_status' => 'Active')));
                $this->set('remain', $remain_job);
                $this->set('total', $total_jobs);
                $this->set('result', $final_result);
                $this->set('country', $country);
                $this->set('skills', $subskill);
                $this->set('user', $user);
            } else {
                $user = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
                $skills = explode(',', $user['User']['skills']);
                $country_id = $user['User']['country_id'];
                $subskill = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $skills)));
                $skill_data = $this->Subskill->find('all', array('limit' => 4, 'order' => 'Subskill.id DESC', 'conditions' => array('Subskill.id' => $skills)));
                $skil_name = array();
                foreach ($skill_data as $k => $v) {
                    $skil_name[] = $v['Subskill']['skill_name'];
                }
                $skill_name = implode(',', $skil_name);
                $this->set('skill_name', $skill_name);
                $country = $this->Country->find('first', array('conditions' => array('Country.id' => $country_id)));
                $final_result = $this->Finalresult->find('all', array('conditions' => array('Finalresult.user_id' => $user_id, 'Finalresult.percentile' => 'Passed')));
                foreach ($final_result as $key => $val) {
                    $test_id = $val['Finalresult']['test_id'];
                    $test = $this->Test->find('all', array('conditions' => array('Test.id' => $test_id)));

                    $result = $this->Result->find('all', array('conditions' => array('Result.user_id' => $user_id, 'Result.test_id' => $test_id)));
                    $total_result = count($result);
                    $result_data = $this->Result->find('all', array('conditions' => array('Result.user_id' => $user_id, 'Result.test_id' => $test_id, 'Result.status' => '1')));
                    $right_ans = count($result_data);
                    $percent_data = $right_ans / $total_result * 100;
                    $final_result[$key]['percent'] = $percent_data;
                    $final_result[$key]['test'] = $test;
                }
                $total_jobs = $this->Hire->find('count', array('conditions' => array('Hire.contractor_id' => $user_id, 'Hire.hire_status' => 'closed')));
                $remain_job = $this->Hire->find('count', array('conditions' => array('Hire.contractor_id' => $user_id, 'Hire.hire_status' => 'Active')));
                $this->set('remain', $remain_job);
                $this->set('total', $total_jobs);
                $project_feedback = $this->Projectfeedback->find('all', array('conditions' => array('Projectfeedback.freelancer_id' => $user_id, 'Projectfeedback.user_type' => 'client')));
                foreach ($project_feedback as $k => $v) {
                    $hire = $this->Hire->find('first', array('conditions' => array('Hire.job_id' => $v['Projectfeedback']['job_id'], 'Hire.contractor_id' => $user_id)));

                    if (!empty($hire)) {
                        $project_feedback[$k]['start_date'] = $hire['Hire']['created'];
                    }
                }
                $this->set('project_feedback', $project_feedback);
                $this->set('result', $final_result);
                $this->set('country', $country);
                $this->set('skills', $subskill);
                $this->set('user', $user);
            }
        } else {
            $this->redirect('/login');
        }
    }

    public function end_contract($job_id = null) {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('Job');
            $this->loadModel('Hire');
            $this->loadModel('Balancepayment');
            $this->loadModel('Milestone');
            $this->loadModel('Paypalpayment');
            $this->loadModel('Creditpayment');
            $this->loadModel('Projectfeedback');
            $freelancer_id = $this->Auth->user('id');
            $feedback = $this->Projectfeedback->find('first', array('conditions' => array('Projectfeedback.job_id' => $job_id, 'Projectfeedback.user_type' => 'freelancer')));
            $jobs = $this->Job->find('first', array('conditions' => array('Job.id' => $job_id)));
            $this->set('feedback', $feedback);
            $this->set('job', $jobs);
            $hire = $this->Hire->find('first', array('conditions' => array('Hire.contractor_id' => $freelancer_id, 'Hire.job_id' => $job_id)));
            if (!empty($hire)) {
                $pay = explode(',', $hire['Hire']['payment']);
                $pay_data = array_sum($pay);
                $remain = $hire['Job']['budget'] - $pay_data;
                $this->set('pay', $pay_data);
                $this->set('remain', $remain);
            }
            $milestones = $this->Milestone->find('all', array('conditions' => array('Milestone.job_id' => $job_id, 'Milestone.freelancer_id' => $freelancer_id)));
            foreach ($milestones as $k => $v) {
                if ($v['Milestone']['payment_method'] == 'Credit_card') {
                    $credit = $this->Creditpayment->find('first', array('conditions' => array('Creditpayment.freelancer_id' => $freelancer_id, 'Creditpayment.job_id' => $job_id, 'Creditpayment.milestone_id' => $v['Milestone']['id'])));
                    if (!empty($credit)) {
                        $due_date = $credit['Creditpayment']['created'];
                        $crnt_date = time();
                        $selected = strtotime($due_date);
                        $diff = $crnt_date - $selected;
                        $date = $this->secondsToTime($diff);
                        if ($date['d'] > 0) {
                            $pay_text = $date['d'] . ' days ' . 'ago';
                        } else {
                            $pay_text = $date['d'] . ' day ' . 'ago';
                        }
                        $milestones[$k]['pay_date'] = $pay_text;
                    }
                } else {
                    $paypal = $this->Paypalpayment->find('first', array('conditions' => array('Paypalpayment.freelancer_id' => $freelancer_id, 'Paypalpayment.job_id' => $job_id, 'Paypalpayment.milestone_id' => $v['Milestone']['id'])));
                    if (!empty($paypal)) {
                        $due_date = $paypal['Paypalpayment']['payment_date'];
                        $crnt_date = time();
                        $selected = strtotime($due_date);
                        $diff = $crnt_date - $selected;
                        $date = $this->secondsToTime($diff);
                        if ($date['d'] > 0) {
                            $pay_text = $date['d'] . ' days ' . 'ago';
                        } else {
                            $pay_text = $date['d'] . ' day ' . 'ago';
                        }
                        $milestones[$k]['pay_date'] = $pay_text;
                    }
                }

                $hire_data = $this->Hire->find('first', array('conditions' => array('Hire.job_id' => $v['Milestone']['job_id'])));
                $milestones[$k]['hire_date'] = $hire_data['Hire']['created'];
            }
            $this->set('milestone', $milestones);
            $this->set('hire', $hire);
            if ($this->request->is('post')) {
                $err = 0;
                if (empty($this->request->data['Projectfeedback']['score'])) {
                    $err = 1;
                    $msg[] = "Rate field is required.";
                }
                if (empty($this->request->data['Projectfeedback']['feedback'])) {
                    $err = 1;
                    $msg[] = "Feedback field is required.";
                }
                if ($err == 1) {
                    $this->set('error', $msg);
                } else {
                    $this->request->data['Projectfeedback']['job_id'] = $jobs['Job']['id'];
                    $this->request->data['Projectfeedback']['client_id'] = $jobs['Job']['user_id'];
                    $this->request->data['Projectfeedback']['freelancer_id'] = $this->Auth->user('id');
                    $this->request->data['Projectfeedback']['user_type'] = 'freelancer';
                    if ($this->Projectfeedback->save($this->request->data)) {
                        $this->Session->setFlash('Project Feedback sent to the Client.', 'success');
                    } else {
                        $this->Projectfeedback->validationErrors;
                    }
                }
            }
        } else {
            $this->redirect('/login');
        }
    }

    public function viewandedit_membershipPlans() {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('User');
            $this->loadModel('Membershipplan');
            $user_id = $this->Auth->user('id');
            $user = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
            $Membershipplan = $this->Membershipplan->find('first', array(
                'order' => array('Membershipplan.id' => 'desc'),
                'conditions' => array('Membershipplan.user_id' => $user_id)));
            $this->set('user', $user);
            if (!empty($Membershipplan)) {
                $time = strtotime($Membershipplan['Membershipplan']['created']);
                $final = date("Y-m-d", strtotime("+1 month", $time));
                $this->set('finaldate', $final);
            }
            if ($this->request->is('post')) {
                $paypal_id = "sanjivkumarpnf-facilitator@gmail.com "; // Sandbox Business email ID
                $paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscrr?rm=2&cmd=_xclick&business=' . $paypal_id . '&amount=5&currency_code=USD&item_name=Premium MemberShip&notify_url=' . BASE_URL . '/client/paypal_notify&return=' . BASE_URL . '/freelancer/payMembership';
                header('Location: ' . $paypal_url);
            }
        } else {
            $this->redirect('/login');
        }
    }

    public function payMembership() {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->autoRender = false;
            $this->loadModel('User');
            $this->loadModel('Membershipplan');
            $users = $this->User->find('first', array('conditions' => array('User.id' => $this->Auth->user('id'))));
            if (!empty($_POST)) {
                $final = date("Y-m-d", strtotime("+1 month", time()));
                $this->request->data['Membershipplan']['user_id'] = $this->Auth->user('id');
                $this->request->data['Membershipplan']['amount'] = $_POST['mc_gross'];
                $this->request->data['Membershipplan']['membership_type'] = 'individual';
                $this->request->data['Membershipplan']['connects'] = 60;
                $this->request->data['Membershipplan']['closed_time'] = $final;
                $user['User']['connects'] = 60;
                $user['User']['membership_type'] = 'premium';
                $user['User']['closed_time'] = $final;
                if ($this->Membershipplan->save($this->request->data, array('validate' => false))) {
                    $this->User->id = $this->Auth->user('id');
                    $this->User->save($user);
                }
                $this->Session->setFlash('Your Membership is upgraded to Premium Membership and you got 60 more connects.', 'success');
                $this->redirect(array('controller' => 'freelancer', 'action' => 'viewandedit_membershipPlans#individuals'));
            }
        } else {
            $this->redirect('/login');
        }
    }

    public function membershipforSmallAgency() {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->autoRender = false;
            $this->loadModel('User');
            $this->loadModel('Membershipplan');
            $users = $this->User->find('first', array('conditions' => array('User.id' => $this->Auth->user('id'))));

            if (empty($_POST)) {
                $paypal_id = "sanjivkumarpnf-facilitator@gmail.com "; // Sandbox Business email ID
                $paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscrr?rm=2&cmd=_xclick&business=' . $paypal_id . '&amount=15&currency_code=USD&item_name=Premium MemberShip for Small Agency&notify_url=' . BASE_URL . '/client/paypal_notify&return=' . BASE_URL . '/freelancer/membershipforSmallAgency';
                $this->redirect($paypal_url);
            } else {
                $final = date("Y-m-d", strtotime("+1 month", time()));
                $this->request->data['Membershipplan']['user_id'] = $this->Auth->user('id');
                $this->request->data['Membershipplan']['amount'] = $_POST['mc_gross'];
                $this->request->data['Membershipplan']['membership_type'] = 'premium_smallAgency';
                $this->request->data['Membershipplan']['connects'] = 70;
                $this->request->data['Membershipplan']['closed_time'] = $final;
                $user['User']['closed_time'] = $final;
                $user['User']['connects'] = 70;
                $user['User']['membership_type'] = 'premium_smallAgency';
                if ($this->Membershipplan->save($this->request->data, array('validate' => false))) {
                    $this->User->id = $this->Auth->user('id');
                    $this->User->save($user);
                }
                $this->Session->setFlash('Your Membership is upgraded and you got 70  connects for a month.', 'success');
                $this->redirect(array('controller' => 'freelancer', 'action' => 'viewandedit_membershipPlans#individual'));
            }
        } else {
            $this->redirect('/login');
        }
    }

    public function membershipforlargeAgency() {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->autoRender = false;
            $this->loadModel('User');
            $this->loadModel('Membershipplan');
            $users = $this->User->find('first', array('conditions' => array('User.id' => $this->Auth->user('id'))));
            if (empty($_POST)) {
                $paypal_id = "sanjivkumarpnf-facilitator@gmail.com ";
                // Sandbox Business email ID
                $paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscrr?rm=2&cmd=_xclick&business=' . $paypal_id . '&amount=40&currency_code=USD&item_name=Premium MemberShip for Large Agency&notify_url=' . BASE_URL . '/client/paypal_notify&return=' . BASE_URL . '/freelancer/membershipforlargeAgency';
                $this->redirect($paypal_url);
            } else {
                $final = date("Y-m-d", strtotime("+1 month", time()));
                $this->request->data['Membershipplan']['user_id'] = $this->Auth->user('id');
                $this->request->data['Membershipplan']['amount'] = $_POST['mc_gross'];
                $this->request->data['Membershipplan']['membership_type'] = 'premium_largeAgency';
                $this->request->data['Membershipplan']['connects'] = 70;
                $this->request->data['Membershipplan']['closed_time'] = $final;
                $user['User']['connects'] = 70;
                $user['User']['closed_time'] = $final;
                $user['User']['membership_type'] = 'premium_largeAgency';
                if ($this->Membershipplan->save($this->request->data, array('validate' => false))) {
                    $this->User->id = $this->Auth->user('id');
                    $this->User->save($user);
                }
                $this->Session->setFlash('Your Membership is upgraded and you can use 70 connects for a month.', 'success');
                $this->redirect(array('controller' => 'freelancer', 'action' => 'viewandedit_membershipPlans#individual'));
            }
        } else {
            $this->redirect('/login');
        }
    }

    public function addMembers() {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'front';
            $this->loadModel('User');
            $this->loadModel('Admin');
            $admin_data = $this->Admin->find('first');
            $this->User->set($this->request->data);
            if ($this->request->is('post')) {
                $password = $this->request->data['User']['password'];
                $this->request->data['User']['parent_id'] = $this->Auth->user('id');
                $this->request->data['User']['type'] = 'freelancer';
                $this->request->data['User']['employer_type'] = 'individual';
                $this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['password']);
                $this->request->data['User']['status'] = 1;
                if ($this->User->save($this->request->data)) {
                    $last_id = $this->User->getLastInsertId();
                    $company = $this->User->find('first', array('conditions' => array('User.id' => $this->Auth->user('id'))));
                    $users = $this->User->find('first', array('conditions' => array('User.id' => $last_id)));
                    $Email = new CakeEmail();
                    $Email->template('memberRegistration');
                    $Email->emailFormat('html');
                    $Email->viewVars(array('company' => $company, 'userdata' => $users, 'password' => $password));
                    $Email->from(array('jobider@pnf.com' => 'www.jobider.com'));
                    $Email->to($admin_data['Admin']['email']);
                    $Email->subject('Congratulations !  You are successfully registered.', 'success');
                    $Email->send();
                    $this->Session->setFlash('Team Member added successfully.', 'success');
                } else {
                    $this->User->validationErrors;
                }
            } else {
                $this->User->validationErrors;
            }
            $UserDetails = $this->User->find('first', array('conditions' => array('User.id' => $this->Auth->user('id'))));
            if (!empty($UserDetails) and $UserDetails['User']['membership_type'] == 'premium_smallAgency') {
                $completed_quota = $this->User->find('count', array('conditions' => array('User.parent_id' => $this->Auth->user('id'))));
                $this->set('completeQuota', $completed_quota);
                $this->set('membership', 'small');
            } elseif (!empty($UserDetails) and $UserDetails['User']['membership_type'] == 'premium_largeAgency') {
                $this->set('membership', 'large');
            } else {
                $this->set('membership', 'large');
            }
            $this->set('UserDetails', $UserDetails);
        } else {
            $this->redirect('/login');
        }
    }

    public function ajax_send() {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->layout = 'ajax';
            $this->loadModel('User');
            $this->loadModel('Contect');
            $this->loadModel('Job');
            $this->loadModel('Message');
            $user_id = $_POST['user_id'];
            $job_id = $_POST['job_id'];
            $freelancer_id = $this->Auth->user('id');
            $users = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
            $this->set('users', $users);
            $this->set('job', $job_id);
            $this->set('reciever', $freelancer_id);
        } else {
            $this->redirect('/login');
        }
    }

    public function send_message() {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->autoRender = false;
            $this->loadModel('Message');
            $this->loadModel('User');
            $this->loadModel('Job');
            $this->loadModel('Admin');
            $user_id = $this->Auth->user('id');
            $admin_data = $this->Admin->find('first');
            $users = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
            if ($this->request->is('post')) {
                //  pr($this->request->data); die;
                $reply = nl2br($this->request->data['Message']['reply']);
                $this->request->data['Message']['reply'] = $reply;
                $this->request->data['Message']['sender'] = $this->request->data['Message']['sender'];
                $this->request->data['Message']['job_id'] = $this->request->data['Message']['job_id'];
                $this->request->data['Message']['reciever'] = $this->request->data['Message']['reciever'];
                $this->request->data['Message']['read_status'] = 0;
                $this->request->data['Message']['status'] = 1;
                $this->set($this->request->data);
                $data = $this->request->data;
                $find_job = $this->Job->find('first', array('conditions' => array('Job.id' => $data['Message']['job_id'])));
                if ($this->Message->save($this->request->data)) {
                    $Email = new CakeEmail();
                    $Email->template('reply_message');
                    $Email->emailFormat('html');
                    $Email->viewVars(array('data' => $find_job['Job']['job_title'], 'client_fname' => $users['User']['first_name'], 'client_lname' => $users['User']['last_name'], 'Job_id' => $find_job['Job']['id'], 'message' => $data['Message']['reply']));
                    $Email->from(array('Jobider@pnf.com' => $users['User']['first_name'] . '' . $users['User']['last_name'] . 'via Jobider'));
                    $Email->to($users['User']['email']);
                    $Email->subject($find_job['Job']['job_title'], 'success');
                    $Email->send();
                    $Email->template('reply_message');
                    $Email->emailFormat('html');
                    $Email->viewVars(array('data' => $find_job['Job']['job_title'], 'client_fname' => $users['User']['first_name'], 'client_lname' => $users['User']['last_name'], 'Job_id' => $find_job['Job']['id'], 'message' => $data['Message']['reply']));
                    $Email->from(array('Jobider@pnf.com' => $users['User']['first_name'] . '' . $users['User']['last_name'] . 'via Jobider'));
                    $Email->to($admin_data['Admin']['email']);
                    $Email->subject($find_job['Job']['job_title'], 'success');
                    $Email->send();
                    $this->redirect(array('controller' => 'freelancer', 'action' => 'single_message', $this->request->data['Message']['reciever']));
                }
            }
        } else {
            $this->redirect('/login');
        }
    }

    public function change_terms($job_id = null) {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->AutoRender = false;
            $this->loadModel('Jobdetail');
            $this->loadModel('ChangeTerm');
            $this->loadModel('Notification');
            $this->loadModel('User');
            $freelancer_id = $this->Auth->user('id');
            $user = $this->User->find('first', array('conditions' => array('User.id' => $freelancer_id)));
            $jobs_data = $this->Jobdetail->find('first', array('conditions' => array('Jobdetail.job_id' => $job_id, 'Jobdetail.freelancer_id' => $freelancer_id)));
            if ($this->request->is('post')) {
                $this->request->data['ChangeTerm']['client_id'] = $jobs_data['Jobdetail']['client_id'];
                $this->request->data['ChangeTerm']['freelancer_id'] = $freelancer_id;
                $this->request->data['ChangeTerm']['job_id'] = $job_id;
                $notification['Notication']['reciever_id'] = $jobs_data['Jobdetail']['client_id'];
                $notification['Notication']['sender_id'] = $freelancer_id;
                $notification['Notication']['job_id'] = $job_id;
                $notification['Notication']['status'] = '0';
                $notification['Notication']['url'] = BASE_URL . '/client/view_details/' . $job_id;
                $notification['Notication']['notification_msg'] = $user['User']['first_name'] . ' ' . $user['User']['last_name'] . ' change the terms';
                $this->Notification->save($notification);
                if ($this->ChangeTerm->save($this->request->data)) {
                    $this->redirect('/freelancer/view_jobdetails/' . $job_id);
                }
            }
        } else {
            $this->redirect('/login');
        }
    }

    public function downloadfile($id = null) {
        if (isset($_SESSION['Auth']['User']['type']) and $_SESSION['Auth']['User']['type'] == 'freelancer') {
            $this->autoRender = false;
            $this->loadModel('Message');
            $message_val = $this->Message->find('first', array('conditions' => array('Message.id' => $id)));
            $file = WWW_ROOT . 'documents/' . $message_val['Message']['attach_data'];
            //header("Pragma: public");
            //header("Expires: 0");
            // header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            //header("Cache-Control: public", false);
            //header("Content-Description: File Transfer");
            header('Content-Type: application/doc');
            //header("Accept-Ranges: bytes");
            header("Content-Disposition: attachment; filename=\"" . $message_val['Message']['attach_data'] . "\";");
            //header("Content-Transfer-Encoding: binary");
            readfile($file);
        } else {
            $this->redirect('/login');
        }
    }

    public function view_connect_history($user_id = null) {
        $this->layout = 'front';
        $this->loadModel('User');
        $this->loadModel('Jobdetail');
        $this->User->recursive = -1;
        $this->paginate = array(
            'limit' => 4,
            'conditions' => array(
                'User.id' => $user_id
            )
        );
        $user_data = $this->paginate('User');
        $this->paginate = array(
            'limit' => 4,
            'conditions' => array(
                'Jobdetail.freelancer_id' => $user_id
            ),
            'order' => 'Jobdetail.id DESC'
        );
        $job_detail = $this->paginate('Jobdetail');
        foreach ($job_detail as $key => $val) {
            $client_data = $this->User->find('first', array('conditions' => array('User.id' => $val['Jobdetail']['client_id'])));
            $job_detail[$key]['client'] = $client_data;
        }
        $this->set('user_data', $user_data);
        $this->set('job_detail', $job_detail);
    }

}
