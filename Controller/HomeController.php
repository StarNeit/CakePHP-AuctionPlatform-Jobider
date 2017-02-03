<?php

class HomeController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('index', 'subategory_popup', 'freelancer_category', 'searchbycategory', 'top3_developer', 'viewprofile', 'browseprofile', 'ajax_data', 'search_data', 'read_more', 'findjobbycategory', 'findfreelancer', 'jobdetail', 'find_jobsby_category', 'top3_developer1234', 'findclient'));
    }

    /* Home Index Function */
    /* Manage Home Page Content */

    public function webadmin_homecontent($id = null) {
        $this->layout = 'admin_main';
        $this->loadModel('Homecontent');
        $Home = $this->Homecontent->find('first', array('conditions' => array('Homecontent.id' => $id)));
        $this->set('result', $Home);
        if (empty($this->request->data)) {
            $this->request->data = $this->Homecontent->read();
        } else {
            $this->Homecontent->id = $id;
            $this->set($this->request->data);
            if ($this->Homecontent->save($this->request->data)) {
                $this->Session->setFlash('Content Detail Updated Successfully', 'success');
                $this->redirect(array('controller' => 'home', 'action' => 'homecontent/1'));
            }
        }
    }

    public function webadmin_Client_recources($id = null) {
        $this->layout = 'admin_main';
        $this->loadModel('Clientrecource');
        $Home = $this->Clientrecource->find('first', array('conditions' => array('Clientrecource.id' => $id)));
        $this->set('result', $Home);
        if (empty($this->request->data)) {
            $this->request->data = $this->Clientrecource->read();
        } else {
            $this->Clientrecource->id = $id;
//            pr($this->request->data);
//            die;
            $this->set($this->request->data);
            if ($this->Clientrecource->save($this->request->data)) {
                $this->Session->setFlash('Content Detail Updated Successfully', 'success');
                $this->redirect(array('controller' => 'home', 'action' => 'Client_recources/1'));
            }
        }
    }

    /* End Section */

    public function index() {
        $this->layout = 'front';
        $this->set('title_for_layout', 'Job-bidder');
        $this->loadModel('User');
        $this->loadModel('Category');
        $this->loadModel('Banner');
        $this->loadModel('Homecontent');
        $this->Category->recursive = -1;
        $all_category = $this->Category->find('all', array('limit' => 8));
        $this->set('category', $all_category);
        $home_content = $this->Homecontent->find('first', array('conditions' => array('Homecontent.id' => 1)));
        $this->set('HomeContent', $home_content);
        $session = $this->Session->read();
        if (isset($session['Auth']['User']['type']) && $session['Auth']['User']['type'] == 'freelancer') {
            $this->redirect('/freelancer');
        }
        if (isset($session['Auth']['User']['type']) && $session['Auth']['User']['type'] == 'client') {
            $this->redirect('/client');
        }
        $banner = $this->Banner->find('all', array('limit' => 4));
        $this->set('home_content', $banner);
    }

    /* Home Search By Category Function */

    public function searchbycategory() {
        $this->layout = 'front';
        $this->loadModel('Skill');
        $this->loadModel('Category');
        $this->loadModel('Subcategory');
        $this->loadModel('Subskill');
        $this->loadModel('Country');
        $this->loadModel('User');
        if (!empty($this->request->data['User']['search']) and $this->request->data['User']['search'] == 'web development' or $this->request->data['User']['search'] == 'php') {
            $Search_freelancer = $this->User->find('all', array('conditions' => array('User.type' => 'freelancer')));
            foreach ($Search_freelancer as $key => $val) {
                $category = explode(',', $val['User']['categories']);
                if (in_array($this->request->data['User']['search'], $category)) {
                    $ids[] = $val['User']['id'];
                }
            }
            $this->set('freelancer', $Search_freelancer);
        } else {
            $this->redirect(array('controller' => 'home', 'action' => 'index'));
        }
        $country_data = $this->Country->find('list', array('conditions' => array('Country.status' => 1), 'fields' => array('Country.name')));
        $category_data = $this->Category->find('list', array('conditions' => array('Category.status' => 1), 'fields' => array('Category.name')));
        $Subcategory_data = $this->Subcategory->find('list', array('conditions' => array('Subcategory.status' => 1), 'fields' => array('Subcategory.category_name')));
        $Skills = $this->Skill->find('list', array('conditions' => array('Skill.status' => 1), 'fields' => array('Skill.name')));
        $Sub_skills = $this->Subskill->find('list', array('conditions' => array('Subskill.skill_id' => 8), 'fields' => array('Subskill.skill_name')));
        $Search_freelancer = $this->User->find('all', array('conditions' => array('User.type' => 'freelancer')));
        $this->set('subdata', $Sub_skills);
        $this->set('categories', $category_data);
        $this->set('subcategories', $Subcategory_data);
        $this->set('skill', $Skills);
        $this->set('country', $country_data);
        $this->set('freelancer', $Search_freelancer);
    }

    /* Home Subcategory Popup Function */

    public function subategory_popup() {
        //pr($_POST); die;
        //$this->autoRender=false;
        $this->layout = 'popup_model';
        $this->loadModel('Subcategory');
        $this->loadModel('Category');
        $category_id = $_POST['category_id'];
        $category_data = $this->Category->find('first', array('conditions' => array('Category.id' => $category_id)));
        $this->set('category', $category_data);
        $subcategory_data = $this->Subcategory->find('all', array('conditions' => array('Subcategory.category_id' => $category_id)));
        $this->set('subcategory', $subcategory_data);
    }

    /* Home Top3 Developer Function   */

    public function top3_developer1234($id) {
        $this->autoRender = false;
        $this->loadModel('User');
        $this->loadModel('Subskill');
        $this->loadModel('Category');
        $this->loadModel('Subcategory');
        $this->Subcategory->recursive = -1;
        $subcategory = $this->Subcategory->find('all', array('conditions' => array('Subcategory.category_id' => $id)));
        $users = $this->User->find('all', array('conditions' => array('User.type' => 'freelancer')));
        foreach ($users as $key => $value) {
            $category = explode(',', $value['User']['categories']);
            foreach ($category as $k => $v) {
                foreach ($subcategory as $kk => $vv) {
                    if ($vv['Subcategory']['id'] == $v) {
                        $subcategory_id[] = $value['User']['id'];
                    }
                }
            }
        }
        $res = array_unique($subcategory_id);
        $user_val = $this->User->find('all', array('conditions' => array('User.id' => $res)));
    }

    public function top3_developer($id) {
        $this->layout = 'front';
        $this->loadModel('User');
        $this->loadModel('Category');
        $this->loadModel('Subcategory');
        $this->loadModel('Subskill');
        $this->loadModel('User');
        $this->loadModel('Skill');
        $this->loadModel('Projectfeedback');
        $this->Subskill->recursive = -1;
       
        $category = $this->Category->find('first', array('conditions' => array('Category.id' => $id)));
        
               $this->set('category', $category);
        $subcategory = $this->Subcategory->find('all', array('conditions' => array('Subcategory.category_id' => $id)));
      
        $users = $this->User->find('all', array('limit' => '3', 'conditions' => array('User.type' => 'freelancer')));
        $subcategory_id = array();
        foreach ($users as $key => $value) {
            $category = explode(',', $value['User']['categories']);
            foreach ($category as $k => $v) {
                foreach ($subcategory as $kk => $vv) {
                    if ($vv['Subcategory']['id'] == $v) {
                        $subcategory_id[] = $value['User']['id'];
                    }
                }
            }
        }
        $res = array_unique($subcategory_id);
        $user_val = $this->User->find('all', array('conditions' => array('User.id' => $res)));
        foreach ($user_val as $key => $val) {
            $usersid = $val['User']['id'];
            $skill_id = explode(',', $val['User']['skills']);
            $skills = $this->Subskill->find('all', array('limit' => '5', 'conditions' => array('Subskill.id' => $skill_id)));
            $project_feedback = $this->Projectfeedback->find('first', array('conditions' => array('Projectfeedback.user_type' => 'client', 'Projectfeedback.freelancer_id' => $usersid)));
            $user_val[$key]['User']['skill_name'] = $skills;
            $user_val[$key]['User']['feedback'] = $project_feedback;
        } 
//        pr($user_val);
//        die;
        $this->set('users', $user_val);
    }

    /* Home View Profile Function public */

    public function viewprofile($user_id) {
        $this->layout = 'front';
        $this->loadModel('User');
        $this->loadModel('Subskill');
        $this->loadModel('Country');
        $this->loadModel('Finalresult');
        $this->loadModel('Result');
        $this->loadModel('Hire');
        $this->loadModel('Projectfeedback');
        $users = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
        $Projectfeedback = $this->Projectfeedback->find('all', array('conditions' => array('Projectfeedback.user_type' => 'client', 'Projectfeedback.freelancer_id' => $user_id), 'order' => array('Projectfeedback.id desc')));
        if (!empty($Projectfeedback)) {
            foreach ($Projectfeedback as $k => $v) {
                $hire_new = $this->Hire->find('first', array('conditions' => array('Hire.contractor_id' => $v['Projectfeedback']['freelancer_id'], 'Hire.job_id' => $v['Projectfeedback']['job_id'])));
                if (!empty($hire_new)) {
                    $Projectfeedback[$k]['Projectfeedback']['start'] = $hire_new['Hire']['created'];
                }
            }
        }
//        pr($Projectfeedback);
//        die('sdjasdhkasd');
        $tasks_takenBy_freelancer = $this->Finalresult->find('all', array('conditions' => array('Finalresult.user_id' => $user_id)));
        foreach ($tasks_takenBy_freelancer as $keyy => $vall) {
            $tests_ids = $vall['Finalresult']['test_id'];
            $all_Tests = $this->Test->find('all', array('conditions' => array('Test.id' => $tests_ids)));
            $Result = $this->Result->find('all', array('conditions' => array('Result.user_id' => $user_id, 'Result.test_id' => $tests_ids)));
            $answers = count($Result);
            $actual_result = $this->Result->find('all', array('conditions' => array('Result.user_id' => $user_id, 'Result.test_id' => $tests_ids, 'Result.status' => '1')));
            $Right_answers = count($actual_result);
            $percentage = $Right_answers / $answers * 100;
            $Percent = number_format($percentage);
            $tasks_takenBy_freelancer[$keyy]['Percentage'] = $percentage;
            $tasks_takenBy_freelancer[$keyy]['Test'] = $all_Tests;
        }
        $this->set('users', $users);
        $kills_id = explode(',', $users['User']['skills']);
        $country_id = $users['User']['country_id'];
        $subskill = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $kills_id)));
        $limited_skills = $this->Subskill->find('all', array('limit' => '3', 'conditions' => array('Subskill.id' => $kills_id)));
        $ltd_skills = $this->Subskill->find('list', array('limit' => '5', 'conditions' => array('Subskill.id' => $kills_id), 'fields' => array('Subskill.skill_name')));
        $this->set('LessSkill', $ltd_skills);
        $skillname = array();
        foreach ($limited_skills as $key => $val) {
            $skillname[] = $val['Subskill']['skill_name'];
        }
        $skillname_1 = implode(',', $skillname);
        $this->set('subskill', $subskill);
        $country_name = $this->Country->find('first', array('conditions' => array('Country.id' => $country_id)));
        $jobs_completed = $this->Hire->find('count', array('conditions' => array('Hire.contractor_id' => $user_id, 'Hire.hire_status' => 'closed')));
        $In_process_jobs = $this->Hire->find('count', array('conditions' => array('Hire.contractor_id' => $user_id, 'Hire.hire_status' => 'Active')));
