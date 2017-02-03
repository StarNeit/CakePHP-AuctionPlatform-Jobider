<?php

ob_start();
//error_reporting(0);
App::uses('CakeEmail', 'Network/Email');

class LoginController extends AppController {

    var $twitterConsumerKey = twitterConsumerKey;
    var $twitterConsumerSecret = twitterConsumerSecret;
    public $components = array('Cookie', 'Session');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('index', 'forgetpassword', 'resetpassword', 'GooglePlus', 'Facebook', 'twitter', 'linkedin'));
    }

    /* Login Webadmin Index Function */

    public function webadmin_index() {
        $this->layout = "admin_login";
        //pr($_SESSION); 
        $this->loadModel('Admin');
        if ($this->request->is('post')) {
            $conds = array(
                'Admin.username' => $this->request->data['Admin']['username'],
                'Admin.password' => Security::hash($this->request->data['Admin']['password'], null, TRUE),
            );
            $admin = $this->Admin->find('first', array('conditions' => $conds));
            if ($admin) {
                $this->Auth->login($admin['Admin']);
                return $this->redirect($this->Auth->redirect());
            } else {
                $message = $this->Session->setFlash(('Invalid enteries..!!'), 'auth.front.message');
            }
        }
        if ($this->Auth->loggedIn() || $this->Auth->login()) {
            return $this->redirect($this->Auth->redirectUrl());
        }
    }

    /* Login Webadmin Logout Function */

    public function webadmin_logout() {
        $this->Session->delete('Auth.Admin');
        $this->redirect('/webadmin');
    }

    /* Login Index1 Function */

    public function index1() {
        $this->layout = 'front';
        $this->loadModel('User');
        if ($this->request->is('post')) {
            $password = $this->request->data['User']['password'];
            $hpassword = Security::hash($password, null, true);
            $username = $this->request->data['User']['email'];
            $conds = array('email' => $username, 'password' => $hpassword, 'status' => 1);
            $login_user = $this->Users->find('first', array('conditions' => $conds));
            if ($login_user) {
                $this->Auth->login($login_user['User']);
                return $this->redirect($this->Auth->redirect());
            }
        }
    }

    /* Login Index Function */

    public function index() {
        $this->layout = 'front';
        $this->loadModel('User');
        if ($this->request->is('post')) {
//    pr($this->request->data);
//    die('vbshsdfjsj');
            $conds = array(
                'User.email' => $this->request->data['User']['email'],
                'User.password' => Security::hash($this->request->data['User']['password'], null, TRUE),
                'User.status' => '1',
            );
            $admin = $this->User->find('first', array('conditions' => $conds));
            if ($admin) {
                if ($admin['User']['type'] == 'client') {
                    //$_SESSION['Auth']['Client'] = $admin['User'];
                    $this->Auth->login($admin['User']);
                }
                if ($admin['User']['type'] == 'freelancer') {
                    $current_date = date('d-m-Y');
                    $date = strtotime($current_date);
                    $strt_date = strtotime($admin['User']['add_time']);
                    $end_date = date('d-m-Y', strtotime('+1 month', $strt_date));
                    $total_time = strtotime($end_date);

                    $loginData['User']['login_time'] = time();
                    $this->User->id = $admin['User']['id'];
                    $this->set($loginData);
                    $this->User->save($loginData);
                    $this->Auth->login($admin['User']);
                }
                if ($this->request->data['User']['remember'] == '1') {

                    $this->Cookie->write(array('name' => $this->request->data['User']['email'], 'password' => $this->request->data['User']['password']), true, "60 seconds");
                    $COOKIE['email'] = $this->Cookie->read('name');
                    $COOKIE['password'] = $this->Cookie->read('password');
                    $_SESSION['User']['Cookie'] = $COOKIE;
                } else {
                    unset($_SESSION['User']['Cookie']);
                }
                return $this->redirect('/login/dashboard');
            } else {

                // echo   $hash_password=Security::hash($this->request->data['User']['password']);
                $conditions = array(
                    'User.email' => $this->request->data['User']['email'],
                    'User.password' => Security::hash($this->request->data['User']['password'], null, TRUE),
                );
                $activated = $this->User->find('first', array('conditions' => $conditions));

                if ($activated) {


                    if ($activated['User']['status'] == "0") {
                        $message = $this->Session->setFlash(('Your are not verified,Please check your mail to activate your account!!'), 'error_unverify');
                    }
                } else {
                    $message = $this->Session->setFlash(('Invalid enteries..!!'), 'error_unverify');
                }
            }
        }
    }

    /* Login Dashboard Function */

    public function dashboard() {
        $this->autoRender = false;
        // pr($_SESSION); die;
        $session = $this->Session->read();
        //pr($session); die;
//            $user_id=$session['Auth']['User']['id'];
        if (isset($session['Auth']['User']['type']) && !empty($session['Auth']['User']['type'])) {
            $freelancer = $session['Auth']['User']['type'];

            if ($freelancer == 'freelancer') {

                $this->redirect('/freelancer');
            }
        }
        if (isset($session['Auth']['User']['type']) && !empty($session['Auth']['User']['type'])) {
            $client = $session['Auth']['User']['type'];

            if ($client == 'client') {
                $this->redirect('/client');
            }
        }
    }

    /* Login Logout Function */

    public function logout() {
//        $this->Session->delete('Auth.freelancer');
//        $this->Session->delete('Auth.Client');
        $this->redirect($this->Auth->logout());
    }

    /* Login Forget Password Function */

    public function forgetpassword() {
        $this->layout = 'front';
        $this->loadModel('User');
        if (($this->request->is('post'))) {
            $this->User->set($this->request->data);
            $find = $this->User->find('first', array('conditions' => array('User.email' => $this->request->data['User']['email'])));
            $this->set('find', $find);
            if (!empty($find)) {
                $random = rand(100, 150);
                $rand = md5($random);
                $this->request->data['User']['user_token'] = $rand;
                $this->User->id = $find['User']['id'];
                $data = $this->request->data;
                if ($this->User->save($data)) {
                    $Email = new CakeEmail();
                    $Email->template('resetpassword');
                    $Email->emailFormat('html');
                    $Email->viewVars(array('tocken' => $rand, 'data' => $data, 'first_name' => $find['User']['first_name']));
                    $Email->from(array('info@jobider.com' => 'www.jobider.com'));
                    $Email->to($data['User']['email']);
                    $Email->subject('Jobider - Reset Password', 'success');
                    $Email->send();
                    $this->set('data', $data);
                    $this->Session->setFlash('Please check your email address.
A Reset password email has been sent to your email address. Click on the  link in order to reset your password.', 'success');
                }
            }
        }
    }

    /* Login Reset Password123 Function */

    public function resetpassword123($token = null) {
        $this->layout = 'front';
        $this->loadModel('User');
        $find = $this->User->find('first', array('conditions' => array('User.user_token' => $token)));
        $id = $find['User']['id'];
        $this->set('token', $find);
        if (!empty($find)) {
            if ($this->request->is('post')) {
                if ($this->request->data['new_password'] == $this->request->data['confirm_password']) {
                    $NewPassword_is = $this->request->data['new_password'];
                    $hashPassword_is = Security::hash($NewPassword_is, null, TRUE);
                    $this->request->data['password'] = $hashPassword_is;
                    $this->User->id = $id;
                    $this->set($this->request->data);
                    if ($this->User->save($this->request->data)) {
                        $this->Session->setFlash('Password Successfully Changed , Please <a href="http://jobider.pnf-sites.info/developer/login">login here</a>', 'success');
                    } else {
                        $this->Session->setFlash('Password Does Not Changed, Please Try Again', 'error_unverify');
                    }
                } else {
                    $this->Session->setFlash('Passowrd Does Not Match , Please Enter The Correct Password', 'error_unverify');
                }
            }
        }
    }

    /* Login Reset Password Function */

    public function resetpassword($token = null) {
        $this->layout = 'front';
        $this->loadModel('User');
        $find = $this->User->find('first', array('conditions' => array('User.user_token' => $token)));
        $id = $find['User']['id'];
        $this->set('token', $find);
        if (!empty($find)) {
            if ($this->request->is('post')) {
                $this->User->set($this->request->data);
                if ($this->request->data['User']['new_password'] == $this->request->data['User']['confirm_password']) {
//                    $password_will_be = $this->request->data['User']['new_password'];
//                    $hpassword_back_with = Security::hash($password_will_be, null, true);
                    $this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['new_password']);
                    $this->User->id = $id;
                    $this->set($this->request->data);
//                    pr($this->request->data);
//                    die;
                    if ($this->User->save($this->request->data)) {
                        $this->Session->setFlash('Password successfully changed , Please <a href="http://www.jobider.com/login" target="_blank">login here</a>', 'success');
                    } else {
                        $this->Session->setFlash('Password Does Not Changed, Please Try Again', 'error_unverify');
                    }
                } else {
                    $this->Session->setFlash('Password Does Not Match , Please Enter The Correct Password', 'error_unverify');
                }
            }
        }
    }

    ///////////////////////////Google+///////////////////

    public function GooglePlus() {

        $this->autoRender = false;
        require_once INCLUDE_PATH . 'app/webroot/googlelogin/src/apiClient.php';
        require_once INCLUDE_PATH . 'app/webroot/googlelogin/src/contrib/apiOauth2Service.php';

        $client = new apiClient();
        $client->setApplicationName("Google Account Login");
        $oauth2 = new apiOauth2Service($client);
        if (isset($_GET['code'])) {
            $client->authenticate();
//            $_SESSION['token'] = $client->getAccessToken();
        }
        if (isset($_SESSION['token'])) {
//            $client->setAccessToken($_SESSION['token']);
        }
        if (isset($_REQUEST['logout'])) {
            unset($_SESSION['token']);
            unset($_SESSION['google_data']); //Google session data unset
            $client->revokeToken();
        }
        if ($client->getAccessToken()) {
            $user = $oauth2->userinfo->get();
            // pr($user); die;
            unset($_SESSION['facebook_info']);
//                    unset($_SESSION['google_data']);
            unset($_SESSION['linkedIn_info']);
            $_SESSION['google_data'] = $user;
               
//            $_SESSION['token'] = $client->getAccessToken();
            // return $this->redirect(array('controller'=>'users','action'=>'client'));
        } else {
            $authUrl = $client->createAuthUrl();
        }
?>
        <?php if (isset($personMarkup)): ?>
            <?php print $personMarkup ?>
        <?php endif ?>
        <?php

        if (isset($authUrl)) {
          //  echo "yes";
            $this->redirect($client->createAuthUrl());
        } else {
           // echo "no";
            return $this->redirect(array('controller' => 'users', 'action' => 'client'));
        }
    }

    public function Facebook() {
        $this->autoRender = false;


        require_once INCLUDE_PATH . 'app/webroot/facebook/facebook.php';

        $facebook = new Facebook(array(
            'appId' => FACEBOOK_APP_ID,
            'secret' => FACEBOOK_APP_SECRET,
        ));
        unset($_SESSION['fb_' . FACEBOOK_APP_ID . '_code']);
        unset($_SESSION['fb_' . FACEBOOK_APP_ID . '_access_token']);
        unset($_SESSION['fb_' . FACEBOOK_APP_ID . '_user_id']);
//     pr($facebook);die;

        $user = $facebook->getUser();
//     pr($user); die;
// die;
        if ($user) {
//            pr($user);
///user is logged in
            try {
                $user_profile = $facebook->api('/me');
//                pr($user_profile);
                if (!empty($user_profile)) {
                    unset($_SESSION['google_data']);
                    unset($_SESSION['linkedIn_info']);
                    $_SESSION['facebook_info'] = $user_profile;
                    $this->redirect(array('controller' => 'users', 'action' => 'client'));
                }

                $token = $facebook->getAccessToken();
            } catch (FacebookApiException $e) {
                error_log($e);
                pr($e);
                $user = null;
            }
        } else {
//             $user_profile = $facebook->api('/me');
//                pr($user_profile); die;
//                if (!empty($user_profile)) {
//                    unset($_SESSION['google_data']);
//                    unset($_SESSION['linkedIn_info']);
//                    $_SESSION['facebook_info'] = $user_profile;
//                   // pr($_SESSION['facebook_info']); die;
//                    //$this->redirect(array('controller' => 'users', 'action' => 'client'));
//                }
//user is not logged in redirect to facebook
            $redirect_uri = BASE_URL . '/login/Facebook';
//pr($redirect_uri);
            $login_url = $facebook->getLoginUrl(array('scope' => 'email,read_stream, user_birthday, user_location, user_work_history, user_hometown, user_photos', 'redirect_uri' => $redirect_uri));
            header("Location: " . $login_url);
        }
    }

    public function twitter() {
        require_once(INCLUDE_PATH . 'app/webroot/twitteroauth/twitteroauth.php');
        if (!isset($_REQUEST['oauth_token']) and !isset($_REQUEST['oauth_verifier'])) {
            $redirect_uri = BASE_URL . '/login/twitter/';
            $callbackurl = $redirect_uri;
            /* Application Details */
            $connection = new TwitterOAuth($this->twitterConsumerKey, $this->twitterConsumerSecret);
            /* Get temporary credentials. */
            $request_token = $connection->getRequestToken($callbackurl);
            /* Save temporary credentials to session. */
            $token = $request_token['oauth_token'];
            $secret = $request_token['oauth_token_secret'];
            /* If last connection failed don't display authorization link. */
            switch ($connection->http_code) {
                case 200:
                    /* Build authorize URL and redirect user to Twitter. */
                    $url = $connection->getAuthorizeURL($token);
                    header("Location: " . $url);
                    break;
                default:
                    /* Show notification if something went wrong. */
                    echo 'Could not connect to Twitter. Refresh the page or try again later.';
            }
        } else {
            $connection = new TwitterOAuth($this->twitterConsumerKey, $this->twitterConsumerSecret, $_REQUEST['oauth_token'], $_REQUEST['oauth_verifier']);
            $token_credentials = $connection->getAccessToken($_REQUEST['oauth_verifier']);

            $connection = new TwitterOAuth($this->twitterConsumerKey, $this->twitterConsumerSecret, $token_credentials['oauth_token'], $token_credentials['oauth_token_secret']);
            $account = $connection->get('account/verify_credentials');

            if (!empty($account)) {
                pr($account);
                die;
                $this->Session->write('twitterAccount', $account);
//    $this->set('twitterAccount',$account);
                $this->redirect(array('controller' => 'users', 'action' => 'client'));
            }
        }
    }

    public function linkedin() {
        $this->autoRender = false;
        require_once INCLUDE_PATH . 'app/webroot/linkedin/OAuth.php';
        $linkedin = new linkedinoauth();
        define('API_KEY', '75qry6kvx7ar5u');
        define('API_SECRET', 'KfUP66UjtOL6IAkk');
        define('REDIRECT_URI', BASE_URL . "/login/linkedin");
        define('SCOPE', 'r_emailaddress r_basicprofile');

        if (isset($_GET['error'])) {
            echo "error  LinkedIn returned an error";

            print $_GET['error'] . ': ' . $_GET['error_description'];
        } elseif (isset($_GET['code'])) {

            if ($_SESSION['state'] == $_GET['state']) {
//ECHO"HERE";DIE;
                $token = $linkedin->getAccessToken();
            } else {
                exit;
            }
        } else {
            unset($_SESSION['access_token']);
            unset($_SESSION['expires_in']);
            unset($_SESSION['expires_at']);
            unset($_SESSION['state']);

            if ((empty($_SESSION['expires_at'])) || (time() > $_SESSION['expires_at'])) {
                
            }
            if (empty($_SESSION['access_token'])) {
                $linkedin->getAuthorizationCode();
            }
        }// Congratulations! You have a valid token. Now fetch your profile 

        $user_linkedin = $linkedin->fetch('GET', '/v1/people/~:(id,first-name,last-name,headline,picture-url,email-address)');
        if (!empty($user_linkedin)) {
            unset($_SESSION['facebook_info']);
            unset($_SESSION['google_data']);
            $_SESSION['linkedIn_info'] = $user_linkedin;
        }
        $this->redirect(array('controller' => 'users', 'action' => 'client'));
    }

}

