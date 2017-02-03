<?php

class FacebookController extends AppController {

    public function login1() { 
        $this->autoRender = false;
        //require 'facebook.php';
        echo INCLUDE_PATH . 'facebook_login/facebook/facebook.php';
        require_once INCLUDE_PATH . 'facebook_login/facebook/facebook.php';
        require INCLUDE_PATH . 'facebook_login/config/fbconfig.php';
        require INCLUDE_PATH . 'facebook_login/config/functions.php';
//echo'hfdsaout';die;

        $facebook = new Facebook(array(
            'appId' => '1579449555643627',
            'secret' => 'fae775a80354c13dde90e6549ced5181',
        ));

        $user = $facebook->getUser();
//pr($user); die;('fhdjhfdsf');
//die('kjfhdkjfhdjh');
        if ($user) {
            try {
                // Proceed knowing you have a logged in user who's authenticated.
                $user_profile = $facebook->api('/me');
            } catch (FacebookApiException $e) {
                error_log($e);
                $user = null;
            }






            if (!empty($user_profile)) {
                # User info ok? Let's print it (Here we will be adding the login and registering routines)

                $username = $user_profile['name'];
                $uid = $user_profile['id'];
                $email = $user_profile['email'];
                $user = new User();
                $userdata = $user->checkUser($uid, 'facebook', $username, $email);
                if (!empty($userdata)) {
                    session_start();
                    $_SESSION['id'] = $userdata['id'];
                    $_SESSION['oauth_id'] = $uid;

                    $_SESSION['username'] = $userdata['username'];
                    $_SESSION['email'] = $email;
                    $_SESSION['oauth_provider'] = $userdata['oauth_provider'];
                    $this->redirect(array('controller' => 'dashboard', 'action' => 'index'));
                    // header("Location: home.php");
                }
            } else {
                # For testing purposes, if there was an error, let's kill the script
                die("There was an error.");
            }
        } else {
            # There's no active session, let's generate one
            $login_url = $facebook->getLoginUrl(array('scope' => 'email'));
            //pr($login_url); die;
            $this->redirect($login_url);
            //header("Location: " . $login_url);
        }
    }

