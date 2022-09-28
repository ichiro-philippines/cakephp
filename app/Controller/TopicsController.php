<?php

class TopicsController extends AppController {
    public $components = array('Session', 'Auth');
    /**
     * Overhead processing
     *
     */
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

            $role = Configure::read('USERS_ROLE_LIST');
            $visible = Configure::read('VISIBLE_LIST');

            if (AuthComponent::user('role') == $role['ROLE_REGULAR']) {
                $this->request->data['Topic']['visible'] = $visible['VISIBLE_ALL_USER'];
            }

            $this->request->data['Topic']['user_id'] = AuthComponent::user('id');

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
        $this->set('topic', $data);
    }

    /**
     * Method for editing the topic
     * 
     * @param int $id
    */
    public function edit($id) {
        $role = Configure::read('USERS_ROLE_LIST');
        if (AuthComponent::user('role') == $role['ROLE_REGULAR']) {
            $this->redirect('index');
        }

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
        $role = Configure::read('USERS_ROLE_LIST');
        if (AuthComponent::user('role') == $role['ROLE_REGULAR']) {
            $this->redirect('index');
        }

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