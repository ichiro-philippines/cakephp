<h1>Posts</h1>
<table>
    <tr>
        <th>ID</th>
        <th>Topic ID</th>
    </tr>
    <?php foreach($posts as $post): ?>
        <?php 
            $status = Configure::read("TOPICS_STATUS_LIST");
            if ($post['Topic']['status'] == $status["STATUS_SHOW"]) { 
        ?>
            <tr>
                <td>
                    <?php
                        echo $this->HTML->link($post['Post']['id'],
                        array(
                            'controller' => 'posts',
                            'action' => 'view',
                            $post['Post']['id']
                        ));
                    ?>
                </td>
                <td>
                    <?php
                        echo $this->HTML->link($post['Topic']['title'],
                        array(
                            'controller' => 'posts',
                            'action' => 'view',
                            $post['Post']['topic_id']
                        ));
                    ?>
                </td>
            </tr>
        <?php } ?>
    <?php endforeach; ?>
    <?php unset($post); ?>
</table>