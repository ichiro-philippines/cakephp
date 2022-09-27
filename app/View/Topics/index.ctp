<h1>Topics</h1>
<?php echo $this->HTML->link('Create a post in this topic',
    array(
        'controller' => 'topics',
        'action' => 'add'
    )); 
?>
<br>
<?php
    if (AuthComponent::user()) {
        echo $this->HTML->link('Logout',
        array(
            'controller' => 'users',
            'action' => 'logout'
        ));
    } else {
        echo $this->HTML->link('Login',
        array(
            'controller' => 'users',
            'action' => 'login'
        ));
    }

?>
<br>
<table>
    <tr>
        <th>Title</th>
        <th>User ID</th>
        <th>Published</th>
        <th>Created</th>
        <th>Modified</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    <?php foreach($topics as $topic): ?>
        <?php
            $status = Configure::read("TOPICS_STATUS_LIST");
            if ($topic['Topic']['status'] == $status["STATUS_SHOW"] && AuthComponent::user('role') == 2) :
        ?>
            <tr>
                <td>
                    <?php
                        echo $this->HTML->link($topic['Topic']['title'],
                        array(
                            'controller' => 'topics',
                            'action' => 'view',
                            $topic['Topic']['id']
                        ));
                    ?>
                </td>
                <td><?php echo $topic['Topic']['user_id']; ?></td>
                <td><?php echo $topic['Topic']['visible']; ?></td>
                <td><?php echo $topic['Topic']['created']; ?></td>
                <td><?php echo $topic['Topic']['modified']; ?></td>
                <td>
                    <?php
                        echo $this->HTML->link('Edit',
                        array(
                            'controller' => 'topics',
                            'action' => 'edit',
                            $topic['Topic']['id']
                        ));
                    ?>
                </td>
                <td>
                    <?php
                        echo $this->Form->postLink('Delete',
                        array(
                            'controller' => 'topics',
                            'action' => 'delete',
                            $topic['Topic']['id']),
                            $topic['Topic']['status'],
                            array('confirm' => 'Are you sure you want to delete this topic?')
                        );
                    ?>
                </td>
            </tr>
        <?php endif; ?>
        <?php
            $status = Configure::read("TOPICS_STATUS_LIST");
            if (($topic['Topic']['status'] == $status["STATUS_SHOW"] || AuthComponent::user()) && AuthComponent::user('role') == 1 && $topic['Topic']['visible'] == 1) :
        ?>
            <tr>
                <td>
                    <?php
                        echo $this->HTML->link($topic['Topic']['title'],
                        array(
                            'controller' => 'topics',
                            'action' => 'view',
                            $topic['Topic']['id']
                        ));
                    ?>
                </td>
                <td><?php echo $topic['Topic']['user_id']; ?></td>
                <td><?php echo $topic['Topic']['visible']; ?></td>
                <td><?php echo $topic['Topic']['created']; ?></td>
                <td><?php echo $topic['Topic']['modified']; ?></td>
                <td>
                    <?php
                        echo $this->HTML->link('Edit',
                        array(
                            'controller' => 'topics',
                            'action' => 'edit',
                            $topic['Topic']['id']
                        ));
                    ?>
                </td>
                <td>
                    <?php
                        echo $this->Form->postLink('Delete',
                        array(
                            'controller' => 'topics',
                            'action' => 'delete',
                            $topic['Topic']['id']),
                            $topic['Topic']['status'],
                            array('confirm' => 'Are you sure you want to delete this topic?')
                        );
                    ?>
                </td>
            </tr>
        <?php endif; ?>
    <?php endforeach; ?>
    <?php unset($topic); ?>
</table>