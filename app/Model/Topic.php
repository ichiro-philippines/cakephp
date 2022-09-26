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
class Topic extends AppModel {

    public $displayFild = 'title';

    public $validate = array(
        'id' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
            ),
        ),
        'user_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            ),
        ),
        'title' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
            ),
        ),
        'visible' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
            ),
        ),
        'created' => array(
        ),
        'modified' => array(
        ),
    );
}
