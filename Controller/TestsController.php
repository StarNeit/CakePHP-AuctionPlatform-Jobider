<?php

class TestsController extends AppController {
    /*     * ****************Test Module******************** */

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('chek_question', 'chek_topic');
    }

    /* Tests Web-admin Index Function */

    public function webadmin_index() {
        $this->layout = 'admin_main';
        $this->loadModel('Test');
        if (!empty($this->request->data)) {
            if (!empty($this->request->data['Test']['search'])) {
                $this->paginate = array('limit' => 5, 'conditions' => array('OR' => array('Test.title' => $this->request->data['Test']['search'])), 'order' => array('Test.id' => 'asc'));
                $search = $this->paginate('Test');
                $this->set('blog', $search);
                $text = $this->request->data['Test']['search'];
                $this->set('text', $text);
            } else {
                $this->paginate = array('limit' => 5);
                $search = $this->paginate('Test');
                $this->set('blog', $search);
            }
        } else {
            $this->paginate = array('limit' => 5);
            $search = $this->paginate('Test');
            $this->set('blog', $search);
        }
    }

    /* Tests Webadmin Add Function */

    public function webadmin_add() {
        $this->layout = 'admin_main';
        $this->loadModel('Test');
        $this->loadModel('Category');
        $category = $this->Category->find('list', array('conditions' => array('Category.status' => 1)));
        $this->set('data', $category);
        if ($this->request->is('post')) {
            $this->set($this->request->data);
            if ($this->Test->save($this->request->data)) {
                $this->Session->setFlash('Test Added  successfully', 'success');
                $this->redirect(array('controller' => 'tests', 'action' => 'index'));
            }
        }
    }

    /* Tests Webadmin Change Status Function */

    public function webadmin_change_status($id) {
        $this->autoRender = false;
        $page_data = $this->Test->findById($id);
        if ($page_data['Test']['status'] == '1') {
            $page_status = '0';
        } else {
            $page_status = '1';
        }
        $this->request->data['Test']['status'] = $page_status;
        $this->Test->id = $id;
        $this->set($this->request->data);
        if ($this->Test->save($this->request->data)) {
            $this->Session->setFlash('Test Status Changed Successfully', 'success');
            $this->redirect(array('controller' => 'tests', 'action' => 'index'));
        }
    }

    /* Tests Webadmin Changeselectall Function */

    public function webadmin_changeselectall() {
        $this->autoRender = false;
        $this->loadModel('Test');
        if (!empty($this->request->data)) {
            $catr = $this->request->data['Test']['chk1'];
            if ($this->request->data['Test']['select'] == 'active') {
                foreach ($catr as $v) {
                    $this->request->data['Test']['status'] = '1';
                    $this->Test->id = $v;
                    $this->Test->save($this->request->data);
                }
                $this->Session->setFlash(' Status Activated Successfully', 'success');
            } elseif ($this->request->data['Test']['select'] == 'inactive') {
                foreach ($catr as $v) {
                    $this->request->data['Test']['status'] = '0';
                    $this->Test->id = $v;
                    $this->Test->save($this->request->data);
                }
                $this->Session->setFlash(' Status Inactivated Successfully', 'success');
            } elseif ($this->request->data['Test']['select'] == 'delete') {
                foreach ($catr as $v) {
                    $this->Test->delete($v);
                }
                $this->Session->setFlash('Deleted Successfully', 'success');
            }
            $this->redirect(array('controller' => 'tests', 'action' => 'index'));
        }
    }

    /* Tests Webadmin Delete Function */

    public function webadmin_delete($id) {
        $this->autoRender = false;
        $this->Test->delete($id);
        $this->Session->setFlash('Pages Deleted Successfully', 'success');
        $this->redirect(array('controller' => 'tests', 'action' => 'index'));
    }

    /* Tests Webadmin Edit Function */
    public function webadmin_edit($id = null) {
        $this->layout = 'admin_main';
        $this->loadModel('Category');
        $category_data = $this->Category->find('list', array('conditions' => array('Category.status' => 1), 'fields' => array('Category.name')));
        $this->set('data', $category_data);
        $value = $this->Test->find('first', array('conditions' => array('Test.id' => $id)));
        $this->set('blog', $value);
        if (empty($this->request->data)) {
            $this->request->data = $this->Test->read();
        } else {
            $this->Test->id = $id;
            $this->set($this->request->data);
            if ($this->Test->save($this->request->data)) {
                $this->Session->setFlash('Details Updated Successfully', 'success');
                $this->redirect(array('controller' => 'tests', 'action' => 'index'));
            }
        }
    }

    /*     * ******************END TEST MODULE******************** */

    /*     * *****************TEST CONTENT Module******************* */

    /* Tests Webadmin Add Test Contents  Function */

    public function webadmin_addtestcontents() {
        $this->layout = 'admin_main';
        $this->loadModel('Test');
        $this->loadModel('Testcontent');
        $this->loadModel('Category');
        $category = $this->Category->find('list', array('conditions' => array('Category.status' => 1)));
        $tests = $this->Test->find('list', array('conditions' => array('Test.status' => 1)));
        $this->set('test', $tests);
        $this->set('data', $category);
        if ($this->request->is('post')) {
            $this->set($this->request->data);
//            pr($this->request->data);
//            die('ashgdasgd');
            if ($this->Testcontent->save($this->request->data)) {
                $this->Session->setFlash('Test content Added  Successfully', 'success');
                $this->redirect(array('controller' => 'tests', 'action' => 'managetestcontent', $this->request->data['Testcontent']['test_id']));
            }
        }
    }

    /*     * **************Tests Check Function************** */

    function chek() {
        $this->autoRender = false;
        $this->loadModel('Test');
        $find = $this->Test->find('all', array('conditions' => array('Test.category_id' => $_POST['category'])));
        if ($find) {
            $test = "<select name='data[Testcontent][test_id]' class= 'form-control' >";
            $test.='<option value="">Select the Test</option>';
            foreach ($find as $k => $v) {
                $test .= '<option value=' . $v['Test']['id'] . '>' . $v['Test']['title'] . '</option>';
            }
            $test.= "</select>";
        }
        $arr['suc'] = 'yes';
        $arr['provide'] = $test;
        echo json_encode($arr);
    }

    /* Tests Webadmin Edit Test Content Function */

    public function webadmin_edittestcontent($id = NULL) {
        $this->layout = 'admin_main';
        $this->loadModel('Category');
        $this->loadModel('Test');
        $this->loadModel('Testcontent');
        $category = $this->Category->find('list', array('conditions' => array('Category.status' => 1)));
        $Test_data = $this->Test->find('list', array('fields' => 'Test.title'));
        $us_data = $this->Testcontent->find('first', array('conditions' => array('Testcontent.id' => $id)));
        $this->set('data', $Test_data);
        $this->set('category', $category);
        $this->set('user_data', $us_data);
        if ($this->request->is('post')) {
            $this->set($this->request->data);
            $this->Testcontent->id = $id;
            if ($this->Testcontent->save($this->request->data)) {
     $this->Session->setFlash('Test content Updated Successfully', 'success');
                $this->redirect(array('controller' => 'tests', 'action' => 'managetestcontent/' . $us_data['Testcontent']['test_id']));
            }
        }
    }

    public function edit_testcontent_ajax() {
        $this->autoRender = false;
        $this->loadModel('Test');
        $find = $this->Test->find('all', array('conditions' => array('Test.category_id' => $_POST['provider'])));
        if (!empty($find)) {
            $test = " <label for='exampleInputPassword1'>Select Test</label><select name='data[Testcontent][test_id]' class= 'form-control ' ><option value=''>Select Test</option>";
            foreach ($find as $k => $v) {
                $test .= '<option value=' . $v['Test']['id'] . '>' . $v['Test']['title'];
            }
              $arr['provide'] = $test;
               $arr['suc'] = 'yes';
        }else{
              $arr['suc'] = 'no';
        }
      
      
        echo json_encode($arr);
    }

    /* Tests Webadmin Manage Test Content Function */

    public function webadmin_managetestcontent($id = null) {
        $this->layout = 'admin_main';
        $this->loadModel('Test');
        $this->loadModel('Testcontent');
        $name = $this->Test->find('first', array('conditions' => array('Test.id' => $id)));
        $this->set('title', $name);
        if (!empty($this->request->data)) {
            if (!empty($this->request->data['Testcontent']['search'])) {
                $this->paginate = array('limit' => 4, 'conditions' => array('OR' => array('Testcontent.test_content LIKE' => '%' . $this->request->data['Testcontent']['search'] . '%')), 'AND' => array('Testcontent.test_id' => $id), 'order' => array('Testcontent.id' => 'asc'));
                $search = $this->paginate('Testcontent');
                $this->set('blog', $search);
                $text = $this->request->data['Testcontent']['search'];
                $this->set('text', $text);
            } else {
                $this->paginate = array('limit' => 4, 'conditions' => array('Testcontent.test_id' => $id));
                $search = $this->paginate('Testcontent');
                $this->set('blog', $search);
            }
        } else {
            $this->paginate = array('limit' => 4, 'conditions' => array('Testcontent.test_id' => $id));
            $search = $this->paginate('Testcontent');
            $this->set('blog', $search);
        }
    }

    /* Tests Webadmin Change Status  Test Content Function */

    public function webadmin_change_status_testcontent($id) {
        $this->autoRender = false;
        $this->loadModel('Testcontent');
        $data_value = $this->Testcontent->find('first', array('conditions' => array('Testcontent.id' => $id)));
        if ($data_value['Testcontent']['status'] == '1') {
            $us = '0';
        } else {
            $us = '1';
        }
        $this->request->data['Testcontent']['status'] = $us;
        $this->Testcontent->id = $id;
        $this->set($this->request->data);
        $this->Testcontent->save($this->request->data);
        $this->redirect(array('controller' => 'tests', 'action' => 'managetestcontent/' . $data_value['Testcontent']['test_id']));
    }

    /* Tests Webadmin Delete Test Content Function */

    public function webadmin_deletetestcontent($id) {
        $this->autoRender = false;
        $this->loadModel('Testcontent');
        $jobdata = $this->Testcontent->find('first', array('conditions' => array('Testcontent.id' => $id)));
        //	pr($jobdata); die;
        $this->Testcontent->delete($id);
        $this->Session->setFlash('Test Content Deleted Successfully', 'success');
        $this->redirect(array('controller' => 'tests', 'action' => 'managetestcontent', $jobdata['Testcontent']['test_id']));
    }

    /* Tests Webadmin Changeselectall Test Content Function */

    public function webadmin_changeselectalltestcontent($id) {
        $this->autoRender = false;
        $this->loadModel('Test');
        $this->loadModel('Testcontent');
        if (!empty($this->request->data)) {
            $catr = $this->request->data['Testcontent']['chk1'];
            if ($this->request->data['Testcontent']['select'] == 'active') {
                foreach ($catr as $v) {
                    $this->request->data['Testcontent']['status'] = '1';
                    $this->Testcontent->id = $v;
                    $this->Testcontent->save($this->request->data);
                }
                $this->Session->setFlash('Test Content Status Activated Successfully', 'success');
            } elseif ($this->request->data['Testcontent']['select'] == 'inactive') {
                foreach ($catr as $v) {
                    $this->request->data['Testcontent']['status'] = '0';
                    $this->Testcontent->id = $v;
                    $this->Testcontent->save($this->request->data);
                }
                $this->Session->setFlash('Test Content Status Inactivated Successfully', 'success');
            } elseif ($this->request->data['Testcontent']['select'] == 'delete') {
                foreach ($catr as $v) {
                    $this->Testcontent->delete($v);
                }
                $this->Session->setFlash('Test Content Deleted Successfully', 'success');
            }
            $this->redirect(array('controller' => 'tests', 'action' => 'managetestcontent', $id));
        }
    }

    /* Tests Webadmin Show Data Function */

    public function webadmin_showdata() {
        $this->layout = 'popup_model';
        $this->loadModel('Testcontent');
        $this->loadModel('Category');
        $this->loadModel('Test');
        $t_id = $_POST['select'];
        $test_data = $this->Testcontent->find('first', array('conditions' => array('Testcontent.id' => $t_id)));
        $this->Category->recursive = -1;
        $cate = $this->Category->find('first', array('conditions' => array('Category.id' => $test_data['Testcontent']['category_id'])));
        $test = $this->Test->find('first', array('conditions' => array('Test.id' => $test_data['Testcontent']['test_id'])));
        $this->set('faq_data', $test_data);
        $this->set('cat_name', $cate);
        $this->set('test', $test);
    }

    /* Tests Webadmin Preview Function */

    public function webadmin_preview($id = null) {
        $this->autoRender = false;
        $this->loadModel('Testcontent');
        $found = $this->Testcontent->findById($id);
        if ($this->request->is('post')) {
            if ($found['Testcontent']['status'] == '1') {
                $use_status = '0';
            } else {
                $use_status = '1';
            }
            $this->request->data['Testcontent']['status'] = $use_status;
            $this->Testcontent->id = $id;
            if ($this->Testcontent->save($this->request->data)) {
                $this->Session->setFlash('Test Status Changed Successfully', 'success');
                $this->redirect(array('controller' => 'tests', 'action' => 'managetestcontent', $found['Testcontent']['test_id']));
            }
        }
    }

    /*     * **************END TEST CONTENT Module**************** */

    /*     * *****************QUESTIONS  Module************************ */

    public function webadmin_addQuestions() {
        $this->layout = 'admin_main';
        $this->loadModel('Category');
        $this->loadModel('Question');
        $this->loadModel('Test');
        $this->loadModel('Testcontent');
        $category = $this->Category->find('list');
        $Tests = $this->Test->find('list');
        $this->set('data', $category);
        $this->set('test', $Tests);
        if ($this->request->is('post')) {
            $options_data = implode(',', $this->request->data['Question']['options']);
            $answers_data = implode(',', $this->request->data['Question']['answers']);
            $this->request->data['Question']['options'] = $options_data;
            $this->request->data['Question']['answers'] = $answers_data;
            $this->request->data['Question']['time_spent'] = time();
            $this->set($this->request->data);
            if ($this->Question->save($this->request->data)) {
                $this->Session->setFlash('Question added Successfully', 'success');
                $this->redirect(array('controller' => 'tests', 'action' => 'manageQuestions'));
            }
        }
    }

    public function chek_question() {
        $this->autoRender = false;
        $this->loadModel('Test');
        $find = $this->Test->find('all', array('conditions' => array('Test.category_id' => $_POST['provider'])));
        if (!empty($find)) {
            $test = " <label for='exampleInputPassword1'>Select Test</label><select name='data[Question][test_id]' class= 'form-control test' ><option value=''>Select Test</option>";
            foreach ($find as $k => $v) {
                $test .= '<option value=' . $v['Test']['id'] . '>' . $v['Test']['title'];
            }
        }
        $arr['suc'] = 'yes';
        $arr['provide'] = $test;
        echo json_encode($arr);
    }

    public function chek_topic() {
        $this->autoRender = false;
        $this->loadModel('Testcontent');
        $find = $this->Testcontent->find('all', array('conditions' => array('Testcontent.test_id' => $_POST['topic'])));
        if (!empty($find)) {
            $test = " <label for='exampleInputPassword1'>Select Topic</label><select name='data[Question][topic_id]' class= 'form-control testcontent' ><option value=''>Select Topic</option>";
            foreach ($find as $k => $v) {
                $test .= '<option value=' . $v['Testcontent']['id'] . '>' . $v['Testcontent']['test_content'];
            }
        }
        $arr['suc'] = 'yes';
        $arr['topic'] = $test;
        echo json_encode($arr);
    }

    public function edit_question1() {
        $this->autoRender = false;
        $this->loadModel('Test');
        $find = $this->Test->find('all', array('conditions' => array('Test.category_id' => $_POST['provider'])));
        if (!empty($find)) {
            $test = " <label for='exampleInputPassword1'>Select Test</label><select name='data[Question][test_id]' class= 'form-control test' ><option value=''>Select Test</option>";
            foreach ($find as $k => $v) {
                $test .= '<option value=' . $v['Test']['id'] . '>' . $v['Test']['title'];
            }
        }
        $arr['suc'] = 'yes';
        $arr['provide'] = $test;
        echo json_encode($arr);
    }

    public function edit_topic1() {
        $this->autoRender = false;
        $this->loadModel('Testcontent');
        $find = $this->Testcontent->find('all', array('conditions' => array('Testcontent.test_id' => $_POST['topic'])));
        if (!empty($find)) {
            $test = " <label for='exampleInputPassword1'>Select Topic</label><select name='data[Question][topic_id]' class= 'form-control testcontent' ><option value=''>Select Topic</option>";
            foreach ($find as $k => $v) {
                $test .= '<option value=' . $v['Testcontent']['id'] . '>' . $v['Testcontent']['test_content'];
            }
        }
        $arr['suc'] = 'yes';
        $arr['topic'] = $test;
        echo json_encode($arr);
    }

    public function webadmin_manageQuestions() {
        $this->layout = 'admin_main';
        $this->loadModel('Question');
        if (!empty($this->request->data)) {
            if (!empty($this->request->data['Question']['search'])) {
                $this->paginate = array('limit' => 5, 'conditions' => array('OR' => array('Question.name  LIKE' => '%' . $this->request->data['Question']['search'] . '%')), 'order' => array('Question.id' => 'asc'));
                $search = $this->paginate('Question');
                $this->set('blog', $search);
                $text = $this->request->data['Question']['search'];
                $this->set('text', $text);
            } else {
                $this->paginate = array('limit' => 5);
                $search = $this->paginate('Question');
                $this->set('blog', $search);
            }
        } else {
            $this->paginate = array('limit' => 5);
            $search = $this->paginate('Question');
            $this->set('blog', $search);
        }
    }

    public function webadmin_changeselectall_question() {
        $this->autoRender = false;
        $this->loadModel('Question');
        if (!empty($this->request->data)) {
            $catr = $this->request->data['Question']['chk1'];
            if ($this->request->data['Question']['select'] == 'active') {
                foreach ($catr as $v) {
                    $this->request->data['Question']['status'] = '1';
                    $this->Question->id = $v;
                    $this->Question->save($this->request->data);
                }
                $this->Session->setFlash(' Status Activated Successfully', 'success');
            } elseif ($this->request->data['Question']['select'] == 'inactive') {
                foreach ($catr as $v) {
                    $this->request->data['Question']['status'] = '0';
                    $this->Question->id = $v;
                    $this->Question->save($this->request->data);
                }
                $this->Session->setFlash(' Status Inactivated Successfully', 'success');
            } elseif ($this->request->data['Question']['select'] == 'delete') {
                foreach ($catr as $v) {
                    $this->Question->delete($v);
                }
                $this->Session->setFlash('Deleted Successfully', 'success');
            }
            $this->redirect(array('controller' => 'tests', 'action' => 'manageQuestions'));
        }
    }

    public function webadmin_change_status_question($id) {
        $this->autoRender = false;
        $this->loadModel('Question');
        $page_data = $this->Question->findById($id);
        if ($page_data['Question']['status'] == '1') {
            $page_status = '0';
        } else {
            $page_status = '1';
        }
        $this->request->data['Question']['status'] = $page_status;
        $this->Question->id = $id;
        $this->set($this->request->data);
        if ($this->Question->save($this->request->data)) {
            $this->Session->setFlash('Question Status Changed Successfully', 'success');
            $this->redirect(array('controller' => 'tests', 'action' => 'manageQuestions'));
        }
    }

    public function webadmin_delete_question($id) {
        $this->autoRender = false;
        $this->loadModel('Question');
        $this->Question->delete($id);
        $this->Session->setFlash('Question Deleted Successfully', 'success');
        $this->redirect(array('controller' => 'tests', 'action' => 'manageQuestions'));
    }

    public function webadmin_edit_question($id = null) {
        $this->layout = 'admin_main';
        $this->loadModel('Category');
        $this->loadModel('Test');
        $this->loadModel('Testcontent');
        $this->loadModel('Question');
        $category_data = $this->Category->find('list', array('conditions' => array('Category.status' => 1), 'fields' => array('Category.name')));
        $Tests = $this->Test->find('list');
        $topics = $this->Testcontent->find('list', array('fields' => array('Testcontent.test_content')));
        $this->set('data', $category_data);
        $this->set('test', $Tests);
        $this->set('test_topic', $topics);
        $value = $this->Question->find('first', array('conditions' => array('Question.id' => $id)));
        $test_id = $value['Question']['test_id'];
        $test_find = $this->Test->find('first', array('conditions' => array('Test.id' => $test_id)));
        //  $title = $test_find['Test']['title'];
        $this->set('test_title', $test_find);
        $opt = explode(',', $value['Question']['options']);
        $this->set('option', $opt);
        $this->set('blog', $value);
        if (empty($this->request->data)) {
            $this->request->data = $this->Question->read();
        } else {
            $this->Question->id = $id;
            $options_data = implode(',', $this->request->data['Question']['options']);
            $answers_data = implode(',', $this->request->data['Question']['answers']);
            $this->request->data['Question']['options'] = $options_data;
            $this->request->data['Question']['answers'] = $answers_data;
            $this->request->data['Question']['time_spent'] = time();
            $this->set($this->request->data);
//            pr($this->request->data);
//            die('ashdgasdj');
            if ($this->Question->save($this->request->data)) {
                $this->Session->setFlash('Details Updated Successfully', 'success');
                $this->redirect(array('controller' => 'tests', 'action' => 'manageQuestions'));
            }
        }
    }

}