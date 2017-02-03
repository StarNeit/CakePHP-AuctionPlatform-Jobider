<?php

App::uses('CakeEmail', 'Network/Email');

class PagesController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('aboutus', 'contactus', 'clientresource', 'howitworks', 'press', 'feedback', 'termsofservices', 'privacy', 'guidelines', 'client_policies', 'freelancer_policies', 'client_guidelines', 'freelancer_guidelines', 'Hourly_rates', 'Cookies_policy', 'clientmanuals', 'benefits');
    }

    //*****************BACKEND PANEL*********************//
    /* Pages Webadmin Index Function */
    public function webadmin_index() {
        $this->layout = 'admin_main';
        $this->loadModel('Page');
        if (!empty($this->request->data)) {
            if (!empty($this->request->data['Page']['search'])) {
//                pr($this->request->data['Page']['search']);
//                die('hhdcfjsdj');
                $this->paginate = array('limit' => 5, 'conditions' => array('OR' => array('Page.title' => $this->request->data['Page']['search'], 'Page.name' => $this->request->data['Page']['search'])), 'order' => array('Page.id' => 'asc'));
                $search = $this->paginate('Page');
                $this->set('blog', $search);
                $text = $this->request->data['Page']['search'];
                $this->set('text', $text);
            } else {
                $this->paginate = array('limit' => 5);
                $search = $this->paginate('Page');
                $this->set('blog', $search);
            }
        } else {
            $this->paginate = array('limit' => 5);

            $search = $this->paginate('Page');
            $this->set('blog', $search);
        }
    }

    /* Pages Webadmin Add Function */

    public function webadmin_add() {
        $this->layout = 'admin_main';
        $this->loadModel('Page');
        if ($this->request->is('post')) {

            $slug = preg_replace("/-$/", "", preg_replace('/[^a-z0-9]+/i', "_", strtolower($this->request->data['Page']['name'])));
            $this->request->data['Page']['name'] = $slug;
            $this->request->data['Page']['description'] = $this->request->data['Page']['editor1'];
            $this->request->data['Page']['image'] = time() . '_' . $this->request->data['Page']['image_name']['name'];
            if (move_uploaded_file($this->request->data['Page']['image_name']['tmp_name'], WWW_ROOT . 'uploads/' . time() . '_' . $this->request->data['Page']['image_name']['name']))
                $this->set($this->request->data);
            if ($this->Page->save($this->request->data)) {
                $this->Session->setFlash('Pages are insert successfully', 'success');
                $this->redirect(array('controller' => 'pages', 'action' => 'index'));
            }
        }
    }

    /* Pages Webadmin Edit Function */

    public function webadmin_edit($id = null) {
        $this->layout = 'admin_main';
        $value = $this->Page->find('first', array('conditions' => array('Page.id' => $id)));
        $this->set('blog', $value);
        if ($this->request->is('post')) {
            $this->Page->set($this->request->data);
            $slug = preg_replace("/-$/", "", preg_replace('/[^a-z0-9]+/i', "_", strtolower($this->request->data['Page']['name'])));
            $this->request->data['Page']['name'] = $slug;
            $this->request->data['Page']['description'] = $this->request->data['Page']['editor1'];
            if (!empty($this->request->data['Page']['file']['name'])) {
                $this->request->data['Page']['image'] = time() . '_' . $this->request->data['Page']['file']['name'];
                move_uploaded_file($this->request->data['Page']['file']['tmp_name'], WWW_ROOT . 'uploads/' . time() . '_' . $this->request->data['Page']['file']['name']);
            }


            $this->Page->id = $id;
            $this->set($this->request->data);
            if ($this->Page->save($this->request->data)) {
                $this->Session->setFlash('Abouts Updated Successfully', 'success');
                $this->redirect(array('controller' => 'pages', 'action' => 'index'));
            }
        }
    }

    /* Pages Webadmin Change Status Function */

    public function webadmin_change_status($id) {
        $this->autoRender = false;
        $page_data = $this->Page->findById($id);
        if ($page_data['Page']['status'] == '1') {
            $page_status = '0';
        } else {
            $page_status = '1';
        }
        $this->request->data['Page']['status'] = $page_status;
        $this->Page->id = $id;
        $this->set($this->request->data);
        if ($this->Page->save($this->request->data)) {
            $this->Session->setFlash('Page Status Changed Successfully', 'success');
            $this->redirect(array('controller' => 'pages', 'action' => 'index'));
        }
    }

    /* Pages Webadmin Changeselectall Function */

    public function webadmin_changeselectall() {
        $this->autoRender = false;
        if (!empty($this->request->data)) {
            $cater = $this->request->data['Page']['chk1'];
            if ($this->request->data['Page']['select'] == 'active') {
                foreach ($cater as $val) {
                    $this->request->data['Page']['status'] = '1';
                    $this->Page->id = $val;
                    $this->Page->save($this->request->data);
                }
                $this->Session->setFlash('Page Status Active Successfully', 'success');
            } elseif ($this->request->data['Page']['select'] == 'inactive') {
                foreach ($cater as $val) {
                    $this->request->data['Page']['status'] = '0';
                    $this->Page->id = $val;
                    $this->Page->save($this->request->data);
                }
                $this->Session->setFlash('Page Status Inactive Successfully', 'success');
            } elseif ($this->request->data['Page']['select'] == 'delete') {
                foreach ($cater as $val) {
                    $this->Page->delete($val);
                }
                $this->Session->setFlash('Pages Deleted Successfully', 'success');
            }
            $this->redirect(array('controller' => 'pages', 'action' => 'index'));
        }
    }

    /* Pages Webadmin Delete Function */

    public function webadmin_delete($id) {
        $this->autoRender = false;
        $this->Page->delete($id);
        $this->Session->setFlash('Pages Deleted Successfully', 'success');
        $this->redirect(array('controller' => 'pages', 'action' => 'index'));
    }

    /* Pages Webadmin Address Function */

    public function webadmin_address($id = NULL) {
        $this->layout = 'admin_main';
        $this->loadModel('Address');
        $category_data = $this->Address->find('first', array('conditions' => array('Address.id' => $id)));
        $this->set('data', $category_data);
        if (empty($this->request->data)) {
            $this->request->data = $this->Address->read();
        } else {
            $this->Address->id = $id;
            $this->set($this->request->data);
            if ($this->Address->save($this->request->data)) {
                $this->Session->setFlash('Address Detail Updated Successfully', 'success');
                $this->redirect(array('controller' => 'pages', 'action' => 'address/1'));
            }
        }
    }

    /* Pages Webadmin Feedback Detail Function */

    public function webadmin_feedbackdetail() {
        $this->layout = 'admin_main';
        $this->loadModel('Feedback');
        if (!empty($this->request->data)) {
            if (!empty($this->request->data['Feedback']['search'])) {
                $this->paginate = array('limit' => 2, 'conditions' => array('OR' => array('Feedback.name' => $this->request->data['Feedback']['search'], 'Feedback.email' => $this->request->data['Feedback']['search'])), 'order' => array('Feedback.id' => 'asc'));
                $feedback_Info = $this->paginate('Feedback');
                $this->set('blog', $feedback_Info);
                $text = $this->request->data['Feedback']['search'];
                $this->set('text', $text);
            } else {
                $this->paginate = array('limit' => 10);
                $search = $this->paginate('Feedback');
                $this->set('blog', $search);
            }
        } else {
            $this->paginate = array('limit' => 10);
            $feedback_Info = $this->paginate('Feedback');
            $this->set('blog', $feedback_Info);
        }
    }

    /* Pages Webadmin Reply Function */

    public function webadmin_reply($id = NULL) {
        $this->layout = 'admin_main';
        $this->loadModel('Feedback');
        $find = $this->Feedback->findById($id);
        $this->set('value', $find);
        if (!empty($this->data)) {
            $to = $find['Feedback']['email'];
            $subject = 'Reply From Admin.';
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            // More headers//
            $headers .= 'From: <admin@Jobider.com>' . "\r\n";
            $message = $this->data['Feedback']['message'];
            mail($to, $subject, $message, $headers);
            $Success = 'Message Sent Successfully !';
            $this->set('success', $Success);
        } else {
            $error = 'Error Occured !';
            $this->set('error', $error);
        }
    }

    public function webadmin_feedback_delete($id) {
        $this->autoRender = false;
        $this->loadModel('Feedback');
        $this->Feedback->delete($id);
        $this->Session->setFlash('Feedback Deleted Successfully', 'success');
        $this->redirect(array('controller' => 'pages', 'action' => 'feedbackdetail'));
    }

    //*****************End Backend panel****************//
    //*****************FRONT END***************//
    /* Pages About Us Function */

    public function aboutus() {
        $this->layout = 'front';
         $this->set('title_for_layout', 'About us');
        $this->loadModel('Page');
        $about = $this->Page->find('first', array('conditions' => array('Page.id' => '8')));
        $this->set('about', $about);
    }

    /* Pages Contact Us Function */

    public function contactus() {
        $this->layout = 'front';
        $this->loadModel('Contact');
        $this->loadModel('Address');
        $this->loadModel('Admin');
        $adres = $this->Address->find('first', array('conditions' => array('Address.id' => '1')));
        $this->set('address', $adres);
        $admin_data = $this->Admin->find('first');
        if (!empty($this->request->data)) {
            if ($this->request->is('post')) {
                $data = $this->request->data;
                if ($this->Contact->Save($this->data)) {
                    $Email = new CakeEmail();
                    $Email->template('contact_us');
                    $Email->emailFormat('html');
                    $Email->viewVars(array('data' => $data['Contact']['message']));
                    $Email->from(array('Jobider@pnf.com' => $data['Contact']['name'] . ' via Jobider'));
                    $Email->to($data['Contact']['email']);
                    $Email->subject('Message From User ', 'success');
                    $Email->send();
                    $Email->template('contact_us');
                    $Email->emailFormat('html');
                    $Email->viewVars(array('data' => $data['Contact']['message']));
                    $Email->from(array('Jobider@pnf.com' => $data['Contact']['name'] . ' via Jobider'));
                    $Email->to($admin_data['Admin']['email']);
                    $Email->subject('Message From User ', 'success');
                    $Email->send();
                    $Success = 'Message Sent Successfully !';
                    $this->set('success', $Success);
                }
            }
        }
    }

    /* Pages Client Resource Function */

    public function clientresource() {
        $this->layout = 'front';
         $this->set('title_for_layout', 'Client Resource');
        $this->loadModel('Banner');
        $this->loadModel('Clientrecource');
        $page = $this->Page->find('first', array('conditions' => array('Page.id' => '13')));
        $this->set('page', $page);
        $Client_Recource = $this->Clientrecource->find('first', array('conditions' => array('Clientrecource.id' => '1', 'Clientrecource.status' => '1')));
        $this->set('Result', $Client_Recource);
    }

    /* Pages How It Works Function */

    public function howitworks1() {
        $this->layout = 'front';
        $this->loadModel('Page');
        $this->loadModel('Faqcontent');
        $this->loadModel('Faq');
        // $faqs = $this->Page->find('first', array('conditions' => array('Page.id' => 9)));
        $faqs = $this->Faq->find('all', array('field' => array('Faq.quesion', 'Faq.answer')));
        //$this->set('question', $questions);
        $this->set('faqs', $faqs);
    }

    public function howitworks() {
        $this->layout = 'front';
        $this->loadModel('Page');
        $this->loadModel('Faqcontent');
        $faqs = $this->Page->find('first', array('conditions' => array('Page.id' => 9)));
        $questions = $this->Faqcontent->find('all', array('field' => array('Faqcontent.quesion', 'Faqcontent.answer')));
        $this->set('question', $questions);
        $this->set('faqs', $faqs);
    }

    /* Pages Feedback Function */

    public function feedback() {
        $this->layout = 'front';
        $this->loadModel('Feedback');
        if (!empty($this->data)) {
            if ($this->data) {
                $this->set($this->data);
                if ($this->Feedback->Save($this->data)) {
                    $to = 'skamboj261@gmail.com';
                    $subject = 'Message From User';
                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    // More headers//
                    $headers .= 'From: <admin@Jobider.com>' . "\r\n";
                    $message = $this->data['Feedback']['comment'];
                    mail($to, $subject, $message, $headers);
                    $Success = 'Feedback Sent Successfully !';
                    $this->set('success', $Success);
                } else {
//                    $Error = 'Feedback Sending Failed !';
//                    $this->set('error', $Error);
                }
            }
        }
    }

    /* Pages Trust And Safety Function */

    /* Pages Press Function */

    public function press() {
        $this->layout = 'front';
        $this->loadModel('Media');
        $this->loadModel('Address');
//        $media_info = $this->Media->find('all', array('order' => 'Media.id desc'));
        $this->paginate = array('limit' => 5, 'order' => 'Media.id desc');
        $search = $this->paginate('Media');
//         pr($search);die;
//        $Site_email = $this->Address->find('first', array('conditions' => array('Address.id' => 1, 'Address.status' => '1'), 'fields' => array('Address.email')));
        if (!empty($search)) {
            $this->set('media_result', $search);
        }
//        $this->set('email_site', $Site_email);
    }

    /* Pages Terms Of Services Function */

    public function termsofservices() {
        $this->layout = 'front';
        $this->loadModel('Page');
        $terms = $this->Page->find('first', array('conditions' => array('Page.id' => 20, 'Page.status' => 1)));
        $this->set('Terms', $terms);
    }

    public function clientmanuals() {
        $this->layout = 'front';
        $this->loadModel('Page');
        $this->loadModel('Clientmanual');
        $manual = $this->Page->find('first', array('conditions' => array('Page.id' => 13, 'Page.status' => 1)));
        $Client_manual = $this->Clientmanual->find('all', array('fields' => array('Clientmanual.question', 'Clientmanual.answer')));
//       pr($Client_manual);
//       die('sadasdjhsaj');
//       pr($manual);die('here');
        $this->set('manual', $manual);
        $this->set('Result_manuals', $Client_manual);
    }

    /* Pages Privacy Function */

    public function privacy() {
        $this->layout = 'front';
        $this->loadModel('Page');
        $privacy = $this->Page->find('first', array('conditions' => array('Page.id' => 21, 'Page.status' => 1)));
        $this->set('Privacy_Result', $privacy);
    }

    public function guidelines() {
        $this->layout = 'front';
        $this->loadModel('Page');
        $guidelines = $this->Page->find('first', array('conditions' => array('Page.id' => 27)));
        $this->set('Guidelines', $guidelines);
    }

    public function client_policies() {
        $this->layout = 'front';
        $this->loadModel('Page');
        $client_policy = $this->Page->find('first', array('conditions' => array('Page.id' => 23)));
        $this->set('client_policy', $client_policy);
    }

    public function freelancer_policies() {
        $this->layout = 'front';
        $this->loadModel('Page');
        $freelancer_policy = $this->Page->find('first', array('conditions' => array('Page.id' => 24)));
        $this->set('freelancer_policy', $freelancer_policy);
    }

    public function client_guidelines() {
        $this->layout = 'front';
        $this->loadModel('Page');
        $client_guideline = $this->Page->find('first', array('conditions' => array('Page.id' => 25)));
        $this->set('client_guideline', $client_guideline);
    }

    public function freelancer_guidelines() {
        $this->layout = 'front';
        $this->loadModel('Page');
        $freelancer_guideline = $this->Page->find('first', array('conditions' => array('Page.id' => 26)));
        $this->set('freelancer_guideline', $freelancer_guideline);
    }

    public function Hourly_rates() {
        $this->layout = 'front';
        $this->loadModel('Page');
        $hourly = $this->Page->find('first', array('conditions' => array('Page.id' => 28, 'Page.status' => 1)));
        $this->set('Hourlyrates', $hourly);
    }

    public function Cookies_policy() {
        $this->layout = 'front';
        $this->loadModel('Page');
        $Cookie_data = $this->Page->find('first', array('conditions' => array('Page.id' => '29', 'Page.status' => '1')));
//        pr($Cookie_data);
//        die('sadjhajsdhj');
        $this->set('Cookie_Result', $Cookie_data);
    }

    //*******************End FrontEnd Panel*************************//
    //*******************How It Works Admin Panel*****************//
    public function webadmin_addquestions() {
        $this->layout = 'admin_main';
        $this->loadModel('Faqcontent');
        if ($this->request->is('post')) {
            if ($this->Faqcontent->save($this->request->data)) {
                $this->Session->setFlash('Faq content added successfully', 'success');
                $this->redirect('/webadmin/pages/managequestions');
            }
        }
    }

    public function webadmin_managequestions() {
        $this->layout = 'admin_main';
        $this->loadModel('Faqcontent');
        if (!empty($this->request->data)) {
            if (!empty($this->request->data['Faqcontent']['search'])) {
                $this->paginate = array('limit' => 5, 'conditions' => array('OR' => array('Faqcontent.question LIKE' => '%' . $this->request->data['Faqcontent']['search'] . '%')), 'order' => array('Faqcontent.id' => 'asc'));
                $search = $this->paginate('Faqcontent');
                $this->set('blog', $search);
                $text = $this->request->data['Faqcontent']['search'];
                $this->set('text', $text);
            } else {
                $this->paginate = array('limit' => 5);
                $search = $this->paginate('Faqcontent');
                $this->set('blog', $search);
            }
        } else {
            $this->paginate = array('limit' => 30);

            $search = $this->paginate('Faqcontent');
          
            $this->set('blog', $search);
        }
    }

    public function webadmin_editquestions($id) {
        $this->layout = 'admin_main';
        $this->loadModel('Faqcontent');
        $quest = $this->Faqcontent->find('first', array('conditions' => array('Faqcontent.id' => $id)));
        $this->set('quest', $quest);
        if ($this->request->is('post')) {
            $this->Faqcontent->id = $id;
            $this->set($this->request->data);
            if ($this->Faqcontent->save($this->request->data)) {
                $this->Session->setFlash('Faq content updated successfully', 'success');
                $this->redirect('/webadmin/pages/managequestions');
            }
        }
    }

    public function webadmin_change_ques_status($id) {
        $this->autoRender = FALSE;
        $this->loadModel('Faqcontent');
        $find = $this->Faqcontent->findById($id);
        if ($find['Faqcontent']['status'] == '1') {
            $faq_status = '0';
        } else {
            $faq_status = '1';
        }
        $this->request->data['Faqcontent']['status'] = $faq_status;
        $this->Faqcontent->id = $id;
        $this->set($this->request->data);
        if ($this->Faqcontent->save($this->request->data)) {
            $this->Session->setFlash('Status Changed Successfully', 'success');
            $this->redirect('/webadmin/pages/managequestions');
        }
    }

    public function webadmin_changeselectques() {
        $this->autoRender = false;
        $this->loadModel('Faqcontent');
        if (!empty($this->request->data)) {
            $cater = $this->request->data['Faqcontent']['chk1'];
            if ($this->request->data['Faqcontent']['select'] == 'active') {
                foreach ($cater as $val) {
                    $this->request->data['Faqcontent']['status'] = '1';
                    $this->Faqcontent->id = $val;
                    $this->Faqcontent->save($this->request->data);
                }
                $this->Session->setFlash('Faq Status Active Successfully', 'success');
            } elseif ($this->request->data['Faqcontent']['select'] == 'inactive') {
                foreach ($cater as $val) {
                    $this->request->data['Faqcontent']['status'] = '0';
                    $this->Faqcontent->id = $val;
                    $this->Faqcontent->save($this->request->data);
                }
                $this->Session->setFlash('Faq Status Inactive Successfully', 'success');
            } elseif ($this->request->data['Faqcontent']['select'] == 'delete') {
                foreach ($cater as $val) {
                    $this->Faqcontent->delete($val);
                }
                $this->Session->setFlash('Faqs Deleted Successfully', 'success');
            }
            $this->redirect(array('controller' => 'pages', 'action' => 'managequestions'));
        }
    }

    public function webadmin_deletequestions($id) {
        $this->autoRender = false;
        $this->loadModel('Faqcontent');
        $this->Faqcontent->delete($id);
        $this->Session->setFlash('Faq Content Deleted Successfully', 'success');
        $this->redirect('/webadmin/pages/managequestions');
    }

    public function benefits() {
        $this->layout = 'front';
         $this->set('title_for_layout', 'Benefits');
    }

}
