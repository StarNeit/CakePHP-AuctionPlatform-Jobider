<?php

class BlogsController extends AppController {

    //var $uses='Admin';

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index', 'view_blog', 'blog_category', 'blog_article', 'test');
    }

    /* Blogs Webadmin Add Function */

    public function webadmin_add123() {
        $this->layout = 'admin_main';
        $this->loadModel('Blog');
        $this->loadModel('Category');
        $cat_data = $this->Category->find('list', array('fields' => 'Category.name'));
        $this->set('data', $cat_data);
        if ($this->request->is('post')) {
            $this->set($this->request->data);
            if ($this->Blog->validates()) {
                $this->request->data['Blog']['description'] = strip_tags($this->request->data['Blog']['editor1']);
                if ($this->Blog->save($this->request->data)) {
                    $recent_blog_id = $this->Blog->getLastInsertId();
                    $description = $this->request->data['Blog']['editor1'];
                    if (strstr($description, "#")) {

                        function gethashtags($description) {
                            //Match the hashtags
                            preg_match_all('/(^|[^a-z0-9_])#([a-z0-9_]+)/i', $description, $matchedHashtags);
                            $hashtag = '';
                            // For each hashtag, strip all characters but alpha numeric
                            if (!empty($matchedHashtags[0])) {
                                foreach ($matchedHashtags[0] as $match) {
                                    $hashtag .= preg_replace("/[^a-z0-9]+/i", "", $match) . ',';
                                }
                            }
                            //to remove last comma in a string
                            return rtrim($hashtag, ',');
                        }
                        //usage
                        $tags_will = gethashtags($description);
                        $this->loadModel('Hashtag');
                        $tag['Hashtag']['blog_id'] = $recent_blog_id;
                        $tag['Hashtag']['tag'] = $tags_will;
                        $tag['Hashtag']['added_on'] = time();
                        $hashsaved = $this->Hashtag->save($tag, array('validate' => true));
                    }
                    $this->Session->setFlash('Blogs insert successfully', 'success');
                    $this->redirect('/webadmin/blogs');
                }
            } else {
                $errors = $this->Blog->validationErrors;
            }
        }
    }

    public function webadmin_add() {
        $this->layout = 'admin_main';
        $this->loadModel('Blog');
        $this->loadModel('Category');
        $cat_data = $this->Category->find('list', array('fields' => 'Category.name'));
        $this->set('data', $cat_data);
        if ($this->request->is('post')) {
            $title=$this->request->data['Blog']['title'];
            $titles=explode(" ", $title);
            $title_new="";
            foreach ($titles as $title_val) {
                # code...
                $title_new.=$title_val.'_';
            }
            $this->request->data['Blog']['slug']=$title_new.'~'.strtotime("now");
            $this->request->data['Blog']['description'] = $this->request->data['Blog']['editor1'];
            
            if (move_uploaded_file($this->request->data['Blog']['image_name']['tmp_name'], WWW_ROOT . 'uploads/' . time() . '_' . $this->request->data['Blog']['image_name']['name']))
                    $this->request->data['Blog']['image'] = time() . '_' . $this->request->data['Blog']['image_name']['name'];
                $this->set($this->request->data);
                if(empty($this->request->data['Blog']['category_id'])){
                    $this->Session->setFlash('Please select the Category','error_unverify');
                }else{
                if ($this->Blog->save($this->request->data)) {
                    $this->Session->setFlash('Blogs  are insert successfully', 'success');
                    $this->redirect(array('controller' => 'blogs', 'action' => 'index'));
                }
                }
        }
    }

    /* Blogs  Webadmin Index Function */

    public function webadmin_index() {
        $this->layout = 'admin_main';
        if (!empty($this->request->data)) {
            if (!empty($this->request->data['Blog']['search'])) {
                $this->paginate = array('limit' => 4, 'conditions' => array('OR' => array('Blog.author' => $this->request->data['Blog']['search'], 'Blog.title' => $this->request->data['Blog']['search'])), 'order' => array('Blog.id' => 'asc'));
                $search = $this->paginate('Blog');
                foreach($search as $k=>$v){
                    $category=  $this->Category->find('first',array('conditions'=>array('Category.id'=>$v['Blog']['category_id'])));
                    $search[$k]['category']=$category;
                }
                $this->set('blog', $search);
                $text = $this->request->data['Blog']['search'];
                $this->set('text', $text);
            } else {
                $this->paginate = array('limit' => 4);
                $search = $this->paginate('Blog');
                foreach($search as $k=>$v){
                    $category=  $this->Category->find('first',array('conditions'=>array('Category.id'=>$v['Blog']['category_id'])));
                    $search[$k]['category']=$category;
                }
                $this->set('blog', $search);
            }
        } else {
            $this->paginate = array('limit' => 4);
            $search = $this->paginate('Blog');
foreach($search as $k=>$v){
                    $category=  $this->Category->find('first',array('conditions'=>array('Category.id'=>$v['Blog']['category_id'])));
                    $search[$k]['category']=$category;
                }
                //pr($search);
            $this->set('blog', $search);
        }
    }

    /* Blogs Webadmin Change Status Function */

    public function webadmin_change_status($id) {
        $this->autoRender = false;
        $find = $this->Blog->findById($id);
        if ($find['Blog']['status'] == '1') {
            $use = '0';
        } else {
            $use = '1';
        }
        $this->request->data['Blog']['status'] = $use;
        $this->Blog->id = $id;
        $this->set($this->request->data);
        if ($this->Blog->save($this->request->data)) {
            $this->Session->setFlash('Blogs status change successfully', 'success');
        }
        $this->redirect('/webadmin/blogs');
    }

    /* Blogs Webadmin Changeselectall Function */

    public function webadmin_changeselectall() {
        $this->autoRender = false;
        if (!empty($this->request->data)) {
            $catAr = $this->request->data['Blog']['chk1'];
            if ($this->request->data['Blog']['select'] == 'active') {
                foreach ($catAr as $v) {
                    //$test = $this->User->findById($v);
                    //pr($test); die;
                    $this->request->data['Blog']['status'] = '1';
                    $this->Blog->id = $v;
                    $this->Blog->save($this->request->data);
                }
                $this->Session->setFlash('selected users activated successfully', 'success');
            } elseif ($this->request->data['Blog']['select'] == 'inactive') {
                foreach ($catAr as $v) {
                    $this->request->data['Blog']['status'] = '0';
                    $this->Blog->id = $v;
                    $this->Blog->save($this->request->data);
                }
                $this->Session->setFlash('Selected users inactivated successfully', 'success');
            } elseif ($this->request->data['Blog']['select'] == 'delete') {
                foreach ($catAr as $v) {
                    $this->Blog->delete($v);
                }
                $this->Session->setFlash('Selected users  deleted successfully', 'success');
            }
            $this->redirect('/webadmin/blogs');
        }
    }

    /* Blogs Webadmin Edit Function */

    public function webadmin_edit($id = null) {
        $this->layout = 'admin_main';
        $blog = $this->Blog->find('first', array('conditions' => array('Blog.id' => $id)));
        $this->set('blog', $blog);
        if ($this->request->is('post')) {
            //pr($this->request->data); die;
            $this->request->data['Blog']['description'] = $this->request->data['Blog']['editor1'];
            if(isset($this->request->data['Blog']['file']['name']) && !empty($this->request->data['Blog']['file']['name'])){
            $fileupload = WWW_ROOT . 'uploads/' . time() . '_' . $this->request->data['Blog']['file']['name'];
            move_uploaded_file($this->request->data['Blog']['file']['tmp_name'],$fileupload);
               $this->request->data['Blog']['image'] = time() . '_' . $this->request->data['Blog']['file']['name'];
            }else{
                $this->request->data['Blog']['image']=$blog['Blog']['image'];
            }
                    
                $this->Blog->id = $id;
            $this->set($this->request->data);
            if ($this->Blog->save($this->request->data)) {
                $this->Session->setFlash('Blogs updated successfully', 'success');
                $this->redirect('/webadmin/blogs');
            }
        }
    }

    /* Blogs Webadmin Delete Function */

    public function webadmin_delete($id) {
        $this->autoRender = false;
        $this->Blog->delete($id);
        $this->Session->setFlash('Blogs Deleted Successfully', 'success');
        $this->redirect(array('controller' => 'blogs', 'action' => 'index'));
    }

    //////////////////////Front End Functions////////////////////
    /* Blogs Front Index  Function */
    public function index() { 
        $this->layout = 'front';
         $this->set('title_for_layout', 'Blog');
        $this->loadModel('Category');
        
//        $blogs=  $this->Blog->find('all',array('order'=>'Blog.id DESC','conditions'=>array('Blog.status'=>1,'limit'=>3),));
        $blogs = $this->Blog->find('all', array('conditions'=>array('Blog.status'=>'1'),'order'=>array('Blog.id DESC'),'limit'=>'5'));
        //pr($blogs);die;
        $this->set('blog', $blogs);
        $category_value = $this->Category->find('all', array('fields' => array('Category.name')));
        $this->set('category', $category_value);
        $blog_tag = $this->Blog->find('all', array('fields' => array('Blog.tags')));
 // pr($blog_tag); 
        foreach ($blog_tag as $val) {

            $tags[] = explode(',', $val['Blog']['tags']);
        }
//pr($tags);die('skdask');
        $new_array = array();
        foreach ($tags AS $key => $value) {
           // pr($value);
            foreach ($value as $kk => $vv) {
                $new_array[] = $vv;
            }
        }
      //  pr($new_array); 
        $res = array_unique($new_array);
      // pr($res);die('skldjsa');
        $this->set('tags', $res);
    }

    /* Blogs View Blog  Function */

    public function view_blog($id) {
        $this->layout = 'front';
        $this->loadModel('Skill');
        $this->loadModel('Blog');
        $this->loadModel('Category');
        $blogs_data = $this->Blog->find('first', array('conditions' => array('Blog.slug' => $id)));
        //pr($blogs_data);
        $cat_id = $blogs_data['Blog']['category_id'];
        $this->Category->recursive = -1;
        $category = $this->Category->find('first',array('conditions'=>array('Category.id'=>$cat_id),'fields'=>array('Category.name','Category.id')));
        $this->set('blog_data', $blogs_data);
        $category_value = $this->Skill->find('all', array('fields' => array('Skill.name')));
        $category_data = $this->Category->find('all', array('conditions' => array('Category.status' => '1'), 'fields' => array('Category.name')));
        $blog_data = $this->Blog->find('all', array('fields' => array('Blog.tags')));
        foreach ($blog_data as $val) {
            $tags[] = explode(',', $val['Blog']['tags']);
        }
        $new_array = array();
        foreach ($tags AS $key => $value) {
            foreach ($value as $kk => $vv) {
                $new_array[] = $vv;
            }
        }
        $res = array_unique($new_array);
        ///pr($res);
        $this->set('tags', $res);
        $this->set('category', $category_value);
        $this->set('category_data', $category_data);
        $this->set('cat', $category);
    }

    public function blog_category($id = null) {
        $this->layout = 'front';
        $this->loadModel('Blog');
        $this->loadModel('Category');
//        pr($this->params);
//        die('sdjfhjsdh');
        $Blog_data = $this->Blog->find('all', array('conditions' => array('Blog.category_id' => $id, 'Blog.status' => '1'),'order'=>'Blog.id DESC','limit'=>'3'));
       // pr($Blog_data);
        $category_data = $this->Category->find('all', array('conditions' => array('Category.status' => '1'), 'fields' => array('Category.name')));
        $this->set('Blog_result', $Blog_data);
        $this->set('category_data', $category_data);
        $blog_data = $this->Blog->find('all', array('fields' => array('Blog.tags')));
        foreach ($blog_data as $val) {
            $tags[] = explode(',', $val['Blog']['tags']);
        }
        $new_array = array();
        foreach ($tags AS $key => $value) {
            foreach ($value as $kk => $vv) {
                $new_array[] = $vv;
            }
        }
        $res = array_unique($new_array);
       // pr($res);
        $this->set('tags', $res);
    }

    public function blog_article($tag = NULL) {
        $this->layout = 'front';
        $this->loadModel('Blog');
        $this->loadModel('Category');
        $blogs = $this->Blog->find('all', array('conditions' => array('Blog.tags LIKE' => '%' . $tag . '%'),'order'=>'Blog.id DESC','limit'=>'3'));
        foreach ($blogs as $val) {
            $tags[] = explode(',', $val['Blog']['tags']);
        }
        $new_array = array();
        foreach ($tags AS $key => $value) {
            foreach ($value as $kk => $vv) {
                $new_array[] = $vv;
            }
        }
        $res = array_unique($new_array);
        $this->set('tags', $res);
        $this->set('blog', $blogs);
        $category_value = $this->Category->find('all', array('fields' => array('Category.name')));
        $this->set('category', $category_value);
    }

}

