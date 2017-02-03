<?php

App::uses('Controller', 'Controller');

class AppController extends Controller {

    public $components = array('Email','Session', 'Cookie', 'Auth', 'Paginator', 'RequestHandler');
    public $helpers = array('Html', 'Form', 'Js');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->userModel = 'Admin';
        $this->loadModel('Address');
        $this->loadModel('Jobdetail');
        $this->loadModel('Category');
        $this->loadModel('Contect');
        $this->loadModel('Notification');
        $this->loadModel('Test');
        $this->loadModel('Message');
        $this->loadModel('Job');
        $this->loadModel('AdminNotification');
        $user_id = $this->Auth->User('id');
        //  pr($user_id);
        if(isset($this->params['pass']['0']) && !empty($this->params['pass']['0'])){
      $slug=  $this->params['pass']['0'];
      $id=  $this->params['pass']['0'];
$free_id=  $this->params['pass']['0'];
      $sender_id=  $this->params['pass']['0'];
      $us_id=  $this->params['pass']['0'];
      $jobid=  $this->params['pass']['0'];
//      pr($jobid);
      $helpid=  $this->params['pass']['0'];
      $helps=  $this->params['pass']['0'];
      $uss=  $this->params['pass']['0'];
     $id_val=  $this->params['pass']['0'];
   //$test_data=  $this->Test->find('first',array('conditions'=>array('Test.id'=>$id)));
        $this->set('test', $slug);
        $this->set('test_data', $id);
        $this->set('sender', $sender_id);
        $this->set('us', $us_id);
        $this->set('jobid', $jobid);
        $this->set('helpid', $helpid);
        $this->set('helps', $helps);
        $this->set('ussid', $uss);
        $this->set('id_val', $id_val);
        $this->set('free_id', $free_id);
        }
        //$admin_notify=  $this->AdminNotification->find('all',array('limit'=>5,'conditions'=>array('AdminNotification.read_status'=>'0')));
        //$this->set('admin_data',$admin_notify);
        $admin_count=  $this->AdminNotification->find('count',array('conditions'=>array('AdminNotification.read_status'=>'0')));
        $this->set('admin_count',$admin_count);
         $count_msg=  $this->Message->find('count',array('conditions'=>array('Message.reciever'=>$user_id,'Message.read_status'=>'0')));
         //pr($count_msg);
        $Job_details = $this->Jobdetail->find('all', array('conditions' => array('Jobdetail.freelancer_id' => $user_id)));
        $notification = $this->Notification->find('all', array('conditions' => array('Notification.reciever_id' => $user_id), 'order' =>array('Notification.id DESC')));
       //pr($notification); 
  $count_notify=  $this->Notification->find('count',array('conditions'=>array('Notification.reciever_id'=>$user_id,'Notification.status'=>'0')));
  //pr($count_notify);
  $this->set('count_notify',$count_notify);
  $count_job=  $this->Job->find('count',array('conditions'=>array('Job.job_status'=>'in-process')));
  $this->set('inv_count',$count_job);
        $count = count($Job_details);
        $adres = $this->Address->find('first', array('conditions' => array('Address.id' => '1')));
        $this->set('address', $adres);
        $this->set('notification', $notification);
        $this->set('sent_app', $count);
        $this->set('count_message', $count_msg);
//        $this->set('inv_interview', $count_interview);
        if (isset($this->params['prefix']) && $this->params['prefix'] == 'webadmin') {
            $this->Auth->userModel = 'Admin';
            AuthComponent::$sessionKey = 'Auth.Admin';
            $this->Auth->logoutRedirect = $this->Auth->loginAction = array('prefix' => 'webadmin', 'controller' => 'login', 'action' => 'index');
            $this->Auth->loginError = 'Invalid Username/Password Combination!';
            $this->Auth->flash['element'] = 'auth.front.message';
            $this->Auth->loginRedirect = array('controller' => 'dashboard', 'action' => 'index', 'prefix' => 'webadmin');
        } else {
            $this->Auth->userModel = 'User';
            $this->Auth->loginAction = array('prefix' => false, 'controller' => 'login', 'action' => 'index');
            $this->Auth->logoutRedirect = $this->Auth->loginAction = array('prefix' => false, 'controller' => 'login', 'action' => 'index');
            $this->Auth->loginError = 'Invalid Email/Password Combination!';
            $this->Auth->flashElement = "auth.front.message";
            $this->Auth->loginRedirect = array('controller' => 'login', 'action' => 'dashboard', 'prefix' => false);
        }
        /* Search Functionality for Home Page . */

