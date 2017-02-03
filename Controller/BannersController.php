<?php

class BannersController extends AppController {
    /*Banners Webadmin Add Function*/
    public function webadmin_add() {
        $this->layout = 'admin_main';
        //$this->loadModel('Page');
        if ($this->request->is('post')) {
            $slug=  preg_replace("/-$/","",preg_replace('/[^a-z0-9]+/i',"_",strtolower($this->request->data['Banner']['name'])));
            $this->request->data['Banner']['name']=$slug;
            $this->request->data['Banner']['description'] =$this->request->data['Banner']['description'];
            $this->request->data['Banner']['image'] = time() . '_' . $this->request->data['Banner']['image_name']['name'];
            if (move_uploaded_file($this->request->data['Banner']['image_name']['tmp_name'], WWW_ROOT . 'uploads/' . time() . '_' . $this->request->data['Banner']['image_name']['name']))
                    $this->set($this->request->data);
                if ($this->Banner->save($this->request->data)) {
                    $this->Session->setFlash('Banner Image Added Successfully', 'success');
                    $this->redirect(array('controller' => 'banners', 'action' => 'index'));
                }
        }
    }
    /*Banners Webadmin Index Function*/
    public function webadmin_index() {
        $this->layout = 'admin_main';
        if (!empty($this->request->data)) {
            if (!empty($this->request->data['Banner']['search'])) {
                $this->paginate = array('limit' => 4, 'conditions' => array('Banner.title' => $this->request->data['Banner']['search']), 'order' => array('Banner.id' => 'asc'));
                $search = $this->paginate('Banner');
                $this->set('blog', $search);
                $text = $this->request->data['Banner']['search'];
                $this->set('text', $text);
            } else {
                $this->paginate = array('limit' => 4);
                $search = $this->paginate('Banner');
                $this->set('blog', $search);
            }
        } else {
            $this->paginate = array('limit' => 4);
            $search = $this->paginate('Banner');
            $this->set('blog', $search);
            //	pr($search);
        }
    }
    /*Banners Webadmin Edit Function*/
    public function webadmin_edit($id = null) {
        $this->layout = 'admin_main';
        $this->loadModel('Page');
        $banner = $this->Banner->find('first', array('conditions' => array('Banner.id' => $id)));
        //pr($banner);
        $this->set('banner', $banner);
        if (!empty($this->request->data)) {
            $slug=  preg_replace("/-$/","",preg_replace('/[^a-z0-9]+/i',"_",strtolower($this->request->data['Banner']['name'])));
            $this->request->data['Banner']['name']=$slug;
            $this->request->data['Banner']['description'] = $this->request->data['Banner']['description'];
            $this->request->data['Banner']['image'] = time() . '_' . $this->request->data['Banner']['image_name']['name'];
            if (move_uploaded_file($this->request->data['Banner']['image_name']['tmp_name'], WWW_ROOT . 'uploads/' . time() . '_' . $this->request->data['Banner']['image_name']['name']))
                $this->Banner->id = $id;
            $this->set($this->request->data);
            if ($this->Banner->save($this->request->data)) {
                $this->Session->setFlash('Banner Iamge Updated Successfully', 'success');
                $this->redirect(array('controller' => 'banners', 'action' => 'index'));
            }
        }
    }
    /*Banners Webadmin Change Status Function*/
    public function webadmin_change_status($id) {
        $this->autoRender = false;
        $data = $this->Banner->findById($id);
        if ($data['Banner']['status'] == '1') {
            $us_status = '0';
        } else {
            $us_status = '1';
        }
        $this->request->data['Banner']['status'] = $us_status;
        $this->Banner->id = $id;
        $this->set($this->request->data);
        if ($this->Banner->save($this->request->data)) {
            $this->Session->setFlash('Banner Status Changed Successfully', 'success');
            $this->redirect(array('controller' => 'banners', 'action' => 'index'));
        }
    }
    /*Banners Webadmin Delete Function*/
    public function webadmin_delete($id) {
        $this->autoRender = false;
        $this->Banner->delete($id);
        $this->Session->setFlash('Banner Image Deleted Successfully', 'success');
        $this->redirect(array('controller' => 'banners', 'action' => 'index'));
    }
				/*Banners Webadmin Changeselectall Function*/
    public function webadmin_changeselectall() { 
        $this->autoRender = false;
        if (!empty($this->request->data)) {
            $catre = $this->request->data['Banner']['chk1'];
            if (!empty($catre)) {
                if ($this->request->data['Banner']['select'] == 'active') {
                    foreach ($catre as $val) {
                        $this->request->data['Banner']['status'] = '1';
                        $this->Banner->id = $val;
                        $this->Banner->save($this->request->data);
                    }
                    $this->Session->setFlash('Banner Status Active Successfully', 'success');
                } elseif ($this->request->data['Banner']['select'] == 'inactive') {
                    foreach ($catre as $val) {
                        $this->request->data['Banner']['status'] = '0';
                        $this->Banner->id = $val;
                        $this->Banner->save($this->request->data);
                    }
                    $this->Session->setFlash('Banner Status Inactive Successfully', 'success');
                } elseif ($this->request->data['Banner']['select'] == 'delete') {
                    foreach ($catre as $val) {

                        $this->Banner->delete($val);
                    }
                    $this->Session->setFlash('Banner Image Deleted Successfully', 'success');
                }
                $this->redirect(array('controller' => 'banners', 'action' => 'index'));
            }
        }
    }

}
