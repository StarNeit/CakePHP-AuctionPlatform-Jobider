<?php

class SubskillsController extends AppController {
    /* Subskills Webadmin Add Function */

    public function webadmin_add() {
        $this->layout = 'admin_main';
        $this->loadModel('Skill');
        $skill_data = $this->Skill->find('list', array('fields' => 'Skill.name'));
        $this->set('data', $skill_data);
        if ($this->request->is('post')) {
            if ($this->Subskill->save($this->request->data)) {
                $this->Session->setFlash('Subskills Added Successfully', 'success');
                $this->redirect(array('controller' => 'subskills', 'action' => 'index', $this->request->data['Subskill']['skill_id']));
            }
        }
    }

    /* Subskills Webadmin Index Function */

    public function webadmin_index($id) {
        $this->layout = 'admin_main';
        if (!empty($this->request->data)) {
            if (!empty($this->request->data['Subskill']['search'])) {
                $this->paginate = array('limit' => 4, 'conditions' => array('OR' => array('Subskill.skill_name' => $this->request->data['Subskill']['search'])), 'AND' => array('Subskill.skill_id' => $id), 'order' => array('Subskill.id' => 'asc'));
                $search = $this->paginate('Subskill');
                $this->set('blog', $search);
                $text = $this->request->data['Subskill']['search'];
                $this->set('text', $text);
            } else {
                $this->paginate = array('limit' => 4, 'conditions' => array('Subskill.skill_id' => $id));
                $search = $this->paginate('Subskill');

                $this->set('blog', $search);
            }
        } else {
            $this->paginate = array('limit' => 4, 'conditions' => array('Subskill.skill_id' => $id));

            $search = $this->paginate('Subskill');
            //pr($search); die;
            $this->set('blog', $search);
        }
    }

    /* Subskills Webadmin Change Status Function */

    public function webadmin_change_status($id) {
        $this->autoRender = false;
        $skill_data = $this->Subskill->find('first', array('conditions' => array('Subskill.id' => $id)));
        if ($skill_data['Subskill']['status'] == '1') {
            $skill_status = '0';
        } else {
            $skill_status = '1';
        }
        $this->request->data['Subskill']['status'] = $skill_status;
        $this->Subskill->id = $id;
        $this->set($this->request->data);
        if ($this->Subskill->save($this->request->data)) {
            $this->Session->setFlash('Subskills Status Changed Successfully', 'success');
            $this->redirect(array('controller' => 'subskills', 'action' => 'index', $skill_data['Subskill']['skill_id']));
        }
    }

    /* Subskills Webadmin Edit Function */

    public function webadmin_edit($skill_data_id = null) {
        $this->layout = 'admin_main';
        $this->loadModel('Skill');
        //echo $skill_data_id;
        $skill_value = $this->Skill->find('list', array('fields' => array('Skill.name')));
        $this->set('data', $skill_value);
        $skill_data_value = $this->Subskill->find('first', array('conditions' => array('Subskill.id' => $skill_data_id)));
        $this->set('skill_data', $skill_data_value);
        if ($this->request->is('post')) {
            $this->set($this->request->data);
            $this->Subskill->id = $skill_data_id;
            if ($this->Subskill->save($this->request->data)) {
                $this->Session->setFlash('Subskill Updated Successfully', 'success');
                $this->redirect(array('controller' => 'subskills', 'action' => 'index', $skill_data_value['Subskill']['skill_id']));
            }
        }
    }

    /* Subskills Webadmin Changeselectall Function */

    public function webadmin_changeselectall($id) {
        $this->autoRender = false;
        if (!empty($this->request->data)) {
            $catar = $this->request->data['Subskill']['chk1'];
            if ($this->request->data['Subskill']['select'] == 'active') {
                foreach ($catar as $v) {
                    $this->request->data['Subskill']['status'] = '1';
                    $this->Subskill->id = $v;
                    $this->Subskill->save($this->request->data);
                }
                $this->Session->setFlash('Subcategory Status Activated Successfully', 'success');
            } elseif ($this->request->data['Subskill']['select'] == 'inactive') {
                foreach ($catar as $v) {
                    $this->request->data['Subskill']['status'] = '0';
                    $this->Subskill->id = $v;
                    $this->Subskill->save($this->request->data);
                }
                $this->Session->setFlash('Subcategory Status Inactivated successfully', 'success');
            } elseif ($this->request->data['Subskill']['select'] == 'delete') {
                foreach ($catar as $v) {
                    $this->Subskill->delete($v);
                }
                $this->Session->setFlash('Subcategory Deleted Successfully', 'success');
            }
            $this->redirect(array('controller' => 'subskills', 'action' => 'index', $id));
        }
    }

    /* Careers Webadmin Delete Function */

    public function webadmin_delete($id) {
        $this->autoRender = false;
        $skill_data = $this->Subskill->findById($id);
        $this->Subskill->delete($id);
        $this->Session->setFlash('Subskills Deleted Successfully', 'success');
        $this->redirect(array('controller' => 'subskills', 'action' => 'index', $skill_data['Subskill']['skill_id']));
    }

}