    public function login() {//echo"5";die;
        $this->autoRender = false;
        require_once( INCLUDE_PATH . 'facebook/facebook.php' );
        $facebook = new Facebook(array(
            'appId' => 721625481230741,
            'secret' => '9f965cabb42052b79a616a73d5fdea71',
        ));
//        $facebook->getLogoutUrl(SITE_URL . 'facebook/login');
// Get User ID
// echo '$facebook';
        $user = $facebook->getUser();
//pr($user);die;
        if ($user) {///user is logged in
// echo"user";
//die;
            try {
                $user_profile = $facebook->api('/me');
                $profile_pic = "http://graph.facebook.com/" . $user_profile['id'] . "/picture";
                pr($user_profile);
                pr($profile_pic);
                echo $fbimage = "<img src=\"" . $profile_pic . "\" />";
                $pages = $facebook->api('/me/accounts');
                pr($pages);
                foreach ($pages['data'] as $page) {
                    pr($page);
                    $fan_pic = "http://graph.facebook.com/" . $page['id'] . "/picture";
                    pr($fan_pic);
                    $title = $page['name'];
                    echo $fbimage = "<img src=\"" . $fan_pic . "\" / title='$title'>";
                }
                $groups = $facebook->api('/me/groups');
                pr($groups);
                die;
                foreach ($groups['data'] as $single) {
                    pr($single);
                    echo $g_pic = "http://graph.facebook.com/" . $single['id'] . "/picture";
                    $title = $single['name'];
                    echo $fbimage = "<img src=\"" . $g_pic . "\" / title='$title'>";
                }

                if (isset($user_profile) and ($user_profile)) {
// pr($user_profile);
//  die;
                    $this->loadModel('User');
                    $this->loadModel('Fanpage');
                    $existingUser = $this->User->find('first', array('conditions' => array('User.fb_id' => $user_profile['id'])));
//pr($existingUser);die;
                    if (isset($existingUser['User']) and ($existingUser['User'])) {//user found
//      $this->Auth->login($existingUser['User']);
//     pr($existingUser);
//  echo'here';
// pr($_SESSION); 
///       echo"h343";
                        unset($_SESSION['fb_1461058634183453_code']);

                        unset($_SESSION['fb_1461058634183453_access_token']);
                        unset($_SESSION['fb_1461058634183453_user_id']);
                        if (isset($_GET['redirect_uri']) and !empty($_GET['redirect_uri'])) {
                            header("Location: " . $_GET['redirect_uri']);
                        } else {
                            $this->Session->setFlash('This Facebook User Already Exists!!Kindly Logout This Facebook Account and Login with an Another One.', 'error');
                            if ($finduser['User']['type'] == 'normal') {

                                $this->redirect(array('controller' => 'dashboard', 'action' => 'schedulepost'));
                            } elseif ($finduser['User']['type'] == 'scheduler') {
                                $this->redirect(array('controller' => 'PostScheduler', 'action' => 'schedulepost'));
                            } elseif ($finduser['User']['type'] == 'agency') {
                                $this->redirect(array('controller' => 'Agency', 'action' => 'schedulepost'));
                            }

                        }
                    } else {
                        echo"here";
                        $fb_count = $this->Faceboook->find('count', array('conditions' => array('user_id' => $finduser['User']['id'])));
                        $fb_exist_in_facebook = $this->Faceboook->find('first', array('conditions' => array('Faceboook.fb_id' => $user_profile['id'], 'user_id' => $finduser['User']['id'])));
                        if ($finduser['User']['type'] == 'agency') {
                            $fb_maximum_limit = 15;
                        } else {
                            $fb_maximum_limit = 3;
                        }

                        if ($fb_count < $fb_maximum_limit) {
                            if (empty($user_profile['birthday'])) {
                                $user_profile['birthday'] = "-";
                            }
                            $UserData['User']['fb_id'] = $user_profile['id'];
                            $UserData['User']['timezone'] = $user_profile['timezone'];
                            $UserData['User']['locale'] = $user_profile['locale'];
                            $UserData['User']['fb_access_token'] = $facebook->getAccessToken();
                            $UserData['User']['fb_status'] = 1;
                            if (empty($user_profile['email'])) {
                                $user_profile['email'] = "-";
                            }
                            $UserData['User']['birthday'] = $user_profile['birthday'];
                            $UserData['User']['first_name'] = $user_profile['first_name'];
                            $UserData['User']['last_name'] = $user_profile['last_name'];
                            @$UserData['User']['fb_email'] = $user_profile['email'];
                            $UserData['User']['gender'] = $user_profile['gender'];
                            $this->User->id = $finduser['User']['id'];
                            if ($this->User->save($UserData, array('validate' => false))) {
                                $existing_fb_of_current_user = $this->Faceboook->find('first', array('conditions' => array('Faceboook.fb_id' => $user_profile['id'], 'user_id' => $finduser['User']['id'])));
                                if (empty($existing_fb_of_current_user)) {
                                    $FacebookData['Faceboook']['fb_id'] = $user_profile['id'];
                                    $FacebookData['Faceboook']['timezone'] = $user_profile['timezone'];
                                    $FacebookData['Faceboook']['locale'] = $user_profile['locale'];
                                    $FacebookData['Faceboook']['fb_access_token'] = $UserData['User']['fb_access_token'];
                                    $FacebookData['Faceboook']['fb_status'] = 1;
                                    $FacebookData['Faceboook']['loginby'] = 'facebook';
                                    if (empty($user_profile['email'])) {
                                        $user_profile['email'] = "-";
                                    }
                                    $FacebookData['Faceboook']['birthday'] = $user_profile['birthday'];
                                    $FacebookData['Faceboook']['first_name'] = $user_profile['first_name'];
                                    $FacebookData['Faceboook']['last_name'] = $user_profile['last_name'];
                                    @$FacebookData['Faceboook']['fb_email'] = $user_profile['email'];
                                    $FacebookData['Faceboook']['gender'] = $user_profile['gender'];
                                    $FacebookData['Faceboook']['user_id'] = $finduser['User']['id'];
  if ($this->Faceboook->save($FacebookData, array('validate' => false))) {
                                        
                                    }
                                    $fanData = "";
                                    $fanData['Fanpage']['user_id'] = $finduser['User']['id'];
                                    $fanData['Fanpage']['fb_id'] = $user_profile['id'];
                                    if (isset($pages)) {

                                        foreach ($pages['data'] as $page) {
                                            $this->Fanpage->create();
                                            $fanData['Fanpage']['fanpage_id'] = $page['id'];
                                            $fanData['Fanpage']['fanpage_access_token'] = $page['access_token'];
                                            $fanData['Fanpage']['fanpage_category'] = $page['category'];
                                            $fanData['Fanpage']['fanpage_name'] = $page['name'];
                                            $findexistingfanpage = $this->Fanpage->find('first', array('conditions' => array('Fanpage.fanpage_id' => $fanData['Fanpage']['fanpage_id'])));

                                            if (empty($findexistingfanpage)) {


                                                if ($this->Fanpage->save($fanData, array('validate' => false))) {

                                                    echo"saved";
                                                } else {
                                                    echo $this->Session->setFlash('Error while Adding Post', 'error');
                                                }
                                            }
                                        }
                                    }
                                }
                            }
// $findfanpages = $this->Fanpage->find('all', array('conditions' => array('Fanpage.fb_id' => $user_profile['id'])));
//                                    pr($findfanpages);
// $User = $this->User->find('first', array('conditions' => array('User.id' => $last_InserId)));
                            if (isset($_GET['redirect_uri']) and !empty($_GET['redirect_uri'])) {
                                $redirectVar = $_GET['redirect_uri'];
                            } else {
                                if ($finduser['User']['type'] == 'normal') {
                                    echo"in";
                                    $redirectVar = BASE_URL . 'dashboard/schedulepost';
                                } elseif ($finduser['User']['type'] == 'scheduler') {
                                    $redirectVar = BASE_URL . 'PostScheduler/schedulepost';
                                } elseif ($finduser['User']['type'] == 'agency') {
                                    $redirectVar = BASE_URL . 'Agency/schedulepost';
                                }
                            }
//$this->Auth->login($User['User']);
                            unset($_SESSION['fb_' . $this->facebookAppId . '_code']);
                            unset($_SESSION['fb_' . $this->facebookAppId . '_access_token']);
                            unset($_SESSION['fb_' . $this->facebookAppId . '_user_id']);
//pr($_SESSION);die;
                            $this->redirect($redirectVar);
                        } elseif (($fb_count == $fb_maximum_limit) && isset($fb_exist_in_facebook) && !empty($fb_exist_in_facebook)) {
//echo"h32el4jwk";die;
                            $FbData['User']['fb_id'] = $user_profile['id'];
                            $FbData['User']['timezone'] = $user_profile['timezone'];
                            $FbData['User']['locale'] = $user_profile['locale'];
                            $FbData['User']['fb_access_token'] = $facebook->getAccessToken();
//    $FbData['User']['fb_status'] = 1;
                            $FbData['User']['loginby'] = 'facebook';
                            if (empty($user_profile['email'])) {
                                $user_profile['email'] = "-";
                            }
//$FbData['User']['birthday'] = $user_profile['birthday'];
                            $FbData['User']['first_name'] = $user_profile['first_name'];
                            $FbData['User']['last_name'] = $user_profile['last_name'];
                            @$FbData['User']['fb_email'] = $user_profile['email'];
                            $FbData['User']['gender'] = $user_profile['gender'];
                            $this->User->id = $finduser['User']['id'];
                            if ($this->User->save($FbData, array('validate' => false))) {

                                $fanData = "";
                                $fanData['Fanpage']['user_id'] = $finduser['User']['id'];
                                $fanData['Fanpage']['fb_id'] = $user_profile['id'];
                                if (isset($pages)) {

                                    foreach ($pages['data'] as $page) {
                                        $this->Fanpage->create();
                                        $fanData['Fanpage']['fanpage_id'] = $page['id'];
                                        $fanData['Fanpage']['fanpage_access_token'] = $page['access_token'];
                                        $fanData['Fanpage']['fanpage_category'] = $page['category'];
                                        $fanData['Fanpage']['fanpage_name'] = $page['name'];

                                        $findexistingfanpage = $this->Fanpage->find('first', array('conditions' => array('Fanpage.fanpage_id' => $fanData['Fanpage']['fanpage_id'])));

                                        if (empty($findexistingfanpage)) {


                                            if ($this->Fanpage->save($fanData, array('validate' => false))) {

                                                echo"saved";
                                            } else {
                                                echo $this->Session->setFlash('Error while Adding Post', 'error');
                                            }
                                        }
                                    }
                                }
                                unset($_SESSION['fb_' . $this->facebookAppId . '_code']);
                                unset($_SESSION['fb_' . $this->facebookAppId . '_access_token']);
                                unset($_SESSION['fb_' . $this->facebookAppId . '_user_id']);
                                if ($finduser['User']['type'] == 'normal') {
                                    $this->redirect(array('controller' => 'dashboard', 'action' => 'schedulepost'));
                                } elseif ($finduser['User']['type'] == 'scheduler') {
                                    $this->redirect(array('controller' => 'PostScheduler', 'action' => 'schedulepost'));
                                } elseif ($finduser['User']['type'] == 'agency') {
                                    $this->redirect(array('controller' => 'Agency', 'action' => 'schedulepost'));
                                }
                            }
                        } else {

//     pr($_SESSION);
                            unset($_SESSION['fb_' . $this->facebookAppId . '_code']);
                            unset($_SESSION['fb_' . $this->facebookAppId . '_access_token']);
                            unset($_SESSION['fb_' . $this->facebookAppId . '_user_id']);
//      pr($_SESSION);die;
                            echo $this->Session->setFlash("You Have Exceeded the Limit of Your Facebook Accounts. Kindly Logout This Account and connect with One of Your " . $fb_maximum_limit . " Previous Used Accounts", 'error');
                            if ($finduser['User']['type'] == 'normal') {
                                $this->redirect(array('controller' => 'dashboard', 'action' => 'schedulepost'));
                            } elseif ($finduser['User']['type'] == 'scheduler') {
                                $this->redirect(array('controller' => 'PostScheduler', 'action' => 'schedulepost'));
                            } elseif ($finduser['User']['type'] == 'agency') {
                                $this->redirect(array('controller' => 'Agency', 'action' => 'schedulepost'));
                            }
                        }
                    }
                }
            } catch (FacebookApiException $e) {
                error_log($e);
                pr($e);
                die('failed');
                $user = null;
            }
        } else {///user is not logged in redirect to facebook
            if (@$_GET['redirect_uri']) {
                $redirect_uri = SITE_URL . 'facebook/login?redirect_uri=' . $_GET['redirect_uri'];
//echo"hello1";die;
            } else {
                $redirect_uri = SITE_URL . 'facebook/login';
            }
            $login_url = $facebook->getLoginUrl(array('scope' => 'email,publish_stream,publish_actions,manage_pages,user_groups', 'redirect_uri' => $redirect_uri));
//   pr($login_url);die;
            header("Location: " . $login_url);
        }
    }

