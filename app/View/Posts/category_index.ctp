<h1>Blog posts</h1>
<?php echo $this->Html->link(
    'TOP',
    array('controller' => 'posts', 'action' => 'index')
); ?>


<h1>カテゴリー「<?php echo $selectedCategory_name[0]['Category']['name'] ;?>」一覧</h1>
<div style="float:left; width:600px; margin-right:50px;">
    <table>
        <tr>
            <th>Id</th>
            <th>Title</th>
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
            <!--<?php echo $category['Category']['name']; ?>-->
            <?php echo $this->Html->link($category['Category']['name'].'('.$category['Category']['count'].')',array('controller' => 'posts', 'action' => 'category_index',$category['Category']['id'])); ?>
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


