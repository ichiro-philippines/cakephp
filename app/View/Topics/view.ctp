<?php App::import('Controller', 'Users'); ?>
<h1><?php echo $topic['Topic']['title']; ?></h1>

<?php echo $this->HTML->link('Create a post in this post',
    array(
        'controller' => 'posts',
        'action' => 'add',
        $topic['Topic']['id']
    ));
?>
<br>
<table>
    <tr><td>Sr. No.</td><td>User</td><td>Post</td></tr>
<?php
    $counter = 1;
    foreach ($topic['Post'] as $post) {
        $ucontroller = new UsersController();
        $uname = $ucontroller->getUserNameById($post['user_id']);
        echo '<tr><td>' . $counter . '</td><td>' . $uname['User']['username'] . '</td><td>' . $post['body'] . '</td></tr>';
        $counter++;
    }
?>
</table>