        // if (!empty($this->request->data['Category']['search_home'])) {
        //     $search_data = $this->Job->find('all', array('conditions' => array('Job.job_title LIKE' => '%' . $this->request->data['Category']['search_home'] . '%')));
        //     $this->Session->write('search_content', $this->request->data['Category']['search_home']);
        //     $this->Session->write('search_data', $search_data);
        //     $this->redirect(array('controller' => 'home', 'action' => 'findjobbycategory'));
        // }
         
        if($this->request->data['Category']['search_type']=='job'){
            $this->Session->write('search_content', $this->request->data['Category']['search_home']);
            $this->redirect(array('controller' => 'home', 'action' => 'findjobbycategory'));
        }
        if($this->request->data['Category']['search_type']=='freelancer'){
            $this->Session->write('search_content', $this->request->data['Category']['search_home']);
            $this->redirect(array('controller' => 'home', 'action' => 'findfreelancer'));
        }
        if($this->request->data['Category']['search_type']=='client'){
            $this->Session->write('search_content', $this->request->data['Category']['search_home']);
            $this->redirect(array('controller' => 'home', 'action' => 'findclient'));
        }

    }

      function generate_timezone_list() {
        static $regions = array(
    DateTimeZone::AFRICA,
    DateTimeZone::AMERICA,
    DateTimeZone::ANTARCTICA,
    DateTimeZone::ASIA,
    DateTimeZone::ATLANTIC,
    DateTimeZone::AUSTRALIA,
    DateTimeZone::EUROPE,
    DateTimeZone::INDIAN,
    DateTimeZone::PACIFIC,
        );
//pr($regions);
        $timezones = array();
//        PR($regions);
        foreach ($regions as $region) {
//            PR(DateTimeZone::listIdentifiers($region));
            $timezones = array_merge($timezones, DateTimeZone::listIdentifiers($region));
        }
//pr($timezones);DIE;
        $timezone_offsets = array();
        foreach ($timezones as $timezone) {
            $tz = new DateTimeZone($timezone);
//pr($timezone);
            $timezone_offsets[$timezone] = $tz->getOffset(new DateTime);
            //  pr($timezone_offsets);
        }

        // sort timezone by offset
        asort($timezone_offsets);
//pr(asort($timezone_offsets));die;
        $timezone_list = array();
        foreach ($timezone_offsets as $timezone => $offset) {
            $offset_prefix = $offset < 0 ? '-' : '+';
            //    pr($timezone);
            //    pr($offset);
            //       pr($offset_prefix);
            $offset_formatted = gmdate('H:i', abs($offset));
//pr($offset_formatted);
            $pretty_offset = "UTC${offset_prefix}${offset_formatted}";
///pr($pretty_offset);
            $timezone_list[$timezone] = "(${pretty_offset}) $timezone";
            //   pr($timezone_list);die;
        }
        //      pr($timezone_list);
//   pr(count($timezone_list));
        //       pr($timezone_list['Pacific/Pago_Pago']);
        // die;
        return $timezone_list;
    }
    function pageForPagination($model) {
    $page = 1;
    $sameModel = isset($this->params['named']['model']) && $this->params['named']['model'] == $model;
    $pageInUrl = isset($this->params['named']['page']);
    if ($sameModel && $pageInUrl) {
      $page = $this->params['named']['page'];
    }

    $this->passedArgs['page'] = $page;
    return $page;
  }
}