//        pr($In_process_jobs);
//        die('asjdbhjsad');

        $this->set('country_name', $country_name);
        $this->set('Tasks_Taken', $tasks_takenBy_freelancer);
        $this->set('skills_name', $skillname_1);
        $this->set('Projectfeedback', $Projectfeedback);
        $this->set('total', $jobs_completed);
        $this->set('remain', $In_process_jobs);
    }

    /* Home Browse Profile Function */

    public function browseprofile() {
        $this->layout = 'front';
        $this->loadModel('User');
        $this->loadModel('Skill');
        $this->loadModel('Finalresult');
        $this->loadModel('Subskill');
        $this->loadModel('Country');
        $this->loadModel('Projectfeedback');
        $this->paginate = array('limit' => 3, 'conditions' => array('User.type' => 'freelancer'), 'order' => 'User.id Asc');
        $Freelancers = $this->paginate('User');
        foreach ($Freelancers as $key => $val) {
            $userids = $val['User']['id'];
            $userSkills = explode(',', $val['User']['skills']);
            $country_id = $val['User']['country_id'];
            $Skills = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $userSkills)));
            $User_country = $this->Country->find('first', array('conditions' => array('Country.id' => $country_id)));
            $Feedback_freelancer = $this->Projectfeedback->find('first', array('conditions' => array('Projectfeedback.user_type' => 'client', 'Projectfeedback.freelancer_id' => $userids)));
            $All_tests = $this->Finalresult->find('all', array('conditions' => array('Finalresult.user_id' => $userids)));
            $test_count = count($All_tests);
            foreach ($All_tests as $kk => $vv) {
                $currentDate = time();
                $selectedDate = strtotime($vv['Finalresult']['created']);
                $diff = $currentDate - $selectedDate;
                $date = $this->secondsToTime($diff);
                $text = $date['d'] . ' days ago';
            }
            $Freelancers[$key]['User']['skills'] = $Skills;
            $Freelancers[$key]['User']['country'] = $User_country;
            $Freelancers[$key]['User']['tests'] = $test_count;
            $Freelancers[$key]['User']['feedback'] = $Feedback_freelancer;
            if (!empty($text)) {
                $Freelancers[$key]['User']['timeduration'] = $text;
            }
        }
        if (!empty($this->request->data)) {
            if (!empty($this->request->data['User']['search_content'])) {
                $user = explode(' ', $this->request->data['User']['search_content']);
                foreach ($user as $k => $v) {
                    $conds['OR']['User.first_name LIKE'] = "%$v%";
                }
                foreach ($user as $k => $v) {
                    $conds['OR']['User.last_name LIKE'] = "%$v%";
                }

                $this->paginate = array('limit' => 5, 'conditions' => $conditions, 'order' => 'User.id DESC');
                $Freelancers = $this->paginate('User');
                foreach ($Freelancers as $key => $vall) {
                    $userids = $vall['User']['id'];
                    $userSkills = explode(',', $vall['User']['skills']);
                    $country_id = $vall['User']['country_id'];
                    $subskills = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $userSkills)));
                    $User_country = $this->Country->find('first', array('conditions' => array('Country.id' => $country_id)));
                    $Feedback_freelancer = $this->Projectfeedback->find('first', array('conditions' => array('Projectfeedback.user_type' => 'client', 'Projectfeedback.freelancer_id' => $userids)));
                    $All_tests = $this->Finalresult->find('all', array('conditions' => array('Finalresult.user_id' => $userids)));
                    $test_count = count($All_tests);
                    foreach ($All_tests as $kkk => $vvv) {
                        $currentDate = time();
                        $selectedDate = strtotime($vvv['Finalresult']['created']);
                        $diff = $currentDate - $selectedDate;
                        $date = $this->secondsToTime($diff);
                        $text = $date['d'] . ' days ago';
                    }
                    $Freelancers[$key]['User']['skills'] = $subskills;
                    $Freelancers[$key]['User']['country'] = $User_country;
                    $Freelancers[$key]['User']['tests'] = $test_count;
                    if (!empty($text)) {
                        $Freelancers[$key]['User']['timeduration'] = $text;
                    }
                    $Freelancers[$key]['User']['feedback'] = $Feedback_freelancer;
                }
                $this->set('Freelancer_user', $Freelancers);
            }
        }
        $this->set('Freelancer_user', $Freelancers);
    }

    /* Home Ajax Data Function */

    public function ajax_data() {
        $this->autoRender = false;
        $this->loadModel('Subcategory');
        $category_id = $_POST['category_id'];
        $subcategory = $this->Subcategory->find('all', array('conditions' => array('Subcategory.category_id' => $category_id)));
        if ($subcategory) {
            $test = '<option value="">Select The Subcategory</option>';
            foreach ($subcategory as $k => $v) {
                $test.='<option value="' . $v['Subcategory']['id'] . '">' . $v['Subcategory']['category_name'] . '</option>';
            }
            $arr['suc'] = 'yes';
            $arr['subcategory'] = $test;
            echo json_encode($arr);
        }
    }

    /* Home Search Data Function */

    public function search_data() {
        $this->autoRender = false;
        $this->loadModel('Subcategory');
        $this->loadModel('Country');
        $this->loadModel('User');
        $this->loadModel('Subskill');
        $category = $_POST['category_id'];
        $subcategory = $_POST['subcategory_id'];
        $country = $_POST['country_id'];
        $user_country = $this->Country->find('first', array('conditions' => array('Country.id' => $country)));
        if (!empty($country)) {
            $users_data = $this->User->find('all', array('conditions' => array('AND' => array('User.country_id' => $country, 'User.type' => 'freelancer'))));
            $count_data = count($users_data);
        } else {
            $user_skills = $this->User->find('all', array('conditions' => array('User.type' => 'freelancer')));
        }
        if (!empty($user_skills)) {
            foreach ($user_skills as $key => $val) {
                $category = explode(',', $val['User']['category_id']);
                $subskill = explode(',', $val['User']['categories']);
                if (in_array($_POST['category_id'], $category)) {
                    $id[] = $val['User']['id'];
                }
                if (!empty($_POST['subcategory_id'])) {
                    if (in_array($_POST['subcategory_id'], $subskill)) {
                        $id[] = $val['User']['id'];
                    }
                }
            }
        }
        if (!empty($id)) {
            $id = array_unique($id);
            $users_data = $this->User->find('all', array('conditions' => array('User.id' => $id)));
            $count_data = count($users_data);
        }
        if (!empty($users_data)) {
            $datas = '';
            foreach ($users_data as $k => $data) {
                $countryy_id = $data['User']['country_id'];
                $usr_skills = explode(',', $data['User']['skills']);
                $user_subskill = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $usr_skills)));
                $limited_skills = $this->Subskill->find('all', array('limit' => 3, 'conditions' => array('Subskill.id' => $usr_skills)));
                $sklname = array();
                foreach ($limited_skills as $kk => $vv) {
                    $sklname[] = $vv['Subskill']['skill_name'];
                }
                $skill_data1 = implode(',', $sklname);
                $user_country = $this->Country->find('first', array('conditions' => array('Country.id' => $countryy_id)));
                $datas .= '<div class="bg_white freelaners marg_btm30">
            <div class="green"><a href="' . $this->webroot . 'client/freelancer_profile/' . $data['User']['id'] . '" style="text-decoration:none;color: #fff;" class=makewhite>' . ucfirst($data['User']['first_name']) . '    ' . ucfirst($data['User']['last_name']) . '</a> <a href="' . $this->webroot . 'client/contract/' . $data['User']['id'] . '"><button class="btn-sm btn-danger btn_red11 pull-right marg_l20">Hire Me</button></a><span class="date pull-right"><i class="mrg_r5"><a href="' . $this->webroot . 'client/freelancer_profile/' . $data['User']['id'] . '" style="text-decoration:none;color:#fff;" class= "makewhite"><img alt="" src="' . $this->webroot . 'img/deatil.png"></i>' . $data['User']['job_title'] . '</a>(' . $skill_data1 . ')</span>
             <div class="clearfix"></div>  </div>
               <div class="col-md-2 col-sm-2 marg_tb15">
                 <a href="' . $this->webroot . 'client/freelancer_profile/' . $data['User']['id'] . '" style="text-decoration:none;color=#fff;" class="makewhite"><img class="img-thumbnail" alt=" " src="' . $this->webroot . 'uploads/' . $data['User']['image'] . '" height=auto width="100%"></a> </div>
               <div class="col-md-10 colsm-10 marg_tb15 lesval">
                <p>' . substr($data['User']['description'], 0, 100) . '.... 
                <a href="JavaScript:void(0);" class="more">more</a>
                </p>
               </div><div class="col-md-10 colsm-10 marg_tb15 moreval hide">
                <p>' . $data['User']['description'] . '.... 
                <a href="JavaScript:void(0);" class="less">less</a>
                </p>
               </div>
           <div class="clearfix"></div>
               <hr class="brder_btm1 marg_tb15">
               <div class="tabs_1 col-md-12">';
                foreach ($user_subskill as $k => $v) {
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
                $datas.='<i><img src="' . $this->webroot . 'img/location.png" alt=""></i><span class=" text_green">' . $user_country['Country']['name'] . '</span>';
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
            $arrs['suc'] = 'yes';
            $arrs['dataDiv'] = $datas;
            $arrs['count'] = $count_data;
        } else {
            $arrs['suc'] = 'No';
            $datasD = '<div class="bg_white freelaners marg_btm30">
      <div class="green">Search Results
             <div class="clearfix"></div>  </div>
              <div class="clearfix"></div>
               <p style="text-align:center;color:#DD5428; padding:76px; font-size:22px;"> No Record (s) Found !</p>
               <div class="tabs_1 col-md-12">
               </div>
                        <div class="clearfix"></div>
              <div class="clearfix"></div>
  </div>';
            $count = 0;
            $arrs['dataDivs'] = $datasD;
            $arrs['count'] = $count;
        }
        echo json_encode($arrs);
    }

    public function search_data123() {
        $this->autoRender = false;
        $this->loadModel('Subcategory');
        $this->loadModel('Country');
        $this->loadModel('User');
        $this->loadModel('Subskill');
        $category = $_POST['category_id'];
        $subcategory = $_POST['subcategory_id'];
        $country = $_POST['country_id'];
        if (!empty($country)) {
            $users_data = $this->User->find('all', array('conditions' => array('AND' => array('User.country_id' => $country, 'User.type' => 'freelancer'))));
        } else {
            $user_skills = $this->User->find('all', array('conditions' => array('User.type' => 'freelancer')));
        }
        $id = array();
        //	$ids	=	array();
        if (!empty($user_skills)) {
            foreach ($user_skills as $key => $value) {
                $category_value = explode(',', $value['User']['categories']);
                $category_val = explode(',', $value['User']['category_id']);
                if (in_array($category, $category_val)) {
                    $id[] = $value['User']['id'];
                }

                if (in_array($subcategory, $category_value)) {
                    $id[] = $value['User']['id'];
                }
            }
        }
        if (!empty($id)) {
            //	echo "category case";
            $id = array_unique($id);
            $this->paginate = array(
                'limit' => 4,
                'conditions' => array('User.type' => 'freelancer', 'User.id' => $id)
            );
            $users_data = $this->Paginate('User');
        }
        if (!empty($users_data)) {
            foreach ($users_data as $k => $data) {
                $datas = '<div class="bg_white freelaners marg_btm30">
            <div class="green">' . $data['User']['first_name'] . '    ' . $data['User']['last_name'] . ' <span class="date pull-right"><i class="mrg_r5"><img alt="" src="' . $this->webroot . 'img/deatil.png"></i>' . $data['User']['job_title'] . ' (Scala, Java, Hadoop)</span>
             <div class="clearfix"></div>  </div>
               <div class="col-md-2 col-sm-2 marg_tb15">
                 <img class="img-thumbnail" alt=" " src="' . $this->webroot . 'uploads/' . $data['User']['image'] . '" height=auto width="100%">
               </div>
               <div class="col-md-10 colsm-10 marg_tb15 lesval">
                <p>' . substr($data['User']['description'], 0, 300) . '.... 
                <a href="JavaScript:void(0);" class="more">more</a>
                </p>
               </div>
															<div class="col-md-10 colsm-10 marg_tb15 moreval hide">
                <p>' . $data['User']['description'] . '.... 
                <a href="JavaScript:void(0);" class="less">less</a>
                </p>
               </div>
           <div class="clearfix"></div>
               <hr class="brder_btm1 marg_tb15">
               <div class="tabs_1 col-md-12">
	<button class="btnskill" type="button"></button>
 </div>
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
                 
                 <div class="location pull-left">
                   
                   <i><img src="' . $this->webroot . 'img/location.png" alt=""></i><span class=" text_green"></span>
                   
                 </div>
                 
                 <div class="location pull-left">
                   
                   <i><img src="' . $this->webroot . 'img/check.png" alt=""></i><span class=" text_green">LAST ACTIVE Oct. 12 2014</span>
                   
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
        //	pr($datas);
        if (!empty($datas)) {
            //	die('exist');
            $arrs['suc'] = 'yes';
            $arrs['dataDiv'] = $datas;
//        $arr['dataPagi'] = $dataPagi;
        } else {
            //		die(' not exist');
            $arrs['suc'] = 'No';
            $datasD = '<div class="bg_white freelaners marg_btm30">
      <div class="green">Search Results
             <div class="clearfix"></div>  </div>
              <div class="clearfix"></div>
               <p style="text-align:center;color:#DD5428;"> No Record (s) Found !</p><hr class="brder_btm1 marg_tb15">
               <div class="tabs_1 col-md-12">
               </div>
                        <div class="clearfix"></div>
              <div class="clearfix"></div>
  </div>';
            $arrs['dataDivs'] = $datasD;
        }
        echo json_encode($arrs);
    }

    public function read_more($slug = null) {
        $this->layout = 'front';
        $this->loadModel('Banner');
        $this->loadModel('Homecontent');
        $read_content = $this->Banner->find('first', array('conditions' => array('Banner.name' => $slug)));
        $home_content = $this->Homecontent->find('first');
        $this->set('home_content', $home_content);
        $this->set('Result', $read_content);
    }

    public function findjobbycategory12() {
        $this->layout = 'front';
        $this->loadModel('Category');
        $this->loadModel('Subcategory');
        $this->loadModel('Job');
        $this->loadModel('User');
        $this->loadModel('Hire');
        $this->loadModel('Subskill');
        $this->loadModel('Paypalpayment');
        $this->loadModel('Creditpayment');
        $this->loadModel('Country');
        $this->loadModel('Projectfeedback');
        $this->loadModel('Finalresult');
        $this->loadModel('Test');
        $this->loadModel('Result');
        $session = $this->Session->read();
        if (!empty($session['search_content'])) {
            $category = $this->Job->find('first', array('conditions' => array('Job.job_title LIKE' => '%' . $session['search_content'] . '%')));
            if (!empty($category)) {
                $crnt_date = time();
                $selected = strtotime($category['Job']['created']);
                $diff = $crnt_date - $selected;
                $date = $this->secondsToTime($diff);
                if ($date['d'] == '0' and $date['h'] == '0') {
                    $text = 'Posted  ' . $date['s'] . ' seconds ago';
                } elseif ($date['h'] != '0' and $date['d'] == '0') {
                    $text = 'Posted ' . $date['h'] . ' hours ' . $date['s'] . ' seconds ago';
                } elseif ($date['h'] > 0) {
                    $text = 'Posted ' . $date['h'] . ' hours ago';
                } else {
                    $text = 'Posted ' . $date['s'] . ' seconds ago';
                }
                $category['Job']['time_duration'] = $text;
                $category_name = $this->Subcategory->find('first', array('conditions' => array('Subcategory.id' => $category['Job']['subcategory_id'])));
                $hire_data = $this->Hire->find('count', array('conditions' => array('Hire.hiring_id' => $category['Job']['user_id'])));
                $job_data = $this->Job->find('count', array('conditions' => array('Job.user_id' => $category['Job']['user_id'])));
                $hire = $this->Hire->find('all', array('conditions' => array('Hire.hiring_id' => $category['Job']['user_id'])));
                $job_id = array();
                foreach ($hire as $k => $v) {
                    $job_id[] = $v['Hire']['job_id'];
                }
                $open_jobs = $this->Job->find('count', array('conditions' => array('Job.id !=' => $job_id, 'Job.user_id' => $category['Job']['user_id'])));
                $payment = $this->Paypalpayment->find('all', array('conditions' => array('Paypalpayment.client_id' => $category['Job']['user_id'])));
                $credit = $this->Creditpayment->find('all', array('conditions' => array('Creditpayment.client_id' => $category['Job']['user_id'])));
                $pay_data = array_merge($payment, $credit);
                $pay_val = array();
                foreach ($pay_data as $k => $vv) {
                    if (array_key_exists('Paypalpayment', $vv)) {
                        $pay_val[] = $vv['Paypalpayment']['payment_amount'];
                    }
                    if (array_key_exists('Creditpayment', $vv)) {
                        $pay_val[] = $vv['Creditpayment']['amount'];
                    }
                }
                $user = $this->Country->find('first', array('conditions' => array('Country.id' => $category['User']['country_id'])));
                $skills = explode(',', $category['Job']['skills']);
                $subskill = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $skills)));
                $feedback = $this->Projectfeedback->find('first', array('conditions' => array('Projectfeedback.client_id' => $category['Job']['user_id'], 'Projectfeedback.user_type' => 'freelancer')));

                $this->set('feedback', $feedback);
                $this->set('skill', $subskill);
                $this->set('country_name', $user);
                $pay = array_sum($pay_val);
                $this->set('pay', $pay);
                $this->set('open_jobs', $open_jobs);
                $this->set('job_data', $job_data);
                $this->set('hire_data', $hire_data);
                $this->set('category_name', $category_name);
                $this->set('category', $category);
            }
            $user = explode(' ', $session['search_content']);
            foreach ($user as $k => $v) {
                $conds['OR']['User.first_name LIKE'] = "%$v%";
            }
            foreach ($user as $k => $v) {
                $conds['OR']['User.last_name LIKE'] = "%$v%";
            }
            $conditions = array($conds, 'User.type' => 'freelancer');
            $this->paginate = array('limit' => 4, 'conditions' => $conditions, 'order' => 'User.id DESC');
            $Freelancers = $this->paginate('User');
            //pr($Freelancers);
            if (!empty($Freelancers)) {
                foreach ($Freelancers as $key => $vall) {
                    $userids = $vall['User']['id'];
                    $userSkills = explode(',', $vall['User']['skills']);
                    $country_id = $vall['User']['country_id'];
                    $subskills = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $userSkills)));
                    $User_country = $this->Country->find('first', array('conditions' => array('Country.id' => $country_id)));
                    $Feedback_freelancer = $this->Projectfeedback->find('first', array('conditions' => array('Projectfeedback.user_type' => 'client', 'Projectfeedback.freelancer_id' => $userids)));
                    $All_tests = $this->Finalresult->find('all', array('conditions' => array('Finalresult.user_id' => $userids)));
                    $test_count = count($All_tests);
                    foreach ($All_tests as $kkk => $vvv) {
                        $currentDate = time();
                        $selectedDate = strtotime($vvv['Finalresult']['created']);
                        $diff = $currentDate - $selectedDate;
                        $date = $this->secondsToTime($diff);
                        $text = $date['d'] . ' days ago';
                    }
                    $Freelancers[$key]['User']['skills'] = $subskills;
                    $Freelancers[$key]['User']['country'] = $User_country;
                    $Freelancers[$key]['User']['tests'] = $test_count;
                    if (!empty($text)) {
                        $Freelancers[$key]['User']['timeduration'] = $text;
                    }
                    $Freelancers[$key]['User']['feedback'] = $Feedback_freelancer;
                }
                $this->set('user', $Freelancers);
            }
            $category_data = $this->Category->find('first', array('conditions' => array('Category.name LIKE' => '%' . $session['search_content'] . '%')));
            if (!empty($category_data)) {
                $category_id = $category_data['Category']['id'];
                $this->paginate = array('limit' => 5, 'conditions' => array('AND' => array('Job.category_id' => $category_id, 'Job.status' => 1)), 'order' => 'Job.id ASC');

                $this->Paginator->settings = $this->paginate;
                $job_valuess = $this->Paginator->paginate('Job');
                $job_values = $this->Job->find('all', array('conditions' => array('Job.category_id' => $category_id, 'Job.status' => 1)));
                $count_job = count($job_values);
                foreach ($job_valuess as $kk => $vv) {
                    $skills = explode(',', $vv['Job']['skills']);
                    $subskill = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $skills)));
                    $userId = $vv['Job']['user_id'];
                    $users = $this->User->find('first', array('conditions' => array('User.id' => $userId)));
                    $crnt_date = time();
                    $selected = strtotime($vv['Job']['created']);
                    $diff = $crnt_date - $selected;
                    $date = $this->secondsToTime($diff);
                    if ($date['d'] == '0' and $date['h'] == '0') {
                        $text = 'Posted  ' . $date['s'] . ' seconds ago';
                    } elseif ($date['h'] != '0' and $date['d'] == '0') {
                        $text = 'Posted ' . $date['h'] . ' hours ' . $date['s'] . ' seconds ago';
                    } elseif ($date['h'] > 0) {
                        $text = 'Posted ' . $date['h'] . ' hours ago';
                    } else {
                        $text = 'Posted ' . $date['s'] . ' seconds ago';
                    }
                    $job_valuess[$kk]['Job']['time_duration'] = $text;
                    $job_valuess[$kk]['Job']['skill_name'] = $subskill;
                    $job_valuess[$kk]['Job']['user_info'] = $users;
                }
                $this->set('count_job', $count_job);
                $cat_data = $this->Category->find('all', array('fields' => array('Category.name')));
                $this->Subcategory->recursive = -1;
                $Sub_category = $this->Subcategory->find('all', array('fields' => array('Subcategory.category_name'), 'conditions' => array('Subcategory.category_id' => $category_id)));
                $this->set('cat_data', $cat_data);
                $this->set('data_JobResult', $job_valuess);
                $this->set('sub_cat', $Sub_category);
                $this->set('category_data', $category_data);
                $category_val = $this->Category->find('all', array('fields' => array('Category.name')));
                $job_count = array();
                foreach ($category_val as $ke => $va) {
                    $job_count[$va['Category']['id']] = count($this->Job->find('all', array('conditions' => array('Job.category_id' => $va['Category']['id']))));
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
                $this->set('job_count', $job_count);
            }
        }
    }

    public function findjobbycategory() {
        $this->layout = 'front';
        $this->set('search_flag', 0);
        $this->loadModel('Category');
        $this->loadModel('Subcategory');
        $this->loadModel('Job');
        $this->loadModel('User');
        $this->loadModel('Subskill');
        $this->loadModel('Hire');
        $this->loadModel('Paypalpayment');
        $this->loadModel('Creditpayment');
        $this->loadModel('Projectfeedback');
        $this->loadModel('Test');
        $this->loadModel('Result');
        $this->loadModel('Finalresult');
        $this->loadModel('Country');
        $session = $this->Session->read();
        if (!empty($session['search_content'])) {
            $category = $this->Category->find('first', array('conditions' => array('Category.name LIKE' => '%' . $session['search_content'] . '%')));
            if (!empty($category)) {
                $category_id = $category['Category']['id'];
                $this->set('category', $category);
                $this->paginate = array('limit' => 5, 'conditions' => array('AND' => array('Job.category_id' => $category_id, 'Job.status' => 1)), 'order' => 'Job.id ASC');
                $job_value = $this->paginate('Job');
                $job_values = $this->Job->find('all', array('conditions' => array('Job.status' => $category_id)));
                $count_job = count($job_values);
                foreach ($job_value as $kk => $vv) {
                    $skills = explode(',', $vv['Job']['skills']);
                    $subskill = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $skills)));
                    $userId = $vv['Job']['user_id'];
                    $users = $this->User->find('first', array('conditions' => array('User.id' => $userId)));
                    $crnt_date = time();
                    $selected = strtotime($vv['Job']['created']);
                    $diff = $crnt_date - $selected;
                    $date = $this->secondsToTime($diff);
                    $text = 'Posted  ' . $date['h'] . ' hours ' . $date['m'] . ' Minutes ago ';
                    $job_value[$kk]['Job']['time_duration'] = $text;
                    $job_value[$kk]['Job']['skill_name'] = $subskill;
                    $job_value[$kk]['Job']['user_info'] = $users;
                }
                $this->set('count_job', $count_job);
                $cat_val = $this->Category->find('all', array('fields' => array('Category.name')));
                $job_counts = array();
                foreach ($cat_val as $kk => $vv) {
                    $job_counts[$vv['Category']['id']] = $this->Job->find('count', array('conditions' => array('Job.category_id' => $vv['Category']['id'])));
                }
                $this->set('Job_Count', $job_counts);
                $cat_data = $this->Category->find('all', array('fields' => array('Category.name')));
                $this->Subcategory->recursive = -1;
                $Sub_category = $this->Subcategory->find('all', array('fields' => array('Subcategory.category_name'), 'conditions' => array('Subcategory.category_id' => $category_id)));
                $this->set('cat_data', $cat_data);
                $this->set('job_data', $job_value);
                $this->set('sub_cat', $Sub_category);


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
            }
            $job_data = $this->Job->find('first', array('conditions' => array('Job.job_title LIKE' => '%' . $session['search_content'] . '%')));
            if (!empty($job_data)) {//search by title of job
                $crnt_date = time();
                $selected = strtotime($job_data['Job']['created']);
                $diff = $crnt_date - $selected;
                $date = $this->secondsToTime($diff);
                if ($date['d'] == '0' and $date['h'] == '0') {
                    $text = 'Posted  ' . $date['s'] . ' seconds ago';
                } elseif ($date['h'] != '0' and $date['d'] == '0') {
                    $text = 'Posted ' . $date['h'] . ' hours ' . $date['s'] . ' seconds ago';
                } elseif ($date['h'] > 0) {
                    $text = 'Posted ' . $date['h'] . ' hours ago';
                } else {
                    $text = 'Posted ' . $date['s'] . ' seconds ago';
                }
                $job_data['Job']['time_duration'] = $text;
                $category_name = $this->Subcategory->find('first', array('conditions' => array('Subcategory.id' => $job_data['Job']['subcategory_id'])));
                $hire_data = $this->Hire->find('count', array('conditions' => array('Hire.hiring_id' => $job_data['Job']['user_id'])));
                $jobs_data = $this->Job->find('count', array('conditions' => array('Job.user_id' => $job_data['Job']['user_id'])));
                $hire = $this->Hire->find('all', array('conditions' => array('Hire.hiring_id' => $job_data['Job']['user_id'])));
                $job_id = array();
                foreach ($hire as $k => $v) {
                    $job_id[] = $v['Hire']['job_id'];
                }
                $open_jobs = $this->Job->find('count', array('conditions' => array('Job.id !=' => $job_id, 'Job.user_id' => $job_data['Job']['user_id'])));
                $payment = $this->Paypalpayment->find('all', array('conditions' => array('Paypalpayment.client_id' => $job_data['Job']['user_id'])));
                $credit = $this->Creditpayment->find('all', array('conditions' => array('Creditpayment.client_id' => $job_data['Job']['user_id'])));
                $pay_data = array_merge($payment, $credit);
                $pay_val = array();
                foreach ($pay_data as $k => $vv) {
                    if (array_key_exists('Paypalpayment', $vv)) {
                        $pay_val[] = $vv['Paypalpayment']['payment_amount'];
                    }
                    if (array_key_exists('Creditpayment', $vv)) {
                        $pay_val[] = $vv['Creditpayment']['amount'];
                    }
                }
                $user = $this->Country->find('first', array('conditions' => array('Country.id' => $job_data['User']['country_id'])));
                $skills = explode(',', $job_data['Job']['skills']);
                $subskill = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $skills)));
                $feedback = $this->Projectfeedback->find('first', array('conditions' => array('Projectfeedback.client_id' => $job_data['Job']['user_id'], 'Projectfeedback.user_type' => 'freelancer')));
                $this->set('feedback', $feedback);
                $this->set('skill', $subskill);
                $this->set('country_name', $user);
                $pay = array_sum($pay_val);
                $this->set('pay', $pay);
                $this->set('open_jobs', $open_jobs);
                $this->set('job_data', $jobs_data);
                $this->set('hire_data', $hire_data);
                $this->set('category_name', $category_name);
                $this->set('job_datas', $job_data);
            }
            $user = explode(' ', $session['search_content']);
            foreach ($user as $k => $v) {
                $conds['OR']['User.first_name LIKE'] = "%$v%";
            }
            foreach ($user as $k => $v) {
                $conds['OR']['User.last_name LIKE'] = "%$v%";
            }
            $conditions = array($conds, 'User.type' => 'freelancer');
