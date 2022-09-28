<?php
App::uses('Model', 'Model');

class Post extends AppModel {

    public $belongsTo = 'Topic';

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
        'topic_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            ),
        ),
        'body' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
            ),
        ),
        'status' => array(
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
