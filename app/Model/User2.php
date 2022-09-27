<?php
App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class User extends AppModel {

    public $displayFild = 'title';

    public $validate = array(
        'id' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
            ),
        ),
        'username' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            ),
        ),
        'password' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
            ),
        ),
        'full_name' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
            ),
        ),
        'role' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
            ),
        ),
        'created' => array(
        ),
        'modified' => array(
        ),
    );

    public $hasMany = array(
        'Topic' => array(
            'className' => 'Topic',
            'foreignKey' => 'user_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' =>' '
        )
    );
}