//            $this->paginate = array('limit' =>4, 'conditions' => $conditions, 'order' => 'User.id DESC');
//            $Freelancers =  $this->paginate('User');
            //pr($Freelancers);
            $Freelancers = $this->User->find('all', array('conditions' => $conditions, 'order' => 'User.id DESC'));
            if (!empty($Freelancers)) {
                foreach ($Freelancers as $key => $vall) {
                    $userids = $vall['User']['id'];
                    $userSkills = explode(',', $vall['User']['skills']);
                    $country_id = $vall['User']['country_id'];
                    $subskills = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $userSkills)));
                    $User_country = $this->Country->find('first', array('conditions' => array('Country.id' => $country_id)));
                    $Feedback_freelancer = $this->Projectfeedback->find('first', array('conditions' => array('Projectfeedback.user_type' => 'client', 'Projectfeedback.freelancer_id' => $userids)));
                    $All_tests = $this->Finalresult->find('all', array('conditions' => array('Finalresult.user_id' => $userids)));
                    $test_count = count($All_tests);
                    foreach ($All_tests as $kkk => $vvv) {
                        $currentDate = time();
                        $selectedDate = strtotime($vvv['Finalresult']['created']);
                        $diff = $currentDate - $selectedDate;
                        $date = $this->secondsToTime($diff);
                        $text = $date['d'] . ' days ago';
                    }
                    $Freelancers[$key]['User']['skills'] = $subskills;
                    $Freelancers[$key]['User']['country'] = $User_country;
                    $Freelancers[$key]['User']['tests'] = $test_count;
                    if (!empty($text)) {
                        $Freelancers[$key]['User']['timeduration'] = $text;
                    }
                    $Freelancers[$key]['User']['feedback'] = $Feedback_freelancer;
                }
