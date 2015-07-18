<?php
class PostsController extends AppController {
    public $helpers = array('Html', 'Form','Session');
    public $uses = array('Post','Category');
    public $components = array('Session');
    public function index() {
        $categories = $this->_get_categories_append_count();
        $this->set('posts', $this->Post->find('all'));
        $this->set('categories',$this->Category->find('all'));
        $this->set(compact('posts','categories'));
    }

    public function category_index($category_id = null){
        //categoriesデータ取得
        $categories = $this->_get_categories_append_count();
        $conditions = array('category_id' => $category_id);
        $posts = $this->Post->find('all',array('conditions'=>$conditions));
        $selectedCategory_name = $this->Category->find('all',array('conditions' => array('id' => $category_id)));
        $this->set(compact('posts','categories','selectedCategory_name'));
    }

    private function _get_categories_append_count(){
        $categories = $this->Category->find('all');
        $index = 0;
        foreach ($categories as $category) {
            $postcount = $this->Post->find('count',array('conditions'=>array('category_id'=>$category['Category']['id'])));
            //debug($postcount);
            $categories[$index]['Category']['count'] = $postcount;
            $index++;
        }
        return $categories;
    }

	public function view($id = null) {
		if (!$id) {
		throw new NotFoundException(__('Invalid post null'));
		}

		$post = $this->Post->findById($id);
		if (!$post) {
		throw new NotFoundException(__('Invalid post nothing'));
		}
		$this->set('post', $post);
	}

	public function add() {
        $categories = $this->Category->find('list');
        $this->set(compact('categories'));

	        if ($this->request->is('post')) {
	            $this->Post->create();
                $this->request->data['Post']['user_id'] = $this->Auth->user('id');
	            if ($this->Post->save($this->request->data)) {
	                $this->Session->setFlash(__('Your post has been saved.'));
	                return $this->redirect(array('action' => 'index'));
	            }
	            $this->Session->setFlash(__('Unable to add your post.'));
	        }
	    }

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $post = $this->Post->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Post->id = $id;
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash(__('Your post has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to update your post.'));
        }

        if (!$this->request->data) {
            $this->request->data = $post;
        }
    }

    public function delete($id) {
    if ($this->request->is('get')) {
        throw new MethodNotAllowedException();
    }

    if ($this->Post->delete($id)) {
        $this->Session->setFlash(
            __('The post with id: %s has been deleted.', h($id))
        );
    } else {
        $this->Session->setFlash(
            __('The post with id: %s could not be deleted.', h($id))
        );
    }

    return $this->redirect(array('action' => 'index'));
    }

    public function isAuthorized($user) {
    // 登録済ユーザーは投稿できる
    if ($this->action === 'add') {
        return true;
    }

    // 投稿のオーナーは編集や削除ができる
    if (in_array($this->action, array('edit', 'delete'))) {
        $postId = (int) $this->request->params['pass'][0];
        if ($this->Post->isOwnedBy($postId, $user['id'])) {
            return true;
        }
    }

    return parent::isAuthorized($user);
    }

}
?>