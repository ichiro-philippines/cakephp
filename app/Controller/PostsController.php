<?php
App::uses('AuthComponent', 'Controller/Component');
class PostsController extends AppController {
    public $componetns = array('Session');

    /**
     * Method for displaying the top page
    */
    public function index() {
        $role = Configure::read('USERS_ROLE_LIST');
        if (AuthComponent::user('role') == $role['ROLE_REGULAR']) {
            $this->redirect(
                array(
                'contoroller' => 'topics',
                'action' => 'index'
            ));
        }

        $data = $this->Post->find('all');
        $this->set('posts', $data);
    }

    /**
     * Method for posting a post
     * 
     * @param int $id
    */
    public function add($id) {
        if ($this->request->is('post')) {

            $this->Post->create();

            $this->request->data['Post']['topic_id'] = $id;
            $this->request->data['Post']['user_id'] = AuthComponent::user('id');

            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash('The post has been created!');
                $this->redirect('/topics/view/' . $id);
            }
        }

        $this->set('topics', $this->Post->Topic->find('list'));
    }

    /**
     * Method for displaying the detail page
     * 
     * @param int $id
    */
    public function view($id) {
        $data = $this->Post->findById($id);
        $this->set('post', $data);
    }
}
?>