//                pr($Freelancers);
//                die;
                $this->set('user', $Freelancers);
            }

            if ($session['search_content'] == 'job' or $session['search_content'] == 'jobs' or $session['search_content'] == 'Jobs' or $session['search_content'] == 'Job' or $session['search_content'] == 'JOB' or $session['search_content'] == 'JOBS') {
                $this->loadModel('Subcategory');
                $this->loadModel('Job');
                $this->loadModel('User');
                $this->loadModel('Category');
                $this->loadModel('Subskill');
                include 'timefunction.php';
                $this->paginate = array(
                    'limit' => 7,
                    'conditions' => array(
                        'Job.status' => '1',
                        'Job.description !=' => ''
                    ),
                    'order' => 'Job.id DESC'
                );
                $job_data = $this->paginate('Job');
                foreach ($job_data as $k => $v) {
                    $users_id = $v['Job']['user_id'];
                    $users = $this->User->find('first', array('conditions' => array('User.id' => $users_id)));
                    $end_date = $v['Job']['addedon'];
                    $current_date = time();
                    $current_time = time();
                    $diff = $current_date - $end_date;
                    $obj = secondsToTime($diff);
                    $actual_days = floor($diff / (60 * 60 * 24));
                    $actual_hours = floor($diff / (60 * 60));
                    $actual_minutes = floor(($diff - ($actual_days * 60 * 60 * 24) - ($actual_hours * 60 * 60)) / 60);
                    $job_data[$k]['Job']['users'] = $users;
                    $job_data[$k]['Job']['days'] = $obj['d'];
                    $job_data[$k]['Job']['hours'] = $obj['h'];
                    $job_data[$k]['Job']['minutes'] = $obj['m'];
                    $job_data[$k]['Job']['seconds'] = $obj['s'];
/////////////////////////////////
                    $skills = explode(',', $v['Job']['skills']);
                    $subskills = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $skills)));
                    $job_data[$k]['Job']['realskill'] = $subskills;
                }
                $count_job = $this->Job->find('count', array('conditions' => array('Job.status' => '1')));
                $this->set('job_data', $job_data);
                $this->set('count_job', $count_job);
                $category = $this->Category->find('all', array('fields' => array('Category.name')));
                $category_val = $this->Subcategory->find('all', array('fields' => array('Subcategory.category_name', 'Subcategory.id')));
                //pr($category); 
                $job_count = array();
                foreach ($category_val as $ke => $va) {
                    $job_count[$va['Subcategory']['id']] = count($this->Job->find('all', array('conditions' => array('Job.subcategory_id' => $va['Subcategory']['id']))));
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

                $this->set('category', $category);
                $this->set('job_count', $job_count);
                $subcategory = $this->Subcategory->find('all');
                $this->set('subcategory', $subcategory);
            }

