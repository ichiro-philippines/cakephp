<h1>Edit Topics</h1>
<?php
echo $this->Form->create('Topic');
// echo $this->Form->input('user_id');
echo $this->Form->input('title');
echo $this->Form->input('visible', array(
    'type' => 'checkbox',
    'label' => 'visible'
));
echo $this->Form->end('Edit topic');


