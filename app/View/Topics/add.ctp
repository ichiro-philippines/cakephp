<h1>Create Topics</h1>
<?php
echo $this->Form->create('Topic');
echo $this->Form->input('title');
$role = Configure::read('USERS_ROLE_LIST');
if (AuthComponent::user('role') == $role['ROLE_ADMIN']) {
    echo $this->Form->select('visible', 
    array(
        '1' => 'Published',
        '2' => 'Hidden'
    ),
        array('empty' => false)
    );
}
echo $this->Form->end('save topic');


