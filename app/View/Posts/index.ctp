<h1>Blog posts</h1>
<p><?php echo $this->Html->link('Add Post', array('action' => 'add')); ?></p>
<!--<?php echo $this->Html->link(
    'Add Post',
    array('controller' => 'posts', 'action' => 'add')
); ?>-->

<div style="float:left; width:600px; margin-right:50px;">
    <table>
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Category</th>
            <th>Action</th>
            <th>Created</th>
        </tr>
    
    <!-- ここから、$posts配列をループして、投稿記事の情報を表示 -->

    <?php foreach ($posts as $post): ?>
    <tr>
        <td><?php echo $post['Post']['id']; ?></td>
        <td>
            <?php echo $this->Html->link($post['Post']['title'],
array('controller' => 'posts', 'action' => 'view', $post['Post']['id'])); ?>
        </td>
        <td>
            <?php echo $post['Category']['name']; ?>
        </td>
        <td>
            <?php echo $this->Form->postLink(
                'Delete',
                array('action' => 'delete', $post['Post']['id']),
                array('confirm' => 'Are you sure?'));
            ?>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $post['Post']['id'])); ?>
        </td>
        <td><?php echo $post['Post']['created']; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($post); ?>
    </table>
</div>


<div style="float:right; width:150px; margin-right:5px;">
    <table>
        <th>Category</th>
        <?php foreach ($categories as $category): ?>
        <tr>
          <td>
            <?php
            echo $this->Html->link($category['Category']['name'].'('.$category['Category']['count'].')',array('controller' => 'posts', 'action' => 'category_index', $category['Category']['id']));
             ?>

          </td>
        </tr>
        <?php endforeach; ?>
        <?php unset($category); ?>
        <!-- <tr>
            <td>R&B</td>
        </tr>
        <tr>
            <td>Blues</td>
        </tr>
        <tr>
            <td>EDM</td>
        </tr>
        <tr>
            <td>HIPHOP</td>
        </tr>
        <tr>
            <td>House</td>
        </tr>
        <tr>
            <td>Country</td>
        </tr> -->
    </table>
</div>


