<?php

class FindfreelancerController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('findjobs', 'jobs_category', 'jobsdata', 'professional_category', 'jobs_cate', 'jobscategory', 'professional_skills', 'professional_country', 'countrydata', 'country_data', 'chek', 'Search', 'freelancer_skill', 'skill_data', 'skills_free', 'jobs_categories', 'category_jobs', 'TopSkillFreelancers', 'FreelancerByCategory', 'professionals_cate', 'Skill_Freelancer', 'ajax_data', 'search_result');
    }

    /* Find Jobs Function */

    public function findjobs() {
        $this->layout = 'front';
        $this->loadModel('Category');
        $this->loadModel('Subcategory');
        $category = $this->Category->find('all', array('fields' => array('Category.name')));
        foreach ($category as $key => $val) {
            $subcate = $this->Subcategory->find('all', array('limit' => 5, 'conditions' => array('Subcategory.category_id' => $val['Category']['id'])));
            $category[$key]['subcategory'] = $subcate;
        }
        $this->set('category', $category);
    }

    /* Jobs Category Function */

    public function jobs_category($id) {
        $this->layout = 'front';
        $this->loadModel('Subcategory');
        $this->loadModel('Job');
        $this->loadModel('User');
        $this->loadModel('Category');
        $this->loadModel('Subskill');
        include 'timefunction.php';
        $sub_data = $this->Subcategory->find('first', array('conditions' => array('Subcategory.id' => $id)));

        $this->set('sub_data', $sub_data);
        $sub_text = $sub_data['Subcategory']['category_name'];
        $sub_texts = $sub_data['Category']['name'];
        $this->set('sub_text', $sub_text);

        $this->paginate = array(
            'limit' => 4,
            'conditions' => array(
                'Job.subcategory_id' => $sub_data['Subcategory']['id'],
            ),
            'order' => 'Job.id DESC'
        );
        $job_data = $this->paginate('Job');
        //pr($job_data);
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
        $count_job = $this->Job->find('count',array('conditions'=>array('Job.subcategory_id'=>$sub_data['Subcategory']['id'])));
        $this->set('job_data', $job_data);
        $this->set('count_job', $count_job);
        $category=  $this->Category->find('all',array('fields'=>array('Category.name')));
        $category_val = $this->Subcategory->find('all', array('fields' => array('Subcategory.category_name','Subcategory.id')));
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
        $subcategory = $this->Subcategory->find('all', array('conditions' => array('Subcategory.category_id' => $sub_data['Category']['id'])));
        $this->set('subcategory', $subcategory);
    }

    /* Jobs Data Function */

    public function jobsdata($ids) {
        $this->layout = 'front';
        $this->loadModel('Job');
        $this->loadModel('User');
        $this->loadModel('Subskill');
        $this->loadModel('Category');
        $this->loadModel('Subcategory');
        $this->loadModel('Country');
        $jobdata = $this->Job->find('first', array('conditions' => array('Job.id' => $ids)));

        if (!empty($jobdata)) {
            $this->set('jobdata', $jobdata);
            $user_id = $jobdata['Job']['user_id'];
            $currentDate = time();
            $selected_date = strtotime($jobdata['Job']['created']);
            $diff = $currentDate - $selected_date;
            $date = $this->secondsToTime($diff);
            $text = $date['d'] . '  days ' . $date['h'] . '  hours ago';
            $Client_info = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
            $country_id = $Client_info['User']['country_id'];
            $client_country = $this->Country->find('first', array('conditions' => array('Country.id' => $country_id)));
            $category = $this->Category->find('first', array('conditions' => array('Category.id' => $jobdata['Job']['category_id'])));
            $this->set('category', $category);

            $sub = $this->Subcategory->find('first', array('conditions' => array('Subcategory.id' => $jobdata['Job']['subcategory_id'])));
            $this->set('sub', $sub);
            $skills = explode(',', $jobdata['Job']['skills']);
            $subskill = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $skills)));
            $this->set('subskill', $subskill);
            $jobs = $this->Job->find('all', array('conditions' => array('Job.id !=' => $ids)));
            $this->set('Timeduration', $text);
            $this->set('jobs', $jobs);
            $this->set('Clientdata', $Client_info);
            $this->set('Clientcountry', $client_country);
        }
    }

    /* Professional Category Function */

    public function professional_category() {
        $this->layout = 'front';
        $this->loadModel('Category');
        $this->loadModel('Subcategory');
        $category = $this->Category->find('all', array('fields' => array('Category.name')));
        foreach ($category as $key => $val) {
            $subcate = $this->Subcategory->find('all', array('limit' => 5, 'conditions' => array('Subcategory.category_id' => $val['Category']['id'])));
            $category[$key]['subcategory'] = $subcate;
        }

        $this->set('category', $category);
    }

    /* Jobs Cate Function */

    public function professionals_cate($cat_id = NULL) {
        $this->layout = 'front';
        $this->loadModel('Category');
        $this->loadModel('Subcategory');
        $this->loadModel('User');
        $this->loadModel('Country');
        $this->loadModel('Subskill');
        $this->loadModel('Finalresult');
        $this->loadModel('Projectfeedback');
        $this->Subcategory->recursive = -1;
        $AllCategory = $this->Category->find('first', array('conditions' => array('Category.id' => $cat_id), 'fields' => array('Category.name')));
        $all_subcategory = $this->Subcategory->find('all', array('conditions' => array('Subcategory.category_id' => $cat_id)));
        $all_freelancers = $this->User->find('all', array('conditions' => array('User.type' => 'freelancer', 'User.description !=' => '')));
        $var = count($all_freelancers);
        $userId = array();
        foreach ($all_freelancers as $k => $v) {
            $category_id = explode(',', $v['User']['categories']);
            foreach ($category_id as $key => $val) {
                foreach ($all_subcategory as $kk => $vv) {
                    if ($vv['Subcategory']['id'] == $val) {
                        $userId[] = $v['User']['id'];
                    }
                }
            }
        }
        $USerId = array_unique($userId);
        $this->paginate = array('limit' => 3, 'conditions' => array('User.id' => $USerId), 'order' => 'User.id DESC');
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
                $all_subcategory = $this->Subcategory->find('all', array('conditions' => array('Subcategory.category_id' => $cat_id)));
                $all_freelancers = $this->User->find('all', array('conditions' => array('User.type' => 'freelancer', 'User.description !=' => '')));
                $userId = array();
                foreach ($all_freelancers as $k => $v) {
                    $category_id = explode(',', $v['User']['categories']);
                    foreach ($category_id as $key => $val) {
                        foreach ($all_subcategory as $kk => $vv) {
                            if ($vv['Subcategory']['id'] == $val) {
                                $userId[] = $v['User']['id'];
                            }
                        }
                    }
                }
                $USerId = array_unique($userId);
                $user = explode(' ', $this->request->data['User']['search_content']);
                foreach ($user as $k => $v) {
                    $conds['OR']['User.first_name LIKE'] = "%$v%";
                }
                foreach ($user as $k => $v) {
                    $conds['OR']['User.last_name LIKE'] = "%$v%";
                }
                $conditions = array($conds, 'User.description !=' => '', 'User.type' => 'freelancer', 'User.id' => $USerId);
                $this->paginate = array('limit' => 5, 'conditions' => $conditions);
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
        $this->set('Category', $AllCategory);
        $this->set('cat_id', $cat_id);
    }

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

    public function search_result() {
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
            $users_data = $this->User->find('all', array('conditions' => array('User.id' => $id, 'User.image !=' => '', 'User.description !=' => '')));
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
            <div class="green">' . ucfirst($data['User']['first_name']) . '    ' . ucfirst($data['User']['last_name']) . ' <a href="' . $this->webroot . 'client/contract/' . $data['User']['id'] . '"><button class="btn-sm btn-danger btn_red11 pull-right marg_l20">Hire Me</button></a><span class="date pull-right"><i class="mrg_r5"><img alt="" src="' . $this->webroot . 'img/deatil.png"></i>' . $data['User']['job_title'] . '(' . $skill_data1 . ')</span>
             <div class="clearfix"></div>  </div>
               <div class="col-md-2 col-sm-2 marg_tb15">
                 <img class="img-thumbnail" alt=" " src="' . $this->webroot . 'uploads/' . $data['User']['image'] . '" height=auto width="100%">
               </div>
               <div class="col-md-10 colsm-10 marg_tb15 lesval">
                <p>' . substr($data['User']['description'], 0, 200) . '.... 
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

    public function jobs_cate($id) {
        $this->layout = 'front';
        $this->loadModel('Subcategory');
        $this->loadModel('Job');
        $this->loadModel('User');
        $this->loadModel('Category');
        $this->loadModel('Subskill');
        $jobs = $this->Job->find('all', array('conditions' => array('Job.category_id' => $id)));
        $sub_data = $this->Category->find('first', array('conditions' => array('Category.id' => $id)));
//pr($sub_data);
        $sub_category = $this->Subcategory->find('all', array('conditions' => array('Subcategory.category_id' => $id)));
        $category = $this->Category->find('all', array('fields' => array('Category.name')));
//pr($category);
        $job_count = array();
        foreach ($category as $ke => $va) {
//            pr($va);
            $job_count[$va['Category']['id']] = count($this->Job->find('all', array('conditions' => array('Job.category_id' => $va['Category']['id']))));
        }
        $this->set('sub_data', $sub_data);
        $this->paginate = array(
            'limit' => 4,
            'conditions' => array(
                'Job.category_id' => $id,
            ),
            'order' => 'Job.id DESC'
        );
        $job_data = $this->paginate('Job');
//       pr($job_data);
//       die('sjdjsahdsadsa');
        foreach ($job_data as $k => $v) {
            $user_id = $v['Job']['user_id'];
            $users = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
            $crnt_date = time();
            $selected = strtotime($v['Job']['created']);
            $diff = $crnt_date - $selected;
            $date = $this->secondsToTime($diff);
            $text = 'on ' . $date['d'] . ' days ' . $date['h'] . ' hours ago';
            /////////////////////////////////
            $skills = explode(',', $v['Job']['skills']);
            $subskills = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $skills)));
            $job_data[$k]['Job']['realskill'] = $subskills;
            $job_data[$k]['Job']['time_duration'] = $text;
            $job_data[$k]['Job']['users'] = $users;
        }
        $count_job = count($jobs);
        $this->set('job_data', $job_data);
        $this->set('count_job', $count_job);
        $this->set('subcategory', $sub_category);

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
        $subcategory = $this->Subcategory->find('all', array('conditions' => array('Subcategory.category_id' => $sub_data['Category']['id'])));
        $this->set('subcategory', $subcategory);
    }

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

    /* Jobscategory Function */

    public function jobscategory($ids) {
        $this->layout = 'front';
        $this->loadModel('Job');
        $this->loadModel('Subskill');
        $this->loadModel('Category');
        $this->loadModel('Subcategory');
        $last_url = $this->referer();
        $this->set('last_url', $last_url);
        $jobdata = $this->Job->find('first', array('conditions' => array('Job.id' => $ids)));
        $this->set('jobdata', $jobdata);
        $category = $this->Category->find('first', array('conditions' => array('Category.id' => $jobdata['Job']['category_id'])));
        $this->set('category', $category);
        $sub = $this->Subcategory->find('first', array('conditions' => array('Subcategory.id' => $jobdata['Job']['subcategory_id'])));
        $this->set('sub', $sub);
        $skills = explode(',', $jobdata['Job']['skills']);
        $subskill = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $skills)));
        $this->set('subskill', $subskill);
        $jobs = $this->Job->find('all', array('conditions' => array('Job.id !=' => $ids)));
        $this->set('jobs', $jobs);
    }

    /* Professional Skills Function */

    public function professional_skills($var = NULL) {
        $this->layout = 'front';
        $this->loadModel('Skill');
        $this->loadModel('Category');
        $this->loadModel('Subskill');
        $this->loadModel('Subcategory');
        $skills = $this->Skill->find('all', array('fields' => array('Skill.name')));
        $category = $this->Category->find('all', array('fields' => array('Category.name')));
        foreach ($category as $key => $value) {
            $subcategory[$value['Category']['id']] = $this->Subcategory->find('first', array('conditions' => array('Subcategory.category_id' => $value['Category']['id'])));
        }
        $subskill = $this->Subskill->find('all', array('fields' => array('Subskill.skill_name')));
        $find_professional = $this->Subskill->find('all', array('conditions' => array('Subskill.skill_name LIKE' => $var . '%'), 'fields' => array('Subskill.skill_name', 'Subskill.id')));
        $this->set('subskill', $subskill);
        $this->set('find_professional', $find_professional);
        $this->set('skills', $skills);
        $this->set('category', $category);
    }

    /* Professional Country Function */

    public function professional_country() {
        $this->layout = 'front';
        $this->loadModel('User');
        $this->loadModel('Country');
        $this->loadModel('Category');
        $all_countryy = $this->Country->find('list', array('conditions' => array('Country.status' => 1)));
//	pr($all_countryy); die('jkhdfhdfkjh');
        $this->paginate = array(
            'limit' => '50',
            'conditions' => array(
                'Country.status' => '1'
            )
        );
        $all_country = $this->paginate('Country');
//pr($all_country); die('kdfkdjfldkj');
        foreach ($all_country as $k => $v) {
            $ids[] = $v['Country']['id'];
        }
        $find_freelancer = $this->User->find('all', array('conditions' => array('User.country_id' => $ids, 'User.type' => 'freelancer', 'User.status' => 1), 'fields' => array('User.username')));

        $this->Category->recursive = -1;
        $all_category = $this->Category->find('all', array('fields' => array('Category.name', 'Category.id')));
//$this->set('cntry',	$cntry);
        $this->set('freelancer_result', $find_freelancer);
        $this->set('category', $all_category);
        $this->set('countryy', $all_country);
        $this->set('country', $all_countryy);
    }

    /* Country Data Function */

    /* Select Subcategory Function Through Ajax */

    public function chek() {
        $this->autoRender = false;
        $this->loadModel('Subcategory');
        $find = $this->Subcategory->find('all', array('conditions' => array('Subcategory.category_id' => $_POST['provider'])));
        if ($find) {
            $test = "<select name='data[Subcategory][sub_skills]' class= 'form-control sub' ><option value=''>Select Subcategory</option>";
            foreach ($find as $k => $v) {
                $test .= '<option value=' . $v['Subcategory']['id'] . '>' . $v['Subcategory']['category_name'];
            }
        }
        $arr['suc'] = 'yes';
        $arr['provide'] = $test;
        echo json_encode($arr);
    }

    /* Search Freelancer Function Through Ajax */

    public function Search() {
        $this->autoRender = false;
        $this->loadModel('User');
        $this->loadModel('Subskill');
        $this->loadModel('Country');
        $category = $_POST['provider'];
// $country=$_POST['country'];
        if (!empty($_POST['contry'])) {
            $search = $this->User->find('all', array('conditions' => array('User.country_id' => $_POST['contry'], 'User.type' => 'freelancer')));
            $count_data = count($search);
        } else {
            $Search_freelancer = $this->User->find('all', array('conditions' => array('User.type' => 'freelancer')));
        }
        $id = array();
        if (!empty($Search_freelancer)) {
            foreach ($Search_freelancer as $kk => $vv) {
                $category_id = explode(',', $vv['User']['category_id']);
                $subcategory_id = explode(',', $vv['User']['categories']);
                if (in_array($_POST['provider'], $category_id)) {
                    $id[] = $vv['User']['id'];
                }
                if (!empty($_POST['subskill'])) {
                    if (in_array($_POST['subskill'], $subcategory_id)) {
                        $id[] = $vv['User']['id'];
                    }
                }
            }
        }
        if (!empty($id)) {
            $user_id = array_unique($id);
            $this->paginate = array(
                'limit' => 3,
                'conditions' => array(
                    'User.id' => $user_id
                )
            );
            $search = $this->paginate('User');
            $count_data = count($search);
        }

        if (!empty($search)) {
            $datas = '';
            foreach ($search as $k => $data) {
                $subskil = explode(',', $data['User']['skills']);
                $counttry_id = $data['User']['country_id'];
                $country_name = $this->Country->find('first', array('conditions' => array('Country.id' => $counttry_id)));
                $subs = $this->Subskill->find('all', array('limit' => 3, 'conditions' => array('Subskill.id' => $subskil)));
                $subsk = array();
                foreach ($subs as $kks => $vvc) {
                    $subsk[] = $vvc['Subskill']['skill_name'];
                }
                $subkk = implode(',', $subsk);
                $subskl = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $subskil)));
                $datas .= '<div class="bg_white freelaners marg_btm30">
            <div class="green">' . $data['User']['first_name'] . '    ' . $data['User']['last_name'] . '<span class="date pull-right"><i class="mrg_r5"><img alt="" src="' . $this->webroot . 'img/deatil.png"></i>' . $data['User']['job_title'] . '(' . $subkk . ')</span>
             <div class="clearfix"></div>  </div>
               <div class="col-md-2 col-sm-2 marg_tb15">
                 <img class="img-thumbnail" alt=" " src="' . $this->webroot . 'uploads/' . $data['User']['image'] . '" height=auto width="100%">
               </div>
               <div class="col-md-10 colsm-10 marg_tb15">
                <p>' . substr($data['User']['description'], 0, 150) . '.... 
                <a href="#">more</a>
                </p>
               </div>
           <div class="clearfix"></div>
               <hr class="brder_btm1 marg_tb15">
               <div class="tabs_1 col-md-12">';
                foreach ($subskl as $ks => $ve) {
                    $skill_data = '<button class="subskil" disabled>' . $ve['Subskill']['skill_name'] . '</button>';
                    $datas.=$skill_data;
                }

                $datas.=' </div>
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
                   
                   <i><img src="' . $this->webroot . 'img/location.png" alt=""></i><span class=" text_green">' . $country_name['Country']['name'] . '</span>
                   
                 </div>
                 
                 <div class="location pull-left">
                   
                   <i><img src="' . $this->webroot . 'img/check.png" alt=""></i><span class=" text_green">LAST ACTIVE ' . $date = date('M. d,Y', strtotime($data['User']['created'])) . '</span>
                   
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
               <p style="text-align:center;color:#DD5428;"> No Record (s) Found !</p><hr class="brder_btm1 marg_tb15">
               <div class="tabs_1 col-md-12">
               </div>
                        <div class="clearfix"></div>
              <div class="clearfix"></div>
  </div>';
            $arr['dataDivs'] = $datasD;
            $arr['count'] = 0;
        }
        echo json_encode($arr);
    }

    /* Freelancer Skill Function */

    public function freelancer_skill($skill_id) {
        $this->layout = 'front';
        $this->loadModel('Subskill');
        $this->loadModel('Skill');
        $this->loadModel('Country');
        $this->loadModel('User');
        $subskill = $this->Subskill->find('first', array('conditions' => array('Subskill.id' => $skill_id)));
        $subskil = $this->Subskill->find('list', array('conditions' => array('Subskill.skill_id' => $subskill['Skill']['id']), 'fields' => 'Subskill.skill_name'));
        $this->set('subskil', $subskil);
        $this->set('subskill', $subskill);
        $skill_name = $this->Skill->find('list', array('field' => array('skill.name')));
        $this->set('skill_name', $skill_name);
        $country_name = $this->Country->find('list', array('field' => 'Country.name'));
        $this->set('country_name', $country_name);
        $user = $this->User->find('all', array('conditions' => array('User.type' => 'freelancer')), 'order');
        $user_id = array();
        foreach ($user as $kk => $val) {
            $skills = explode(',', $val['User']['skills']);
            if (in_array($skill_id, $skills)) {
                $user_id[] = $val['User']['id'];
            }
        }

        $this->paginate = array(
            'limit' => 4,
            'conditions' => array(
                'AND' => array(
                    'User.id' => $user_id,
                    'User.type' => 'freelancer'
                )
            ),
            'order' => 'User.id DESC'
        );
        $user_info = $this->paginate('User');
//$skill_value=array();
        foreach ($user_info as $k => $val) {
            $skills_id = explode(',', $val['User']['skills']);
            $contry_id = $val['User']['country_id'];
            $subskills = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $skills_id)));
            $limited_skills = $this->Subskill->find('all', array('limit' => 3, 'conditions' => array('Subskill.id' => $skills_id)));
            $sklname = array();
            foreach ($limited_skills as $kk => $vv) {
                $sklname[] = $vv['Subskill']['skill_name'];
            }
            $skill_data1 = implode(',', $sklname);
            $country_name = $this->Country->find('first', array('conditions' => array('Country.id' => $contry_id)));
            $user_info[$k]['User']['skill_data'] = $subskills;
            $user_info[$k]['User']['country_name'] = $country_name;
            $user_info[$k]['User']['LimitedSkills'] = $skill_data1;
        }
        $sub_text = $subskill['Subskill']['skill_name'];
        $user_count = count($user_info);
        $this->set('user_info', $user_info);
        $this->set('user_count', $user_count);
        $this->set('sub_text', $sub_text);
    }

    public function Skill_Freelancer($id = null) {
        $this->layout = 'front';
        $this->loadModel('Skill');
        $this->loadModel('Subskill');
        $this->loadModel('User');
        $this->loadModel('Finalresult');
        $this->loadModel('Result');
        $this->loadModel('Test');
        $this->loadModel('Country');
        $this->loadModel('Projectfeedback');
        $Sub_Skill = $this->Subskill->Find('first', array('conditions' => array('Subskill.id' => $id)));
        $sub_id = $Sub_Skill['Subskill']['id'];
        $all_freelancers = $this->User->find('all', array('conditions' => array('User.type' => 'freelancer')));
        $userId = array();
        foreach ($all_freelancers as $k => $v) {
            $skill_id = explode(',', $v['User']['skills']);
            foreach ($skill_id as $key => $val) {
                if ($sub_id == $val) {
                    $userId[] = $v['User']['id'];
                }
            }
        }
        $USerId = array_unique($userId);
        $this->paginate = array('limit' => 3, 'conditions' => array('User.id' => $USerId));
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
                $Sub_Skill = $this->Subskill->Find('first', array('conditions' => array('Subskill.id' => $id)));
                $sub_id = $Sub_Skill['Subskill']['id'];
                $all_freelancers = $this->User->find('all', array('conditions' => array('User.type' => 'freelancer', 'User.description !=' => '')));
                $userId = array();
                foreach ($all_freelancers as $k => $v) {
                    $skill_id = explode(',', $v['User']['skills']);
                    foreach ($skill_id as $key => $val) {
                        if ($sub_id == $val) {
                            $userId[] = $v['User']['id'];
                        }
                    }
                }
                $USerId = array_unique($userId);
                $user = explode(' ', $this->request->data['User']['Search_freelancer']);
                foreach ($user as $k => $v) {
                    $conds['OR']['User.first_name LIKE'] = "%$v%";
                }
                foreach ($user as $k => $v) {
                    $conds['OR']['User.last_name LIKE'] = "%$v%";
                }
                $conditions = array($conds, 'User.description !=' => '', 'User.type' => 'freelancer', 'User.id' => $USerId);
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
        $this->set('id', $id);
        $this->set('SkillName', $Sub_Skill);
    }

    public function country_data($con_id) {
        $this->layout = 'front';
        $this->loadModel('Skill');
        $this->loadModel('Subskill');
        $this->loadModel('User');
        $this->loadModel('Finalresult');
        $this->loadModel('Result');
        $this->loadModel('Test');
        $this->loadModel('Country');
        $this->loadModel('Projectfeedback');
        $Country_data = $this->Country->find('first', array('conditions' => array('Country.id' => $con_id)));
        $country_id = $Country_data['Country']['id'];
        $all_freelancer = $this->User->find('all', array('conditions' => array('User.type' => 'freelancer', 'User.country_id' => $country_id)));
        $user_id = array();
        foreach ($all_freelancer as $key => $val) {
            $countryIds[] = $val['User']['country_id'];
            foreach ($countryIds as $kk => $vv) {
                if ($country_id == $vv) {
                    $user_id[] = $val['User']['id'];
                }
            }
        }
        $UserId = array_unique($user_id);
        $this->paginate = array('limit' => 3, 'conditions' => array('User.id' => $UserId));
        $Freelancers = $this->Paginate('User');
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
                $Country_data = $this->Country->find('first', array('conditions' => array('Country.id' => $con_id)));
                $country_id = $Country_data['Country']['id'];
                $all_freelancer = $this->User->find('all', array('conditions' => array('User.type' => 'freelancer')));
                $user_id = array();
                foreach ($all_freelancer as $key => $val) {
                    $countryIds[] = $val['User']['country_id'];
                    foreach ($countryIds as $kk => $vv) {
                        if ($country_id == $vv) {
                            $user_id[] = $val['User']['id'];
                        }
                    }
                }
                $UserId = array_unique($user_id);
                $user = explode(' ', $this->request->data['User']['Search_freelancer']);
                foreach ($user as $k => $v) {
                    $conds['OR']['User.first_name LIKE'] = "%$v%";
                }
                foreach ($user as $k => $v) {
                    $conds['OR']['User.last_name LIKE'] = "%$v%";
                }
                $conditions = array($conds, 'User.type' => 'freelancer', 'User.description !=' => '', 'User.country_id' => $country_id, 'User.id' => $UserId);
                $this->paginate = array('limit' => 10, 'conditions' => $conditions);
                $Freelancers = $this->paginate('User');
                foreach ($Freelancers as $keey => $vall) {
                    $userids = $vall['User']['id'];
                    $userSkills = explode(',', $vall['User']['skills']);
                    $userCountry = $vall['User']['country_id'];
                    $subSkills = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $userSkills)));
                    $Country = $this->Country->find('first', array('conditions' => array('Country.id' => $userCountry)));
                    $feedbackFreelancer = $this->Projectfeedback->find('first', array('conditions' => array('Projectfeedback.freelancer_id' => $userids, 'Projectfeedback.user_type' => 'client')));
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
            }
        }
        $this->set('Freelancer_user', $Freelancers);
        $this->set('id', $con_id);
        $this->set('Country_name', $Country_data);
    }

    /* Skill Data Function */

    public function skill_data() {
        $this->autoRender = false;
        $this->loadModel('Subskill');
        $skill_id = $_POST['skill'];
        $subskill = $this->Subskill->find('all', array('conditions' => array('Subskill.skill_id' => $skill_id)));
        if ($subskill) {
            $sub_data = "<select name='data[Userskill][sub_skills]' class= 'form-control sub' ><option value=''>Select Subskill</option>";
            foreach ($subskill as $k => $v) {
                $sub_data.="<option value=" . $v['Subskill']['id'] . ">" . $v['Subskill']['skill_name'] . "</option>";
            }
            $sub_data.='</select>';
        }
        $arr['suc'] = 'yes';
        $arr['subskill'] = $sub_data;
        echo json_encode($arr);
    }

    /* Skill Data Function */

    public function skills_free() {
        $this->autoRender = false;
        $this->loadModel('User');
        $this->loadModel('Subskill');
        $this->loadModel('Country');
        $skills = $_POST['skill'];
        $subskill = $_POST['subskill'];
        $country = $_POST['country'];
        $user_country = $this->Country->find('first', array('conditions' => array('Country.id' => $country)));
        if (!empty($country)) {
            $user = $this->User->find('all', array('conditions' => array('User.country_id' => $country, 'User.type' => 'freelancer')));
            $count = count($user);
        } else {
            $user_skill = $this->User->find('all', array('conditions' => array('User.type' => 'freelancer')));
        }
        $id = array();
        if (!empty($user_skill)) {
            foreach ($user_skill as $key => $value) {
                $skills_value = explode(',', $value['User']['skills']);
                $skills_val = explode(',', $value['User']['skill_id']);
                if (in_array($skills, $skills_val)) {
                    $id[] = $value['User']['id'];
                }

                if (in_array($subskill, $skills_value)) {
                    $id[] = $value['User']['id'];
                }
            }
        }
        if (!empty($id)) {
            $id = array_unique($id);
            $this->paginate = array(
                'limit' => 4,
                'conditions' => array('User.type' => 'freelancer', 'User.id' => $id, 'User.image !=' => '', 'User.description !=' => '')
            );
            $user = $this->Paginate('User');
            $count = count($user);
        }
        if (!empty($user)) {
            $datas = '';
            foreach ($user as $k => $data) {
                $skills = explode(',', $data['User']['skills']);
                $c_id = $data['User']['country_id'];
                $subskill = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $skills)));
                $limited_skills = $this->Subskill->find('all', array('limit' => 3, 'conditions' => array('Subskill.id' => $skills)));
                $sklname = array();
                foreach ($limited_skills as $kk => $vv) {
                    $sklname[] = $vv['Subskill']['skill_name'];
                }
                $skill_data1 = implode(',', $sklname);
                if (isset($c_id) && !empty($c_id)) {
                    $c_name = $this->Country->find('first', array('conditions' => array('Country.id' => $c_id)));
                }
                $datas.= '<div class="bg_white freelaners marg_btm30">
            <div class="green">' . $data['User']['first_name'] . '    ' . $data['User']['last_name'] . ' <span class="date pull-right"><i class="mrg_r5"><img alt="" src="' . $this->webroot . 'img/deatil.png"></i>' . $data['User']['job_title'] . ' (' . $skill_data1 . ')</span>
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
                <a href="JavaScript:void(0);" class="less">less</a></p>
               </div>
           <div class="clearfix"></div>
               <hr class="brder_btm1 marg_tb15">
               <div class="tabs_1 col-md-12">';

                foreach ($subskill as $kk => $vv) {
                    $skill_data = '<button class="subskil" disabled>' . $vv['Subskill']['skill_name'] . '</button>';
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
                $datas.=' </div>
                 
                 <div class="location pull-left">
                   
                   <i><img src="' . $this->webroot . 'img/check.png" alt=""></i><span class=" text_green">LAST ACTIVE ' . $date = date('M.d,Y', strtotime($data['User']['created'])) . ' </span>
                   
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
            $arr['count'] = $count;
//        $arr['dataPagi'] = $dataPagi;
        } else {
            $arr['suc'] = 'No';
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
            $count = 0;
            $arr['dataDivs'] = $datasD;
            $arr['count'] = $count;
        }
        echo json_encode($arr);
    }

    /* Jobs Categories Function */

    public function jobs_categories($id) {
        $this->layout = 'front';
        $this->loadModel('Category');
        $this->loadModel('Subcategory');
        $this->loadModel('Job');
        $this->loadModel('Subskill');
        $this->loadModel('User');
        $category_value = $this->Category->find('first', array('conditions' => array('Category.id' => $id)));
        $this->set('category_name', $category_value);
        $sub_text = $category_value['Category']['name'];
        $this->set('sub_text', $sub_text);
        $this->paginate = array(
            'limit' => 4, 'conditions' => array(
                'Job.category_id' => $id
            ),
            'order' => 'Job.id Desc '
        );
        $job_data = $this->paginate('Job');

        $skill = array();
        foreach ($job_data as $k => $v) {
            $skill = explode(',', $v['Job']['skills']);
            $user_id = $v['Job']['user_id'];
            $subskill = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $skill)));
            $client_info = $this->User->find('first', array('conditions' => array('User.id' => $user_id)));
            $job_data[$k]['Job']['Subskill'] = $subskill;
            $job_data[$k]['Job']['Client_record'] = $client_info;
        }
        $job_count = count($job_data);
        $this->set('job_count', $job_count);
        $this->set('job_data', $job_data);
        $sidebar_category = $this->Category->find('all', array('fields' => array('Category.name', 'Category.id')));
        $this->set('sidebar_category', $sidebar_category);
        $sidebar_subcategory = $this->Subcategory->find('all', array('conditions' => array('Subcategory.category_id' => $id)));
        $this->set('subcategory', $sidebar_subcategory);
