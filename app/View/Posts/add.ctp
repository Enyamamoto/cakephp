<h1>Add Post</h1>
<?php
echo $this->Form->create('Post',array('enctype' => 'multipart/form-data'));
echo $this->Form->input('category_id',array('options'=>$categories));
echo $this->Form->input('title');
echo $this->Form->input('body', array('rows' => '3'));
echo $this->Form->input('upfile',array('type' => 'file'));
//echo $this->Form->input('Save Post', array('type' => 'submit'));
//echo $this->Form->end();
echo $this->Form->end('Save Post');
?>