    public function linkedin() {


        require_once(INCLUDE_PATH . 'linkedin1/OAuth.php');
//  require_once(INCLUDE_PATH . 'socialapp/linkedin/linkedinoAuth.php');
        $linkedin = new linkedinoauth();
        define('API_KEY', '753zyf08an5gdt');
        define('API_SECRET', 'wQB1AfKDMsIjHlfc');
        define('REDIRECT_URI', SITE_URL . "facebook/linkedin");
        define('SCOPE', 'r_fullprofile r_emailaddress rw_nus r_network rw_company_admin');
// unset($_SESSION['access_token']);

        if (isset($_GET['error'])) {
            echo"error  LinkedIn returned an error";

            print $_GET['error'] . ': ' . $_GET['error_description'];
        } elseif (isset($_GET['code'])) {

            if ($_SESSION['state'] == $_GET['state']) {
//ECHO"HERE";DIE;
                $aa = $linkedin->getAccessToken();
//  echo"here";
//pr($aa);die;
//     echo "2";
//   pr($_SESSION); 
//    exit;
            } else {
                exit;
            }
        } else {
            unset($_SESSION['access_token']);
            unset($_SESSION['expires_in']);
            unset($_SESSION['expires_at']);
            unset($_SESSION['state']);
            echo"3";
            if ((empty($_SESSION['expires_at'])) || (time() > $_SESSION['expires_at'])) {
// Token has expired, clear the state
// $_SESSION = array();
            }
            if (empty($_SESSION['access_token'])) {//echo"3.2";
// Start authorization process
                echo"here2";
                $linkedin->getAuthorizationCode();
            }
        }

        pr($linkedin);
// Congratulations! You have a valid token. Now fetch your profile 
        $user = $linkedin->fetch('GET', '/v1/people/~');
        pr($user);
//$user1 = $linkedin->fetch('GET', '/v1/people/~/public-profile-url');
        $user_picture = $linkedin->fetch('GET', '/v1/people/~/picture-url');
        $companies = $linkedin->fetchCompany('GET', '/v1/companies?is-company-admin=true');
        pr($companies);
        die;
        $ExistBylinkedin = $this->User->find('first', array('conditions' => array('User.linkedin_profilerequesturl' => $user->siteStandardProfileRequest->url)));
        if (isset($ExistBylinkedin['User']['id']) and !empty($ExistBylinkedin['User']['id'])) {
            $last_InserId = $ExistBylinkedin['User']['id']; //echo"h";die;
            if (isset($_GET['redirect_uri']) and !empty($_GET['redirect_uri'])) {
                header("Location: " . $_GET['redirect_uri']);
            } else {
                unset($_SESSION['access_token']);
                unset($_SESSION['expires_in']);
                unset($_SESSION['expires_at']);
                unset($_SESSION['state']);

                $this->Session->setFlash('This Linkedin User Already Exists!!.', 'error');
                if ($finduser['User']['type'] == 'normal') {
                    $this->redirect(array('controller' => 'dashboard', 'action' => 'schedulepost'));
                } elseif ($finduser['User']['type'] == 'scheduler') {
                    $this->redirect(array('controller' => 'PostScheduler', 'action' => 'schedulepost'));
                }
            }
        } else {


            $linkedin_count = $this->Linkkedin->find('count', array('conditions' => array('user_id' => $finduser['User']['id'])));
            $linkd_exist_in_linkedin = $this->Linkkedin->find('first', array('conditions' => array('Linkkedin.linkedin_profilerequesturl' => $user->siteStandardProfileRequest->url, 'user_id' => $finduser['User']['id'])));


            if ($finduser['User']['type'] == 'agency') {
                $linkedin_maximum_limit = 15;
            } else {
                $linkedin_maximum_limit = 3;
            }

            if ($linkedin_count < $linkedin_maximum_limit) {
                $this->loadModel('User');
                $UserData['User']['linkedin_oauth_access_token'] = $_SESSION['access_token'];
                $UserData['User']['linkedin_firstname'] = $user->firstName;
                $UserData['User']['linkedin_lastname'] = $user->lastName;
                $UserData['User']['linkedin_profilerequesturl'] = $user->siteStandardProfileRequest->url;
                if (isset($user_picture)) {
                    $UserData['User']['linkedin_profile_image'] = $user_picture;
                }
                $this->User->id = $finduser['User']['id'];

                if ($this->User->save($UserData, array('validate' => false))) {
                    $existing_linkdin_of_current_user = $this->Linkkedin->find('first', array('conditions' => array('Linkkedin.linkedin_profilerequesturl' => $UserData['User']['linkedin_profilerequesturl'], 'user_id' => $finduser['User']['id'])));
                    if (empty($existing_linkdin_of_current_user)) {

                        $LinkedinData['Linkkedin']['linkedin_oauth_access_token'] = $_SESSION['access_token'];
                        $LinkedinData['Linkkedin']['user_id'] = $finduser['User']['id'];
                        $LinkedinData['Linkkedin']['linkedin_firstname'] = $user->firstName;
                        $LinkedinData['Linkkedin']['linkedin_lastname'] = $user->lastName;
                        $LinkedinData['Linkkedin']['linkedin_profilerequesturl'] = $user->siteStandardProfileRequest->url;
                        if (isset($user_picture)) {
                            $LinkedinData['Linkkedin']['linkedin_profile_image'] = $user_picture;
                        }
                        if ($this->Linkkedin->save($LinkedinData, array('validate' => false))) {
// echo"done";die;
                        }
                    }
                }

                if (isset($_GET['redirect_uri']) and !empty($_GET['redirect_uri'])) {
                    header("Location: " . $_GET['redirect_uri']);
                } else {
                    if ($finduser['User']['type'] == 'normal') {
                        $this->redirect(array('controller' => 'dashboard', 'action' => 'schedulepost'));
                    } elseif ($finduser['User']['type'] == 'scheduler') {
                        $this->redirect(array('controller' => 'PostScheduler', 'action' => 'schedulepost'));
                    } elseif ($finduser['User']['type'] == 'agency') {
                        $this->redirect(array('controller' => 'Agency', 'action' => 'schedulepost'));
                    }
                }
            } elseif (($linkedin_count == $linkedin_maximum_limit) && isset($linkd_exist_in_linkedin) && !empty($linkd_exist_in_linkedin)) {
                $LinkData['User']['linkedin_oauth_access_token'] = $_SESSION['access_token'];
                $LinkData['User']['linkedin_firstname'] = $user->firstName;
                $LinkData['User']['linkedin_lastname'] = $user->lastName;
                $LinkData['User']['linkedin_profilerequesturl'] = $user->siteStandardProfileRequest->url;
                if (isset($user_picture)) {
                    $LinkData['User']['linkedin_profile_image'] = $user_picture;
                }
                $this->User->id = $finduser['User']['id'];
                if ($this->User->save($LinkData, array('validate' => false))) {
                    if ($finduser['User']['type'] == 'normal') {
                        $this->redirect(array('controller' => 'dashboard', 'action' => 'schedulepost'));
                    } elseif ($finduser['User']['type'] == 'scheduler') {
                        $this->redirect(array('controller' => 'PostScheduler', 'action' => 'schedulepost'));
                    } elseif ($finduser['User']['type'] == 'agency') {
                        $this->redirect(array('controller' => 'Agency', 'action' => 'schedulepost'));
                    }
                }
            } else {
                unset($_SESSION['access_token']);
                unset($_SESSION['expires_in']);
                unset($_SESSION['expires_at']);
                unset($_SESSION['state']);
                echo $this->Session->setFlash("You Have Exceeded the Limit of Your Linkedin Accounts!! Kindly Login withOne of Your " . $linkedin_maximum_limit . " Previous Previous Used Accounts.", 'error');
                if ($finduser['User']['type'] == 'normal') {
                    $this->redirect(array('controller' => 'dashboard', 'action' => 'schedulepost'));
                } elseif ($finduser['User']['type'] == 'scheduler') {
                    $this->redirect(array('controller' => 'PostScheduler', 'action' => 'schedulepost'));
                } elseif ($finduser['User']['type'] == 'agency') {
                    $this->redirect(array('controller' => 'Agency', 'action' => 'schedulepost'));
                }
            }
        }
// $this->redirect(array('controller' => 'social', 'action' => 'index'));
    }

}