///////Get The Data From 24 hours///////////////
        $tres = $this->Job->find('all', array('conditions' => array('Job.created >= NOW() - INTERVAL   1 DAY')));
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

    public function category_jobs($id) {
        $this->layout = 'front';
        $this->loadModel('Category');
        $this->loadModel('Job');
        $this->loadModel('User');
        $jobs = $this->Job->find('all', array('conditions' => array('Job.category_id' => $id)));
        $category = $this->Category->find('first', array('conditions' => array('Category.id' => $id), 'fields' => array('Category.name')));
        $this->paginate = array('limit' => 5, 'conditions' => array('AND' => array('Job.category_id' => $id, 'Job.status' => 1)), 'order' => 'Job.id ASC');
        $job_value = $this->paginate('Job');
        $count_job = count($jobs);
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

    public function TopSkillFreelancers($id = null) {
        $this->layout = 'front';
        $this->loadModel('Skill');
        $this->loadModel('Subskill');
        $this->loadModel('User');
        $this->loadModel('Finalresult');
        $this->loadModel('Result');
        $this->loadModel('Test');
        $this->loadModel('Country');
        $this->loadmodel('Projectfeedback');
        $this->Subskill->recursive = -1;
        $Sub_Skill = $this->Skill->Find('first', array('conditions' => array('Skill.id' => $id)));
        $sub_skill = $this->Subskill->Find('all', array('conditions' => array('Subskill.skill_id' => $id)));
        $all_freelancers = $this->User->find('all', array('conditions' => array('User.type' => 'freelancer', 'User.image !=' => '', 'User.description !=' => '')));
        $userId = array();
        foreach ($all_freelancers as $k => $v) {
            $skill_id = explode(',', $v['User']['skills']);
            foreach ($skill_id as $key => $val) {
                foreach ($sub_skill as $kk => $vv) {
                    if ($vv['Subskill']['id'] == $val) {
                        $userId[] = $v['User']['id'];
                    }
                }
            }
        }
        $USerId = array_unique($userId);
        $this->paginate = array('limit' => 4, 'conditions' => array('User.id' => $USerId));
        $Freelancers = $this->paginate('User');
        foreach ($Freelancers as $keey => $vall) {
            $userids = $vall['User']['id'];
            $userSkills = explode(',', $vall['User']['skills']);
            $userCountry = $vall['User']['country_id'];
            $subSkills = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $userSkills)));
            $Country = $this->Country->find('first', array('conditions' => array('Country.id' => $userCountry)));
            $feedback_freelancer = $this->Projectfeedback->find('first', array('conditions' => array('Projectfeedback.freelancer_id' => $userids, 'Projectfeedback.user_type' => 'client')));
