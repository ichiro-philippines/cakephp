<?php
	
class TopicsController extends AppController {
    public $components = array('Session', 'Auth');

    public function beforeFilter() {
        $this->Auth->allow('index');
    }

    /**
     * Method for displaying the top page
    */
    public function index() {
        $data = $this->Topic->find('all');
        $this->set('topics', $data);
    }

    /**
     * Method for posting a topic
    */
    public function add() {
        if ($this->request->is('post')) {
            $this->Topic->create();
            if (AuthComponent::user('role') == 1) {
                $this->request->data['Topic']['visible'] = 2;
            }
            $this->request->data['Topic']['visible'] = 2;
            if ($this->Topic->save($this->request->data)) {
                $this->Session->setFlash('The topic has been created!');
                $this->redirect('index');
            }
        }
    }

    /**
     * Method for displaying the detail page
     * 
     * @param int $id
    */
    public function view($id) {
        $data = $this->Topic->findById($id);
        // var_dump($data);exit;
        $this->set('topic', $data);
    }

    /**
     * Method for editing the topic
     * 
     * @param int $id
    */
    public function edit($id) {
        $data = $this->Topic->findById($id);
        if ($this->request->is(array('post', 'put'))) {
            $this->Topic->id = $id;
            if ($this->Topic->save($this->request->data)) {
                $this->Session->setFlash('The topic has been editted!');
                $this->redirect('index');
            }
        }
        $this->request->data = $data;
    }

    /**
     * Method for deleting the topic
     * 
     * @param int $id
    */
    public function delete($id) {
        $this->Topic->id = $id;
        if ($this->request->is(array('post', 'put'))) {
            $data = array('status' => 0);
            $field = array('status');
            if ($this->Topic->save($data, $field)) {
                $this->Session->setFlash('The topic has been deleted!');
                $this->redirect('index');
            }
        }
    }
}