//             if ($session['search_content'] == 'freelancer' or $session['search_content'] == 'freelancers' or $session['search_content'] == 'Freelancers' or $session['search_content'] == 'Freelancer' or $session['search_content'] == 'FREELANCER' or $session['search_content'] == 'FREELANCERS') {
//                 $this->loadModel('Skill');
//                 $this->loadModel('Subskill');
//                 $this->loadModel('User');
//                 $this->loadModel('Finalresult');
//                 $this->loadModel('Result');
//                 $this->loadModel('Test');
//                 $this->loadModel('Country');
//                 $this->loadModel('Projectfeedback');
//                 $this->paginate = array('limit' => 10, 'conditions' => array('User.status' => '1','User.type'=>'freelancer','User.description !='=>''));
//                 $Freelancers = $this->paginate('User');
//                 foreach ($Freelancers as $keey => $vall) {
//                     $userids = $vall['User']['id'];
//                     $userSkills = explode(',', $vall['User']['skills']);
//                     $userCountry = $vall['User']['country_id'];
//                     $subSkills = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $userSkills)));
//                     $Country = $this->Country->find('first', array('conditions' => array('Country.id' => $userCountry)));
//                     $feedbackFreelancer = $this->Projectfeedback->find('first', array('conditions' => array('Projectfeedback.freelancer_id' => $userids, 'Projectfeedback.user_type' => 'client')));
// //            pr($feedbackFreelancer);
//                     $All_tests = $this->Finalresult->find('all', array('conditions' => array('Finalresult.user_id' => $userids)));
//                     $test_count = count($All_tests);
//                     foreach ($All_tests as $kk => $vv) {
//                         $current_date = time();
//                         $selected = strtotime($vv['Finalresult']['created']);
//                         $diff = $current_date - $selected;
//                         $date = $this->secondsToTime($diff);
//                         $text = $date['d'] . '  days ago';
//                     }
//                     $Freelancers[$keey]['User']['Skills'] = $subSkills;
//                     $Freelancers[$keey]['User']['Country_name'] = $Country;
//                     $Freelancers[$keey]['User']['tests'] = $test_count;
//                     $Freelancers[$keey]['User']['feedback'] = $feedbackFreelancer;
//                     if (!empty($text)) {
//                         $Freelancers[$keey]['User']['test_timeduration'] = $text;
//                     }
//                 }
//                 if (!empty($this->request->data)) {
//                     if (!empty($this->request->data['User']['Search_freelancer'])) {
//                         $user = explode(' ', $this->request->data['User']['Search_freelancer']);
                                    