//            pr($feedback_freelancer);
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
            $Freelancers[$keey]['User']['feedback'] = $feedback_freelancer;
            if (!empty($text)) {
                $Freelancers[$keey]['User']['test_timeduration'] = $text;
            }
        }
//        pr($Freelancers);die;
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
                    $feedback_freelancer = $this->Projectfeedback->find('first', array('conditions' => array('Projectfeedback.user_type' => 'client', 'Projectfeedback.freelancer_id' => $userids)));
                    //                    pr($feedback_freelancer);
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
                    if (!empty($text)) {
                        $Freelancers[$keey]['User']['test_timeduration'] = $text;
                    }
                    $Freelancers[$keey]['User']['feedback'] = $feedback_freelancer;
                }
                $this->set('Freelancer_user', $Freelancers);
            }
        }
        $this->set('Freelancer_user', $Freelancers);
        $this->set('id', $id);
        $this->set('SkillName', $Sub_Skill);
    }

    public function FreelancerByCategory($cat_id = null) {
        $this->layout = 'front';
        $this->loadModel('Category');
        $this->loadModel('Subcategory');
        $this->loadModel('User');
        $this->loadModel('Country');
        $this->loadModel('Subskill');
        $this->loadModel('Finalresult');
        $this->loadModel('Projectfeedback');
        $this->Subcategory->recursive = -1;
        $AllCategory = $this->Category->find('first', array('conditions' => array('Category.id' => $cat_id), 'fields' => array('Category.name')));
        $all_subcategory = $this->Subcategory->find('all', array('conditions' => array('Subcategory.category_id' => $cat_id)));
        $all_freelancers = $this->User->find('all', array('conditions' => array('User.type' => 'freelancer', 'User.image !=' => '', 'User.description !=' => '')));
        $userId = array();
        foreach ($all_freelancers as $k => $v) {
            $category_id = explode(',', $v['User']['categories']);
            foreach ($category_id as $key => $val) {
                foreach ($all_subcategory as $kk => $vv) {
                    if ($vv['Subcategory']['id'] == $val) {
                        $userId[] = $v['User']['id'];
                    }
                }
            }
        }
        $USerId = array_unique($userId);
        $this->paginate = array('limit' => 3, 'conditions' => array('User.id' => $USerId));
        $Freelancers = $this->paginate('User');
        foreach ($Freelancers as $key => $val) {
            $userids = $val['User']['id'];
            $userSkills = explode(',', $val['User']['skills']);
            $country_id = $val['User']['country_id'];
            $Skills = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $userSkills)));
            $User_country = $this->Country->find('first', array('conditions' => array('Country.id' => $country_id)));
            $All_tests = $this->Finalresult->find('all', array('conditions' => array('Finalresult.user_id' => $userids)));
            $Feedback_freelancer = $this->Projectfeedback->find('first', array('conditions' => array('Projectfeedback.user_type' => 'client', 'Projectfeedback.freelancer_id' => $userids)));
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
                $conditions = array($conds, 'User.description !=' => '', 'User.type' => 'freelancer');
                $this->paginate = array('limit' => 5, 'conditions' => $conditions);
                $Freelancers = $this->paginate('User');
                foreach ($Freelancers as $key => $vall) {
                    $userids = $vall['User']['id'];
                    $userSkills = explode(',', $vall['User']['skills']);
                    $country_id = $val['User']['country_id'];
                    $subskills = $this->Subskill->find('all', array('conditions' => array('Subskill.id' => $userSkills)));
                    $User_country = $this->Country->find('first', array('conditions' => array('Country.id' => $country_id)));
                    $All_tests = $this->Finalresult->find('all', array('conditions' => array('Finalresult.user_id' => $userids)));
                    $Feedback_freelancer = $this->Projectfeedback->find('first', array('conditions' => array('Projectfeedback.user_type' => 'client', 'Projectfeedback.freelancer_id' => $userids)));
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
                    $Freelancers[$key]['User']['feedback'] = $Feedback_freelancer;
                    if (!empty($text)) {
                        $Freelancers[$key]['User']['timeduration'] = $text;
                    }
                }
                $this->set('Freelancer_user', $Freelancers);
            }
        }
        $this->set('Freelancer_user', $Freelancers);
        $this->set('Category', $AllCategory);
        $this->set('cat_id', $cat_id);
    }
    
    
	


}

