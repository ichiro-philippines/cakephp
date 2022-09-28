<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Auth');

/**
 * Overhead processing
 *
 */
	public function beforeFilter() {
		$this->Auth->allow('add');
	}

/**
 * get user's name by ID
 *
 * @return array
 */
	public function getUserNameById($id) {
		$data = $this->User->findById($id);
		return $data;
	}
/**
 * login method
 *
 * @return void
 */
	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				return $this->redirect($this->Auth->redirectUrl());
			} else {
				$this->Session->setFlash('Invalid Username or password');
			}
		}
	}

/**
 * logout method
 *
 * @return void
 */
	public function logout() {
		$this->Auth->logout();
		$this->redirect('/topics/index');
	}

/**
 * index method
 *
 * @return void
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
		
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
        $role = Configure::read('USERS_ROLE_LIST');
        if (AuthComponent::user('role') == $role['ROLE_REGULAR']) {
            $this->redirect(
                array(
                'contoroller' => 'topics',
                'action' => 'index'
            ));
        }

		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			$this->request->data['User']['password'] = AuthComponent::password($this->request->data['User']['password']);
			$this->request->data['User']['role'] = 1;
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
        $role = Configure::read('USERS_ROLE_LIST');
        if (AuthComponent::user('role') == $role['ROLE_REGULAR']) {
            $this->redirect(
                array(
                'contoroller' => 'topics',
                'action' => 'index'
            ));
        }

		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
        $role = Configure::read('USERS_ROLE_LIST');
        if (AuthComponent::user('role') == $role['ROLE_REGULAR']) {
            $this->redirect(
                array(
                'contoroller' => 'topics',
                'action' => 'index'
            ));
        }

		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete($id)) {
			$this->Flash->success(__('The user has been deleted.'));
		} else {
			$this->Flash->error(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
