<?php

class SkillsController extends AppController {
    /* Skills Webadmin Add Function */

    public function webadmin_add() {
        $this->layout = 'admin_main';
        $this->loadModel('Category');

        if ($this->request->is('post')) {
            if ($this->Skill->validates()) {
                if ($this->Skill->save($this->request->data)) {
                    $this->Session->setFlash('Skills Inserted Successfully', 'success');
                    $this->redirect(array('controller' => 'skills', 'action' => 'index'));
                }
            } else {
                $this->Skill->validationErrors;
            }
        }
    }

    /* Skills Webadmin Index Function */

    public function webadmin_index() {
        $this->layout = 'admin_main';
        if (!empty($this->request->data)) {
            if (!empty($this->request->data['Skill']['search'])) {
                $this->paginate = array('limit' => 4, 'conditions' => array('OR' => array('Skill.name' => $this->request->data['Skill']['search'])), 'order' => array('Skill.id' => 'asc'));
                $search = $this->paginate('Skill');
                $this->set('blog', $search);
                $text = $this->request->data['Skill']['search'];
                $this->set('text', $text);
            } else {
                $this->paginate = array('limit' => 4);
                $search = $this->paginate('Skill');
                $this->set('blog', $search);
            }
        } else {
            $this->paginate = array('limit' => 4);
            $search = $this->paginate('Skill');
            $this->set('blog', $search);
            //pr($search);
        }
    }

    /* Skills Webadmin Change Status Function */

    public function webadmin_change_status($id) {
        $this->autoRender = false;
        $skill_data = $this->Skill->find('first', array('conditions' => array('Skill.id' => $id)));
        if ($skill_data['Skill']['status'] == '1') {
            $skill_status = '0';
        } else {
            $skill_status = '1';
        }
        $this->request->data['Skill']['status'] = $skill_status;
        $this->Skill->id = $id;
        if ($this->Skill->save($this->request->data)) {
            $this->Session->setFlash('Skills Status Changed Successfully', 'success');
            $this->redirect(array('controller' => 'skills', 'action' => 'index'));
        }
    }

    /* Skills Webadmin Changeselectall Function */

    public function webadmin_changeselectall() {
        $this->autoRender = false;
        if (!empty($this->request->data)) {
            $catar = $this->request->data['Skill']['chk1'];
            if ($this->request->data['Skill']['select'] == 'active') {
                foreach ($catar as $v) {
                    $this->request->data['Skill']['status'] ='1';
                    $this->Skill->id = $v;
                    $this->Skill->save($this->request->data);
                }
                $this->Session->setFlash('Skills Status Activated Successfully', 'success');
            } elseif ($this->request->data['Skill']['select'] == 'inactive') {
                foreach ($catar as $v) {
                    $this->request->data['Skill']['status'] = '0';
                    $this->Skill->id = $v;
                    $this->Skill->save($this->request->data);
                }
                $this->Session->setFlash('Skills Status Inactivated successfully','success');
            } elseif ($this->request->data['Skill']['select'] == 'delete') {
                foreach ($catar as $v) {
                    $this->Skill->delete($v);
                }
                $this->Session->setFlash('Subcategory Deleted Successfully', 'success');
            }
            $this->redirect(array('controller' => 'skills', 'action' => 'index'));
        }
    }

    /* Skills Webadmin Edit Function */

    public function webadmin_edit($skill_id = null) {
        $this->layout = 'admin_main';
        $this->loadModel('Category');

        $skill_data_value = $this->Skill->find('first', array('conditions' => array('Skill.id' => $skill_id)));
        $this->set('skill_value', $skill_data_value);
        if ($this->request->is('post')) {
            $this->set($this->request->data);
            $this->Skill->id = $skill_id;
            if ($this->Skill->save($this->request->data)) {
                $this->Session->setFlash('Skills Updated Successfully', 'success');
                $this->redirect(array('controller' => 'skills', 'action' => 'index'));
            }
        }
    }

    /* Skills Webadmin Delete Function */
    public function webadmin_delete($id) {
        $this->autoRender = false;
        $this->Skill->delete($id);
        $this->Session->setFlash('Skills Deleted Successfully', 'success');
        $this->redirect(array('controller' => 'skills', 'action' => 'index'));
    }

}