//                         foreach ($user as $k => $v) {
//                             $conds['OR']['User.first_name LIKE'] = "%$v%";
//                         }
//                         foreach ($user as $k => $v) {
//                             $conds['OR']['User.last_name LIKE'] = "%$v%";
//                         }
//                         $conditions = array($conds, 'User.description !=' => '', 'User.type' => 'freelancer');
//                         $this->paginate = array('limit' => 10, 'conditions' => $conditions);
//                         $Freelancers = $this->paginate('User');
//                         foreach ($Freelancers as $keey => $vall) {
//                             $userids = $vall['User']['id'];
//                             $userSkills = explode(',', $vall['User']['skills']);
//                             $userCountry = explode(',', $vall['User']['country_id']);
//                             $subSkills = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $userSkills)));
//                             $Country = $this->Country->find('first', array('conditions' => array('Country.id' => $userCountry)));
//                             $feedbackFreelancer = $this->Projectfeedback->find('first', array('conditions' => array('Projectfeedback.user_type' => 'client', 'Projectfeedback.freelancer_id' => $userids)));
//                             $All_tests = $this->Finalresult->find('all', array('conditions' => array('Finalresult.user_id' => $userids)));
//                             $test_count = count($All_tests);
//                             foreach ($All_tests as $kk => $vv) {
//                                 $current_date = time();
//                                 $selected = strtotime($vv['Finalresult']['created']);
//                                 $diff = $current_date - $selected;
//                                 $date = $this->secondsToTime($diff);
//                                 $text = $date['d'] . '  days ago';
//                             }
//                             $Freelancers[$keey]['User']['Skills'] = $subSkills;
//                             $Freelancers[$keey]['User']['Country_name'] = $Country;
//                             $Freelancers[$keey]['User']['tests'] = $test_count;
//                             $Freelancers[$keey]['User']['feedback'] = $feedbackFreelancer;
//                             if (!empty($text)) {
//                                 $Freelancers[$keey]['User']['test_timeduration'] = $text;
//                             }
//                         }
//                         $this->set('Freelancer_user', $Freelancers);
//                     }
//                 }
//                 $this->set('Freelancer_user', $Freelancers);
// //                $this->set('id', $id);
// //                $this->set('SkillName', $Sub_Skill);
//             }
        }
    }

    public function findclient()
    {
        $this->layout='front';
        $this->set('search_flag', 2);

    }

    public function findfreelancer()
    {
        $this->layout = 'front';
        $this->set('search_flag', 1);
        $session = $this->Session->read();
        //if (!empty($session['search_content'])) {
            //if ($session['search_content'] == 'freelancer' or $session['search_content'] == 'freelancers' or $session['search_content'] == 'Freelancers' or $session['search_content'] == 'Freelancer' or $session['search_content'] == 'FREELANCER' or $session['search_content'] == 'FREELANCERS') {
                    $this->loadModel('Skill');
                    $this->loadModel('Subskill');
                    $this->loadModel('User');
                    $this->loadModel('Finalresult');
                    $this->loadModel('Result');
                    $this->loadModel('Test');
                    $this->loadModel('Country');
                    $this->loadModel('Projectfeedback');
                    $this->paginate = array('limit' => 10, 'conditions' => array('User.status' => '1','User.type'=>'freelancer','User.description !='=>''));
                    $Freelancers = $this->paginate('User');
                    foreach ($Freelancers as $keey => $vall) {
                        $userids = $vall['User']['id'];
                        $userSkills = explode(',', $vall['User']['skills']);
                        $userCountry = $vall['User']['country_id'];
                        $subSkills = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $userSkills)));
                        $Country = $this->Country->find('first', array('conditions' => array('Country.id' => $userCountry)));
                        $feedbackFreelancer = $this->Projectfeedback->find('first', array('conditions' => array('Projectfeedback.freelancer_id' => $userids, 'Projectfeedback.user_type' => 'client')));
    //            pr($feedbackFreelancer);
                        $All_tests = $this->Finalresult->find('all', array('conditions' => array('Finalresult.user_id' => $userids)));
                        $test_count = count($All_tests);
                        foreach ($All_tests as $kk => $vv) {
                            $current_date = time();
                            $selected = strtotime($vv['Finalresult']['created']);
                            $diff = $current_date - $selected;
                            $date = $this->secondsToTime($diff);
                            $text = $date['d'] . '  days ago';
                        }
                        $Freelancers[$keey]['User']['Skills'] = $subSkills;
                        $Freelancers[$keey]['User']['Country_name'] = $Country;
                        $Freelancers[$keey]['User']['tests'] = $test_count;
                        $Freelancers[$keey]['User']['feedback'] = $feedbackFreelancer;
                        if (!empty($text)) {
                            $Freelancers[$keey]['User']['test_timeduration'] = $text;
                        }
                    }
                    if (!empty($this->request->data)) {
                        if (!empty($this->request->data['User']['Search_freelancer'])) {
                            $user = explode(' ', $this->request->data['User']['Search_freelancer']);
                                        
                            foreach ($user as $k => $v) {
                                $conds['OR']['User.first_name LIKE'] = "%$v%";
                            }
                            foreach ($user as $k => $v) {
                                $conds['OR']['User.last_name LIKE'] = "%$v%";
                            }
                            $conditions = array($conds, 'User.description !=' => '', 'User.type' => 'freelancer');
                            $this->paginate = array('limit' => 10, 'conditions' => $conditions);
                            $Freelancers = $this->paginate('User');
                            foreach ($Freelancers as $keey => $vall) {
                                $userids = $vall['User']['id'];
                                $userSkills = explode(',', $vall['User']['skills']);
                                $userCountry = explode(',', $vall['User']['country_id']);
                                $subSkills = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $userSkills)));
                                $Country = $this->Country->find('first', array('conditions' => array('Country.id' => $userCountry)));
                                $feedbackFreelancer = $this->Projectfeedback->find('first', array('conditions' => array('Projectfeedback.user_type' => 'client', 'Projectfeedback.freelancer_id' => $userids)));
                                $All_tests = $this->Finalresult->find('all', array('conditions' => array('Finalresult.user_id' => $userids)));
                                $test_count = count($All_tests);
                                foreach ($All_tests as $kk => $vv) {
                                    $current_date = time();
                                    $selected = strtotime($vv['Finalresult']['created']);
                                    $diff = $current_date - $selected;
                                    $date = $this->secondsToTime($diff);
                                    $text = $date['d'] . '  days ago';
                                }
                                $Freelancers[$keey]['User']['Skills'] = $subSkills;
                                $Freelancers[$keey]['User']['Country_name'] = $Country;
                                $Freelancers[$keey]['User']['tests'] = $test_count;
                                $Freelancers[$keey]['User']['feedback'] = $feedbackFreelancer;
                                if (!empty($text)) {
                                    $Freelancers[$keey]['User']['test_timeduration'] = $text;
                                }
                            }
                            $this->set('Freelancer_user', $Freelancers);
                        }
                    }
                    $this->set('Freelancer_user', $Freelancers);
    //                $this->set('id', $id);
    //                $this->set('SkillName', $Sub_Skill);
                //}
        //}
    }

    function secondsToTime($inputSeconds) {

        $secondsInAMinute = 60;
        $secondsInAnHour = 60 * $secondsInAMinute;
        $secondsInADay = 24 * $secondsInAnHour;

        /* extract days */
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

    public function jobdetail($id) {
        $this->layout = 'front';
        $this->loadModel('Job');
        $this->loadModel('User');
        $this->loadModel('Subskill');
        $this->loadModel('Country');
        $this->loadModel('Category');
        $this->loadModel('Subcategory');
        $this->loadModel('Projectfeedback');
        $this->loadModel('Paypalpayment');
        $this->loadModel('Creditpayment');
        $this->loadModel('Hire');
        $last_url = $this->referer();
        $this->set('last_url', $last_url);
        $jobs = $this->Job->find('first', array('conditions' => array('Job.id' => $id, 'Job.status' => 1)));

        $user_id = $jobs['Job']['user_id'];
        $hire_data = $this->Hire->find('all', array('conditions' => array('Hire.hiring_id' => $user_id)));
        $job_id = array();
        foreach ($hire_data as $key => $val) {
            $job_id[] = $val['Hire']['job_id'];
        }
        //pr($job_id);
        $users = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
        $this->set('users', $users);
        $jobs_all = $this->Job->find('all', array('conditions' => array('Job.id !=' => $id, 'Job.status' => 1), 'fields' => array('Job.id', 'Job.job_title'), 'order' => 'Job.id DESC'));

        $payment = $this->Paypalpayment->find('all', array('conditions' => array('Paypalpayment.client_id' => $user_id)));
        $credit_data = $this->Creditpayment->find('all', array('conditions' => array('Creditpayment.client_id' => $user_id)));
        $pay_val = array_merge($payment, $credit_data);
        $pay_data = array();
        foreach ($pay_val as $key => $va) {
            if (array_key_exists('Paypalpayment', $va)) {
                $pay_data[] = $va['Paypalpayment']['payment_amount'];
            }
            if (array_key_exists('Creditpayment', $va)) {
                $pay_data[] = $va['Creditpayment']['amount'];
            }
        }
        $pay = array_sum($pay_data);
        $this->set('pay', $pay);
        $Hire_data = $this->Hire->find('all', array('conditions' => array('Hire.hiring_id' => $user_id)));
        $Hire_data_count = count($Hire_data);
        $this->set('Hire_data', $Hire_data_count);
        $jobs_count = count($this->Job->find('all', array('conditions' => array('Job.status' => 1, 'Job.user_id' => $user_id), 'fields' => array('Job.id', 'Job.job_title'), 'order' => 'Job.id DESC')));


        $FeedbackToClient = $this->Projectfeedback->find('first', array('conditions' => array('Projectfeedback.client_id' => $user_id, 'Projectfeedback.user_type' => 'freelancer')));
        $review_client = $this->Projectfeedback->find('count', array('conditions' => array('Projectfeedback.client_id' => $user_id, 'Projectfeedback.user_type' => 'freelancer')));
        $all_open_jobs = $this->Job->find('all', array('conditions' => array('Job.id !=' => $job_id, 'Job.user_id' => $user_id)));
        $count_open_job = count($all_open_jobs);
        // pr($count_open_job);
        $this->set('open_jobs', $count_open_job);
        $skills = $jobs['Job']['skills'];
        $Skills = explode(',', $skills);
        $subskill = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $Skills)));
        $client_details = $this->User->find('first', array('conditions' => array('User.id' => $user_id, 'User.status' => 1)));
        $country_id = $client_details['User']['country_id'];
        $Country = $this->Country->find('first', array('conditions' => array('Country.id' => $country_id), 'fields' => array('Country.name')));
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
        $this->set('clientinfo', $client_details);
        $this->set('skill', $subskill);
        $this->set('subcategory_data', $Subcategory_data);
        $this->set('client_country', $Country);
        $this->set('category_data', $category_data);
        $this->set('OtherOpenJobs', $jobs_all);
        $this->set('Feedback', $FeedbackToClient);
        $this->set('Reviews', $review_client);
        $this->set('count_job', $jobs_count);
    }

    public function find_jobsby_category($id) {
        $this->layout = 'front';
        $this->loadModel('Category');
        $this->loadModel('Job');
        $this->loadModel('User');
        $this->loadModel('Subskill');
        $this->loadModel('Projectfeedback');
        $category = $this->Category->find('first', array('conditions' => array('Category.id' => $id), 'fields' => array('Category.name')));
        $this->paginate = array('limit' => 5, 'conditions' => array('AND' => array('Job.category_id' => $id, 'Job.status' => 1)), 'order' => 'Job.id ASC');
        $job_value = $this->paginate('Job');
        $job_values = $this->Job->find('all', array('conditions' => array('Job.category_id' => $id)));
        $count_job = count($job_values);
        if (!empty($job_value)) {
            foreach ($job_value as $kk => $vv) {
                $skills = $vv['Job']['skills'];
                $subSkills = $this->Subskill->find('all', array('conditions' => array('Subskill.skill_id' => $skills)));
                $crnt_date = time();
                $userId = $vv['Job']['user_id'];
                $selected = strtotime($vv['Job']['created']);
                $diff = $crnt_date - $selected;
                $date = $this->secondsToTime($diff);
                $text = 'Posted  ' . $date['h'] . ' hours ' . $date['m'] . ' Minutes ago ';

                $job_value[$kk]['Job']['time_duration'] = $text;
                $job_value[$kk]['Job']['skill_name'] = $subSkills;
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
    }

}
