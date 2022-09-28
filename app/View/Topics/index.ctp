<h1>Topics</h1>
<?php if (AuthComponent::user()) :?>
    <p>Login user: <?php echo AuthComponent::user('username') ?> (Role: <?php echo AuthComponent::user('role') ?>)</p>
<?php else: ?>
    <p>Not Login User</p>
<?php endif; ?>
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
        )) . ' or ' . $this->HTML->link('Ragister',
        array(
            'controller' => 'users',
            'action' => 'add'
        ));
    }

?>
<br>
<table>
    <tr>
        <th>Title</th>
        <th>User ID</th>
        <th>Created</th>
        <th>Modified</th>
        <?php 
            $role = Configure::read('USERS_ROLE_LIST');
            if (AuthComponent::user('role') == $role['ROLE_ADMIN']) :
        ?>
            <th>Published</th>
            <th>Edit</th>
            <th>Delete</th>
        <?php endif; ?>

    </tr>
    <?php foreach($topics as $topic): ?>
        <?php
            $status = Configure::read('TOPICS_STATUS_LIST');
            $visible = Configure::read('VISIBLE_LIST');
            if ($topic['Topic']['status'] == $status["STATUS_SHOW"] && AuthComponent::user('role') == $role['ROLE_ADMIN']) :
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
                <td><?php echo $topic['User']['username']; ?></td>
                <td><?php echo $topic['Topic']['created']; ?></td>
                <td><?php echo $topic['Topic']['modified']; ?></td>
                <?php if (AuthComponent::user('role') == $role['ROLE_ADMIN']) :?>
                <td><?php echo $topic['Topic']['visible']; ?></td>
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
                <?php endif; ?>
            </tr>
        <?php endif; ?>
        <?php
            if ($topic['Topic']['status'] == $status["STATUS_SHOW"]
            && (AuthComponent::user('role') == $role['ROLE_REGULAR'] || !AuthComponent::user())
            && $topic['Topic']['visible'] == $visible['VISIBLE_ALL_USER']) :
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
                <td><?php echo $topic['User']['username']; ?></td>
                <td><?php echo $topic['Topic']['created']; ?></td>
                <td><?php echo $topic['Topic']['modified']; ?></td>
                <?php if (AuthComponent::user('role') == $role['ROLE_ADMIN']) :?>
                <td><?php echo $topic['Topic']['visible']; ?></td>
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
                <?php endif; ?>
            </tr>
        <?php endif; ?>
    <?php endforeach; ?>
    <?php unset($topic); ?>
</table>