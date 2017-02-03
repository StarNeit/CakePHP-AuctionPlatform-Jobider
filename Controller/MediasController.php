<?php

class MediasController extends AppController {

    var $uses = array('Media');

    public function webadmin_add() {
        $this->layout = 'admin_main';
        $this->loadModel('Media');
        if ($this->request->is('post')) {
//            pr($this->request->data); die;
            $this->request->data['Media']['description'] = strip_tags($this->request->data['Media']['editor1']);
            $this->request->data['Media']['image'] = time() . '_' . $this->request->data['Media']['image_name']['name'];
            if (move_uploaded_file($this->request->data['Media']['image_name']['tmp_name'], WWW_ROOT . 'uploads/' . time() . '_' . $this->request->data['Media']['image_name']['name']))
                $this->set($this->request->data);
            if ($this->Media->save($this->request->data)) {
                $this->Session->setFlash('Media content  inserted successfully', 'success');
                $this->redirect(array('controller' => 'medias', 'action' => 'index'));
            }
        }
    }

    public function webadmin_index() {
        $this->layout = 'admin_main';
        $this->loadModel('Media');
        if (!empty($this->request->data)) {
            if (!empty($this->request->data['Media']['search'])) {
                $this->paginate = array('limit' => 5, 'conditions' => array('OR' => array('Media.title LIKE' => '%' . $this->request->data['Media']['search'] . '%', 'Media.name LIKE' => '%' . $this->request->data['Media']['search'] . '%')), 'order' => array('Media.id' => 'asc'));
                $search = $this->paginate('Media');
                $this->set('blog', $search);
                $text = $this->request->data['Media']['search'];
                $this->set('text', $text);
            } else {
                $this->paginate = array('limit' => 5);
                $search = $this->paginate('Media');
                $this->set('blog', $search);
            }
        } else {
            $this->paginate = array('limit' => 4);
            $search = $this->paginate('Media');
            $this->set('blog', $search);
        }
    }

    public function webadmin_change_status($id) {
        $this->autoRender = false;
        $page_data = $this->Media->findById($id);
        if ($page_data['Media']['status'] == '1') {
            $page_status = '0';
        } else {
            $page_status = '1';
        }
        $this->request->data['Media']['status'] = $page_status;
        $this->Media->id = $id;
        $this->set($this->request->data);
        if ($this->Media->save($this->request->data)) {
            $this->Session->setFlash('Media Status Changed Successfully', 'success');
            $this->redirect(array('controller' => 'medias', 'action' => 'index'));
        }
    }

    public function webadmin_changeselectall() {
        $this->autoRender = false;
        if (!empty($this->request->data)) {
            $cater = $this->request->data['Media']['chk1'];
            if ($this->request->data['Media']['select'] == 'active') {
                foreach ($cater as $val) {
                    $this->request->data['Media']['status'] = '1';
                    $this->Media->id = $val;
                    $this->Media->save($this->request->data);
                }
                $this->Session->setFlash('Media Status Active Successfully', 'success');
            } elseif ($this->request->data['Media']['select'] == 'inactive') {
                foreach ($cater as $val) {
                    $this->request->data['Media']['status'] = '0';
                    $this->Media->id = $val;
                    $this->Media->save($this->request->data);
                }
                $this->Session->setFlash('Media Status Inactive Successfully', 'success');
            } elseif ($this->request->data['Media']['select'] == 'delete') {
                foreach ($cater as $val) {
                    $this->Media->delete($val);
                }
                $this->Session->setFlash('Media Deleted Successfully', 'success');
            }
            $this->redirect(array('controller' => 'medias', 'action' => 'index'));
        }
    }

    public function webadmin_delete($id) {
        $this->autoRender = false;
        $this->Media->delete($id);
        $this->Session->setFlash('Media Deleted Successfully', 'success');
        $this->redirect(array('controller' => 'medias', 'action' => 'index'));
    }

    public function webadmin_edit($id = null) {
        $this->layout = 'admin_main';
        $value = $this->Media->find('first', array('conditions' => array('Media.id' => $id)));
        $this->set('blog', $value);
        if ($this->request->is('post')) {
            $this->Media->set($this->request->data);
            $this->request->data['Media']['description'] = strip_tags($this->request->data['Media']['editor1']);
            if (!empty($this->request->data['Media']['file']['name'])) {
                $this->request->data['Media']['image'] = time() . '_' . $this->request->data['Media']['file']['name'];
                move_uploaded_file($this->request->data['Media']['file']['tmp_name'], WWW_ROOT . 'uploads/' . time() . '_' . $this->request->data['Media']['file']['name']);
            }
            $this->Media->id = $id;
            $this->set($this->request->data);
            if ($this->Media->save($this->request->data)) {
                $this->Session->setFlash('Media infomation Updated Successfully', 'success');
                $this->redirect(array('controller' => 'medias', 'action' => 'index'));
            }
        }
    }

}
