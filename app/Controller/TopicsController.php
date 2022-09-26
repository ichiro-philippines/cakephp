<?php 

class TopicsController extends AppController {
    public $componetns = array('Session');

/**
 *Method for displaying the top page
 */
public function index() {
    $data = $this->Topic->find('all');
    $this->set('topics', $data);
}

/**
 *Method for posting a topic
 */
public function add() {
    if ($this->request->is('post')) {
        $this->Topic->create();
        if ($this->Topic->save($this->request->data)) {
            $this->Session->setFlash('The topic has been created!');
            $this->redirect('index');
        }
    }
}

/**
 *Method for displaying the detail page
 */
public function view($id) {
    $data = $this->Topic->findById($id);
    $this->set('topic', $data);
}

/**
 *Method for editing the topic
 */
public function edit($id){
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
 *Method for deleting the topic
 */
public function delete($id) {
    $this->Topic->id = $id;
    if ($this->request->is(array('post', 'put'))) {
        if ($this->Topic->delete()) {
            $this->Session->setFlash('The topic has been deleted!');
            $this->redirect('index');
        }
    }
}
}