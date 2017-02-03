<?php

class ClosedprojectsController extends AppController {

    //Manage Closed Project's record & feedback. 
    public function webadmin_index() { 
        $this->loadModel('Projectfeedback');
        $this->layout = 'admin_main';
        $this->paginate = array('limit' => 10, 'group' => array('Projectfeedback.job_id'));
        $feedback = $this->paginate('Projectfeedback');
        $this->set('feedback', $feedback);
    }

// View Feedback according to particular job.
    public function webadmin_view_detail($id = NULL) {
        $this->loadModel('Projectfeedback');
        $this->loadModel('Job');
        $this->loadModel('Hire');
        $this->layout = 'admin_main';
        $feedback = $this->Projectfeedback->find('all', array('conditions' => array('Projectfeedback.job_id' => $id)));
        $hire = $this->Hire->find('first', array('conditions' => array('Hire.job_id' => $id)));
        $this->set('record', $feedback);
        $this->set('hire', $hire);
    }

    // Delete Closed Project's record.
    public function webadmin_delete($id = NULL) {
        $this->loadModel('Projectfeedback');
        $this->layout = 'admin_main';
        $this->Projectfeedback->delete($id);
        $this->Session->setFlash('Closed Project`s record deleted Successfully.', 'success');
        $this->redirect(array('controller' => 'Closedprojects', 'action' => 'index', 'prefix' => 'webadmin'));
    }

}