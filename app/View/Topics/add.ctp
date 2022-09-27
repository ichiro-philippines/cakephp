<h1>Create Topics</h1>
<?php
echo $this->Form->create('Topic');
// echo $this->Form->input('user_id');
echo $this->Form->input('title');
echo $this->Form->select('visible', array(
    '1' => 'Published',
    '2' => 'Hidden'),
    array('empty' => false)
);
echo $this->Form->end('save topic');


